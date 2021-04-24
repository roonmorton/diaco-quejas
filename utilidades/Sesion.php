<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$uNombres = isset($_SESSION["nombres"]) ? $_SESSION["nombres"] : null;
$uApellidos = isset($_SESSION["apellidos"]) ? $_SESSION["apellidos"] : null;
$uUsuariro = isset($_SESSION["usuario"]) ? $_SESSION["usuario"] : null;
$salir = isset($_POST['salir']) ? $_POST['salir'] : '0';



if ((!isset($uNombres) && !isset($uApellidos) && !isset($uUsuariro)) || ($salir == '1')) {
    require_once($_SERVER['DOCUMENT_ROOT'] . '/modelos/Usuario.php');
    $u = new Usuario();
    $u->cerrarSesion();
    header('Location: '.'/admin/login.php');
    exit();
}

?>
