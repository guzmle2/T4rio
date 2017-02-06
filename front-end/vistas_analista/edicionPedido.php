<?php
include_once 'C:\xampp\htdocs\T4rio\front-end\Base.php';
$Factura = FabricaEntidad::Factura();
$Factura->setId($_GET['id']);
$dao = FabricaDao::DaoFactura($Factura);
$Factura = $dao->consultarXid();

$dao = FabricaDao::DaoTipoEmpresa(FabricaEntidad::TipoEmpresa());
$TipoEmpresa = $dao->obtenerTodos();

$dao = FabricaDao::DaoTipoProducto(FabricaEntidad::TipoProducto());
$TipoProducto = $dao->obtenerTodos();
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
    <script type="text/javascript">

        function eliminar() {
            var x = document.getElementById("tableToModify").rows.length;
            document.getElementById("tableToModify").deleteRow(x-1);
        }

        function clickAgregar() {
            var row = document.getElementById("rowToClone"); // find row to copy
            var table = document.getElementById("tableToModify"); // find table to append to
            document.getElementById('txtHint').id = 'otro';
            document.getElementById('txtCantidad').id = 'cantidad';
            var clone = row.cloneNode(true); // copy children too

            var InputType = clone.getElementsByTagName("input");

            for (var i = 0; i < InputType.length; i++) {
                if (InputType[i].type == 'checkbox') {
                    InputType[i].checked = false;
                } else {
                    InputType[i].value = '';
                }
            }
            var x = document.getElementById("tableToModify").rows.length;
            table.appendChild(clone); // add new row to end of table
            document.getElementById("tableToModify").rows[x].cells[2].id = "txtHint";
            document.getElementById("tableToModify").rows[x].cells[3].id = "txtCantidad";
            document.getElementById("txtHint").innerHTML = "";
            document.getElementById("txtCantidad").innerHTML = "";

        }


        function showUser(str) {
            if (str == "") {
                document.getElementById("txtHint").innerHTML = "";
                return;
            } else {
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else {
                    // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET","producto.php?tipoProducto="+str,true);
                xmlhttp.send();
            }
        }

        function showHint(str) {
            if (str.length == 0) {
                document.getElementById("txtCantidad").innerHTML = "";
                return;
            } else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("txtCantidad").innerHTML = xmlhttp.responseText;
                    }
                }
                var porId=document.getElementById("txtHint").innerHTML;
                xmlhttp.open("GET", "producto.php?cantidad=" + str +"&precioIndividual="+porId, true);
                xmlhttp.send();
            }
        }

        function Eliminar (i) {
            document.getElementById("tableToModify").deleteRow(i);
        }
    </script>
    <header>
        <nav>
            <div class="nav-wrapper cyan lighten-1">
                <div class="center-align"><a href="#!" class="brand-logo">T4rio</a></div>
            </div>
        </nav>
    </header>
    <section class="container row">
        <div class="col s12 ">
            <br>
            <br>
            <br>

            <form action="_indexAnalistaBean.php" method="post">

                <div class="row row col s8 offset-s2">

                    <p class="center-align">
                        <h4>Detalle del pedido Num: <?php echo $Factura->getId();?></h4>
                    </p>
                    <p> Observacion</p>
                    <textarea id="textarea1" class="materialize-textarea" disabled>
                        <?php echo $Factura->getExtra(); ?>
                    </textarea>
                </div>

                <div class="row col s8 offset-s2">
                    <div class="col s4">
                        <div class="input-field col s12">

                            <select class="browser-default" name="tipoEmpresa" required>
                                <option value="<?php echo $Factura->getTipoEmpresa()->getId()?>"  selected><?php echo $Factura->getTipoEmpresa()->getNombre()?></option>
                                <?php foreach($TipoEmpresa as $items):?>
                                    <option value="<?php echo $items->getId();?>">
                                        <?php echo $items->getNombre() ?>
                                    </option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>

                    <div class="col s6 ">
                        <div class="input-field col s6">
                            <input id="icon_prefix" name="informacion" type="text" class="validate" length="10" required="" value="<?php echo $Factura->getInformacion()?>">
                            <label for="icon_prefix">Datos de la empresa</label>
                        </div>
                    </div>
                </div>
                <div class="row row col s8 offset-s2">

                    <p class="center-align">
                        Detalle del pedido
                    </p>

                </div>
                <table class="striped centered">

                    <thead>
                        <tr>
                            <th data-field="producto ">Producto</th>
                            <th data-field="cantidad ">Cantidad</th>
                            <th data-field="precioActual ">Precio actual</th>
                            <th data-field="precioActual ">Precio por cantidad</th>
                        </tr>
                    </thead>

                    <tbody id="tableToModify">
                        <tr id="rowToClone">
                            <?php
                            foreach( $Factura->getProductos()[0] as $producto):
                            ?>


                            <td>
                                <div class="input-field col s12">
                                    <select class="browser-default" name="tipoProducto[]" required onchange="showUser(this.value)">
                                        <option value="<?php echo $producto->getTipoProducto()->getId()?>"  selected > <?php echo $producto->getTipoProducto()->getNombre()?></option>
                                        <?php foreach($TipoProducto as $items):?>
                                            <option value="<?php echo $items->getId();?>">
                                                <?php echo $items->getNombre() ?>
                                            </option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <input placeholder="cantidad" value="<?php echo $producto->getCantidad() ?>" onkeyup="showHint(this.value)" name="cantidad[]" type="number" class="validate center">
                            </td>
                            <td>
                                <div class="input-field col s12" >
                                    <div id="txtHint"> <?php echo $producto->getPrecioCompra() ?> </div>

                                </div>
                            </td>
                            <td>
                                <div class="input-field col s12" >
                                    <div id="txtCantidad"> <?php echo $producto->getPrecioCantidad() ?> </div>

                                </div>
                            </td>

                        </tr>


                        <?php endforeach;
                        ?>


                        <input type="hidden" name="id" value="<?php echo $Factura->getId() ?>"/>
                    </tbody>

                    <td onclick="eliminar()">
                        <a onclick="eliminar()">Eliminar ultima fila</a>
                    </td>

                </table>

                <div class="right-align">
                    <button class="btn-floating btn-large waves-effect waves-light red" onClick="clickAgregar()">
                        <i class="mdi-content-add"></i>
                    </button>

                </div>

                <div class="center">
                    <a href="index.php" class="btn waves-effect waves-light" type="submit" name="action">Regresar</a>
                    <button class="btn waves-effect waves-light" type="submit" name="action">Guardar!
                        <i class="mdi-content-send right"></i>
                    </button>

                </div>
            </form>
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