<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?
		//session_start();
		include('conectarse.php');
		include('../includes/inc_header_sistema.inc');
		include('funcion.php');
	
	
	
	
	
	
	function fecha(){
	$mes = date("n");
	$mesArray = array(
		1 => "Enero", 
		2 => "Febrero", 
		3 => "Marzo", 
		4 => "Abril", 
		5 => "Mayo", 
		6 => "Junio", 
		7 => "Julio", 
		8 => "Agosto", 
		9 => "Septiembre", 
		10 => "Octubre", 
		11 => "Noviembre", 
		12 => "Diciembre"
	);

	$semana = date("D");
	$semanaArray = array(
		"Mon" => "Lunes", 
		"Tue" => "Martes", 
		"Wed" => "Miercoles", 
		"Thu" => "Jueves", 
		"Fri" => "Viernes", 
		"Sat" => "S�bado", 
		"Sun" => "Domingo", 
	);
	
	$mesReturn = $mesArray[$mes];
	$semanaReturn = $semanaArray[$semana];
	$dia = date("d");
	$a�o = date ("Y");
	
return $semanaReturn." ".$dia." de ".$mesReturn." de ".$a�o;
}
	
	
	
	
		

		function anotaciones($codpersona)
{	
		
	$value = "select gafete from asesor where idasesor = '$codpersona'";
	$gaf = mssql_query($value);
	$gafete = mssql_fetch_array($gaf);
	
							
		$qry_insertar_notas ="select x.id_observaciones, y.observacion, x.observacion, x.adjunto,convert(varchar(10),x.fecha,21) from tb_observaciones x,
 tb_observacion y where x.tipo_observacion = y.codigo_observacion and x.idasesor = '$codpersona'";
		$result = mssql_query($qry_insertar_notas);	
					$cnt = 1;
					$x = fecha();
					while ($vec = mssql_fetch_array($result))
					{	
					
					
		 					  print '';
		  					  print"<tr> ";
  							  print "<input type='hidden' name='cuenta[".$cnt."]'/>";
							  print"<input name='masterkey[".$cnt."]' type='hidden' value=".$vec[0].">";
							  print"<input name='mllave[".$cnt."]' type='hidden' value=".$vec[0].">";
							  print"<TD width='120'><span class='style9'>$vec[1]</span></TD>";
  							  print"<TD width='200'><span class='style9'>$vec[4]</span></TD>";							  
							  print"<TD width='350'><span class='style9'>$vec[2]</span></TD>";							  						  							
							  print "<td width='110'> <a href='fotos/".$gafete[0]."/notas/".$vec[3]."' target = '_blank'>ver</a></td>";
							  						
							  print"</tr>";		 																				
							  
					
						
					
						
						$cnt ++;
					}
					print "<tr> ".$x." </tr>";
					
						
		}

		
		
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>

<script language="JavaScript" src="calendar_db.js"></script>
<link rel="stylesheet" href="calendar.css">
<link href="../css/cssWeb.css" type=text/css rel=StyleSheet>
<style type="text/css">
<!--
.Estilo1 {	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.Estilo2 {	color: #FFFFFF;
	font-weight: bold;
	font-size: 16px;
}
.Estilo67 {font-size: 9px}
.Estilo68 {font-size: 16px}
.Estilo7 {font-family: Arial, Helvetica, sans-serif}
.Estilo22 {font-size: 11px}
.Estilo6 {color: #FF0000}
.Estilo31 {font-size: 12px; font-weight: bold; }
.Estilo47 {color: #000000}
.style9 {font-size: 13px}
-->
</style>

</head>
<body>
<p>
  <?
		$fecha_naci =  "$ano-$mes-$dia";  

		$sqpersona = "SELECT nombre,nombre2,nombre3,apellido,apellido2, 
		apellidocasada, sexo, cedula,  nit, activo, colonia, aldea1, caserio, calle, numero,idmunicipio_nac, idregistro, estadocivil, nacionalidad, codigo_profesion, idmunicipio_reside, pasaporte,
		nombre_estado_provincia, year(fecha_nacimiento),month(fecha_nacimiento),day(fecha_nacimiento),zona,tipolicencia,licencia,iddepartamento_reside,gafete,idgrupoetnico,direccion_para_notificaciones,igss,empadronamiento,gruposanguineo,altura,peso,idasesor,userfilefoto,iddepartamento_nac FROM asesor WHERE gafete = '$num_gafete'";
		
		$resultado = mssql_query($sqpersona);
		$row = mssql_fetch_array($resultado);
		
		

		

?>
</p>
<p align="center" class="MenuUnderline"><em>Ministerio de Economia Guatemala, C.A. Ficha de Empleado</em></p>
<table width="64%" border="0" align="center" cellpadding="0" cellspacing="0" class="BasicFontInBorder4">
<tr>
<td height="318">
<table width="100%" border="0" align="left" cellspacing="0">
      <tr class="Estilo1">
        <td height="34" class="Estilo22" >&nbsp;</td>
        <td class="BlueBasicFontNoAlign">&nbsp;</td>
        <td class="Estilo7">&nbsp;</td>
        <td rowspan="4"><?
			if (!empty($row[39]) )
			{
				
				print '<img src="fotos/'.trim($num_gafete).'/'.$row[39].'" width="73" height="89" />';
			}
				
			?>        </td>
      </tr>
<tr class="Estilo1">
        <td height="34" class="Estilo22" ><strong class="SaveUser">Numero de DPI:</strong></td>
        <td class="BlueBasicFontNoAlign"><span class="Estilo22"><strong>
          <? echo $row[30];?>
          &nbsp;&nbsp;</strong></span></td>
        <td width="119" class="Estilo7"><strong>
          <input name="num_gafete2" type="hidden" id="num_gafete2" size="18" value="<? echo $row[30];?>"/>
        </strong></td>
      </tr>
      <tr class="Estilo1">
        <td height="23" class="Estilo22" >&nbsp;</td>
        <td class="BlueBasicFontNoAlign"><p>&nbsp;</p></td>
        <td class="Estilo7">&nbsp;</td>
      </tr>
      <tr class="Estilo1">
        <td height="34" class="Estilo22" >&nbsp;</td>
        <td class="BlueBasicFontNoAlign">&nbsp;</td>
        <td class="Estilo7">&nbsp;</td>
      </tr>
      <tr class="Estilo1">
        <td width="119" height="34" class="QuoteNameWriting" > Primer Nombre</td>
        <td width="235" class="BlueBasicFontNoAlign"><? echo $row[0];?></td>
        <td class="QuoteNameWriting"><div align="right" class="Estilo22">Segundo Nombre </div></td>
        <td width="210" class="BlueBasicFontNoAlign"><? echo $row[1];?></td>
      </tr>
      <tr class="Estilo7">
        <td class="QuoteNameWriting"><span class="Estilo22">Tercer Nombre</span></td>
        <td class="BlueBasicFontNoAlign"><? echo $row[2];?></td>
        <td class="QuoteNameWriting"><div align="right" class="Estilo22">Primer Apellido</div></td>
        <td class="BlueBasicFontNoAlign"><? echo $row[3];?></td>
      </tr>
      <tr class="Estilo7">
        <td class="QuoteNameWriting"><span class="Estilo22">Segundo Apellido</span></td>
        <td class="BlueBasicFontNoAlign"><? echo $row[4];?></td>
        <td class="QuoteNameWriting"><div align="right"><span class="Estilo22">Apellido de Casada</span></div></td>
        <td colspan="5" class="BlueBasicFontNoAlign"><? echo $row[5];?></td>
      </tr>
      <tr class="Estilo7">
        <td class="QuoteNameWriting"><span class="Estilo22">Estado Civil</span></td>
        <td class="BlueBasicFontNoAlign"><span class="Estilo22">

            <? if ($row['nacionalidad'] == 'S')
				{
					print 'Soltero(a)'; 
               
	
				}else{
					print 'Casado (a)';
				}
				?>

        </span></td>
        <td class="QuoteNameWriting"><div align="right" class="Estilo22">Fecha nacimiento<font color="#FF0000"></font></div></td>
        <td colspan="5" class="BlueBasicFontNoAlign"><span class="Estilo22">&nbsp;<?
	$i=1;
		
	 while ($i<=31)
	  {
	  if ($i == $row[25])
	  {
	  	print $i;
	  }
	  
	  $i++;
	 } 
	
	 
	?>
        /
            <?
	$i=1;
		
	 while ($i<=12)
	  {
			  if ($i == $row[24])
			  {
				print $i;
			  }
			  
			  $i++;
	  }
	
	?>
        / 
            <?
	 $i=1900;		
	 while ($i<=date('Y'))
	  {
		  if ($i == $row[23])
		  {
			print $i;
		  } 
	  $i++;
	  }
	
	 
	?>
         
          <!--input name="edad" type="text" id="nacimiento" size="5"-->
        </span></td>
      </tr>
      <tr class="Estilo1">
        <td class="QuoteNameWriting"><span class="Estilo22">Sexo:</span></td>
        <td class="BlueBasicFontNoAlign"><span class="Estilo22">
          <?
				if ($row[6]=='M')
				{
				print ' M
              <input selected name="sexo" type="radio" value="M" checked="checked"/>
              F
              <input name="sexo" type="radio" value="F" />
			';					
				}else{
				
				print ' M
              <input name="sexo" type="radio" value="M" />
              F
              <input name="sexo" type="radio" value="F" checked="checked" />
			';			
					
				}
				
            ?>
        </span></td>
      </tr>
      <tr class="Estilo1">
        <td class="QuoteNameWriting">Nit</td>
        <td class="BlueBasicFontNoAlign"><? echo $row[8];?></td>
        <!--td colspan="2" class="Estilo7"><div align="right" class="Estilo22">Igss</div></td-->
      </tr>
      <tr class="Estilo1">
            <td class="QuoteNameWriting"><span class="Estilo22">Nacionalidad:</span></td>
        	<td class="BlueBasicFontNoAlign"><span class="Estilo22">
          		<?	if($row['nacionalidad'] == 1)
					{
						print ("Guatemalteca");
					} 
					else
					{
						print("Otro");
					}
					?>
        	</span></td>
              <td class="QuoteNameWriting"><div align="right" class="Estilo22">Departamento: </div></td>
			  <td class="BlueBasicFontNoAlign"><span class="Estilo22">
          		<? $dep_nac = $row['iddepartamento_nac']; $sqlrs = "select dpi.codigo_registro,dpi.registro, dep.nombre_departamento, dep.codigo_departamento from dbo.tb_registro as dpi inner join dbo.tb_departamento as dep on dpi.codigo_departamento= dep.codigo_departamento where dpi.codigo_departamento > 0 ";
			$resultrs = mssql_query($sqlrs);
			while ($vec = mssql_fetch_array($resultrs))
			  {
			  if ($dep_nac ==  $vec[0] )
					{
						echo $vec['nombre_departamento'];		
					}else{
						echo $row['nombre_departamento'];		
					}

			  }
			  	?>
        	</span></td>
			<tr>
			<td class="QuoteNameWriting"><span class="Estilo22">Municipio: </span></td>
			  <td class="BlueBasicFontNoAlign"><span class="Estilo22">
          		 <?
				   $depar_naci = $row['iddepartamento_nac']; 
				    $sql2 = "select codigo_departamento from tb_registro where codigo_registro = $depar_naci";
	$result = mssql_query($sql2);
	$res = mssql_fetch_array($result);
	$cdepartamento = $res['codigo_departamento']; 
	
			$sql22 = " select codigo_municipio, nombre_municipio, muestra_muni from tb_municipio where codigo_departamento = $cdepartamento";
			$result22 = mssql_query($sql22);
			$vec = mssql_fetch_array($result22);
			  if ( $vec[0] == $row['idmunicipio_nac'] )
					{
						echo $vec['nombre_municipio'];		
					}else{
						echo $vec['nombre_municipio'];
					}		
			 ?>
        	</span></td>
			<td class="QuoteNameWriting"><div align="right" class="Estilo22">Grupo etnico: </div></td>
			  <td class="BlueBasicFontNoAlign"><span class="Estilo22">
          		<? $gpEtnico = $row['idgrupoetnico'];
			$sqlet = "select grupoetnico from asesor_grupoetnico where idgrupoetnico = $gpEtnico";
			$resultet = mssql_query($sqlet);
			$grupoet = mssql_fetch_array($resultet);
			echo $grupoet['grupoetnico'];		
				?>
        	</span></td>
			</tr>
			<span class="Estilo22">
          
          </span></td>
		  
      </tr>
	  <tr>
			<td class="QuoteNameWriting"><span class="Estilo22">Numero de telefono: </span></td>
			  <td class="BlueBasicFontNoAlign"><span class="Estilo22">
          		 <?
				 	echo $row['cedula'];	
			 ?>
        	</span></td>
			<td class="QuoteNameWriting"><div align="right" class="Estilo22">Tipo de licencia: </div></td>
			  <td class="BlueBasicFontNoAlign"><span class="Estilo22">
          		</span>
				<span> <? echo $row['tipolicencia']; ?></span>
        	</span>&nbsp; </span><span class="Estilo73"><font color="#000000">Numero: </font></span><span class="Estilo22"><? echo $row['licencia']; ?></span></td>
			</tr>
			<tr>
			<td class="QuoteNameWriting"><span class="Estilo22">Lugar de nacimiento: </span></td>
			  <td class="BlueBasicFontNoAlign"><span class="Estilo22">
          		 
        	</span></td>
			<td class="QuoteNameWriting"><div align="right" class="Estilo22">DPI extendido en: </div></td>
			  
			</tr>
			
			
			
			
		  
      </tr>
      <tr class="Estilo7">
        <td height="87" colspan="4" class="Estilo7">
		
		
		
			<table width="100%">				
	<tr>
	 	
	</tr>
	    
			  
	 <table width="100%" 
                        border="0" align="center" cellpadding="0" cellspacing="1" bordercolor="#CCCCCC" bgcolor="#CCCCCC" class="TuringHelp" id="table27">
                        <tbody>
			



                          <tr>

                          </tr>
                          <?

		if (!empty($num_gafete))
		{		
		
				
		$sql = "select idasesor from asesor where gafete = '$num_gafete'";
		$result = mssql_query($sql);
		$row = mssql_fetch_array($result);
		$codpersona =  $row[0];
					 						
		anotaciones($codpersona);
				
		}
		
		

?>
                          <tr>
                            <td width="49"></td>
                          </tr>
                        </tbody>
              </table>
		
		
		�</td>
      </tr>
    </table></td>
  </tr>
</table>

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
