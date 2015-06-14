<?php
/**
 * Created by PhpStorm.
 * User: LEONORBANCO
 * Date: 11/06/2015
 * Time: 10:32 AM
 */

namespace Test;
use Entidad\Empresa;
use PHPUnit_Framework_TestCase;
use Fabrica\FabricaDao;

require_once 'TestBase.php';
require '../Fabrica/FabricaDao.php';
require'..\Entidad\Empresa.php';


class TestDaoEmpresa extends PHPUnit_Framework_TestCase implements TestBase {


    var $Empresa;
    /**
     * inicio de la prueba
     */
    public function setUp(){
        $Bussines = new Empresa();
        $Bussines->setNombre("Empresa");
        $Bussines->setRif("J00001");
        $Bussines->setDireccion("Calle cemento, Av. Rallada");
        $Bussines->setCorreo("empresa@correo.com");        
        $this->Empresa = $Bussines;
    }


    /**
     * Prueba dao de agregar usuario
     */
    public function testAgregarVacio(){
        $this->Empresa->setNombre("");
        $dao = FabricaDao::obtenerDaoEmpresa($this->Empresa);
        $dao->agrega_modifica();
        $this->assertTrue($dao->Empresa==null);
    }

    /**
     * Prueba de dao agregar
     */
    public function testAgregar(){
        $dao = FabricaDao::obtenerDaoEmpresa($this->Empresa);
        $dao->agrega_modifica();
        $this->Empresa->setId($dao->Empresa->getId());
        $this->assertTrue($dao->Empresa->getId()!=0);
    }

    /**
     * prueba dao de modificar usuario
     */
    public function testModifcar(){
        $this->Empresa->setNombre("Nombre Modificado");
        $dao = FabricaDao::obtenerDaoEmpresa($this->Empresa);
        $dao->agrega_modifica();
        $dao->consultarPorId();
        $this->assertEquals($dao->Empresa->getNombre(), $this->Empresa->getNombre());
    }



    /**
     * Prueba unitaria que consulta todos
     */
    public function testConsultarTodos(){
        $dao = FabricaDao::obtenerDaoEmpresa($this->Empresa);
        $registros = $dao->consultarTodos();
        $this->assertTrue($registros != null);
    }

    /**
     * metodo que prueba la consulta por parametro
     */
    public function testConsultarPorParametro(){
        $usr = new Empresa();
        $usr->setId(1);
        $dao = FabricaDao::obtenerDaoEmpresa($usr);
        $this->assertEquals($dao->Empresa->getId(), $usr->getId());
    }


    /**
     * metodo que prueba la consulta por parametro
     */
    public function testConsultarPorId(){
        $usr = new Empresa();
        $usr->setId(1);
        $dao = FabricaDao::obtenerDaoEmpresa($usr);
        $dao->consultarPorId();
        $this->assertEquals($dao->Empresa->getId(), $usr->getId());
    }


    /**
     * Prueba unitaria que elimina
     */
    public function testEliminar(){
        $dao = FabricaDao::obtenerDaoEmpresa($this->Empresa);
        $dao->eliminar();
        $dao->consultarPorId();
        $this->assertTrue($dao->Empresa == null);
    }


    /**
     * Cierre de la preba
     *
     */
    public function tearDown(){
    }
}