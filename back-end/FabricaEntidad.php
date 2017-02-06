<?php
/**
 * Created by PhpStorm.
 * User: DIAZ
 * Date: 24/07/2015
 * Time: 09:45 PM
 */

include_once 'C:\xampp\htdocs\T4rio\back-end\Entidad\Usuario.php';
include_once 'C:\xampp\htdocs\T4rio\back-end\Entidad\TipoProducto.php';
include_once 'C:\xampp\htdocs\T4rio\back-end\Entidad\TipoEmpresa.php';
include_once 'C:\xampp\htdocs\T4rio\back-end\Entidad\FacturaProducto.php';
include_once 'C:\xampp\htdocs\T4rio\back-end\Entidad\Factura.php';
include_once 'C:\xampp\htdocs\T4rio\back-end\Conexion.php';
class FabricaEntidad {

    public static function Usuario(){
        return new Usuario();
    }

    public static function TipoEmpresa(){
        return new TipoEmpresa();
    }

    public static function TipoProducto(){
        return new TipoProducto();
    }

    public static function FacturaProducto(){
        return new FacturaProducto();
    }

    public static function Factura(){
        return new Factura();
    }

    public static function Conexion()
    {
        return new Conexion();
    }
}