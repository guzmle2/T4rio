<?php
/**
 * Created by PhpStorm.
 * User: LEONORBANCO
 * Date: 11/06/2015
 * Time: 06:30 PM
 */

namespace Entidad;
use EntidadBase;

include_once  'EntidadBase.php';

class FacturaUEmpresa extends EntidadBase {

    /**
     * @var Usuario
     */
    var $Usuario;

    /**
     * @var Empresa
     */
    var $Empresa;

    /**
     * @var $fechaCreacion
     */
    var $fechaCreacion;

    /**
     * @var $precioTotal
     */
    var $precioTotal;

    function __construct(){
    $this->Usuario = new Usuario();
    $this->Empresa = new Empresa();

    }


    /**
     * @return Usuario
     */
    public function getUsuario()
    {
        return $this->Usuario;
    }

    /**
     * @param Usuario $Usuario
     */
    public function setUsuario(&$Usuario)
    {
        $this->Usuario =& $Usuario;
    }

    /**
     * @return Empresa
     */
    public function getEmpresa()
    {
        return $this->Empresa;
    }

    /**
     * @param Empresa $Empresa
     */
    public function setEmpresa(&$Empresa)
    {
        $this->Empresa =& $Empresa;;
    }

    /**
     * @return mixed
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * @param mixed $fechaCreacion
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;
    }

    /**
     * @return mixed
     */
    public function getPrecioTotal()
    {
        return $this->precioTotal;
    }

    /**
     * @param mixed $precioTotal
     */
    public function setPrecioTotal($precioTotal)
    {
        $this->precioTotal = $precioTotal;
    }


}