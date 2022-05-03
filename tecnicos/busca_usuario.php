<?
	$grupo_id=13;
	include("../restringir.php");		
?>
<html>
<head>
<script LANGUAGE="JavaScript">
function Validar(form)
{
  if (form.txt_nombre.value == "" && form.txt_apellido.value=="")
  { 
  	alert("Escriba por lo menos un nombre o apellido"); 
	form.txt_nombre.focus(); 
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
<link href="../helpdesk.css" rel="stylesheet" type="text/css">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<style type="text/css">
<!--
.Estilo1 {font-size: 12px}
.Estilo2 {font-size: 14px}
.Estilo3 {color: #FFFFFF}
-->
</style>
</head>

<body>

<div align="left">
  <form name="form1" method="post" action="busca_usuario2.php">
    <table width="100%" border="2" bordercolor="#ECE9D8">
      <tr>
        <td><div align="left"><span class="tcat">B&uacute;squeda de usuarios </span></div></td>
      </tr>
      <tr>
        <td><center>
            <table width="100%" border="0" cellspacing="5">
              <tr>
                <td width="9%" height="25">Nombre::</td>
                <td width="17%"><input name="txt_nombre" type="text" id="txt_buscar4" size="20"></td>
                <td width="8%">Apellido</td>
                <td width="19%"><input name="txt_apellido" type="text" id="txt_apellido" size="20"></td>
                <td width="47%"><input name="bt_buscar" onClick="Validar(this.form)" type="button" id="bt_buscar4" value="Iniciar B&uacute;squeda"></td>
              </tr>
            </table>
        </center></td>
      </tr>
      <tr>
        <td>        <div align="left" class="Estilo1"></div></td>
      </tr>
    </table>
    <table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" id="table17">
      <head>
        <tr>
          <td width="19%" class="tcat"><div align="left"><span class="Estilo1"><a href="crea_usuario.php" title="Agregar municipio al sistema" target="body"><span class="Estilo2">[Agregar Usuario </span>]</a></span></div></td>
          <td colspan="4" class="tcat"><div align="center">Listado de usuarios previamente registrados</div></td>
          <td width="36%" class="tcat">&nbsp;</td>
        </tr>
      </thead>
        <tr align="center" bgcolor="#006699" class="thead">
          <td colspan="2" class="Estilo3 thead"><strong>Nombre</strong></td>
          <td width="18%" class="Estilo3 thead"><strong>Usuario</strong></td>
          <td width="7%" class="thead Estilo3"><span class="Estilo3 thead"><strong>Editar</strong></span></td>
          <td width="10%" class="thead Estilo3"><span class="Estilo3 thead"><strong>Eliminar</strong></span></td>
          <td class="thead Estilo3"><strong>Borrar contrase&ntilde;a </strong></td>
        </tr>
		<?
				require_once('../connection/helpdesk.php');
				$consulta = "SELECT * FROM usuario where activo=1";
				$result=$query($consulta);
				$i = 0;				
				while($row=$fetch_array($result))
				{
					$clase = "detalletabla2";
					if ($i % 2 == 0) 
					{
						$clase = "detalletabla1";
					}
					echo '<tr class='.$clase.'><td colspan="2">'.utf8_encode($row["nombres"]).'&nbsp;'.utf8_encode($row["apellidos"]).'</td><td>'.$row["nombre_usuario"].'</td><td><center><a href="editar_usuario.php?id='.$row["codigo_usuario"].'"><img src="imagenes/iconos/ico_editar.jpg"></a></center></td><td><center><a href="elimina_usuario.php?id='.$row["codigo_usuario"].'"><img src="imagenes/iconos/ico_borrar.jpg"></a></center></td><td><center><a href="borrar_contrasena.php?id='.$row["codigo_usuario"].'"><img src="imagenes/iconos/ico_ver.jpg"></a></center></td></tr>';					
					$i++;
				}
				$close($s);
			 ?>
      </tbody>
    </table>
  </form>
  <p>&nbsp;</p>
</div>
<!-- /forum rules and admin links -->
<br />
			<div align="left"></div>
            
</body>

</html>
