<?php
//Configuracion de la conexion a base de datos
$bd_host = "128.5.8.85"; 
$bd_usuario = "farmacia"; 
$bd_password = "DTIdesa@2K271."; 
$bd_base = "almacen_farmacia"; 
$con = mssql_connect($bd_host, $bd_usuario, $bd_password); 
mssql_select_db($bd_base, $con); 
?>