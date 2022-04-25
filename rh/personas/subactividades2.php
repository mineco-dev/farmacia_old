<?
	include('../includes/inc_header_sistema.inc'); 
	/*$dbms=new DBMS($conexion); */
	$IdActividad = $_REQUEST['Id']; 
?> 
<label for="SubActividad2"></label> 
<select name="idgrupo2"  id="SubActividades2"  class="TituloMedios"> 
<? 

$sql = "select codigo_municipio, nombre_municipio from tb_municipio where codigo_departamento =$IdActividad";
			$result = mssql_query($sql);
			while ($res = mssql_fetch_array($result))
			  { 
			  	
				?>
					<option value="<? echo $res['codigo_municipio']; ?>" selected><? echo $res['nombre_municipio']; ?></option>
				
					

			<? } ?>

<?
/*
	$dbms->sql="select codigo_municipio,nombre_municipio from tb_municipio where codigo_departamento = $IdActividad"; 
	$dbms->Query(); 
	while($Fields=$dbms->MoveNext()) 
	{
		print "<option value=\"".$Fields["codigo_municipio"]."\">".$Fields["nombre_municipio"]."</option>"; 
	}*/
?> 
</select>
