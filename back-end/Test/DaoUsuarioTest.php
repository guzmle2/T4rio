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

    var $User;


    public function setUp(){
        $Usuario = new Usuario();
        $Usuario->setNombre("Nombre");
        $Usuario->setApellido("Apellido");
        $Usuario->setCedula("19720104");
        $Usuario->setCorreo("ronoel54@gmail.com");
        $Usuario->setTipo("admin");
        $Usuario->setClave("1234");
        $this->User = $Usuario;
    }


    /**
     * Prueba dao de agregar usuario
     */
    public function testAgregarUsuario(){
        $dao = FabricaDao::obtenerDaoUsuario($this->User);
        $dao->agrega_modifica();
        $this->assertTrue($dao->Usuario->getId() != 0);
        $this->User->setId($dao->Usuario->getId());
    }

    /**
     * prueba dao de modificar usuario
     */
    public function testModifcarUsuario(){
        $this->User->setNombre("Nombre Modificado");
        $dao = FabricaDao::obtenerDaoUsuario($this->User);
        $dao->agrega_modifica();
        $dao->consultarPorId();
        $this->assertEquals($dao->Usuario->getNombre(), $this->User->getNombre());
    }

    public function testEliminarUsuario(){
        $dao = FabricaDao::obtenerDaoUsuario($this->User);
        $dao->eliminar();
        $dao->consultarPorId();
        $this->assertTrue($dao->Usuario == null);

    }

    public function tearDown(){
    }

}
