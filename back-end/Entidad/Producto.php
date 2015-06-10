<?php
/**
 * Created by PhpStorm.
 * User: LEONORBANCO
 * Date: 10/06/2015
 * Time: 03:50 PM
 */

namespace Entidad;


use EntidadBase;

require_once 'EntidadBase.php';

class Producto extends EntidadBase {

    var $nombre;
    var $precioActual;
    var $estado;

    function __construct() {  }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getPrecioActual()
    {
        return $this->precioActual;
    }

    /**
     * @param mixed $precioActual
     */
    public function setPrecioActual($precioActual)
    {
        $this->precioActual = $precioActual;
    }

    /**
     * @return mixed
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @param mixed $estado
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }


}