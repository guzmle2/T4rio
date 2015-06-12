<?php
/**
 * Created by PhpStorm.
 * User: LEONORBANCO
 * Date: 11/06/2015
 * Time: 10:37 AM
 */

namespace Dao;

use IDao\IDaoFacturaUEProducto;

require_once 'Connect.php';
require_once '../Contrato/IDaoFacturaUEProducto.php';

class DaoFacturaUEProducto implements IDaoFacturaUEProducto {


    var $FacturaUEProducto;
    const TABLA = 'factura_usuario_$FacturaUEmpresa_producto';

    public function __construct(&$FacturaUEProducto)
    {
        $this->FacturaUEProducto =& $FacturaUEProducto;
    }

    public function agrega_modifica()
    {
        $conexion = new Connect();
        $query = '';

        if($this->$FacturaUEProducto->getId() != null  )
        {
            if( $this->$FacturaUEProducto->getEmpresa() != null &&
                $this->$FacturaUEProducto->getProducto() != null &&
                $this->$FacturaUEProducto->getCantidad() != null && $this->$FacturaUEProducto->getCantidad() != '' &&
                $this->$FacturaUEProducto->getPrecioCompra() != null && $this->$FacturaUEProducto->getPrecioCompra() != '' &&
                $this->$FacturaUEProducto->getPrecioCantidad() != null && $this->$FacturaUEProducto->getPrecioCantidad() != ''){
                $consulta = $conexion->prepare('INSERT INTO ' . self::TABLA .'(id_facturaUsuario$FacturaUEmpresa,id_producto, cantidad, precioCompra,precioCantidad)
                VALUES  (:id_facturaUsuario$FacturaUEmpresa, :id_producto, :cantidad, :precioCompra, :precioCantidad)');
                $consulta->bindParam(':id_facturaUsuario$FacturaUEmpresa', $this->$FacturaUEProducto->getFacturaUEmpresa()->getId());
                $consulta->bindParam(':id_producto', $this->$FacturaUEProducto->getProducto()->getId());
                $consulta->bindParam(':cantidad', $this->$FacturaUEProducto->getCantidad());
                $consulta->bindParam(':precioCompra', $this->$FacturaUEProducto->getPrecioCompra());
                $consulta->bindParam(':precioCantidad', $this->$FacturaUEProducto->getPrecioCantidad());
                $consulta->execute();

                $this->$FacturaUEProducto->setId($conexion->lastInsertId()) ;

            }else{
                return $this->$FacturaUEProducto = null;
            }


        }else{

            if( $this->$FacturaUEProducto->getCantidad() != null){
                if($query == ''){
                    $query .='cantidad = :cantidad';
                }else{
                    $query .=', cantidad = :cantidad';
                }
            }

            if( $this->$FacturaUEProducto->getPrecioCompra() != null){
                if($query == ''){
                    $query .='precioCompra = :precioCompra';
                }else{
                    $query .=', precioCompra = :precioCompra';
                }
            }


            if($this->$FacturaUEProducto->getPrecioCantidad() != null){
                if($query == ''){
                    $query .='precioCantidad = :precioCantidad';
                }else{
                    $query .=', estado = :estado';
                }

            }
            $consulta = $conexion->prepare('UPDATE ' . self::TABLA .' SET '.$query.
                ' WHERE id = :id');
            $consulta->bindParam(':cantidad', $this->$FacturaUEProducto->getCantidad());
            $consulta->bindParam(':precioCompra', $this->$FacturaUEProducto->getPrecioCompra());
            $consulta->bindParam(':precioCantidad', $this->$FacturaUEProducto->getPrecioCantidad());
            $consulta->bindParam(':id', $this->$FacturaUEProducto->getId());
            $consulta->execute();
        }
        $conexion = null;
        return $this->$FacturaUEProducto;
    }

    public function consultarPorId()
    {

    }

    public function consultarPorParametro()
    {
        if ($this->FacturaUEProducto->getId() != null) {
            $parametro = ' factura_usuario_empresa_producto.id = :parametro';
            $valor = $this->FacturaUEProducto->getId();
        } elseif ($this->FacturaUEProducto->getProducto() != null) {
            $parametro = ' producto.nombre = :parametro';
            $valor = $this->FacturaUEProducto->getProducto()->getNombre();
        }else {
            $parametro = ' id = :parametro';
            $valor = 0;
        }
        $conexion = new Connect();
        $consulta = $conexion->prepare('SELECT factura_usuario_empresa_producto.id,
                                          producto.nombre,
                                          factura_usuario_empresa_producto.cantidad,
                                          factura_usuario_empresa_producto.precioCompra,
                                          factura_usuario_empresa_producto.precioCantidad
                                        FROM '. self::TABLA .'
                                          INNER JOIN producto
    ON factura_usuario_empresa_producto.id_producto=producto.id; WHERE ' .$parametro);
        $consulta->bindParam(':parametro', $valor);
        $consulta->execute();
        $facturasProductos = $consulta->fetchAll();
        $conexion = null;
        return $facturasProductos;

    }

    public function consultarTodos()
    {
        $conexion = new Connect();
        $consulta = $conexion->prepare('SELECT factura_usuario_empresa_producto.id,
                                          producto.nombre,
                                          factura_usuario_empresa_producto.cantidad,
                                          factura_usuario_empresa_producto.precioCompra,
                                          factura_usuario_empresa_producto.precioCantidad
                                        FROM '. self::TABLA .'
                                          INNER JOIN producto
    ON factura_usuario_empresa_producto.id_producto=producto.id;');
        $consulta->execute();
        $facturasProductos = $consulta->fetchAll();
        $conexion = null;
        return $facturasProductos;
    }

    public function eliminar()
    {
        $conexion = new Connect();
        try{
            $consulta = $conexion->prepare( 'DELETE FROM ' . self::TABLA .' WHERE id = :parametro');
            $consulta->bindParam(':parametro', $this->FacturaUEProducto->getId());
            $consulta->execute();
            $conexion = null;

        }catch (Exception $e){
            $conexion = null;
            echo 'Ha surgido un error y no se puede conectar a la base de datos. Detalle: ' . $e->getMessage();
        }
    }
}