<?php 

require_once($_SERVER['DOCUMENT_ROOT'] .'/utilidades/DataBase.php');

class Queja {
    public $id;
	public $nombre;
	public $descripcion;
	public $solucion;
	public $telefono;
	public $idSucursal;

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