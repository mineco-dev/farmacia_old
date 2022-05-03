<html>
<head>
<script LANGUAGE="JavaScript">
function Validar(form)
{
 if (form.txt_categoria.value == "")
  { 
  	alert("Escriba la categor�a o parte de la misma"); 
	form.txt_categoria.focus(); 
	return;
 }
  form.submit();
}
function Refrescar(form)
{
	form.reset();
	form.txt_categoria.focus(); 
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
        <td><div align="left"><span class="tcat">B&uacute;squeda de categor&iacute;as </span></div></td>
      </tr>
      <tr>
        <td><center>
            <table width="100%" border="0" cellspacing="5">
              <tr>
                <td width="7%" height="25">Buscar:</td>
                <td width="17%"><input name="txt_categoria" type="text" id="txt_categoria" size="20"></td>
                <td><input name="bt_buscar" onClick="Validar(this.form)" type="button" id="bt_buscar4" value="Iniciar B&uacute;squeda"></td>
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
          <td width="16%" class="tcat"><div align="left"><span class="Estilo1"><a href="crea_categoria.php" title="Agregar municipio al sistema" target="body"><span class="Estilo2">[Agregar</span>]</a></span></div></td>
          <td colspan="4" class="tcat"><div align="center">Listado de categorias previamente registradas</div></td>
          <td width="26%" class="tcat"><div align="right"><span class="Estilo1"><a href="busca_cat.php" title="Agregar municipio al sistema" target="body"><span class="Estilo2">[Ver todas </span>]</a></span></div></td>
        </tr>
      </thead>
        <tr align="center" bgcolor="#006699" class="thead">
          <td colspan="4" class="Estilo3 thead"><strong>Descripci&ograve;n</strong><span class="Estilo3 thead"></span></td>
          <td width="15%" class="thead Estilo3"><span class="Estilo3 thead"><strong><strong>Editar</strong></strong></span></td>
          <td class="thead Estilo3"><span class="Estilo3 thead"><strong>Eliminar</strong></span></td>
        </tr>
		<?		
				$categoria=$_REQUEST["txt_categoria"];
				require_once('../connection/helpdesk.php');				
				$consulta = "SELECT * FROM categoria where categoria like '%$categoria%'and activo=1 order by categoria";
				$result=$query($consulta);
				$i = 0;				
				while($row=$fetch_array($result))
				{
					$clase = "detalletabla2";
					if ($i % 2 == 0) 
					{
						$clase = "detalletabla1";
					}
					echo '<tr class='.$clase.'><td colspan="4">'.$row["categoria"].'</td><td><center><a href="editar_cat.php?id='.$row["codigo_categoria"].'"><img src="imagenes/iconos/ico_editar.jpg"></a></center></td><td colspan="2"><center><a href="elimina_cat.php?id='.$row["codigo_categoria"].'"><img src="imagenes/iconos/ico_borrar.jpg"></a></center></td></tr>';					
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
