
-- Crear Usuario
insert into Usuario(nombres, apellidos, correo,contrasenia) values('Admin','Admin','admin',md5('admin1342'));


-- Escriba en SQL estándar el script para la inserción de una queja para el comercio “YYYY”, en el municipio de Cobán, Alta Verapaz.
INSERT INTO Queja(nombre, telefono, descripcion, solucion,idSucursal) 
values('','','Esto es la descripcion de una queja ', 'Solucion de la queja', (
	SELECT idSucursal from Sucursal as s where s.nombre = 'YYYY'
));

-- Escriba en SQL estándar el script para editar el nombre del comercio “XXX”
UPDATE Comercio set nombre = 'Nuevo nombre'  where idComercio = 5;


-- Listado de quejas recibidas en rango de fechas
select q.idQueja, q.nombre as usuario, q.telefono, q.descripcion, q.solucion, q.creacion, s.nombre as sucursal, c.nombre as comercio from Queja as q
		inner join Sucursal as s
		on s.idSucursal = q.idSucursal
		inner join Comercio as c 
		on c.idComercio = s.idComercio
		where s.nombre like '%$query%' OR c.nombre like '%$query%' OR DATE(q.creacion) BETWEEN STR_TO_DATE('2021/04/14', '%Y/%m/%d') AND STR_TO_DATE('2021/04/14', '%Y/%m/%d') order by q.idQueja DESC;


-- Se desea saber el conteo de quejas por comercio-sucursal en la región norte y sur, que se haya realizado durante este año, y que no haya tenido ninguna queja para el comercio en la región oriente durante este año.

select  concat(c.nombre, ' - ', s.nombre)  as 'comercio-sucursal', r.nombre as region from Queja as q
inner join Sucursal as s
on q.idSucursal = s.idSucursal
inner join Comercio as c
on c.idComercio = s.idComercio
inner join Municipio as m
on m.idMunicipio = s.idMunicipio
inner join Departamento as d
on d.idDepartamento = m.idDepartamento
inner join Pais_Region as pr
on pr.idPais_Region =  d.idPais_Region
inner join Region as r 
on r.idRegion = pr.idRegion

; 


