<?php 
include($_SERVER['DOCUMENT_ROOT'].'/diaco-quejas/utilidades/Sesion.php');
$path = 'sucursalReporte';
require_once($_SERVER['DOCUMENT_ROOT'].'/diaco-quejas/modelos/Reportes.php');


$busqueda = isset($_GET["busqueda"]) ? $_GET["busqueda"] : "";
$reporte = new Reporte();
            $lista = $reporte->resumenSucursales($busqueda);
        
  
?>

<!DOCTYPE html>
<html lang="es" style="height: 100%;">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Diaco - Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.2/css/bulma.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" />
</head>

<body class="has-background-light" style="height: 100%;">
    <?php include('../templates/navbar.php');?>
    <div class="columns is-desktop">
        <div class="column  is-2  has-background-light">
            <?php include('../templates/sidenav.php');?>
        </div>
        <div class="column is-10 has-background-light" style="border-left: 1px solid #ccc;">
            <!-- Contenido -->

            <div class="container" style="padding: 2em  0;">
                <div class="columns is-desktop">
                    <div class="column is-6 ">
                        <h1 class="title is-3">
                            <span class="icon ">
                                <i class="fas fa-gem"></i>
                            </span>
                            <span>Sucursales</span>
                        </h1>
                    </div>
                    <div class="column is-6 " style="text-align:right;">
                    </div>
                </div>

                <div class="">
                    <form action="" method="GET" style="padding: 1em 0;">
                        <div class="field has-addons ">
                            <div class="control  is-expanded">
                                <input class="input" type="text" placeholder="Ingresar terminos de busqueda" autofocus
                                    name="busqueda" value="<?php echo isset($busqueda) ? $busqueda : ''; ?>" />
                            </div>
                            <div class="control">
                                <input class="button is-danger" value="Buscar" type="submit">
                            </div>
                        </div>
                    </form>

                </div>
                <div class="box">
                    <table class="table is-striped is-hoverable is-fullwidth">
                        <thead>
                            <tr>
                                <th><abbr title="Position">#</abbr></th>
                                <th>COMERCIO</th>
                                <th>REGION</th>
                                <th>DEPARTAMENTO</th>
                                <th>MUNICIPIO</th>
                                <th>QUEJAS</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php if(isset($lista) && count($lista) >  0   ){ ?>
                            <?php $index = 1; foreach($lista as $value){ ?>
                            <tr>
                                <th>
                                    <?php echo $index; ?>
                                </th>
                                <td>
                                    <?php echo $value["comercio"] . ' - ' . $value["sucursal"]; ?>
                                </td>
                                <td>
                                    <?php echo $value["region"]; ?>
                                </td>
                                <td>
                                    <?php echo $value["departamento"]; ?>
                                </td>
                                <td>
                                    <?php echo $value["municipio"]; ?>
                                </td>
                                <td>
                                    <span class="tag is-danger is-medium"><?php echo $value["quejas"]; ?></span>
                                </td>
                               
                            </tr>
                            <?php $index++; } ?>
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
    <script src="/diaco-quejas/admin/recursos/js/funciones.js"></script>
</body>

</html>