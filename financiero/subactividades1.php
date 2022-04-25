<?
	include('conectarse.php');
	include('INCLUDES/inc_header.inc'); 
	$dbms=new DBMS($conexion); 
	$IdActividad = $_REQUEST['Id']; 
?> 
<label for="SubActividad1"></label> 
<!--select name="idasesor"  id="SubActividades3"  class="TituloMedios"--> 
<select name="SubActividades1"  id="SubActividades1"  class="TituloMedios"> 
<? 
/*	$dbms->sql="select  id_renglon, renglon, ident_renglon from grupo where id_renglon = $IdActividad"; 
	$dbms->Query(); 
	while($Fields=$dbms->MoveNext()) 
	{
		print "<option value=\"".$Fields["id_renglon"]."\">".$Fields["ident_renglon"]." ".$Fields["renglon"]."</option>"; 
	}
*/	
	$sql="select  id_renglon, renglon, ident_renglon from grupo where id_renglon = $IdActividad"; 
	$result = mssql_query($sql);
	while($rows = mssql_fetch_array($result))
	{
		print "<option value=\"".$row["id_renglon"]."\">".$row["ident_renglon"]." ".$row["renglon"]."</option>"; 
	}

?> 
</select>

<?
 envia_msg("select  id_renglon, renglon, ident_renglon from grupo where id_renglon = $IdActividad");  ?>