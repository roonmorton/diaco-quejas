<?php 

require_once($_SERVER['DOCUMENT_ROOT'] .'utilidades/Database.php');

class Sucursal {
    public $id;
	public $nombre;
	public $telefono;
	public $direccion;
	public $creacion;
	public $actualizacion;
	
	public $idMunicipio; 
	public $idComercio;
	public $idDepartamento;
	public $idPais;



	private $db;

	function __construct(){
		$this->db = new DataBase();
		$this->id = 0;
	}

	public function set (
		$id,
		$nombre,
		$telefono,
		$direccion,
		$idMunicipio,
		$idComercio
	){
		$this->id = $id;
		$this->nombre = $nombre;
		$this->telefono = $telefono;
		$this->direccion = $direccion;
		$this->idMunicipio = $idMunicipio;
		$this->idComercio = $idComercio;

	}


	public function add(){
		$res = true;
		$query = "";
		if($this->id  == "0" ){
			$query ="INSERT INTO Sucursal (nombre, telefono, direccion, idMunicipio, idComercio) VALUES ('$this->nombre', '$this->telefono', '$this->direccion', '$this->idMunicipio', '$this->idComercio');";
		}else{
			$query = "UPDATE Sucursal SET nombre = '$this->nombre', idMunicipio = '$this->idMunicipio', telefono = '$this->telefono' , direccion = '$this->direccion', idComercio = '$this->idComercio' WHERE idSucursal = '$this->id'";
		}
		if(!$this->db->query($query))
			$res = false;
		return $res;
	}

	public function delete(){
		$query = "DELETE FROM Sucursal WHERE idSucursal = $this->id";
		return $this->db->query($query);

	}

	public function list(){
		$query = 'SELECT * FROM Sucursal as p ORDER BY idSucursal DESC';
		return $this->db->queryResult($query);
	}

	public function busqueda($q){
		$query = "SELECT * FROM Sucursal as p WHERE UPPER(nombre) LIKE UPPER('%$q%') ORDER BY idComercio DESC";
		return $this->db->queryResult($query);
	}

	

	public function find(){
		$query = "SELECT s.*, d.idDepartamento, pr.idPais FROM Sucursal as s 
		inner join Municipio as m 
		on m.idMunicipio = s.idMunicipio
		inner join Departamento as d 
		on d.idDepartamento = m.idDepartamento
		inner join Pais_Region pr 
		on pr.idPais_Region = d.idPais_Region
		 WHERE idSucursal = $this->id";
		$result = $this->db->queryResult($query);
		if(count($result) > 0){
			$result = $result[0];
			$this->nombre = $result["nombre"];
			$this->idComercio = $result["idComercio"];
			$this->idMunicipio = $result["idMunicipio"];
			$this->idDepartamento = $result["idDepartamento"];
			$this->idPais = $result["idPais"];
			$this->telefono = $result["telefono"];
			$this->direccion = $result["direccion"];
			$this->actualizacion = $result["actualizacion"];
			$this->creacion = $result["creacion"];
		}
		$this->db->close();
	}

	public function resumenSucursales($query){
		$query = "select s.idSucursal, s.nombre as sucursal, s.direccion, s.telefono, c.nombre as comercio, m.nombre as municipio,
		d.nombre as departamento, r.nombre as region
		 from Sucursal as s 
		inner join Comercio as c 
		on c.idComercio = s.idComercio
		inner join Municipio as m 
		on m.idMunicipio = s.idMunicipio
		inner join Departamento as d 
		on d.idDepartamento = m.idDepartamento
		inner join Pais_Region as pr
		on pr.idPais_Region = d.idPais_Region
		inner join Region as r 
		on r.idRegion = pr.idRegion
		where upper(s.nombre) like upper('%$query%') 
		OR upper(c.nombre) like upper('%$query%') OR upper(m.nombre) like upper('%$query%') 
		OR upper(r.nombre) like upper('%$query%') order by c.nombre, s.nombre ASC";
		$result = $this->db->queryResult($query);
		return $result;
	}


	public function obtenerInfoSucursal($idSucursal){
		$query = "select
		s.idSucursal,
		s.direccion,
		s.nombre as sucursal, 
		c.nombre as comercio,
		m.nombre as municipio,
		d.nombre as departamento,
		r.nombre as region,
		p.nombre as pais
		from  Sucursal as s
	inner join Comercio as c 
	on c.idComercio = s.idComercio
	inner join Municipio as m
	on m.idMunicipio = s.idMunicipio
	inner join Departamento as d 
	on d.idDepartamento = m.idDepartamento
	inner join Pais_Region as pr
	on pr.idPais_Region = d.idPais_Region
	inner join Region as r
	on r.idRegion = pr.idRegion
	inner join Pais as p
	on p.idPais = pr.idPais
    where idSucursal = $idSucursal";
		$result = $this->db->queryResult($query);
		$res = null; 
		if(isset($result) && count($result) >  0   ){ 
			$res = $result[0];
		   }
		return $res;
	}


	public function __destroy(){
        $this->db->close();
    }
}

?>