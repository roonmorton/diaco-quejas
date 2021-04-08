<?php 
$path = 'comercioIndex';

session_start();
$idComercio = isset($_GET["comercio"]) ? $_GET["comercio"] : '';



if (isset($idComercio) && $idComercio != "") {
    require_once($_SERVER['DOCUMENT_ROOT'] . '/diaco-quejas/modelos/Comercio.php');
    $comercio = new Comercio();
    $comercio->id = $idComercio;
    $comercio->find();
}

if(isset($_POST)){
	if(isset($_POST["add"]) && $_POST["add"] == "1"){
        require_once($_SERVER['DOCUMENT_ROOT'].'/diaco-quejas/modelos/Sucursal.php');
  			$sucursal = new Sucursal();
  			$sucursal->set(
  				$_POST["pID"],
  				$_POST["pNombre"],
  				$_POST["pTelefono"],
  				$_POST["pDireccion"],
  				$_POST["pMunicipio"],
                  $idComercio

  			);
  			if($sucursal->add())
  				echo "<script>alert('Sucursal agregado Correctamente...');window.location.href = '/diaco-quejas/admin/comercios/sucursales?comercio=$idComercio'; </script>";
  			else
              $error = true;
	}elseif(isset($_POST["edit"]) && $_POST["edit"] == "1"){
        require_once($_SERVER['DOCUMENT_ROOT'].'/diaco-quejas/modelos/Sucursal.php');
        require_once($_SERVER['DOCUMENT_ROOT'].'/diaco-quejas/modelos/Departamento.php');
        require_once($_SERVER['DOCUMENT_ROOT'].'/diaco-quejas/modelos/Municipio.php');

        $departamento = new Departamento();
        $listaDepartamentos =  $departamento->list();
        $municipio = new Municipio();
        $listaMunicipios =  $municipio->list();

                $sucursal = new Sucursal();
                $sucursal->id = $_POST["pID"];
                $sucursal->find();
            }  
}else{
    header('Location: '.'/contacts/contacts/');
}

require_once($_SERVER['DOCUMENT_ROOT'].'/diaco-quejas/modelos/Pais.php');

                        $pais = new Pais();
                        $listaPaises =  $pais->list();

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
    <?php include('../../templates/navbar.php');?>
    <div class="columns is-desktop">
        <div class="column  is-2  has-background-light">
            <?php include('../../templates/sidenav.php');?>
        </div>
        <div class="column is-10 has-background-light" style="border-left: 1px solid #ccc;">
            <!-- Contenido -->
            <div class="container" style="padding: 2.5em  0;">
                <!-- <div class="columns is-desktop">
                    <div class="column is-6 ">
                        <h1 class="title is-4">
                            <span class="icon ">
                                <i class="fas fa-store"></i>
                            </span>
                            <span><?php echo isset($sucursal)  && $sucursal->id != '0' ? 'Editar' : 'Agregar'; ?> una
                                sucursal</span>
                        </h1>
                    </div>
                    <div class="column is-6 " style="text-align:right;">
                        <?php if( isset($sucursal)) { ?>
                        <h4 class="is-4" style="font-weight: bold;"> <?php echo $sucursal->actualizacion; ?> </h4>
                        <?php } ?>
                    </div>
                </div> -->
                <div class="columns is-desktop">
                    <div class="column is-6 ">
                        <h1 class="title is-4" style="margin-bottom: .5em;">
                            <span class="icon ">
                                <i class="fas fa-globe-americas"></i>
                            </span>
                            <span><?php echo isset($sucursal)  && $sucursal->id != '0' ? 'Editar' : 'Agregar'; ?> una
                                sucursal</span>
                        </h1>
                        <h5 class="title is-6">
                            <span><?php echo isset($comercio) && isset($comercio->nombre) && $comercio->nombre != '' ? $comercio->nombre : 'Comercio no valido...'; ?></span>
                        </h5>

                    </div>
                    <div class="column is-6 " style="text-align:right;">
                        <?php if (isset($pais)) { ?>
                        <h4 class="is-4" style="font-weight: bold;">
                            <?php echo isset($sucursal) ? $sucursal->actualizacion : ''; ?> </h4>
                        <?php } ?>
                    </div>
                </div>
                <div class="box" style="    padding-bottom: 2.5em; padding-top: 2.5em;">
                    <?php if (isset($comercio) && isset($comercio->nombre)) { ?>
                    <form action="" method="POST">
                        <input class="input" type="hidden" name="pID"
                            value="<?php echo isset($sucursal) ? $sucursal->id : '0'; ?>">
                        <input class="input" type="hidden" name="add" value="1">
                        <div class="field">
                            <label class="label">NOMBRE *</label>
                            <div class="control has-icons-left has-icons-right">
                                <input class="input " type="text" placeholder="Ingresar nombre para el comercio"
                                    autofocus name="pNombre" required=""
                                    value="<?php echo isset($sucursal) ? $sucursal->nombre : ''; ?>">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-tag"></i>
                                </span>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">TELEFONO </label>
                            <div class="control has-icons-left has-icons-right">
                                <input class="input " type="text" placeholder="Ingresar telefono para el comercio"
                                    autofocus name="pTelefono"
                                    value="<?php echo isset($sucursal) ? $sucursal->telefono : ''; ?>">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-phone-square-alt"></i>
                                </span>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">PAIS </label>

                            <div class="control has-icons-left " style="width:100%">
                                <div class="select " style="width:100%">
                                    <select required="" style="width:100%" id="sPaises" name="pPais">

                                        <?php if(isset($listaPaises) && count($listaPaises) >  0   ){ ?>
                                        <option selected value="">Seleccionar un pais</option>
                                        <?php foreach($listaPaises as $value){ ?>
                                        <option value="<?php echo $value['idPais']; ?>"
                                            <?php echo isset($sucursal) && isset($sucursal->idPais)? $sucursal->idPais == $value['idPais'] ? 'selected' :''  : ''; ?>>
                                            <?php echo $value['nombre']; ?>
                                        </option>
                                        <?php } ?>
                                        <?php } else { ?>
                                        <option selected value="">No hay paises registrados</option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <span class="icon is-left">
                                    <i class="fas fa-globe-americas"></i>
                                </span>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">DEPARTAMENTO </label>

                            <div class="control has-icons-left " style="width:100%">
                                <div class="select " style="width:100%">
                                    <select required="" style="width:100%" id="sDepartamentos" name="pDepartamento">
                                        <!-- <option selected value="">Seleccionar un departamento</option> -->

                                        <?php if(isset($listaDepartamentos) && count($listaDepartamentos) >  0   ){ ?>
                                        <option selected value="">Seleccionar un departamento</option>
                                        <?php foreach($listaDepartamentos as $value){ ?>
                                        <option value="<?php echo $value['idDepartamento']; ?>"
                                            <?php echo isset($sucursal) && isset($sucursal->idPais)? $sucursal->idDepartamento == $value['idDepartamento'] ? 'selected' :''  : ''; ?>>
                                            <?php echo $value['nombre']; ?>
                                        </option>
                                        <?php } ?>
                                        <?php } else { ?>
                                        <option selected value="">Seleccionar un departamento</option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <span class="icon is-left">
                                    <i class="fas fa-globe"></i>
                                </span>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">MUNICIPIO </label>

                            <div class="control has-icons-left " style="width:100%">
                                <div class="select " style="width:100%">
                                    <select required="" style="width:100%" id="sMunicipios" name="pMunicipio">
                                        <!-- <option selected value="">Seleccionar un municipio</option> -->

                                        <?php if(isset($listaMunicipios) && count($listaMunicipios) >  0   ){ ?>
                                        <option selected value="">Seleccionar un municipio</option>
                                        <?php foreach($listaMunicipios as $value){ ?>
                                        <option value="<?php echo $value['idMunicipio']; ?>"
                                            <?php echo isset($sucursal) && isset($sucursal->idPais)? $sucursal->idMunicipio == $value['idMunicipio'] ? 'selected' :''  : ''; ?>>
                                            <?php echo $value['nombre']; ?>
                                        </option>
                                        <?php } ?>
                                        <?php } else { ?>
                                        <option selected value="">Seleccionar un departamento</option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <span class="icon is-left">
                                    <i class="fas fa-globe"></i>
                                </span>
                            </div>
                        </div>


                        <div class="field">
                            <label class="label">DIRECCION </label>
                            <div class="control has-icons-left has-icons-right">
                                <input class="input " type="text" placeholder="Ingresar una direccion para el comercio"
                                    autofocus name="pDireccion"
                                    value="<?php echo isset($sucursal) ? $sucursal->direccion : ''; ?>">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-map-marker-alt"></i>
                                </span>
                            </div>
                        </div>

                        <!-- <div class="field">
                            <label class="label">DESCRIPCION</label>
                            <div class="control has-icons-left has-icons-right">
                                <textarea class="textarea" placeholder="Ingresar una descripcion para el comercio" name="pDescripcion">
                            <?php echo isset($sucursal) ? $sucursal->isoCode : ''; ?>
                            </textarea>
                            </div>
                        </div> -->
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
    <script>
    document.addEventListener('DOMContentLoaded', () => {

        document.getElementById("sPaises").onchange = function(evt) {
            var idPais = evt.target.value;
            if (idPais != '') {
                fetch('/diaco-quejas/admin/servicios.php?idPais=' + idPais)
                    .then(response => response.json())
                    .then(data => {
                        var select = document.getElementById('sDepartamentos');
                        var selectM = document.getElementById('sMunicipios')
                        var opt = document.createElement('option');
                        var optM = document.createElement('option');
                        select.innerHTML = "";
                        selectM.innerHTML = "";
                        opt.value = '';
                        opt.innerHTML = 'Seleccionar un departamento';
                        optM.value = '';
                        optM.innerHTML = 'Seleccionar un municipio';
                        select.appendChild(opt);
                        selectM.appendChild(optM);
                        if (data && Array.isArray(data)) {

                            for (let item of data) {
                                var opt2 = document.createElement('option');
                                opt2.value = item.idDepartamento;
                                opt2.innerHTML = item.nombre;
                                select.appendChild(opt2);
                            }
                        } else {
                            console.log("no es array");
                        }
                    });
            }
        };

        document.getElementById("sDepartamentos").onchange = function(evt) {
            var idDepartamento = evt.target.value;
            if (idDepartamento != '') {
                fetch('/diaco-quejas/admin/servicios.php?idDepartamento=' + idDepartamento)
                    .then(response => response.json())
                    .then(data => {
                        var select = document.getElementById('sMunicipios');
                        select.innerHTML = "";
                        if (data && Array.isArray(data)) {
                            var opt = document.createElement('option');
                            opt.value = '';
                            opt.innerHTML = 'Seleccionar un municipio';
                            select.appendChild(opt);
                            for (let item of data) {
                                var opt2 = document.createElement('option');
                                opt2.value = item.idMunicipio;
                                opt2.innerHTML = item.nombre;
                                select.appendChild(opt2);
                            }
                        }
                    });
            }
        };

    });
    </script>
</body>

</html>