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
    public function agrega_modifica();

    public function consultarPorId();

    public function eliminar();

    public function consultarPorParametro();

    public function consultarTodos();
}