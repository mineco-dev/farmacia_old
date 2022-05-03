<?		
	$grupo_id=8;
	include("../restringir.php");
	if (isset($_SESSION["editar_ticket"])) 
	{
		session_unregister("editar_ticket");	
	}	
?>
<html>
<head>
<script LANGUAGE="JavaScript">
function Validar(form)
{
  if (form.cbo_tickets.value == "0")
  { 
  	alert("Seleccione un n�mero de ticket"); 
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
.Estilo1 {font-size: 12px}
.Estilo3 {color: #FFFFFF}
-->
</style>
</head>

<body>

<div align="left">
  <form name="form1" method="post" action="">
    <table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" id="table17">
      <tr>
        <td width="7%" class="tcat"><div align="left"></div>            
          <div align="center">
            <?
					$query2="SELECT * FROM soporte WHERE codigo_dependencia='$dependencia' and codigo_estado<4 order by codigo_estado";					
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
				?>
          </div></td>
        <td width="15%" class="tcat"><div align="center">
            <input name="bt_buscar" onClick="Validar(this.form)" type="button" id="bt_buscar4" value="Iniciar B&uacute;squeda">
        </div></td>
        <td colspan="3" class="tcat"><div align="left">Listado de tickets pendientes </div></td>
        </tr>
      </thead>
        <tr align="center" bgcolor="#006699" class="thead">
          <td class="thead Estilo3"><strong>N&uacute;mero</strong></td>
          <td colspan="2" class="Estilo3 thead"><strong>Descripci&oacute;n</strong></td>
          <td width="23%" class="Estilo3 thead"><strong>Responsable</strong></td>
          <td width="14%" class="thead Estilo3"><span class="Estilo3 thead"><strong>Editar</strong></span><span class="Estilo3 thead"></span></td>
        </tr>
		<?
				if (isset($cbo_tickets))
					$consulta = "SELECT * FROM view_reporte_pend_completado where ticket='$cbo_tickets'";
				else
				$consulta = "SELECT * FROM view_reporte_pend_completado where codigo_dependencia='$dependencia' and estatus<4";					
				require_once('../connection/helpdesk.php');							
				$result=$query($consulta);
				$i = 0;				
				while($row=$fetch_array($result))
				{
					$clase = "detalletabla2";
					if ($i % 2 == 0) 
					{
						$clase = "detalletabla1";
					}
					echo '<tr class='.$clase.'><td>'.$row["ticket"].'</td><td colspan="2">'.$row["descripcion"].'</td><td>'.$row["nombre_dependencia"].'</td><td><center><a href="geditar_tickets.php?id='.$row["ticket"].'"><img src="imagenes/iconos/ico_editar.jpg"></a></center></td></tr>';					
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
