<?php 

require_once($_SERVER['DOCUMENT_ROOT'] .'/utilidades/DataBase.php');

class Usuario{

    public $id;
    public $usuario;
    public $contrasenia; 
    public $nombres; 
    public $apellidos;

 
	private $db;

	function __construct(){
		$this->db = new DataBase();
		$this->id = 0;
	}
    
    public function set (
		$usuario,
		$contrasenia
	){
		$this->usuario = $usuario;
		$this->contrasenia = $contrasenia;
	}


    public function iniciarSesion(){
        $query = "select * from Usuario where upper(correo)= upper('$this->usuario') and contrasenia = md5('$this->contrasenia')";
		$result = $this->db->queryResult($query);
        $res = false;

		if(count($result) > 0){
			$result = $result[0];
			session_start();
            $_SESSION["nombres"] = $result['nombres'];
            $_SESSION["apellidos"] = $result['apellidos'];
            $_SESSION["usuario"] = $result['correo'];
            $res = true;
		}
		$this->db->close();
        return $res;
    }

    public function cerrarSesion(){
        unset($_SESSION["nombres"]);
        unset($_SESSION["apellidos"]);
        unset($_SESSION["usuario"]);
        session_destroy();
    }


       
	public function __destroy(){
        $this->db->close();
    }
    
}


?>