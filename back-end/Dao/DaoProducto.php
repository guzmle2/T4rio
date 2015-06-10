<?php
/**
 * Created by PhpStorm.
 * User: LEONORBANCO
 * Date: 10/06/2015
 * Time: 03:31 PM
 */

namespace Dao;


use Contrato\IDaoProducto;

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

        if($this->Producto->getId() != null)
        {
            $consulta = $conexion->prepare('INSERT INTO ' . self::TABLA .'
             (nombre,
             precioActual,
             estado)
             VALUES
             (:nombre,
              :precioActual,
              :estado)');
            $consulta->bindParam(':nombre', $this->Producto->getNombre());
            $consulta->bindParam(':precioActual', $this->Producto->getPrecioActual());
            $consulta->bindParam(':estado', $this->Producto->getEstado());
            $consulta->execute();

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
        // TODO: Implement consultarPorId() method.
    }

    public function eliminar()
    {
        // TODO: Implement eliminar() method.
    }

    public function consultarPorParametro()
    {
        // TODO: Implement consultarPorParametro() method.
    }

    public function consultarTodos()
    {
        // TODO: Implement consultarTodos() method.
    }
}