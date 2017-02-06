<?php
/**
 * Created by PhpStorm.
 * User: DIAZ
 * Date: 24/07/2015
 * Time: 09:50 PM
 */

include_once 'EntidadBase.php';
class TipoEmpresa extends EntidadBase {


    private $nombre;

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

    function __toString()
    {
        return ('TipoEmpresa: '.$this->getId().', '.
            $this->getNombre());
    }

}