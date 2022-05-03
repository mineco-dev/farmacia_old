<?		
	$grupo_id=17;
	include("../restringir.php");		
	if (isset($_SESSION["codigo_usuario"])) 
	{
		//session_unregister("codigo_usuario");	
	}	
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
  <form name="form1" method="post" action="">
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
      <td width="19%"><head>
        <tr>
          <td class="tcat"><div align="left"></div>            
            <div align="center"><a href="agrega_usuario_rol.php" target="body">[Agregar Usuario] </a></div></td>
          <td colspan="2" class="tcat"><div align="center">Listado de usuarios con roles en el sistema </div></td>
          <td class="tcat"><a href="cp_perfil.php" target="body">[Copiar perfil] </a></td>
        </tr>
      </thead>
        <tr align="center" bgcolor="#006699" class="thead">
          <td colspan="2" class="Estilo3 thead"><strong>Nombre</strong></td>
          <td width="38%" class="Estilo3 thead"><strong>Usuario</strong></td>
          <td width="14%" class="thead Estilo3"><span class="Estilo3 thead"><strong>Ver roles </strong></span><span class="Estilo3 thead"></span></td>
        </tr>
		<?
				if ((!isset($txt_nombre)) && (!isset($txt_nombre)))
				$consulta = "SELECT distinct(a.codigo_usuario), b.nombres, b.apellidos, b.nombre_usuario, a.codigo_usuario FROM rol a inner join usuario b on a.codigo_usuario=b.codigo_usuario where b.activo=1";
				else
					$consulta = "SELECT distinct(a.codigo_usuario), b.nombres, b.apellidos, b.nombre_usuario, a.codigo_usuario FROM rol a inner join usuario b on a.codigo_usuario=b.codigo_usuario where b.nombres like '%$txt_nombre%' and b.apellidos like '%$txt_apellido%' and b.activo=1";
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
					echo '<tr class='.$clase.'><td colspan="2">'.$row["nombres"].'&nbsp;'.$row["apellidos"].'</td><td>'.$row["nombre_usuario"].'</td><td><center><a href="roles_det.php?id='.$row["codigo_usuario"].'"><img src="imagenes/iconos/ico_ver.jpg"></a></center></td></tr>';					
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
