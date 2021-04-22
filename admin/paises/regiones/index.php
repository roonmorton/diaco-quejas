<?php
include($_SERVER['DOCUMENT_ROOT'] . '/utilidades/Sesion.php');
$path = 'paisIndex';
require_once($_SERVER['DOCUMENT_ROOT'] . '/modelos/Pais.php');



if (isset($_GET["pais"]) && $_GET["pais"] != "") {
    $idPais = $_GET['pais'];
    $pais = new Pais();
    $pais->id = $idPais;
    $pais->find();

    if (isset($_POST)) {
        if (isset($_POST["setRegionPais"]) && $_POST["setRegionPais"] == "1" && isset($pais)) {
            $idRegion = $_POST["pIdRegion"];
            $idRegionPais = $_POST["pIdPaisRegion"];
            if (!isset($idRegionPais) || $idRegionPais == '') {
                if ($pais->addPaisRegion($idRegion)) {
                    echo '<script>window.location.href = ""; </script>';
                } else {
                    echo '<script>alert("No se pudo agregar la region...");window.location.href = ""; </script>';
                }
            } else {
                if ($pais->eliminarPaisRegion($idRegion)) {
                    echo '<script>window.location.href = ""; </script>';
                } else {
                    echo '<script>alert("Region no se pudo eliminar...");window.location.href = ""; </script>';
                }
            }
        }
    }

    if (isset($_GET["busqueda"]) && $_GET["busqueda"] != "") {
        $busqueda = $_GET['busqueda'];
    } else {
        $busqueda = '';
    }
    if (isset($pais->isoCode)) {
        $lista = $pais->regionesDePais($busqueda);
    }
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
    <?php include('../../templates/navbar.php'); ?>
    <div class="columns is-desktop">
        <div class="column  is-2  has-background-light">
            <?php include('../../templates/sidenav.php'); ?>
        </div>
        <div class="column is-10 has-background-light" style="border-left: 1px solid #ccc;">
            <!-- Contenido -->
            <div class="container" style="padding: 2em  0;">
                <div class="columns is-desktop">
                    <div class="column is-6 ">
                        <h1 class="title is-3">
                            <span class="icon ">
                                <i class="fas fa-globe-americas"></i>
                            </span>
                            <span>Regiones en: <?php echo isset($pais) ? $pais->nombre : 'Pais no valido'; ?></span>
                        </h1>
                    </div>
                    <div class="column is-6 " style="text-align:right;">
                    </div>
                </div>
                <div class="">
                </div>
                <div class="box">
                    <table class="table is-striped is-hoverable is-fullwidth">
                        <thead>
                            <tr>
                                <th><abbr title="Position">#</abbr></th>
                                <th>REGION</th>
                                <th>DESCRIPCION</th>
                                <th>DEPARTAMENTOS</th>
                                <th>CREACION</th>
                                <th>ACTIVO</th>
                                <th>ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php if (isset($lista) && count($lista) >  0) { ?>
                                <?php $index = 1;
                                foreach ($lista as $value) { ?>
                                    <tr>
                                        <th>
                                            <?php echo $index; ?>
                                        </th>
                                        <td>
                                            <?php echo $value["nombreRegion"]; ?>
                                        </td>
                                        <td>
                                            <?php echo $value["descripcion"]; ?>
                                        </td>
                                        <td>
                                            <span class="tag is-danger is-medium"><?php echo $value["departamentos"]; ?></span>
                                        </td>
                                        <td>
                                            <?php echo $value["creacion"]; ?>
                                        </td>
                                        <td>
                                            <form method="POST" action="" style="padding-right: .2em; margin-bottom: 0">
                                                <input type="hidden" name="pIdRegion" value="<?php echo $value['idRegion']; ?>" />
                                                <input type="hidden" name="pIdPaisRegion" value="<?php echo $value['idPais_Region']; ?>" />

                                                <input class="input" type="hidden" name="setRegionPais" value="1" />
                                                <label class="checkbox">
                                                    <input type="checkbox" id="checkedRegion" <?php if (isset($value['idPais_Region']) && $value['idPais_Region'] != '') {
                                                                                                    echo "checked";
                                                                                                } ?> />
                                                </label>
                                            </form>
                                        </td>
                                        <td>
                                            <div class="buttons are-small">
                                                <?php if (isset($value['idPais_Region']) && $value['idPais_Region'] != '') { ?>
                                                    <a href="/admin/paises/regiones/departamentos/?region=<?php echo $value['idPais_Region']; ?>" class="button is-link is-outlined" title="Departamentos">
                                                        <span class="icon is-small">
                                                            <i class="fas fa-map-marked-alt"></i>
                                                        </span></a>
                                                <?php } ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php $index++;
                                } ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="7">
                                        <h3 class="subtitle">No se encontro ningun dato....</h3>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const $checkboxes = Array.prototype.slice.call(document.querySelectorAll('#checkedRegion'), 0);
            if ($checkboxes.length > 0) {
                $checkboxes.forEach(el => {
                    el.addEventListener('click', (event) => {
                        event.preventDefault();
                        if (confirm('Actualizar el registro registro?')) {
                            el.parentNode.parentNode.submit()
                        }
                    });
                });
            }


        });
    </script>
    <script src="/admin/recursos/js/funciones.js"></script>
</body>

</html>