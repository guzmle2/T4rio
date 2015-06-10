<?php
/**
 * Created by PhpStorm.
 * User: DIAZ
 * Date: 07/06/2015
 * Time: 06:43 PM
 */

namespace Dao;
use PDO;
use PDOException;

class Connect extends PDO {
    private $tipo_de_base = 'mysql';
    private $host = 'localhost';
    private $nombre_de_base = 't4rio';
    private $usuario = 'root';
    private $contrasena = '';

    public function __construct() {
        //Sobreescribo el método constructor de la clase PDO.
        try{
            parent::__construct($this->tipo_de_base.':host='.$this->host.';dbname='.$this->nombre_de_base, $this->usuario, $this->contrasena);
        }catch(PDOException $e){
            echo 'Ha surgido un error y no se puede conectar a la base de datos. Detalle: ' . $e->getMessage();
            exit;
        }
    }
}