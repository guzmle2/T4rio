<?php
/**
 * Created by PhpStorm.
 * User: DIAZ
 * Date: 24/07/2015
 * Time: 11:13 PM
 */
include_once 'C:\xampp\htdocs\T4rio\back-end\FabricaDao.php';
include_once 'C:\xampp\htdocs\T4rio\back-end\FabricaEntidad.php';
class DaoFacturaProducto {

    private $FacturaProducto;


    const STRING_SQL = ' ( id_factura, id_tipoProducto, cantidad, precioCompra, precioCantidad  )';

    const STRING_PARAMETROS = '( :id_factura, :id_tipoProducto, :cantidad, :precioCompra, :precioCantidad )';

    const STRING_MODIFICA = ' id_factura = :id_factura, id_tipoProducto = :id_tipoProducto, cantidad = :cantidad, precioCompra = :precioCompra, precioCantidad = :precioCantidad ';

    const TABLA = ' factura_producto ';


    function __construct(FacturaProducto $facturaProducto)
    {
        $this->FacturaProducto = $facturaProducto;
    }


    public function agregar()
    {
        $conexion = FabricaEntidad::Conexion();;
        if($this->objetoCompleto()){
            $consulta = $conexion->prepare('INSERT INTO ' . self::TABLA.self::STRING_SQL . ' VALUE ' . self::STRING_PARAMETROS);
            $consulta->bindParam(':id_factura', $this->FacturaProducto->getIdFactura());
            $consulta->bindParam(':id_tipoProducto', $this->FacturaProducto->getTipoProducto()->getId());
            $consulta->bindParam(':cantidad', $this->FacturaProducto->getCantidad());
            $consulta->bindParam(':precioCompra', $this->FacturaProducto->getPrecioCompra());
            $consulta->bindParam(':precioCantidad', $this->FacturaProducto->getPrecioCantidad());
            $consulta->execute();
            $this->FacturaProducto->setId( $conexion->lastInsertId() );
            $conexion = null;
            if($this->FacturaProducto->getId() != null && $this->FacturaProducto->getId() != 0){
                return $this->FacturaProducto;
            }else{
                return null;
            }
        }else{
            return null;
        }
    }

    public function modificar()
    {
        $conexion = FabricaEntidad::Conexion();;
        if($this->objetoCompleto() && $this->FacturaProducto->getId() != null &&  $this->FacturaProducto->getId() != 0 ){
            $consulta = $conexion->prepare('UPDATE ' . self::TABLA .' SET '.self::STRING_MODIFICA.' WHERE id = :id');

            $consulta->bindParam(':id_factura', $this->FacturaProducto->getIdFactura());
            $consulta->bindParam(':id_tipoProducto', $this->FacturaProducto->getTipoProducto()->getId());
            $consulta->bindParam(':cantidad', $this->FacturaProducto->getCantidad());
            $consulta->bindParam(':precioCompra', $this->FacturaProducto->getPrecioCompra());
            $consulta->bindParam(':precioCantidad', $this->FacturaProducto->getPrecioCantidad());
            $consulta->bindParam(':id', $this->FacturaProducto->getId());
            $consulta->execute();
            $conexion = null;
            if($this->FacturaProducto->getId() != null){
                return $this->FacturaProducto;
            }else{
                return null;
            }
        }else{
            return null;
        }
    }

    public function eliminar()
    {
        $conexion = FabricaEntidad::Conexion();;
        if($this->FacturaProducto->getId() != 0 && $this->FacturaProducto->getId() != null )
        {
            try{
                $consulta = $conexion->prepare( 'DELETE FROM ' . self::TABLA .' WHERE id = :parametro');
                $consulta->bindParam(':parametro', $this->FacturaProducto->getId());
                $resultado = $consulta->execute();
                $conexion = null;
                return $resultado;

            }catch (Exception $e){
                $conexion = null;
                return false;
            }
        }else{
            return false;
        }
    }


    public function eliminarXIdFactura($id)
    {
        $conexion = FabricaEntidad::Conexion();;
        if($id != 0 && $id != null )
        {
            try{
                $consulta = $conexion->prepare( 'DELETE FROM ' . self::TABLA .' WHERE id_factura = :parametro');
                $consulta->bindParam(':parametro', $id);
                $resultado = $consulta->execute();
                $conexion = null;
                return $resultado;

            }catch (Exception $e){
                $conexion = null;
                return false;
            }
        }else{
            return false;
        }
    }

    public function consultarXid()
    {
        $conexion = FabricaEntidad::Conexion();;
        if ( $this->FacturaProducto->getId() != null )
        {
            $consulta = $conexion->prepare('SELECT * FROM '. self::TABLA . ' WHERE id = :id');
            $consulta->bindParam(':id', $this->FacturaProducto->getId());
            $consulta->execute();
            $registro = $consulta->fetch();
            if($registro){
                $this->armarObjeto($registro);
            }else{
                $this->FacturaProducto = null;
            }
        }else{
            $this->FacturaProducto = null;
        }
        $conexion = null;
        return $this->FacturaProducto;
    }

    public function consultarXLogin()
    {
        $conexion = FabricaEntidad::Conexion();;
        if ( $this->FacturaProducto->getCorreo() != null )
        {
            $consulta = $conexion->prepare('SELECT * FROM '. self::TABLA . ' WHERE correo = :correo');
            $consulta->bindParam(':correo', $this->FacturaProducto->getCorreo());
            $consulta->execute();
            $registro = $consulta->fetch();
            if($registro){
                $this->armarObjeto($registro);
            }else{
                $this->FacturaProducto = null;
            }
        }else{
            $this->FacturaProducto = null;
        }
        $conexion = null;
        return $this->FacturaProducto;
    }

    public function obtenerTodos()
    {
        $conexion = FabricaEntidad::Conexion();;
        $consulta = $conexion->prepare('SELECT * FROM ' . self::TABLA );
        $consulta->execute();
        $Revisiones = $consulta->fetchAll();
        $conexion = null;
        $objetos = $this->armarListaObjetos($Revisiones);
        return $objetos;
    }

    public function obtenerTodoDesc()
    {
        $conexion = FabricaEntidad::Conexion();;
        $consulta = $conexion->prepare('SELECT * FROM ' . self::TABLA .' order by 1 desc ');
        $consulta->execute();
        $Revisiones = $consulta->fetchAll();
        $conexion = null;
        $objetos = $this->armarListaObjetos($Revisiones);
        return $objetos;
    }


    public function obtenerTodoAsc()
    {
        $conexion = FabricaEntidad::Conexion();;
        $consulta = $conexion->prepare('SELECT * FROM ' . self::TABLA );
        $consulta->execute();
        $Revisiones = $consulta->fetchAll();
        $conexion = null;
        $objetos = $this->armarListaObjetos($Revisiones);
        return $objetos;
    }


    public function consultarXParametro($parametro, $valor)
    {
        $conexion = FabricaEntidad::Conexion();;

        $consulta = $conexion->prepare('SELECT * FROM '. self::TABLA . ' WHERE '.$parametro.' = :id');
        $consulta->bindParam(':id', $valor);
        $consulta->execute();
        $registro = $consulta->fetch();
        if($registro){
            $this->armarObjeto($registro);
        }else{
            $this->FacturaProducto = null;
        }
        $conexion = null;
        return $this->FacturaProducto;

    }


    public function obtenerListaXParametro($parametro, $valor)
    {
        $conexion = FabricaEntidad::Conexion();;
        $consulta = $conexion->prepare('SELECT * FROM ' . self::TABLA .' WHERE '.$parametro.' = :id');
        $consulta->bindParam(':id', $valor);
        $consulta->execute();
        $Revisiones = $consulta->fetchAll();
        $conexion = null;
        $objetos = $this->armarListaObjetos($Revisiones);
        return $objetos;
    }


    public function productosFactura($numFactura)
    {
        $conexion = FabricaEntidad::Conexion();;
        $consulta = $conexion->prepare('SELECT * FROM ' . self::TABLA .' WHERE id_factura = :id');
        $consulta->bindParam(':id', $numFactura);
        $consulta->execute();
        $Revisiones = $consulta->fetchAll();
        $conexion = null;
        $objetos = $this->armarListaObjetos($Revisiones);
        return $objetos;
    }



    private function objetoCompleto()
    {
        if(($this->FacturaProducto->getIdFactura() != null && $this->FacturaProducto->getIdFactura() != '' )
            && ($this->FacturaProducto->getTipoProducto() != null && $this->FacturaProducto->getTipoProducto()->getId() != null )
            && ($this->FacturaProducto->getCantidad() != null && $this->FacturaProducto->getCantidad() != '' )
            && ($this->FacturaProducto->getPrecioCompra() != null && $this->FacturaProducto->getPrecioCompra() != '' )
            && ($this->FacturaProducto->getPrecioCantidad() != null && $this->FacturaProducto->getPrecioCantidad() != '' )  )
        {
            return true;
        }else{
            return false;
        }
    }


    private function objetoCompletoIndvidual(FacturaProducto $facturaProducto)
    {
        if(($facturaProducto->getIdFactura() != null && $facturaProducto->getIdFactura() != '' )
            && ($facturaProducto->getTipoProducto() != null && $facturaProducto->getTipoProducto()->getId() != null )
            && ($facturaProducto->getCantidad() != null && $facturaProducto->getCantidad() != '' )
            && ($facturaProducto->getPrecioCompra() != null && $facturaProducto->getPrecioCompra() != '' )
            && ($facturaProducto->getPrecioCantidad() != null && $facturaProducto->getPrecioCantidad() != '' )  )
        {
            return true;
        }else{
            return false;
        }
    }



    public function obtenerTipoProducto($id_tipoProducto){

        $TipoProducto = FabricaEntidad::TipoProducto();
        $TipoProducto->setId($id_tipoProducto);

        $dao = FabricaDao::DaoTipoProducto($TipoProducto);
        $TipoProducto = $dao->consultarXid();

        return $TipoProducto;

    }

    private function armarObjeto($registro)
    {
        $this->FacturaProducto->setId($registro['id']);
        $this->FacturaProducto->setTipoProducto($this->obtenerTipoProducto($registro['id_tipoProducto']));
        $this->FacturaProducto->setCantidad($registro['cantidad']);
        $this->FacturaProducto->setPrecioCompra($registro['precioCompra']);
        $this->FacturaProducto->setPrecioCantidad($registro['precioCantidad']);
    }

    private function armarListaObjetos($Revisiones)
    {
        $pila = array();
        for($i=0;$i<count($Revisiones);$i++){
            $objeto = FabricaEntidad::FacturaProducto();

            $objeto->setId($Revisiones[$i]['id']);
            $objeto->setTipoProducto($this->obtenerTipoProducto($Revisiones[$i]['id_tipoProducto']));
            $objeto->setCantidad($Revisiones[$i]['cantidad']);
            $objeto->setPrecioCompra($Revisiones[$i]['precioCompra']);
            $objeto->setPrecioCantidad($Revisiones[$i]['precioCantidad']);
            array_push($pila, $objeto);
        }

        return $pila;
    }

    public function obtenerProdcutos($IdFactura)
    {
        $conexion = FabricaEntidad::Conexion();;
        $consulta = $conexion->prepare('SELECT * FROM ' . self::TABLA .' WHERE id_factura = :id');
        $consulta->bindParam(':id', $IdFactura);
        $consulta->execute();
        $Revisiones = $consulta->fetchAll();
        $conexion = null;
        $objetos = $this->armarListaObjetos($Revisiones);
        return $objetos;
    }

    private function idValidoIdObjeto($objeto)
    {
        if($objeto != null){
            return $objeto->getId();
        }else{
            return null;
        }
    }

    public function cargarProductos($getProductos, $idFactura)
    {
        $collections = $getProductos;

        foreach ($collections as $factPr){
            $fact = FabricaEntidad::FacturaProducto();
            $fact = $factPr;
            $fact->setIdFactura($idFactura);
           $resultado = $this->agregarFactProd($fact);
            if($resultado == null){
                return null;
            }
        }
        return true;
    }

    public function modificarProductos($getProductos)
    {
        $collections = $getProductos;

        foreach ($collections as $factPr){
            $resultado = $this->modificarProducto($factPr);
            if($resultado == null){
                return null;
            }
        }
        return true;
    }


    public function agregarFactProd(FacturaProducto $facturaProducto)
    {
        $conexion = FabricaEntidad::Conexion();;
        if($this->objetoCompletoIndvidual($facturaProducto)){
            $consulta = $conexion->prepare('INSERT INTO ' . self::TABLA.self::STRING_SQL . ' VALUE ' . self::STRING_PARAMETROS);
            $consulta->bindParam(':id_factura', $facturaProducto->getIdFactura());
            $consulta->bindParam(':id_tipoProducto', $facturaProducto->getTipoProducto()->getId());
            $consulta->bindParam(':cantidad', $facturaProducto->getCantidad());
            $consulta->bindParam(':precioCompra', $facturaProducto->getPrecioCompra());
            $consulta->bindParam(':precioCantidad', $facturaProducto->getPrecioCantidad());
            $consulta->execute();
            $facturaProducto->setId( $conexion->lastInsertId() );
            $conexion = null;
            if($facturaProducto->getId() != null && $facturaProducto->getId() != 0){
                return $this->FacturaProducto;
            }else{
                return null;
            }
        }else{
            return null;
        }
    }


    public function modificarProducto(FacturaProducto $facturaProducto)
    {
        $conexion = FabricaEntidad::Conexion();



        if($this->objetoCompletoIndvidual($facturaProducto) && $facturaProducto->getId() != null &&  $facturaProducto->getId() != 0 ){
            $consulta = $conexion->prepare('UPDATE ' . self::TABLA .' SET '.self::STRING_MODIFICA.' WHERE id = :id');

            $consulta->bindParam(':id_factura', $facturaProducto->getIdFactura());
            $consulta->bindParam(':id_tipoProducto', $facturaProducto->getTipoProducto()->getId());
            $consulta->bindParam(':cantidad', $facturaProducto->getCantidad());
            $consulta->bindParam(':precioCompra', $facturaProducto->getPrecioCompra());
            $consulta->bindParam(':precioCantidad', $facturaProducto->getPrecioCantidad());
            $consulta->bindParam(':id', $facturaProducto->getId());
            $consulta->execute();
            $conexion = null;
            if($facturaProducto->getId() != null){
                return $facturaProducto;
            }else{
                return null;
            }
        }else{
            return null;
        }
    }

    public function eliminarProductos($idfacturaProducto)
    {
        $conexion = FabricaEntidad::Conexion();;
        if($this->FacturaProducto->getId() != 0 && $this->FacturaProducto->getId() != null )
        {
            try{
                $consulta = $conexion->prepare( 'DELETE FROM ' . self::TABLA .' WHERE id_factura = :parametro');
                $consulta->bindParam(':parametro',$idfacturaProducto);
                $resultado = $consulta->execute();
                $conexion = null;
                return $resultado;

            }catch (Exception $e){
                $conexion = null;
                return false;
            }
        }else{
            return false;
        }
    }
}