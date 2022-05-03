<?	
	//Validar la sesion 
	session_start();	
	if (isset($_SESSION['visita'])) 
	{		
		session_unregister('visita');
	}	
	include("../validate.php");
	$grupo_id=2;
	if (($_SESSION["group_id"]) < $grupo_id) 
	include("../logout.php");		
//	<body onload="Abrir_ventana('new.php')">
?>
<?
//Este script chequea las opciones seleccionadas en el combobox
if ((!isset($cbo_estado)) && (!isset($txt_gafete)))
	$consulta = "SELECT * FROM seg_visitas where codigo_estado<3 ORDER BY codigo_visita desc";
	else
		if (($cbo_estado==0) && ($txt_gafete==""))
		$consulta = "SELECT * FROM seg_visitas where codigo_estado<3 ORDER BY codigo_visita desc";
		else
			if (($cbo_estado==0) && ($txt_gafete!=""))
			$consulta = "SELECT * FROM seg_visitas where gafete_asignado='$txt_gafete' and codigo_estado<3 ORDER BY codigo_visita desc";
			else
				if (($cbo_estado>0) && ($txt_gafete==""))
				$consulta = "SELECT * FROM seg_visitas where codigo_estado='$cbo_estado' and codigo_estado<3 ORDER BY codigo_visita desc";
				else
					if (($cbo_estado==0) && ($txt_gafete==""))
						$consulta = "SELECT * FROM seg_visitas where codigo_estado<3 ORDER BY codigo_visita desc";
						else					
						$consulta = "SELECT * FROM seg_visitas where codigo_estado='$cbo_estado' and gafete_asignado='$txt_gafete' and codigo_estado<3 ORDER BY codigo_visita desc";
?>
<html>
<head>
<script language="JavaScript">
function Validar(form)
{
 if (form.cbo_estado.value=="0" && form.txt_gafete.value=="")
  { 
  	alert("Seleccione al menos un criterio para la b�squeda"); 	
  }  
 }
function Abrir_ventana(pagina) 
	{
		var opciones="toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, width=200, height=100, top=85, left=140";
		window.open(pagina,"",opciones);
	}
</script>
<link href="../../helpdesk.css" rel="stylesheet" type="text/css">
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<META HTTP-EQUIV="REFRESH" CONTENT="100;URL=visitas.php">
<style type="text/css">
<!--
.Estilo1 {color: #FFFFFF}
.Estilo2 {color: #000000}
-->
</style>
</head>
<body>
<center>
  <form name="form1" method="post" action="">
    <table width="100%" border="0" bordercolor="#0000FF">
      <tr>
        <td colspan="4"><div align="center"></div>          <div align="center"><strong>Reporte de visitas activas</strong></div>          <div align="center"></div></td>
      </tr>
      <tr bgcolor="#FFFFFF" class="error">
        <td width="13%"><div align="center"><span class="Estilo2">Gafete:</span>          
        </div></td>
        <td width="13%"><input name="txt_gafete" type="text" id="txt_gafete" size="10"></td>
        <td width="33%"><span class="Estilo1">
          	<?
					require_once('../Connection/helpdesk.php'); 
					$query2="SELECT * FROM seg_estado where codigo_estado<3 ORDER BY estado";
					$result2=mssql_query($query2);	
					echo('<select name="cbo_estado">');
					$nombre=":: Estado de la visita ::";
					echo'<option value="0">'.$nombre.'</option>';
					while($row2=mssql_fetch_array($result2))
					{
						echo'<option value="'.$row2["codigo_estado"].'">'.$row2["estado"].'</option>';
					}
					echo('</select>');											 								
				?>
        </span>        </td>
        <td width="41%"><span class="Estilo1">
          <input name="Submit" type="submit" onClick="Validar(this.form)" value="Buscar...">
        </span></td>
      </tr>
      <tr>
        <td colspan="4"><center>
            <table width="99%" border="1" class="tablaazul">
              <tr bordercolor="#333333">
                <td width="8%"><div align="center"><strong>Gafete</strong></div></td>
                <td width="21%"><div align="center"><strong>Fecha ingreso</strong></div></td>
                <td width="33%"><div align="center"><strong>Nombre del visitante</strong></div></td>
                <td width="25%"><div align="center"><strong>Ingresado por: </strong></div></td>
                <td width="13%"><div align="center"><strong>Asignar equipo: </strong></div></td>
              </tr>
              <?				
				$result3=mssql_query($consulta);
				$i = 0;
				while($row3=mssql_fetch_array($result3))
				{
					$clase = "detalletabla2";
					if ($i % 2 == 0) 
					{
						$clase = "detalletabla1";
					}					
					echo '<tr class='.$clase.'><td><center>'.$row3["gafete_asignado"].'</center></td><td><center>'.$row3["fecha_ingreso"].'</center></td><td><center>'.$row3["nombre_visitante"].'</a></center></td><td><center>'.$row3["nombres"].'&nbsp;'.$row3["apellidos"].'</center></td><td><center><a href="equipo_det.php?id='.$row3["codigo_visita"].'"><img src="../imagenes/iconos/ico_equipo.jpg"></a></center></td></tr>';					
					$i++;
				}
				mssql_close($s);				
			  ?>
            </table>
        </center></td>
      </tr>
      <tr>
        <td colspan="4">&nbsp;</td>
      </tr>
    </table>
  </form>
</center>
</body>
</html>
