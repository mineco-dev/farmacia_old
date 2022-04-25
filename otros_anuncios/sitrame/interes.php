<?
	/*$grupo_id=47;	
	include("../../restringir.php");		*/
?>
<?
	if (isset($txt_buscar)) 
	{	
		if ($txt_buscar!="")
		{
			$consulta = "SELECT * FROM publicacion where activo=1 and codigo_dependencia='23' and tipo_publicacion =1 and palabras_clave like '%$txt_buscar%' order by fecha desc";
		}
		else
		{
			$consulta = "SELECT * FROM publicacion where activo=1 and codigo_dependencia='23' and tipo_publicacion =1 order by fecha desc";	
		}	
	}
	else
	{
		$consulta = "SELECT * FROM publicacion where activo=1 and codigo_dependencia='23' and tipo_publicacion =1 order by fecha desc";	
	}
?>
<html>
<head>
<link href="../../helpdesk.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
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
          <td colspan="5" class="tcat"><!--<div align="center"><a href="crear_publicacion.php">[Nueva 	Publicaci&oacute;n]</a></div>   -->            <div align="right"></div>           </td>
        </tr>
        <tr align="center" bgcolor="#006699" class="thead">
          <td width="169" class="Estilo3 thead"><strong>FECHA </strong></td>
          <td width="887" class="Estilo3 thead"><strong>DESCRIPCión</strong></td>
          <td width="135" class="thead Estilo3"><span class="thead Estilo3"><strong>Ver detalle </strong></span></td><!--
          <td width="41" class="thead Estilo3"><span class="Estilo3 thead"><strong>Editar</strong></span></td>
          <td width="85" class="thead Estilo3"><span class="Estilo3 thead"><strong>Eliminar</strong></span></td>-->
        </tr>
		<?
				require_once('../../connection/helpdesk.php');				
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
						echo '<tr class='.$clase.'><td>'.$row["fecha"].'</td><td>'.$row["descripcion"].'</tr>';									
					}
					else
					{
						echo '<tr class='.$clase.'><td>'.$row["fecha"].'</td><td>'.$row["descripcion"].'</td><td><center><a href="files/'.$row["nombre_archivo"].' "target=_blank""><img src="../../images/iconos/ico_ver.jpg"></a></center></td></tr>';				
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
