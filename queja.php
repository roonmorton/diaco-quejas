<?php 
$path = 'quejaReporte';




require_once($_SERVER['DOCUMENT_ROOT'].'/modelos/Sucursal.php');

$idSucursal = isset($_GET["sucursal"]) ? $_GET["sucursal"] : "";

if($idSucursal != ''){
    $sucursal = new Sucursal();
    $laSucursal = $sucursal->obtenerInfoSucursal($idSucursal); 
}
  

if(isset($laSucursal) && $laSucursal["comercio"] != ""){

	if(isset($_POST["add"]) && $_POST["add"] == "1"){
        require_once($_SERVER['DOCUMENT_ROOT'].'/modelos/Queja.php');
  			$queja = new Queja();
  			$queja->set(
  				0,
  				$_POST["pNombre"],
  				$_POST["pDescripcion"],
  				$_POST["pSolucion"],
  				$_POST["pTelefono"],
  				$_POST["pID"]

  			);
  			if($queja->add())
  				echo '<script>alert("Queja registrada Correctamente...");window.location.href = "/"; </script>';
  			else
              $error = true;
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" />
</head>

<body class="has-background-light">



    <nav class="navbar is-danger " role="navigation" aria-label="main navigation">
        <div class="container">
            <div class="navbar-brand">
                <a class="navbar-item" href="">
                    <h2 class="subtitle is-family-secondary ">
                        <strong style="color: #fff">
                            Diaco - Quejas
                        </strong>
                    </h2>
                </a>

            </div>

        </div>
    </nav>
    <div class="container" style="padding: 2.5em  0;">
        <div class="columns is-desktop">
            <div class="column is-6 ">
                <h1 class="title is-4">
                    <span class="icon ">
                        <i class="fas fa-store"></i>
                    </span>
                    <span><?php echo isset($laSucursal)  && $laSucursal['comercio'] != '' ? 'Sucursal: ' .$laSucursal['comercio'] . ' - ' .$laSucursal['sucursal'] : 'Sucursal no valida'; ?>
                    </span>
                </h1>
            </div>
            <div class="column is-6 " style="text-align:right;">
            </div>
        </div>
        <div class="box" style="    padding-bottom: 2.5em; padding-top: 2.5em;">
            <?php if (isset($laSucursal) && isset($laSucursal['comercio'])) { ?>
            <form action="" method="POST">
                <input class="input" type="hidden" name="pID"
                    value="<?php echo isset($laSucursal) ? $laSucursal["idSucursal"] : '0'; ?>">
                <input class="input" type="hidden" name="add" value="1">
                <article class="message is-warning">
                    <div class="message-body">
                        Campos con <strong>*</strong> son requeridos...
                    </div>
                </article>
                <div class="columns is-desktop">
                    <div class="column is-6 ">
                        <div class="field">
                            <label class="label">DEPARTAMENTO</label>
                            <div class="control has-icons-left has-icons-right">
                                <input class="input " type="text" placeholder="" required="" disabled
                                    value="<?php echo isset($laSucursal) && isset($laSucursal['departamento']) ? $laSucursal['departamento'] : ''; ?>">
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
                                <input class="input " type="text" placeholder="" required="" disabled
                                    value="<?php echo isset($laSucursal) && isset($laSucursal['municipio']) ? $laSucursal['municipio'] : ''; ?>">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-flag"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- <div class="field">
                            <label class="label">SUCURSAL</label>
                            <div class="control has-icons-left has-icons-right">
                                <input class="input " type="text" placeholder="Region de comercio" required="" disabled
                                    value="<?php echo isset($queja) && isset($queja['comercio']) ? $queja['comercio'] . ' - ' .$queja['sucursal'] : ''; ?>">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-flag"></i>
                                </span>
                            </div>
                        </div> -->

                <div class="field">
                    <label class="label">DIRECCION</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input " type="text" placeholder="Direccion de la sucursal" autofocus required=""
                            disabled
                            value="<?php echo isset($laSucursal) && isset($laSucursal['direccion']) ? $laSucursal['direccion'] : ''; ?>">
                        <span class="icon is-small is-left">
                            <i class="fas fa-flag"></i>
                        </span>
                    </div>
                </div>
                <div class="field">
                    <label class="label">NOMBRE (opcional) </label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input " type="text" placeholder="Nombre de cliente" autofocus value="" name="pNombre">
                        <span class="icon is-small is-left">
                            <i class="fas fa-user"></i>
                        </span>
                    </div>
                </div>

                <div class="field">
                    <label class="label">TELEFONO (opcional) </label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input " type="text" placeholder="Telefono de cliente" value="" name="pTelefono">
                        <span class="icon is-small is-left">
                            <i class="fas fa-flag"></i>
                        </span>
                    </div>
                </div>

                <div class="field">
                    <label class="label"> DETALLE QUEJA *</label>
                    <div class="control ">
                        <textarea class="textarea " placeholder="Ingrese su queja" required="" name="pDescripcion"></textarea>
                    </div>
                </div>

                <div class="field">
                    <label class="label">SOLUCION *</label>
                    <div class="control ">
                        <textarea class="textarea " placeholder="Ingrese una solucion para su queja" name="pSolucion"
                            required=""></textarea>
                    </div>
                </div>

                <br>
                <button type="submit" class="button is-danger">
                    <span class="icon is-small">
                        <i class="fas fa-save"></i>
                    </span>
                    <span>Registrar</span>
                </button>

            </form>
            <?php } else { ?>
            <h5 class="title is-5">No se ha encontrado la sucursal...</h5>
            <?php } ?>
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

</body>

</html>