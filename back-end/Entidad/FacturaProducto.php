<?php
/**
 * Created by PhpStorm.
 * User: DIAZ
 * Date: 24/07/2015
 * Time: 09:51 PM
 */

include_once 'EntidadBase.php';
include_once 'C:\xampp\htdocs\T4rio\back-end\FabricaEntidad.php';
class FacturaProducto extends EntidadBase {

    private $IdFactura;
    private $TipoProducto;
    private $cantidad;
    private $precioCompra;
    private $precioCantidad;

    function __construct()
    {
        $this->TipoProducto = FabricaEntidad::TipoProducto();
    }

    /**
     * @return mixed
     */
    public function getIdFactura()
    {
        return $this->IdFactura;
    }

    /**
     * @param mixed $IdFactura
     */
    public function setIdFactura($IdFactura)
    {
        $this->IdFactura = $IdFactura;
    }

    /**
     * @return mixed
     */
    public function getTipoProducto()
    {
        return $this->TipoProducto;
    }

    /**
     * @param mixed $TipoProducto
     */
    public function setTipoProducto(TipoProducto $TipoProducto)
    {
        $this->TipoProducto = $TipoProducto;
    }

    /**
     * @return mixed
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * @param mixed $cantidad
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    }

    /**
     * @return mixed
     */
    public function getPrecioCompra()
    {
        return $this->precioCompra;
    }

    /**
     * @param mixed $precioCompra
     */
    public function setPrecioCompra($precioCompra)
    {
        $this->precioCompra = $precioCompra;
    }

    /**
     * @return mixed
     */
    public function getPrecioCantidad()
    {
        return $this->precioCantidad;
    }

    /**
     * @param mixed $precioCantidad
     */
    public function setPrecioCantidad($precioCantidad)
    {
        $this->precioCantidad = $precioCantidad;
    }


    function __toString()
    {
        return ('FacturaProducto: '.$this->getId().', '.
            $this->getIdFactura().', '.
            $this->getTipoProducto().', '.
            $this->getCantidad().', '.
            $this->getPrecioCompra().', '.
            $this->getPrecioCantidad());
    }




}