<?php
/**
 * Created by PhpStorm.
 * User: LEONORBANCO
 * Date: 11/06/2015
 * Time: 10:36 AM
 */

namespace Dao;
use IDao\IDaoFacturaUEmpresa;

require_once 'Connect.php';
require_once '../Contrato/IDaoFacturaUEmpresa.php';

class DaoFacturaUEmpresa implements IDaoFacturaUEmpresa {


    var $FacturaUEmpresa;
    const TABLA = 'factura_usuario_empresa';

    public function __construct(&$FacturaUEmpresa)
    {
        $this->FacturaUEmpresa =& $FacturaUEmpresa;
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
        // TODO: Implement consultarPorId() method.
    }

    public function consultarPorParametro()
    {
        // TODO: Implement consultarPorParametro() method.
    }

    public function consultarTodos()
    {
        // TODO: Implement consultarTodos() method.
    }

    public function eliminar()
    {
        // TODO: Implement eliminar() method.
    }
}