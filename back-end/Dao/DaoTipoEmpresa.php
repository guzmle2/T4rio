<?php
/**
 * Created by PhpStorm.
 * User: DIAZ
 * Date: 24/07/2015
 * Time: 11:14 PM
 */
include_once 'C:\xampp\htdocs\T4rio\back-end\FabricaDao.php';
include_once 'C:\xampp\htdocs\T4rio\back-end\FabricaEntidad.php';
class DaoTipoEmpresa {

    private $TipoEmpresa;


    const TABLA = 'tipo_empresa';
    const STRING_SQL = ' ( nombre )';
    const STRING_PARAMETROS = '( :nombre )';

    function __construct( TipoEmpresa $tipoEmpresa)
    {
        $this->TipoEmpresa = $tipoEmpresa;
    }



    public function agregar()
    {
        $conexion = FabricaEntidad::Conexion();;
        if($this->TipoEmpresaCompleta()){
            $consulta = $conexion->prepare('INSERT INTO ' . self::TABLA.self::STRING_SQL . ' VALUES ' . self::STRING_PARAMETROS);
            $consulta->bindParam(':nombre', $this->TipoEmpresa->getNombre());
            $consulta->execute();
            $this->TipoEmpresa->setId( $conexion->lastInsertId() );
            $conexion = null;
            if($this->TipoEmpresa->getId() != null){
                return $this->TipoEmpresa;
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
        if($this->TipoEmpresaCompleta() && $this->TipoEmpresa->getId() != null &&  $this->TipoEmpresa->getId() != 0 ){
            $consulta = $conexion->prepare('UPDATE ' . self::TABLA .' SET ( nomre = :nombre ) WHERE id = :id');
            $consulta->bindParam(':nombre', $this->TipoEmpresa->getNombre());
            $consulta->bindParam(':id', $this->TipoEmpresa->getId());
            $consulta->execute();
            $conexion = null;
            if($this->TipoEmpresa->getId() != null){
                return $this->TipoEmpresa;
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
        if($this->TipoEmpresa->getId() != 0 && $this->TipoEmpresa->getId() != null )
        {
            try{
                $consulta = $conexion->prepare( 'DELETE FROM ' . self::TABLA .' WHERE id = :parametro');
                $consulta->bindParam(':parametro', $this->TipoEmpresa->getId());
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
        if ( $this->TipoEmpresa->getId() != null )
        {
            $consulta = $conexion->prepare('SELECT * FROM '. self::TABLA . ' WHERE id = :id');
            $consulta->bindParam(':id', $this->TipoEmpresa->getId());
            $consulta->execute();
            $registro = $consulta->fetch();
            if($registro){
                $this->armarTipoEmpresa($registro);
            }else{
                $this->TipoEmpresa = null;
            }
        }else{
            $this->TipoEmpresa = null;
        }
        $conexion = null;
        return $this->TipoEmpresa;
    }

    public function obtenerTodos()
    {
        $conexion = FabricaEntidad::Conexion();;
        $consulta = $conexion->prepare('SELECT * FROM ' . self::TABLA );
        $consulta->execute();
        $Revisiones = $consulta->fetchAll();
        $conexion = null;
        $TipoEmpresas = $this->armarTipoEmpresas($Revisiones);
        return $TipoEmpresas;
    }

    public function consultarXNombre()
    {
        $conexion = FabricaEntidad::Conexion();;
        if ( $this->TipoEmpresa->getNombre() != null && $this->TipoEmpresa->getNombre() != '' )
        {
            $consulta = $conexion->prepare('SELECT * FROM '. self::TABLA . ' WHERE nombre = :id');
            $consulta->bindParam(':id', $this->TipoEmpresa->getNombre());
            $consulta->execute();
            $registro = $consulta->fetch();
            if($registro){
                $this->armarTipoEmpresa($registro);
            }else{
                $this->TipoEmpresa = null;
            }
        }else{
            $this->TipoEmpresa = null;
        }
        $conexion = null;
        return $this->TipoEmpresa;

    }



    private function TipoEmpresaCompleta()
    {
        if($this->TipoEmpresa->getNombre() != null && $this->TipoEmpresa->getNombre() != '' )
        {
            return true;
        }else{
            return false;
        }
    }

    private function armarTipoEmpresa($registro)
    {
        $this->TipoEmpresa->setId($registro['id']);
        $this->TipoEmpresa->setNombre($registro['nombre']);
    }

    private function armarTipoEmpresas($Revisiones)
    {
        $pila = array();
        for($i=0;$i<count($Revisiones);$i++){
            $TipoEmpresa = FabricaEntidad::TipoEmpresa();

            $TipoEmpresa->setId($Revisiones[$i]['id']);
            $TipoEmpresa->setNombre($Revisiones[$i]['nombre']);

            array_push($pila, $TipoEmpresa);
        }

        return $pila;
    }
}