<?php
/**
 * Created by PhpStorm.
 * User: DIAZ
 * Date: 07/06/2015
 * Time: 07:14 PM
 */

require_once 'Connect.php';

class DaoUsuario {

    var $Objeto;
    const TABLA = 'usuario';

    public function __construct(&$objeto)
    {
        $this->Objeto =& $objeto;
    }

    public function agregar(){
        $conexion = new Connect();
        try{
            $consulta = $conexion->prepare('INSERT INTO ' . self::TABLA .'
             (nombre,
             apellido,
             cedula,
             correo,
             tipo,clave)
             VALUES
             (:nombre,
              :apellido,
              :cedula,
              :correo,
              :tipo,
              :clave)');
            $consulta->bindParam(':nombre', $this->Objeto->getNombre());
            $consulta->bindParam(':apellido', $this->Objeto->getApellido());
            $consulta->bindParam(':cedula', $this->Objeto->getCedula());
            $consulta->bindParam(':tipo', $this->Objeto->getTipo());
            $consulta->bindParam(':correo', $this->Objeto->getCorreo());
            $consulta->bindParam(':clave', $this->Objeto->getClave());
            $consulta->execute();
            $this->Objeto->setId($conexion->lastInsertId()) ;
            $conexion = null;

        }catch (Exception $e){
            echo 'Ha surgido un error y no se puede conectar a la base de datos. Detalle: ' . $e->getMessage();
        }

    }

    public function modificar(){
        $conexion = new Connect();
        $consulta = $conexion->prepare('UPDATE ' . self::TABLA .' SET
            nombre = :nombre,
            apellido = :apellido,
            cedula = :cedula,
            correo = :correo,
            tipo = :tipo,
            clave = :clave
            WHERE id = :id');
        $consulta->bindParam(':nombre', $this->Objeto->getNombre());
        $consulta->bindParam(':apellido',$this->Objeto->getApellido());
        $consulta->bindParam(':cedula', $this->Objeto->getCedula());
        $consulta->bindParam(':clave', $this->Objeto->getClave());
        $consulta->bindParam(':tipo', $this->Objeto->getTipo());
        $consulta->bindParam(':correo', $this->Objeto->getCorreo());
        $consulta->bindParam(':correo', $this->Objeto->getId());
        $consulta->execute();
        $this->id = $conexion->lastInsertId();
        $conexion = null;
    }

    public function consultarPorId(){
        $conexion = new Connect();
        $consulta = $conexion->prepare('SELECT nombre,
                                                apellido,
                                                cedula,
                                                tipo,
                                                correo,
                                                clave
                                                FROM ' . self::TABLA . ' WHERE id = :id');
        $consulta->bindParam(':id', $this->Objeto->getId());
        $consulta->execute();
        $registro = $consulta->fetch();
        if($registro){
            return new self($registro['nombre'],
                $registro['apellido'],
                $registro['cedula'],
                $registro['tipo'],
                $registro['correo'],
                $registro['clave'],
                $this->Objeto->getId());
        }else{
            return false;
        }
    }

    public function consultarPorParametro(){

    }

}