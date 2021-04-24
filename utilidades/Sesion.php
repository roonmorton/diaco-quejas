<?php



session_start();
$uNombres = isset($_SESSION["nombres"]) ? $_SESSION["nombres"] : null;
$uApellidos = isset($_SESSION["apellidos"]) ? $_SESSION["apellidos"] : null;
$uUsuariro = isset($_SESSION["usuario"]) ? $_SESSION["usuario"] : null;
$salir = isset($_POST['salir']) ? $_POST['salir'] : '0';

var_dump($_SESSION);
echo "<br>";
var_dump($uNombres);
echo "<br>";
var_dump($uApellidos);
echo "<br>";

var_dump($uUsuariro);
echo "<br>";

var_dump($salir);

if ((!isset($uNombres) && !isset($uApellidos) && !isset($uUsuariro)) || ($salir == '1')) {
    require_once($_SERVER['DOCUMENT_ROOT'] . '/modelos/Usuario.php');
    $u = new Usuario();
    $u->cerrarSesion();
   // header('Location: '.'/admin/login.php');
}

?>
