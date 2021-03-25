<?php 
$path = 'paisIndex';
require_once($_SERVER['DOCUMENT_ROOT'].'/diaco-quejas/modelos/Pais.php');


/* $listaPaises = $pais->list(); */

if(isset($_POST)){
   if (isset($_POST["del"]) && $_POST["del"] == "1"){
  			$pais = new Pais();
  			$pais->id = $_POST["pID"];
  			if($pais->delete()){
                echo "eliminado";
                $pais = new Pais();
                $listaPaises = $pais->list();
                var_dump($listaPaises);
                echo '<script>alert("Contacto eliminado Correctamente...");window.location.href = ""; </script>';
              }
	}else {
    $pais = new Pais();
    $listaPaises = $pais->list();
    }
}else{
    $pais = new Pais();
    $listaPaises = $pais->list();
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
                                <i class="fas fa-globe-americas"></i>
                            </span>
                            <span>Paises</span>
                        </h1>
                    </div>
                    <div class="column is-6 " style="text-align:right;">
                        <a href="crear.php" class="button is-black" title="Agregar un pais">
                            <span class="icon is-small">
                                <i class="fas fa-plus-square"></i>
                            </span>
                            <span>Agregar</span>
                        </a>
                    </div>
                </div>
                <div class="box">
                    <table class="table is-striped is-hoverable is-fullwidth">
                        <thead>
                            <tr>
                                <th><abbr title="Position">#</abbr></th>
                                <th>NOMBRE</th>
                                <th>ISO</th>
                                <th>CREACION</th>
                                <th>ACTUALIZACION</th>
                                <th>ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php if(isset($listaPaises) && count($listaPaises) >  0   ){ ?>
                            <?php $index = 1; foreach($listaPaises as $value){ ?>

                            <tr>
                                <th>
                                    <?php echo $index; ?>
                                </th>
                                <td>
                                    <?php echo $value["nombre"]; ?>
                                </td>
                                <td>
                                    <?php echo $value["isoCode"]; ?>
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
                                            <input type="hidden" name="pID" value="<?php echo $value['idPais']; ?>">
                                            <input type="hidden" name="del" value="1">
                                            <button class="button is-danger is-outlined" title="Eliminar" type="submit"
                                                onclick="return confirm('Esta seguro de eliminar el registro?');">
                                                <span class="icon is-small ">
                                                    <i class="fas fa-trash"></i>
                                                </span></button>
                                        </form>

                                        <form method="POST" action="crear.php"
                                            style="padding-right: .2em; margin-bottom: 0">
                                            <input type="hidden" name="pID" value="<?php echo $value['idPais']; ?>">
                                            <input class="input" type="hidden" name="edit" value="1">
                                            <button class="button is-link is-outlined" title="Actualizar">
                                                <span class="icon is-small">
                                                    <i class="fas fa-edit"></i>
                                                </span></button>
                                        </form>
                                    </div>
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
    <script src="./recursos/js/funciones.js"></script>
</body>

</html>