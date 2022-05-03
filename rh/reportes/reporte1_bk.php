<?
	require_once('../../connection/rrhhconsulta.inc');
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
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<style type="text/css">
<!--
.Estilo3 {color: #FFFFFF}
.Estilo4 {font-size: 9px}
.style2 {
	font-family: "Times New Roman", Times, serif;
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
                <td height="25" class="error"><div align="right">Nota: <span class="defaultfieldname Estilo4">Puede buscar por nombre, apellido, extensi&oacute;n, tel&eacute;fono, celular o nombre de dependencia. </span></div></td>
              </tr>
            </table>
        </center></td>
      </tr>
    </table>
    <table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" id="table17">
        <tr align="center" bgcolor="#006699" class="thead">
          <td colspan="2" class="Estilo3 thead"><strong>Nombre</strong></td>
           <td width="32%" class="thead Estilo3"><strong>Dependencia</strong></td>
          <td width="12%" class="thead Estilo3"><strong>Tel&eacute;fono Oficial</strong></td>
          <td width="9%" class="thead Estilo3"><span class="thead Estilo3"><span class="Estilo3 thead"><strong>Extensi&oacute;n</strong></span></span></td>
          <td width="10%" class="thead Estilo3"><span class="Estilo3 thead"><strong>Celular oficial </strong></span></td>
         
        </tr>
		<?								
				if (!isset($_REQUEST["txt_buscar"]))
				{
					$consulta2 = "select (a.nombre+' '+a.nombre2+' '+a.apellido+' '+a.apellido2 +' '+a.apellidocasada) as nombre_empleado,
					t.telefono, t.extensiont,
					tt.telefono as celular, d.nombre,
					a.idasesor 
					from asesor a
					left join tb_telefono t on a.idasesor=t.idasesor and t.oficial=1 and t.id_tipo_telefono=1
					left join tb_telefono tt on a.idasesor=tt.idasesor and tt.oficial=1 and tt.id_tipo_telefono=2
	                                left join direccion d on d.iddireccion = t.iddireccion				
                                       where a.activo=1
					order by nombre_empleado";
				}
				else
				{
				$busqueda=$_REQUEST["txt_buscar"];
				$consulta2 = "select (a.nombre+' '+a.nombre2+' '+a.apellido+' '+a.apellido2 +' '+a.apellidocasada) as nombre_empleado,
					t.telefono, t.extensiont,
					tt.telefono as celular, d.nombre,
					a.idasesor 
					from asesor a
					left join tb_telefono t on a.idasesor=t.idasesor and t.oficial=1 and t.id_tipo_telefono=1
					left join tb_telefono tt on a.idasesor=tt.idasesor and tt.oficial=1 and tt.id_tipo_telefono=2
	                                left join direccion d on d.iddireccion = t.iddireccion	
					where a.activo=1 and (a.nombre like '%$busqueda%' or a.nombre2 like '%$busqueda%' or a.apellido like '%$busqueda%' 
					or a.apellido2 like '%$busqueda%' or a.apellidocasada like '%$busqueda%' or t.extensiont like '%$busqueda%' 
					or t.telefono like '%$busqueda%' or tt.telefono like '%$busqueda%' or d.nombre like '%$busqueda%')
					order by nombre_empleado";
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
					echo '<tr class='.$clase.'><td colspan="2">'.$row2["nombre_empleado"].'<td>'.$row2["nombre"].'</td><td>'.$row2["telefono"].'</td><td>'.$row2["extensiont"].'</td><td>'.$row2["celular"].'</td></tr>';					
					$i++;
					$entro=true;
				}
				$free_result($result2);
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
