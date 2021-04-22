<?php 

require_once($_SERVER['DOCUMENT_ROOT'] .'utilidades/Database.php');

class Region {
    public $id;
	public $nombre;
	public $code;
	public $descripcion; 
	public $creacion;
	public $actualizacion;

	private $db;

	function __construct(){
		$this->db = new DataBase();
		$this->id = 0;
	}

	public function set (
		$id,
		$nombre,
		$code,
		$descripcion
	){
		$this->id = $id;
		$this->nombre = $nombre;
		$this->code = $code;
		$this->descripcion = $descripcion;
	}


	public function add(){

		$res = true;
		$query = "";
		if($this->id  == "0" ){
			$query ="INSERT INTO Region (nombre, code,descripcion) VALUES ('$this->nombre', '$this->code', '$this->descripcion');";
		}else{
			$query = "UPDATE Region SET nombre = '$this->nombre', code = '$this->code', descripcion = '$this->descripcion' WHERE idRegion = '$this->id'";
		}
		if(!$this->db->query($query))
			$res = false;
		return $res;
	}

	public function delete(){
		$query = "DELETE FROM Region WHERE idRegion = $this->id";
		return $this->db->query($query);

	}

	public function list(){
		$query = 'SELECT * FROM Region ORDER BY idRegion DESC';
		return $this->db->queryResult($query);
	}

	public function busqueda($q){
		$query = "SELECT * FROM Region WHERE UPPER(nombre) LIKE UPPER('%$q%') ORDER BY idRegion DESC";
		return $this->db->queryResult($query);
	}

	public function find(){
		$query = "SELECT * FROM Region WHERE idRegion = $this->id";
		$result = $this->db->queryResult($query)[0];
		$this->nombre = $result["nombre"];
		$this->code = $result["code"];
		$this->descripcion = $result["descripcion"];
		$this->actualizacion = $result["actualizacion"];
		$this->creacion = $result["creacion"];
	}

	public function __destroy(){
        $this->db->close();
    }
}

?>