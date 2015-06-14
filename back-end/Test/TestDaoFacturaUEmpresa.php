<?php
/**
 * Created by PhpStorm.
 * User: LEONORBANCO
 * Date: 11/06/2015
 * Time: 10:32 AM
 */

namespace Test;
use Entidad\Empresa;
use Entidad\FacturaUEmpresa;
use Entidad\Usuario;
use Fabrica\FabricaDao;
use PHPUnit_Framework_TestCase;


require '../Fabrica/FabricaDao.php';
require'..\Entidad\Empresa.php';
require'..\Entidad\Usuario.php';
require'..\Entidad\FacturaUEmpresa.php';
require_once 'TestBase.php';

class TestDaoFacturaUEmpresa extends PHPUnit_Framework_TestCase implements TestBase {

    var $FactUEmpresa;

    /**
     * inicio de la prueba
     */
    public function setUp()
    {
        $Bussines = new Empresa();
        $Bussines->setNombre("Empresa");
        $Bussines->setRif("J00001");
        $Bussines->setDireccion("Calle cemento, Av. Rallada");
        $Bussines->setCorreo("empresa@correo.com");
        $dao = FabricaDao::obtenerDaoEmpresa($Bussines);
        $dao->agrega_modifica();
        $Bussines->setId($dao->Empresa->getId());

        $Usuario = new Usuario();
        $Usuario->setNombre("Nombre");
        $Usuario->setApellido("Apellido");
        $Usuario->setCedula("19720104");
        $Usuario->setCorreo("ronoel54@gmail.com");
        $Usuario->setTipo("admin");
        $Usuario->setClave("1234");
        $dao = FabricaDao::obtenerDaoUsuario($Usuario);
        $dao->agrega_modifica();
        $Usuario->setId($dao->Usuario->getId());

        $FUEmpresa = new FacturaUEmpresa();
        $FUEmpresa->setUsuario($Usuario);
        $FUEmpresa->setEmpresa($Bussines);
        $FUEmpresa->setFechaCreacion("12/12/12");
        $FUEmpresa->setPrecioTotal("1500");
        $FUEmpresa->setPrecioTotal("1200");



        $this->FactUEmpresa = $FUEmpresa;
    }

    /**
     * Prueba dao de agregar usuario
     */
    public function testAgregarVacio(){
        $this->FactUEmpresa->setfechaCreacion(null);
        $dao = FabricaDao::obtenerDaoFacturaUEmpresa($this->FactUEmpresa);
        $dao->agrega_modifica();
        $this->assertTrue($dao->FacturaUEmpresa == null);
    }

    /**
     * Prueba de dao agregar
     */
    public function testAgregar(){
        $dao = FabricaDao::obtenerDaoFacturaUEmpresa($this->FactUEmpresa);
        $dao->agrega_modifica();
        $this->FactUEmpresa->setId($dao->FacturaUEmpresa->getId());
        $this->assertTrue($dao->FacturaUEmpresa->getId()!=0);
    }

    /**
     * prueba dao de modificar usuario
     */
    public function testModifcar(){
        $this->FactUEmpresa->setFechaCreacion("1/01/2016");
        $dao = FabricaDao::obtenerDaoFacturaUEmpresa($this->FactUEmpresa);
        $dao->agrega_modifica();
        $dao->consultarPorId();
        $this->assertEquals($dao->FacturaUEmpresa->getFechaCreacion(), $this->FactUEmpresa->getFechaCreacion());
    }




    /**
     * Prueba unitaria que consulta todos
     */
    public function testConsultarTodos(){
        $dao = FabricaDao::obtenerDaoFacturaUEmpresa($this->FactUEmpresa);
        $registros = $dao->consultarTodos();
        $this->assertTrue($registros != null);
    }

    /**
     * metodo que prueba la consulta por parametro
     */
    public function testConsultarPorParametro(){
        $usr = new FacturaUEmpresa();
        $usr->setId(1);
        $dao = FabricaDao::obtenerDaoFacturaUEmpresa($usr);
        $dao->consultarPorParametro();
        $this->assertEquals($dao->FacturaUEmpresa->getId(), $usr->getId());
    }


    /**
     * metodo que prueba la consulta por parametro
     */
    public function testConsultarPorId(){
        $usr = new FacturaUEmpresa();
        $usr->setId(1);
        $dao = FabricaDao::obtenerDaoFacturaUEmpresa($usr);
        $dao->consultarPorId();
        $this->assertEquals($dao->FacturaUEmpresa->getId(), $usr->getId());
    }

    /**
     * Prueba unitaria que elimina
     */
    public function testEliminar(){
        $dao = FabricaDao::obtenerDaoFacturaUEmpresa($this->FactUEmpresa);
        $dao->eliminar();
        $dao->consultarPorId();
        $this->assertTrue($dao->FacturaUEmpresa == null);
    }

    /**
     * Cierre de la preba
     *
     */
    public function tearDown()
    {


    }
}