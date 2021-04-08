<?php 

require_once($_SERVER['DOCUMENT_ROOT'] .'/diaco-quejas/utilidades/Database.php');

class Reporte {

	private $db;

	function __construct(){
		$this->db = new DataBase();

	}

	



	public function resumen(){
		$query = 'select * from (select count(1) as comercios from Comercio) as comercio, (select count(1) as sucursales from Sucursal) as sucursal, (select count(1) as regiones from Region) as region';
		$result = $this->db->queryResult($query);
		$res; 
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