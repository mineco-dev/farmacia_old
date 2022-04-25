<?
session_start();

require("../../includes/var.inc");
require('../../includes/cnn/inc_header.inc');
require_once('../../includes/function.php');
$dbms=new DBMS($conexion);
$dbms->bdd=$database_cnn;

$dbms->sql="delete from tbl_miembrotelefono";
$dbms->Query();
$dbms->sql="delete from tbl_miembroservicio";
$dbms->Query();
$dbms->sql="delete from tbl_miembrocorreo";
$dbms->Query();
$dbms->sql="delete from tbl_miembro";
$dbms->Query();

?>
</BODY>
</html>