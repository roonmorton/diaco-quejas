<?php 

if($_GET){
    $idPais = isset($_GET["idPais"]) && $_GET["idPais"] != "" ? $_GET["idPais"] : '';
    $idDepartamento = isset($_GET["idDepartamento"]) && $_GET["idDepartamento"] != "" ? $_GET["idDepartamento"] : '';

    if($idPais != ''){
    require_once($_SERVER['DOCUMENT_ROOT'].'modelos/Pais.php');
    $pais = new Pais();
    $pais->id = $idPais;
    $list =  $pais->departamentosDePais('');
    header('Content-type: application/json');
    echo json_encode( $list );
    }else if($idDepartamento != ''){
        require_once($_SERVER['DOCUMENT_ROOT'].'modelos/Departamento.php');
    $departamento = new Departamento();
    $departamento->id = $idDepartamento;
    $list =  $departamento->municipiosDeDepartamento('');
    header('Content-type: application/json');
    echo json_encode( $list );

    }

}
    
?>