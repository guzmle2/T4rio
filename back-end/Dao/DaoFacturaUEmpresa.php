<?php
/**
 * Created by PhpStorm.
 * User: LEONORBANCO
 * Date: 11/06/2015
 * Time: 10:36 AM
 */

namespace Dao;
use Entidad\Empresa;
use Entidad\Usuario;
use IDao\IDaoFacturaUEmpresa;

require_once 'Connect.php';
require_once '../Contrato/IDaoFacturaUEmpresa.php';

class DaoFacturaUEmpresa implements IDaoFacturaUEmpresa {


    var $FacturaUEmpresa;

    const TABLA = 'factura_usuario_empresa';

    public function __construct(&$FacturaUEmpresa)
    {
        $this->FacturaUEmpresa =& $FacturaUEmpresa;
    }




    public function agrega_modifica()
    {
        $conexion = new Connect();
        $query = '';

        if($this->$FacturaUEmpresa->getId() != null  )
        {
            if( $this->$FacturaUEmpresa->getEmpresa() != null && $this->$FacturaUEmpresa->getUsuario() != null &&
                $this->$FacturaUEmpresa->getFechaCreacion() != null && $this->$FacturaUEmpresa->getFechaCreacion() != '' &&
                $this->$FacturaUEmpresa->getPrecioTotal() != null && $this->$FacturaUEmpresa->getPrecioTotal() != '' ){

                $consulta = $conexion->prepare('INSERT INTO ' . self::TABLA .'
                (id_usuario,id_empresa, fechaCreacion,precioTotal)
                VALUES  (:id_usuario,:id_empresa, :fechaCreacion,:precioTotal)');
                $consulta->bindParam(':id_usuario', $this->$FacturaUEmpresa->getUsuario()->getId());
                $consulta->bindParam(':id_empresa', $this->$FacturaUEmpresa->getEmpresa()->getId());
                $consulta->bindParam(':fechaCreacion', $this->$FacturaUEmpresa->getFechaCreacion());
                $consulta->bindParam(':precioTotal', $this->$FacturaUEmpresa->getPrecioTotal());
                $consulta->execute();
                $this->$FacturaUEmpresa->setId($conexion->lastInsertId()) ;

            }else{
                $this->$FacturaUEmpresa = null;
            }


        }else{

            if( $this->$FacturaUEmpresa->getUsuario() != null){
                if($query == ''){
                    $query .='id_usuario = :id_usuario';
                }else{
                    $query .=', id_usuario = :id_usuario';
                }
            }

            if( $this->$FacturaUEmpresa->getEmpresa() != null){
                if($query == ''){
                    $query .='id_empresa = :id_empresa';
                }else{
                    $query .=', id_empresa = :id_empresa';
                }
            }


            if($this->$FacturaUEmpresa->getFechaCreacion() != null){
                if($query == ''){
                    $query .='fechaCreacion = :fechaCreacion';
                }else{
                    $query .=', fechaCreacion = :fechaCreacion';
                }

            }

            if($this->$FacturaUEmpresa->getPrecioTotal() != null){
                if($query == ''){
                    $query .='precioTotal = :precioTotal';
                }else{
                    $query .=', precioTotal = :precioTotal';
                }

            }
            $consulta = $conexion->prepare('UPDATE ' . self::TABLA .' SET '.$query.
                ' WHERE id = :id');
            $consulta->bindParam(':id_usuario', $this->$FacturaUEmpresa->getUsuario()->getId());
            $consulta->bindParam(':id_Empresa', $this->$FacturaUEmpresa->getEmpresa()->getId());
            $consulta->bindParam(':fechaCreacion', $this->$FacturaUEmpresa->getFechaCreacion());
            $consulta->bindParam(':precioTotal', $this->$FacturaUEmpresa->getPrecioTotal());
            $consulta->execute();
        }
        $conexion = null;
        return $this->$FacturaUEmpresa;
    }

    public function consultarPorId()
    {
        $conexion = new Connect();
        $consulta = $conexion->prepare('SELECT id,id_usuario, id_empresa,fechaCreacion,precioTotal FROM '
            . self::TABLA . ' WHERE id = :id');
        $consulta->bindParam(':id', $this->Empresa->getId());
        $consulta->execute();
        $registro = $consulta->fetch();
        if($registro){
            $this->$FacturaUEmpresa->setFechaCreacion($registro['fechaCreacion']);
            $this->$FacturaUEmpresa->setPrecionTotal($registro['precioTotal']);
            $this->$FacturaUEmpresa->setId($registro['id']);
            $conexion = null;
            $this->$FacturaUEmpresa->setUsuario(DaoFacturaUEmpresa::consultarUsuario($registro['id_usuario']));
            $this->$FacturaUEmpresa->setEmpresa(DaoFacturaUEmpresa::consultarEmpresa($registro['id_empresa']));

        }else{
            $this->$FacturaUEmpresasa = null;
        }
        $conexion = null;
        return $this->$FacturaUEmpresapresa;
    }

    public function consultarPorParametro()
    {
        $conexion = new Connect();
        if ($this->FacturaUEmpresa->getId() != null) {
            $parametro = ' WHERE id = :parametro';
            $valor = $this->FacturaUEmpresa->getId();
        } elseif ($this->FacturaUEmpresa->getPrecioTotal() != null) {
            $parametro = ' WHERE precioTotal = :parametro';
            $valor = $this->FacturaUEmpresa->getPrecioTotal();
        }else {
            $parametro = ' WHERE id = :parametro';
            $valor = 0;
        }
        $consulta = $conexion->prepare('SELECT id,
                                                id_usuario,
                                                id_empresa,
                                                fechaCreacion,
                                                precioTotal
                                                FROM ' . self::TABLA . $parametro);
        $consulta->bindParam(':parametro', $valor);
        $consulta->execute();
        $registro = $consulta->fetch();
        if ($registro) {
            $this->FacturaUEmpresa->setFechaCreacion($registro['fechaCreacion']);
            $this->FacturaUEmpresa->setPrecioTotal($registro['precioTotal']);
            $this->FacturaUEmpresa->setId($registro['id']);
            $conexion = null;
            $this->$FacturaUEmpresa->setUsuario(DaoFacturaUEmpresa::consultarUsuario($registro['id_usuario']));
            $this->$FacturaUEmpresa->setEmpresa(DaoFacturaUEmpresa::consultarEmpresa($registro['id_empresa']));

        } else {
            $this->FacturaUEmpresa = null;
        }
        $conexion = null;
        return $this->FacturaUEmpresa;
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
        $facturas = $consulta->fetchAll();
        $conexion = null;
        return $facturas;
    }

    public function eliminar()
    {
        $conexion = new Connect();
        try{
            $consulta = $conexion->prepare( 'DELETE FROM ' . self::TABLA .' WHERE id = :parametro');
            $consulta->bindParam(':parametro', $this->FacturaUEmpresa->getId());
            $consulta->execute();
            $conexion = null;

        }catch (Exception $e){
            $conexion = null;
            echo 'Ha surgido un error y no se puede conectar a la base de datos. Detalle: ' . $e->getMessage();
        }
    }

    public function consultarXEmpresa()
    {
        $conexion = new Connect();
        $consulta = $conexion->prepare('SELECT id,id_usuario, id_empresa,fechaCreacion,precioTotal FROM '
            . self::TABLA . ' WHERE id_empresa = :id_empresa');
        $consulta->bindParam(':id_empresa', $this->FacturaUEmpresa->getEmpresa()->getId());
        $consulta->execute();
        $facturas = $consulta->fetchAll();
        $conexion = null;
        return $facturas;
    }

    public function consultarXUsuario()
    {
        $conexion = new Connect();
        $consulta = $conexion->prepare('SELECT id,id_usuario, id_empresa,fechaCreacion,precioTotal FROM '
            . self::TABLA . ' WHERE id_usuario = :id_usuario');
        $consulta->bindParam(':id_usuario', $this->FacturaUEmpresa->getUsuario()->getId());
        $consulta->execute();
        $facturas = $consulta->fetchAll();
        $conexion = null;
        return $facturas;
    }

    public function consultarUsuario($id)
    {
        $conexion = new Connect();
        $consulta = $conexion->prepare('SELECT id,nombre,
                                                apellido,
                                                cedula,
                                                tipo,
                                                correo,
                                                clave
                                                FROM usuario WHERE id = :id');
        $consulta->bindParam(':id', $id);
        $consulta->execute();
        $registro = $consulta->fetch();
        if($registro){
            $user = new Usuario();
            $user->setNombre($registro['nombre']);
            $user->setApellido($registro['apellido']);
            $user->setCedula($registro['cedula']);
            $user->setCorreo($registro['correo']);
            $user->setTipo($registro['tipo']);
            $user->setClave($registro['clave']);
            $user->setId($registro['id']);
            $conexion = null;
            return $this->FacturaUEmpresa->setUsuario($user);
        }else{
            $conexion = null;
            return $this->FacturaUEmpresa->setUsuario(null);
        }
    }

    public function consultarEmpresa($id_empresa)
    {
        $conexion = new Connect();
        $consulta = $conexion->prepare('SELECT id,nombre, rif,direccion,correo FROM empresa WHERE id = :id');
        $consulta->bindParam(':id', $id_empresa);
        $consulta->execute();
        $registro = $consulta->fetch();
        if($registro){
            $empres = new Empresa();
            $empres->setNombre($registro['nombre']);
            $empres->setRif($registro['rif']);
            $empres->setDireccion($registro['direccion']);
            $empres->setCorreo($registro['direccion']);
            $empres->setId($registro['id']);
            $conexion = null;
            return $this->FacturaUEmpresa->setEmpresa($empres);
        }else{
            $conexion = null;
            return $this->FacturaUEmpresa->setEmpresa(null);
        }
    }


    public function consultarPorIdParametro($id)
    {
        $conexion = new Connect();
        $consulta = $conexion->prepare('SELECT id,id_usuario, id_empresa,fechaCreacion,precioTotal FROM '
            . self::TABLA . ' WHERE id = :id');
        $consulta->bindParam(':id', $id);
        $consulta->execute();
        $registro = $consulta->fetch();
        if($registro){
            $this->$FacturaUEmpresa->setFechaCreacion($registro['fechaCreacion']);
            $this->$FacturaUEmpresa->setPrecionTotal($registro['precioTotal']);
            $this->$FacturaUEmpresa->setId($registro['id']);
            $conexion = null;
            $this->$FacturaUEmpresa->setUsuario(DaoFacturaUEmpresa::consultarUsuario($registro['id_usuario']));
            $this->$FacturaUEmpresa->setEmpresa(DaoFacturaUEmpresa::consultarEmpresa($registro['id_empresa']));
            $conexion = null;
            return $this->$FacturaUEmpresapresa;
        }else{
            $conexion = null;
            return $this->$FacturaUEmpresasa = null;
        }
    }
}