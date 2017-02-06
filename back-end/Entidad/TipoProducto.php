<?php
/**
 * Created by PhpStorm.
 * User: DIAZ
 * Date: 24/07/2015
 * Time: 09:49 PM
 */

include_once 'EntidadBase.php';
class TipoProducto extends EntidadBase {


    private $nombre;
    private $precioActual;
    private $estado;

    function __construct()
    {
    }

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

    function __toString()
    {
        return ('TipoProducto: '.$this->getId().', '.
            $this->getNombre().', '.
            $this->getPrecioActual().', '.
            $this->getEstado());
    }

}