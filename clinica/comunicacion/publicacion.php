<?
require("../includes/funciones.php");
require("../includes/sqlcommand.inc");	
?>
<?
	if (isset($id))
	{
		$consulta = "SELECT * FROM comsocial_notas where id_noticia='$id' and activo=1 order by fecha desc";
	}
	else{
		if (isset($txt_buscar)) 
		{	
			if ($txt_buscar!="")
			{
				$consulta = "SELECT * FROM comsocial_notas where activo=1 and titulo like '%$txt_buscar%' order by id_noticia, fecha desc";
			}
			else
			{
				$consulta = "SELECT * FROM comsocial_notas where activo=1 order by id_dependencia, fecha desc";	
			}	
		}
		else
		{
			$consulta = "SELECT * FROM comsocial_notas where activo=1 order by id_noticia, fecha desc";	
			
		}
	}
?>
<html>
<head>
<link href="../helpdesk.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<style type="text/css">
<!--
.Estilo3 {color: #FFFFFF}
-->
</style>
</head>

<body>
<div align="left">
  <form name="form1" method="post" action="">
    <table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" id="table17">
        <tr>
          <td width="240" class="tcat"><div align="right">B&uacute;squeda por titulo:</div></td>
          <td colspan="4" class="tcat"><input name="txt_buscar" type="text" id="txt_buscar" size="50">
          <input name="bt_buscar" type="submit" id="bt_buscar6" value="Iniciar B&uacute;squeda"></td>
        </tr>
        <tr>
          <td class="tcat"><div align="center"><a href="nota2.php">[Nueva Publicaci&oacute;n]</a></div><div align="center"></div>
          <div align="center"><strong></strong></div></td>
          <td colspan="2" class="tcat"><div align="center">Publicaciones </div></td>
          <td colspan="2" class="tcat"><div align="right"></div></td>
        </tr>
        <tr align="center" bgcolor="#006699" class="thead">
          <td class="Estilo3 thead"><strong>Fecha publicaci&oacute;n </strong></td>
          <td width="422" class="Estilo3 thead"><strong>Descripci&oacute;n</strong></td>
          <td width="135" class="thead Estilo3"><span class="thead Estilo3"><strong>Ver detalle </strong></span></td>
          <td width="41" class="thead Estilo3"><span class="Estilo3 thead"><strong>Editar</strong></span></td>
          <td width="85" class="thead Estilo3"><span class="Estilo3 thead"><strong>Eliminar</strong></span></td>
        </tr>
		<?
				//require_once('../connection/helpdesk.php');				
				conectardb($comunicacion)
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
						echo '<tr class='.$clase.'><td>'.$row["fecha"].'</td><td>'.$row["descripcion"].'</td><td><center><img src="../images/iconos/ico_ver.jpg"></center></td><td><center><a href="editar_nota.php?id='.$row["id_noticia"].'"><img src="../images/iconos/ico_editar.jpg"></a></center></td><td><center><a href="borrar_publicacion.php?id='.$row["id_noticia"].'"><img src="../images/iconos/ico_borrar.jpg"></a></center></td></tr>';									
					}
					else
					{
						echo '<tr class='.$clase.'><td>'.$row["fecha"].'</td><td>'.$row["descripcion"].'</td><td><center><a href="comunicacion/img_notas/'.$row["nombre_archivo"].' "target=_blank""><img src="../images/iconos/ico_ver.jpg"></a></center></td><td><center><a href="editar_nota.php?id='.$row["id_noticia"].'"><img src="../images/iconos/ico_editar.jpg"></a></center></td><td><center><a href="borrar_publicacion.php?id='.$row["id_noticia"].'"><img src="../images/iconos/ico_borrar.jpg"></a></center></td></tr>';				
					}							
					$i++;
				}
				$close($s);
			 ?>
    </table>
  </form>
  </div>
</body>

</html>
