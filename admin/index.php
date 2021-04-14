<?php 
include($_SERVER['DOCUMENT_ROOT'].'/diaco-quejas/utilidades/Sesion.php');

$path = 'adminIndex';


require_once($_SERVER['DOCUMENT_ROOT'].'/diaco-quejas/modelos/Queja.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/diaco-quejas/modelos/Reportes.php');

$queja = new Queja();
    $quejas = $queja->cantidadQuejasUnMes();

    $reporte = new Reporte();
    $resumen = $reporte->resumen();


?>

<!DOCTYPE html>
<html lang="en" style="height: 100%;">

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

<body class="has-background-light" style="height: 100%;">
    <?php include('./templates/navbar.php');?>
    <div class="columns is-desktop">
        <div class="column  is-2 ">
            <?php include('./templates/sidenav.php');?>
        </div>
        <div class="column is-10" style="border-left: 1px solid #ccc;">


            <!-- Contenido -->

            <div class="container" style="padding: 2em  0;">
                <div class="columns is-desktop">
                    <div class="column is-6 ">
                        <h1 class="title is-3">
                            <span class="icon ">
                                <i class="fas fa-home"></i>
                            </span>
                            <span>Inicio</span>
                        </h1>
                    </div>
                    <div class="column is-6 " style="text-align:right;">
                    </div>
                </div>
                <div class="columns is-desktop  is-4" style="margin-top: 1.5em;">
                    <div class="column is-3 " >
                        <div class="box">
                        <h3 class="title is-4">
                            <span class="icon ">
                                <i class="fas fa-store-alt"></i>
                            </span>
                            <span>Comercios</span>
                        </h3>
                        <h1 class="title is-1">
                            <?php echo isset($resumen) && isset($resumen["comercios"]) ? $resumen["comercios"] : '' ; ?>
                        </h1></div>
                    </div>
                    <div class="column is-3 " >
                    <div class="box">
                    <h3 class="title is-4">
                            <span class="icon ">
                                <i class="fas fa-store"></i>
                            </span>
                            <span>Sucursales</span>
                        </h3>
                        <h1 class="title is-1">
                            <?php echo isset($resumen) && isset($resumen["sucursales"]) ? $resumen["sucursales"] : '' ; ?>
                        </h1>
                    </div>
                    </div>
                    <div class="column is-3 " >
                    <div class="box">
                    <h3 class="title is-4">
                            <span class="icon ">
                                <i class="fas fa-flag"></i>
                            </span>
                            <span>Regiones</span>
                        </h3>
                        <h1 class="title is-1 ">
                            <?php echo isset($resumen) && isset($resumen["regiones"]) ? $resumen["regiones"] : '' ; ?>
                        </h1>
                    </div>
                        

                    </div>
                    
                </div>

                <div class="box" style="margin-rigth: 10px">
                        <h3 class="title is-4" style="text-align:center">
                            <span class="icon ">
                                <i class="fas fa-heart-broken"></i>
                            </span>
                            <span>Quejas</span>
                        </h3>
                        <h1 class="title is-1 " style="text-align:center">
                            <?php echo isset($resumen) && isset($resumen["quejas"]) ? $resumen["quejas"] : '' ; ?>
                        </h1>

                    </div>
                <div class="box" style="margin-top: 2em;">

                    <div class="columns is-desktop" style="padding: .8rem .8rem 0 0.8rem">
                        <div class="column is-6 " style="padding: 0;">
                            <h3 class="title is-4" style="margin-bottom: .5em;">
                                <span class="icon ">
                                    <i class="fas fa-chart-area"></i>
                                </span>
                                <span>Quejas</span>
                            </h3>
                        </div>
                        <div class="column is-6 " style="text-align:right; padding: 0;">
                            <!-- <a href="crear.php" class="button is-black" title="Agregar un pais">
                            <span class="icon is-small">
                                <i class="fas fa-plus-square"></i>
                            </span>
                            <span>Agregar</span>
                        </a> -->
                        </div>
                    </div>
                    <!--  <hr style="margin: 0;"> -->
                    <canvas id="myChart" width="400" height="120"></canvas>

                </div>
                <!-- <div class="box">

                </div> -->
            </div>

        </div>
    </div>
    <script src="./recursos/js/funciones.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [
                <?php if(isset($quejas["quejas"] )){ foreach ($quejas["dias"] as $valor) { echo "'$valor',"; } }?>
            ],
           
            datasets: [{
                label: 'Quejas',
                data: [
                    <?php $max = 0; if(isset($quejas["quejas"] )){ foreach ($quejas["quejas"] as $valor) {  
                        $max = $valor > $max ? $valor : $max;
                        echo $valor.',';
                         } }?>
                ],
                fill: 'start',
                borderColor: '#f14668',
                backgroundColor: '#fb9fb2',
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    suggestedMax: <?php echo $max+1 ;?>,
                },
            },
            plugins: {
                filler: {
                    propagate: false,
                },
                title: {
                    display: true,
                }
            },
            interaction: {
                intersect: false,
            }
        }
    });
    </script>
</body>

</html>