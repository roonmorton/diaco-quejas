<?php
$path = 'paisIndex';

session_start();
$region = isset($_GET["region"]) ? $_GET["region"] : '';
if (isset($_POST["add"]) && $_POST["add"] == "1" && isset($region) && $region != "") {
    require_once($_SERVER['DOCUMENT_ROOT'] . '/diaco-quejas/modelos/Departamento.php');
    $departamento = new Departamento();
    $departamento->set(
        $_POST["pID"],
        $_POST["pNombre"],
        $region
    );
    if ($departamento->add())
        echo "<script>alert('Departamento agregado Correctamente...');window.location.href = '/diaco-quejas/admin/paises/regiones/departamentos/?region=$region'; </script>";
    else
        $error = true;
} elseif (isset($_POST["edit"]) && $_POST["edit"] == "1") {
    require_once($_SERVER['DOCUMENT_ROOT'] . '/diaco-quejas/modelos/Departamento.php');
    $departamento = new Departamento();
    $departamento->id = $_POST["pID"];
    $departamento->find();
}


if (isset($region) && $region != "") {
    require_once($_SERVER['DOCUMENT_ROOT'] . '/diaco-quejas/modelos/Pais.php');
    $pais = new Pais();
    $pais->idPaisRegion = $region;
    $pais->findPaisDeRegion();

}




?>

<!DOCTYPE html>
<html lang="en" style="height: 100%;">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Diaco - Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.2/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
</head>

<body class="has-background-light" style="height: 100%;">
    <?php include('../../../templates/navbar.php'); ?>
    <div class="columns is-desktop">
        <div class="column  is-2  has-background-light">
            <?php include('../../../templates/sidenav.php'); ?>
        </div>
        <div class="column is-10 has-background-light" style="border-left: 1px solid #ccc;">
            <!-- Contenido -->
            <div class="container" style="padding: 2.5em  0;">
                <div class="columns is-desktop">
                    <div class="column is-6 ">
                        <h1 class="title is-4" style="margin-bottom: .5em;">
                            <span class="icon ">
                                <i class="fas fa-globe-americas"></i>
                            </span>
                            <span><?php echo isset($departamento)  && $departamento->id != '0' ? 'Editar' : 'Agregar'; ?> un Departamento</span>
                        </h1>
                        <h5 class="title is-6">
                            <span><?php echo isset($pais) && $pais->id != '0' ? $pais->nombreRegion : 'Region no valida'; ?> de <?php echo isset($pais) && $pais->id != '0' ? $pais->nombre : 'Pais no valido'; ?></span>
                        </h5>

                    </div>
                    <div class="column is-6 " style="text-align:right;">
                        <?php if (isset($pais)) { ?>
                            <h4 class="is-4" style="font-weight: bold;"> <?php echo isset($departamento) ? $departamento->actualizacion : ''; ?> </h4>
                        <?php } ?>
                    </div>
                </div>
                <div class="box" style="    padding-bottom: 2.5em; padding-top: 2.5em;">
                    <?php if (isset($pais) && isset($pais->isoCode)) { ?>
                        <form action="" method="POST">
                            <input class="input" type="hidden" name="pID" value="<?php echo isset($departamento) ? $departamento->id : '0'; ?>">
                            <input class="input" type="hidden" name="add" value="1">
                            <div class="field">
                                <label class="label">NOMBRE *</label>
                                <div class="control has-icons-left has-icons-right">
                                    <input class="input " type="text" placeholder="Ingresar nombre para el departamento" autofocus name="pNombre" required="" value="<?php echo isset($departamento) ? $departamento->nombre : ''; ?>">
                                    <span class="icon is-small is-left">
                                        <i class="fas fa-globe"></i>
                                    </span>
                                </div>
                            </div>
                            <br>

                            <button type="submit" class="button is-danger">
                                <span class="icon is-small">
                                    <i class="fas fa-plus-square"></i>
                                </span>
                                <span>Guardar</span>
                            </button>
                        </form>
                    <?php } else { ?>
                        <h5 class="title is-5"> Nada para agregar o modificar....</h5>
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
    <script src="./recursos/js/funciones.js"></script>
</body>

</html>