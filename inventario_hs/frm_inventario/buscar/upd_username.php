<?
require("../../../includes/funciones.php");
require("../../../includes/sqlcommand.inc");

//-----------------Consulta id de usuario en esta tabla y lo graba en un vector-----------------------
conectardb($inventarioopera);
$cnt=1;
$qry_consulta_responsable="select distinct(codigo_usuario_responsable) from tb_inventario_responsable_det";
$res_qry_consulta_responsable=$query($qry_consulta_responsable);	
while($row_qry_consulta_responsable=$fetch_array($res_qry_consulta_responsable))
{	
	$codigo_usuario[$cnt]=$row_qry_consulta_responsable["codigo_usuario_responsable"];	
	$cnt++;
}
//-----------------finaliza consulta-----------------------

//-----------------Consulta nombre de usuario de acuerdo al ID y lo graba en un vector-----------------------
conectardb($rrhh);	
$cnt=1;
while ($cnt<=count($codigo_usuario))
{
	$qry_consulta_responsable="select a.*, d.nombre as dependencia, d.nivel from asesor a 
								inner join tb_contratacion_gobierno c on a.idasesor=c.idasesor and c.oficial=1
								inner join direccion d on d.iddireccion=c.entidad_gobierno where a.idasesor='$codigo_usuario[$cnt]'";
	$res_qry_consulta_responsable=$query($qry_consulta_responsable);	
	while($row_qry_consulta_responsable=$fetch_array($res_qry_consulta_responsable))
	{
		$nombre_usuario[$cnt]=$row_qry_consulta_responsable["apellido"].' '.$row_qry_consulta_responsable["apellido2"].' '.$row_qry_consulta_responsable["apellidocasada"].', '.$row_qry_consulta_responsable["nombre"].' '.$row_qry_consulta_responsable["nombre2"].' '.$row_qry_consulta_responsable["nombre3"];
		$dependencia[$cnt]=$row_qry_consulta_responsable["dependencia"];
		$nivel[$cnt]=$row_qry_consulta_responsable["nivel"];
	}
	$cnt++;
}
//finaliza consulta de nombre

//----------------------Actualiza en la tabla el nombre del usuario consultado
conectardb($inventarioopera);
$cnt=1;
while ($cnt<=count($codigo_usuario))
{
	$qry_consulta_responsable="update tb_inventario_responsable_det set nombre_usuario_responsable='$nombre_usuario[$cnt]', dependencia='$dependencia[$cnt]', nivel='$nivel[$cnt]' where 	
								codigo_usuario_responsable='$codigo_usuario[$cnt]'";
	$respuesta=$query($qry_consulta_responsable);		
	$cnt++;	
}
if ($respuesta) echo "SE ACTUALIZO LA TABLA CORRECTAMENTE";
else echo "OCURRIO UN PROBLEMA EN LA ACTUALIZACION";

// finaliza actualizacion del nombre de usuario
?>