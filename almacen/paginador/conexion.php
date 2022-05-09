<?php
//Configuracion de la conexion a base de datos
$bd_host = "1283.5.8.85"; 
$bd_usuario = "farmacia"; 
$bd_password = "DTIdesa@2k271."; 
$bd_base = "almacen_farmacia"; 
//ini_set('mssql.charset', 'UTF-8');
$con = mssql_connect($bd_host, $bd_usuario, $bd_password); 
mssql_select_db($bd_base, $con); 
?>