<?php
function conectar(){
    //ini_set('mssql.charset', 'UTF-8');
    $user = "farmacia";
    $pass = "DTIdesa@2K271.";
    $server  ="128.5.8.85";
    $db = "almacen_farmacia";
    $con =mssql_connect($server,$user,$pass,$db) or die ("Error al conectar a la base de datos");
    //mysqli_set_charset($con,"utf8");
    return $con;
}
?>