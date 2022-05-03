<?
	$grupo_id=1;	
	include("../restringir.php");		
?>
<?	if (isset($hoy))
	{
		$consulta = "SELECT * FROM publicacion where codigo_archivo='$hoy' and vigencia>=fecha";
	}
	else
	{
		if (isset($txt_buscar)) 
		{	
			if ($txt_buscar!="")
			{
				$consulta = "EXEC proc_publicacion_view @vcodigo_dependencia='$dependencia', @vtipo_publicacion=1, @vpalabras_clave='%$txt_buscar%'";
			}
			else
			{
				$consulta = "EXEC proc_publicacion_view @vcodigo_dependencia='$dependencia', @vtipo_publicacion=1, @vpalabras_clave='NA'";
			}		
		}
		else
		{
			$consulta = "EXEC proc_publicacion_view @vcodigo_dependencia='$dependencia', @vtipo_publicacion=1, @vpalabras_clave='NA'";
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
</head>

<body>
<div align="left">
  <form name="form1" method="post" action="index.php">
    <table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" id="table17">
        <tr>
          <td colspan="3" class="tcat"><div align="center"><strong>Anuncios y publicaciones </strong> </div></td>
        </tr>
        <tr>
          <td class="tcat"><div align="left"></div>            
            <div align="center"><strong>B&uacute;squeda por palabra clave:</strong></div>            <div align="center"></div></td>
          <td class="tcat"><input name="txt_buscar" type="text" id="txt_buscar3" size="50">
          <input name="bt_buscar" type="submit" id="bt_buscar2" value="Iniciar B&uacute;squeda"></td>
          <td class="tcat">&nbsp;</td>
        </tr>
        <tr align="center" bgcolor="#006699" class="thead">
          <td width="210" class="Estilo3 thead"><strong>Fecha publicaci&oacute;n </strong></td>
          <td width="614" class="Estilo3 thead"><strong>Descripci&oacute;n</strong></td>
          <td width="125" class="thead Estilo3"><span class="thead Estilo3"><strong>Ver detalle </strong></span><span class="Estilo3 thead"></span><span class="Estilo3 thead"></span></td>
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
					if ($row["nombre_archivo"]=="NA")
					{
						echo '<tr class='.$clase.'><td>'.$row["fecha"].'</td><td>'.$row["descripcion"].'</td><td><center><img src="../images/iconos/ico_ver.jpg"></center></td></tr>';										}
					else
					{
						echo '<tr class='.$clase.'><td>'.$row["fecha"].'</td><td>'.$row["descripcion"].'</td><td><center><a href="files/'.$row["nombre_archivo"].' "target=_blank""><img src="../images/iconos/ico_ver.jpg"></a></center></td></tr>';					
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
