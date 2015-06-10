<?php
/**
 * Created by PhpStorm.
 * User: DIAZ
 * Date: 09/06/2015
 * Time: 12:06 AM
 */

namespace Fabrica;

use Dao\DaoProducto;
use Dao\DaoUsuario;
require_once '..\Dao\DaoUsuario.php';
require_once '..\Dao\DaoProducto.php';

class FabricaDao {

    public function obtenerDaoUsuario(&$Usuario){
        return new DaoUsuario($Usuario);
    }

    public function obtenerDaoProducto(&$Producto){
        return new DaoProducto($Producto);
    }

}