<?PHP
require("../includes/funciones.php");
require("../includes/sqlcommand.inc");

$cat=$_REQUEST['cat'];
$subcat=$_REQUEST['subcat'];
$codprod=$_REQUEST['codp'];

?>


<?PHP
if (isset($_REQUEST["txt_id"]))
{	
		$rowid=$_REQUEST["txt_id"];
        $fecha_vence=$_POST["txt_fecha_v"];
        $ingreso=$_POST["txt_cant"];
		$lote=strtoupper($_REQUEST["txt_lote"]);
		conectardb($almacen);
		$nombre_usuario=$_SESSION["user_name"];
		$qry_cambia_stat="UPDATE lotes_existencia SET fecha_vence='$fecha_vence', ingreso=$ingreso, lote='$lote' WHERE rowid='$rowid'";
		$query($qry_cambia_stat);
}

?>
<script>
	window.close()
</script>