<?
session_start();
	include('INCLUDES/inc_header.inc'); 
	$dbms=new DBMS($conexion); 
	$IdActividad = $_REQUEST['Id']; 
?> 
<label for="SubActividad3"></label> 
<!--select name="idasesor"  id="SubActividades3"  class="TituloMedios"--> 
<select name="id_asesor"  id="id_asesor" > 
<? 
	$conection = mssql_connect("server_appl","sa","sa") or die("no se puede conectar a SQL Server");
	mssql_select_db("RRHH",$conection);
	if ($_SESSION['sstipo'] == 3)
	 {
		$dbms->sql="select  idasesor, nombre, nombre2, nombre3, apellido, apellido2, apellidocasada from asesor where iddireccion = $IdActividad order by 2"; 
	 }
	else
	 {
	 $dbms->sql="select  idasesor, nombre, nombre2, nombre3, apellido, apellido2, apellidocasada from asesor where iddireccion = $IdActividad order by 2"; 
	 }
	$dbms->$sql;
	$dbms->Query(); 
	while($Fields=$dbms->MoveNext()) 
	{ 
//	 	 print "<option value=\"".$Fields["idasesor"]."\">".$Fields["nombre"].' '.$Fields["nombre2"].' '.$Fields["apellido"].' '.$Fields["apellido2"]."</option>"; 
	 	 print "<option value=\"".$Fields["idasesor"]."\">".$Fields["nombre"].' '.$Fields['nombre2'].' '.$Fields['apellido'].' '.$Fields['apellido2']."</option>"; 
	}
?> 
</select>
