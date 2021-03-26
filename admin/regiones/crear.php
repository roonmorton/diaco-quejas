<?php 
$path = 'regionIndex';

session_start();

if(isset($_POST)){
	if(isset($_POST["add"]) && $_POST["add"] == "1"){
        require_once($_SERVER['DOCUMENT_ROOT'].'/diaco-quejas/modelos/Region.php'); 
  			$region = new Region();
  			$region->set(
  				$_POST["pID"],
  				$_POST["pNombre"],
  				$_POST["pCode"],
  				$_POST["pDescripcion"]
  			);
  			if($region->add())
  				echo '<script>alert("Region agregado Correctamente...");window.location.href = "/diaco-quejas/admin/regiones"; </script>';
  			else
              $error = true;
	}elseif(isset($_POST["edit"]) && $_POST["edit"] == "1"){
        require_once($_SERVER['DOCUMENT_ROOT'].'/diaco-quejas/modelos/Region.php');
                $region = new Region();
                $region->id = $_POST["pID"];
                $region->find();
            }  
}else{
    header('Location: '.'/contacts/contacts/');
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
            <div class="container" style="padding: 2.5em  0;">
                <div class="columns is-desktop">
                    <div class="column is-6 ">
                        <h1 class="title is-4">
                            <span class="icon ">
                                <i class="fas fa-flag"></i>
                            </span>
                            <span><?php echo isset($region) && $region->id != '0' ? 'Editar' : 'Agregar'; ?> una región</span>
                        </h1>
                    </div>
                    <div class="column is-6 " style="text-align:right;">
                        <?php if( isset($region)) { ?>
                        <h4 class="is-4" style="font-weight: bold;"> <?php echo $region->actualizacion; ?> </h4>
                        <?php } ?>
                    </div>
                </div>
                <div class="box" style="    padding-bottom: 2.5em; padding-top: 2.5em;">
                    <form action="" method="POST">
                        <input class="input" type="hidden" name="pID"
                            value="<?php echo isset($region) ? $region->id : '0'; ?>" />
                        <input class="input" type="hidden" name="add" value="1" />
                        <div class="field">
                            <label class="label">NOMBRE *</label>
                            <div class="control has-icons-left has-icons-right">
                                <input class="input " type="text" placeholder="Ingresar nombre para la region" autofocus
                                    name="pNombre" required=""
                                    value="<?php echo isset($region) ? $region->nombre : ''; ?>" />
                                <span class="icon is-small is-left">
                                    <i class="fas fa-layer-group"></i>
                                </span>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">CODIGO *</label>
                            <div class="control has-icons-left has-icons-right">
                                <input class="input " type="text" placeholder="Ingresar codigo unico como identificador para la región"
                                    name="pCode" required=""
                                    value="<?php echo isset($region) ? $region->code : ''; ?>" />
                                <span class="icon is-small is-left">
                                    <i class="fas fa-code"></i>
                                </span>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">DESCRIPCION</label>
                            <div class="control ">
                                <textarea class="textarea " type="number" placeholder="Ingresar una descripción"
                                    name="pDescripcion" ><?php echo isset($region) ? $region->descripcion : ''; ?></textarea>
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
                    <br>
                    <?php if(isset($error) && $error){ ?>
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