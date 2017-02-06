<?php
include_once 'C:\xampp\htdocs\T4rio\front-end\Base.php';

$dao = FabricaDao::DaoFactura(FabricaEntidad::Factura());
$Factura = $dao->obtenerListaXParametro('estatus', 'APROBADO');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>T4rio</title>
    <link rel="stylesheet" href="../css/style.css">
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
</head>

<body>

    <header>
        <nav>
            <div class="nav-wrapper cyan lighten-1">
                <div class="center-align"><a href="#!" class="brand-logo">T4rio</a> </div>
            </div>
        </nav>
    </header>
    <section class="container">
        <div class="row">
            <div class="col s12">
                <br>
                <br>

                <div class="row center">
                    <h5>Registros</h5>
                </div>
                <div class="row row col s12">
                    <p> Escoga el filtro de la busqueda de registro</p>
                    <span>De dejar en blanco el campo valor, se filtraran todos</span>
                </div>

                <div class="row col s12">
                    <div class="col s4">
                        <div class="input-field col s12">
                            <select class="browser-default">
                                <option value="" disabled selected>Tipo de busqueda</option>
                                <option value="1">Por producto</option>
                                <option value="2">Por Empresa</option>
                                <option value="3">Por fecha</option>
                                <option value="3">Por Usuario creador</option>
                            </select>
                        </div>
                    </div>
                    <div class="">
                        <div class="input-field col s6">
                            <input id="icon_prefix" type="text" class="validate" length="10">
                            <label for="icon_prefix">Valor de busqueda</label>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="center">

                        <button class="btn waves-effect waves-light" type="submit" name="action">Buscar!
                            <i class="mdi-content-send right"></i>
                        </button>
                    </div>
                </div>


                <div class="row">
                    <table class="striped">
                        <thead>
                        <tr>
                            <th data-field="detalle"></th>
                            <th data-field="usuario">Usuario creador</th>
                            <th data-field="rifEmpresa">Rif empresa</th>
                            <th data-field="numPedido">Num. Pedido</th>
                            <th data-field="montoT">Monto total</th>
                        </tr>
                        </thead>

                        <tbody>

                        <?php
                        if($Factura != null){
                            foreach( $Factura as $orden):
                                ?>
                                <tr>
                                    <td>
                                        <a href="comprobante.php?id=<?php echo $orden->getId()?>"  class=" right btn waves-effect waves-light cyan lighten-1" type="submit" name="action">
                                            Ver detalle!
                                        </a>
                                    </td>

                                    <td>
                                        <div class="input-field col s12">
                                            <input value="<?php echo $orden->getCreador()->getCorreo()?>"  type="text" class="validate center" disabled>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-field col s12">
                                            <input value="<?php echo $orden->getInformacion()?>"  type="text" class="validate center" disabled>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-field col s12">
                                            <input value="<?php echo $orden->getId()?>"  type="text" class="validate center" disabled>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-field col s12">
                                            <input value="<?php echo $orden->getPrecioTotal()?>"  type="text" class="validate center" disabled>
                                        </div>
                                    </td>

                                </tr>
                            <?php endforeach;}
                        ?>
                        </tbody>
                    </table>
                    <a href="../index.php" class="btn waves-effect waves-light" type="submit" name="action">Salir</a>
                </div>
    </section>
    <footer class="page-footer cyan lighten-1 ">
        <div class="container ">
            <div class="row ">
                <div class="col l6 s12 ">
                    <h5 class="white-text ">T4rio</h5>
                    <p class="grey-text text-lighten-4 ">Diseño y desarrollo como software de defensa de tesis.</p>
                </div>
                <div class="col l4 offset-l2 s12 ">
                    <h5 class="white-text ">Tesistas</h5>
                    <ul>
                        <li><a class="grey-text text-lighten-3 " href="#! ">Migdalia</a>
                        </li>
                        <li><a class="grey-text text-lighten-3 " href="#! ">Rodrigo</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-copyright ">
            <div class="container ">
                © 2015 Copyright
                <a class="grey-text text-lighten-4 right " href="#! ">Universidad</a>
            </div>
        </div>
    </footer>
    <script type="text/javascript " src="https://code.jquery.com/jquery-2.1.1.min.js "></script>
    <script type="text/javascript " src="../js/materialize.min.js"></script>
</body>

</html>