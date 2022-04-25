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
$idpublicacion = $_GET['idpublicacion'];
$query = "delete from tbl_publicacionarchivo where idpublicacion = $idpublicacion";
$dbms->sql = $query;
$dbms->QueryI();

$query = "delete from tbl_publicacion where idpublicacion = $idpublicacion";
$dbms->sql = $query;
$dbms->QueryI();
cambiar_ventana("boletines.php");
?>