<?	
$grupo_id=5;
include("../restringir.php");	
?>
<?
//Este script chequea las opciones seleccionadas en el combobox
if (isset($cat)) $consulta = "SELECT * FROM view_soporte where codigo_categoria='$cat'";
else
if (isset($hoy)) $consulta = "SELECT * FROM view_soporte where ticket='$hoy'";
else
  if ((!isset($cbo_tecnico)) && (!isset($cbo_estado)))
	$consulta = "SELECT * FROM view_soporte where codigo_dependencia='$dependencia'";
	else
		if (($cbo_tecnico>0) && ($cbo_estado==0))
		$consulta = "SELECT * FROM view_soporte where codigo_tecnico='$cbo_tecnico' and codigo_dependencia='$dependencia'";
		else
			if (($cbo_tecnico==0) && ($cbo_estado>0))
			$consulta = "SELECT * FROM view_soporte where codigo_estado='$cbo_estado' and codigo_dependencia='$dependencia'";
			else
				if (($cbo_tecnico==0) && ($cbo_estado==0))
					$consulta = "SELECT * FROM view_soporte and codigo_dependencia='$dependencia'";
					else					
					$consulta = "SELECT * FROM view_soporte where codigo_tecnico='$cbo_tecnico' and codigo_estado='$cbo_estado' and codigo_dependencia='$dependencia'";
?>
<html>
<head>
<script language="JavaScript">
function Validar(form)
{
 if (form.cbo_tecnico.value == "0" && form.cbo_estado.value=="0")
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
<link href="../helpdesk.css" rel="stylesheet" type="text/css">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<META HTTP-EQUIV="REFRESH" CONTENT="100;URL=actividad.php">
<style type="text/css">
<!--
.Estilo1 {color: #FFFFFF}
.Estilo2 {
	color: #333333;
	font-weight: bold;
}
-->
</style>
</head>
<body>
<center>
  <form name="form1" method="post" action="">
    <table width="90%" border="0" bordercolor="#0000FF">
      <tr>
        <td colspan="3"><div align="center"><strong>Detalle de actividades pendientes </strong></div></td>
        <td><div align="center"></div></td>
      </tr>
      <tr bgcolor="#FFFFFF" class="error">
        <td width="26%"><div align="center" class="Estilo1"> <a href="actividad.php" target="body">[Ver todas] </a> </div></td>
        <td width="39%"><span class="Estilo1">
          <?
		  			if ($dependencia==46) $cbo_usuario="SELECT * FROM usuario WHERE activo=1 and codigo_usuario IN (20, 382, 96, 328, 384, 422, 572) ORDER BY nombres";
					else					
					if ($dependencia==10) $cbo_usuario="SELECT * FROM usuario WHERE activo=1 and codigo_usuario IN (544, 633, 328, 648, 414, 365, 96,712,700) ORDER BY nombres";
					else $cbo_usuario="SELECT * FROM usuario WHERE activo=1 and codigo_dependencia='$dependencia' ORDER BY nombres";
					require_once('../Connection/helpdesk.php'); 
				//	$query="SELECT * FROM usuario WHERE activo=1 and codigo_dependencia='$dependencia' ORDER BY nombres";
					$result=mssql_query($cbo_usuario);	
					echo('<select name="cbo_tecnico">');

					$nombre=":: Personal asignado ::";
					echo'<option value="0">'.$nombre.'</option>';
					while($row=mssql_fetch_array($result))
					{
						echo'<option value="'.$row["codigo_usuario"].'">'.$row["nombres"].' '.$row["apellidos"].'</option>';
					}
					echo('</select>');										 								
				?>
        </span>        </td>
        <td width="17%"><span class="Estilo1">
          <?
					$query2="SELECT * FROM estado where codigo_estado<5 ORDER BY nombre_estado";
					$result2=mssql_query($query2);	
					echo('<select name="cbo_estado">');
					$nombre=":: Estado de la solicitud ::";
					echo'<option value="0">'.$nombre.'</option>';
					while($row2=mssql_fetch_array($result2))
					{
						echo'<option value="'.$row2["codigo_estado"].'">'.$row2["nombre_estado"].'</option>';
					}
					echo('</select>');											 								
				?>
        </span></td>
        <td width="18%"><input name="Submit" type="submit" onClick="Validar(this.form)" value="Realizar B&uacute;squeda"></td>
      </tr>
      <tr>
        <td colspan="4"><center>
            <table width="99%" border="0" class="tablaazul">
              <tr class="detalletabla2">
                <td width="8%"><div align="center"><strong># Ticket </strong></div></td>
                <td width="11%"><div align="center"><strong>Fecha</strong></div></td>
                <td width="11%" bordercolor="#000000"><div align="center"><strong>Nombre</strong></div>
                    <div align="center"></div></td>
                <td width="18%" bordercolor="#000000"><div align="center"><strong>IP</strong></div></td>
                <td width="20%"><div align="center" class="Estilo2">Asistencia para: </div></td>
                <td width="13%"><div align="center"><strong>Estado</strong></div></td>
                <td width="6%"><div align="center"><strong>Nivel</strong></div></td>
               <td width="6%"><div align="center"><strong>Fecha Asignacion</strong></div></td>
                <td width="13%"><div align="center"><strong>Atiende</strong> </div></td>
              </tr>
              <?			  			
							$result3=mssql_query($consulta);
				$i = 0;
				while($row3=mssql_fetch_array($result3))
				{
					$color_estado="color_rojo";
					if ($row3["codigo_estado"]==1) $color_estado="color_rojo";
					else 
						if ($row3["codigo_estado"]==2) $color_estado="color_amarillo";
						else 
							$color_estado="color_verde";
					$clase = "detalletabla2";
					if ($i % 2 == 0) 
					{
						$clase = "detalletabla1";
					}					
                	echo '<tr class='.$clase.'><td><center>'.$row3["ticket"].'</center></td><td><center>'.$row3["fecha"].'</center></td><td><center>'.$row3["nombre"].'&nbsp;'.$row3["apellido"].'</center></td><td><center>'.$row3["ip"].'</center></td><td><center>'.$row3["categoria"].'</center></td><td class='.$color_estado.'><center><a href="up_actividad.php?id='.$row3["ticket"].'">'.$row3["estado"].'</a></center></td><td><center>'.$row3["nivel"].'</center></td><td><center>'.$row3["fecha_inicio"].'</center></td><td><center>'.$row3["tecnico"].'</center></td></tr>';					
				echo' <tr class='.$clase.'><td><center><a href="comentario.php?id='.$row3["ticket"].'"><img src="imagenes/iconos/ico_msj.jpg" alt="Agregar un comentario de seguimiento"></a></center></td><td colspan="7"><center>'.$row3["detalle"].'</center></td></tr>';	
				
				echo '<tr class='.$clase.'><td><a href="actividad1.php?id='.$row3["ticket"].' '.$row3["fecha"].'&nbsp;'.$row3["nombres"].' ESCRIBI�: -->'.$row3["detalle"].'" ><img src="Imagenes/iconos/ico_ver.jpg" /> </td></tr>';
																																	
				/*echo '<tr class='.$clase.'><td><center><img src="imagenes/iconos/ico_ver.jpg" alt="Ver comentarios de seguimiento">'.$row3["ticket"].'</center></td></tr>';*/
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
