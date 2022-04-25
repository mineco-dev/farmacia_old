<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
</head>

<body>

<?

require("../../includes/funciones.php");
require("../../includes/sqlcommand.inc");
	conectardb($reloj);
	$qry_name="select * from userinfo = ".$_REQUEST['userid']." ";	

					$res_qry_name=$query($qry_name);	

					echo('<select name="cbo_name">');
					$nombre=":: Seleccione ::";
					echo'<option value="0">'.$name.'</option>';
					while($row_name=$fetch_array($res_qry_name))
					{
						echo'<option value="'.$row_name["userid"].'">'.$row_name["name"].'</option>';
					}
					echo('</select>');				
					$free_result($res_qry_name);
					?>

</body>
</html>
