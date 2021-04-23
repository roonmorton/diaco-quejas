<?php 

require_once($_SERVER['DOCUMENT_ROOT'] .'/utilidades/DataBase.php');

class Departamento {
    public $id;
	public $nombre;
	public $creacion;
	public $actualizacion;
	public $idPaisRegion;

	public $idDepartamento; 
	public $nombrePais; 
	public $idPais; 
	public $paisIsoCode;



	private $db;

	function __construct(){
		$this->db = new DataBase();
		$this->id = 0;
	}

	public function set (
		$id,
		$nombre,
        $idPaisRegion
	){
		$this->id = $id;
		$this->nombre = $nombre;
		$this->idPaisRegion = $idPaisRegion;
	}


	public function add(){

		$res = true;
		$query = "";
		if($this->id  == "0" ){
			$query ="INSERT INTO Departamento (nombre, idPais_Region) VALUES ('$this->nombre', '$this->idPaisRegion');";
		}else{
			$query = "UPDATE Departamento SET nombre = '$this->nombre' WHERE idDepartamento = '$this->id'";
		}
		if(!$this->db->query($query))
			$res = false;
		return $res;
	}

	public function delete(){
		$query = "DELETE FROM Departamento WHERE idDepartamento = $this->id";
		return $this->db->query($query);

	}

	public function list(){
		$query = 'SELECT * FROM Departamento ORDER BY idDepartamento DESC';
		return $this->db->queryResult($query);
	}

	public function busqueda($q){
		$query = "SELECT * FROM Departamento WHERE UPPER(nombre) LIKE UPPER('%$q%') ORDER BY idDepartamento DESC";
		return $this->db->queryResult($query);
	}

	public function find(){
		$query = "SELECT * FROM Departamento WHERE idDepartamento = $this->id";
		$result = $this->db->queryResult($query)[0];
		$this->nombre = $result["nombre"];
		$this->creacion = $result["creacion"];
		$this->actualizacion = $result["actualizacion"];
		$this->idPaisRegion = $result["idPais_Region"];
		$this->db->close();
	}

	public function findPaisDeDepartamento(){
		$query = "select dep.idDepartamento, dep.nombre, dep.idPais_Region as idPaisRegion, p.idPais, p.nombre as nombrePais, p.isoCode from Departamento as dep 
		inner join Pais_Region as pr
		on pr.idPais_Region = dep.idPais_Region
		inner join Pais as p
		on p.idPais = pr.idPais
		where dep.idDepartamento = $this->id";
		$result = $this->db->queryResult($query);
		if(count($result) > 0){
			$result = $result[0];
			$this->nombre = $result["nombre"];
			$this->paisIsoCode = $result["isoCode"];
			$this->idPais = $result["idPais"];
			$this->idPaisRegion = $result["idPaisRegion"];
			$this->nombrePais = $result["nombrePais"];
		}
	}


	public function municipiosDeDepartamento($busqueda){
		$query = "select m.* from Departamento as dep 
		inner join Municipio as m
		on m.idDepartamento = dep.idDepartamento
		where dep.idDepartamento = $this->id";
		$result = $this->db->queryResult($query);
	
		return $result;
	}

	public function __destroy(){
        $this->db->close();
    }
}
