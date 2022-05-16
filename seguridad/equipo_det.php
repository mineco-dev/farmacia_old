<?	
$grupo_id=2; // Para agentes de seguridad 
include("../restringir.php");	
?>
<html>
<head>
<script LANGUAGE="JavaScript">
function Validar(form)
{
 if (form.cbo_equipo.value == "0")
  { 
  	alert("Seleccione el tipo de equipo"); 
	form.cbo_equipo.focus(); 
	return;
 }
 if (form.cbo_mov_equipo.value == "0")
  { 
  	alert("Indique si el equipo es personal o del Ministerio"); 
	form.cbo_mov_equipo.focus(); 
	return;
 }
  if (form.txt_serie.value == "")
  { 
  	alert("Escriba el N�mero de serie o un número �nico que identifique el equipo"); 
	form.txt_serie.focus(); 
	return;
 }
  form.submit();
}
function Refrescar(form)
{
	form.reset();
	form.cbo_equipo.focus(); 
}
</script>
<link href="../helpdesk.css" rel="stylesheet" type="text/css">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<style type="text/css">
<!--
.Estilo3 {color: #FFFFFF}
.Estilo4 {	color: #0000FF;
	font-weight: bold;
}
-->
</style>
</head>

<body>

<div align="left">
  <form name="form1" method="post" action="agrega_equipo.php">
    <table width="100%" border="2" bordercolor="#ECE9D8">
      <tr>
        <td><div align="left"><span class="tcat">Registro de equipo ingresado </span></div></td>
      </tr>
      <tr>
        <td><center>
            <table width="100%" border="0" cellspacing="5">
              <tr>
                <td width="8%" height="25">Visitante:</td>
                <td colspan="3" class="titulocategoria">
				  <?	
				  	if (isset($id))	$ultima_visita=$id;		
					require_once('../connection/helpdesk.php');  
					$consulta = "select  a.nombre_visitante as visitante, b.codigo_visita from seg_visitante a inner join seg_visita b on a.codigo_visitante=b.codigo_visitante where codigo_visita='$ultima_visita'";
					$result=$query($consulta);
					while($row=$fetch_array($result))		
					{
						echo $row["visitante"];
					}		
				?>				</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td height="25" colspan="2"><div align="left">Descripci&oacute;n::</div></td>
                <td><div align="center"><span class="alt1">
                  <?					
					$consulta="SELECT * FROM seg_equipo ORDER BY nombre_equipo";
					$result=$query($consulta);	
					echo('<select name="cbo_equipo">');
					$nombre=":: Seleccione ::";
					echo'<option value="0">'.$nombre.'</option>';
					while($row=$fetch_array($result))
					{
						echo'<option value="'.$row["codigo_equipo"].'">'.$row["nombre_equipo"].'</option>';
					}
					echo('</select>');					
				?>
                </span></div></td>
                <td><div align="center"></div></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td height="25" colspan="2">No. de serie:</td>
                <td><input name="txt_serie" type="text" id="txt_serie" size="25"></td>
                <td>&nbsp;</td>
                <td><div align="right"><span class="Estilo4"><a href="visitas.php" target="body" class="Estilo4">FINALIZAR</a></span></div></td>
              </tr>
              <tr>
                <td height="25" colspan="2"><div align="left"><span class="alt1">Tipo Movimiento:</span></div></td>
                <td width="18%"><span class="alt1">
                  <?					
					$consulta2="SELECT * FROM seg_mov_equipo Where activo=1";
					$result2=$query($consulta2);	
					echo('<select name="cbo_mov_equipo">');					
					echo'<option value="0">'.$nombre.'</option>';
					while($row2=$fetch_array($result2))
					{
						echo'<option value="'.$row2["codigo_mov_equipo"].'">'.$row2["descripcion"].'</option>';
					}
					echo('</select>');					
				?>
                </span></td>
                <td width="11%"><span class="alt1">
                  <input name="bt_agregar" onClick="Validar(this.form)" type="button" id="bt_agregar2" value="Agregar">
                </span></td>
                <td width="59%">&nbsp;</td>
              </tr>
            </table>
        </center></td>
      </tr>
    </table>
    <table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" id="table17">
        <tr align="center" bgcolor="#006699" class="thead">
          <td width="12" colspan="2" class="Estilo3 thead"><strong>Descripci&oacute;n</strong></td>
          <td width="16%" class="Estilo3 thead"><strong>No. de serie </strong></td>
          <td width="5%" colspan="2" class="Estilo3 thead"><span class="Estilo3 thead"><span class="Estilo3 thead"><strong>Movimiento</strong></span></span></td>
          <td class="Estilo3 thead"><span class="Estilo3 thead"></span><span class="thead Estilo3"><strong>Observaci&oacute;n</strong></span></td>
        </tr>
		<?				
				$consulta3 = "SELECT a.nombre_equipo as equipo, b.codigo_visita, b.numero_serie, b.codigo_equipo_det, c.descripcion FROM seg_equipo a inner join seg_equipo_det b on a.codigo_equipo=b.codigo_equipo inner join seg_mov_equipo c on b.codigo_mov_equipo=c.codigo_mov_equipo where b.codigo_visita='$ultima_visita' and retirado=2";
				$result3=$query($consulta3);
				$i = 0;				
				while($row3=$fetch_array($result3))
				{					
					$clase = "detalletabla2";
					if ($i % 2 == 0) 
					{
						$clase = "detalletabla1";
					}			
						echo '<tr class='.$clase.'><td colspan="2">'.$row3["equipo"].'</td><td>'.$row3["numero_serie"].'</td><td colspan="2">'.$row3["descripcion"].'</td><td><center><a href="observacion_equipo.php?id='.$row3["codigo_equipo_det"].'"><img src="../images/iconos/ico_editar.jpg"></a></center></td></tr>';										
					$i++;
				}
				$close($s);				
				session_write_close();
				session_register('ultima_visita');
				$_SESSION['ultima_visita'] = $ultima_visita;	
			 ?>
    </table>  
  </form>
  <p>&nbsp;</p>
</div>
<!-- /forum rules and admin links -->
<br />
			<div align="left"></div>
            
</body>

</html>
