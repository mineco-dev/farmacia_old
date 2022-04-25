<?		
$grupo_id=2; // Para agentes de seguridad 
include("../restringir.php");	
?>
<?
if (isset($_SESSION['id_sale'])) 
	{
		session_unregister('id_sale');	
	}	

//si viene de la pagina principal
if (isset($vis))	
	$consulta = "SELECT * FROM seg_visitas where codigo_estado<3 and codigo_visita='$vis'";
else
//Este script chequea las opciones seleccionadas en el combobox
if ((!isset($cbo_estado)) && (!isset($txt_gafete)))
$consulta = "SELECT * FROM seg_visitas where codigo_estado < 3 ORDER BY codigo_visita desc";
/*--------------------------Cambio en vista ^^^^^^^^^^^ 31-01-2017------------------------------------------*/
/*$consulta = "SELECT     dbo.seg_visitante.nombre_visitante, dbo.seg_visita.codigo_visita, dbo.seg_estado.estado, dbo.seg_visita.gafete_asignado, dbo.seg_visita.fecha_ingreso, dbo.seg_visita.codigo_estado, 
                      dbo.seg_visita.usuario_ingreso, dbo.usuario.nombres, dbo.usuario.apellidos, dbo.seg_visita.impedir_salida
FROM         dbo.seg_visita INNER JOIN
                      dbo.seg_estado ON dbo.seg_estado.codigo_estado = dbo.seg_visita.codigo_estado INNER JOIN
                      dbo.seg_visitante ON dbo.seg_visita.codigo_visitante = dbo.seg_visitante.codigo_visitante INNER JOIN
                      dbo.usuario ON dbo.seg_visita.usuario_ingreso = dbo.usuario.codigo_usuario";*/
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
	if (!numerico(form.txt_gafete.value))
    { 
        alert("Debe ingresar un n�mero de gafete v�lido");
		form.reset();
		form.txt_gafete.focus(); 
		return;
	}

if (form.cbo_estado.value=="0" && form.txt_gafete.value=="")
	{ 
		alert("Seleccione al menos un criterio para la b�squeda"); 	
	}  
function Refrescar(form)
{
	form.reset();
	form.txt_gafete.focus(); 
}
function Abrir_ventana(pagina) 
	{
		var opciones="toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, width=200, height=100, top=85, left=140";
		window.open(pagina,"",opciones);
	}
function numerico(valor)
{ 
	   ticket=valor.toString();
	   var nuLongitud = ticket.length;
	   var i= 0;
	   var bobandera = "TRUE";
	   for(i=0;i<nuLongitud;i++)
	   {
		  switch(ticket.charAt(i))
		  {
				case '1': case '2': case '3':
				case '4': case '5': case '6':
				case '7': case '8': case '9': case '0':
				bobandera = "TRUE";
				break;
				default:
				bobandera = "FALSE";				
		  } //end switch           
	   }//end for
	   if (bobandera == "FALSE") return false
	   else return true;      
}
form.submit();	
}
</script>
<link href="../helpdesk.css" rel="stylesheet" type="text/css">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
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
                <td width="7%"><div align="center"><strong>Detalle de visitas</strong></div></td>
                <td width="8%"><div align="center"><strong>No. de Gafete</strong></div></td>
                <td width="11%"><strong>Pasar a otra dependencia </strong></td>
                <td width="13%"><div align="center"><strong>Fecha ingreso</strong></div></td>
                <td width="28%"><div align="center"><strong>Nombre del visitante</strong></div></td>
                <td width="27%"><div align="center"><strong>Ingresado por: </strong></div></td>
                <td width="6%"><strong>Sale visitante </strong></td>
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
					$estado=$row3["codigo_estado"];
					$impide_salida=$row3["impedir_salida"];     // para regresar la sig linea a su estado original coloca ($estado==2)
					if (($departament_id==37) && ($estado>=1)) // si la visita fue confirmada y la dependencia del usuario logeado es seguridad
					{
						if ($impide_salida==1) echo '<tr class='.$clase.'><td><center><a href="visitas_activas_det.php?id='.$row3["codigo_visita"].'"><img src="../images/iconos/ico_ver.jpg"></a></center></td><td><center>'.$row3["gafete_asignado"].'</center></td><td><center><a href="visita_det.php?id='.$row3["codigo_visita"].'"><img src="../images/iconos/ico_transferir.jpg"></a></center></td><td><center>'.$row3["fecha_ingreso"].'</center></td><td><center>'.$row3["nombre_visitante"].'</a></center></td><td><center>'.$row3["nombres"].'&nbsp;'.$row3["apellidos"].'</center></td><td><center><a href="impide_salida.php?id='.$row3["codigo_visita"].'"><img src="../images/iconos/ico_esperar.jpg"></a></center></td></tr>';
						else echo '<tr class='.$clase.'><td><center><a href="visitas_activas_det.php?id='.$row3["codigo_visita"].'"><img src="../images/iconos/ico_ver.jpg"></a></center></td><td><center>'.$row3["gafete_asignado"].'</center></td><td><center><a href="visita_det.php?id='.$row3["codigo_visita"].'"><img src="../images/iconos/ico_transferir.jpg"></a></center></td><td><center>'.$row3["fecha_ingreso"].'</center></td><td><center>'.$row3["nombre_visitante"].'</a></center></td><td><center>'.$row3["nombres"].'&nbsp;'.$row3["apellidos"].'</center></td><td><center><a href="salida.php?id='.$row3["codigo_visita"].'"><img src="../images/iconos/ico_salir.jpg"></a></center></td></tr>';
					}
					else
					if (($departament_id==37) && ($estado==1)) echo '<tr class='.$clase.'><td><center><a href="visitas_activas_det.php?id='.$row3["codigo_visita"].'"><img src="../images/iconos/ico_ver.jpg"></a></center></td><td><center>'.$row3["gafete_asignado"].'</center></td><td><center><a href="visita_det.php?id='.$row3["codigo_visita"].'"><img src="../images/iconos/ico_transferir.jpg"></a></center></td><td><center>'.$row3["fecha_ingreso"].'</center></td><td><center>'.$row3["nombre_visitante"].'</a></center></td><td><center>'.$row3["nombres"].'&nbsp;'.$row3["apellidos"].'</center></td><td><center><img src="../images/iconos/ico_salir.jpg"></center></td></tr>';
					else echo '<tr class='.$clase.'><td><center><a href="visitas_activas_det.php?id='.$row3["codigo_visita"].'"><img src="../images/iconos/ico_ver.jpg"></a></center></td><td><center>'.$row3["gafete_asignado"].'</center></td><td><center><a href="visita_det.php?id='.$row3["codigo_visita"].'"><img src="../images/iconos/ico_transferir.jpg"></a></center><td><center>'.$row3["fecha_ingreso"].'</center></td><td><center>'.$row3["nombre_visitante"].'</a></center></td><td><center>'.$row3["nombres"].'&nbsp;'.$row3["apellidos"].'</center></td><td><center><a href="impide_salida.php?id='.$row3["codigo_visita"].'"><img src="../images/iconos/ico_esperar.jpg"></a></center></td></tr>';	// es para usuarios que no son de seguridad								
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
