<?php
include_once 'C:\xampp\htdocs\T4rio\front-end\Base.php';
session_start();
$usuario = $_SESSION['usuarioLogeado'];
$dao = FabricaDao::DaoTipoEmpresa(FabricaEntidad::TipoEmpresa());
$TipoEmpresa = $dao->obtenerTodos();

$daoTP = FabricaDao::DaoTipoProducto(FabricaEntidad::TipoProducto());
$TipoProducto = $daoTP->obtenerTodos();

$daoFactura = FabricaDao::DaoFactura(FabricaEntidad::Factura());
$FacturasPendientes = $daoFactura->obtenerPorEditar($usuario->getId())


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

            <div class="center" style="color: red;">
                <?php if (isset($_GET[ "error"]))
                {
                    if ($_GET[ "error"]=="si" )
                    { echo '*Ah ocuriddo un error no se pudo registrar la factura*';
                    }else{
                    }
                }
                ?>

            </div>

            <ul class=" collapsible collection " data-collapsible="accordion ">
                <li>
                    <div class="collapsible-header collection-item ">Por modificar <span class="new badge ">1</span>
                    </div>
                    <div class="collapsible-body ">
                        <table class="striped centered">

                            <thead>
                                <tr>
                                    <th data-field="numeroPedido ">Numero de pedido</th>
                                    <th data-field="observacion ">Observacions</th>
                                    <th data-field="observacion "></th>
                                </tr>
                            </thead>

                            <tbody>
                            <?php
                            if($FacturasPendientes != null){
                               foreach( $FacturasPendientes as $orden):
                            ?>
                            <tr>

                                   <td>
                                       <div class="input-field col s12">
                                           <input value="<?php echo $orden->getId()?>" placeholder="producto" type="text" class="validate center" disabled>
                                       </div>
                                   </td>
                                   <td>
                                       <div class="input-field col s12">
                                           <textarea id="textarea1" class="materialize-textarea" disabled><?php echo $orden->getExtra()?> </textarea>
                                       </div>
                                   </td>
                                   <td>
                                       <a href="edicionPedido.php?id=<?php echo $orden->getId()?>" class="btn waves-effect waves-light" type="submit" name="action">Editar</a>
                                   </td>


                            </tr>
                            <?php endforeach;}
                            ?>
                            </tbody>

                        </table>
                    </div>
                </li>
            </ul>

            <ul class="collapsible collection " data-collapsible="accordion ">
                <li>
                    <div class="collapsible-header collection-item ">
                        Generar pedido
                    </div>
                    <div class="collapsible-body ">
                        <form action="_indexAnalistaBean.php" method="post">

                            <div class="row col s8 offset-s2">
                                <div class="col s6">
                                    <div class="input-field col s12">
                                        <select class="browser-default" name="tipoEmpresa" required>
                                            <option value="" disabled selected>Tipo de Empresa</option>
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
                                        <input id="icon_prefix" type="text" class="validate" name="informacion" length="10">
                                        <label for="icon_prefix">Rif de la empresa</label>
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
                                        <td>
                                            <div class="input-field col s12">
                                                <select class="browser-default" name="tipoProducto[]" required onchange="showUser(this.value)">
                                                    <option value="" disabled selected > Tipo Producto</option>
                                                    <?php foreach($TipoProducto as $items):?>
                                                        <option value="<?php echo $items->getId();?>">
                                                            <?php echo $items->getNombre() ?>
                                                        </option>
                                                    <?php endforeach;?>
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                                <input placeholder="cantidad"  onkeyup="showHint(this.value)" name="cantidad[]" type="number" class="validate center">
                                        </td>
                                        <td>
                                            <div class="input-field col s12" >
                                                <div id="txtHint">  </div>

                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-field col s12" >
                                                <div id="txtCantidad">  </div>

                                            </div>
                                        </td>
                                    </tr>
                                </tbody>

                            </table>

                            <div class="right-align">
                                <button class="btn-floating btn-large waves-effect waves-light red" onClick="clickAgregar()">
                                    <i class="mdi-content-add"></i>
                                </button>

                            </div>

                            <div class="center">
                                <button class="btn waves-effect waves-light" type="submit" name="action">Procesar
                                    <i class="mdi-content-send right"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </li>
            </ul>

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