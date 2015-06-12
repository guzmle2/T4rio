<?php
/**
 * Created by PhpStorm.
 * User: LEONORBANCO
 * Date: 11/06/2015
 * Time: 10:32 AM
 */

namespace Test;
use Entidad\Producto;
use PHPUnit_Framework_TestCase;
use Fabrica\FabricaDao;

require_once 'TestBase.php';
require '../Fabrica/FabricaDao.php';
require'..\Entidad\Producto.php';

class TestDaoProducto extends PHPUnit_Framework_TestCase implements TestBase {

    var $Producto;
    /**
     * inicio de la prueba
     */
    public function setUp(){
        $Product = new Producto();
        $Product->setNombre("Producto #1");
        $Product->setPrecioActual("1200");
        $Product->setEstado("");
        $this->Producto = $Product;
    }


    /**
     * Prueba dao de agregar usuario
     */
    public function testAgregarVacio(){
        $this->Producto->setNombre("");
        $dao = FabricaDao::obtenerDaoProducto($this->Producto);
        $dao->agrega_modifica();
        $this->assertTrue($dao->Producto==null);
    }

    public function testAgregar(){
//
//        $dao = FabricaDao::obtenerDaoUsuario($this->Producto);
//        $dao->agrega_modifica();
//        $this->assertTrue($dao->Usuario->getId() != 0);
//        $this->Producto->setId($dao->Usuario->getId());
    }

    /**
     * prueba dao de modificar usuario
     */
    public function testModifcar(){
/*        $this->Producto->setNombre("Nombre Modificado");
        $dao = FabricaDao::obtenerDaoUsuario($this->Producto);
        $dao->agrega_modifica();
        $dao->consultarPorId();
        $this->assertEquals($dao->Usuario->getNombre(), $this->Producto->getNombre());*/
    }

    /**
     * Prueba unitaria que elimina
     */
    public function testEliminar(){
/*        $dao = FabricaDao::obtenerDaoUsuario($this->Producto);
        $dao->eliminar();
        $dao->consultarPorId();
        $this->assertTrue($dao->Usuario == null);*/

    }


    /**
     * Prueba unitaria que consulta todos
     */
    public function testConsultarTodos(){
/*        $dao = FabricaDao::obtenerDaoUsuario($this->Producto);
        $registros = $dao->consultarTodos();
        $this->assertTrue($registros != null);*/
    }

    /**
     * metodo que prueba la consulta por parametro
     */
    public function testConsultarPorParametro(){
/*        $usr = new Usuario();
        $usr->setCorreo("ronoel54@gmail.com");
        $dao = FabricaDao::obtenerDaoUsuario($usr);
        $this->assertEquals($dao->Usuario->getCorreo(), $usr->getCorreo());*/
    }


    /**
     * metodo que prueba la consulta por parametro
     */
    public function testConsultarPorId(){
/*        $usr = new Usuario();
        $usr->setId(1);
        $dao = FabricaDao::obtenerDaoUsuario($usr);
        $dao->consultarPorId();
        $this->assertEquals($dao->Usuario->getId(), $usr->getId());*/
    }




    /**
     * Cierre de la preba
     *
     */
    public function tearDown(){
    }
}