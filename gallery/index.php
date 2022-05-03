<?
	$grupo_id=1;	
	include("../restringir.php");		
?>
<?	if (isset($hoy))
	{
		$consulta = "SELECT * FROM galeriafotos where codigo_evento='$hoy' and activo=1 order by codigo_evento desc";
	}
	else
	{
		if (isset($txt_buscar)) 
		{	
			if ($txt_buscar!="")
			{
				$consulta = "SELECT * FROM galeriafotos where activo=1 and nombre_evento like '%$txt_buscar%' order by codigo_evento desc";
			}
			else
			{
				$consulta = "SELECT * FROM galeriafotos where activo=1 order by codigo_evento desc";
			}
		}
		else
		{
			$consulta = "SELECT * FROM galeriafotos where activo=1 order by codigo_evento desc";
		}
	}		
?>
<html>
<head>
<link href="../helpdesk.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<style type="text/css">
<!--
.Estilo3 {color: #FFFFFF}
-->
</style>
<script LANGUAGE="JavaScript">
function Validar(form)
{
  if (form.txt_buscar.value == "")
  { 
  	alert("Escriba palabras clave para realizar la b�squeda"); 
	form.txt_buscar.focus(); 
	return;
  }  
  form.submit();
}
function Refrescar(form)
{
	form.reset();
	form.txt_buscar.focus(); 
}
</script>
</head>

<body>
<div align="left">
  <form name="form1" method="post" action="index.php">
    <table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" id="table17">
        <tr>
          <td colspan="6" class="tcat"><div align="center"><strong>Listado de eventos </strong> </div></td>
        </tr>
        <tr>
          <td colspan="3" class="tcat"><div align="left"></div>            
            <div align="left"><strong>B&uacute;squeda:</strong>
              <input name="txt_buscar" type="text" id="txt_buscar3" size="50">            
            </div></td>
          <td width="133" class="tcat"><input name="bt_buscar" type="button" onClick="Validar(this.form)" id="bt_buscar2" value="Iniciar B&uacute;squeda"></td>
          <td width="269" class="tcat">&nbsp;</td>
          <td width="125" class="tcat"><a href="index.php" target="_self">[Todos]</a></td>
        </tr>
        <tr align="center" bgcolor="#006699" class="thead">
          <td width="135" class="Estilo3 thead"><div align="center"><strong>Fecha </strong></div><div align="center"></div></td>
          <td width="83" class="thead Estilo3"><strong>Ver fotos </strong></td>
          <td width="165" class="thead Estilo3"><span class="Estilo3 thead"><strong>T&iacute;tulo del evento</strong></span></td>
          <td colspan="3" class="Estilo3 thead"><span class="thead Estilo3"></span><span class="thead Estilo3"></span><strong>Descripci&oacute;n</strong></td>
        </tr>
		<?
				require_once('../connection/helpdesk.php');				
				$result=$query($consulta);
				$i = 0;				
				while($row=$fetch_array($result))
				{
					$clase = "detalletabla2";
					if ($i % 2 == 0) 
					{
						$clase = "detalletabla1";
					}					
					{
						echo '<tr class='.$clase.'><td>Del '.$row["fecha_inicio"].' Al '.$row["fecha_fin"].'</td><td><a href="evento_det.php?ev='.$row["codigo_evento"].' "target="body""><center><img src="../images/iconos/ico_ver.jpg"></a></td><td>'.$row["nombre_evento"].'</td><td colspan="3">'.$row["descripcion"].'</td></tr>';					
					}							
					$i++;
				}
				$close($s);
			 ?>
    </table>
  </form>
  <p>&nbsp;</p>
</div>
</body>

</html>
