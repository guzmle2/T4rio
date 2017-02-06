<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>T4rio</title>
    <link rel="stylesheet" href="css/style.css">
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />
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
    <div class="center" style="color: red;">
        <?php if (isset($_GET[ "clave"]))
        {
            if ($_GET[ "clave"]=="no" )
            { echo '*Clave invalida*';
            }else{ echo '* El medidor no pudo ser asignado*';
            }
        }
        ?>

    </div>
    <div class="row">
        </div>
        <div class="col s8 offset-s2">

            <form action="_registroUsuarioBean.php" method="post" >

                <div class="contenedorLogin waves-color-demo">
                    <h4 style="color:black;" align="center">Registro de usuario</h4>
                    <br>
                    <div class="row ">
                        <div class="input-field col s4 offset-s4">
                            <input disabled  type="text" class="validate" value="<?php echo $_GET['correo']; ?> " >
                            <input type="hidden" class="validate" name="correo" value="<?php echo $_GET['correo']; ?> " >
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s4 offset-s4">
                            <input id="clave" type="password" class="validate" length="10" name="clave" required placeholder="Clave">
                        </div>
                        <div class="input-field col s4 offset-s4">
                            <input id="nombre" type="text" class="validate" length="20" name="nombre" required placeholder="Introduzca su Nombre">
                        </div>
                        <div class="input-field col s4 offset-s4">
                            <input id="apellido" type="text" class="validate" length="20" name="apellido" required placeholder="Introduzca su apellido">
                        </div>
                        <div class="input-field col s4 offset-s4">
                            <input id="cedula" type="number" class="validate" length="10" name="cedula" required placeholder="Introduzca su cedula">
                        </div>
                        <div class=" col s4 offset-s4">
                            <select class="browser-default" name="tipo" required>
                                <option value="" selected>Seleccione tipo usuario</option>
                                <option value="ANALISTA">ANALISTA</option>
                                <option value="SUPERVISOR">SUPERVISOR</option>
                                <option value="GERENTE">GERENTE</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s2 offset-s4">
                            <br/>
                            <button class="waves-effect waves-red btn-large waves-color-demo" type="submit" name="action">Agregar
                                <i class="mdi-alert-warning right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>


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
<script type="text/javascript" src="js/materialize.min.js"></script>
</body>

</html>