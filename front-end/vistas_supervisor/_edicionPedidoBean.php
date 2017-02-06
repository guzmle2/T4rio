<?php
/**
 * Created by PhpStorm.
 * User: DIAZ
 * Date: 26/07/2015
 * Time: 02:40 AM
 */
include_once 'C:\xampp\htdocs\T4rio\front-end\Base.php';
if(isset($_GET['id']) && isset($_GET['aprobar'])){

    $dao = FabricaDao::DaoFactura(FabricaEntidad::Factura());
    $dao->editarOrden('APROBADO','',$_GET['id']);
    header("location: index.php?aprobar=si");

}else{
    if(isset($_GET['id'])){

        $dao = FabricaDao::DaoFactura(FabricaEntidad::Factura());
        $dao->editarOrden('POREDITAR',$_POST['extra'],$_GET['id']);

    }else{
        $dao = FabricaDao::DaoFactura(FabricaEntidad::Factura());
        $dao->editarOrden('POREDITAR',$_POST['extra'],$_POST['id']);

    }
    header("location: index.php?editar=si");

}
