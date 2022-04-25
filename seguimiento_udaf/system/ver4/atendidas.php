<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
</head>

<body>
<?

      	$vec[0] = "Fecha";
		$vec[1] = "Hora";
		$vec[2] = "Solicitante";
		$vec[3] = "Descripcion";
	
		$vec2[0] = "fecha";
		$vec2[1] = "hora";
		$vec2[2] = "solicitante";
		$vec2[3] = "observaciones";
		$vec2[4] = "id_documento";
	
		$vec3[0] = "width=\"10%\"";
		$vec3[1] = "width=\"10%\"";
		$vec3[2] = "width=\"10%\"";
		$vec3[3] = "width=\"70%\"";
	
		$query ="select CONVERT(nvarchar(10), fecha_creacion, 103) as fecha,
				CONVERT(nvarchar(10), fecha_creacion, 108) as hora, 
				solicitante,observaciones,id_documento
				from docs_udaf where estado in('$mtstatus')
				order by fecha_creacion desc";

		getTabla($query,4,$vec,$vec2,$vec3,$dbms,95,"","","../solicitud/ver/solicitud.php?id_documento=");
	  ?>
</body>
</html>
