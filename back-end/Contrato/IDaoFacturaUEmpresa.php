<?php
/**
 * Created by PhpStorm.
 * User: LEONORBANCO
 * Date: 11/06/2015
 * Time: 10:33 AM
 */

namespace IDao;

use IDao\IDaoBase;
require_once 'IDaoBase.php';

interface IDaoFacturaUEmpresa extends IDaoBase {

    public function consultarXEmpresa();

    public function consultarXUsuario();


}