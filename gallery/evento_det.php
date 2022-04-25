<!DOCTYPE html>
<html>
<head>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript" src="scripts/prototype.js"></script>
<script type="text/javascript" src="scripts/scriptaculous.js?load=effects"></script>
<script type="text/javascript" src="scripts/frog.js"></script>
<style type="text/css">
#FrogJS{
width: 100%;
height: 100%;
margin: 0 auto;
}
#FrogJSCredit{
text-align: right;
font-size: 80%;
color: #999;
padding: 1px;
}
#FrogJSCaption{
text-align: left;
line-height: 140%;
}
</style>
<link href="../helpdesk.css" rel="stylesheet" type="text/css">
</head>

<body>
<?
require_once('../connection/helpdesk.php');				
if (isset($ev))
	{
		$consulta = "SELECT * FROM galeriafotos where codigo_evento='$ev' and activo=1";
		$result=$query($consulta);						
		while($row=$fetch_array($result))
		{
			$titulo=$row["nombre_evento"];
			$lugar=$row["lugar"];
			$organizador=$row["organizador"];
			$fecha_inicio=$row["fecha_inicio"];
			$fecha_fin=$row["fecha_fin"];		
		}
	}
?>
<center>
<table width="100%" border="0">
  <tr>
    <td width="11%" class="detalletabla1">Evento</td>
    <td width="89%" class="detalletabla1"><? echo $titulo; ?></td>
  </tr>
  <tr>
    <td class="detalletabla2">Lugar</td>
    <td class="detalletabla2"><? echo $lugar; ?></td>
  </tr>
  <tr>
    <td><p class="detalletabla1">Organizado por</p>
    </td>
    <td class="detalletabla1"><? echo $organizador; ?></td>
  </tr>
  <tr>
    <td class="detalletabla2">Fecha</td>
    <td class="detalletabla2"><? echo "Del $fecha_inicio Al $fecha_fin"; ?></td>
  </tr>
</table>
</center>
<table width="100%">
<tr>
<td>
<div id="FrogJS">
<!-- <a href="images/1.jpg" title="Jolie Myers / The State News" rel="http://portfolio.statenews.com/users/Jolie_Myers/"> -->
<?
$qry_det_evento = "SELECT * FROM galeriafotosdet where codigo_evento='$ev' and activo=1";
$resp_det_evento=$query($qry_det_evento);						
while($fila_det_evento=$fetch_array($resp_det_evento))
{
  //echo '<a href="images/'.$fila_det_evento["fotogrande"].'" title="'.$fila_det_evento["titulo"].'">';
  echo '<a href="images/'.$fila_det_evento["carpeta"].'/'.$fila_det_evento["fotogrande"].'" title="'.$fila_det_evento["titulo"].'">';
  echo '<img src="images/'.$fila_det_evento["carpeta"].'/'.$fila_det_evento["fotopequena"].'" alt="'.$fila_det_evento["descripcion"].'"/></a>';
}
?>
<p align="left">&nbsp;</p>
</div></td>
</tr>
</table>
</body>
</html>
