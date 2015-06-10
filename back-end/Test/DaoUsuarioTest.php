<?php
/**
 * Created by PhpStorm.
 * User: DIAZ
 * Date: 08/06/2015
 * Time: 11:25 PM
 */

namespace Test;

use Dao\DaoUsuario;
use Entidad\Usuario;
use Fabrica\FabricaDao;
use PHPUnit_Framework_TestCase;
require'..\Entidad\Usuario.php';
require'..\Dao\DaoUsuario.php';
require'..\Fabrica\FabricaDao.php';


class DaoUsuarioTest extends PHPUnit_Framework_TestCase {

    var $Usuario;


    public function setUp(){

        $Usuario = new Usuario();
        $Usuario->setNombre("Nombre");
        $Usuario->setApellido("Apellido");
        $Usuario->setCedula("19720104");
        $Usuario->setCorreo("ronoel54@gmail.com");
        $Usuario->setTipo("admin");
        $Usuario->setClave("1234");
    }


    public function testAgregarUsuario(){
        $dao = FabricaDao::obtenerDaoUsuario($Usuario);
        $this->assertContains($dao->agregar() != 0);
    }

    public function testModifcarUsuario(){
        $UsuarioMod = new Usuario();
        $UsuarioMod->setId(1);
        $UsuarioMod->setNombre("Nombre Modificado");
        $dao = FabricaDao::obtenerDaoUsuario($UsuarioMod);
        $this->assertContains($dao->modificar($UsuarioMod->getId()) != 0);
    }

    public function tearDown(){
    }

}
