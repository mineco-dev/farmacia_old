<?
	require("../includes/funciones.php");
	require("../includes/sqlcommand.inc");	
?>
<?
$tipo_reporte="";
//evalua las opciones que vienen seteadas del generador de reportes
session_register("rpt_bodega");
$_SESSION["rpt_bodega"]=$_REQUEST["cbo_bodega"];
if ($_REQUEST["txt_numero"]!="")
{
	if ($_REQUEST["cbo_tipo_docto"]==1)
	{
		$tipo_reporte="rpt_despacho.php";  //para un reporte especifico por numero de despacho ingresado
		session_register("hoja_despacho");
		$_SESSION["hoja_despacho"]=$_REQUEST["txt_numero"];		
	}
		else
			if ($_REQUEST["cbo_tipo_docto"]==2)
			{
				session_register("ultimo_reg_egreso");
				$_SESSION["ultimo_reg_egreso"]=$_REQUEST["txt_numero"];
				$tipo_reporte="rpt_receta.php";  //para un reporte especifico por numero de receta egresada
			}
			else
			if ($_REQUEST["cbo_tipo_docto"]==12)
			{
				session_register("hoja_despacho");
				$_SESSION["hoja_despacho"]=$_REQUEST["txt_numero"];	
				$tipo_reporte="rpt_invent_inicial.php";  //para un reporte especifico por inventario inicial ingresado
			}
	session_register("no_documento");
	$_SESSION["no_documento"]=$_REQUEST["txt_numero"];
}
else
{
  if ($_REQUEST["select1"]!="0")
	{
		session_register("categoria");
		$_SESSION["categoria"]=$_REQUEST["select1"];  //para un reporte por categoria		
		if ($_REQUEST["select2"]!="0")
		{
			session_register("subcategoria");
			$_SESSION["subcategoria"]=$_REQUEST["select2"];  //para un reporte por subcategoria
			if ($_REQUEST["select3"]!="0")
			{
				session_register("producto");
				$_SESSION["producto"]=$_REQUEST["select3"];  //para un reporte por producto
			}	//fin producto
		}		//fin subcat
	} //fin de evaluacion de categoria	
	session_register("fecha_inicial");
	$_SESSION["fecha_inicial"]=$_REQUEST["date1"]; 
	session_register("fecha_final");
	$_SESSION["fecha_final"]=$_REQUEST["date2"]; 
	session_register("tipo_movimiento");
	$_SESSION["tipo_movimiento"]=$_REQUEST["cbo_tipo_mov"]; 
	if (isset($_REQUEST["otros"]))
	{
		$otro_reporte=$_REQUEST["otros"];	
		if ($otro_reporte=='KA') 
		{
			$tipo_reporte="rpt_kardex.php";  //para un reporte tipo kardex
		}
			else
			if ($otro_reporte=='TI') 
			{
				$tipo_reporte="rpt_inventario.php";  //para un reporte toma de inventario
			}
				else
				if ($otro_reporte=='EX') 
				{
					$tipo_reporte="rpt_existencias.php";  //para un reporte de saldos o existencias
				}
					else
					if ($otro_reporte=='IN') 
					{
						$tipo_reporte="rpt_ingreso_det.php";  //para un reporte de ingresos detallado
					}
						else
						if ($otro_reporte=='EG') 
						{
							$tipo_reporte="rpt_egreso_det.php";  //para un reporte de egresos detallado
						}
						else
						if ($otro_reporte=='VE') 
						{
							$tipo_reporte="rpt_vencimiento.php";  //para un reporte de egresos detallado
						}
	}	
}
?>
<!DOCTYPE html>
<html>
<head>
<script language="JavaScript">
function Abrir_ventana(pagina) 
	{
		var opciones="toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=700, height=400, top=85, left=140";
		window.open(pagina,"",opciones);
	}
</script>
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<?
if ($tipo_reporte!="") 
	{	
		echo "<body onload=Abrir_ventana('$tipo_reporte')>";
	}
	else 
	{
		echo "<body>";
	}
?>	
<table width="95%"  border="0">
  <tr>
    <td><div align="center">
      <p align="left"><a href="reportes.php"><img src="../images/iconos/ico_izquierda.gif" alt="Regresar al generador de reportes" width="58" height="30" border="0"></a></p>
      <p><img src="../images/reportes.gif" width="291" height="269"></p>
      <p><? echo $tipo_reporte; ?></p>
      </div></td>
  </tr>
</table>
</body>
</html>
