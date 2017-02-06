<?php
/**
 * Created by PhpStorm.
 * User: DIAZ
 * Date: 25/07/2015
 * Time: 06:32 PM
 */

include_once 'Base.php';

session_start();

$usuario = FabricaEntidad::Usuario();
if(isset($_SESSION['usuarioLogeado'])){
    $usuario = $_SESSION['usuarioLogeado'];
    $clave = $usuario->getClave();

}else{

    if(isset($_POST['correo'])){
        $usuario->setCorreo($_POST['correo']);
    }

    $dao = FabricaDao::DaoUsuario($usuario);
    $usuario = $dao->consultarXLogin();
    $clave = $_POST['clave'];
}

if($usuario != null){
    if($usuario->getClave() == $clave){
        if(isset($_SESSION['usuarioLogeado'])){

        }else{
            $_SESSION['usuarioLogeado'] =$usuario;
        }

        if($usuario->getTipo() == 'GERENTE'){
            header("location: vistas_gerente/");

        }elseif($usuario->getTipo() == 'SUPERVISOR'){
            header("location: vistas_supervisor/");
        }else{
            header("location: vistas_analista/");
        }


    }else{
        header("location: index.php?clave=no");
    }

}else{
    header("location: registroUsuario.php?correo=".$_POST['correo']);
}

