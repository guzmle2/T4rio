<?php
/**
 * Created by PhpStorm.
 * User: DIAZ
 * Date: 25/07/2015
 * Time: 09:08 PM
 */

include_once 'C:\xampp\htdocs\T4rio\front-end\Base.php';

if (isset($_GET['cantidad']) && isset($_GET['precioIndividual'])){

    $cantidad =$_GET['cantidad'];
    $precio = $_GET['precioIndividual'];
    echo $cantidad*$precio;

}

if (isset($_GET['tipoProducto'])){
    $producto = FabricaEntidad::TipoProducto();
    $producto->setId($_GET['tipoProducto'] );
    $dao = FabricaDao::DaoTipoProducto($producto);
    $producto = $dao->consultarXid();
    echo $producto->getPrecioActual();

}


