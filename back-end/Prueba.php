<?php
/**
 * Created by PhpStorm.
 * User: DIAZ
 * Date: 07/06/2015
 * Time: 07:55 PM
 */

include 'Entidad\Usuario.php';
require_once 'Dao\DaoUsuario.php';
use Entidad\Usuario;

$usuario = new Usuario("Leonor", "Guzman","19720106","ronoel54@gmail.com", "admin","1234",null);
$dao = new DaoUsuario($usuario);
$dao->agregar();

if ($dao->Objeto->getId() == 0)
{    echo"No se creo";
}else{
    echo"se creo" .$dao->Objeto->getId();
}

