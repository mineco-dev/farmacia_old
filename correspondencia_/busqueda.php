<html>

<head>
<script LANGUAGE="JavaScript">
function Validar(form)
{
 if (form.txt_buscar.value == "")
  { 
  	alert("Escriba información para iniciar la b�squeda"); 
	form.txt_buscar.focus(); 
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
<link href="../../helpdesk.css" rel="stylesheet" type="text/css">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
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
        <td><div align="left"><span class="tcat">B&uacute;squeda de visitantes </span></div></td>
      </tr>
      <tr>
        <td><center>
            <table width="100%" border="0" cellspacing="5">
              <tr>
                <td width="6%" height="25">Buscar:</td>
                <td width="23%"><input name="txt_buscar" type="text" id="txt_buscar4" size="30"></td>
                <td width="71%"><input name="bt_buscar" onClick="Validar(this.form)" type="button" id="bt_buscar4" value="Iniciar B&uacute;squeda"></td>
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
          <td width="13%" class="tcat"><div align="left"><span class="Estilo1"><a href="agregar.php" title="Agregar municipio al sistema" target="body"><span class="Estilo2">[Agregar Visitante</span>]</a></span></div></td>
          <td colspan="4" bordercolor="#FF0000" class="tcat"><div align="center">Listado de visitantes previamente registrados</div></td>
          <td colspan="3" class="tcat"><span class="Estilo1"><a href="index.php" title="Agregar municipio al sistema" target="body"><span class="Estilo2">[Ver todos</span>]</a></span></td>
        </tr>
      </thead>
        <tr align="center" bgcolor="#006699" class="thead">
          <td colspan="2" class="Estilo3 thead"><strong>Nombre</strong></td>
          <td width="10%" class="Estilo3 thead"><strong>C&eacute;dula</strong></td>
          <td width="11%" class="Estilo3 thead"><strong>Licencia</strong></td>
          <td width="12%" class="Estilo3 thead"><strong>Pasaporte</strong></td>
          <td width="6%" class="Estilo3 thead"><strong>Editar</strong></td>
          <td width="8%" class="Estilo3 thead"><strong>Lista Negra</strong></td>
          <td width="30%" class="Estilo3 thead"><strong>Ver mas... </strong></td>
        </tr>
		<?
				$buscar=$_REQUEST["txt_buscar"];								
				require_once('../../connection/helpdesk.php');
				$consulta = "SELECT * FROM seg_visitante where nombre_visitante like '%$buscar%' or numero_cedula like '%$buscar%' or numero_licencia like '%$buscar%' or numero_pasaporte like '%$buscar%' order by nombre_visitante";		
				$result=$query($consulta);
				$i = 0;								
				while($row=$fetch_array($result))
				{
					$lista_negra=$row["lista_negra"];
					$clase = "detalletabla2";
					if ($i % 2 == 0) 
					{
						$clase = "detalletabla1";
					}
					if ($lista_negra==1)
					{
					 	$clase="lista_negra";
						echo '<tr class='.$clase.'><td colspan="2">'.$row["nombre_visitante"].'</td><td>'.$row["numero_cedula"].'</td><td>'.$row["numero_licencia"].'</td><td>'.$row["numero_pasaporte"].'</td><td><center><a href="editar.php?id='.$row["codigo_visitante"].'"><img src="../imagenes/iconos/ico_editar.jpg"></a></center></td><td><center><img src="../imagenes/iconos/ico_borrar.jpg"></center></td><td><center><a href="ver.php?id='.$row["codigo_visitante"].'"><img src="../imagenes/iconos/ico_ver.jpg"></a></center></td></tr>';					
					}	
					else
						echo '<tr class='.$clase.'><td colspan="2"><a href="registrar_visita.php?id='.$row["codigo_visitante"].'">'.$row["nombre_visitante"].'</a></td><td>'.$row["numero_cedula"].'</td><td>'.$row["numero_licencia"].'</td><td>'.$row["numero_pasaporte"].'</td><td><center><a href="editar.php?id='.$row["codigo_visitante"].'"><img src="../imagenes/iconos/ico_editar.jpg"></a></center></td><td><center><a href="eliminar.php?id='.$row["codigo_visitante"].'"><img src="../imagenes/iconos/ico_borrar.jpg"></a></center></td><td><center><a href="ver.php?id='.$row["codigo_visitante"].'"><img src="../imagenes/iconos/ico_ver.jpg"></a></center></td></tr>';										
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
