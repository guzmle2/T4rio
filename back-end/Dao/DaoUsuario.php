<?php
/**
 * Created by PhpStorm.
 * User: DIAZ
 * Date: 07/06/2015
 * Time: 07:14 PM
 */

namespace Dao;
use Entidad\Usuario;
use IDao\IDaoUsuario;

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

    public function agrega_modifica(){
        $conexion = new Connect();
        $query = '';
        if($this->Usuario->getId() == null ){
            {
                if($this->Usuario->getNombre()  != null && $this->Usuario->getNombre() != '' &&
                $this->Usuario->getApellido()  != null && $this->Usuario->getNombre() != '' &&
                $this->Usuario->getCedula()  != null && $this->Usuario->getCedula() != '' &&
                $this->Usuario->getTipo()  != null && $this->Usuario->getTipo() != '' &&
                $this->Usuario->getCorreo()  != null && $this->Usuario->getCorreo() != '' &&
                $this->Usuario->getClave()  != null && $this->Usuario->getClave() != '')
                {
                    $consulta = $conexion->prepare('INSERT INTO ' . self::TABLA .'
                    (nombre, apellido,cedula,correo,tipo,clave)
                    VALUES(:nombre,:apellido,:cedula,:correo,:tipo,:clave)');
                    $consulta->bindParam(':nombre', $this->Usuario->getNombre());
                    $consulta->bindParam(':apellido', $this->Usuario->getApellido());
                    $consulta->bindParam(':cedula', $this->Usuario->getCedula());
                    $consulta->bindParam(':tipo', $this->Usuario->getTipo());
                    $consulta->bindParam(':correo', $this->Usuario->getCorreo());
                    $consulta->bindParam(':clave', $this->Usuario->getClave());
                    $consulta->execute();
                    $this->Usuario->setId($conexion->lastInsertId()) ;

                }else{
                    $this->Usuario = null ;
                }
            }


            }
        else{
            if ($this->Usuario->getNombre() != null)
            {
                if($query == ''){
                    $query .='nombre = :nombre';
                }else{
                    $query .=', nombre = :nombre';
                }
            }

            if ($this->Usuario->getApellido() != null)
            {
                if($query == ''){
                    $query .='apellido = :apellido';
                }else{
                    $query .=', apellido = :apellido';
                }
            }
            if($this->Usuario->getCedula() != null){
                if($query == ''){
                    $query .='cedula = :cedula';
                }else{
                    $query.=', cedula = :cedula';
                }

            }


            if( $this->Usuario->getCorreo() != null){
                if($query == ''){
                    $query .='correo = :correo';
                }else{
                    $query .=', correo = :correo';
                }
            }

            if( $this->Usuario->getTipo() != null){
                if($query == ''){
                    $query .='tipo = :tipo';
                }else{
                    $query .=', tipo = :tipo';
                }
            }


            if($this->Usuario->getClave() != null){
                if($query == ''){
                    $query .='clave = :clave';
                }else{
                    $query .=', clave = :clave';
                }

            }
            $consulta = $conexion->prepare('UPDATE ' . self::TABLA .' SET '.$query.
                ' WHERE id = :id');
            $consulta->bindParam(':nombre', $this->Usuario->getNombre());
            $consulta->bindParam(':apellido', $this->Usuario->getApellido());
            $consulta->bindParam(':cedula', $this->Usuario->getCedula());
            $consulta->bindParam(':tipo', $this->Usuario->getTipo());
            $consulta->bindParam(':correo', $this->Usuario->getCorreo());
            $consulta->bindParam(':clave', $this->Usuario->getClave());
            $consulta->bindParam(':id', $this->Usuario->getId());
            $consulta->execute();


        }
        $conexion = null;

        return $this->Usuario;
    }

    public function consultarPorId(){
        $conexion = new Connect();
        $consulta = $conexion->prepare('SELECT id,nombre,
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
            $this->Usuario->setApellido($registro['apellido']);
            $this->Usuario->setCedula($registro['cedula']);
            $this->Usuario->setCorreo($registro['correo']);
            $this->Usuario->setTipo($registro['tipo']);
            $this->Usuario->setClave($registro['clave']);
            $this->Usuario->setId($registro['id']);
        }else{
            $this->Usuario = null;
        }
        $conexion = null;
        return $this->Usuario;
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
            $this->Usuario->setNombre($registro['nombre']);
            $this->Usuario->setApellido($registro['apellido']);
            $this->Usuario->setCedula($registro['cedula']);
            $this->Usuario->setCorreo($registro['correo']);
            $this->Usuario->setTipo($registro['tipo']);
            $this->Usuario->setClave($registro['clave']);
            $this->Usuario->setId($registro['id']);

        } else {
            $this->Usuario = null;
        }
        $conexion = null;
        return $this->Usuario;
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
        $consulta->execute();
        $usuarios = $consulta->fetchAll();
        $conexion = null;
        return $usuarios;
    }

    public function eliminar()
    {
        $conexion = new Connect();
        try{
            $consulta = $conexion->prepare( 'DELETE FROM ' . self::TABLA .' WHERE id = :parametro');
            $consulta->bindParam(':parametro', $this->Usuario->getId());
            $consulta->execute();
            $conexion = null;

        }catch (Exception $e){
            $conexion = null;
            echo 'Ha surgido un error y no se puede conectar a la base de datos. Detalle: ' . $e->getMessage();
        }
    }

    public function consultarPorIdParametro($id)
    {
        $conexion = new Connect();
            $parametro = ' WHERE id = :parametro';
            $valor = $id;

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
            $Usuario = new Usuario();
            $Usuario->setNombre($registro['nombre']);
            $Usuario->setApellido($registro['apellido']);
            $Usuario->setCedula($registro['cedula']);
            $Usuario->setCorreo($registro['correo']);
            $Usuario->setTipo($registro['tipo']);
            $Usuario->setClave($registro['clave']);
            $Usuario->setId($registro['id']);

        } else {
            $Usuario = null;
        }
        $conexion = null;
        return $Usuario;
    }
}