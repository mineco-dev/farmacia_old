<?
	include('../../connection/helpdesk.php');
?>
<html>
<head>
<script LANGUAGE="JavaScript">
function Validar(form)
{
  if (form.txt_buscar.value == "")
  { 
  	alert("Puede buscar por nombre, apellido, extensión, celular, tel�fono o dependencia"); 
	form.txt_buscar.focus(); 
	return;
  }  
function Refrescar(form)
{
	form.reset();
	form.txt_buscar.focus(); 
}
form.submit();
}
</script>
<link href="../../helpdesk.css" rel="stylesheet" type="text/css">
<link href="../../css/box_ie.css" rel="stylesheet" type="text/css" media="screen">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<style type="text/css">
<!--
.Estilo3 {color: #FFFFFF}
.Estilo4 {font-size: 12px}
.style2 {
	font-family: "Times New Roman", Times, serif; font-size:12px
	font-size: 24px;
	color: #666666;
}
-->
</style>
</head>

<body>

<div align="left">
<form name="form1" method="post" action="">
    <table width="100%" border="0" bordercolor="#000000">
      <tr>
        <td><div align="center" class="legal1"><strong>Directorio telef&oacute;nico del Ministerio de Econom&iacute;a</strong></div></td>
      </tr>
      <tr>
        <td><center>
            <table width="100%" border="0" cellspacing="0">
              <tr>
                <td height="25">&nbsp;</td>
              </tr>
              <tr>
                <td height="25"><div align="right">
                    <input name="txt_buscar" type="text" id="txt_nombre2" size="40">
                    <input name="bt_buscar" onClick="Validar(this.form)" type="button" id="bt_buscar3" value="Buscar">
                </div></td>
              </tr>
              <tr>
                <td height="25" class="error"><div align="right">Nota: <span class="defaultfieldname Estilo4">Puede buscar por nombre, apellido, extensi&oacute;n, o nombre de dependencia. </span></div></td>
              </tr>
            </table>
        </center></td>
      </tr>
    </table>
    <table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" id="table17">
        <tr align="center" bgcolor="#006699" class="thead">
          <td colspan="2" class="Estilo3 thead" width="30"><strong>Nombre</strong></td>
           <td width="30%" class="thead Estilo3"><strong>Dependencia</strong></td>
<!--          <td width="12%" class="thead Estilo3"><strong>Tel&eacute;fono Oficial</strong></td>-->
          <td width="30%" class="thead Estilo3"><span class="thead Estilo3"><span class="Estilo3 thead"><strong>Extensi&oacute;n</strong></span></span></td>
<!--          <td width="10%" class="thead Estilo3"><span class="Estilo3 thead"><strong>Celular oficial </strong></span></td>-->
         
        </tr>
		<?								
				if (!isset($_REQUEST["txt_buscar"]))
				{
					$consulta2 = "select (u.nombres + ' ' + u.apellidos) as empleado, u.extension, u.codigo_dependencia, u.nivel, u.activo, d.nombre_dependencia from usuario u
					inner join dependencia d on u.codigo_dependencia=d.codigo_dependencia
					where u.activo=1 order by empleado";
				}
				else
				{
				$busqueda=$_REQUEST["txt_buscar"];
				$consulta2 = "select (u.nombres + ' ' + u.apellidos) as empleado, u.extension, u.codigo_dependencia, u.nivel,
					u.activo, d.nombre_dependencia from usuario u
					inner join dependencia d on u.codigo_dependencia=d.codigo_dependencia
					where u.activo=1 and (u.nombres like '%$busqueda%'  or u.apellidos like '%$busqueda%' 
					or u.extension like '%$busqueda%' COLLATE Traditional_Spanish_ci_ai or d.nombre_dependencia like '%$busqueda%' COLLATE Traditional_Spanish_ci_ai)
					order by empleado";
				}
				$result2=$query($consulta2);
				$i = 0;				
				$entro=false;
				while($row2=$fetch_array($result2))
				{
					$clase = "detalletabla2";
					if ($i % 2 == 0) 
					{
						$clase = "detalletabla1";
					}
					echo '<tr class='.$clase.'><td colspan="2">'.$row2["empleado"].'<td>'.$row2["nombre_dependencia"].'</td><td>'.$row2["extension"].'</td></tr>';					
					$i++;
					$entro=true;
				}
				mssql_free_result($result2);
				if (!$entro)
				{
					echo '<tr align="center"><td colspan="6">&nbsp;</td></tr>';					
					echo '<tr align="center"><td colspan="6">******* NO SE ENCONTRARON REGISTROS QUE COINCIDAN CON EL FILTRO INGRESADO *******</td></tr>';					
				}
			 ?>
      <td width="19%"></tbody>
    </table>
  </form>
  </div> 
  <p>&nbsp;</p>
</div>
<!-- /forum rules and admin links -->
<br />
			<div align="left"></div>
            
</body>

</html>
