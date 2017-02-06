<?php
/**
 * Created by PhpStorm.
 * User: DIAZ
 * Date: 25/07/2015
 * Time: 07:24 PM
 */
include_once 'C:\xampp\htdocs\T4rio\front-end\Base.php';
$usuario = FabricaEntidad::Usuario();

if(isset($_POST['nombre'])){
    $usuario->setNombre($_POST['nombre']);
}
if(isset($_POST['apellido'])){
    $usuario->setApellido($_POST['apellido']);
}
if(isset($_POST['cedula'])){
    $usuario->setCedula($_POST['cedula']);
}
if(isset($_POST['correo'])){
    $usuario->setCorreo($_POST['correo']);
}
if(isset($_POST['tipo'])){
    $usuario->setTipo($_POST['tipo']);
}
if(isset($_POST['clave'])){
    $usuario->setClave( $_POST['clave']);
}


$dao = FabricaDao::DaoUsuario($usuario);
$usuario = $dao->agregar();
if($usuario != null){
    session_start();
    $_SESSION['usuarioLogeado'] = $usuario;
    header("location: _indexBean.php");
}else{
    header("location: index.php?error=si");
}
