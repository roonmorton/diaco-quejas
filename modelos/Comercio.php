<?php 

require_once($_SERVER['DOCUMENT_ROOT'] .'/utilidades/DataBase.php');

class Comercio {
    public $id;
	public $nombre;
	public $descripcion;
	public $telefono;
	public $direccion;
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
		$telefono,
		$direccion,
		$descripcion
	){
		$this->id = $id;
		$this->nombre = $nombre;
		$this->telefono = $telefono;
		$this->direccion = $direccion;
		$this->descripcion = $descripcion;
	}


	public function add(){
		$res = true;
		$query = "";
		if($this->id  == "0" ){
			$query ="INSERT INTO Comercio (nombre, descripcion, telefono, direccion) VALUES ('$this->nombre', '$this->descripcion', '$this->telefono', '$this->direccion');";
		}else{
			$query = "UPDATE Comercio SET nombre = '$this->nombre', descripcion = '$this->descripcion', telefono = '$this->telefono' , direccion = '$this->direccion' WHERE idComercio = '$this->id'";
		}
		if(!$this->db->query($query))
			$res = false;
		return $res;
	}

	public function delete(){
		$query = "DELETE FROM Comercio WHERE idComercio = $this->id";
		return $this->db->query($query);

	}

	public function list(){
		$query = 'SELECT p.*, (
			select count(1) from Sucursal as s  where s.idComercio = p.idComercio ) as sucursales  FROM Comercio as p ORDER BY idComercio DESC';
		return $this->db->queryResult($query);
	}

	public function busqueda($q){
		$query = "SELECT p.*, (
			select count(1) from Sucursal as s  where s.idComercio = p.idComercio ) as sucursales  FROM Comercio as p WHERE UPPER(nombre) LIKE UPPER('%$q%') ORDER BY idComercio DESC";
		return $this->db->queryResult($query);
	}

	public function find(){
		$query = "SELECT * FROM Comercio WHERE idComercio = $this->id";
		$result = $this->db->queryResult($query);
		if(count($result) > 0){
			$result = $result[0];
			$this->nombre = $result["nombre"];
			$this->descripcion = $result["descripcion"];
			$this->telefono = $result["telefono"];
			$this->direccion = $result["direccion"];

			$this->actualizacion = $result["actualizacion"];
			$this->creacion = $result["creacion"];
		}
	}


	public function sucursalesDeComercio($busqueda){
		$query = "select s.* from Sucursal as s 
		inner join Comercio as c
		on c.idComercio = s.idComercio 
		where c.idComercio = $this->id";
		$result = $this->db->queryResult($query);
		return $result;
	}

	public function __destroy(){
        $this->db->close();
    }
}

?>