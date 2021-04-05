<?php 

require_once($_SERVER['DOCUMENT_ROOT'] .'/diaco-quejas/utilidades/Database.php');

class Municipio {
    public $id;
	public $nombre;
	public $creacion;
	public $actualizacion;
	public $idDepartamento;
	public $zipCode;



	private $db;

	function __construct(){
		$this->db = new DataBase();
		$this->id = 0;
	}

	public function set (
		$id,
		$nombre,
        $idDepartamento,
		$zipCode
	){
		$this->id = $id;
		$this->nombre = $nombre;
		$this->idDepartamento = $idDepartamento;
		$this->zipCode = $zipCode;
	}


	public function add(){

		$res = true;
		$query = "";
		if($this->id  == "0" ){
			$query ="INSERT INTO Municipio (nombre, idDepartamento, zipCode) VALUES ('$this->nombre', '$this->idDepartamento', '$this->zipCode');";
		}else{
			$query = "UPDATE Municipio SET nombre = '$this->nombre', zipCode = '$this->zipCode' WHERE idMunicipio = '$this->id'";
		}
		if(!$this->db->query($query))
			$res = false;
		return $res;
	}

	public function delete(){
		$query = "DELETE FROM Municipio WHERE idMunicipio = $this->id";
		return $this->db->query($query);

	}

	public function list(){
		$query = 'SELECT * FROM Municipio ORDER BY idMunicipio DESC';
		return $this->db->queryResult($query);
	}

	public function busqueda($q){
		$query = "SELECT * FROM Municipio WHERE UPPER(nombre) LIKE UPPER('%$q%') ORDER BY idMunicipio DESC";
		return $this->db->queryResult($query);
	}

	public function find(){
		$query = "SELECT * FROM Municipio WHERE idMunicipio = $this->id";
		$result = $this->db->queryResult($query)[0];
		$this->nombre = $result["nombre"];
		$this->creacion = $result["creacion"];
		$this->actualizacion = $result["actualizacion"];
		$this->idDepartamento = $result["idDepartamento"];
		$this->zipCode = $result["zipCode"];
	}

	public function __destroy(){
        $this->db->close();
    }
}
