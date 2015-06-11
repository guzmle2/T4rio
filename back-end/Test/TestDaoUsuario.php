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
require_once 'TestBase.php';


class DaoUsuarioTest extends PHPUnit_Framework_TestCase implements TestBase
{

    var $User;


    /**
     * inicio de la prueba
     */
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
    public function testAgregarVacio(){
        $this->User->setNombre("");
        $dao = FabricaDao::obtenerDaoUsuario($this->User);
        $dao->agrega_modifica();
        $this->assertTrue($dao->Usuario==null);
    }

    public function testAgregar(){

        $dao = FabricaDao::obtenerDaoUsuario($this->User);
        $dao->agrega_modifica();
        $this->assertTrue($dao->Usuario->getId() != 0);
        $this->User->setId($dao->Usuario->getId());
    }

    /**
     * prueba dao de modificar usuario
     */
    public function testModifcar(){
        $this->User->setNombre("Nombre Modificado");
        $dao = FabricaDao::obtenerDaoUsuario($this->User);
        $dao->agrega_modifica();
        $dao->consultarPorId();
        $this->assertEquals($dao->Usuario->getNombre(), $this->User->getNombre());
    }

    /**
     * Prueba unitaria que elimina
     */
    public function testEliminar(){
        $dao = FabricaDao::obtenerDaoUsuario($this->User);
        $dao->eliminar();
        $dao->consultarPorId();
        $this->assertTrue($dao->Usuario == null);

    }


    /**
     * Prueba unitaria que consulta todos
     */
    public function testConsultarTodos(){
        $dao = FabricaDao::obtenerDaoUsuario($this->User);
        $registros = $dao->consultarTodos();
        $this->assertTrue($registros != null);
    }

    /**
     * metodo que prueba la consulta por parametro
     */
    public function testConsultarPorParametro(){
        $usr = new Usuario();
        $usr->setCorreo("ronoel54@gmail.com");
        $dao = FabricaDao::obtenerDaoUsuario($usr);
        $this->assertEquals($dao->Usuario->getCorreo(), $usr->getCorreo());
    }


    /**
     * metodo que prueba la consulta por parametro
     */
    public function testConsultarPorId(){
        $usr = new Usuario();
        $usr->setId(1);
        $dao = FabricaDao::obtenerDaoUsuario($usr);
        $dao->consultarPorId();
        $this->assertEquals($dao->Usuario->getId(), $usr->getId());
    }




    /**
     * Cierre de la preba
     *
     */
    public function tearDown(){
    }

}
