<?
session_start();
include('conectarse.php');
include('../includes/inc_header_sistema.inc');
$dbms=new DBMS($conexion); 
$dbms->bdd=$database_cnn;

//envia_msg($modificar);

if ($modificar == 1)
{
//envia_msg($profesion);

/***************/
$nombre_carpeta = "fotos/".$num_gafete;

		 
		$nombre_archivo = $HTTP_POST_FILES['userfile']['name']; 
		$tipo_archivo = $HTTP_POST_FILES['userfile']['type']; 
		$tamano_archivo = $HTTP_POST_FILES['userfile']['size']; 





/*************/

$fecha_naci = $anos.'-'.$mess.'-'.$dias;
	
	$peopleupdate = "UPDATE asesor SET
	nombre='$nombre',
	nombre2='$nombre2',
	nombre3='$nombre3',
	apellido='$apellidos',
	apellido2='$apellido2', 
    apellidocasada='$apellidocasada',
	sexo='$sexo',
	cedula='$cedula',
	nit='$nit',
	activo='$empleado_activo',
	colonia='$colonia',
	aldea1='$aldea',
	caserio='$caserio',
	calle='$calle',
	numero='$numero',
	idmunicipio_nac='$idgrupo',
	idregistro='$registro',
	estadocivil='$estado_civil',
	nacionalidad='$idnacionalidad',
	codigo_profesion=$profesion,
	idmunicipio_reside='$idgrupo2',
	pasaporte='$numero_pasaporte',
	nombre_estado_provincia='$provincia',
	fecha_nacimiento='$fecha_naci',
	zona='$zona',
	tipolicencia='$tipo_licencia',
	licencia='$num_licencia',
	iddepartamento_reside='$tema',
	idgrupoetnico='$idgrupoetnico',
	direccion_para_notificaciones='$direccion_para_notificaciones',
	igss='$igss',
	empadronamiento='$empadronamiento',
	gruposanguineo='$g_sanguineo',
	altura='$altura',
	peso='$peso',
	userfilefoto='$nombre_archivo',
	gafete = '$num_gafete' WHERE gafete = '$num_gafete2'"; 
	
	
	$peopleup = "UPDATE asesor SET
	nombre='$nombre',
	nombre2='$nombre2',
	nombre3='$nombre3',
	apellido='$apellidos',
	apellido2='$apellido2', 
    apellidocasada='$apellidocasada',
	sexo='$sexo',
	cedula='$cedula',
	nit='$nit',
	activo='$empleado_activo',
	colonia='$colonia',
	aldea1='$aldea',
	caserio='$caserio',
	calle='$calle',
	numero='$numero',
	idmunicipio_nac='$idgrupo',
	idregistro='$registro',
	estadocivil='$estado_civil',
	nacionalidad='$idnacionalidad',
	codigo_profesion=$profesion,
	idmunicipio_reside='$idgrupo2',
	pasaporte='$numero_pasaporte',
	nombre_estado_provincia='$provincia',
	fecha_nacimiento='$fecha_naci',
	zona='$zona',
	tipolicencia='$tipo_licencia',
	licencia='$num_licencia',
	iddepartamento_reside='$tema',
	idgrupoetnico='$idgrupoetnico',
	direccion_para_notificaciones='$direccion_para_notificaciones',
	igss='$igss',
	empadronamiento='$empadronamiento',
	gruposanguineo='$g_sanguineo',
	altura='$altura',
	peso='$peso',
	gafete = '$num_gafete' WHERE gafete = '$num_gafete2'";
	
	/*** CARGAR ARCHIVOS  AL SISTEMA  *////			
if (!empty($nombre_archivo))
{
		$result = mssql_query($peopleupdate);			
		
		$nombre_carpeta = "fotos/".$num_gafete;
		if(!is_dir($nombre_carpeta)){
			@mkdir($nombre_carpeta, 0700);			

		}else{	
		
		}  



		if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "jpg") || strpos($tipo_archivo, "pdf")) && ($tamano_archivo < 100000))) { 
			echo "La extensión o el TAMAÑO de los archivos no es correcta. <br><br><table><tr><td><li>Se permiten archivos .gif o .jpg<br><li>se permiten archivos de 100 Kb m�ximo.</td></tr></table>"; 
		}else{ 
			if (move_uploaded_file($HTTP_POST_FILES['userfile']['tmp_name'], $nombre_carpeta."/".$nombre_archivo)){ 			 
			}else{ 
			   echo "Ocurri� alg�n error al subir el fichero. No pudo guardarse."; 
			} 
		} 
	

}else{
		$result = mssql_query($peopleup);
}
	/*/////**************CARGAR ARCHIVOS AL SISTEMA   ************/
	

		$cnt = 1;
		while ($cnt <= count($id_correo))
		{			
			if ($checkbox_correo[$cnt] == 'on')
			{			
				mssql_query("delete from tb_correo where id_correo = '$id_correo[$cnt]'");
			}else{
				//envia_msg($prueba);
			}
			$cnt ++;
		}


		$cnt = 1;
		while ($cnt <= count($id_familiares))
		{			
			if ($checkbox_familiares[$cnt] == 'on')
			{			
				mssql_query("delete from tb_familiares where id_familiares = '$id_familiares[$cnt]'");
			}else{
				//envia_msg($prueba);
			}
			$cnt ++;
		}
		
		$cnt = 1;
		while ($cnt <= count($id_estudios_realizados))
		{			
			if ($checkbox_estudios[$cnt] == 'on')
			{			
				mssql_query("delete from estudios_realizados where id_estudios_realizados = '$id_estudios_realizados[$cnt]'");
			}else{
				//envia_msg($prueba);
			}
			$cnt ++;
		}
	
		$cnt = 1;
		while ($cnt <= count($id_experiencia_laboral))
		{			
			if ($checkbox_experiencia[$cnt] == 'on')
			{			
				mssql_query("delete from tb_experiencia_laboral where id_experiencia_laboral = '$id_experiencia_laboral[$cnt]'");
			}else{
				//envia_msg($prueba);
			}
			$cnt ++;
		}
	
		$cnt = 1;
		while ($cnt <= count($id_contratacion_gobierno))
		{			
			if ($checkbox_contratacion[$cnt] == 'on')
			{			
				mssql_query("delete from tb_contratacion_gobierno where id_contratacion_gobierno = '$id_contratacion_gobierno[$cnt]'");
			}else{
				//envia_msg($prueba);
			}
			$cnt ++;
		}
		
		$cnt = 1;
		while ($cnt <= count($id_alergia))
		{			
			if ($checkbox_alergia[$cnt] == 'on')
			{			
				mssql_query("delete from tb_alergia where id_alergia = '$id_alergia[$cnt]'");
			}else{
				//envia_msg($prueba);
			}
			$cnt ++;
		}
		
		$cnt = 1;
		while ($cnt <= count($id_enfermedad))
		{			
			if ($checkbox_enfermedad[$cnt] == 'on')
			{			
				mssql_query("delete from tb_enfermedad where id_enfermedad = '$id_enfermedad[$cnt]'");
			}else{
				//envia_msg($prueba);
			}
			$cnt ++;
		}
		
		$cnt = 1;
		while ($cnt <= count($id_idioma))
		{			
			if ($checkbox_idiomas[$cnt] == 'on')
			{			
				mssql_query("delete from tb_idioma where id_idioma = '$id_idioma[$cnt]'");
			}else{
				//envia_msg($prueba);
			}
			$cnt ++;
		}
		
		$cnt = 1;
		while ($cnt <= count($id_curso))
		{			
			if ($checkbox_curso[$cnt] == 'on')
			{			
				mssql_query("delete from tb_curso where id_curso = '$id_curso[$cnt]'");
			}else{
				//envia_msg($prueba);
			}
			$cnt ++;
		}

		$cnt = 1;
		while ($cnt <= count($id_telefono))
		{			
			if ($checkbox_telefonos[$cnt] == 'on')
			{			
				mssql_query("delete from tb_telefono where id_telefono = '$id_telefono[$cnt]'");
			}else{
				//envia_msg($prueba);
			}
			$cnt ++;
		}
	
	
	
//  insercion de los nuevos datos




		$sql = "select idasesor from asesor where gafete = '$num_gafete'";
		$result = mssql_query($sql);
		$row = mssql_fetch_array($result);
		$codpersona =  $row[0];
		//envia_msg($codpersona);
		//print $codpersona;
		

		
		$nameta = "fotos/".$num_gafete."/anexo";
		if(!is_dir($nameta)){
			@mkdir($nameta, 0700);			

		}else{	
		
		}  

		
		$cnt = 1;
		while ($cnt <= count($contador))
		{										
		
		
		$fname ='files'.$cnt; 	 
		$nombre_ar = $HTTP_POST_FILES[$fname]['name']; 
		//envia_msg($f);
		//envia_msg($nombre_ar);
		$anexo[$cnt] = $nombre_ar;		
		//envia_msg($anexo[$f]);		
		$tipo_archivo = $HTTP_POST_FILES[$fname]['type']; 
		$tamano_archivo = $HTTP_POST_FILES[$fname]['size']; 
		//compruebo si las caracter�sticas del archivo son las que deseo 
		if ($checkbox_requisitos[$cnt]=='on')
		{
		if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "jpg") || strpos($tipo_archivo, "pdf") || strpos($tipo_archivo, "doc" || strpos($tipo_archivo, "xls" || strpos($tipo_archivo, "docx")))) && ($tamano_archivo < 100000))) { 
			echo ".."; 
		}else{ 
			if (move_uploaded_file($HTTP_POST_FILES[$fname]['tmp_name'], $nameta."/".$nombre_ar)){ 
			  // echo "El archivo ha sido cargado correctamente."; 
			}else{ 
			   echo "No se pudieron cargar archivos adjuntos"; 
			} 
		} 
		}else{
			//no hay archivos que se quieran actualizar
		}
		
			
			
			if ($llave[$cnt]<4 && $checkbox_requisitos[$cnt]=='on' && !empty($nombre_ar))
			{
				$qry_update_requisitos =" update tb_requisitos set ";
				$qry_update_requisitos.=" fecha1 = '$testinputi[$cnt]', fecha2= '$testinputf[$cnt]',archivo='$nombre_ar' ";
				$qry_update_requisitos.=" where id_requisito = $superkey[$cnt] ";
							$result = mssql_query($qry_update_requisitos);
			}
			
			
			if ($llave[$cnt]<4 && $checkbox_requisitos[$cnt]=='on' && empty($nombre_ar))
			{
				$qry_update_requisitos =" update tb_requisitos set ";
				$qry_update_requisitos.=" fecha1 = '$testinputi[$cnt]', fecha2= '$testinputf[$cnt]' ";
				$qry_update_requisitos.=" where id_requisito = $superkey[$cnt] ";
							$result = mssql_query($qry_update_requisitos);
			}

			
			/*if ($llave[$cnt]<4 && $checkbox_requisitos[$cnt]=='on' && empty($nombre_ar))
			{
			
			}*/
			
			if ($checkbox_requisitos[$cnt] == 'on' && $llave[$cnt]>3  && !empty($nombre_ar)){
					$qry_update_requisitos =" update tb_requisitos set ";
					$qry_update_requisitos.=" archivo = '$nombre_ar' ";
					$qry_update_requisitos.=" where id_requisito = $superkey[$cnt] ";
					$result = mssql_query($qry_update_requisitos);
			}


			/*if ($checkbox_requisitos[$cnt] == 'on' && $llave[$cnt]>3  && empty($nombre_ar)){
			
			}*/
			
			
/*			print $qry_update_requisitos;
			$result = mssql_query($qry_update_requisitos);*/
			
			
			$cnt ++;
		}
		
		
		
		$cnt = 1;
		while ($cnt <= count($telefono))
		{
	
			$auxiliar = $telefono[$cnt];
			if ($auxiliar[0]=='4' ||$auxiliar[0]=='5')		
			{
				$tipo = 2;
			}else{
				$tipo = 1;
			}
			
			$id_tipotelefono = $tipo;
			$qry_insertar_telefono ="insert into tb_telefono";
			$qry_insertar_telefono.="(telefono,idasesor,extensiont,oficial,iddireccion,id_tipo_telefono) ";
			$qry_insertar_telefono.="values ('$telefono[$cnt]', '$codpersona','$extensiont[$cnt]','$oficialt[$cnt]','$iddireccion[$cnt]','$id_tipotelefono')";
			$result = mssql_query($qry_insertar_telefono);
			$cnt ++;
			
			/*$qry_insertar_telefono ="insert into tb_telefono";
			$qry_insertar_telefono.="(telefono,idasesor,extensiont,oficial,iddireccion) ";
			$qry_insertar_telefono.="values ('$telefono[$cnt]', '$codpersona','$extensiont[$cnt]','$oficialt[$cnt]','$iddireccion[$cnt]')";
			$result = mssql_query($qry_insertar_telefono);
			$cnt ++;*/
		}
		$cnt = 1;
		while ($cnt <= count($correo))
		{
			$qry_insertar_correo ="insert into tb_correo";
			$qry_insertar_correo.="(correo,idasesor,oficial) ";
			$qry_insertar_correo.="values ('$correo[$cnt]', '$codpersona','$oficialc[$cnt]')";
			$result = mssql_query($qry_insertar_correo);
			$cnt ++;
		}
		
		$cnt = 1;
		while ($cnt <= count($idioma))
		{
			$qry_insertar_idiomas ="insert into tb_idiomas";
			$qry_insertar_idiomas.="(id_idiomaref,idasesor,centro_estudios,escribe,lee,habla) ";
			$qry_insertar_idiomas.="values ('$idioma[$cnt]', '$codpersona','$centroidi[$cnt]','$escribe[$cnt]','$lee[$cnt]','$habla[$cnt]')";
			$result = mssql_query($qry_insertar_idiomas);
			$cnt ++;
		}
		$cnt = 1;
		while ($cnt <= count($alergia))
		{
			$qry_insertar_alergia ="insert into tb_alergia";
			$qry_insertar_alergia.="(alergia,idasesor,forma_aliviar) ";
			$qry_insertar_alergia.="values ('$alergia[$cnt]', '$codpersona','$forma_aliviar[$cnt]')";
			$result = mssql_query($qry_insertar_alergia);
			$cnt ++;
		}
		$cnt = 1;
		while ($cnt <= count($nombre_familiar))
		{
			$fecha_nac[$cnt] = $aniofam[$cnt].'-'.$mesfam[$cnt].'-'.$diafam[$cnt];
			$qry_insertar_familiar ="insert into tb_familiares";
			$qry_insertar_familiar.="(nombre_familiar,idasesor,tipo_parentesco,fecha_nac,lugar_ocupacion,telefono) ";
			$qry_insertar_familiar.="values ('$nombre_familiar[$cnt]', '$codpersona','$tipo_parentesco[$cnt]','$fecha_nac[$cnt]','$lugar_ocupacion[$cnt]','$telefonofam[$cnt]')";
			$result = mssql_query($qry_insertar_familiar);
			$cnt ++;
		}
		$cnt = 1;
		while ($cnt <= count($curso_cap))
		{
			$fecha_cap[$cnt] = $aniocap[$cnt].'-'.$mescap[$cnt].'-'.$diacap[$cnt];
			$qry_insertar_curso ="insert into tb_curso";
			$qry_insertar_curso.="(curso,idasesor,fecha,lugar) ";
			$qry_insertar_curso.="values ('$curso_cap[$cnt]', '$codpersona','$fecha_cap[$cnt]','$lugar_cap[$cnt]')";
			$result = mssql_query($qry_insertar_curso);
			$cnt ++;
		}
		$cnt = 1;
		while ($cnt <= count($empresaexp))
		{
			$fecha_ingreso[$cnt] = $anioexpi[$cnt].'-'.$mesexpi[$cnt].'-'.$diaexpi[$cnt];
			$fecha_egreso[$cnt] = $anioexpf[$cnt].'-'.$mesexpf[$cnt].'-'.$diaexpf[$cnt];
			$qry_insertar_contratacion ="insert into tb_contratacion_gobierno";
			$qry_insertar_contratacion.="(entidad_gobierno,idasesor,fecha_ingreso,fecha_egreso,puesto,renglon,atribuciones,partida,sueldo,oficial) ";
			$qry_insertar_contratacion.="values ('$empresaexp[$cnt]', '$codpersona','$fecha_ingreso[$cnt]','$fecha_egreso[$cnt]','$puestoexp[$cnt]','$renglon[$cnt]','$atribuciones[$cnt]','$partida[$cnt]','$sueldo[$cnt]','$oficialcg[$cnt]')";
			
			$result = mssql_query($qry_insertar_contratacion);
			$cnt ++;
		}
		
		$cnt = 1;
		while ($cnt <= count($empresae))
		{
			$fecha_ingreso_emp[$cnt] = $anioempi[$cnt].'-'.$mesempi[$cnt].'-'.$diaempi[$cnt];
			$fecha_egreso_emp[$cnt] = $anioempf[$cnt].'-'.$mesempf[$cnt].'-'.$diaempf[$cnt];
			$qry_insertar_explaboral ="insert into tb_experiencia_laboral";
			$qry_insertar_explaboral.="(entidad,idasesor,fecha_ingreso,fecha_egreso,puesto,referencia,atribuciones) ";
			$qry_insertar_explaboral.="values ('$empresae[$cnt]', '$codpersona','$fecha_ingreso_emp[$cnt]','$fecha_egreso_emp[$cnt]','$puestoemp[$cnt]','$referenciaemp[$cnt]','$atribucionesemp[$cnt]')";	
			$result = mssql_query($qry_insertar_explaboral);
			$cnt ++;
		}
		
		$cnt = 1;
		while ($cnt <= count($titulo))
		{
			$fecha_estudio[$cnt] = $anioaca[$cnt].'-'.$mesaca[$cnt].'-'.$diaaca[$cnt];
			$qry_insertar_academicos ="insert into estudios_realizados";
			$qry_insertar_academicos.="(titulo,idasesor,nivel_academico,fecha,centro_estudios) ";
			$qry_insertar_academicos.="values ('$titulo[$cnt]', '$codpersona','$nivel[$cnt]','$fecha_estudio[$cnt]','$centroaca[$cnt]')";			
			$result = mssql_query($qry_insertar_academicos);
			$cnt ++;
		}
		
		
		$cnt = 1;
		while ($cnt <= count($enfermo))
		{
			$qry_insertar_enfermedad ="insert into tb_enfermedad";
			$qry_insertar_enfermedad.="(enfermedad,idasesor,prescripcion_medica,medicamentos,estado) ";
			$qry_insertar_enfermedad.="values ('$enfermo[$cnt]', '$codpersona','$doctor[$cnt]','$medicina[$cnt]','$estatusenfermedad[$cnt]')";						
			$result = mssql_query($qry_insertar_enfermedad);
			$cnt ++;
		}
			
	
	
	

// fin de $modificar
}


if ($busca == 1)
 {
	include('../includes/inc_header_sistema.inc');
	function valida_empleado($reg,$num)		
	{
		$ret = 0;
		$query = "select 
					count(*) 
				  from 
					asesor
				  where
					idregistro = $reg and
					cedula = '$num'";
		$consulta = mssql_query($query);
		$vector = mssql_fetch_row($consulta);
		$ret = $vector[0];
		return $ret;
	}
	
	

	
	
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
//  						  print"<input name='".$id_correo[$cnt]."' id='usua' value='".$vec[0]."' type='hidden'>";
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
		$qry_insertar_estudios ="select f.id_estudios_realizados,r.profesion,p.nivel_estudios,f.fecha,f.centro_estudios  from estudios_realizados f, nivel_academico p, tb_profesion r  where idasesor='$codpersona' and f.nivel_academico = p.id_nivel_academico and f.titulo = r.codigo_profesion";
		$result = mssql_query($qry_insertar_estudios);	
					$cnt = 1;
					while ($vec = mssql_fetch_array($result))
					{	
		 					  print '';
		  					  print"<tr> ";
							  print"<input name='id_estudios_realizados[".$cnt."]' id='usua' value='".$vec[0]."' type='hidden'>";
							  print"<TD width='30'><span class='style9'><font color='#335B96'>$vec[0]</font></span></TD>";
							  print"<TD width='113'><span class='style9'>$vec[1]</span></TD>";
  							  print"<TD width='40'><span class='style9'><font color='#335B96'>$vec[2]</font></span></TD>";
							  print"<TD width='80'><span class='style9'>$vec[3]</span></TD>";
  							  print"<TD width='200'><span class='style9'><font color='#335B96'>$vec[4]</font></span></TD>";
							  print"<TD width='10'><span class='style9'><input type='checkbox' name='checkbox_estudios[".$cnt."]' id='checkbox' /> </span></TD>";							
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
							  print"<input name='id_experiencia_laboral[".$cnt."]' id='usua' value='".$vec[0]."' type='hidden'>";
							  print"<TD width='30'><span class='style9'><font color='#335B96'>$vec[0]</font></span></TD>";
							  print"<TD width='200'><span class='style9'>$vec[1]</span></TD>";
  							  print"<TD width='80'><span class='style9'><font color='#335B96'>$vec[2]</font></span></TD>";
							  print"<TD width='100'><span class='style9'>$vec[3]</span></TD>";
  							  print"<TD width='100'><span class='style9'>$vec[4]</span></TD>";
  							  print"<TD width='80'><span class='style9'><font color='#335B96'>$vec[5]</font></span></TD>";
   							  print"<TD width='300'><span class='style9'><font color='#335B96'>$vec[6]</font></span></TD>";
							  print"<TD width='10'><span class='style9'><input type='checkbox' name='checkbox_experiencia[".$cnt."]' id='checkbox' /> </span></TD>";							
							  print"</tr>";		 																				
						$cnt ++;
					}
		}
	
	
	
		function contrataciones_gobierno($codpersona)
		{					
		$qry_insertar_estudios ="select f.id_contratacion_gobierno,d.nombre,f.fecha_ingreso,p.puesto,
f.renglon,f.fecha_egreso,f.atribuciones,f.sueldo,f.partida from 
tb_contratacion_gobierno f, puesto p, direccion d where idasesor='$codpersona'
and f.puesto = p.id_puesto and d.iddireccion = f.entidad_gobierno; ";
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
   							  print"<TD width='600'><span class='style9'><font color='#335B96'>$vec[8]</font></span></TD>";
						  	  print"<TD width='50'><span class='style9'><font color='#335B96'>$vec[7]</font></span></TD>";
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
		$qry_insertar_telefono ="select id_telefono,telefono, extensiont from tb_telefono where idasesor='$codpersona'";
		$result = mssql_query($qry_insertar_telefono);	
					$cnt = 1;
					while ($vec = mssql_fetch_array($result))
					{	
		 					  print '';
		  					  print"<tr> ";
							  print"<input name='id_telefono[".$cnt."]' id='usua' value='".$vec[0]."' type='hidden'>";
							  print"<TD width='84' align='center'><span class='style9'><font color='#335B96'>$vec[0]</font></span></TD>";
							  print"<TD width='60' align='center'><span class='style9'>$vec[1]</span></TD>";
						      print"<TD width='53' align='center'><span class='style9'>$vec[2]</span></TD>";
							  print"<TD width='135'><span class='style9'><input type='checkbox' name='checkbox_telefonos[".$cnt."]' id='checkbox' /> </span></TD>";							
							  print"</tr>";		 																				
						$cnt ++;
					}
		}
		
		
		function requisitos($codpersona)
		{	
		
		
	
		
		
	$value = "select gafete from asesor where idasesor = '$codpersona'";
	$gaf = mssql_query($value);
	$gafete = mssql_fetch_array($gaf);
	
							
		$qry_insertar_requisitos ="select r.id_requisito,cr.requisito,convert(varchar,r.fecha1,21) as fecha1,
convert(varchar,r.fecha2,21) as fecha2,r.archivo,r.codigo_requisito from tb_requisitos r, cat_requisitos cr where idasesor='$codpersona'
and cr.codigo_requisito = r.codigo_requisito;";
		$result = mssql_query($qry_insertar_requisitos);	
					$cnt = 1;
					while ($vec = mssql_fetch_array($result))
					{	
					
					if ($vec[5]<4)
					{
		 					  print '';
		  					  print"<tr> ";
  							  print "<input type='hidden' name='contador[".$cnt."]'/>";
							  print"<input name='superkey[".$cnt."]' type='hidden' value=".$vec[0].">";
							  print"<input name='llave[".$cnt."]' type='hidden' value=".$vec[5].">";
							  print"<TD width='84'><span class='style9'>$vec[0]</span></TD>";
							  print"<TD width='113'><span class='style9'>$vec[1]</span></TD>";							  							  							  print"<TD width='113'><span class='style9'><input type='text' name='testinputi[".$cnt."]' value=".$vec[2]." size = '10'> 
							  <script language='JavaScript'>
	new tcal ({
		'formname': 'form1',
		'controlname': 'testinputi[".$cnt."]'
	});

	</script> </span></TD>";							  
  							print"<TD width='113'><span class='style9'><input type='text' name='testinputf[".$cnt."]' value=".$vec[3]." size = '10'> 
							  <script language='JavaScript'>
	new tcal ({
		'formname': 'form1',
		'controlname': 'testinputf[".$cnt."]'
	});

	</script> </span></TD>";
							  print "<td width='110'> <a href='fotos/".$gafete[0]."/anexo/".$vec[4]."' target = '_blank'>ver</a></td>";
							  print "<td width='110'> <input type='file' name='files".$cnt."' />";
							  print"<TD width='70'><span class='style9'><input type='checkbox' name='checkbox_requisitos[".$cnt."]' id='checkbox_requisitos[".$cnt."]'/></span></TD>";							
							  print"</tr>";		 																				
					
						
						}else{
							 print '';
		  					  print"<tr> ";
  							  print"<input name='superkey[".$cnt."]' type='hidden' value=".$vec[0].">";
							  print"<input name='llave[".$cnt."]' type='hidden' value=".$vec[5].">";
							  print"<TD width='84'><span class='style9'>$vec[0]</span></TD>";
							  print"<TD width='113'><span class='style9'>$vec[1]</span></TD>";							  							  							  print"<TD width='113'><span class='style9'></TD>";							  
  							  print"<TD width='113'><span class='style9'></TD>";
							  print "<td width='110'> <a href='fotos/".$gafete[0]."/anexo/".$vec[4]."' target = '_blank'>ver</a></td>";
							  print "<td width='110'> <input type='file' name='files".$cnt."'/>";
  							  print "<input type='hidden' name='contador[".$cnt."]'/>";
  						  	  print"<TD width='70'><span class='style9'><input type='checkbox' name='checkbox_requisitos[".$cnt."]' id='checkbox_requisitos[".$cnt."]'/></span></TD>";							
							  print"</tr>";		 																				
					
						}
						
						$cnt ++;
					}
					
						
		}


//$telefonos_empleado = telefonos_empleado();	
	
	
	$flag = 0;
	$flag1 = 0;

/*if (!empty($registro) && !empty($cedula))
{
	if (valida_empleado($registro,$cedula) > 0) $flag=1;
}*/	
	

/*	function valida_extranjero($dbms,$num)		
	{
		$ret = 0;
		$query = "select 
					count(*) cnt
				  from 
					tb_persona
				  where
					numero_pasaporte = $num";
		$dbms->sql=$query;
		$dbms->Query();
		$Fields=$dbms->MoveNext();
		$ret = $Fields["cnt"];
		return $ret;
	}*/
	
if ($flag != 1) {	

//prueba
$opnacionalidad = 1;


	$fecha_naci =  "$ano-$mes-$dia";  
	if ($opnacionalidad == 1) // nacional
	{
		$idnacionalidad = 1;

		$sqpersona = "SELECT nombre,nombre2,nombre3,apellido,apellido2, 
		apellidocasada, sexo, cedula,  nit, activo, colonia, aldea1, caserio, calle, numero,idmunicipio_nac, idregistro, estadocivil, nacionalidad, codigo_profesion, idmunicipio_reside, pasaporte,
		nombre_estado_provincia, year(fecha_nacimiento),month(fecha_nacimiento),day(fecha_nacimiento),zona,tipolicencia,licencia,iddepartamento_reside,gafete,idgrupoetnico,direccion_para_notificaciones,igss,empadronamiento,gruposanguineo,altura,peso,idasesor,userfilefoto FROM asesor WHERE gafete = '$num_gafete'";
		
		//print $sqpersona;
		
	}else //extranjero
	{
	
		/*if (valida_extranjero($dbms,$numero_pasaporte) > 0) $flag=1;*/
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
		//envia_msg($codpersona);
		//print $codpersona;
		
		
		
		
		
		
		/*$cnt = 1;
		while ($cnt <= count($correo))
		{
			$qry_insertar_correo ="insert into tb_correo";
			$qry_insertar_correo.="(correo,idasesor) ";
			$qry_insertar_correo.="values ('$correo[$cnt]', '$codpersona')";
			$result = mssql_query($qry_insertar_correo);
			$cnt ++;
		}
		
		$cnt = 1;
		while ($cnt <= count($idioma))
		{
			$qry_insertar_idiomas ="insert into tb_idiomas";
			$qry_insertar_idiomas.="(id_idiomaref,idasesor,centro_estudios,escribe,lee,habla) ";
			$qry_insertar_idiomas.="values ('$idioma[$cnt]', '$codpersona','$centroidi[$cnt]','$escribe[$cnt]','$lee[$cnt]','$habla[$cnt]')";
			$result = mssql_query($qry_insertar_idiomas);
			$cnt ++;
		}
		$cnt = 1;
		while ($cnt <= count($alergia))
		{
			$qry_insertar_alergia ="insert into tb_alergia";
			$qry_insertar_alergia.="(alergia,idasesor,forma_aliviar) ";
			$qry_insertar_alergia.="values ('$alergia[$cnt]', '$codpersona','$forma_aliviar[$cnt]')";
			$result = mssql_query($qry_insertar_alergia);
			$cnt ++;
		}
		$cnt = 1;
		while ($cnt <= count($nombre_familiar))
		{
			$fecha_nac[$cnt] = $aniofam[$cnt].'-'.$mesfam[$cnt].'-'.$diafam[$cnt];
			$qry_insertar_familiar ="insert into tb_familiares";
			$qry_insertar_familiar.="(nombre_familiar,idasesor,tipo_parentesco,fecha_nac,lugar_ocupacion,telefono) ";
			$qry_insertar_familiar.="values ('$nombre_familiar[$cnt]', '$codpersona','$tipo_parentesco[$cnt]','$fecha_nac[$cnt]','$lugar_ocupacion[$cnt]','$telefonofam[$cnt]')";
			$result = mssql_query($qry_insertar_familiar);
			$cnt ++;
		}
		$cnt = 1;
		while ($cnt <= count($curso_cap))
		{
			$fecha_cap[$cnt] = $aniocap[$cnt].'-'.$mescap[$cnt].'-'.$diacap[$cnt];
			$qry_insertar_curso ="insert into tb_curso";
			$qry_insertar_curso.="(curso,idasesor,fecha,lugar) ";
			$qry_insertar_curso.="values ('$curso_cap[$cnt]', '$codpersona','$fecha_cap[$cnt]','$lugar_cap[$cnt]')";
			$result = mssql_query($qry_insertar_curso);
			$cnt ++;
		}
		$cnt = 1;
		while ($cnt <= count($empresaexp))
		{
			$fecha_ingreso[$cnt] = $anioexpi[$cnt].'-'.$mesexpi[$cnt].'-'.$diaexpi[$cnt];
			$fecha_egreso[$cnt] = $anioexpf[$cnt].'-'.$mesexpf[$cnt].'-'.$diaexpf[$cnt];
			$qry_insertar_contratacion ="insert into tb_contratacion_gobierno";
			$qry_insertar_contratacion.="(entidad_gobierno,idasesor,fecha_ingreso,fecha_egreso,puesto,renglon,atribuciones,partida,sueldo) ";
			$qry_insertar_contratacion.="values ('$empresaexp[$cnt]', '$codpersona','$fecha_ingreso[$cnt]','$fecha_egreso[$cnt]','$puestoexp[$cnt]','$renglon[$cnt]','$atribuciones[$cnt]','$partida[$cnt]','$sueldo[$cnt]')";
			
			$result = mssql_query($qry_insertar_contratacion);
			$cnt ++;
		}
		
		$cnt = 1;
		while ($cnt <= count($empresae))
		{
			$fecha_ingreso_emp[$cnt] = $anioempi[$cnt].'-'.$mesempi[$cnt].'-'.$diaempi[$cnt];
			$fecha_egreso_emp[$cnt] = $anioempf[$cnt].'-'.$mesempf[$cnt].'-'.$diaempf[$cnt];
			$qry_insertar_explaboral ="insert into tb_experiencia_laboral";
			$qry_insertar_explaboral.="(entidad,idasesor,fecha_ingreso,fecha_egreso,puesto,referencia,atribuciones) ";
			$qry_insertar_explaboral.="values ('$empresae[$cnt]', '$codpersona','$fecha_ingreso_emp[$cnt]','$fecha_egreso_emp[$cnt]','$puestoemp[$cnt]','$referenciaemp[$cnt]','$atribucionesemp[$cnt]')";	
			$result = mssql_query($qry_insertar_explaboral);
			$cnt ++;
		}
		
		$cnt = 1;
		while ($cnt <= count($titulo))
		{
			$fecha_estudio[$cnt] = $anioaca[$cnt].'-'.$mesaca[$cnt].'-'.$diaaca[$cnt];
			$qry_insertar_academicos ="insert into estudios_realizados";
			$qry_insertar_academicos.="(titulo,idasesor,nivel_academico,fecha,centro_estudios) ";
			$qry_insertar_academicos.="values ('$titulo[$cnt]', '$codpersona','$nivel[$cnt]','$fecha_estudio[$cnt]','$centroaca[$cnt]')";			
			$result = mssql_query($qry_insertar_academicos);
			$cnt ++;
		}
		
		
		$cnt = 1;
		while ($cnt <= count($enfermo))
		{
			$qry_insertar_enfermedad ="insert into tb_enfermedad";
			$qry_insertar_enfermedad.="(enfermedad,idasesor,prescripcion_medica,medicamentos,estado) ";
			$qry_insertar_enfermedad.="values ('$enfermo[$cnt]', '$codpersona','$doctor[$cnt]','$medicina[$cnt]','$estatusenfermedad[$cnt]')";						
			$result = mssql_query($qry_insertar_enfermedad);
			$cnt ++;
		}*/
		
		
		
		//cambiar_ventana("oculto.php?valor=$valor");
		session_write_close();
	}else
	{
		cambiar_ventana("ocultoerr.php");
	}	

}




function dia()
{
	$i=1;	
	 while ($i<=31)
	  {
					
                    $dia = $dia."<option value=".$i.">".$i."</option>";
          $i++;
	 }
	 return $dia;
}	

function mes()
{
	$i=1;	
	 while ($i<=12)
	  {
					
                    $mes = $mes."<option value=".$i.">".$i."</option>";
          $i++;
	 }
	 return $mes;
}		

function anio()
{
	$i=1920;	
	 while ($i<=date('Y'))
	  {
					
          $anio = $anio."<option value=".$i.">".$i."</option>";
          $i++;
	 }
	 return $anio;
}		

function condicional()
{
	$condicional = $condicional."<option value=1>SI</option>";
	$condicional = $condicional."<option value=2>NO</option>";
	
	return $condicional;
}   	

function renglon()
{
	$renglon = $renglon."<option value=11>011</option>";
	$renglon = $renglon."<option value=22>022</option>";
	$renglon = $renglon."<option value=29>029</option>";	
	return $renglon;
}   	


	 
$anio = anio();
$mes = mes();
$dia = dia();
$condicional = condicional(); 
$renglon = renglon();
?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>



<script>
function cargar()
{

var x = window.document.form1.modificar[0].value;

//alert(x);

if (window.document.form1.modificar[0].checked)
{
	window.document.form1.actualizar.disabled = false;
//	window.document.form1.cmd_cantidad.disabled = false;
	}else{
			window.document.form1.actualizar.disabled = true;
	}
/*if(window.document.form1.modificar[0].checked)	
{
	window.document.form1.cmd_cantidad.disabled = false;
	}*/

}
</script>

<script language="JavaScript" src="calendar_db.js"></script>
<link rel="stylesheet" href="calendar.css">

<link href="../css/cssWeb.css" type=text/css rel=StyleSheet>

<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
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
.style1 {color: #666699}
.style5 {
	font-size: 9px;
	font-family: Arial, Helvetica, sans-serif;
	color: #000000;
}
.style6 {
	color: #000000;
	font-size: 14px;
}
.style8 {font-size: 11px; font-weight: bold; }
-->
</style>
<script language="JavaScript">
function imprimir()
{
//	alert(window.document.form1.opnacionalidad[0].value);
//	alert(window.document.form1.opnacionalidad[1].value);
	if (window.document.form1.opnacionalidad[0].checked)
	{
	   document.getElementById("div_extranjero").style.display = "none";
	   document.getElementById("div_nacional").style.display = "inline";
	}else
	{
	   document.getElementById("div_extranjero").style.display = "inline";
	   document.getElementById("div_nacional").style.display = "none";
	}
}

function modifica_estado(obj) {
obj.value=obj.value.toUpperCase();
if(obj.value=="GUATEMALTECO") 
{
   document.getElementById("div_extranjero").style.display = "none";
   document.getElementById("div_nacional").style.display = "inline";
} else {
   document.getElementById("div_extranjero").style.display = "inline";
   document.getElementById("div_nacional").style.display = "none";
}
}

function validarEntero(numero){ 
  if ((isNaN(numero)) && (numero > 0)) { 
		alert("Solo puede ingresar numeros validos en el campo");
		return "";
  }else{ 
		return numero;
  } 
}

function Validar(form)
{
	/* textoCampo = window.document.form1.zona.value 
	 textoCampo = validarEntero(textoCampo) 
	 window.document.form1.zona.value = textoCampo 

	 textoCampo = window.document.form1.codigo_postal.value 
	 textoCampo = validarEntero(textoCampo) 
	 window.document.form1.codigo_postal.value = textoCampo 
	 
/*	 textoCampo = window.document.form1.telefono.value 
	 textoCampo = validarEntero(textoCampo) 
	 window.document.form1.telefono.value = textoCampo 
*/	




	  if (form.profesion.value <> "")
	  { alert("Por favor Seleccione una profesion valida"); form.profesion.focus(); return; }
	/*  
	  if (form.apellidos.value == "")
	  { alert("Por favor ingrese su Primer Apellido"); form.apellidos.focus(); return; }
	  
	  if (form.estado_civil.value == 0)
		{ alert("Por favor seleccione su Estado Civil"); form.estado_civil.focus(); return; }
		
	  //if (form.dia.value == "")
	  //{ alert("Por favor ingrese dia de cumpleaños"); form.dia.focus(); return; }
	  
	  //if (form.mes.value == "")
	  //{ alert("Por favor ingrese mes de su cumpleaños"); form.mes.focus(); return; }
	  
	  //if (form.ano.value == "")
	  //{ alert("Por favor ingrese Año de su cumpleaños"); form.ano.focus(); return; }
	
//		alert(form.sexo[0].checked);
	 /* if ((!form.sexo[0].checked) && (!form.sexo[1].checked))
		{ alert("Por favor ingrese su Sexo"); form.sexo[0].focus(); return; }
	  
	  if ((form.registro.value == "") && (form.opnacionalidad[0].checked))
	  { alert("Por favor confirme su Registro");  return; }

	  if ((form.numero_pasaporte.value == "") && (form.opnacionalidad[1].checked))
	  { alert("Por favor ingrese No. de Pasaporte"); return; }
	
	
	 /* if (form.cedula.value == "")
	  { alert("Por favor confirme su No. de Cedula"); form.cedula.focus(); return; }*/
	  
/*	  if (form.tema2.value == "") 
	  { alert("Por favor confirme El Departamento"); form.tema2.focus(); return; }
*/	
	/*  if ((form.idgrupo.value == "") && (form.opnacionalidad[0].checked))
	  { alert("Por favor confirme Municio"); form.idgrupo.focus(); return; }
	
		if (form.calle.value == "")
		  { alert("Por favor ingrese la calle");  return; }

		if (form.numero.value == "")
		  { alert("Por favor ingrese el numero de la casa"); return; }
		
		if (form.zona.value == "")
		  { alert("Por favor ingrese la zona"); return; }
		
		if (form.tema.value == "")
		  { alert("Por favor seleccione el departamento de residencia"); return; }*/

if (confirm('Esta seguro de guardar estos datos?')){ 
    //  document.form.submit() 
		form.submit();
		
  	} 
}
</script>
</head>

<body>
<table width="598" border="0" align="left" cellspacing="0">
  <tr bgcolor="#0066CC">
    <td colspan="7" bgcolor="#FFFFFF"><div align="left"><span class="Estilo1 Estilo2 style1"><span class="style6">Actualizacion  de Empleados </span></span><span class="style5">&nbsp;&nbsp;</span><span class="Estilo67"><font color="#6699FF" face="Arial, Helvetica, sans-serif">&nbsp;&nbsp;Fecha</font> <font face="Arial, Helvetica, sans-serif"> <? echo'<font color="#003399"><strong>'.date("d")."/".date("m")."/".date("Y").'</strong></font>'; ?> <? echo'<font color="#003399"><strong>'.$hora.'</strong></font>'; ?> </font></span></div></td>
  </tr>
  &nbsp;
  <tr>
    <td width="260"></td>
    <td width="334"></td>
  </tr>
  <!--td colspan="2">&nbsp;</td>
    <td colspan="-1">&nbsp;</td-->
  &nbsp;
  <tr>
    <td><? /*
	$valor2 = $_GET[valor];
	
	
	
//	$val = 0;
	
	if ($val == $valor2)
{*/
	?>
        <!--input value="ENTRO SI"  type="submit" -->
        <?   /*} 
else {*/

 ?>
        <!--input  value="SALIR"  type="submit"  onMouseMove="Enviar1()" -->
        <? //}?></td>
  </tr>
</table>
<br>
<p>&nbsp;</p>
<p>&nbsp;</p>
<form action="cpersona.php?busca=1" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <div id="TabbedPanels1" class="TabbedPanels">
    <ul class="TabbedPanelsTabGroup">
      <li class="TabbedPanelsTab" tabindex="0">Datos Personales</li>
      <li class="TabbedPanelsTab" tabindex="0">Datos Familiares</li>
      <li class="TabbedPanelsTab" tabindex="0">Datos Academicos</li>
      <li class="TabbedPanelsTab" tabindex="0">Experiencia Laboral</li>
      <li class="TabbedPanelsTab" tabindex="0">Historial Medico</li>
	  <li class="TabbedPanelsTab" tabindex="0">Requisitos</li>
    </ul>
    <div class="TabbedPanelsContentGroup">
      <div class="TabbedPanelsContent">
        <table width="100%" border="0" align="center" cellspacing="0">
          
          <tr class="Estilo1">
            <td height="34" class="Estilo22" ><strong>Numero de GAFETE:</strong></td>
            <td class="Estilo7"><span class="Estilo22"><strong>
              <input name="num_gafete" id="num_gafete" size="18" value="<? echo $row[30];?>"/>
              &nbsp;&nbsp;</strong></span></td>
            <td colspan="3" class="Estilo7"><strong>
              <input name="num_gafete2" type="hidden" id="num_gafete2" size="18" value="<? echo $row[30];?>"/>
            </strong></td>
            <td rowspan="3">
			<?
			if (!empty($row[39]) )
			{
				
				print '<img src="fotos/'.$num_gafete.'/'.$row[39].'" width="73" height="89" />';
			}
				
			?>			</td>
            <td colspan="-1">&nbsp;</td>
          </tr>
          <tr class="Estilo1">
            <td height="23" class="Estilo22" >&nbsp;</td>
            <td class="Estilo7"><p>&nbsp;</p>            </td>
            <td colspan="3" class="Estilo7">&nbsp;</td>
            <td colspan="-1">&nbsp;</td>
          </tr>
          <tr class="Estilo1">
            <td height="34" class="Estilo22" >&nbsp;</td>
            <td class="Estilo7">&nbsp;</td>
            <td colspan="3" class="Estilo7">&nbsp;</td>
            <td colspan="-1">&nbsp;</td>
          </tr>
          <tr class="Estilo1">
            <td width="133" height="34" class="Estilo22" > Primer Nombre <font color="#FF0000"><strong>**</strong></font></td>
            <td class="Estilo7" width="180"><input name="nombre" type="text" class="Estilo7" id="nombre" size="30" onKeyUp="javascript:this.value=this.value.toUpperCase();" value="<? echo $row[0];?>" /></td>
            <td colspan="3" class="Estilo7"><div align="right" class="Estilo22">Segundo Nombre </div></td>
            <td width="187"><input name="nombre2" type="text" class="Estilo7" id="nombre2" size="30" onkeyup="javascript:this.value=this.value.toUpperCase();" value="<? echo $row[1];?>" /></td>
            <td width="187" colspan="-1"><span class="Estilo6"> </span></td>
          </tr>
          <tr class="Estilo7">
            <td class="Estilo7"><span class="Estilo22">Tercer Nombre</span></td>
            <td class="Estilo7"><input name="nombre3" type="text" class="Estilo7" id="nombre3" size="30" onKeyUp="javascript:this.value=this.value.toUpperCase();" value="<? echo $row[2];?>" /></td>
            <td colspan="3" class="Estilo7"><div align="right" class="Estilo22">Primer Apellido<font color="#FF0000"><strong>**</strong></font></div></td>
            <td><input name="apellidos" type="text" class="Estilo7" id="apellidos" size="30" onkeyup="javascript:this.value=this.value.toUpperCase();" value="<? echo $row[3];?>" /></td>
            <td colspan="-1">&nbsp;</td>
          </tr>
          <tr class="Estilo7">
            <td class="Estilo7"><span class="Estilo22">Segundo Apellido</span></td>
            <td class="Estilo7"><input name="apellido2" type="text" class="Estilo7" id="apellido2" size="30" onKeyUp="javascript:this.value=this.value.toUpperCase();" value="<? echo $row[4];?>" /></td>
            <td colspan="3" class="Estilo7"><div align="right"><span class="Estilo22">Apellido de Casada</span></div></td>
            <td colspan="6" class="Estilo7"><input name="apellidocasada" type="text" class="Estilo7" id="apellidocasada" size="30" onKeyUp="javascript:this.value=this.value.toUpperCase();" value="<? echo $row[5];?>" /></td>
          </tr>
          <tr class="Estilo7">
            <td class="Estilo7"><span class="Estilo22">Estado Civil<font color="#FF0000"><strong>**</strong></font></span></td>
            <td class="Estilo7"><span class="Estilo22">
              <select name="estado_civil" class="TituloMedios" id="estado_civil" >
                <option selected value=''> Seleccione </option>
                <? if ($row[17] == 'S')
				{
					print ' <option selected value="S" > Soltero (a) </option>
                <option value="C"> Casado (a)</option>';
	
				}else{
					print ' <option value="S" > Soltero (a) </option>
                <option selected value="C"> Casado (a)</option>';
				}
				?>
            </select>
            </span></td>
            <td colspan="3" class="Estilo7"><div align="right" class="Estilo22">Fecha nacimiento<font color="#FF0000"></font></div></td>
            <td colspan="6" class="Estilo7"><span class="Estilo22">&nbsp;d&iacute;a
              <!--input name="dia3" type="text" class="Estilo1" id="dia3" maxlength="2"  size="2"-->
                  <select name="dias" class="Estilo1">
                    <option></option>
                    <?
	$i=1;
		
	 while ($i<=31)
	  {
	  if ($i == $row[25])
	  {
	  	print ' <option selected value="'.$i.'" >'.$i.'</option>';
	  }else{
	  	print '<option value="'.$i.'">'.$i.'</option>';
	  }
	  
	  $i++;
	 } 
	
	 
	?>
                  </select>
              mes
              <!--input name="mes3" type="text" class="Estilo1" id="mes3" size="2" maxlength="2"-->
              <select name="mess" class="Estilo1">
                <option></option>
                <?
	$i=1;
		
	 while ($i<=12)
	  {
			  if ($i == $row[24])
			  {
				print ' <option selected value="'.$i.'" >'.$i.'</option>';
			  }else{
				print '<option value="'.$i.'">'.$i.'</option>';
			  }
			  
			  $i++;
	  }
	
	?>
              </select>
              a&ntilde;o
              <!--input name="ano3" type="text" class="Estilo1" id="ano3" size="4" maxlength="4"-->
              <select name="anos" class="Estilo1">
                <option></option>
                <?
	 $i=1900;		
	 while ($i<=date('Y'))
	  {
		  if ($i == $row[23])
		  {
			print ' <option selected value="'.$i.'" >'.$i.'</option>';
		  }else{
			print '<option value="'.$i.'">'.$i.'</option>';
		  }	  
	  $i++;
	  }
	
	 
	?>
              </select>
              <!--input name="edad" type="text" id="nacimiento" size="5"-->
            </span></td>
          </tr>
          <tr class="Estilo1">
            <td><span class="Estilo22">Sexo:<font color="#FF0000"><strong>**</strong></font></span> </td>
            <td><span class="Estilo22">
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
            <td class="Estilo22">NIT</td>
            <td class="Estilo7"><input name="nit" type="text" class="Estilo7" id="nit" size="30" onKeyUp="javascript:this.value=this.value.toUpperCase();" value="<? echo $row[8];?>" /></td>
            <td width="57">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ACTIVO</strong> </td>
            <!--td colspan="2" class="Estilo7"><div align="right" class="Estilo22">Igss</div></td-->
            <td width="99" colspan="-1"><!--input name="igss" type="text" class="Estilo1" id="igss" size="30"-->
                <span class="Estilo6"><select name="empleado_activo" id="empleado_activo">
                
                <?
					if ($row[9]==1)
					{
						print '<option selected value="1">Activo</option>
				                <option value="2">Inactivo</option>';
					}else{
								print '<option  value="1">Activo</option>
				                <option selected value="2">Inactivo</option>';
					
					}
                ?>
                
                
                
                </select> </span></td>
          </tr>
          
          <tr class="Estilo7">
            <td class="Estilo7"><span class="Estilo22">Nacionalidad<font color="#FF0000"><strong>**</strong></font></span></td>
            <td colspan="4" class="Estilo7"><label>
              <input name="opnacionalidad" type="radio" onClick="imprimir();" value="1" checked="checked" />
              <span class="Estilo22">Guatemalteco
              <input name="opnacionalidad" type="radio" value="2" onClick="imprimir();"/> 
            Otros</span></label></td>
            <td>&nbsp;</td>
            <td colspan="-1">&nbsp;</td>
          </tr>
          
          <tr class="Estilo7">
            <td colspan="7" class="Estilo7">
			
			<span id="div_nacional" style="display:inline">
			<table width="100%" border="0">
              
              <tr class="Estilo7">
                <td width="13%" class="Estilo7"><div align="left"><span class="style8">C&eacute;dula de Vecindad</span></div></td>
                <td width="41%" class="Estilo7">&nbsp;</td>
                <td colspan="2" class="Estilo7"><div align="right" class="Estilo22">
                  <div align="left">Fotografia</div>
                </div></td>
                <td width="33%" colspan="-1"><input type="file" name="userfile" id="userfile" /></td>
              </tr>
              <tr class="Estilo7">
                <td class="Estilo7"><span class="Estilo22">Orden<font color="#FF0000"><strong>**</strong></font></span></td>
                <td class="Estilo7"><span class="Estilo22">
                  <select name="registro" class="TituloMedios" id="registro" onChange="javascript:cargarCombo('subactividades.php', 'registro', 'Div_Subactividades')">
                    <option value=''> Seleccione </option>
                    <? $sql = "select codigo_registro, registro from tb_registro ";
			$result = mssql_query($sql);
			while ($wor = mssql_fetch_array($result))
			  { 
			  	
				?>
                
                <?
					if ($row[16] == $wor['codigo_registro'])
					{
	                    print '<option selected value="'.$wor['codigo_registro'].'">'.$wor['registro'].'</option>';						
					}else{
	                    print '<option value="'.$wor['codigo_registro'].'">'.$wor['registro'].'</option>';						
					}
                ?>
                                       
                    <? } ?>
                  </select>
                  Registro<font color="#FF0000"><strong>**</strong></font>
                  <input name="cedula" type="text" class="Estilo7" id="cedula" size="7" value="<? echo $row[7];?>" />
                </span></td>
                <td colspan="2" class="Estilo7">
                  <div align="left">
                    <!--div align="right" class="Estilo22">
adjunte copia de C&eacute;dula</div-->
                  <span class="Estilo22">Numero de IGSS</span></div></td>
                <!--td c><span class="Estilo22"><input name="userfile" type="file" id="userfile" size="30">
    </span></td-->
                <td colspan="-1"><span class="Estilo22"><span class="Estilo47">
                  <input name="igss" type="text" class="Estilo7" id="igss"  onkeyup="javascript:this.value=this.value.toUpperCase();" value="<? echo $row[33];?>" />
                </span></span></td>
              </tr>
              <tr class="Estilo1">
                <td class="Estilo22">Municipio<font color="#FF0000"><strong>**</strong></font></td>
                <td class="Estilo7"><span class="Estilo47">
                  <div align="left"><div id="Div_Subactividades">
                      <label for="SubActividad"></label>
                      <select name="idgrupo"  id="idgrupo" class="TituloMedios">
                      <? $sql = "select codigo_municipio, nombre_municipio from tb_municipio where codigo_municipio ='$row[15]'";
			$result = mssql_query($sql);
			while ($wor = mssql_fetch_array($result))
			  { 
			  	
				?>
                
                <?
					if ($row[15] == $wor['municipio'])
					{
	                    print '<option selected value="'.$wor['codigo_municipio'].'">'.$wor['nombre_municipio'].'</option>';						
					}else{
	                    print '<option value="'.$wor['codigo_municipio'].'">'.$wor['nombre_municipio'].'</option>';						
					}
                ?>
                                       
                    <? } ?>
                      </select>
                    </div></div>
                </span> </td>
                <td colspan="2" class="Estilo7"><div align="left">Empadronamiento</div></td>
                <td colspan="-1"><span class="Estilo47">
                  <input name="empadronamiento" type="text" class="Estilo7" id="empadronamiento"  onkeyup="javascript:this.value=this.value.toUpperCase();" value="<? echo $row[34];?>"/>
                </span></td>
              </tr>
            </table>
	        </span>			
			<span id="div_extranjero" style="display:none">			
			<table width="100%" border="0">
              <tr class="Estilo7">
            <td class="Estilo7"><span class="Estilo22">Nacionalidad<font color="#FF0000"><strong>**</strong></font></span></td>
            <td class="Estilo7"><span class="Estilo22">
			
			<select name="idnacionalidad"  id="idnacionalidad"  class="TituloMedios"> 
			<? 

				$sql = "select codigo_pais_origen, nombre_pais from tb_pais_origen where codigo_pais_origen <> 1 order by nombre_pais";
				$result = mssql_query($sql);
				while ($w = mssql_fetch_array($result))
			  	{ 
					print "<option value=".$w['codigo_pais_origen'].">".$w['nombre_pais']."</option>";
				}

			?> 
</select>
            </span></td>
            <td colspan="2" class="Estilo7">&nbsp;</td>
            <td colspan="-1">&nbsp;</td>
          </tr>
			  <tr class="Estilo7">
                <td width="21%" class="Estilo7"><span class="Estilo22">Numero Pasaporte</span></td>
                <td width="52%" class="Estilo7"><input name="numero_pasaporte" type="text" class="Estilo7" id="numero_pasaporte" size="30" value="<? echo $row[21];?>" /></td>
                <td width="14" class="Estilo7">&nbsp;</td>
                <td width="13%" colspan="-1">&nbsp;</td>
              </tr>
            </table>			
			</span>            </td>
          </tr>
          
          <tr class="Estilo1">
            <td class="Estilo22">Profesion </td>
            <td class="Estilo7"><select name="profesion" class="TituloMedios" id="profesion" >
              <option value='0'> Seleccione </option>
              <?      $sql = "select codigo_profesion, profesion from tb_profesion where activo=1 order by profesion ";
			$result = mssql_query($sql);
			while ($ww = mssql_fetch_array($result))
			  { 
			  	
				?>
              <? 
					if ($row[19] == $ww[0])
					{
	                    print '<option selected value="'.$ww[0].'">'.$ww[1].'</option>';						
					}else{
	                    print '<option value="'.$ww[0].'">'.$ww[1].'</option>';						
					}
               } 			   
			   ?>
            </select></td>
            <td colspan="3" class="Estilo7"><div align="right" class="Estilo22"></div></td>
            <td>&nbsp;</td>
            <td colspan="-1"><!--input name="tipolicencia" type="text" class="Estilo1" id="tipolicencia" size="30"--></td>
          </tr>
          <tr class="Estilo1">
            <td class="Estilo22">Tipo de Licencia</td>
            <td colspan="5" class="Estilo7"><select name="tipo_licencia" id="tipo_licencia" >
            
              <? if ($row[27] == 'A')
				{
					print '<option selected value="A">A</option>
						   <option value="B">B</option>		            
						   <option value="C">C</option>
						   <option value="M">M</option></select>';
				}
				
				if ($row[27] == 'B')
				{
					print '<option value="A">A</option>
						   <option selected value="B">B</option>		            
						   <option value="C">C</option>
						   <option value="M">M</option></select>';
				}
				
				if ($row[27] == 'C')
				{
					print '<option value="A">A</option>
						   <option value="B">B</option>		            
						   <option selected value="C">C</option>
						   <option value="M">M</option></select>';
				}
				if ($row[27] == 'M')
				{
					print '<option value="A">A</option>
						   <option value="B">B</option>		            
						   <option value="C">C</option>
						   <option selected value="M">M</option></select>';
				}else{
					print '<option value="A">A</option>
						   <option value="B">B</option>		            
						   <option value="C">C</option>
						   <option value="M">M</option>
						   </select>';
				}
			?>
            
            &nbsp;&nbsp;&nbsp;              Numero<span class="Estilo6">**</span>:
            
            
            
            <input type="text" name="num_licencia" size = "20" value=" <? echo $row[28]; ?> "> 
                       &nbsp;</td>
          </tr>
        </table>
      </div>
      <div class="TabbedPanelsContent">
      
        <table width="640" height="269"  border="0" align="center"  cellpadding="0" class="Estilo7">
        
          &nbsp;
          <tr>
            <td></td></td>
          <tr>
            <td colspan="4"><div align="left"><span class="Estilo47"><span class="Estilo31">Datos de residencia</span></span></div></td>
          </tr>
          <tr>
            <td width="15%"><span class="Estilo22">Calle y avenida<font color="#FF0000"><strong>**</strong></font> </span></td>
            <td width="24%"><span class="Estilo47">
            <input name="calle" type="text" class="Estilo7" id="calle"  onkeyup="javascript:this.value=this.value.toUpperCase();" value="<? echo $row[13];?>" />
            </span></td>
            <td  width="26%" align="right"><span class="Estilo22">Numero<font color="#FF0000"><strong>**</strong></font></span> </td>
            <td width="34%"><input name="numero" type="text" class="Estilo7" id="numero" size="5" onKeyUp="javascript:this.value=this.value.toUpperCase();" value="<? echo $row[14];?>" />            </td>
          </tr>
          <tr>
            <td width="15%" class="Estilo7"><div align="right" class="Estilo22">
                <div align="right" class="Estilo22">
                  <div align="left"> Zona<span class="Estilo6"><strong>**</strong></span> </div>
                </div>
            </div></td>
            <td class="Estilo7"><div align="left">
              <select name="zona" class="TituloMedios" id="zona">
                <option value=''> Seleccione </option>
                <? 
					$sql = "select codigo_zona, numero_zona from tb_zona";
					$result = mssql_query($sql);
					while ($opcion = mssql_fetch_array($result))
					  { 
						
						?>
                        
                        <?
							if($row[26]==$opcion['codigo_zona'])
							{
								print '<option selected value="'.$opcion['codigo_zona'].'">'.$opcion['numero_zona'].'</option>';
							}else{
								print '<option value="'.$opcion['codigo_zona'].'">'.$opcion['numero_zona'].'</option>';
							}
							
                        ?>
								
                        		
                       			 
						<? 
						
					   } 
						
						?>
              </select>
            
            </div></td>
            <td width="26%" align="right" class="Estilo7"><span class="Estilo22">Colonia </span></td>
            <td width="34%"><div align="left" class="Estilo22">
                <input name="colonia" type="text" class="Estilo7" id="colonia"  onkeyup="javascript:this.value=this.value.toUpperCase();" value="<? echo $row[10];?>" />
            </div></td>
          </tr>
          <tr>
            <td width="15%" class="Estilo7"><div align="right" class="Estilo22">
                <div align="right" class="Estilo22">
                  <div align="left"> Aldea </div>
                </div>
            </div></td>
            <td class="Estilo7"><div align="left">
                <input name="aldea" type="text" class="Estilo7" id="aldea" onKeyUp="javascript:this.value=this.value.toUpperCase();" value="<? echo $row[11];?>" />
            </div></td>
            <td width="26%" align="right" class="Estilo7"><span class="Estilo22">Caserio </span></td>
            <td width="34%"><div align="left" class="Estilo22">
                <input name="caserio" type="text" class="Estilo7" id="caserio"  onkeyup="javascript:this.value=this.value.toUpperCase();" value="<? echo $row[12];?>" />
            </div></td>
          </tr>
          <tr>
            <td width="15%" class="Estilo7"><div align="right" class="Estilo22">
                <div align="right" class="Estilo22">
                  <div align="left"> Edificio</div>
                </div>
            </div></td>
            <td class="Estilo7"><div align="left">
                <input name="edificio" type="text" class="Estilo7" id="edificio"  onkeyup="javascript:this.value=this.value.toUpperCase();" />
            </div></td>
            <td width="26%" align="right" class="Estilo7">&nbsp;</td>
            <td width="34%"><div align="left" class="Estilo22"></div></td>
          </tr>
          <tr>
            <td><span class="Estilo47"><span class="Estilo22">Departamento<font color="#FF0000"><strong>**</strong></font></span></span></td>
            <td><span class="Estilo47">
              <div align="left">
                <select name="tema" class="TituloMedios" id="tema"  onchange="javascript:cargarCombo('subactividades2.php', 'tema', 'Div_Subactividades2')">
                  <option value=''> Seleccione </option>
                  <? 
$sql = "select codigo_departamento, nombre_departamento from tb_departamento";
			$result = mssql_query($sql);
			while ($xpro = mssql_fetch_array($result))
			  { 
			  	
				?>
                	<?
						if ($row[29] == $xpro['codigo_departamento'])
						{
							print '<option selected value="'.$xpro['codigo_departamento'].'">'.$xpro['nombre_departamento'].'</option>';					
						}else{
							print '<option value="'.$xpro['codigo_departamento'].'">'.$xpro['nombre_departamento'].'</option>';												
						}
                    ?>

                    
                    
                  <? 
				  
				  
				  } ?>
                </select>
              </div>
            </span></td>
            <td width="26%" align="right"><span class="Estilo22">Municipio<font color="#FF0000"><strong>**</strong></font></span></td>
            <td width="34%"><div align="left">
                <div id="Div_Subactividades2">
                  <label for="SubActividad2"></label>
                  <select name="idgrupo2"  id="idgrupo2" class="TituloMedios">
                  
                   <? $sql = "select codigo_municipio, nombre_municipio from tb_municipio where codigo_municipio ='$row[20]'";
			$result = mssql_query($sql);
			while ($wor = mssql_fetch_array($result))
			  { 
			  	
				?>
                
                <?
					if ($row[15] == $wor['municipio'])
					{
	                    print '<option selected value="'.$wor['codigo_municipio'].'">'.$wor['nombre_municipio'].'</option>';						
					}else{
	                    print '<option value="'.$wor['codigo_municipio'].'">'.$wor['nombre_municipio'].'</option>';						
					}
                ?>
                                       
                    <? } ?>
                  
                  
                  </select>
                </div>
            </div></td>
          </tr>
         
          <tr>
            <td class="Estilo22">Notificaciones</td>
            <td colspan="2">
			<textarea name="direccion_para_notificaciones"  rows="6" cols="40"><? echo $row[32];?> </textarea>&nbsp;</td>
            <td >&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td class="Estilo22">Codigo Postal</td>
            <td><span class="Estilo47">
              <input type="text" name="codigo_postal" id="codigo_postal" onKeyUp="javascript:this.value=this.value.toUpperCase();" />
            </span> </td>
            <td align="right"><div align="right"><span class="Estilo47"><span class="Estilo22">Nombre Provincia </span></span></div></td>
            <td ><span class="Estilo47">
              <input type="text" name="nombre_estado_provincia" id="nombre_estado_provincia" onKeyUp="javascript:this.value=this.value.toUpperCase();" />
            </span> </td>
            <td width="1%"><!--input name="Submit2" type="submit" class="Estilo67" value="Agregar otro"  size="2"/-->            </td>
          </tr>
          <tr>
            <td colspan="6"></td>
          </tr>
		  
          <tr class="Estilo1">
            <td colspan="5" class="Estilo22">&nbsp;</td>
          </tr>
          <tr class="Estilo1">
      <td colspan="5" class="Estilo22"><strong>Datos de los Familiares</strong></td>
    </tr>
    <tr class="Estilo1">
      <td colspan="5" class="Estilo22"><table width="100%" border="0" cellpadding="0" cellspacing="0">
          
          <tr>
         
          </tr>
          <tr>
	
       <td><table width="83%" align="center" cellpadding="1" cellspacing="1" bordercolor="#000000" bgcolor="#FFFFFF">
              <tr>
                <td width="737" height="52" colspan="3"><div align="center">
                    <div align="center">
                      <table width="735" 
                        border="0" align="center" cellpadding="0" cellspacing="1" bordercolor="#CCCCCC" bgcolor="#CCCCCC" class="TuringHelp" id="table27">
                        <tbody>
                          <tr>
<td width="20" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><font color="#FFFFFF">Codigo </font></td>
<td width="113" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="Estilo7" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Nombre del Familiar</font></span></td>
<td width="50" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Parentesco</font></span></td>
<td width="40" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Fecha Nacimiento</font></span></td>
<td width="200" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Ocupacion</font></span></td>
<td width="100" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Telefono</font></span></td>
<td width="10" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Eliminar</font></span></td>
                          </tr>
                          <?

		if (!empty($num_gafete))
		{					 						
				funcion_familiares($codpersona);
				
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
          
          
          <tr>          
            <td><? include("familiares.php"); ?>
              <label>
              
              </label></td>
          </tr>
          
<tr>
	
       <td><table width="83%" align="center" cellpadding="1" cellspacing="1" bordercolor="#000000" bgcolor="#FFFFFF">
              <tr>
                <td width="737" height="52" colspan="3"><div align="center">
                    <div align="center">
                      <table width="735" 
                        border="0" align="center" cellpadding="0" cellspacing="1" bordercolor="#CCCCCC" bgcolor="#CCCCCC" class="TuringHelp" id="table27">
                        <tbody>
                          <tr>
                            <td width="184" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><font color="#FFFFFF">Codigo </font></td>
                            <td width="437" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="Estilo7" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Correo</font></span></td>
                            <td width="110" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Eliminar</font></span></td>
                            </tr>
                          <?

		if (!empty($num_gafete))
		{					 						
				funcion_correos($codpersona);
				
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


          
          <tr>
            <td><? include("correo.php"); ?></td>
          </tr>
          
          
          
<tr>
	
       <td><table width="83%" align="center" cellpadding="1" cellspacing="1" bordercolor="#000000" bgcolor="#FFFFFF">
              <tr>
                <td width="737" height="52" colspan="3"><div align="center">
                    <div align="center">
                      <table width="735" 
                        border="0" align="center" cellpadding="0" cellspacing="1" bordercolor="#CCCCCC" bgcolor="#CCCCCC" class="TuringHelp" id="table27">
                        <tbody>
                          <tr>
                            <td width="184" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><font color="#FFFFFF">Codigo </font></td>
                            <td width="218" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="Estilo7" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Numero Telefono</font></span></td>
                            <td width="218" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="Estilo7" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Extensi&oacute;n</font></span></td>
                            <td width="110" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Eliminar</font></span></td>
                            </tr>
                          <?

		if (!empty($num_gafete))
		{					 						
				telefonos_empleado($codpersona);
				
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
          <tr>
            <td><? include("telefono.php"); ?></td>
          </tr>
        </table></td>
      </tr>
    
    <tr class="Estilo1">
      <td colspan="5" class="Estilo22"><p>&nbsp;</p>
        <p>&nbsp;</p></td>
    </tr>
        </table>
      </div>
      <div class="TabbedPanelsContent">
     <table width="100%">
     
          	<tr>
        	<td class="TabbedPanelsTab">Estudios Realizados</td>
        </tr>

     
     <? //aqui empieza ?>
      <tr>	
       <td><table width="83%" align="center" cellpadding="1" cellspacing="1" bordercolor="#000000" bgcolor="#FFFFFF">
              <tr>
                <td width="737" height="52" colspan="3"><div align="center">
                    <div align="center">
                      <table width="735" 
                        border="0" align="center" cellpadding="0" cellspacing="1" bordercolor="#CCCCCC" bgcolor="#CCCCCC" class="TuringHelp" id="table27">
                        <tbody>
                          <tr>
<td width="20" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><font color="#FFFFFF">Codigo </font></td>
<td width="113" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="Estilo7" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Titulo Obtenido</font></span></td>
<td width="50" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Nivel Academico</font></span></td>
<td width="40" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Fecha </font></span></td>
<td width="200" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Centro de Estudios</font></span></td>
<td width="10" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Eliminar</font></span></td>
                            </tr>
                          <?

		if (!empty($num_gafete))
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
     
     
     	<tr>
     	  <td><? include("estudios_realizados.php"); ?></td>
   	  </tr>
     	<tr>
     	  <td class="TabbedPanelsTab">Capacitaciones</td>
   	  </tr>
      
           <? //aqui empieza ?>
      <tr>	
       <td><table width="83%" align="center" cellpadding="1" cellspacing="1" bordercolor="#000000" bgcolor="#FFFFFF">
              <tr>
                <td width="737" height="52" colspan="3"><div align="center">
                    <div align="center">
                      <table width="735" 
                        border="0" align="center" cellpadding="0" cellspacing="1" bordercolor="#CCCCCC" bgcolor="#CCCCCC" class="TuringHelp" id="table27">
                        <tbody>
                          <tr>
<td width="20" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><font color="#FFFFFF">Codigo </font></td>
<td width="200" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="Estilo7" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Curso Recibido</font></span></td>
<td width="50" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Fecha</font></span></td>
<td width="150" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Capacitador </font></span></td>
<td width="10" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Eliminar</font></span></td>
                            </tr>
                          <?

		if (!empty($num_gafete))
		{					 						
				cursos($codpersona);
				
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
      
     	<tr>
     	  <td><? include("capacitaciones.php"); ?></td>
   	  </tr>
     	<tr>
     	  <td class="TabbedPanelsTab">Otros Idiomas </td>
   	  </tr>
      
       <? //aqui empieza ?>
      <tr>	
       <td><table width="100%" align="center" cellpadding="1" cellspacing="1" bordercolor="#000000" bgcolor="#FFFFFF">
              <tr>
                <td width="100%" height="52" colspan="3"><div align="center">
                    <div align="center">
                      <table width="100%" 
                        border="0" align="center" cellpadding="0" cellspacing="1" bordercolor="#CCCCCC" bgcolor="#CCCCCC" class="TuringHelp" id="table27">
                        <tbody>
                          <tr>
<td width="20" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><font color="#FFFFFF">Codigo </font></td>
<td width="200" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="Estilo7" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Centro de Estudios</font></span></td>
<td width="50" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Idioma</font></span></td>
<td width="150" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Escribe</font></span></td>
<td width="150" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Lee</font></span></td>
<td width="150" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Habla</font></span></td>
<td width="10" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Eliminar</font></span></td>
                            </tr>
                          <?

		if (!empty($num_gafete))
		{					 						
				otros_idiomas($codpersona);
				
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
      
     	<tr>
     	  <td><? include("otros_idiomas.php"); ?></td>
   	  </tr>
     </table>
     </div>
    
     <div class="TabbedPanelsContent">
      <table width="100%">
     	<tr>
        	<td class="TabbedPanelsTab">Experiencia Laboral </td>
        </tr>
        
         <? //aqui empieza ?>
      <tr>	
       <td><table width="100%" align="center" cellpadding="1" cellspacing="1" bordercolor="#000000" bgcolor="#FFFFFF">
              <tr>
                <td width="100%" height="52" colspan="3"><div align="center">
                    <div align="center">
                      <table width="100%" 
                        border="0" align="center" cellpadding="0" cellspacing="1" bordercolor="#CCCCCC" bgcolor="#CCCCCC" class="TuringHelp" id="table27">
                        <tbody>
                          <tr>
<td width="15%" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><font color="#FFFFFF">Codigo </font></td>
<td width="15%" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="Estilo7" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Empresa </font></span></td>
<td width="15%" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Fecha Ingreso</font></span></td>
<td width="15%" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Puesto </font></span></td>
<td width="15%" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Referencia </font></span></td>
<td width="15%" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Fecha Egreso </font></span></td>
<td width="15%" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Atribuciones </font></span></td>
<td width="10%" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Eliminar</font></span></td>
                            </tr>
                          <?

		if (!empty($num_gafete))
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
        
     	<tr>
     	  <td><? include("experiencia_laboral.php"); ?></td>
   	  </tr>
     	<tr>
     	  <td class="TabbedPanelsTab">Contrataciones del Gobierno </td>
   	  </tr>
     	
        
         <? //aqui empieza ?>
      <tr>	
       <td><table width="100%" align="center" cellpadding="1" cellspacing="1" bordercolor="#000000" bgcolor="#FFFFFF">
              <tr>
                <td width="100%" height="52" colspan="3"><div align="center">
                    <div align="center">
                      <table width="100%" 
                        border="0" align="center" cellpadding="0" cellspacing="1" bordercolor="#CCCCCC" bgcolor="#CCCCCC" class="TuringHelp" id="table27">
                        <tbody>
                          <tr>
<td width="20" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><font color="#FFFFFF">Codigo </font></td>
<td width="200" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="Estilo7" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Entidad </font></span></td>
<td width="50" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Fecha Ingreso</font></span></td>
<td width="200" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Puesto </font></span></td>
<td width="80" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Renglon</font></span></td>
<td width="50" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Fecha Egreso </font></span></td>

<td width="500" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Partida </font></span></td>

<td width="250" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Sueldo </font></span></td>

<td width="10" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Eliminar</font></span></td>
                            </tr>
                          <?

		if (!empty($num_gafete))
		{					 						
				contrataciones_gobierno($codpersona);
				
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
        
        
        <tr>
     	  <td><? 
		  

		  
		  include("contrataciones_gobierno.php"); ?></td>
   	  </tr>
     </table>
     </div>
     <div class="TabbedPanelsContent">
      <table width="100%">
     	
     	<tr>
     	  <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="16%" class="Estilo1"><div align="right">Grupo Sanguineo</div></td>
              <td width="18%" class="Estilo1">&nbsp;<select id="g_sanguineo" name="g_sanguineo">
              <? 
			  	if ($row[35]=='O+')
				{
			  print '<option selected value="O+">O+</option>
              <option value="O-">O-</option>
              <option value="AB+">AB+</option>
              <option value="A+">A+</option>
              <option value="AB-">AB-</option>
              <option value="B+">B+</option>
              <option value="B-">B-</option>';					
				}
				else
			  	if ($row[35]=='O-')
				{
				print '<option value="O+">O+</option>
              <option selected value="O-">O-</option>
              <option value="AB+">AB+</option>
              <option value="AB-">AB-</option>
              <option value="B+">B+</option>
              <option value="B-">B-</option>';					
				}
				else
			  	if ($row[35]=='AB+')
				{
					print '<option value="O+">O+</option>
              <option value="O-">O-</option>
              <option selected value="AB+">AB+</option>
              <option value="AB-">AB-</option>
              <option value="B+">B+</option>
              <option value="B-">B-</option>';					
				}
				else
			  	if ($row[35]=='AB-')
				{
					print '<option value="O+">O+</option>
              <option value="O-">O-</option>
              <option value="AB+">AB+</option>
              <option selected value="AB-">AB-</option>
              <option value="B+">B+</option>
              <option value="B-">B-</option>';					
				}
				else
				if ($row[35]=='B+')
				{
					print '<option value="O+">O+</option>
              <option value="O-">O-</option>
              <option value="AB+">AB+</option>
              <option value="AB-">AB-</option>
              <option selected value="B+">B+</option>
              <option value="B-">B-</option>';					
				}
				else
				if ($row[35]=='B-')
				{
					print '<option value="O+">O+</option>
              <option value="O-">O-</option>
              <option value="AB+">AB+</option>
              <option value="AB-">AB-</option>
              <option value="B+">B+</option>
              <option selected value="B-">B-</option>';					
				}
				else
				{
					print '<option selected value="0">--Seleccione--</option>					
					<option value="O+">O+</option>
					<option value="O-">O-</option>
              		<option value="AB+">AB+</option>
	  			    <option value="AB-">AB-</option>
					<option value="B+">B+</option>
					<option value="B-">B-</option>';					
				}
			  ?>
              
              </select></td>
              <td width="14%" class="Estilo1"><div align="right">Grupo Etnico</div></td>
              <td width="52%">&nbsp;<select name="idgrupoetnico" class="TituloMedios" id="idgrupoetnico" >
                  <option value='0'>Ninguno</option>
                  <? 
$sql = "select idgrupoetnico, grupoetnico from asesor_grupoetnico";
			$result = mssql_query($sql);
			while ($grupoet = mssql_fetch_array($result))
			  { 
			  	
				?>
                <? 
					if ($row[31]==$grupoet['idgrupoetnico'])
					{
						print '<option selected value="'.$grupoet['idgrupoetnico'].'">'.$grupoet['grupoetnico'].'</option>';		
					}else{
						print '<option value="'.$grupoet['idgrupoetnico'].'">'.$grupoet['grupoetnico'].'</option>';	
					}
					
				?>
                

                  <? } ?>
                </select></td>
            </tr>
            <tr>
              <td class="Estilo1"><div align="right">Altura</div></td>
              <td class="Estilo1">&nbsp;<input type="text" name="altura" size = "18" value="<? echo $row[36];?>">
                Cm</td>
              <td class="Estilo1"><div align="right">Peso</div></td>
              <td>&nbsp;<input type="text" name="peso" size = "18" value="<? echo $row[37];?>">
                <span class="Estilo1">Kg.</span></td>
            </tr>
            
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table></td>
   	  </tr>
     	<tr>
        	<td class="TabbedPanelsTab">Alergias</td>
        </tr>
        
         <? //aqui empieza ?>
      <tr>	
       <td><table width="83%" align="center" cellpadding="1" cellspacing="1" bordercolor="#000000" bgcolor="#FFFFFF">
              <tr>
                <td width="737" height="52" colspan="3"><div align="center">
                    <div align="center">
                      <table width="735" 
                        border="0" align="center" cellpadding="0" cellspacing="1" bordercolor="#CCCCCC" bgcolor="#CCCCCC" class="TuringHelp" id="table27">
                        <tbody>
                          <tr>
<td width="20" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><font color="#FFFFFF">Codigo </font></td>
<td width="200" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="Estilo7" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Alergia</font></span></td>
<td width="600" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Forma Aliviar</font></span></td>
<td width="10" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Eliminar</font></span></td>
                            </tr>
                          <?

		if (!empty($num_gafete))
		{					 						
				alergias($codpersona);
				
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
        
        
     	<tr>
     	  <td><? include("alergias.php"); ?></td>
   	  </tr>
     	<tr>
     	  <td class="TabbedPanelsTab">Enfermedades</td>
   	  </tr>
      
       <? //aqui empieza ?>
      <tr>	
       <td><table width="83%" align="center" cellpadding="1" cellspacing="1" bordercolor="#000000" bgcolor="#FFFFFF">
              <tr>
                <td width="737" height="52" colspan="3"><div align="center">
                    <div align="center">
                      <table width="735" 
                        border="0" align="center" cellpadding="0" cellspacing="1" bordercolor="#CCCCCC" bgcolor="#CCCCCC" class="TuringHelp" id="table27">
                        <tbody>
                          <tr>
<td width="20" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><font color="#FFFFFF">Codigo </font></td>
<td width="200" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="Estilo7" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Enfermedad </font></span></td>
<td width="700" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Prescripcion Medica</font></span></td>
<td width="200" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Medicamentos </font></span></td>
<td width="200" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Estado</font></span></td>
<td width="10" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Eliminar</font></span></td>
                            </tr>
                          <?

		if (!empty($num_gafete))
		{					 						
				enfermedad($codpersona);
				
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
      
     	<tr>
     	  <td><? include("enfermedad.php"); ?></td>
   	  </tr>
      
      
      
     </table>
     </div>

	
	 <div class="TabbedPanelsContent">
<table width="100%">	 
	      	<tr>
     	
   	  </tr>
     	<tr>
     	  <td class="TabbedPanelsTab">Requisitos</td>
   	  </tr>
      
       <? //aqui empieza ?>
      <tr>	
       <td><table width="100%" align="center" cellpadding="1" cellspacing="1" bordercolor="#000000" bgcolor="#FFFFFF">
              <tr>
                <td width="100%" height="52" colspan="3"><div align="center">
                    <div align="center">
                      <table width="735" 
                        border="0" align="center" cellpadding="0" cellspacing="1" bordercolor="#CCCCCC" bgcolor="#CCCCCC" class="TuringHelp" id="table27">
                        <tbody>
                          <tr>
<td width="20" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><font color="#FFFFFF">Codigo </font></td>
<td width="200" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="Estilo7" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Requisitos</font></span></td>
<td width="500" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Fecha Inicial</font></span></td>
<td width="500" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Fecha Final</font></span></td>
<td width="200" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Archivo</font></span></td>
<td width="10" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Reemplazar</font></span></td>
<td width="20" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Actualizar</font></span></td>
                            </tr>
                          <?

		if (!empty($num_gafete))
		{					 						
				requisitos($codpersona);
				
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
	 
</table>	 
	 </div>
	</div>
 
  </div>
  <p align="center">
<span class="style8">
              <input name="modificar" id="modificar1" type="radio" value="1" onClick="cargar();"/>
              SI<span class="Estilo22">
              <input name="modificar" id="modificar2" type="radio" value="2" onClick="cargar();" /> 
              NO
</span> 
    <input name="actualizar" type="submit"  class="TuringHelp" id="actualizar" onClick="Validar(this.form)" value="ACTUALIZAR DATOS" disabled >
	
  </p>
  
</form>


<script type="text/javascript">
<!--
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
//-->
</script>
</body>
<script type="text/javascript"> 
var peticion = false; 
var  testPasado = false; 
try { 
  peticion = new XMLHttpRequest(); 
  } catch (trymicrosoft) { 
  try { 
  peticion = new ActiveXObject("Msxml2.XMLHTTP"); 
  } catch (othermicrosoft) { 
  try { 
  peticion = new ActiveXObject("Microsoft.XMLHTTP"); 
  } catch (failed) { 
  peticion = false; 
  } 
  } 
} 
if (!peticion) 
alert("ERROR AL INICIALIZAR!"); 
  
function cargarCombo (url, comboAnterior, element_id) { 
    //Obtenemos el contenido del div 
    //donde se cargaran los resultados 
    var element =  document.getElementById(element_id); 
    //Obtenemos el valor seleccionado del combo anterior 
    var valordepende = document.getElementById(comboAnterior) 
    var x = valordepende.value 
    //construimos la url definitiva 
    //pasando como parametro el valor seleccionado 
    var fragment_url = url+'?Id='+x; 
    element.innerHTML = '<img src="../imagen/loading.gif" />'; 
    //abrimos la url 
    peticion.open("GET", fragment_url); 
    peticion.onreadystatechange = function() { 
        if (peticion.readyState == 4) { 
//escribimos la respuesta 
element.innerHTML = peticion.responseText; 
        } 
    } 
   peticion.send(null); 
} 
</script>
</html>
