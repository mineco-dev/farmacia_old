<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/cssWeb.css" type=text/css rel=StyleSheet>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<style type="text/css">
<!--
.style3 {font-size: 14px}
.style4 {
	font-size: 18px;
	font-family: "MS Reference Sans Serif", Tahoma, Arial;
}
-->
</style>
</head>

<body>

<p>
  <?
	
include('conectarse.php');
include('../includes/inc_header_sistema.inc');
	
	
		function funcion_correos($codpersona)
		{					
		$qry_insertar_correo ="select id_correo,correo from tb_correo where idasesor='$codpersona'";
		$result = mssql_query($qry_insertar_correo);	
					$cnt = 1;
					while ($vec = mssql_fetch_array($result))
					{	
		 					  print '';
		  					  print"<tr> ";
							  print"<input name='id_correo[".$cnt."]' id='usua' value='".$vec[0]."' type='hidden'>";
							  print"<TD width='84'><span class='style9'><font color='#335B96'>$vec[0]</font></span></TD>";
							  print"<TD width='113'><span class='style9'>$vec[1]</span></TD>";
					  print"<TD width='135'><span class='style9'><input type='checkbox' name='checkbox_correo[".$cnt."]' id='checkbox_correo[".$cnt."]'/></span></TD>";							
							  print"</tr>";		 																				
						$cnt ++;
					}
		}


	function funcion_familiares($codpersona)
		{					
		$qry_insertar_telefono ="select f.id_familiares,f.nombre_familiar,p.parentesco,f.fecha_nac,f.lugar_ocupacion,f.telefono from tb_familiares f, parentesco p where idasesor='$codpersona' and f.tipo_parentesco = p.id_parentesco";
		$result = mssql_query($qry_insertar_telefono);	
					$cnt = 1;
					while ($vec = mssql_fetch_array($result))
					{	
		 					  print '';
		  					  print"<tr> ";
							  print"<input name='id_familiares[".$cnt."]' id='usua' value='".$vec[0]."' type='hidden'>";
							  print"<TD width='30'><span class='style9'><font color='#335B96'>$vec[0]</font></span></TD>";
							  print"<TD width='113'><span class='style9'>$vec[1]</span></TD>";
  							  print"<TD width='40'><span class='style9'><font color='#335B96'>$vec[2]</font></span></TD>";
							  print"<TD width='80'><span class='style9'>$vec[3]</span></TD>";
  							  print"<TD width='200'><span class='style9'><font color='#335B96'>$vec[4]</font></span></TD>";
							  print"<TD width='100'><span class='style9'>$vec[5]</span></TD>";
							  print"<TD width='10'><span class='style9'><input type='checkbox' name='checkbox_familiares[".$cnt."]' id='checkbox' /> </span></TD>";							
							  print"</tr>";		 																				
						$cnt ++;
					}
		}
		
		
		
		function estudios_realizados($codpersona)
		{					
		$qry_insertar_estudios ="select f.id_estudios_realizados,f.titulo,p.nivel_estudios,f.fecha,f.centro_estudios from estudios_realizados f, nivel_academico p where idasesor='$codpersona' and f.nivel_academico = p.id_nivel_academico";
		$result = mssql_query($qry_insertar_estudios);	
					$cnt = 1;
					while ($vec = mssql_fetch_array($result))
					{	
		 					  print '';
		  					  print"<tr> ";							 
							  print"<TD width='113'><span class='style9'>$vec[1]</span></TD>";
  							  print"<TD width='150'><span class='style9'><font color='#335B96'>$vec[2]</font></span></TD>";
							  print"<TD width='80'><span class='style9'>$vec[3]</span></TD>";
  							  print"<TD width='200'><span class='style9'><font color='#335B96'>$vec[4]</font></span></TD>";
							  
							  print"</tr>";		 																				
						$cnt ++;
					}
		}
		
		
		
		function experiencia_laboral($codpersona)
		{					
		$qry_insertar_estudios ="select f.id_experiencia_laboral,f.entidad,f.fecha_ingreso,f.puesto,f.referencia,f.fecha_egreso,f.atribuciones from tb_experiencia_laboral f where idasesor='$codpersona'";
		$result = mssql_query($qry_insertar_estudios);	
					$cnt = 1;
					while ($vec = mssql_fetch_array($result))
					{	
		 					  print '';
		  					  print"<tr> ";
							  
							  print"<TD width='200'><span class='style9'>$vec[1]</span></TD>";
  							  print"<TD width='80'><span class='style9'><font color='#335B96'>$vec[2]</font></span></TD>";
							  print"<TD width='100'><span class='style9'>$vec[3]</span></TD>";
  							  print"<TD width='100'><span class='style9'>$vec[4]</span></TD>";
  							  print"<TD width='80'><span class='style9'><font color='#335B96'>$vec[5]</font></span></TD>";
   							  print"<TD width='300'><span class='style9'><font color='#335B96'>$vec[6]</font></span></TD>";
							  
							  print"</tr>";		 																				
						$cnt ++;
					}
		}
	
	
	
		function contrataciones_gobierno($codpersona)
		{					
		$qry_insertar_estudios ="select f.id_contratacion_gobierno,f.entidad_gobierno,f.fecha_ingreso,p.puesto,f.renglon,f.fecha_egreso,f.atribuciones,f.partida,f.sueldo from tb_contratacion_gobierno f, puesto p where idasesor='$codpersona' and f.puesto = p.id_puesto";
		$result = mssql_query($qry_insertar_estudios);	
					$cnt = 1;
					while ($vec = mssql_fetch_array($result))
					{	
		 					  print '';
		  					  print"<tr> ";
							  print"<input name='id_contratacion_gobierno[".$cnt."]' id='usua' value='".$vec[0]."' type='hidden'>";
							  print"<TD width='30'><span class='style9'><font color='#335B96'>$vec[0]</font></span></TD>";
							  print"<TD width='200'><span class='style9'>$vec[1]</span></TD>";
  							  print"<TD width='100'><span class='style9'><font color='#335B96'>$vec[2]</font></span></TD>";
							  print"<TD width='100'><span class='style9'>$vec[3]</span></TD>";
  							  print"<TD width='100'><span class='style9'>$vec[4]</span></TD>";
  							  print"<TD width='100'><span class='style9'><font color='#335B96'>$vec[5]</font></span></TD>";
   							  print"<TD width='300'><span class='style9'><font color='#335B96'>$vec[6]</font></span></TD>";
						  	  print"<TD width='400'><span class='style9'><font color='#335B96'>$vec[7]</font></span></TD>";
						  	  print"<TD width='80'><span class='style9'><font color='#335B96'>$vec[8]</font></span></TD>";
							  print"<TD width='10'><span class='style9'><input type='checkbox' name='checkbox_contratacion[".$cnt."]' id='checkbox' /> </span></TD>";							
							  print"</tr>";		 																				
						$cnt ++;
					}
		}
		
		
		function alergias($codpersona)
		{					
		$qry_insertar_estudios ="select f.id_alergia,f.alergia,f.forma_aliviar from tb_alergia f where idasesor='$codpersona'";
		$result = mssql_query($qry_insertar_estudios);	
					$cnt = 1;
					while ($vec = mssql_fetch_array($result))
					{	
		 					  print '';
		  					  print"<tr> ";
							  print"<input name='id_alergia[".$cnt."]' id='usua' value='".$vec[0]."' type='hidden'>";
							  print"<TD width='30'><span class='style9'><font color='#335B96'>$vec[0]</font></span></TD>";
							  print"<TD width='200'><span class='style9'>$vec[1]</span></TD>";
  							  print"<TD width='500'><span class='style9'><font color='#335B96'>$vec[2]</font></span></TD>";
							  print"<TD width='10'><span class='style9'><input type='checkbox' name='checkbox_alergia[".$cnt."]' id='checkbox' /> </span></TD>";							
							  print"</tr>";		 																				
						$cnt ++;
					}
		}
		
		
		function enfermedad($codpersona)
		{					
		$qry_insertar_estudios ="select f.id_enfermedad,f.enfermedad,f.prescripcion_medica,f.medicamentos,f.estado from tb_enfermedad f where idasesor='$codpersona'";
		$result = mssql_query($qry_insertar_estudios);	
					$cnt = 1;
					while ($vec = mssql_fetch_array($result))
					{	
					
					if ($vec[4]==1)
					{
						$estado_enfermedad = 'SI';
					}else{
						$estado_enfermedad = 'NO';
					}
					
		 					  print '';
		  					  print"<tr> ";
							  print"<input name='id_enfermedad[".$cnt."]' id='usua' value='".$vec[0]."' type='hidden'>";
							  print"<TD width='30'><span class='style9'><font color='#335B96'>$vec[0]</font></span></TD>";
							  print"<TD width='200'><span class='style9'>$vec[1]</span></TD>";
  							  print"<TD width='500'><span class='style9'><font color='#335B96'>$vec[2]</font></span></TD>";
   							  print"<TD width='300'><span class='style9'><font color='#335B96'>$vec[3]</font></span></TD>";
   							  print"<TD width='50'><span class='style9'><font color='#335B96'>$estado_enfermedad</font></span></TD>";
							  print"<TD width='10'><span class='style9'><input type='checkbox' name='checkbox_enfermedad[".$cnt."]' id='checkbox' /> </span></TD>";							
							  print"</tr>";		 																				
						$cnt ++;
					}
		}
	
	
		function otros_idiomas($codpersona)
		{					
		$qry_insertar_estudios ="select f.id_idioma,f.centro_estudios,p.idioma,f.escribe,f.lee,f.habla from tb_idiomas f, tb_idioma p where idasesor='$codpersona' and f.id_idiomaref = p.id_idioma";
		$result = mssql_query($qry_insertar_estudios);	
					$cnt = 1;
					while ($vec = mssql_fetch_array($result))
					{
					if ($vec[3] == 1)
					{
						$condicional1 = 'SI';
					}else{
						$condicional1 = 'NO';
					}
					if ($vec[4] == 1)
					{
						$condicional2 = 'SI';
					}else{
						$condicional2 = 'NO';
					}
					if ($vec[5] == 1)
					{
						$condicional3 = 'SI';
					}else{
						$condicional3 = 'NO';
					}
						
		 					  print '';
		  					  print"<tr> ";
							  print"<input name='id_idioma[".$cnt."]' id='usua' value='".$vec[0]."' type='hidden'>";
							  print"<TD width='30'><span class='style9'><font color='#335B96'>$vec[0]</font></span></TD>";
							  print"<TD width='250'><span class='style9'>$vec[1]</span></TD>";
  							  print"<TD width='80'><span class='style9'><font color='#335B96'>$vec[2]</font></span></TD>";
							  print"<TD width='80'><span class='style9'>$condicional1</span></TD>";
  							  print"<TD width='80'><span class='style9'><font color='#335B96'>$condicional2</font></span></TD>";
   							  print"<TD width='80'><span class='style9'><font color='#335B96'>$condicional3</font></span></TD>";
							  print"<TD width='10'><span class='style9'><input type='checkbox' name='checkbox_idiomas[".$cnt."]' id='checkbox' /> </span></TD>";							
							  print"</tr>";		 																				
						$cnt ++;
					}
		}
		
		
		
		function cursos($codpersona)
		{					
		$qry_insertar_estudios ="select f.id_curso,f.curso,f.fecha,f.lugar from tb_curso f where idasesor='$codpersona'";
		$result = mssql_query($qry_insertar_estudios);	
					$cnt = 1;
					while ($vec = mssql_fetch_array($result))
					{	
		 					  print '';
		  					  print"<tr> ";
							  print"<input name='id_curso[".$cnt."]' id='usua' value='".$vec[0]."' type='hidden'>";
							  print"<TD width='30'><span class='style9'><font color='#335B96'>$vec[0]</font></span></TD>";
							  print"<TD width='200'><span class='style9'>$vec[1]</span></TD>";
  							  print"<TD width='60'><span class='style9'><font color='#335B96'>$vec[2]</font></span></TD>";
							  print"<TD width='200'><span class='style9'>$vec[3]</span></TD>";
							  print"<TD width='10'><span class='style9'><input type='checkbox' name='checkbox_curso[".$cnt."]' id='checkbox' /> </span></TD>";							
							  print"</tr>";		 																				
						$cnt ++;
					}
		}



	function telefonos_empleado($codpersona)
		{					
		$qry_insertar_telefono ="select id_telefono,telefono from tb_telefono where idasesor='$codpersona'";
		$result = mssql_query($qry_insertar_telefono);	
					$cnt = 1;
					while ($vec = mssql_fetch_array($result))
					{	
		 					  print '';
		  					  print"<tr> ";
							  print"<input name='id_telefono[".$cnt."]' id='usua' value='".$vec[0]."' type='hidden'>";
							  print"<TD width='84'><span class='style9'><font color='#335B96'>$vec[0]</font></span></TD>";
							  print"<TD width='113'><span class='style9'>$vec[1]</span></TD>";
							  print"<TD width='135'><span class='style9'><input type='checkbox' name='checkbox_telefonos[".$cnt."]' id='checkbox' /> </span></TD>";							
							  print"</tr>";		 																				
						$cnt ++;
					}
		}
	
	$flag = 0;
	$flag1 = 0;


	
if ($flag != 1) {	


$opnacionalidad = 1;


	$fecha_naci =  "$ano-$mes-$dia";  
	if ($opnacionalidad == 1) // nacional
	{
		$idnacionalidad = 1;

		$sqpersona = "SELECT nombre,nombre2,nombre3,apellido,apellido2, 
		apellidocasada, sexo, cedula,  nit, activo, colonia, aldea1, caserio, calle, numero,idmunicipio_nac, idregistro, estadocivil, nacionalidad, codigo_profesion, idmunicipio_reside, pasaporte,
		nombre_estado_provincia, year(fecha_nacimiento),month(fecha_nacimiento),day(fecha_nacimiento),zona,tipolicencia,licencia,iddepartamento_reside,gafete,idgrupoetnico,direccion_para_notificaciones,igss,empadronamiento,gruposanguineo,altura,peso,idasesor,userfilefoto FROM asesor WHERE gafete = '$termino'";
		
		//print $sqpersona;
		
	}else //extranjero
	{	
		$sqpersona = "insert into asesor(nombre,nombre2,nombre3,apellido,apellido2, 
		apellidocasada, sexo, nit, activo, colonia, aldea1, caserio, calle, numero, estadocivil, nacionalidad, codigo_profesion, idmunicipio_reside, pasaporte,
		nombre_estado_provincia, fecha_nacimiento,zona,tipolicencia,licencia,iddepartamento_reside,gafete,idgrupoetnico,direccion_para_notificaciones,gruposanguineo,altura,peso) 
		 values ('$nombre',  '$nombre2', '$nombre3', '$apellidos', '$apellido2', '$apellidocasada', '$sexo',  '$nit', $empleado_activo, '$colonia', '$aldea',
		'$caserio',
		'$calle', '$numero', '$estado_civil', '$idnacionalidad', $profesion, $idgrupo2, '$numero_pasaporte', '$provincia', 
		'$fecha_naci','$zona','$tipo_licencia','$num_licencia',$tema,'$num_gafete','$idgrupoetnico','$direccion_para_notificaciones','$g_sanguineo','$altura','$peso')";
	}
	

	
		$result = mssql_query($sqpersona);
		$row = mssql_fetch_row($result);
		$codpersona =  $row[38];
		$asesor = $row[38];
}
	
?>
</p>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td width="12%" rowspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2" rowspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="82%" height="34"><table width="889" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="189"><img src="../imagen/curriculum/datospersonales.gif" width="179" height="25" /></td>
          <td width="488">&nbsp;</td>
          <td width="253"><?
			if (!empty($row[39]) )
			{
				
				print '<img src="http://localhost/rh/personas/fotos/'.$termino.'/'.$row[39].'" width="73" height="89" />';
			}
				
			?></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td height="22" colspan="4"><img src="../imagen/curriculum/linea.gif" width="884" height="14" /></td>
  </tr>
  <tr>
    <td><img src="../imagen/curriculum/nombre.gif" width="131" height="24" /><span class="GrayBasicFont style3">
      <? 
		print $row[0]." ".$row[1]." ".$row[2]." ".$row[3]." ".$row[4]." ".$row[5];		
	?>
    </span></td>
    <td colspan="3"><p class="GrayBasicFont style3">&nbsp;</p></td>
  </tr>
  <tr>
    <td><img src="../imagen/curriculum/fecha_nacimiento.gif" width="131" height="24" /><span class="ProgressWriting">
      <?
	print $row[25]."/".$row[24]."/".$row[23];
	?>
    </span></td>
    <td colspan="3"><p class="ProgressWriting">&nbsp;</p></td>
  </tr>
  <tr>
    <td><img src="../imagen/curriculum/direccion.gif" width="131" height="24" /><span class="ProgressWriting"><? print $row[32];?></span></td>
    <td colspan="3"><p class="ProgressWriting">&nbsp;</p></td>
  </tr>
  <tr>
    <td><img src="../imagen/curriculum/telefonos.gif" width="131" height="24" /><span class="ProgressWriting">
      <? 
	$qry_tels = mssql_query("select telefono from tb_telefono where idasesor = '$codpersona'");
	$x = 0;
	while($imprime = mssql_fetch_row($qry_tels))
	{
		print $imprime[$x]." ";
		$x++;
	}

	
	//empieza ?>
    </span></td>
    <td colspan="3"><p class="ProgressWriting">&nbsp;</p></td>
  </tr>
  <tr>
    <td><img src="../imagen/curriculum/email.gif" width="131" height="24" /><span class="ProgressWriting">
      <?
	$qry_mail = mssql_query("select correo from tb_correo where idasesor = '$codpersona'");
	$x = 0;
	while($imprime = mssql_fetch_row($qry_mail))
	{
		print $imprime[$x]." ";
		$x++;
	}

	?>
    </span></td>
    <td width="4%"><p class="ProgressWriting">&nbsp;</p></td>
    <td width="2%">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><img src="../imagen/curriculum/formacion.gif" width="179" height="25" /></td>
    <td class="FooterLinksSite">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4"><img src="../imagen/curriculum/linea.gif" width="884" height="14" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4"><? //aqui empieza ?>    </td>
  </tr>
  <tr>
    <td><table width="118%" align="center" cellpadding="1" cellspacing="1" bordercolor="#000000" bgcolor="#FFFFFF">
      <tr>
        <td width="737" height="52" colspan="3"><div align="center">
          <div align="center">
            <table width="735" 
                        border="0" align="center" cellpadding="0" cellspacing="1" bordercolor="#CCCCCC" bgcolor="#CCCCCC" class="TuringHelp" id="table27">
              <tbody>
                <tr>
                  <td width="113" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="Estilo7" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Titulo Obtenido</font></span></td>
                  <td width="50" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Nivel Academico</font></span></td>
                  <td width="40" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Fecha </font></span></td>
                  <td width="200" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Centro de Estudios</font></span></td>
                  
                </tr>
                <?

		if (!empty($termino))
		{					 						
				estudios_realizados($codpersona);
				
		}

?>
                <tr>
                  <td width="184"></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div></td>
      </tr>
    </table></td>
  </tr>
  <? //aqui termina?>
  &nbsp;
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><img src="../imagen/curriculum/experiencia_laboral.gif" width="179" height="25" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	
	   <? //aqui empieza ?>
      <tr>	
       <td><table width="83%" align="left" cellpadding="1" cellspacing="1" bordercolor="#000000" bgcolor="#FFFFFF">
              <tr>
                <td width="737" height="52" colspan="3"><div align="center">
                    <div align="center">
                      <table width="735" 
                        border="0" align="center" cellpadding="0" cellspacing="1" bordercolor="#CCCCCC" bgcolor="#CCCCCC" class="TuringHelp" id="table27">
                        <tbody>
                          <tr>

<td width="200" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="Estilo7" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Empresa </font></span></td>
<td width="50" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Fecha Ingreso</font></span></td>
<td width="200" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Puesto </font></span></td>
<td width="80" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Referencia </font></span></td>
<td width="50" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Fecha Egreso </font></span></td>
<td width="250" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Atribuciones </font></span></td>
                          </tr>
                          <?

		if (!empty($termino))
		{					 						
				experiencia_laboral($codpersona);
				
		}

?>
                          <tr>
                            <td width="184"></td>
                          </tr>
                        </tbody>
                      </table>
                  </div>
                 
                </div></td>
              </tr>
            </table></td>        
</tr>
     <? //aqui termina?>
	&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p class="GrayBasicFont style3">&nbsp;</p>
</body>
</html>
