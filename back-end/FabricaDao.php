<?php
/**
 * Created by PhpStorm.
 * User: DIAZ
 * Date: 24/07/2015
 * Time: 09:45 PM
 */

include_once 'C:\xampp\htdocs\T4rio\back-end\Dao\DaoFactura.php';
include_once 'C:\xampp\htdocs\T4rio\back-end\Dao\DaoFacturaProducto.php';
include_once 'C:\xampp\htdocs\T4rio\back-end\Dao\DaoTipoProducto.php';
include_once 'C:\xampp\htdocs\T4rio\back-end\Dao\DaoTipoEmpresa.php';
include_once 'C:\xampp\htdocs\T4rio\back-end\Dao\DaoUsuario.php';
class FabricaDao {

    public static function DaoUsuario(Usuario $usuario){
        return new DaoUsuario($usuario);
    }

    public static function DaoFacturaProducto(FacturaProducto $facturaProducto){
        return new DaoFacturaProducto($facturaProducto);
    }

    public static function DaoTipoProducto(TipoProducto $tipoProducto){
        return new DaoTipoProducto($tipoProducto);
    }

    public static function DaoTipoEmpresa(TipoEmpresa $tipoEmpresa){
        return new DaoTipoEmpresa($tipoEmpresa);
    }

    public static function DaoFactura(Factura $factura){
        return new DaoFactura($factura);
    }

}