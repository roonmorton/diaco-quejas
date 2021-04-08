<?php 

require_once($_SERVER['DOCUMENT_ROOT'] .'/diaco-quejas/utilidades/Database.php');

class Queja {
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
		/* $query = 'SELECT *, (
			select count(1) from Pais_Region as pr where pr.idPais = p.idPais
		) as regiones FROM Pais as p ORDER BY idPais DESC'; */
		$query = 'SELECT * FROM Sucursal as p ORDER BY idSucursal DESC';
		return $this->db->queryResult($query);
	}

	public function busqueda($q){
		/* $query = "SELECT *, (
			select count(1) from Pais_Region as pr where pr.idPais = p.idPais
		) as regiones FROM Pais as p WHERE UPPER(nombre) LIKE UPPER('%$q%') ORDER BY idPais DESC"; */
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
			/* $this->regionesCount = $result["regionesCount"]; */
		}
		$this->db->close();
	}


/* 	public function findPaisDeRegion(){
		$query = "select  p.*, r.idRegion, r.nombre as nombreRegion, r.code as codeRegion, r.descripcion as descripcionRegion from Region as r
		inner join Pais_Region as pr
		on pr.idRegion = r.idRegion
		inner join Pais as p
		on pr.idPais = p.idPais
        where pr.idPais_Region = $this->idPaisRegion";
		$result = $this->db->queryResult($query);
		if(count($result) > 0){
			$result = $result[0];
			$this->id = $result["idPais"];
			$this->nombre = $result["nombre"];
			$this->isoCode = $result["isoCode"];
			$this->actualizacion = $result["actualizacion"];
			$this->creacion = $result["creacion"];
			$this->idRegion = $result["idRegion"];
			$this->nombreRegion = $result["nombreRegion"];
			$this->codeRegion = $result["codeRegion"];
			$this->descripcionRegion = $result["descripcionRegion"];

		}
	}

	public function regionesDePais($busqueda){
		$query = "select r.idRegion, r.nombre as nombreRegion, r.code as codeRegion, r.descripcion, temp.idPais_Region, temp.idPais, temp.nombre, temp.creacion,
		( select count(1) from Departamento as dp where dp.idPais_Region = temp.idPais_Region ) as departamentos 
		from Region as r 
		left join ( 
			select 
				pr.idPais_Region, 
				pr.idRegion, 
				pr.idPais, 
				pr.creacion, 
				pp.nombre from Pais_Region as pr 
				inner join Pais as pp 
				on pp.idPais = pr.idPais where pr.idPais = $this->id
		) as temp
		on temp.idRegion = r.idRegion";
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

	public function departamentosDeRegionPais($busqueda){
		$query = "select *, 
		(
			select count(1) from Municipio as m where m.idDepartamento = dep.idDepartamento
		) as municipios from Departamento as dep
		inner join Pais_Region as pr
		on pr.idPais_Region = dep.idPais_Region
		where dep.idPais_Region = $this->idPaisRegion  ";
		$result = $this->db->queryResult($query);
		return $result;
	} */


	public function cantidadQuejasUnMes() {
		$query = "select Date_format(q.creacion,'%M-%d') as dia, count(DAY(q.creacion)) as cantidad from Queja as q where creacion between date_add(NOW(), INTERVAL -1 MONTH) AND  NOW() group by DAY(q.creacion)";
		$result = $this->db->queryResult($query);
		$res = [
			"dias" => [],
			"quejas" => [],
		];
		 if(isset($result) && count($result) >  0   ){ 
			 foreach($result as $value){ 
				array_push($res["dias"], $value["dia"]);
				array_push($res["quejas"], $value["cantidad"]);

			 }
			}
		return $res;
	}

	public function __destroy(){
        $this->db->close();
    }
}

?>