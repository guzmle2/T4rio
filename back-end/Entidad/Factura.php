<?php
/**
 * Created by PhpStorm.
 * User: DIAZ
 * Date: 24/07/2015
 * Time: 09:51 PM
 */

include_once 'EntidadBase.php';
include_once 'C:\xampp\htdocs\T4rio\back-end\FabricaEntidad.php';
class Factura extends EntidadBase {

    private $Creador;

    private $TipoEmpresa;

    private $FechaCreacion;

    private $precioTotal;

    private $informacion;

    private $estatus;

    private $Productos = array();

    private $nuevoProducto;

    private $extra;


    function __construct()
    {
        $this->Creador = FabricaEntidad::Usuario();
        $this->TipoEmpresa = FabricaEntidad::TipoEmpresa();
    }

    /**
     * @return mixed
     */
    public function getCreador()
    {
        return $this->Creador;
    }

    /**
     * @param mixed $Creador
     */
    public function setCreador( Usuario $Creador)
    {
        $this->Creador = $Creador;
    }

    /**
     * @return mixed
     */
    public function getTipoEmpresa()
    {
        return $this->TipoEmpresa;
    }

    /**
     * @param mixed $TipoEmpresa
     */
    public function setTipoEmpresa(TipoEmpresa $TipoEmpresa)
    {
        $this->TipoEmpresa = $TipoEmpresa;
    }

    /**
     * @return mixed
     */
    public function getFechaCreacion()
    {
        return $this->FechaCreacion;
    }

    /**
     * @param mixed $FechaCreacion
     */
    public function setFechaCreacion($FechaCreacion)
    {
        $this->FechaCreacion = $FechaCreacion;
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

    /**
     * @return mixed
     */
    public function getInformacion()
    {
        return $this->informacion;
    }

    /**
     * @param mixed $informacion
     */
    public function setInformacion($informacion)
    {
        $this->informacion = $informacion;
    }

    /**
     * @return mixed
     */
    public function getEstatus()
    {
        return $this->estatus;
    }

    /**
     * @param mixed $estatus
     */
    public function setEstatus($estatus)
    {
        $this->estatus = $estatus;
    }

    function __toString()
    {
        return ('Factura: '.$this->getCreador().', '.
            $this->getTipoEmpresa().', '.
            $this->getFechaCreacion().', '.
            $this->getPrecioTotal().', '.
            $this->getInformacion().', '.
            $this->getEstatus());
    }

    function getProductos()
    {
        return $this->Productos;
    }

    function setProductos($facturaProducto)
    {
        $this->nuevoProducto = $facturaProducto;
        array_push($this->Productos , $this->nuevoProducto);
    }

    function setNuevoProducto(FacturaProducto $facturaProducto)
    {
        $this->nuevoProducto = $facturaProducto;
        array_push($this->Productos , $this->nuevoProducto);
    }

    /**
     * @return mixed
     */
    public function getExtra()
    {
        return $this->extra;
    }

    /**
     * @param mixed $extra
     */
    public function setExtra($extra)
    {
        $this->extra = $extra;
    }


}