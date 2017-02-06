<?php

session_start();
if(isset($_SESSION['usuarioLogeado']) ){
    session_destroy();
}
?>
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
            <?php if (isset($_GET[ "error"]))
            {
                if ($_GET[ "error"]=="si" )
                { echo '*Ah ocuriddo un error no se pudo registrar el usuario*';
                }else{ echo '* El medidor no pudo ser asignado*';
                }
            }
            ?>

        </div>
        <div class="row">
            <div class="col s3">
            </div>
            <div class="col s6 offset-s3">
                <form action="_indexBean.php" method="post" style="padding:20%;">
                    <div class="row ">
                        <div class="input-field">
                            <input  type="email" name="correo" class="validate" required placeholder="Introduzca su correo">
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field">
                            <input id="password" type="password" name="clave" class="validate" required placeholder="Introduzca su clave">
                        </div>
                    </div>
                    <button class="btn waves-effect waves-light cyan lighten-1" type="submit" name="action">Ingresar
                        <i class="mdi-content-send right"></i>
                    </button>
                </form>
                <div class="col s3"></div>
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