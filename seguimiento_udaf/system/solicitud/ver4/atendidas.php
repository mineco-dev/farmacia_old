<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
</head>

<body>
<?


      	$vec[0] = "Fecha";
		$vec[1] = "Hora";
		$vec[2] = "Solicitante";
		$vec[3] = "Descripción";
	
		$vec2[0] = "fecha";
		$vec2[1] = "hora";
		$vec2[2] = "nombre";
		$vec2[3] = "observaciones";
		$vec2[4] = "id_documento";
	
		$vec3[0] = "width=\"10%\"";
		$vec3[1] = "width=\"10%\"";
		$vec3[2] = "width=\"10%\"";
		$vec3[3] = "width=\"70%\"";
	
		$query ="select CONVERT(nvarchar(10), d.fecha_creacion, 103) as fecha,
	CONVERT(nvarchar(10), d.fecha_creacion, 108) as hora, 
	d.id_nombre,d.estado, d.observaciones, d.id_gestion,d.id_documento,u.nombres+' '+u.apellidos as nombre
 from
	docs_udaf d
inner join usuario u
on d.id_nombre =u.codigo_usuario
	where 
d.estado in ('$mtstatus')
order by fecha_creacion desc";

		getTabla($query,4,$vec,$vec2,$vec3,$dbms,95,"","","../ver4/solicitud_ver.php?id_documento=");
		
	  ?>
</body>
</html>