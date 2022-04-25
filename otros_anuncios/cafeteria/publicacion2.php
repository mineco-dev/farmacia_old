<?
	/*$grupo_id=46;	
	include("../restringir.php");		*/
?>
<?
	if (isset($txt_buscar)) 
	{	
		if ($txt_buscar!="")
		{
			$consulta = "SELECT * FROM publicacion where activo=1 and codigo_dependencia='36' and tipo_publicacion=3 and palabras_clave like '%$txt_buscar%' order by fecha desc";
		}
		else
		{
			$consulta = "SELECT * FROM publicacion where activo=1 and codigo_dependencia='36' and tipo_publicacion=3 order by fecha desc";	
		}	
	}
	else
	{
		$consulta = "SELECT * FROM publicacion where activo=1 and codigo_dependencia='36' and tipo_publicacion=3 order by fecha desc";	
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
.style1 {
	color: #0066FF;
	font-weight: bold;
}
.style2 {
	color: #0066CC;
	font-weight: bold;
}
-->
</style>
</head>

<body>
<div align="left">
  <form name="form1" method="post" action="">
    <table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" id="table17">
        
        <tr>
          <td colspan="5" class="tcat"><!--<div align="center"><a href="crear_publicacion.php">[Nueva 	Publicaci&oacute;n]</a></div>   -->    
            <div align="center"><table width="653" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th scope="col"><span class="style1">Administraci&oacute;n</span></th>
    <th scope="col"><span class="style2">Extensi&oacute;n</span></th>
    <th scope="col"><img src="img/menu_cafteria.jpg" width="152" height="115"></th>
  </tr>
  <tr>
    <td><div align="center"><strong>Glenda V&aacute;squez de Calder&oacute;n</strong></div></td>
    <td><div align="center"><strong>3902</strong></div></td>
    <td>&nbsp;</td>
  </tr>
</table>

                  
                  </div>           </td>
        </tr>
        <tr align="center" bgcolor="#006699" class="thead">
          <td width="175" class="Estilo3 thead"><strong>FECHA </strong></td>
          <td width="1029" class="Estilo3 thead"><strong>DEL DIA</strong></td>
          <!--<td width="135" class="thead Estilo3"><span class="thead Estilo3"><strong>Ver detalle </strong></span></td>
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
						echo '<tr class='.$clase.'><td>'.$row["fecha"].'</td><td>'.$row["descripcion"].'</td><td><center><a href="files/'.$row["nombre_archivo"].' "target=_blank""><img src="../../images/iconos/ico_ver.jpg"></a></center></td><td><center><a href="editar_publicacion.php?id='.$row["codigo_archivo"].'"><img src="../../images/iconos/ico_editar.jpg"></a></center></td><td><center><a href="borrar_publicacion.php?id='.$row["codigo_archivo"].'"><img src="../../images/iconos/ico_borrar.jpg"></a></center></td></tr>';				
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
