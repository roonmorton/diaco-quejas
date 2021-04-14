<?php 

require_once($_SERVER['DOCUMENT_ROOT'] .'/diaco-quejas/utilidades/Database.php');

class Queja {
    public $id;
	public $nombre;
	public $descripcion;
	public $solucion;
	public $telefono;
	public $idSucursal;

	public $creacion;
	public $actualizacion;
	
/* 	public $idMunicipio; 
	public $idComercio;
	public $idDepartamento;
	public $idPais;
 */


	private $db;

	function __construct(){
		$this->db = new DataBase();
		$this->id = 0;
	}

	public function set (
		$id,
		$nombre,
		$descripcion,
		$solucion,
		$telefono,
		$idSucursal
	){
		$this->id = $id;
		$this->nombre = $nombre;
		$this->descripcion = $descripcion;
		$this->solucion = $solucion;
		$this->telefono = $telefono;
		$this->idSucursal = $idSucursal;

	}


	public function add(){
		$res = true;
		$query = "";
		if($this->id  == "0" ){
			$query ="INSERT INTO Queja (nombre, descripcion, solucion, telefono, idSucursal) VALUES ('$this->nombre', '$this->descripcion', '$this->solucion', '$this->telefono', '$this->idSucursal');";
		}else{
			$query = "UPDATE Queja SET nombre = '$this->nombre', descripcion = '$this->descripcion', solucion = '$this->solucion' , telefono = '$this->telefono', idSucursal = '$this->idSucursal' WHERE idQueja = '$this->id'";
		}
		if(!$this->db->query($query))
			$res = false;
		return $res;
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
		$query = "select Date_format(q.creacion,'%M-%d') as dia, count(DAY(q.creacion)) as cantidad from Queja as q where creacion between date_add(NOW(), INTERVAL -1 MONTH) AND  NOW() group by DAY(q.creacion) order by q.creacion ASC";
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