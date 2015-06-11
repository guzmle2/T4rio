<?php
/**
 * Created by PhpStorm.
 * User: LEONORBANCO
 * Date: 11/06/2015
 * Time: 10:31 AM
 */
namespace Test;

interface TestBase
{
    /**
     * inicio de la prueba
     */
    public function setUp();

    /**
     * Prueba dao de agregar usuario
     */
    public function testAgregar();

    /**
     * prueba dao de modificar usuario
     */
    public function testModifcar();

    /**
     * Prueba unitaria que elimina
     */
    public function testEliminar();

    /**
     * Prueba unitaria que consulta todos
     */
    public function testConsultarTodos();

    /**
     * metodo que prueba la consulta por parametro
     */
    public function testConsultarPorParametro();

    /**
     * metodo que prueba la consulta por parametro
     */
    public function testConsultarPorId();

    /**
     * Cierre de la preba
     *
     */
    public function tearDown();
}