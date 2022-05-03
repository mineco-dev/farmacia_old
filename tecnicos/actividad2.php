<?	
	session_start();	
	include("validate.php");
	$grupo_id=2;
    if (($_SESSION["group_id"]) < $grupo_id) 
	include("logout.php");		
//	<body onload="Abrir_ventana('new.php')">
?>
<html>
<head>
<script language="JavaScript">
function Abrir_ventana(pagina) 
	{
		var opciones="toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, width=200, height=100, top=85, left=140";
		window.open(pagina,"",opciones);
	}
</script>
<link href="../helpdesk.css" rel="stylesheet" type="text/css">
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<META HTTP-EQUIV="REFRESH" CONTENT="15;URL=actividad.php">
</head>
<body onload="Abrir_ventana('new.php')">
<center>
  <table width="90%" border="0" bordercolor="#0000FF">
    <tr>
      <td colspan="3"><div align="center"><strong>Detalle de actividades, Subgerencia de Inform&aacute;tica</strong></div></td>
    </tr>
    <tr>
      <td width="26%"><div align="center">
        <a href="actividad.php" target="_parent">[Ver todas] </a> </div></td>
      <td width="39%"><?
					require_once('../Connection/helpdesk.php'); 
					$query="SELECT * FROM usuario WHERE activo=1 and codigo_dependencia=1 ORDER BY nombres";
					$result=mssql_query($query);	
					echo('<select name="cbo_usuario">');
					$nombre=":: Seleccione ::";
					echo'<option value="0">'.$nombre.'</option>';
					while($row=mssql_fetch_array($result))
					{
						echo'<option value="'.$row["codigo_usuario"].'">'.$row["nombres"].' '.$row["apellidos"].'</option>';
					}
					echo('</select>');	
					mssql_close($s);					 								
				?>
</td>
      <td width="35%"><?
					require_once('../Connection/helpdesk.php'); 
					$query="SELECT * FROM usuario WHERE activo=1 and codigo_dependencia=1 ORDER BY nombres";
					$result=mssql_query($query);	
					echo('<select name="cbo_usuario">');
					$nombre=":: Seleccione ::";
					echo'<option value="0">'.$nombre.'</option>';
					while($row=mssql_fetch_array($result))
					{
						echo'<option value="'.$row["codigo_usuario"].'">'.$row["nombres"].' '.$row["apellidos"].'</option>';
					}
					echo('</select>');	
					mssql_close($s);					 								
				?></td>
    </tr>
    <tr>
      <td colspan="3"><center>
          <table width="99%" border="1" class="tablaazul">
            <tr>
              <td width="8%"><div align="center"><strong># Ticket </strong></div></td>
              <td width="11%"><div align="center"><strong>Fecha</strong></div></td>
              <td width="18%" bordercolor="#000000"><div align="center"><strong>Nombre</strong></div>                
              <div align="center"></div></td>
              <td width="19%" bordercolor="#000000"><div align="center"><strong>Asistencia para: </strong></div></td>
              <td width="17%"><div align="center"><strong>Detalle de la solicitud:</strong></div></td>
              <td width="11%"><div align="center"><strong>Estado</strong></div></td>
              <td width="6%"><strong>Nivel</strong></td>
              <td width="10%"><div align="center"><strong>Atiende</strong></div></td>
            </tr>
            <?
			  	require_once('../connection/helpdesk.php');
				$consulta = "SELECT * FROM view_soporte";
				$result=mssql_query($consulta);
				$i = 0;
				while($row=mssql_fetch_array($result))
				{
					$clase = "detalletabla2";
					if ($i % 2 == 0) 
					{
						$clase = "detalletabla1";
					}					
                	echo '<tr class='.$clase.'><td><center>'.$row["ticket"].'</center></td><td><center>'.$row["fecha"].'</center></td><td><center>'.$row["nombre"].'&nbsp;'.$row["apellido"].'</center></td><td><center>'.$row["categoria"].'</center></td><td><center>'.$row["detalle"].'</center></td><td><center><a href="up_actividad.php?id='.$row["ticket"].'">'.$row["estado"].'</a></center></td><td><center>'.$row["nivel"].'</center></td><td><center>'.$row["tecnico"].'</center></td></tr>';
					$i++;
				}
				mssql_close($s);				
			  ?>
          </table>
      </center></td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
  </table>
</center>
</body>
</html>
