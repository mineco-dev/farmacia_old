<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
</head>
<body>
<?php
$usuario_id=($_SESSION["user_id"]);
//print($usuario_id);
?>
<?php
//$jefe = ($_POST['cbo_jefe']); 

      	$vec[0] = "No.";
		$vec[1] = "Fecha Solicitud";
		$vec[2] = "Solicitante";
		$vec[3] = "Dependencia";
	    $vec[4] = "Fecha Aprobo";
		$vec[5] = "Fecha Autorizo";
		$vec[6] = "Fecha Despacho";
		
		
		
		$vec2[0] = "codigo_requisicion_enc";
		$vec2[1] = "fecha_requisicion";
		$vec2[2] = "solicitante";
		$vec2[3] = "nombre";
		$vec2[4] = "fecha_aprobacion";
		$vec2[5] = "fecha_autorizado";
		$vec2[6] = "fecha_despacho";
		$vec2[7] = "codigo_requisicion_enc";
		
	
		
		$vec3[0] = "width=\"4%\"";
		$vec3[1] = "width=\"12%\"";
		$vec3[2] = "width=\"20%\"";
		$vec3[3] = "width=\"20%\"";
		$vec3[4] = "width=\"12%\"";
		$vec3[5] = "width=\"12%\"";
		$vec3[6] = "width=\"12%\"";
	
// where codigo_estatus in (4,$mtstatus)

		 $query ="select CONVERT(nvarchar(10), fechahora, 103) as fecha,
						CONVERT(nvarchar(10), fechahora, 108) as hora, 
						nombre as solicitante,
						pregunta,idsolicitud
				 from
					tbl_solicitud
				 where 
				 	idstatus in ($mtstatus)
				 order by fechahora desc";

       $query ="select e.fecha_requisicion,
				 e.solicitante, d.nombre, e.codigo_requisicion_enc, e.fecha_aprobacion, e.fecha_autorizado, e.fecha_despacho
				from tb_requisicion_enc e
				inner join direccion d
				on e.codigo_dependencia = d.iddireccion
				where codigo_estatus in ($mtstatus)
				order by fecha_requisicion desc"; 

      $query2 ="select e.fecha_requisicion,
				 e.solicitante, d.nombre, e.codigo_requisicion_enc, e.fecha_aprobacion, e.fecha_autorizado, e.fecha_despacho, e.codigo_jefe_dependencia
				from tb_requisicion_enc e
				inner join direccion d
				on e.codigo_dependencia = d.iddireccion
				and codigo_estatus in ($mtstatus)
				--where e.codigo_jefe_dependencia = '$usuario_id' 
				order by fecha_requisicion desc ";
if ($mtstatus=="3") {
 	getTabla2($query2,7,$vec,$vec2,$vec3,$dbms,95,"","","ver/solicitud_aprobar.php?id=");
 }

if ($mtstatus=="4") {
 	getTabla2($query,7,$vec,$vec2,$vec3,$dbms,95,"","","ver/solicitud_autorizar.php?id=");
 }
 
if ($mtstatus==="5") {
	getTabla2($query,7,$vec,$vec2,$vec3,$dbms,95,"","","ver/solicitud_despachar.php?id=");
 }

		
	  ?>
</body>
</html>
