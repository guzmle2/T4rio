<?php
/**
 * Created by PhpStorm.
 * User: DIAZ
 * Date: 07/06/2015
 * Time: 07:14 PM
 */

namespace Dao;
use Dao\Connect;
use Entidad\Usuario;
use IDao\IDaoBase;

require_once 'Connect.php';
require_once '../Contrato/IDaoUsuario.php';

class DaoUsuario implements IDaoUsuario
{

    var $Usuario;
    const TABLA = 'usuario';

    public function __construct(&$Usuario)
    {
        $this->Usuario =& $Usuario;
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
            $consulta->bindParam(':nombre', $this->Usuario->getNombre());
            $consulta->bindParam(':apellido', $this->Usuario->getApellido());
            $consulta->bindParam(':cedula', $this->Usuario->getCedula());
            $consulta->bindParam(':tipo', $this->Usuario->getTipo());
            $consulta->bindParam(':correo', $this->Usuario->getCorreo());
            $consulta->bindParam(':clave', $this->Usuario->getClave());
            $consulta->execute();
            $this->Usuario->setId($conexion->lastInsertId()) ;
            $conexion = null;

        }catch (Exception $e){
            echo 'Ha surgido un error y no se puede conectar a la base de datos. Detalle: ' . $e->getMessage();
        }

    }

    public function modificar($id){
        $conexion = new Connect();
        if ($this->Usuario->getNombre() != null)
        {
            $consulta = $conexion->prepare('UPDATE ' . self::TABLA .' SET
            nombre = :nombre
            WHERE id = :id');
            $consulta->bindParam(':nombre', $this->Usuario->getNombre());
            $consulta->bindParam(':id', $id);
            $consulta->execute();
        }

        if ($this->Usuario->getApellido() != null)
        {
            $consulta = $conexion->prepare('UPDATE ' . self::TABLA .' SET
            apellido = :apellido
            WHERE id = :id');
            $consulta->bindParam(':apellido',$this->Usuario->getApellido());
            $consulta->bindParam(':id', $id);
            $consulta->execute();

        }
        if($this->Usuario->getCedula() != null){
            $consulta = $conexion->prepare('UPDATE ' . self::TABLA .' SET
            cedula = :cedula
            WHERE id = :id');
            $consulta->bindParam(':cedula', $this->Usuario->getCedula());
            $consulta->bindParam(':id', $id);
            $consulta->execute();

        }
        if($this->Usuario->getClave() != null){
            $consulta = $conexion->prepare('UPDATE ' . self::TABLA .' SET
            clave = :clave
            WHERE id = :id');
            $consulta->bindParam(':clave', $this->Usuario->getClave());
            $consulta->bindParam(':id', $id);
            $consulta->execute();

        }
        if( $this->Usuario->getTipo() != null){
            $consulta = $conexion->prepare('UPDATE ' . self::TABLA .' SET
            tipo = :tipo
            WHERE id = :id');
            $consulta->bindParam(':tipo', $this->Usuario->getTipo());
            $consulta->bindParam(':id', $id);
            $consulta->execute();
        }
        if( $this->Usuario->getCorreo() != null){
            $consulta = $conexion->prepare('UPDATE ' . self::TABLA .' SET
            correo = :correo
            WHERE id = :id');
            $consulta->bindParam(':correo', $this->Usuario->getCorreo());
            $consulta->bindParam(':id', $id);
            $consulta->execute();
        }

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
        $consulta->bindParam(':id', $this->Usuario->getId());
        $consulta->execute();
        $registro = $consulta->fetch();
        if($registro){
            $this->Usuario->setNombre($registro['nombre']);
            $this->Usuario->setApellido($registro['nombre']);
            $this->Usuario->setCedula($registro['nombre']);
            $this->Usuario->setCorreo($registro['nombre']);
            $this->Usuario->setTipo($registro['nombre']);
            $this->Usuario->setClave($registro['nombre']);
        }else{
            return false;
        }
    }

    public function consultarPorParametro()
    {
        $conexion = new Connect();
        if ($this->Usuario->getId() != null) {
            $parametro = ' WHERE id = :parametro';
            $valor = $this->Usuario->getId();
        } elseif ($this->Usuario->getNombre() != null) {
            $parametro = ' WHERE nombre = :parametro';
            $valor = $this->Usuario->getNombre();
        } elseif ($this->Usuario->getApellido() != null) {
            $parametro = ' WHERE apellido = :parametro';
            $valor = $this->Usuario->getApellido();
        } elseif ($this->Usuario->getCedula() != null) {
            $parametro = ' WHERE cedula = :parametro';
            $valor = $this->Usuario->getCedula();
        } elseif ($this->Usuario->getTipo() != null) {
            $parametro = ' WHERE tipo = :parametro';
            $valor = $this->Usuario->getTipo();
        } elseif ($this->Usuario->getCorreo() != null) {
            $parametro = ' WHERE correo = :parametro';
            $valor = $this->Usuario->getCorreo();
        } else {
            $parametro = ' WHERE id = :parametro';
            $valor = 0;
        }
        $consulta = $conexion->prepare('SELECT id,
                                                nombre,
                                                apellido,
                                                cedula,
                                                tipo,
                                                correo,
                                                clave
                                                FROM ' . self::TABLA . $parametro);
        $consulta->bindParam(':parametro', $valor);
        $consulta->execute();
        $registro = $consulta->fetch();
        if ($registro) {
            return new self($registro['nombre'],
                $registro['apellido'],
                $registro['cedula'],
                $registro['tipo'],
                $registro['correo'],
                $registro['clave'],
                $this->Usuario->getId());
        } else {
            return false;
        }
    }

    public function consultarTodos()
    {
        $conexion = new Connect();

        $consulta = $conexion->prepare('SELECT id,
                                                nombre,
                                                apellido,
                                                cedula,
                                                tipo,
                                                correo,
                                                clave
                                                FROM ' . self::TABLA );
        $consulta->bindParam(':parametro', $valor);
        $consulta->execute();
        $registros = $consulta->fetchAll();
        return $registros;
    }
}