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


	public function resumenSucursales($query){
		$query = "select s.nombre as sucursal, c.nombre as comercio, m.nombre as municipio,
		d.nombre as departamento, r.nombre as region,
		(select count(1) from Queja as q where q.idSucursal = s.idSucursal) as quejas 
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
		OR upper(r.nombre) like upper('%$query%') order by quejas DESC";
		$result = $this->db->queryResult($query);
		return $result;
	}



	public function resumenQuejas($query){
		$query = "select q.idQueja, q.nombre as usuario, q.descripcion, q.creacion, s.nombre as sucursal, c.nombre as comercio from Queja as q
		inner join Sucursal as s
		on s.idSucursal = q.idSucursal
		inner join Comercio as c 
		on c.idComercio = s.idComercio
		where s.nombre like '%$query%' OR c.nombre like '%$query%'";
		$result = $this->db->queryResult($query);
		return $result;
	}


	public function queja($idQueja){
		$query = "select 
		q.idQueja, 
		q.nombre as usuario, 
		q.descripcion, 
		q.solucion,
		q.creacion, 
		q.telefono,
		s.nombre as sucursal, 
		c.nombre as comercio,
		m.nombre as municipio,
		d.nombre as departamento,
		r.nombre as region,
		p.nombre as pais
		from Queja as q
	inner join Sucursal as s
	on s.idSucursal = q.idSucursal
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
	where q.idQueja = $idQueja";
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