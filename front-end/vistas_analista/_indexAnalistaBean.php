<?php
/**
 * Created by PhpStorm.
 * User: DIAZ
 * Date: 25/07/2015
 * Time: 10:34 PM
 */
include_once 'C:\xampp\htdocs\T4rio\front-end\Base.php';
session_start();
$Factura = FabricaEntidad::Factura();

if(isset($_POST['id'])){
    $Factura->setId($_POST['id']);
}

$TipoProducto= $_POST['tipoProducto'];
$Cantidad = $_POST['cantidad'];
$TipoEmpresa = $_POST['tipoEmpresa'];
$informacion = $_POST['informacion'];

$Factura->setFechaCreacion(date('Y-m-d'));
$Factura->setCreador($_SESSION['usuarioLogeado']);

$empresa = FabricaEntidad::TipoEmpresa();
$empresa->setId($TipoEmpresa);

$Factura->setTipoEmpresa($empresa);
$Factura->setInformacion($informacion);
$Factura->setEstatus('PENDIENTE');

$TotalT = 0;


for($i=0;$i<count($TipoProducto);$i++){
    $objeto = FabricaEntidad::FacturaProducto();
    $objeto->setCantidad($Cantidad[$i]);


    $producto = FabricaEntidad::TipoProducto();
    $producto->setId($TipoProducto[$i]);
    $dao = FabricaDao::DaoTipoProducto($producto);
    $producto = $dao->consultarXid();

    $objeto->setPrecioCompra($producto->getPrecioActual());
    $total = $producto->getPrecioActual()*$Cantidad[$i];
    $objeto->setPrecioCantidad($total);
    $objeto->setTipoProducto($producto);
    $TotalT = $TotalT + $total;
    $Factura->setProductos($objeto);
}

$Factura->setPrecioTotal($TotalT);
$dao = FabricaDao::DaoFactura($Factura);
if ($Factura->getId() != null){
    $Factura = $dao->modificar();
    if($Factura != null){
        header("location: comprobante.php?id=".$Factura->getId());
    }else{
        header("location: index.php?error=si");
    }

}else{
    $Factura = $dao->agregar();
    if($Factura != null){
        header("location: comprobante.php?id=".$Factura->getId());
    }else{
        header("location: index.php?error=si");
    }


}


