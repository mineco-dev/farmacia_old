<? 
$grupo_id=49;
require ("../../restringir.php");
echo "EN CONSTRUCCION";
?>

<?
	if (isset($txt_buscar)) 
	{	
		if ($txt_buscar!="")
		{
			$consulta = "SELECT * FROM empleado  where activo=1";
		}
		else
		{
			$consulta = "SELECT * FROM tb_empleado";	
		}	
	}
	else
	{
		$consulta = "SELECT * tb_empleado";	
	}
?>

<html>
<head>
<link href="../../helpdesk.css" rel="stylesheet" type="text/css">
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
  <form name="form1" method="post" action="">
    <table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" id="table17">
        <tr>
          <td width="218" class="tcat"><div align="right">B&uacute;squeda por Empleado</div></td>
          <td colspan="4" class="tcat"><input name="txt_buscar" type="text" id="txt_buscar" size="50">
          <input name="bt_buscar" type="submit" id="bt_buscar6" value="Iniciar B&uacute;squeda"></td>
        </tr>
        <tr>
          <td class="tcat"><div align="center"><a href="crea_empleado.php">AGREGAR EMPLEADO</a></div>            <div align="center"></div>            <div align="center"><strong></strong></div></td>
          <td colspan="2" class="tcat"><div align="center">EMPLEADOS MINISTERIO DE ECONOM&Iacute;A</div></td>
          <td colspan="2" class="tcat"><div align="right"></div></td>
        </tr>
        <tr align="center" bgcolor="#006699" class="thead">
          <td class="Estilo3 thead"><strong>Nombre</strong></td>
          <td width="610" class="Estilo3 thead"><strong>Dependencia</strong></td>
          <td width="170" class="thead Estilo3"><span class="thead Estilo3"><strong>Ver </strong></span></td>
          <td width="54" class="thead Estilo3"><span class="Estilo3 thead"><strong>Editar</strong></span></td>
          <td width="111" class="thead Estilo3"><span class="Estilo3 thead"><strong>Eliminar</strong></span></td>
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
						echo '<tr class='.$clase.'><td>'.$row["fecha"].'</td><td>'.$row["descripcion"].'</td><td><center><img src="../../images/iconos/ico_ver.jpg"></center></td><td><center><a href="editar_publicacion.php?id='.$row["codigo_archivo"].'"><img src="../../images/iconos/ico_editar.jpg"></a></center></td><td><center><a href="borrar_publicacion.php?id='.$row["codigo_archivo"].'"><img src="../../images/iconos/ico_borrar.jpg"></a></center></td></tr>';									
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