<?php
/**
 * Created by PhpStorm.
 * User: LEONORBANCO
 * Date: 11/06/2015
 * Time: 06:21 PM
 */

namespace Dao;

use Entidad\Empresa;
use IDao\IDaoEmpresa;

require_once 'Connect.php';
require_once '../Contrato/IDaoEmpresa.php';

class DaoEmpresa implements IDaoEmpresa {

    var $Empresa;
    const TABLA = 'empresa';

    public function __construct(&$Empresa)
    {
        $this->Empresa =& $Empresa;
    }

    public function agrega_modifica()
    {
        $conexion = new Connect();
        $query = '';

        if($this->Empresa->getId() == null  )
        {
            if( $this->Empresa->getNombre() != null && $this->Empresa->getNombre() != '' &&
                $this->Empresa->getRif() != null && $this->Empresa->getRif() != '' &&
                $this->Empresa->getDireccion() != null && $this->Empresa->getDireccion() != '' &&
                $this->Empresa->getCorreo() != null && $this->Empresa->getCorreo() != ''){

                $consulta = $conexion->prepare('INSERT INTO ' . self::TABLA .'(nombre,rif, direccion,correo)
                VALUES  (:nombre,:rif, :direccion,:correo)');
                $consulta->bindParam(':nombre', $this->Empresa->getNombre());
                $consulta->bindParam(':rif', $this->Empresa->getRif());
                $consulta->bindParam(':direccion', $this->Empresa->getDireccion());
                $consulta->bindParam(':correo', $this->Empresa->getCorreo());
                $consulta->execute();
                $this->Empresa->setId($conexion->lastInsertId()) ;

            }else{
                $this->Empresa = null;
            }


        }else{

            if( $this->Empresa->getNombre() != null){
                if($query == ''){
                    $query .='nombre = :nombre';
                }else{
                    $query .=', nombre = :nombre';
                }
            }

            if( $this->Empresa->getRif() != null){
                if($query == ''){
                    $query .='rif = :rif';
                }else{
                    $query .=', rif = :rif';
                }
            }


            if($this->Empresa->getDireccion() != null){
                if($query == ''){
                    $query .='direccion = :direccion';
                }else{
                    $query .=', direccion = :direccion';
                }

            }

            if($this->Empresa->getCorreo() != null){
                if($query == ''){
                    $query .='correo = :correo';
                }else{
                    $query .=', correo = :correo';
                }

            }
            $consulta = $conexion->prepare('UPDATE ' . self::TABLA .' SET '.$query.
                ' WHERE id = :id');
            $consulta->bindParam(':nombre', $this->Empresa->getNombre());
             $consulta->bindParam(':rif', $this->Empresa->getRif());
            $consulta->bindParam(':direccion', $this->Empresa->getDireccion());
            $consulta->bindParam(':correo', $this->Empresa->getCorreo());
            $consulta->execute();
        }
        $conexion = null;
        return $this->Empresa;
    }

    public function consultarPorId()
    {
        $conexion = new Connect();
        $consulta = $conexion->prepare('SELECT id,nombre, rif,direccion,correo FROM '
            . self::TABLA . ' WHERE id = :id');
        $consulta->bindParam(':id', $this->Empresa->getId());
        $consulta->execute();
        $registro = $consulta->fetch();
        if($registro){
            $this->Empresa->setNombre($registro['nombre']);
            $this->Empresa->setRif($registro['rif']);
            $this->Empresa->setDireccion($registro['direccion']);
            $this->Empresa->setCorreo($registro['correo']);
            $this->Empresa->setId($registro['id']);

        }else{
            $this->Empresa = null;
        }
        $conexion = null;
        return $this->Empresa;
    }

    public function consultarPorParametro()
    {
        $conexion = new Connect();
        if ($this->Empresa->getId() != null) {
            $parametro = ' WHERE id = :parametro';
            $valor = $this->Empresa->getId();
        } elseif ($this->Empresa->getNombre() != null) {
            $parametro = ' WHERE nombre = :parametro';
            $valor = $this->Empresa->getNombre();
        } elseif ($this->Empresa->getRif() != null) {
            $parametro = ' WHERE rif = :parametro';
            $valor = $this->Empresa->getRif();
        } elseif ($this->Empresa->getDireccion() != null) {
            $parametro = ' WHERE direccion = :parametro';
            $valor = $this->Empresa->getDireccion();
        }else {
            $parametro = ' WHERE id = :parametro';
            $valor = 0;
        }
        $consulta = $conexion->prepare('SELECT id,
                                                nombre,
                                                rif,
                                                direccion,
                                                correo
                                                FROM ' . self::TABLA . $parametro);
        $consulta->bindParam(':parametro', $valor);
        $consulta->execute();
        $registro = $consulta->fetch();
        if ($registro) {
            $this->Empresa->setNombre($registro['nombre']);
            $this->Empresa->setRif($registro['rif']);
            $this->Empresa->setDireccion($registro['direccion']);
            $this->Empresa->setCorreo($registro['correo']);
            $this->Empresa->setId($registro['id']);

        } else {
            $this->Empresa = null;
        }
        $conexion = null;
        return $this->Empresa;
    }

    public function consultarTodos()
    {
        $conexion = new Connect();

        $consulta = $conexion->prepare('SELECT id,
                                                nombre,
                                                rif,
                                                direccion,
                                                correo
                                                FROM ' . self::TABLA );
        $consulta->execute();
        $empresas = $consulta->fetchAll();
        $conexion = null;
        return $empresas;
    }

    public function eliminar()
    {
        $conexion = new Connect();
        try{
            $consulta = $conexion->prepare( 'DELETE FROM ' . self::TABLA .' WHERE id = :parametro');
            $consulta->bindParam(':parametro', $this->Empresa->getId());
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

        $consulta = $conexion->prepare('SELECT id,nombre, rif,direccion,correo FROM '
            . self::TABLA . $parametro);
        $consulta->bindParam(':parametro', $valor);
        $consulta->execute();
        $registro = $consulta->fetch();
        if($registro){
            $Empresa = new Empresa();
            $Empresa->setNombre($registro['nombre']);
            $Empresa->setRif($registro['rif']);
            $Empresa->setDireccion($registro['direccion']);
            $Empresa->setCorreo($registro['correo']);
            $Empresa->setId($registro['id']);

        }else{
            $Empresa = null;
        }
        $conexion = null;
        return $Empresa;
    }
}