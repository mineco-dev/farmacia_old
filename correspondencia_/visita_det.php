<?	
	//Validar la sesion 
	session_start();	
	if (isset($_SESSION["ultima_visita"])) $ultima_visita=($_SESSION["ultima_visita"]);
	else $ultima_visita=$id;	
	include("../validate.php");
	$grupo_id=3;
    if (($_SESSION["group_id"]) < $grupo_id) 
	include("../logout.php");		
?>
<html>
<head>
<script LANGUAGE="JavaScript">
function Validar(form)
{
 if (form.cbo_dependencia.value == "0" && form.cbo_usuario.value =="0")
  { 
  	alert("Seleccione la dependencia o el nombre de la persona a donde se dirige"); 
	form.cbo_dependencia.focus(); 
	return;
 }
   form.submit();
}
function Refrescar(form)
{
	form.reset();
	form.cbo_dependencia.focus(); 
}
</script>
<link href="../../helpdesk.css" rel="stylesheet" type="text/css">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<style type="text/css">
<!--
.Estilo3 {color: #FFFFFF}
.Estilo4 {
	color: #0000FF;
	font-weight: bold;
}
.Estilo6 {font-size: 16px}
-->
</style>
</head>
<body>
<div align="left">
  <form name="form1" method="post" action="agrega_visita_det.php">
    <table width="100%" border="2" bordercolor="#ECE9D8">
      <tr>
        <td bordercolor="#0000FF"><div align="center"><span class="tcat Estilo6"><strong>A donde se dirige el visitante </strong></span></div></td>
      </tr>
      <tr>
        <td bordercolor="#FFFFFF"><center>
            <table width="100%" border="0" cellspacing="5">
              <tr>
                <td width="6%" height="25">Visitante:</td>
                <td colspan="2" class="titulocategoria">
				  <?					
					$ultima_visita=($_SESSION["ultima_visita"]);   //codigo del ultimo visitante					
					require_once('../../connection/helpdesk.php');  
					$consulta = "select  a.nombre_visitante as visitante, b.codigo_visita from seg_visitante a inner join seg_visita b on a.codigo_visitante=b.codigo_visitante where codigo_visita='$ultima_visita'";
					$result=$query($consulta);
					while($row=$fetch_array($result))		
					{
						echo $row["visitante"];
					}		
				?>				</td>
                <td width="57%">&nbsp;</td>
              </tr>
              <tr>
                <td height="25"><div align="left">Dependencia:</div></td>
                <td height="25" colspan="3"><div align="left"><span class="alt1">
                    <?					
					$consulta1="SELECT * FROM dependencia ORDER BY nombre_dependencia";
					$result1=mssql_query($consulta1);	
					echo('<select name="cbo_dependencia">');
					$nombre=":: Seleccione ::";
					echo'<option value="0">'.$nombre.'</option>';
					while($row1=mssql_fetch_array($result1))
					{
						echo'<option value="'.$row1["codigo_dependencia"].'">'.$row1["nombre_dependencia"].'</option>';
					}
					echo('</select>');					
				?>
                </span></div><div align="center"></div></td>
              </tr>
              <tr>
                <td height="25">Usuario:</td>
                <td height="25"><div align="left"><span class="alt1">
                    <?					
					$consulta2="SELECT * FROM usuario WHERE activo=1 ORDER BY nombres";
					$result2=mssql_query($consulta2);	
					echo('<select name="cbo_usuario">');
					$nombre2=":: Nombre de usuario ::";
					echo'<option value="0">'.$nombre2.'</option>';
					while($row2=mssql_fetch_array($result2))
					{
						echo'<option value="'.$row2["codigo_usuario"].'">'.$row2["nombres"].' '.$row2["apellidos"].'</option>';
					}
					echo('</select>');						
				?>
                </span></div></td>
                <td width="8%"><span class="alt1">
                  <input name="bt_agregar" onClick="Validar(this.form)" type="button" id="bt_agregar2" value="Agregar">
                </span></td>
                <td>&nbsp;</td>
              </tr>
            </table>
        </center></td>
      </tr>
    </table>
    <table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" id="table17">
        <tr align="center" bgcolor="#006699" class="thead">
          <td colspan="2" class="Estilo3 thead"><strong>Dependencia</strong></td>
          <td width="253" class="Estilo3 thead"><strong>Usuario que visita </strong></td>
        </tr>
		<?				
				$consulta3 = "SELECT a.nombre_dependencia, a.codigo_dependencia, b.codigo_usuario, b.nombres, b.apellidos, c.codigo_dependencia, c.codigo_usuario_visitado, c.codigo_visita from seg_visita_det c inner join dependencia a on a.codigo_dependencia=c.codigo_dependencia inner join usuario b on b.codigo_usuario=c.codigo_usuario_visitado where c.codigo_visita='$ultima_visita'";
				$result3=$query($consulta3);
				$i = 0;				
				while($row3=$fetch_array($result3))
				{					
					$clase = "detalletabla2";
					if ($i % 2 == 0) 
					{
						$clase = "detalletabla1";
					}			
						echo '<tr class='.$clase.'><td colspan="2">'.$row3["nombre_dependencia"].'</td><td><center>'.$row3["nombres"].'&nbsp;'.$row3["apellidos"].'</center></td></tr>';
					$i++;
				}
				$close($s);				
				session_write_close();
			 ?>
    </table>
    <table width="100%" border="2" bordercolor="#000000">
      <tr>
        <td width="47%" bordercolor="2" bgcolor="#FFFFFF"><div align="center" class="Estilo4"><a href="equipo_det.php" target="body" class="Estilo4">INGRESAR EQUIPO</a> </div>          </td>
        <td width="53%" bordercolor="2" bgcolor="#FFFFFF"><div align="center"><span class="Estilo4"><a href="index.php" target="body" class="Estilo4">FINALIZAR</a></span></div></td>
      </tr>
    </table>
    <p align="center">&nbsp;</p>
  </form>
  <p>&nbsp;</p>
</div>
<!-- /forum rules and admin links -->
<br />
			<div align="left"></div>
            
</body>

</html>
