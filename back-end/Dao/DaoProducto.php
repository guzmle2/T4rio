<?php
/**
 * Created by PhpStorm.
 * User: LEONORBANCO
 * Date: 10/06/2015
 * Time: 03:31 PM
 */

namespace Dao;


use Contrato\IDaoProducto;
require_once 'Connect.php';
require_once '../Contrato/IDaoProducto.php';

class DaoProducto implements IDaoProducto {

    var $Producto;
    const TABLA = 'producto';

    /**
     * @param $Producto
     */
    public function __construct(&$Producto)
    {
        $this->Producto =& $Producto;
    }

    public function agrega_modifica()
    {
        $conexion = new Connect();
        $query = '';

        if($this->Producto->getId() != null  )
        {
            if( $this->Producto->getNombre() != null && $this->Producto->getNombre() != '' &&
                $this->Producto->getPrecioActual() != null && $this->Producto->getPrecioActual() != '' &&
                $this->Producto->getEstado() != null && $this->Producto->getEstado() != ''){
                $consulta = $conexion->prepare('INSERT INTO ' . self::TABLA .'(nombre,precioActual, estado)
                VALUES  (:nombre, :precioActual, :estado)');
                $consulta->bindParam(':nombre', $this->Producto->getNombre());
                $consulta->bindParam(':precioActual', $this->Producto->getPrecioActual());
                $consulta->bindParam(':estado', $this->Producto->getEstado());
                $consulta->execute();

            }else{
                return $this->Producto = null;
            }


        }else{

            if( $this->Producto->getNombre() != null){
                if($query == ''){
                    $query .='nombre = :nombre';
                }else{
                    $query .=', nombre = :nombre';
                }
            }

            if( $this->Producto->getPrecioActual() != null){
                if($query == ''){
                    $query .='precioActual = :precioActual';
                }else{
                    $query .=', precioActual = :precioActual';
                }
            }


            if($this->Producto->getEstado() != null){
                if($query == ''){
                    $query .='estado = :estado';
                }else{
                    $query .=', estado = :estado';
                }

            }
            $consulta = $conexion->prepare('UPDATE ' . self::TABLA .' SET '.$query.
                ' WHERE id = :id');
            $consulta->bindParam(':nombre', $this->Producto->getNombre());
            $consulta->bindParam(':precioActual', $this->Producto->getPrecioActual());
            $consulta->bindParam(':estado', $this->Producto->getEstado());
            $consulta->bindParam(':id', $this->Producto->getId());
            $consulta->execute();
        }
        $this->Producto->setId($conexion->lastInsertId()) ;
        $conexion = null;
        return $this->Producto;
    }

    public function consultarPorId()
    {
        $conexion = new Connect();
        $consulta = $conexion->prepare('SELECT id,nombre, precioActual,estado FROM '
            . self::TABLA . ' WHERE id = :id');
        $consulta->bindParam(':id', $this->Usuario->getId());
        $consulta->execute();
        $registro = $consulta->fetch();
        if($registro){
            $this->Producto->setNombre($registro['nombre']);
            $this->Producto->setPrecioActual($registro['precioActual']);
            $this->Producto->setEstado($registro['estado']);
            $this->Producto->setId($registro['id']);
            $conexion = null;
            return $this->Producto;
        }else{
            return $this->Producto = null;
        }
    }

    public function consultarPorParametro()
    {
        $conexion = new Connect();
        if ($this->Producto->getId() != null) {
            $parametro = ' WHERE id = :parametro';
            $valor = $this->Producto->getId();
        } elseif ($this->Producto->getNombre() != null) {
            $parametro = ' WHERE nombre = :parametro';
            $valor = $this->Producto->getNombre();
        } elseif ($this->Producto->getPrecioActual() != null) {
            $parametro = ' WHERE precioActual = :parametro';
            $valor = $this->Producto->getPrecioActual();
        } elseif ($this->Producto->estado() != null) {
            $parametro = ' WHERE estado = :parametro';
            $valor = $this->Producto->estado();
        }else {
            $parametro = ' WHERE id = :parametro';
            $valor = 0;
        }
        $consulta = $conexion->prepare('SELECT id,
                                                nombre,
                                                precioActual,
                                                esrado
                                                FROM ' . self::TABLA . $parametro);
        $consulta->bindParam(':parametro', $valor);
        $consulta->execute();
        $registro = $consulta->fetch();
        if ($registro) {
            $this->Producto->setNombre($registro['nombre']);
            $this->Producto->setPrecioActual($registro['precioActual']);
            $this->Producto->setEstado($registro['estado']);
            $this->Producto->setId($registro['id']);
            $conexion = null;
            return $this->Producto;

        } else {
            return $this->Producto = null;
        }
    }

    public function consultarTodos()
    {
        $conexion = new Connect();

        $consulta = $conexion->prepare('SELECT id,
                                                nombre,
                                                precioActual,
                                                estado
                                                FROM ' . self::TABLA );
        $consulta->execute();
        $productos = $consulta->fetchAll();
        return $productos;
    }

    public function eliminar()
    {
        $conexion = new Connect();
        try{
            $consulta = $conexion->prepare( 'DELETE FROM ' . self::TABLA .' WHERE id = :parametro');
            $consulta->bindParam(':parametro', $this->Producto->getId());
            $consulta->execute();
            $conexion = null;

        }catch (Exception $e){
            echo 'Ha surgido un error y no se puede conectar a la base de datos. Detalle: ' . $e->getMessage();
        }
    }
}