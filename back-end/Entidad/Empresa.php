<?php
/**
 * Created by PhpStorm.
 * User: LEONORBANCO
 * Date: 11/06/2015
 * Time: 06:29 PM
 */

namespace Entidad;

use EntidadBase;

require_once 'EntidadBase.php';

class Empresa extends EntidadBase {

    private $nombre;
    private $rif;
    private $direccion;
    private $correo;

    function __construct() { }

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
    public function getRif()
    {
        return $this->rif;
    }

    /**
     * @param mixed $rif
     */
    public function setRif($rif)
    {
        $this->rif = $rif;
    }

    /**
     * @return mixed
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * @param mixed $direccion
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    /**
     * @return mixed
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * @param mixed $correo
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;
    }

}