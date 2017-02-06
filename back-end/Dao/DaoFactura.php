<?php
/**
 * Created by PhpStorm.
 * User: DIAZ
 * Date: 24/07/2015
 * Time: 11:13 PM
 */


include_once 'C:\xampp\htdocs\T4rio\back-end\FabricaDao.php';
include_once 'C:\xampp\htdocs\T4rio\back-end\FabricaEntidad.php';

class DaoFactura {

    private $Factura;

    const STRING_SQL = ' ( id_usuario, id_empresa, fechaCreacion, precioTotal, informacion, estatus, extra )';

    const STRING_PARAMETROS = '( :id_usuario, :id_empresa, :fechaCreacion, :precioTotal, :informacion, :estatus, :extra )';

    const STRING_MODIFICA = ' id_usuario = :id_usuario,
    id_empresa = :id_empresa,
    fechaCreacion = :fechaCreacion,
    precioTotal = :precioTotal,
    informacion = :informacion,
    estatus = :estatus,
    extra = :extra ';

    const TABLA = ' factura ';

    function __construct(Factura $factura)
    {
        $this->Factura = $factura;
    }
   

    public function agregar()
    {
        $conexion = FabricaEntidad::Conexion();;
        if($this->objetoCompleto()){
            $consulta = $conexion->prepare('INSERT INTO ' . self::TABLA.self::STRING_SQL . ' VALUE ' . self::STRING_PARAMETROS);
            $consulta->bindParam(':id_usuario', $this->Factura->getCreador()->getId());
            $consulta->bindParam(':id_empresa', $this->Factura->getTipoEmpresa()->getId());
            $consulta->bindParam(':fechaCreacion', $this->Factura->getFechaCreacion());
            $consulta->bindParam(':precioTotal', $this->Factura->getPrecioTotal());
            $consulta->bindParam(':informacion', $this->Factura->getInformacion());
            $consulta->bindParam(':extra', $this->Factura->getExtra());
            $consulta->bindParam(':estatus', $this->Factura->getEstatus());
            $consulta->execute();
            $this->Factura->setId( $conexion->lastInsertId() );
            $conexion = null;
            if($this->Factura->getId() != null && $this->Factura->getId() != 0){

                $dao = FabricaDao::DaoFacturaProducto(FabricaEntidad::FacturaProducto());
                $resultado = $dao->cargarProductos($this->Factura->getProductos(), $this->Factura->getId());
                if($resultado == null)
                {
                    return null;
                }

                return $this->Factura;
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
        if($this->objetoCompleto() && $this->Factura->getId() != null &&  $this->Factura->getId() != 0 ){
            $consulta = $conexion->prepare('UPDATE ' . self::TABLA .' SET '.self::STRING_MODIFICA.' WHERE id = :id');
            $consulta->bindParam(':id_usuario', $this->Factura->getCreador()->getId());
            $consulta->bindParam(':id_empresa', $this->Factura->getTipoEmpresa()->getId());
            $consulta->bindParam(':fechaCreacion', $this->Factura->getFechaCreacion());
            $consulta->bindParam(':precioTotal', $this->Factura->getPrecioTotal());
            $consulta->bindParam(':informacion', $this->Factura->getInformacion());
            $consulta->bindParam(':estatus', $this->Factura->getEstatus());
            $consulta->bindParam(':extra', $this->Factura->getExtra());
            $consulta->bindParam(':id', $this->Factura->getId());
            $consulta->execute();
            $conexion = null;
            if($this->Factura->getId() != null){
                $dao = FabricaDao::DaoFacturaProducto(FabricaEntidad::FacturaProducto());
                $dao->eliminarXIdFactura($this->Factura->getId());
                $resultado = $dao->cargarProductos($this->Factura->getProductos(), $this->Factura->getId());
                if($resultado == null)
                {
                    return null;
                }
                return $this->Factura;
            }else{
                return null;
            }
        }else{
            return null;
        }
    }

    public function eliminar()
    {

        if($this->Factura->getId() != 0 && $this->Factura->getId() != null )
        {
            try{
                $dao = FabricaDao::DaoFacturaProducto(FabricaEntidad::FacturaProducto());
                $dao->eliminarProductos( $this->Factura->getId());
                $conexion = FabricaEntidad::Conexion();
                $consulta = $conexion->prepare( 'DELETE FROM ' . self::TABLA .' WHERE id = :parametro');
                $consulta->bindParam(':parametro', $this->Factura->getId());
                $resultado = $consulta->execute();

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
        if ( $this->Factura->getId() != null )
        {
            $consulta = $conexion->prepare('SELECT * FROM '. self::TABLA . ' WHERE id = :id');
            $consulta->bindParam(':id', $this->Factura->getId());
            $consulta->execute();
            $registro = $consulta->fetch();
            if($registro){
                $this->armarObjeto($registro);
            }else{
                $this->Factura = null;
            }
        }else{
            $this->Factura = null;
        }
        $conexion = null;
        return $this->Factura;
    }

    public function consultarXEmpresa()
    {
        $conexion = FabricaEntidad::Conexion();;
        if ( $this->Factura->getTipoEmpresa() != null && $this->Factura->getTipoEmpresa()->getId() != 0 )
        {
            $consulta = $conexion->prepare('SELECT * FROM '. self::TABLA . ' WHERE id_empresa = :id_empresa');
            $consulta->bindParam(':id_empresa', $this->Factura->getTipoEmpresa()->getId());
            $consulta->execute();
            $registro = $consulta->fetch();
            if($registro){
                $this->armarObjeto($registro);
            }else{
                $this->Factura = null;
            }
        }else{
            $this->Factura = null;
        }
        $conexion = null;
        return $this->Factura;
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
            $this->Factura = null;
        }
        $conexion = null;
        return $this->Factura;

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


    public function productosFactura($IdFactura)
    {
        $dao = FabricaDao::DaoFacturaProducto(FabricaEntidad::FacturaProducto());
        $resultado = $dao->obtenerProdcutos($IdFactura);
        return $resultado;
    }



    private function objetoCompleto()
    {
        if(($this->Factura->getCreador() != null && $this->Factura->getCreador()->getId() != null )
            && ($this->Factura->getTipoEmpresa() != null && $this->Factura->getTipoEmpresa()->getId() != null )
            && ($this->Factura->getFechaCreacion() != null && $this->Factura->getFechaCreacion() != '' )
            && ($this->Factura->getPrecioTotal() != null && $this->Factura->getPrecioTotal() != '' )
            && ($this->Factura->getInformacion() != null && $this->Factura->getInformacion() != '' )
            && ($this->Factura->getEstatus() != null && $this->Factura->getEstatus() != '' )  )
        {
            return true;
        }else{
            return false;
        }
    }



    private function armarObjeto($registro)
    {
        $this->Factura->setId($registro['id']);
        $this->Factura->setCreador($this->obtenerUsuarioCreador($registro['id_usuario']));
        $this->Factura->setTipoEmpresa($this->obtenerEmpresa($registro['id_empresa']));
        $this->Factura->setFechaCreacion($registro['fechaCreacion']);
        $this->Factura->setPrecioTotal($registro['precioTotal']);
        $this->Factura->setInformacion($registro['informacion']);
        $this->Factura->setEstatus($registro['estatus']);
        $this->Factura->setExtra($registro['extra']);
        $this->Factura->setProductos($this->productosFactura($registro['id']));
    }

    private function armarListaObjetos($Revisiones)
    {
        $pila = array();
        for($i=0;$i<count($Revisiones);$i++){
            $objeto = FabricaEntidad::Factura();

            $objeto->setId($Revisiones[$i]['id']);
            $objeto->setCreador($this->obtenerUsuarioCreador($Revisiones[$i]['id_usuario']));
            $objeto->setTipoEmpresa($this->obtenerEmpresa($Revisiones[$i]['id_empresa']));
            $objeto->setFechaCreacion($Revisiones[$i]['fechaCreacion']);
            $objeto->setPrecioTotal($Revisiones[$i]['precioTotal']);
            $objeto->setInformacion($Revisiones[$i]['informacion']);
            $objeto->setEstatus($Revisiones[$i]['estatus']);
            $objeto->setProductos($this->productosFactura($Revisiones[$i]['id']));
            $objeto->setExtra($Revisiones[$i]['extra']);

            array_push($pila, $objeto);
        }

        return $pila;
    }

    public function obtenerPorEditar($Idusuario)
    {
        $poreditar = "POREDITAR";
        $conexion = FabricaEntidad::Conexion();;
        $consulta = $conexion->prepare('SELECT * FROM ' . self::TABLA. ' where id_usuario = :id_usuario and estatus = :estatus   '  );
        $consulta->bindParam(':id_usuario', $Idusuario);
        $consulta->bindParam(':estatus', $poreditar);
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

    private function obtenerUsuarioCreador($idCreador)
    {
        $usuario = FabricaEntidad::Usuario();
        $usuario->setId($idCreador);
        $dao = FabricaDao::DaoUsuario($usuario);
        $creador = $dao->consultarXid();
        return $creador;
    }

    private function obtenerEmpresa($idEmpresa)
    {
        $empresa = FabricaEntidad::TipoEmpresa();
        $empresa->setId($idEmpresa);
        $dao = FabricaDao::DaoTipoEmpresa($empresa);
        $empresa = $dao->consultarXid();
        return $empresa;
    }


    public function editarOrden($estatus,$extra, $idOrden)
    {
        $conexion = FabricaEntidad::Conexion();
        $consulta = $conexion->prepare('UPDATE ' . self::TABLA .' SET estatus = :estatus, extra = :extra WHERE id = :id');

        $consulta->bindParam(':extra', $extra);
        $consulta->bindParam(':estatus', $estatus);
        $consulta->bindParam(':id', $idOrden);
        $consulta->execute();
        $conexion = null;

    }

}