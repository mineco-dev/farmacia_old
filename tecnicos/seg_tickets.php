<?		
	$grupo_id=5;
	include("../restringir.php");
?>
<html>
<head>
<script LANGUAGE="JavaScript">
function Validar(form)
{
  if ((form.cbo_tickets.value == "0") && (form.cbo_historico.value == "2"))
  { 
  	alert("Seleccione un n�mero de ticket � seleccione SI para ver hist�rico"); 
	form.cbo_tickets.focus(); 
	return;
 }
  form.submit();
}
function Refrescar(form)
{
	form.reset();
	form.cbo_tickets.focus(); 
}
</script>
<link href="../helpdesk.css" rel="stylesheet" type="text/css">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<style type="text/css">
<!--
.Estilo3 {color: #FFFFFF}
-->
</style>
</head>

<body>

<div align="left">
  <form name="form1" method="post" action="">
    <div align="center"></div>
    <table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" id="table17">
      <tr>
        <td colspan="4" class="tcat"><div align="left"><strong>Listado de tickets por servicios solicitados </strong></div></td>
        <td colspan="2" class="tcat"><div align="right"><img src="../images/leyend.GIF" width="250" height="21"></div></td>
      </tr>
      <tr>
        <td colspan="6" class="tcat"><div align="left"></div>          
          Consultar por # de ticket
          <?
					$query2="SELECT * FROM soporte WHERE codigo_usuario='$user_id' and codigo_estado <4 order by codigo_soporte";					
					require_once('../Connection/helpdesk.php'); 					
					$result2=mssql_query($query2);	
					echo('<select name="cbo_tickets">');
					$nombre=":: Seleccione ::";
					echo'<option value="0">'.$nombre.'</option>';
					while($row2=mssql_fetch_array($result2))
					{
						echo'<option value="'.$row2["codigo_soporte"].'">'.$row2["codigo_soporte"].'</option>';
					}
					echo('</select>');				
					mssql_close($s);					
				?> &oacute; ver historial de tickets
          <select name="cbo_historico" size="1" id="cbo_historico">
            <option value="2">NO</option>
            <option value="1">SI</option>
          </select>
        <input name="bt_buscar" onClick="Validar(this.form)" type="button" id="bt_buscar4" value="Iniciar B&uacute;squeda">          <div align="right"></div></td>
      </tr>
        <tr align="center" bgcolor="#006699" class="thead">
          <td width="6%" class="Estilo3 thead"><strong>Ticket</strong></td>
          <td width="18%" class="thead Estilo3"><strong>Fecha solicitado </strong></td>
          <td width="19%" class="Estilo3 thead"><strong>Categor&iacute;a</strong></td>
          <td width="25%" class="Estilo3 thead"><strong>Solicitado a</strong></td>
          <td width="26%" class="thead Estilo3"><strong>Atendido por </strong></td>
          <td width="6%" class="thead Estilo3"><span class="Estilo3 thead"><strong>Detalle</strong></span><span class="Estilo3 thead"></span></td>
        </tr>
		<?
				if (isset($cbo_tickets))
					$consulta = "SELECT * FROM view_seg_ticket where ticket='$cbo_tickets'";
				if (isset($cbo_historico))
				{
					if ($cbo_historico==1)
					$consulta = "SELECT * FROM view_seg_ticket where codigo_usuario='$user_id' and estatus=4 order by estatus";
				}
				else
				$consulta = "SELECT * FROM view_seg_ticket where codigo_usuario='$user_id' and estatus<4 order by estatus";					
				require_once('../connection/helpdesk.php');							
				$result=$query($consulta);
				$i = 0;				
				while($row=$fetch_array($result))
				{
					$color_estado="color_verde";
					if ($row["estatus"]==1) $color_estado="color_rojo";
					else 
						if ($row["estatus"]==2) $color_estado="color_amarillo";
					$clase = "detalletabla2";
					if ($i % 2 == 0) 
					{
						$clase = "detalletabla1";
					}
					echo '<tr class='.$clase.'><td>'.$row["ticket"].'</td><td>'.$row["solicitado"].'</td><td>'.$row["categoria"].'</td><td>'.$row["nombre_dependencia"].'</td><td>'.$row["tecnico"].'&nbsp;'.$row["apellido_tecnico"].'</td><td class='.$color_estado.'><center><a href="gseg_tickets.php?id='.$row["ticket"].'"><img src="imagenes/iconos/ico_ver.jpg"></a></center></td></tr>';					
					$i++;
				}
				$close($s);
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
