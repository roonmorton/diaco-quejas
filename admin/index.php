<?php 
$path = 'adminIndex';

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
        </div>
    </div>
    <script src="./recursos/js/funciones.js"></script>
</body>

</html>