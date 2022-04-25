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
		$vec[2] = "nombre";
		$vec[3] = "dependencia";
	
		$vec2[0] = "fecha";
		$vec2[1] = "hora";
		$vec2[2] = "nombre";
		$vec2[3] = "dependencia";
		$vec2[4] = "id_empleado";
	
		$vec3[0] = "width=\"10%\"";
		$vec3[1] = "width=\"10%\"";
		$vec3[2] = "width=\"10%\"";
		$vec3[3] = "width=\"70%\"";
	
		$query ="select CONVERT(nvarchar(10), fecha_creo, 103) as fecha,
	CONVERT(nvarchar(10), fecha_creo, 108) as hora, 
	nombre1 as Empleado,
	apellido1,id_empleado
	 from
	tb_empleado where 
	activo in ($mstatus)
	 order by fecha,hora desc";

		getTabla($query,1,$vec,$vec2,$vec3,$dbms,95,"","","ver/empleado_ver.php?id_empleado=");
	  ?>
</body>
</html>
