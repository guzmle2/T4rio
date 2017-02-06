<?php
/**
 * Created by PhpStorm.
 * User: DIAZ
 * Date: 24/07/2015
 * Time: 11:14 PM
 */

include_once 'C:\xampp\htdocs\T4rio\back-end\FabricaDao.php';
include_once 'C:\xampp\htdocs\T4rio\back-end\FabricaEntidad.php';
class DaoTipoProducto {

    private $TipoProducto;

    const STRING_SQL = ' ( nombre, precioActual, estado )';

    const STRING_PARAMETROS = '( :nombre, :precioActual, :estado  )';

    const STRING_MODIFICA = ' nombre = :nombre, precioActual = :precioActual, estado = :estado ';

    const TABLA = ' tipo_producto ';


    function __construct( TipoProducto $tipoProducto)
    {
        $this->TipoProducto = $tipoProducto;
    }


    public function agregar()
    {
        $conexion = FabricaEntidad::Conexion();;
        if($this->objetoCompleto()){
            $consulta = $conexion->prepare('INSERT INTO ' . self::TABLA.self::STRING_SQL . ' VALUE ' . self::STRING_PARAMETROS);
            $consulta->bindParam(':nombre', $this->TipoProducto->getNombre());
            $consulta->bindParam(':precioActual', $this->TipoProducto->getPrecioActual());
            $consulta->bindParam(':estado', $this->TipoProducto->getEstado());
            $consulta->execute();
            $this->TipoProducto->setId( $conexion->lastInsertId() );
            $conexion = null;
            if($this->TipoProducto->getId() != null && $this->TipoProducto->getId() != 0){
                return $this->TipoProducto;
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
        if($this->objetoCompleto() && $this->TipoProducto->getId() != null &&  $this->TipoProducto->getId() != 0 ){
            $consulta = $conexion->prepare('UPDATE ' . self::TABLA .' SET '.self::STRING_MODIFICA.' WHERE id = :id');

            $consulta->bindParam(':nombre', $this->TipoProducto->getNombre());
            $consulta->bindParam(':precioActual', $this->TipoProducto->getPrecioActual());
            $consulta->bindParam(':estado', $this->TipoProducto->getEstado());
            $consulta->bindParam(':id', $this->TipoProducto->getId());
            $consulta->execute();
            $conexion = null;
            if($this->TipoProducto->getId() != null){
                return $this->TipoProducto;
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
        if($this->TipoProducto->getId() != 0 && $this->TipoProducto->getId() != null )
        {
            try{
                $consulta = $conexion->prepare( 'DELETE FROM ' . self::TABLA .' WHERE id = :parametro');
                $consulta->bindParam(':parametro', $this->TipoProducto->getId());
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
        if ( $this->TipoProducto->getId() != null )
        {
            $consulta = $conexion->prepare('SELECT * FROM '. self::TABLA . ' WHERE id = :id');
            $consulta->bindParam(':id', $this->TipoProducto->getId());
            $consulta->execute();
            $registro = $consulta->fetch();
            if($registro){
                $this->armarObjeto($registro);
            }else{
                $this->TipoProducto = null;
            }
        }else{
            $this->TipoProducto = null;
        }
        $conexion = null;
        return $this->TipoProducto;
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
            $this->TipoProducto = null;
        }
        $conexion = null;
        return $this->TipoProducto;

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



    private function objetoCompleto()
    {
        if(($this->TipoProducto->getNombre() != null && $this->TipoProducto->getNombre() != null )
            && ($this->TipoProducto->getPrecioActual() != null && $this->TipoProducto->getPrecioActual() != '' )
            && ($this->TipoProducto->getEstado() != null && $this->TipoProducto->getEstado() != '' )  )
        {
            return true;
        }else{
            return false;
        }
    }




    private function armarObjeto($registro)
    {
        $this->TipoProducto->setId($registro['id']);
        $this->TipoProducto->setNombre($registro['nombre']);
        $this->TipoProducto->setPrecioActual($registro['precioActual']);
        $this->TipoProducto->setEstado($registro['estado']);
    }

    private function armarListaObjetos($Revisiones)
    {
        $pila = array();
        for($i=0;$i<count($Revisiones);$i++){
            $objeto = FabricaEntidad::TipoProducto();

            $objeto->setId($Revisiones[$i]['id']);
            $objeto->setNombre($Revisiones[$i]['nombre']);
            $objeto->setPrecioActual($Revisiones[$i]['precioActual']);
            $objeto->setEstado($Revisiones[$i]['estado']);

            array_push($pila, $objeto);
        }

        return $pila;
    }

    private function idValidoIdObjeto($objeto)
    {
        if($objeto != null){
            return $objeto->getId();
        }else{
            return null;
        }
    }

}