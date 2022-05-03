<html>
<head>
<script LANGUAGE="JavaScript">
function Validar(form)
{
   if (form.txt_buscar.value == "")
  { 
  	alert("Puede buscar por nombre, apellido, extensión o dependencia"); 
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
<link href="../helpdesk.css" rel="stylesheet" type="text/css">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<style type="text/css">
<!--
.Estilo3 {color: #FFFFFF}
.Estilo4 {font-size: 9px}
-->
</style>
</head>

<body>

<div align="left">
  <form name="form1" method="post" action="busca_extension2.php">
    <table width="100%" border="1" bordercolor="#000000">
      <tr>
        <td><div align="center"><span class="defaultfieldname">B&uacute;squeda de extensiones telef&oacute;nicas </span></div></td>
      </tr>
      <tr>
        <td><center>
            <table width="100%" border="0" cellspacing="5">
              <tr>
                <td width="8%" height="25">Buscar: </td>
                <td width="36%"><input name="txt_buscar" type="text" id="txt_nombre2" size="40"></td>
                <td width="56%" height="25"><input name="bt_buscar" onClick="Validar(this.form)" type="button" id="bt_buscar3" value="Iniciar B&uacute;squeda"></td>
              </tr>
              <tr>
                <td height="25" colspan="3" class="error">Nota: <span class="defaultfieldname Estilo4">Puede buscar por nombre, apellido, extensi&oacute;n o nombre de dependencia. </span></td>
              </tr>
            </table>
        </center></td>
      </tr>
    </table>
    <table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" id="table17">
      <td width="19%"><head>
        <tr>
          <td colspan="6" class="tcat"><div align="left"></div>            
            <div align="center"><strong>Directorio telef&oacute;nico del Ministerio de Econom&iacute;a</strong></div></td>
        </tr>
      </thead>
        <tr align="center" bgcolor="#006699" class="thead">
          <td colspan="2" class="Estilo3 thead"><strong>Nombre</strong></td>
          <td width="18%" class="thead Estilo3"><strong>Extensi&oacute;n</strong></td>
          <td width="7%" class="thead Estilo3"><span class="thead Estilo3"><span class="Estilo3 thead"><strong>Nivel</strong></span></span></td>
          <td colspan="2" class="thead Estilo3"><span class="Estilo3 thead"><strong>Dependencia</strong></span></td>
        </tr>
		<?
				
				require_once('../connection/helpdesk.php');
				$consulta2 = "SELECT * FROM view_busca_extension";
				$result2=$query($consulta2);
				$i = 0;				
				while($row2=$fetch_array($result2))
				{
					$clase = "detalletabla2";
					if ($i % 2 == 0) 
					{
						$clase = "detalletabla1";
					}
					echo '<tr class='.$clase.'><td colspan="2">'.$row2["nombres"].'&nbsp;'.$row2["apellidos"].'</td><td>'.$row2["extension"].'</td><td>'.$row2["nivel"].'</td><td>'.$row2["dependencia"].'</td></tr>';					
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
