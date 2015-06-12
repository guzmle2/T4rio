<?php
/**
 * Created by PhpStorm.
 * User: LEONORBANCO
 * Date: 11/06/2015
 * Time: 06:30 PM
 */

namespace Entidad;

use EntidadBase;

require_once 'EntidadBase.php';
class FacturaUEProducto extends EntidadBase{

    /**
     * @var FacturaUEmpresa
     */
    var $FacturaUEmpresa;

    /**
     * @var Producto
     */
    var $Producto;

    /**
     * @var $cantidad
     */
    var $cantidad;

    /**
     * @var $precioCompra
     */
    var $precioCompra;

    /**
     * @var $precioXCantidad
     */
    var $precioXCantidad;

    /**
     * Constructor de la clase
     */
    function __construct(){ }

    /**
     * @return FacturaUEmpresa
     */
    public function getFacturaUEmpresa()
    {
        return $this->FacturaUEmpresa;
    }

    /**
     * @param FacturaUEmpresa $FacturaUEmpresa
     */
    public function setFacturaUEmpresa(&$FacturaUEmpresa)
    {
        $this->FacturaUEmpresa =& $FacturaUEmpresa;
    }

    /**
     * @return Producto
     */
    public function getProducto()
    {
        return $this->Producto;
    }

    /**
     * @param Producto $Producto
     */
    public function setProducto(&$Producto)
    {
        $this->Producto =& $Producto;
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
    public function getPrecioXCantidad()
    {
        return $this->precioXCantidad;
    }

    /**
     * @param mixed $precioXCantidad
     */
    public function setPrecioXCantidad($precioXCantidad)
    {
        $this->precioXCantidad = $precioXCantidad;
    }


}