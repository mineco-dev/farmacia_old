<?php
//Configuracion de la conexion a base de datos
// $bd_host = 'almacen-pc\DEV';
// $bd_usuario = "sa"; 
// $bd_password = "a$eggy$"; 
// $bd_base = "almacen"; 
// $con = mssql_connect($bd_host, 'sa', 'abc123'); 
$bd_host = '128.5.8.85';
$bd_usuario = "farmacia"; 
$bd_password = "DTIdesa@2K271."; 
$bd_base = "almacen_farmacia"; 
$con = mssql_connect($bd_host, $bd_usuario, $bd_password); 
mssql_select_db($bd_base, $con); 
?>