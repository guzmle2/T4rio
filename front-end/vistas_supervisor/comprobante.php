<?php
include_once 'C:\xampp\htdocs\T4rio\front-end\Base.php';
$Factura = FabricaEntidad::Factura();
$Factura->setId($_GET['id']);
$dao = FabricaDao::DaoFactura($Factura);
$Factura = $dao->consultarXid();
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
            <div class="center-align"><a href="#!" class="brand-logo">T4rio</a></div>
        </div>
    </nav>
</header>
<section class="container section">
    <div class="row">
        <div class="col s12">

            <div class="center">
                <p>
                <h3>Se ah generado  de manera exitosa</h3> Factura numero:
                <div class="red">
                    <h3><?php echo $Factura->getId();  ?></h3>
                </div>
                </p>
            </div>

            <div class="row center">
                <h5>Detalles de la factura realizada</h5>
            </div>

            <div class="row">
                <form action="_edicionPedidoBean.php" method="post">
                    <table class="striped">
                        <thead>
                        <tr>
                            <th data-field="id">Producto</th>
                            <th data-field="name">Cantidad</th>
                            <th data-field="price">Precio Unitario</th>
                            <th data-field="price">Precio por Cantidad</th>
                            <th data-field="price">Total</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php
                        foreach( $Factura->getProductos()[0] as $producto):
                            ?>
                            <tr>
                                <td><?php echo $producto->getTipoProducto()->getNombre();?> </td>
                                <td><?php echo $producto->getCantidad();?> </td>
                                <td><?php echo $producto->getPrecioCompra();?> </td>
                                <td><?php echo $producto->getPrecioCantidad();?> </td>
                                <td></td>
                            </tr>


                        <?php endforeach;
                        ?><tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td> <?php echo $Factura->getPrecioTotal()?></td>
                        </tr>
                        <input type="hidden" name="id" value="<?php echo $Factura->getId()?>"/>
                        </tbody>
                    </table>
                    <div class="input-field col s12">
                        <textarea id="textarea1" name="extra" class="materialize-textarea" required></textarea>
                        <label for="textarea1">Observacion</label>
                    </div>
                    <div>
                        <a href="index.php" class="btn waves-effect waves-light" type="submit" name="action">Regresar</a>

                        <button class="btn waves-effect waves-light" type="submit" name="action">Que se modifique!
                            <i class="mdi-content-send right"></i>
                        </button>
                        <a href="_edicionPedidoBean.php?aprobar=si&id=<?php echo $Factura->getId()?>" class="btn waves-effect waves-light" type="submit" name="action">Aprobar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<footer class="page-footer cyan lighten-1">
    <div class="container">
        <div class="row">
            <div class="col l6 s12">
                <h5 class="white-text">T4rio</h5>
                <p class="grey-text text-lighten-4">Diseño y desarrollo como software de defensa de tesis.</p>
            </div>
            <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Tesistas</h5>
                <ul>
                    <li><a class="grey-text text-lighten-3" href="#!">Migdalia</a>
                    </li>
                    <li><a class="grey-text text-lighten-3" href="#!">Rodrigo</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            © 2015 Copyright
            <a class="grey-text text-lighten-4 right" href="#!">Universidad</a>
        </div>
    </div>
</footer>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="../js/materialize.min.js"></script>
</body>

</html>