<?	
$grupo_id=9;
include("../restringir.php");	
?>
<?
	$gisett=(int)date("w");
	$mesnum=(int)date("m");
	$hora = date(" H:i",time());	
?>
<html>
<head>
<link href="../helpdesk.css" rel="stylesheet" type="text/css">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
<!--
.Estilo2 {font-size: xx-small}
.Estilo3 {font-size: medium}
.Estilo4 {font-size: 12px}
-->
</style>
</head>

<body>
<center>
<p class="Estilo2"><span class="Estilo2">MINISTERIO DE ECONOMIA <BR>
      <strong>AYUDA DE MEMORIA </strong><br>
      <strong><? if ($dependencia==10) echo "COMITE GERENCIAL";  
	  else echo "COMITE DE MODERNIZACION Y FORTALECIMIENTO INSTITUCIONAL"; ?><BR>
    No. <? echo $txt_numero ?><br>
    Reuni&oacute;n: <? echo $txt_fecha ?></strong></p>
  <table width="92%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td class="Estilo2"><? echo $txt_asistentes?></td>
    </tr>
  </table>
  <table width="92%" border="0" bordercolor="#0000FF">
    <tr>
      <td width="100%"><center>
          <table width="99%" border="1" cellpadding="0" cellspacing="0" class="tablaazul">
            <tr bgcolor="#FFFFFF">
              <td width="5%"><div align="center"><strong><span class="Estilo3">No</span>.</strong></div></td>
              <td width="16%"><div align="center"><strong>Descripci&oacute;n de actividades </strong></div></td>
              <td width="19%"><div align="center"><strong>Responsable</strong></div>
              <div align="center"></div></td>
              <td width="9%"><div align="center">
                <p><strong>Fecha </strong><span class="Estilo2">seguimiento / cumplimiento</span></p>
                </div></td>
              <td width="51%"><div align="center"><strong>Observaciones</strong></div>                <div align="center"></div>                <div align="center"></div>                <div align="center"></div></td>
            </tr>
            <?
			  	require_once('../connection/helpdesk.php');
				$consulta = "Select * from view_reporte_pend_completado where codigo_dependencia='$dependencia'";
				$result=mssql_query($consulta);				
				while($row=mssql_fetch_array($result))
				{						
					echo '<tr class="detalletabla6" cellpadding="0" cellspacing="0"><td class="Estilo3"><center>'.$row["ticket"].'</td><td><center>'.$row["descripcion"].'</center></td><td><center>'.$row["nombre_dependencia"].'</center></td><td><center>'.$row["fecha_seguimiento"].'</center></td><td><div align="justify">'.$row["detalle"].'</div></td></tr>';
					$ticket=$row["ticket"];		
						if ($cbo_seguimiento==2)															
							$consulta2= "Select top 1 * from view_seguimiento where codigo_soporte='$ticket' order by codigo_seguimiento desc";							
							else
								$consulta2= "Select * from view_seguimiento where codigo_soporte='$ticket'";
						$result2=mssql_query($consulta2);
						while($row2=mssql_fetch_array($result2))
						{						
                			echo '<tr class="detalletabla5" cellpadding="0" cellspacing="0"><td colspan="2" align=right>'.$row2["fecha"].'</td><td colspan="5">'.$row2["detalle"].'</td></tr>';
						}					
				}
				mssql_close($s);
			  ?>
          </table>
      </center></td>
    </tr>
    <tr>
      <td>
      </td>
    </tr>
  </table>
  <table width="92%" cellpadding="0" cellspacing="0">
    <tr>
      <td width="290" class="xl66 Estilo2">&nbsp;</td>
      <td width="65" class="xl70 Estilo2"></td>
      <td width="228" class="xl70 Estilo2"></td>
      <td class="xl68 Estilo2">&nbsp;</td>
    </tr>
    <tr>
      <td valign="top" class="xl66 Estilo2">&nbsp;</td>
      <td class="xl70"><div align="center"><span class="Estilo2"></span></div></td>
      <td class="xl70"><div align="center"><span class="Estilo2"></span></div></td>
      <td width="309" valign="top" class="xl65"><div align="center"><span class="Estilo2"></span></div></td>
    </tr>
   <tr>
   <?
   if ($dependencia==10) include("minuta_footer_comite.php");
   else include("minuta_footer_comofi.php");
   ?>
   </tr>
  </table>  
</center>
</body>
</html>
