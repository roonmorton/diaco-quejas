<?php 
    session_start();
    $uNombres = $_SESSION["nombres"];
    $uApellidos = $_SESSION["apellidos"];
    $uUsuariro = $_SESSION["usuario"];
    $salir = isset($_POST['salir']) ? $_POST['salir'] : '0' ;
    if((!isset($uNombres) && !isset( $uApellidos ) && !isset($uUsuariro )) || ( $salir == '1')){
        require_once($_SERVER['DOCUMENT_ROOT'].'/diaco-quejas/modelos/Usuario.php');
  	    $u = new Usuario();
        $u-> cerrarSesion();
    }

?>