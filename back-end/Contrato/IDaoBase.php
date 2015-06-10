<?php
/**
 * Created by PhpStorm.
 * User: DIAZ
 * Date: 08/06/2015
 * Time: 11:52 PM
 */
namespace IDao;

interface IDaoBase
{
    public function agregar();

    public function modificar($id);

    public function consultarPorId();

    public function consultarPorParametro();

    public function consultarTodos();
}