<?php 
$path = 'quejaReporte';

session_start();
    $uNombres = isset($_SESSION["nombres"]) ? $_SESSION["nombres"] : null;
    $uApellidos = isset($_SESSION["apellidos"]) ? $_SESSION["apellidos"] : null;
    $uUsuariro = isset($_SESSION["usuario"]) ? $_SESSION["usuario"] : null;
    if((isset($uNombres) && isset( $uApellidos ) && isset($uUsuariro )) ){
        header('Location: '.'/diaco-quejas/admin');
    }


$usuario = isset($_POST["usuario"])  ? $_POST["usuario"] : null;
$contrasenia = isset($_POST["contrasenia"])  ? $_POST["contrasenia"] : null;
	if($usuario != null && $contrasenia != null){
        require_once($_SERVER['DOCUMENT_ROOT'].'/diaco-quejas/modelos/Usuario.php');
  			$u = new Usuario();
  			$u->set(
  				$usuario,
                $contrasenia
  			);
  			if($u->iniciarSesion())
              header('Location: '.'/diaco-quejas/admin');
  			else
              $error = true;
	} 



?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Diaco - Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.2/css/bulma.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" />
</head>

<body class="has-background-light" style="height: 100vh;">

    <nav class="navbar is-danger " role="navigation" aria-label="main navigation">
        <div class="container">
            <div class="navbar-brand">
                <a class="navbar-item" href="https://bulma.io">
                    <h2 class="subtitle is-family-secondary">
                        <strong style="color:#fff;">
                            Diaco - Quejas
                        </strong>
                    </h2>
                </a>
                <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false"
                    data-target="navbarBasicExample">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                </a>
            </div>
            <div id="navbarBasicExample" class="navbar-menu">

                <div class="navbar-end">
                    <div class="navbar-item">
                        <div class="buttons">
                            <a class="button  is-info is-light" href="/diaco-quejas">
                                <strong>Salir</strong>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </nav>


    <div class="columns is-desktop">
        <div class="column is-3" style="margin: 0 auto;">
            <div style="margin-top: 3rem;" class=" has-text-centered">

                <span class="icon is-large">
                    <i class="fas fa-user fa-2x"></i>
                </span>
                <h1 class="subtitle is-2">Inciar Sesion</h1>
            </div>

            <div class="box" style="margin-top:1em; margin: 1em;">
                <form action="" method="POST">
                    <div class="field">
                        <label class="label">Usuario</label>
                        <div class="control has-icons-left has-icons-right">
                            <input class="input " type="text" placeholder="Ingresar usuario" value="" required=""
                                autofocus name="usuario" />
                            <span class="icon is-small is-left">
                                <i class="fas fa-envelope"></i>
                            </span>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Contraseña</label>
                        <div class="control has-icons-left has-icons-right">
                            <input class="input " type="password" placeholder="*****" value="" required=""
                                name="contrasenia" />
                            <span class="icon is-small is-left">
                                <i class="fas fa-key"></i>
                            </span>
                        </div>
                    </div>
                    <br />
                    <input type="submit" class="button is-danger is-fullwidth" value="Iniciar" />
                </form>
                <br>
                <?php if(isset($error) && $error){ ?>
                <div class="notification is-danger is-light">
                    <button class="delete"></button>
                    Usuario/contraseña incorrecta...
                </div>
                <?php } ?>
            </div>
        </div>
    </div>


    <script>
    document.addEventListener('DOMContentLoaded', () => {

        // Get all "navbar-burger" elements
        const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

        // Check if there are any navbar burgers
        if ($navbarBurgers.length > 0) {

            // Add a click event on each of them
            $navbarBurgers.forEach(el => {
                el.addEventListener('click', () => {

                    // Get the target from the "data-target" attribute
                    const target = el.dataset.target;
                    const $target = document.getElementById(target);

                    // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
                    el.classList.toggle('is-active');
                    $target.classList.toggle('is-active');

                });
            });
        }

    });
    </script>
</body>

</html>