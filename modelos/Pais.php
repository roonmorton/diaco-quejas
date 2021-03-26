<?php 

require_once($_SERVER['DOCUMENT_ROOT'] .'/diaco-quejas/utilidades/Database.php');

class Pais {
    public $id;
	public $nombre;
	public $isoCode;
	public $creacion;
	public $actualizacion;

	/* pais_region */

	public $idRegion; 
	public $nombreRegion; 
	public $codeRegion; 
	public $descripcionRegion; 
	public $idPaisRegion; 
	public $creacionPasiRegion; 


	private $db;

	function __construct(){
		$this->db = new DataBase();
		$this->id = 0;
	}

	public function set (
		$id,
		$nombre,
		$isoCode
	){
		$this->id = $id;
		$this->nombre = $nombre;
		$this->isoCode = $isoCode;
	}


	public function add(){
		$res = true;
		$query = "";
		if($this->id  == "0" ){
			$query ="INSERT INTO Pais (nombre, isoCode) VALUES ('$this->nombre', '$this->isoCode');";
		}else{
			$query = "UPDATE Pais SET nombre = '$this->nombre', isoCode = '$this->isoCode' WHERE idPais = '$this->id'";

		}
		if(!$this->db->query($query))
			$res = false;
		return $res;
	}

	public function delete(){
		$query = "DELETE FROM Pais WHERE idPais = $this->id";
		return $this->db->query($query);

	}

	public function list(){
		$query = 'SELECT * FROM Pais ORDER BY idPais DESC';
		return $this->db->queryResult($query);
	}

	public function busqueda($q){
		$query = "SELECT * FROM Pais WHERE UPPER(nombre) LIKE UPPER('%$q%') ORDER BY idPais DESC";
		return $this->db->queryResult($query);
	}

	public function find(){
		$query = "SELECT * FROM Pais WHERE idPais = $this->id";
		$result = $this->db->queryResult($query);
		if(count($result) > 0){
			$result = $result[0];
			$this->nombre = $result["nombre"];
			$this->isoCode = $result["isoCode"];
			$this->actualizacion = $result["actualizacion"];
			$this->creacion = $result["creacion"];
		}
	}


	public function regionesDePais(){
		$query = "select r.idRegion, r.nombre as nombreRegion, r.code as codeRegion, r.descripcion, pr.idPais_Region, p.idPais, p.nombre, pr.creacion from Region as r
		left join Pais_Region as pr
		on pr.idRegion = r.idRegion
		left join Pais as p
		on pr.idPais = p.idPais
		where p.idPais = $this->id OR p.idPais is null";
		$result = $this->db->queryResult($query);
		return $result;
	}


	public function addPaisRegion($idRegion){
		$query = "insert into Pais_Region(idRegion,idPais) values($idRegion,$this->id)";
		return $this->db->query($query);
	}

	public function eliminarPaisRegion($idRegion){
		$query = "delete from Pais_Region where idRegion = $idRegion and  idPais = $this->id";
		return $this->db->query($query);
	}

	public function __destroy(){
        $this->db->close();
    }
}

?>