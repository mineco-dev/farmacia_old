<?
	include('INCLUDES/inc_header.inc'); 
	$dbms=new DBMS($conexion); 
	 
	$IdActividad = $_REQUEST['Id']; 
?> 
<label for="SubActividad"></label> 
<select name="SubActividades"  id="SubActividades"  class="TituloMedios"> 
<? 
	$conection = mssql_connect("server_appl","sa","sa") or die("no se puede conectar a SQL Server");
	 mssql_select_db("RRHH",$conection);

	$dbms->sql="select idmunicipio,nombre_municipio from asesor_municipio where iddepartamento = $IdActividad"; 
	$dbms->Query(); 
	while($Fields=$dbms->MoveNext()) 
	{
		print "<option value=\"".$Fields["idmunicipio"]."\">".$Fields["nombre_municipio"]."</option>"; 
	}
?> 
</select>
