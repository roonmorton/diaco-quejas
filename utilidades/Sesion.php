<?php 
    if(session_status() != 2)
        session_start();


        $uNombres = !empty($_SESSION["nombres"]) ? $_SESSION["nombres"] : null;
        $uApellidos = !empty($_SESSION["apellidos"]) ? $_SESSION["apellidos"] : null;
        $uUsuariro = !empty($_SESSION["usuario"]) ? $_SESSION["usuario"] : null;
        $salir = !empty($_POST['salir']) ? $_POST['salir'] : '0' ;
    

    if((!isset($uNombres) && !isset( $uApellidos ) && !isset($uUsuariro )) || ( $salir == '1')){
        require_once($_SERVER['DOCUMENT_ROOT'].'/diaco-quejas/modelos/Usuario.php');
  	    $u = new Usuario();
        $u-> cerrarSesion();
    }

?>