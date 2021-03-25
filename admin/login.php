<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Diaco - Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.2/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" />
</head>

<body class="has-background-light" style="height: 100vh;">

    <nav class="navbar is-" role="navigation" aria-label="main navigation">
        <div class="container">
            <div class="navbar-brand">
                <!-- <a class="navbar-item" href="https://bulma.io">
                    <img src="https://bulma.io/images/bulma-logo.png" width="112" height="28">
                </a> -->
                <a class="navbar-item" href="https://bulma.io">
                    <h2 class="subtitle is-family-secondary" >
                    <strong>
                    Diaco - Quejas
                    </strong>  </h2>
                </a>

                <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false"
                    data-target="navbarBasicExample">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                </a>
            </div>

            <div id="navbarBasicExample" class="navbar-menu">
                <!-- <div class="navbar-start">
                    <a class="navbar-item">
                        Home
                    </a>

                    <a class="navbar-item">
                        Documentation
                    </a>

                    <div class="navbar-item has-dropdown is-hoverable">
                        <a class="navbar-link">
                            More
                        </a>

                        <div class="navbar-dropdown">
                            <a class="navbar-item">
                                About
                            </a>
                            <a class="navbar-item">
                                Jobs
                            </a>
                            <a class="navbar-item">
                                Contact
                            </a>
                            <hr class="navbar-divider">
                            <a class="navbar-item">
                                Report an issue
                            </a>
                        </div>
                    </div>
                </div> -->

                <div class="navbar-end">
                    <div class="navbar-item">
                        <div class="buttons">
                            <a class="button ">
                                <strong>Salir</strong>
                            </a>
                            <!-- <a class="button is-light">
                                Log in
                            </a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </nav>

    <!-- <div class="container"> -->

    <div class="columns is-desktop">
        <!-- <div
                class="column is-three-quarters-mobile is-two-thirds-tablet is-half-desktop is-one-third-widescreen is-one-quarter-fullhd">
                <code>is-three-quarters-mobile</code><br>
                <code>is-two-thirds-tablet</code><br>
                <code>is-half-desktop</code><br>
                <code>is-one-third-widescreen</code><br>
                <code>is-one-quarter-fullhd</code>
            </div> -->
        <div class="column is-3" style="margin: 0 auto;">
            <div style="margin-top: 3rem;" class=" has-text-centered">

                <span class="icon is-large">
                    <i class="fas fa-user fa-2x"></i>
                </span>
                <h1 class="subtitle is-2">Inciar Sesion</h1>
            </div>

            <div class="box" style="margin-top:1em; margin: 1em;">
                <!-- <div class="field">
                    <label class="label">Username</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input is-success" type="text" placeholder="Text input" value="bulma">
                        <span class="icon is-small is-left">
                            <i class="fas fa-user"></i>
                        </span>
                        <span class="icon is-small is-right">
                            <i class="fas fa-check"></i>
                        </span>
                    </div>
                    <p class="help is-success">This username is available</p>
                </div>

                <div class="field">
                    <label class="label">Username</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input is-success" type="text" placeholder="Text input" value="bulma">
                        <span class="icon is-small is-left">
                            <i class="fas fa-user"></i>
                        </span>
                        <span class="icon is-small is-right">
                            <i class="fas fa-check"></i>
                        </span>
                    </div>
                    <p class="help is-success">This username is available</p>
                </div> -->

                <div class="field">
                    <label class="label">Correo</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input " type="email" placeholder="Ingresar correo" value="" required autofocus>
                        <span class="icon is-small is-left">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <!-- <span class="icon is-small is-right">
                            <i class="fas fa-exclamation-triangle"></i>
                        </span> -->
                    </div>
                    <!-- <p class="help is-danger">This email is invalid</p> -->
                </div>

                <div class="field">
                    <label class="label">Contraseña</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input " type="password" placeholder="*****" value="">
                        <span class="icon is-small is-left">
                            <i class="fas fa-key"></i>
                        </span>
                        <!-- <span class="icon is-small is-right">
                            <i class="fas fa-check"></i>
                        </span> -->
                    </div>
                    <!-- <p class="help is-success">This username is available</p> -->
                </div>







                <!-- <div class="field">
                    <div class="control">
                        <label class="radio">
                            <input type="radio" name="question">
                            Yes
                        </label>
                        <label class="radio">
                            <input type="radio" name="question">
                            No
                        </label>
                    </div>
                </div> -->
                <br>
                <input type="button" class="button is-danger is-fullwidth" value="Iniciar"></button>

            </div>
        </div>
    </div>
    <!--  </div> -->


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