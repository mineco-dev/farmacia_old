<?
session_start();
require("../../includes/var.inc");
require('../../includes/cnn/inc_header.inc');
require_once('../../includes/function.php');
$dbms=new DBMS($conexion);
$dbms->bdd=$database_cnn;
$dbms2=new DBMS($conexion);
$dbms2->bdd=$database_cnn;
$idpublicacion = $_GET["idpublicacion"];
$datos = get_value("select *,
						date_format(fecha,'%d/%m/%Y') as fecha2, 
						if(confidencial=0,'No','Si') as confidencial 
					from tbl_publicacion where idpublicacion = $idpublicacion",$dbms);
?>

<p><?="Fecha: ".$datos["fecha2"]."<br>
		Nombre: ".$datos["nombre"]."<br>
		Descripci&oacute;n: ".$datos["descripcion"]?></p>

<p><small>Descargas:<br><br>
<?
	$dbms->sql="select nombre,url from tbl_publicacionarchivo where idpublicacion = $idpublicacion";
	$dbms->Query();
	$cnt = 1;
	while($Fields=$dbms->MoveNext())
	{
		print "<a href=\"../Publicaciones/".$Fields["url"]."\" target=\"_blank\"\>$cnt - ".$Fields["nombre"]."</a><br>";
		$cnt++;
	}
?>
</small></p>