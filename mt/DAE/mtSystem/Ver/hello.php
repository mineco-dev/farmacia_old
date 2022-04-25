<?
session_start();
require("../../includes/var.inc");
require('../../includes/cnn/inc_header.inc');
require_once('../../includes/function.php');
$dbms=new DBMS($conexion);
$dbms->bdd=$database_cnn;
$dbms2=new DBMS($conexion);
$dbms2->bdd=$database_cnn;
$iddetalle = $_GET["iddetalle"];
?>

<p>Hello</p>

<p><small><? 
	print "hola mundo $iddetalle" ;
	?> This is not keeping a list anymore because of all the dill-holes who posted inappropriate in here, go abuse your own stuff ;)</small></p>
