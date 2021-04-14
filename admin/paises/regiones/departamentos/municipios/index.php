<?php
include($_SERVER['DOCUMENT_ROOT'].'/diaco-quejas/utilidades/Sesion.php');
$path = 'paisIndex';
require_once($_SERVER['DOCUMENT_ROOT'] . '/diaco-quejas/modelos/Departamento.php');



if (isset($_GET["departamento"]) && $_GET["departamento"] != "") {
    $idDepartamento = $_GET['departamento'];
    /* $pais = new Pais();
    $pais->idPaisRegion = $idRegion;
    $pais->findPaisDeRegion(); */

    $departamento = new Departamento();
    $departamento->id = $idDepartamento;
    $departamento->findPaisDeDepartamento();

    if (isset($_POST["del"]) && $_POST["del"] == "1") {
        require_once($_SERVER['DOCUMENT_ROOT'] . '/diaco-quejas/modelos/Municipio.php');
        $Municipio = new Municipio();
        $Municipio->id = $_POST["pID"];
        if ($Municipio->delete()) {
            echo '<script>alert("Municipio eliminado Correctamente...");window.location.href = ""; </script>';
        }else{
            echo '<script>alert("Municipio no se pudo eliminar...");window.location.href = ""; </script>';
        }
    } /* else {
        $pais = new Pais();
        if (isset($_GET["busqueda"]) && $_GET["busqueda"] != "") {
            $busqueda = $_GET['busqueda'];
            $listaPaises = $pais->busqueda($busqueda);
        } else {
            $listaPaises = $pais->list();
        }
    } */



    if (isset($_GET["busqueda"]) && $_GET["busqueda"] != "") {
        $busqueda = $_GET['busqueda'];
    } else {
        $busqueda = '';
    }


    if (isset($departamento->paisIsoCode)) {
        $lista = $departamento->municipiosDeDepartamento($busqueda);
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
    <?php include('../../../../templates/navbar.php'); ?>
    <div class="columns is-desktop">
        <div class="column  is-2  has-background-light">
            <?php include('../../../../templates/sidenav.php'); ?>
        </div>
        <div class="column is-10 has-background-light" style="border-left: 1px solid #ccc;">
            <!-- Contenido -->

            <div class="container" style="padding: 2em  0;">
                <div class="columns is-desktop">
                    <div class="column is-6 ">
                        <h2 class="title is-4">
                            <span class="icon ">
                                <i class="fas fa-globe"></i>
                            </span>
                            <span><?php echo isset($departamento)  && isset($departamento->paisIsoCode) ? ($departamento->nombre . " / $departamento->nombrePais ") : 'Departamento no valido'; ?> </span>
                        </h2>

                    </div>
                    <div class="column is-6 " style="text-align:right;">
                        <?php if (isset($departamento) && isset($departamento->paisIsoCode)) { ?>
                            <a href="crear.php?departamento=<?php echo isset($idDepartamento) ? $idDepartamento : ''; ?>" class="button is-black" title="Agregar un departamento">
                                <span class="icon is-small">
                                    <i class="fas fa-plus-square"></i>
                                </span>
                                <span>Agregar</span>
                            </a>
                        <?php } ?>
                    </div>
                </div>


                <div class="">

                    <!-- <form action="" method="GET" style="padding: 1em 0;">
                        <input class="input" type="hidden" name="departamento" value="<?php echo isset($idDepartamento) ? $idDepartamento : ''; ?>" />
                        <div class="field has-addons ">
                            <div class="control  is-expanded">
                                <input class="input" type="text" placeholder="Ingresar terminos de busqueda" autofocus name="busqueda" value="<?php echo isset($busqueda) ? $busqueda : ''; ?>" />
                            </div>
                            <div class="control">
                                <input class="button is-danger" value="Buscar" type="submit">
                            </div>
                        </div>
                    </form> -->

                </div>
                <div class="box">
                    <table class="table is-striped is-hoverable is-fullwidth">
                        <thead>
                            <tr>
                                <th><abbr title="Position">#</abbr></th>
                                <th>NOMBRE</th>
                                <th>CODIGO ZIP</th>
                                <th>CREACION</th>
                                <th>ACTUALIZACION</th>
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
                                            <?php echo $value["nombre"]; ?>
                                        </td>
                                        <td>
                                            <?php echo $value["zipCode"]; ?>
                                        </td>
                                        <td>
                                            <?php echo $value["creacion"]; ?>
                                        </td>
                                        <td>
                                            <?php echo $value["actualizacion"]; ?>
                                        </td>
                                        <td>
                                            <div class="buttons are-small">
                                                <form method="POST" action="" style="padding-right: .2em; margin-bottom: 0">
                                                    <input type="hidden" name="pID" value="<?php echo $value['idMunicipio']; ?>" />
                                                    <input type="hidden" name="del" value="1" />
                                                    <button class="button is-danger is-outlined" title="Eliminar" type="submit" onclick="return confirm('Esta seguro de eliminar el registro?');">
                                                        <span class="icon is-small ">
                                                            <i class="fas fa-trash"></i>
                                                        </span>
                                                    </button>
                                                </form>
                                                <form method="POST" action="crear.php?departamento=<?php echo isset($idDepartamento) ? $idDepartamento : ''; ?>" style="padding-right: .2em; margin-bottom: 0">
                                                    <input type="hidden" name="pID" value="<?php echo $value['idMunicipio']; ?>" />
                                                    <input class="input" type="hidden" name="edit" value="1" />
                                                    <button class="button is-link is-outlined" title="Actualizar">
                                                        <span class="icon is-small">
                                                            <i class="fas fa-edit"></i>
                                                        </span></button>
                                                </form>
                                               <!--  <?php if (isset($value['idMunicipio']) && $value['idMunicipio'] != '') { ?>
                                                    <a href="/diaco-quejas/admin/paises/regiones/departamentos/municipios/?departamento=<?php echo $value['idMunicipio']; ?>" class="button is-link is-outlined" title="Municipios">
                                                        <span class="icon is-small">
                                                            <i class="fas fa-map-marked-alt"></i>
                                                        </span></a>
                                                <?php } ?> -->
                                            </div>
                                        </td>
                                    </tr>
                                <?php $index++;
                                } ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="6">
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
        /*  document.addEventListener('DOMContentLoaded', () => {
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


        }); */
    </script>
    <script src="/diaco-quejas/admin/recursos/js/funciones.js"></script>
</body>

</html>