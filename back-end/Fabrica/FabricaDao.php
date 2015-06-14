<?php
/**
 * Created by PhpStorm.
 * User: DIAZ
 * Date: 09/06/2015
 * Time: 12:06 AM
 */

namespace Fabrica;

use Dao\DaoEmpresa;
use Dao\DaoFacturaUEmpresa;
use Dao\DaoFacturaUEProducto;
use Dao\DaoProducto;
use Dao\DaoUsuario;
require_once '..\Dao\DaoUsuario.php';
require_once '..\Dao\DaoProducto.php';
require_once '..\Dao\DaoEmpresa.php';
require_once '..\Dao\DaoFacturaUEmpresa.php';
require_once '..\Dao\DaoFacturaUEProducto.php';

class FabricaDao {

    public static function obtenerDaoUsuario(&$Usuario){
        return new DaoUsuario($Usuario);
    }

    public static function obtenerDaoProducto(&$Producto){
        return new DaoProducto($Producto);
    }

    public static function obtenerDaoEmpresa(&$Empresa){
        return new DaoEmpresa($Empresa);
    }

    public static function obtenerDaoFacturaUEmpresa(&$FacturaUEmpresa){
        return new DaoFacturaUEmpresa($FacturaUEmpresa);
    }

    public static function obtenerDaoFacturaUEProducto(&$FacturaUEProducto){
        return new DaoFacturaUEProducto($FacturaUEProducto);
    }

}