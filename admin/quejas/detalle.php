<?php
include($_SERVER['DOCUMENT_ROOT'] . '/utilidades/Sesion.php');
$path = 'quejaReporte';
require_once($_SERVER['DOCUMENT_ROOT'] . '/modelos/Reportes.php');


$idQueja = isset($_GET["queja"]) ? $_GET["queja"] : "";

if ($idQueja != '') {
    $reporte = new Reporte();
    $queja = $reporte->queja($idQueja);
}

?>

<!DOCTYPE html>
<html lang="es" style="height: 100%;">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Diaco - Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.2/css/bulma.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
</head>

<body class="has-background-light" style="height: 100%;">
    <?php include('../templates/navbar.php'); ?>
    <div class="columns is-desktop">
        <div class="column  is-2  has-background-light">
            <?php include('../templates/sidenav.php'); ?>
        </div>
        <div class="column is-10 has-background-light" style="border-left: 1px solid #ccc;">
            <!-- Contenido -->

            <div class="container" style="padding: 2.5em  0;">
                <div class="columns is-desktop">
                    <div class="column is-6 ">
                        <h1 class="title is-4">
                            <span class="icon ">
                                <i class="fas fa-heart-broken"></i>
                            </span>
                            <span><?php echo isset($queja)  && $queja['creacion'] != '' ? 'Queja: ' . $queja['creacion'] : 'Queja no valida'; ?>
                            </span>
                        </h1>
                    </div>
                    <div class="column is-6 " style="text-align:right;">
                    </div>
                </div>
                <div class="box" style="    padding-bottom: 2.5em; padding-top: 2.5em;">
                    <?php if (isset($queja) && isset($queja['creacion'])) { ?>
                        <form action="" method="POST">
                            <div class="field">
                                <label class="label">PAIS</label>
                                <div class="control has-icons-left has-icons-right">
                                    <input class="input " type="text" placeholder="Pais de comercio" required="" disabled value="<?php echo isset($queja) && isset($queja['pais']) ? $queja['pais'] : ''; ?>">
                                    <span class="icon is-small is-left">
                                        <i class="fas fa-flag"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">REGION</label>
                                <div class="control has-icons-left has-icons-right">
                                    <input class="input " type="text" placeholder="Region de comercio" required="" disabled value="<?php echo (isset($queja) && isset($queja['region'])) ? $queja['region'] : ''; ?>">
                                    <span class="icon is-small is-left">
                                        <i class="fas fa-flag"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="columns is-desktop">
                                <div class="column is-6 ">
                                    <div class="field">
                                        <label class="label">DEPARTAMENTO</label>
                                        <div class="control has-icons-left has-icons-right">
                                            <input class="input " type="text" placeholder="" required="" disabled value="<?php echo isset($queja) && isset($queja['departamento']) ? $queja['departamento'] : ''; ?>">
                                            <span class="icon is-small is-left">
                                                <i class="fas fa-flag"></i>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                                <div class="column is-6 ">
                                    <div class="field">
                                        <label class="label">MUNICIPIO</label>
                                        <div class="control has-icons-left has-icons-right">
                                            <input class="input " type="text" placeholder="" required="" disabled value="<?php echo isset($queja) && isset($queja['municipio']) ? $queja['municipio'] : ''; ?>">
                                            <span class="icon is-small is-left">
                                                <i class="fas fa-flag"></i>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="field">
                                <label class="label">SUCURSAL</label>
                                <div class="control has-icons-left has-icons-right">
                                    <input class="input " type="text" placeholder="Region de comercio" required="" disabled value="<?php echo isset($queja) && isset($queja['comercio']) ? $queja['comercio'] . ' - ' . $queja['sucursal'] : ''; ?>">
                                    <span class="icon is-small is-left">
                                        <i class="fas fa-flag"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">NOMBRE</label>
                                <div class="control has-icons-left has-icons-right">
                                    <input class="input " type="text" placeholder="Nombre de cliente" autofocus required="" disabled value="<?php echo isset($queja) && isset($queja['usuario']) ? $queja['usuario'] : ''; ?>">
                                    <span class="icon is-small is-left">
                                        <i class="fas fa-user"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">TELEFONO</label>
                                <div class="control has-icons-left has-icons-right">
                                    <input class="input " type="text" placeholder="Telefono de cliente" required="" disabled value="<?php echo isset($queja) && isset($queja['telefono']) ? $queja['telefono'] : ''; ?>">
                                    <span class="icon is-small is-left">
                                        <i class="fas fa-phone"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label"> DETALLE QUEJA</label>
                                <div class="control ">
                                    <textarea class="textarea " placeholder="" disabled><?php echo isset($queja) && isset($queja['descripcion']) ? $queja['descripcion'] : ''; ?></textarea>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">SOLUCION</label>
                                <div class="control ">
                                    <textarea class="textarea " placeholder="" disabled><?php echo isset($queja) && isset($queja['solucion']) ? $queja['solucion'] : ''; ?></textarea>
                                </div>
                            </div>

                            <br>

                        </form>
                    <?php } else { ?>
                        <h5 class="title is-5">No se ha encontrado la queja...</h5>
                    <?php } ?>
                    <br>
                    <?php if (isset($error) && $error) { ?>
                        <div class="notification is-danger is-light">
                            <button class="delete"></button>
                            <strong>No se guardo el registro</strong>
                            , intentelo mas tarde...
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <script src="/admin/recursos/js/funciones.js"></script>
</body>

</html>