<?php 
echo $_SERVER['DOCUMENT_ROOT']. '/modelos/Sucursal.php' . '<br>';
require ('./modelos/Sucursal.php');
$busqueda = isset($_GET["busqueda"]) ? $_GET["busqueda"] : '';
$sucursal = new Sucursal();
$sucursales = $sucursal->resumenSucursales($busqueda);
?>

<!DOCTYPE html>
<html lang="en" style="height: 100%;">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Diaco - Quejas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.2/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />

</head>

<body class="has-background-light" style="height: 100%;">

    <nav class="navbar is-danger " role="navigation" aria-label="main navigation">
        <div class="container">
            <div class="navbar-brand">
                <a class="navbar-item" href="https://bulma.io">
                    <h2 class="subtitle is-family-secondary ">
                        <strong style="color: #fff">
                            Diaco - Quejas
                        </strong>
                    </h2>
                </a>

            </div>

        </div>
    </nav>

    <div class="section container">
        <h4 class="title is-4">Registro de quejas </h4>

        <div class="">
            <form action="" method="GET">
                <div class="field has-addons ">
                    <div class="control  is-expanded">
                        <input class="input" type="text" placeholder="Ingresar terminos de busqueda" autofocus name="busqueda" value="<?php echo isset($busqueda) ? $busqueda : ''; ?>" />
                    </div>
                    <div class="control">
                        <input class="button is-danger" value="Buscar" type="submit">
                    </div>
                </div>
            </form>
            <br>
            <article class="message is-link">
                <div class="message-body">
                    Busca la sucursal a la que quieras ingresar una queja...
                </div>
            </article>
            <div class="box">
                <table class="table is-striped is-hoverable is-fullwidth">
                    <thead>
                        <tr>
                            <th><abbr title="Position">#</abbr></th>
                            <th>COMERCIO</th>
                            <th>SUCURSAL</th>
                            <th>TELEFONO</th>
                            <th>DIRECCION</th>
                            <th>DEPARTAMENTO</th>
                            <th>MUNICIPIO</th>
                            <th>ACCIONES</th>

                        </tr>
                    </thead>
                    <tbody>

                        <?php if (isset($sucursales) && count($sucursales) >  0) { ?>
                            <?php $index = 1;
                            foreach ($sucursales as $value) { ?>
                                <tr>
                                    <th>
                                        <?php echo $index; ?>
                                    </th>
                                    <td>
                                        <?php echo $value["comercio"]; ?>
                                    </td>
                                    <td>
                                        <?php echo $value["sucursal"]; ?>
                                    </td>
                                    <td>
                                        <?php echo $value["telefono"]; ?>
                                    </td>
                                    <td>
                                        <?php echo $value["direccion"]; ?>
                                    </td>
                                    <td>
                                        <?php echo $value["departamento"]; ?>
                                    </td>
                                    <td>
                                        <?php echo $value["municipio"]; ?>
                                    </td>
                                    <td>
                                        <div class="buttons are-small">
                                            <a href="/queja.php?sucursal=<?php echo $value['idSucursal']; ?>" class="button is-danger is-outlined" title="Registrar queja">
                                                <span class="icon is-small">
                                                    <i class="fas fa-heart-broken"></i>
                                                </span></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php $index++;
                            } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="8">
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
</body>

</html>