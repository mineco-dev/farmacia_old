<?	

$grupo_id=46;
include("../../restringir.php");	
?>
<p align="center">PUBLICACIONES Y ANUNCIOS</p>
<?	
	require_once('../../connection/helpdesk.php');
	$consulta = "SELECT * FROM publicacion where codigo_archivo='$id'";
	$result=$query($consulta);
	while($row=$fetch_array($result))
	{
			$descripcion=$row["descripcion"];
			$archivo=$row["nombre_archivo"];
	}
?>

<form action="gborrar_publicacion.php" method="post" enctype="multipart/form-data"> 
    <table width="397" border="0">
      <tr>
        <td width="92" height="105">Descripci&oacute;n:</td>
        <td width="289"><? echo $descripcion; ?></td>
      </tr>
      <tr>
        <td colspan="2">
		<?
			if ($archivo!="NA")
			{
				echo "Ver archivo adjunto: ";
				echo '<a href="files/'.$archivo.' "target=_blank""><img src="../../images/iconos/ico_ver.jpg"></a>';				
			}
		?>
		<input name="codigo_archivo" type="hidden" id="codigo_archivo" value="<? echo $id ?>"></td>
      </tr>
    </table>
    <p>        <input type="submit" value="Eliminar publicaci&oacute;n"> 
  </p>
</form> 
