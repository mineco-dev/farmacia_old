<?	

//include('../includes/inc_header_sistema2.inc');
//conectardb($reloj_marcaje);

require("../../includes/funciones.php");
require("../../includes/sqlcommand.inc");
	conectardb($reloj_marcaje);

?>
<html>
<head>
<script LANGUAGE="JavaScript">
function Validar(form)
{
  if (form.txt_buscar.value == "")
  { 
  	alert("Puede buscar "); 
	form.txt_buscar.focus(); 
	return;
  }  
function Refrescar(form)
{
	form.reset();
	form.txt_buscar.focus(); 
}
form.submit();
}
</script>
<link href="css/helpdesk.css" rel="stylesheet" type="text/css">
<link href="css/box_ie.css" rel="stylesheet" type="text/css" media="screen">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<style type="text/css">
<!--
.Estilo3 {color: #FFFFFF}
.Estilo4 {font-size: 9px}
.style2 {
	font-family: "Times New Roman", Times, serif;
	font-size: 24px;
	color: #666666;
}
-->
</style>
</head>

<body>

<div align="left">

    <table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#000000">
      <tr>
        <td><div align="center">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="13%">&nbsp;</td>
              <td width="72%"><div align="center" class="legal1">
                <p>Listado </p>
                </div></td>
                
              <td width="15%"><div align="center"><img src="img/logo_rpt.gif" width="107" height="113"></div></td>
            </tr>
            <tr>
              <td colspan="2"><?PHP 
			  
			  if ($cboMesi < 10)
			  {
			  	$cboMesi = '0'.$cboMesi;
			  }

			  if ($cboMesf < 10)
			  {
			  	$cboMesf = '0'.$cboMesf;
			  }

			  if ($cboDiai < 10)
			  {
			  	$cboDiai = '0'.$cboDiai;
			  }

			  if ($cboDiaf < 10)
			  {
			  	$cboDiaf = '0'.$cboDiaf;
			  }
			  
			  
			  
				$fecha1 = $cboDiai.'/'.$cboMesi.'/'.$cboAnioi;
				$fecha2 = $cboDiaf.'/'.$cboMesf.'/'.$cboAniof;
				$fechahora1 = $cboAnioi.'-'.$cboMesi.'-'.$cboDiai.' 00:00:00';
				$fechahora2 = $cboAniof.'-'.$cboMesf.'-'.$cboDiaf.' 24:59:59';								
				$fecha1h = $fecha1.' 00:00:00';
				$fecha2h = $fecha2.' 24:59:59';		
				echo 'Reporte del '.$cboDiai.'/'.$cboMesi.'/'.$cboAnioi.' al '.$cboDiaf.'/'.$cboMesf.'/'.$cboAniof;
		?>
        
        </td>
              <td><p>&nbsp;</p>
              <p>&nbsp;</p></td>
            </tr>
          </table>
          </div></td>
      </tr>
      
      <tr>
      <td>
      
      </td>
      </tr>
    </table>
    
	
<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" id="table17">     
<td>

<table >
<tr>
<td>NOMBRE</td>
</tr>

<tr>
<td>
<input name="NOMBRE" type="text" value="<? print ($nombre); ?>" size="15" maxlength="10">


</td>
</tr>



</table>
</td>
<tr>
        <td colspan="2"></thead>
    <tr align="center" bgcolor="#006699" class="boxTitleBgLightBlue">
          <td colspan="2"><strong>Nombre</strong></td>
          <td width="18%"><strong>Dependencia</strong></td>
      <td width="16%"><strong>Hora Salida</strong></td>
	  <td width="17%">Horas Extras</td>
	  <td width="17%">Total Horas Extras</td>
	  <td width="18%">Nombre</td>
      <td width="3%">&nbsp;</td>
</tr>
<?				


//$query="select * from CHECKINOUT";
 $query = "SELECT ui.NAME,  d.DEPTNAME, convert (varchar (12),c.CHECKTIME,108)fecha1, 
 			CONVERT(varchar(12), c.CHECKTIME,120) as fecha2
			FROM USERINFO ui
			inner join DEPARTMENTS d on d.DEPTID = ui.DEFAULTDEPTID
			inner join CHECKINOUT c on c.USERID = ui.USERID
		where 
		CONVERT(varchar(20), c.checktime, 120) >= '".fechahora1."' and 
		CONVERT(varchar(20), c.checktime, 120) <= '".$fechahora2."' 
		order by fecha desc";
	
		$do=mssql_query($query);
				$i = 0;									
				$tmp = 0;
										
				while($vector = mssql_fetch_row($do))
				{	
					$err = 0;
		
					include("css/format_table.php");									
					echo '<tr class='.$clase.'><td colspan="2">'.$vector[0].'</td><td>'.$vector[1].'</td><td>'.$vector[2].'</td><td>'.$vector[5].'</td><td>'.$vector[4].'</td><td>'.substr($vector[3],0,100).'...</td><td>'.$vector[6].'</td></tr>';										
					$tmp++;
					$i++;
					
				}				
				mssql_free_result($do);
?>
		<td width="9%"></td>
      </tbody><?PHP
	  	
	  ?>
  </table>

  <p>&nbsp;</p>
</div>
<!-- /forum rules and admin links -->
<br />
			<div align="left"></div>
            
</body>

</html>
