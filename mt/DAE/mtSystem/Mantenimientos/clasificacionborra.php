<?
session_start();
require("../../includes/var.inc");
$raiz = "http://localhost:8585/dfchurch/";
require('../../includes/cnn/inc_header.inc');
require_once('../../includes/function.php');
$dbms=new DBMS($conexion);
$dbms->bdd=$database_cnn;
$dbms2=new DBMS($conexion);
$dbms2->bdd=$database_cnn;
$idclasificacion = $_GET['idclasificacion'];
$query = "delete from tbl_clasificacion where idclasificacion = $idclasificacion";
$dbms->sql = $query;
$dbms->QueryI();
cambiar_ventana("clasificacion.php");
?>