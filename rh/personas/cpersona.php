<?
//session_start();
include('conectarse.php');
include('../includes/inc_header_sistema.inc');

//envia_msg($modificar);

if ($modificar == 1)
{


		$carpeta_notas = "fotos/".$num_gafete."/notas";
		$carpeta_bonos = "fotos/".$num_gafete."/bonos"; 
		$carpeta = "fotos/".$num_gafete."/anexo"; 
   	    $nombre_carpeta = "fotos/".$num_gafete;
		
		
		if(!is_dir($nombre_carpeta)){
			@mkdir(trim($nombre_carpeta), 0700);			
		}
		
		if(!is_dir($carpeta)){
			@mkdir(trim($carpeta), 0700);			
		}
		
		if(!is_dir($carpeta_bonos)){
			@mkdir(trim($carpeta_bonos), 0700);			
		}

		if(!is_dir($carpeta_notas)){
			@mkdir(trim($carpeta_notas), 0700);			
		}
		
				 
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
	gafete = '$num_gafete',
	colegiado='$colegiado'
	 WHERE gafete = '$num_gafete2'"; 
	
	
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
	gafete = '$num_gafete', 
	colegiado='$colegiado'
	WHERE gafete = '$num_gafete2'";
	
	/*** CARGAR ARCHIVOS  AL SISTEMA  *////			
if (!empty($nombre_archivo))
{
		$result = mssql_query($peopleupdate);			

		if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "jpg") || strpos($tipo_archivo, "pdf")) && ($tamano_archivo < 400000))) { 
			echo "La extensión o el TAMAÑO de los archivos no es correcta. <br><br><table><tr><td><li>Se permiten archivos .gif o .jpg<br><li>se permiten archivos de 100 Kb m�ximo.</td></tr></table>"; 
		}else{ 
			if (move_uploaded_file($HTTP_POST_FILES['userfile']['tmp_name'], $nombre_carpeta."/".trim($nombre_archivo))){ 			 
			}else{ 
			   echo "Ocurri� alg�n error al subir el fichero. No pudo guardarse."; 
			} 
		} 
	

}else{
		$result = mssql_query($peopleup);
}
	/*/////**************FINALIZA CARGAR ARCHIVOS AL SISTEMA   ************/
	

		


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
//				mssql_query("delete from tb_contratacion_gobierno where id_contratacion_gobierno = '$id_contratacion_gobierno[$cnt]'");
			mssql_query("update tb_contratacion_gobierno set oficial='2' where id_contratacion_gobierno = '$id_contratacion_gobierno[$cnt]'");
			// and idasesor='$codpersona'  mand idasesor='$codpersona'
			}
			$cnt ++;
		}
	
		$cnt = 1;
		while ($cnt <= count($id_contratacion_gobierno))
		{			
			if ($checkbox_contratacion2[$cnt] == 'on')
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


		$sql = "select idasesor from asesor where gafete = '$num_gafete'";
		$result = mssql_query($sql);
		$row = mssql_fetch_array($result);
		$codpersona =  $row[0];
		
		
		
		
		mssql_query("delete from tb_telefono where idasesor = '$codpersona'");
		mssql_query("delete from tb_correo where idasesor = '$codpersona'");
		mssql_query("delete from tb_familiares where idasesor = '$codpersona'");
		
		
		
/*/*

				ACTUALIZACION E INSERCION DE ARCHIVOS ADJUNTOS                         ----------------**-*-*-*-*-*-*-

*/		

		$cnt = 1;
		while ($cnt <= count($contador))
		{										
		
		$fname ='files'.$cnt; 	 
		$nombre_ar = $HTTP_POST_FILES[$fname]['name']; 
		$anexo[$cnt] = $nombre_ar;		
		$tipo_archivo = $HTTP_POST_FILES[$fname]['type']; 
		$extension = split('[.]',$nombre_ar);
 	    $extension = $extension[sizeof($extension)-1];				
		$tamano_archivo = $HTTP_POST_FILES[$fname]['size']; 
		if ($checkbox_requisitos[$cnt]=='on')
		{
		/*if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "png") || strpos($tipo_archivo, "jpg") || strpos($tipo_archivo, "pdf") || strpos($tipo_archivo, "doc" || strpos($tipo_archivo, "xls" || strpos($tipo_archivo, "docx")))) && ($tamano_archivo < 100000))) { 
			echo ".."; 
		}else{ */
		
			$temporal = $superkey[$cnt].'.'.$extension;
		
			if (move_uploaded_file($HTTP_POST_FILES[$fname]['tmp_name'], $carpeta."/".$temporal)){ 
			  // echo "El archivo ha sido cargado correctamente."; 
			}else{ 
			   echo "No se pudieron cargar archivos adjuntos"; 
			} 
//		} 
		}else{
			//no hay archivos que se quieran actualizar
		}
		


			
			if ($checkbox_requisitos[$cnt]=='on' && !empty($nombre_ar))
			{
				$qry_update_requisitos =" update tb_requisitos set ";
				$qry_update_requisitos.=" fecha2 = '$testinputi[$cnt]',archivo='$temporal' ";
				$qry_update_requisitos.=" where id_requisito = $superkey[$cnt] ";
				$result = mssql_query($qry_update_requisitos);
			}
			
			
			if ($checkbox_requisitos[$cnt]=='on' && empty($nombre_ar))
			{
				$qry_update_requisitos =" update tb_requisitos set ";
				$qry_update_requisitos.=" fecha2 = '$testinputi[$cnt]' ";
				$qry_update_requisitos.=" where id_requisito = $superkey[$cnt] ";
				$result = mssql_query($qry_update_requisitos);
			}

	
			
			$cnt ++;
		}
		
		
		   $query="SELECT MAX(id_requisito) from tb_requisitos";
		   $result=mssql_query($query);
		   $row=mssql_fetch_array($result);
		   $codigo_archivo=$row[0];		
		   
$cnt = 1;
while ($cnt <= count($requisito))
{	

			$codigo_archivo++;
			$fichero = 'fichero';
			$codigo_requisito = $requisito[$cnt];
			$archi = $fichero.$cnt;
			$fecha2 = $anior[$cnt].'-'.$meser[$cnt].'-'.$diar[$cnt];						
			$fichero_name = $HTTP_POST_FILES[$archi]['name']; 		

		if ($fichero_name!="")
		{
 		   $tipo_archivo = $HTTP_POST_FILES[$archi]['type']; 
		   $extension = split('[.]',$fichero_name);
		   $extension = $extension[sizeof($extension)-1];		
		   $tamano_archivo = $HTTP_POST_FILES[$archi]['size']; 		
		   		   		   
		   $nombre_archivo_def=$codigo_archivo.".".$extension;	
		   
		   //envia_msg($nombre_archivo_def);		   
		   if(move_uploaded_file($HTTP_POST_FILES[$archi]['tmp_name'], $carpeta."/".$nombre_archivo_def))
		   {}else{'Error el fichero no fue copiado correctamente';}			
	     }

	$files[$cnt]=$nombre_archivo_def;	
$cnt++;
}




/*/*

				FINALIZA ACTUALIZACION E INSERCION DE ARCHIVOS ADJUNTOS          +++       +        +++

																					---------------
																						---------
																						
*/		


/*/*

				ACTUALIZACION E INSERCION DE SALARIOS
				                        ----------------**-*-*-*-*-*-*-

*/		

		
		$cnt = 1;

		while ($cnt <= count($acontador))
		{										
	
		$fname ='afiles'.$cnt; 	 
		$nombre_ar = $HTTP_POST_FILES[$fname]['name']; 
		$anexo[$cnt] = $nombre_ar;		
		$tipo_archivo = $HTTP_POST_FILES[$fname]['type']; 
		$extension = split('[.]',$nombre_ar);
 	    $extension = $extension[sizeof($extension)-1];				
		$tamano_archivo = $HTTP_POST_FILES[$fname]['size']; 
		
		if ($acheckbox_requisitos[$cnt]=='on')
		{
		/* if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "png") || strpos($tipo_archivo, "jpg") || strpos($tipo_archivo, "pdf") || strpos($tipo_archivo, "doc" || strpos($tipo_archivo, "xls" || strpos($tipo_archivo, "docx")))) && ($tamano_archivo < 100000))) { 
			echo ".."; 
		}else{ */
		
			$temporal = $asuperkey[$cnt].'.'.$extension;		
			if (move_uploaded_file($HTTP_POST_FILES[$fname]['tmp_name'], $carpeta_bonos."/".$temporal)){ 	
					
				}else{ 
				   echo "No se pudieron cargar archivos adjuntos"; 
				} 		
		}else{
			//no hay archivos que se quieran actualizar
		}
		
			$lista = split( ",", $avalorbono[$cnt]);
			
			$avalorbono[$cnt] = $lista[0].$lista[1];
			
			if ($acheckbox_requisitos[$cnt]=='on' && !empty($nombre_ar))
			{
				$qry_update_requisitos =" update tb_bono set ";
				$qry_update_requisitos.=" fecha2 = '$atestinputi[$cnt]',archivo='$temporal', valor = $avalorbono[$cnt]";
				$qry_update_requisitos.=" where rowid = $asuperkey[$cnt] ";
				$result = mssql_query($qry_update_requisitos);
			}
			
			
			if ($acheckbox_requisitos[$cnt]=='on' && empty($nombre_ar))
			{
				$qry_update_requisitos =" update tb_bono set ";
				$qry_update_requisitos.=" fecha2 = '$atestinputi[$cnt]', valor = $avalorbono[$cnt]";
				$qry_update_requisitos.=" where rowid = $asuperkey[$cnt] ";
				$result = mssql_query($qry_update_requisitos);
			}

			$cnt ++;
		}
		
		   $query="SELECT MAX(rowid) from tb_bono";
		   $result=mssql_query($query);
		   $row=mssql_fetch_array($result);
		   $codigo_archivo=$row[0];		
		   
$cnt = 1;
while ($cnt <= count($bono))
{	


			$codigo_archivo++;
			$fichero = 'ficherobono';
			$archi = $fichero.$cnt;

			$fichero_name = $HTTP_POST_FILES[$archi]['name']; 		
				
		if (!empty($fichero_name))
		{

 		   $tipo_archivo = $HTTP_POST_FILES[$archi]['type']; 
		   $extension = split('[.]',$fichero_name);
		   $extension = $extension[sizeof($extension)-1];		
		   $tamano_archivo = $HTTP_POST_FILES[$archi]['size']; 		
		   		   		   
		   $nombre_archivo_def=$codigo_archivo.".".$extension;			   

		   if(move_uploaded_file($HTTP_POST_FILES[$archi]['tmp_name'], $carpeta_bonos."/".$nombre_archivo_def))
		   {
			   //envia_msg('copiado correctamente');
		   	}else{
				envia_msg('Error el fichero no fue copiado correctamente');
			}			
	     }

	$filesbono[$cnt]=$nombre_archivo_def;	
$cnt++;
}


$cnt = 1;
		while ($cnt <= count($bono))
		{
			$valor = $valorbono[$cnt];
			$fichero = 'ficherobono';
			$codigo_bono = $bono[$cnt];
			$archi = $filesbono[$cnt];
			$fecha2 = $aniobono[$cnt].'-'.$mesbono[$cnt].'-'.$diabono[$cnt];
			
			if (!empty($codigo_bono))
			{
				$qry_insertar_bono ="insert into tb_bono";
				$qry_insertar_bono.="(codigo_bono,fecha2,archivo,idasesor,valor)";
				$qry_insertar_bono.="values ($codigo_bono,'$fecha2','$archi',$codpersona,$valor)";
	
				$result = mssql_query($qry_insertar_bono);
				//print $qry_insertar_bono;
				
			}
		
		$cnt++;
		}


/*/*

				FINALIZA ACTUALIZACION E INSERCION DE      SALARIOS    SSSS          +++       +        +++

																					---------------
																						---------
																						
*/		



//******************************* inicia ACTUALIZACION DE ARCHIVOS DE OBSERVACIONES  ***************///
		
		$cnt = 1;
		while ($cnt <= count($cuenta))
		{										
		
		$fname ='nfiles'.$cnt; 	 
		$nombre_ar = $HTTP_POST_FILES[$fname]['name']; 
		$anexo[$cnt] = $nombre_ar;		
		$tipo_archivo = $HTTP_POST_FILES[$fname]['type']; 
		$extension = split('[.]',$nombre_ar);
 	    $extension = $extension[sizeof($extension)-1];				
		$tamano_archivo = $HTTP_POST_FILES[$fname]['size']; 
		if ($checkbox_notas[$cnt]=='on')
		{
		/*if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "png") || strpos($tipo_archivo, "jpg") || strpos($tipo_archivo, "pdf") || strpos($tipo_archivo, "doc" || strpos($tipo_archivo, "xls" || strpos($tipo_archivo, "docx")))) && ($tamano_archivo < 100000))) { 
			echo ".."; 
		}else{ */
		
			$temporal = $masterkey[$cnt].'.'.$extension;
		
			if (move_uploaded_file($HTTP_POST_FILES[$fname]['tmp_name'], $carpeta_notas."/".$temporal)){ 
			  
			}else{ 
			   echo "No se pudieron cargar archivos adjuntos"; 
			} 
		//} 
		}else{

		}
		
			
			
			if ($checkbox_notas[$cnt]=='on' && !empty($nombre_ar))
			{
				$qry_update_notas =" update tb_observaciones set ";
				$qry_update_notas.=" fecha = '$finput[$cnt]',adjunto='$temporal' ";
				$qry_update_notas.=" where id_observaciones = $masterkey[$cnt] ";
				$result = mssql_query($qry_update_notas);
			}
			
			
			if ($checkbox_notas[$cnt]=='on' && empty($nombre_ar))
			{
				$qry_update_notas =" update tb_observaciones set ";
				$qry_update_notas.=" fecha = '$finput[$cnt]' ";
				$qry_update_notas.=" where id_observaciones = $masterkey[$cnt] ";
				$result = mssql_query($qry_update_notas);
			}

	
			
			
			$cnt ++;
		}
		
		
		
		
		   $query="SELECT MAX(id_observaciones) from tb_observaciones";
		   $result=mssql_query($query);
		   $row=mssql_fetch_array($result);
		   $codigo_archivo=$row[0];		
		   
$cnt = 1;
while ($cnt <= count($txtcodigoobservacion))
{	
			$codigo_archivo++;
			$fichero = 'adjunto';
			$codigo_requisito = $txtcodigoobservacion[$cnt];
			$archi = $fichero.$cnt;
			$fecha2 = $anioobservacion[$cnt].'-'.$meseobservacion[$cnt].'-'.$diaobservacion[$cnt];						
			$fichero_name = $HTTP_POST_FILES[$archi]['name']; 		
				
		if ($fichero_name!="")
		{
 		   $tipo_archivo = $HTTP_POST_FILES[$archi]['type']; 
		   $extension = split('[.]',$fichero_name);
		   $extension = $extension[sizeof($extension)-1];		
		   $tamano_archivo = $HTTP_POST_FILES[$archi]['size']; 		
		   		   		   
		   $nombre_archivo_def=$codigo_archivo.".".$extension;	
		   
		   
		   if(move_uploaded_file($HTTP_POST_FILES[$archi]['tmp_name'], $carpeta_notas."/".$nombre_archivo_def))
		   {}else{'Error el fichero no fue copiado correctamente';}			
	     }

	$files[$cnt]=$nombre_archivo_def;	
$cnt++;
}



$cnt = 1;
		while ($cnt <= count($txtcodigoobservacion))
		{	
					
			$fichero = 'adjunto';
			$codigo_requisito = $txtcodigoobservacion[$cnt];
			$archi = $files[$cnt];
			$fecha2 = $anioobservacion[$cnt].'-'.$meseobservacion[$cnt].'-'.$diaobservacion[$cnt];						
			$txtobservaciong  = $txtobservacion[$cnt];
			if (!empty($codigo_requisito))
			{
				$qry_insertar_notas ="insert into tb_observaciones";
				$qry_insertar_notas.="(tipo_observacion,fecha,observacion,adjunto,idasesor)";
				$qry_insertar_notas.="values ($codigo_requisito,'$fecha2','$txtobservaciong','$archi',$codpersona)";
	
				$result = mssql_query($qry_insertar_notas);
				
			}
		
		$cnt++;
		}


/***************************************** //////////////////////////////**************/////////////////////



		$cnt = 1;
		while ($cnt <= count($requisito))
		{	
					
			$fichero = 'files';
			$codigo_requisito = $requisito[$cnt];
			$archi = $files[$cnt];
			$fecha2 = $anior[$cnt].'-'.$meser[$cnt].'-'.$diar[$cnt];
			
			if (!empty($codigo_requisito))
			{
				$qry_insertar_requisitos ="insert into tb_requisitos";
				$qry_insertar_requisitos.="(codigo_requisito,fecha2,archivo,idasesor)";
				$qry_insertar_requisitos.="values ($codigo_requisito,'$fecha2','$archi',$codpersona)";
	
				$result = mssql_query($qry_insertar_requisitos);
				
			}
		
		$cnt++;
		}
		
		
		
		$cnt = 1;
		while ($cnt <= count($telefono))
		{
	
			$auxiliar = $telefono[$cnt];
			if ($auxiliar[0]=='4' ||$auxiliar[0]=='5')		
			{
				$tipo = 2;
				$extensiont[$cnt]='0';
			}else{
				$tipo = 1;
				if (empty($extensiont[$cnt]))
				{
					$extensiont[$cnt]='0';
				}
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
		// deshabilitado para mientras EN LO QUE SE CORRIGE EL UPDATE//
		/*
		$cnt = 1;
		while ($cnt <= count($idioma))
		{
			$qry_insertar_idiomas ="insert into tb_idiomas";
			$qry_insertar_idiomas.="(id_idiomaref,idasesor,centro_estudios,escribe,lee,habla) ";
			$qry_insertar_idiomas.="values ('$idioma[$cnt]', '$codpersona','$centroidi[$cnt]','$escribe[$cnt]','$lee[$cnt]','$habla[$cnt]')";
			$result = mssql_query($qry_insertar_idiomas);
			$cnt ++;
		}
		*/
		// deshabilitado para mientras EN LO QUE SE CORRIGE EL UPDATE//
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
		
		if ($oficialcg[$cnt]=='1')
		{
			mssql_query("UPDATE asesor SET iddireccion = '$empresaexp[$cnt]' where idasesor = '$codpersona'");
		}

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
		$qry_insertar_estudios ="select e.id_estudios_realizados, p.profesion, n.nivel_estudios, centro_estudios, e.fecha, ee.tipo from estudios_realizados as e inner join nivel_academico as n on n.id_nivel_academico = e.titulo inner join tb_profesion as p on p.codigo_profesion = e.nivel_academico inner join tb_estadoEstudio as ee on ee.id_estadoEstudio = e.id_estadoEstudio where idasesor = $codpersona";
		$result = mssql_query($qry_insertar_estudios);	
					$cnt = 1;
					while ($vec = mssql_fetch_array($result))
					{	
		 					  print '';
		  					  print"<tr> ";
							  print"<input name='id_estudios_realizados[".$cnt."]' id='usua' value='".$vec[0]."' type='hidden'>";
							  print"<TD width='30'><span class='style9'><font color='#335B96'>$vec[0]</font></span></TD>";
							  print"<TD width='113'><span class='style9'>$vec[2]</span></TD>";
  							  print"<TD width='40'><span class='style9'><font color='#335B96'>$vec[3]</font></span></TD>";
							  print"<TD width='80'><span class='style9'>$vec[1]</span></TD>";
							  print"<TD width='200'><span class='style9'><font color='#335B96'>$vec[5]</font></span></TD>";
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
							  print"<TD width='10'><span class='style9'><input type='checkbox' name='checkbox_contratacion[".$cnt."]' id='checkbox'/></span></TD>";							
  							  print"<TD width='10'><span class='style9'><input type='checkbox' name='checkbox_contratacion2[".$cnt."]' id='checkbox'/></span></TD>";							
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
		$qry_insertar_telefono ="select id_telefono,telefono, extensiont,oficial from tb_telefono where idasesor='$codpersona'";
		$result = mssql_query($qry_insertar_telefono);	
					$cnt = 1;
					while ($vec = mssql_fetch_array($result))
					{	
		 				
 						if ($vec[3]==1)
						{
							$oficial = 'SI';
						}else{
							$oficial = 'NO';
						}
						
							  print '';
		  					  print"<tr> ";
							  print"<input name='id_telefono[".$cnt."]' id='usua' value='".$vec[0]."' type='hidden'>";
							  print"<TD width='84' align='center'><span class='style9'><font color='#335B96'>$vec[0]</font></span></TD>";
							  print"<TD width='60' align='center'><span class='style9'>$vec[1]</span></TD>";
						      print"<TD width='53' align='center'><span class='style9'>$vec[2]</span></TD>";
  						      print"<TD width='53' align='center'><span class='style9'>$oficial</span></TD>";
							  print"<TD width='135'><span class='style9'><input type='checkbox' name='checkbox_telefonos[".$cnt."]' id='checkbox' /> </span></TD>";							
							  print"</tr>";		 																				
						$cnt ++;
					}
		}
		
		
		
		
/*//////////////////////FUNCIONES QUE UTILIZAN ARCHIVOS ******************************///////////////	

	
function requisitos($codpersona)
{	
		
	$value = "select gafete from asesor where idasesor = '$codpersona'";
	$gaf = mssql_query($value);
	$gafete = mssql_fetch_array($gaf);
	
							
		$qry_insertar_requisitos ="select r.id_requisito,cr.requisito,convert(varchar,r.fecha2,21) as fecha1,
convert(varchar,r.fecha2,21) as fecha2,r.archivo,r.codigo_requisito from tb_requisitos r, tb_requisito cr where idasesor='$codpersona'
and cr.codigo_requisito = r.codigo_requisito;";
		$result = mssql_query($qry_insertar_requisitos);	
					$cnt = 1;
					while ($vec = mssql_fetch_array($result))
					{	
					
					
		 					  print '';
		  					  print"<tr> ";
  							  print "<input type='hidden' name='contador[".$cnt."]'/>";
							  print"<input name='superkey[".$cnt."]' type='hidden' value=".$vec[0].">";
							  print"<input name='llave[".$cnt."]' type='hidden' value=".$vec[5].">";
							  print"<TD width='120'><span class='style9'>$vec[0]</span></TD>";
							  print"<TD width='350'><span class='style9'>$vec[1]</span></TD>";							  							  							  print"<TD width='200'><span class='style9'><input type='text' name='testinputi[".$cnt."]' value=".$vec[2]." size = '10'> 
							  <script language='JavaScript'>
	new tcal ({
		'formname': 'form1',
		'controlname': 'testinputi[".$cnt."]'
	});

	</script> </span></TD>";							  
  							
							  print "<td width='110'> <a href='fotos/".$gafete[0]."/anexo/".$vec[4]."' target = '_blank'>ver</a></td>";
							  print "<td width='110'> <input type='file' name='files".$cnt."' />";
							  print"<TD width='70'><span class='style9'><input type='checkbox' name='checkbox_requisitos[".$cnt."]' id='checkbox_requisitos[".$cnt."]'/></span></TD>";							
							  print"</tr>";		 																				
					
						
					
						
						$cnt ++;
					}
					
						
		}




/****************************                funtion of notes            **************************/


function anotaciones($codpersona)
{	
		
	$value = "select gafete from asesor where idasesor = '$codpersona'";
	$gaf = mssql_query($value);
	$gafete = mssql_fetch_array($gaf);
	
							
		$qry_insertar_notas ="select x.id_observaciones, y.observacion, x.observacion, x.adjunto,convert(varchar(10),x.fecha,21) from tb_observaciones x,
 tb_observacion y where x.tipo_observacion = y.codigo_observacion and x.idasesor = '$codpersona'";
		$result = mssql_query($qry_insertar_notas);	
					$cnt = 1;
					while ($vec = mssql_fetch_array($result))
					{	
					
					
		 					  print '';
		  					  print"<tr> ";
  							  print "<input type='hidden' name='cuenta[".$cnt."]'/>";
							  print"<input name='masterkey[".$cnt."]' type='hidden' value=".$vec[0].">";
							  print"<input name='mllave[".$cnt."]' type='hidden' value=".$vec[0].">";
							  print"<TD width='120'><span class='style9'>$vec[1]</span></TD>";
  							  print"<TD width='200'><span class='style9'><input type='text' name='finput[".$cnt."]' value=".$vec[4]." size = '10'> 
							  <script language='JavaScript'>
	new tcal ({
		'formname': 'form1',
		'controlname': 'finput[".$cnt."]'
	});

	</script> </span></TD>";							  
							  print"<TD width='350'><span class='style9'>$vec[2]</span></TD>";							  						  							
							  print "<td width='110'> <a href='fotos/".$gafete[0]."/notas/".$vec[3]."' target = '_blank'>ver</a></td>";
							  print "<td width='110'> <input type='file' name='nfiles".$cnt."' />";
							  print"<TD width='70'><span class='style9'><input type='checkbox' name='checkbox_notas[".$cnt."]' id='checkbox_notas[".$cnt."]'/></span></TD>";							
							  print"</tr>";		 																				
					
						
					
						
						$cnt ++;
					}
					
						
		}


/******************************************f u n c t i o n   o  f    s a la r i o s******************************/
function salarios($codpersona)
{	
		
	$value = "select gafete from asesor where idasesor = '$codpersona'";
	$gaf = mssql_query($value);
	$gafete = mssql_fetch_array($gaf);
	
							
		$qry_insertar_bonos ="select r.rowid,cr.descripcion,convert(varchar,r.fecha2,21) as fecha2,r.archivo,r.codigo_bono,r.valor from tb_bono r, tb_bonos cr where idasesor='$codpersona'
and cr.rowid = r.codigo_bono";
		$result = mssql_query($qry_insertar_bonos);	
					$cnt = 1;
					while ($vec = mssql_fetch_array($result))
					{	
		 					  print '';
		  					  print"<tr> ";
  							  print "<input type='hidden' name='acontador[".$cnt."]'/>";
							  print"<input name='asuperkey[".$cnt."]' type='hidden' value=".$vec[0].">";
							  print"<input name='allave[".$cnt."]' type='hidden' value=".$vec[4].">";
							  print"<TD width='120'><span class='style9'>$vec[1]</span></TD>";
							  print"<TD width='350'><span class='style9'> <input name='avalorbono[".$cnt."]' type = 'text' value = ".number_format($vec[5], 2, '.', ',')." size = '10'>
</span></TD>";				
  							  print"<TD width='200'><span class='style9'><input type='text' name='atestinputi[".$cnt."]' value=".$vec[2]." size = '10'> 
							  <script language='JavaScript'>
	new tcal ({
		'formname': 'form1',
		'controlname': 'atestinputi[".$cnt."]'
	});

	</script> </span></TD>";							  
  							
							  print "<td width='110'> <a href='fotos/".$gafete[0]."/bonos/".$vec[3]."' target = '_blank'>ver</a></td>";
							  print "<td width='110'> <input type='file' id='afile' name='afiles".$cnt."' />";
							  print"<TD width='70'><span class='style9'><input type='checkbox' name='acheckbox_requisitos[".$cnt."]' id='acheckbox_requisitos[".$cnt."]'/></span></TD>";							
							  print"</tr>";		 																				
					
						
					
						
						$cnt ++;
					}
					
						
		}


/******************************************   fin de la funcion  **********************************************/


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
		nombre_estado_provincia, year(fecha_nacimiento),month(fecha_nacimiento),day(fecha_nacimiento),zona,tipolicencia,licencia,iddepartamento_reside,gafete,idgrupoetnico,direccion_para_notificaciones,igss,empadronamiento,gruposanguineo,altura,peso,idasesor,userfilefoto,colegiado FROM asesor WHERE gafete = '$num_gafete'";
		
		
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
		$dia7=$row[25];
		$mes7=$row[24];
		$fecha_ing7=$row[23];
		$idlinguistica=$row[31];
		$idgrupoetnico=$row['idgrupoetnico'];
		session_write_close();
	}else
	{
		cambiar_ventana("ocultoerr.php");
	}	

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
	$renglon = $renglon."<option value=189>189</option>";	
	$renglon = $renglon."<option value=Otros>Otros</option>";		
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

<!--<link href="../css/cssWeb.css" type=text/css rel=StyleSheet>-->
<link href="template1/mctabs.css" rel="stylesheet" type="text/css" /><!--se agrego toda la linea>
<!-- JavaScript -->

<script src="javascript-tabs.js" type="text/javascript"></script><!--se agrego toda la linea-->
<!--<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>-->
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
.Estilo7 {font-family: Arial, Helvetica, sans-serif}
.Estilo22 {font-size: 11px}
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
.titulo 

{
font-size:24px;
font-family:Arial, Helvetica, sans-serif, Courier, monospace, sans-serif, sans-serif;
color:#0000FF;
}
.Estilo73 {font-size: 12px}
.Estilo74 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo6 {	color: #FF0000;
	font-size: 12px;
}
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
	  	
	


	  if (form.apellidos.value == "")
	  { alert("Por favor ingrese su Primer Apellido"); form.apellidos.focus(); return; }
	  
	  if (form.estado_civil.value == 0)
		{ alert("Por favor seleccione su Estado Civil"); form.estado_civil.focus(); return; }
		
		

		
	  if ((form.dia.value == "") || (form.mes.value == "") ||(form.ano.value == ""))
	  { alert("Por favor ingrese fecha de cumplea�os"); form.dia.focus(); form.mes.focus(); form.ano.focus(); return; }
	  
	
		alert(form.sexo[0].checked);
	 if ((!form.sexo[0].checked) && (!form.sexo[1].checked))
		{ alert("Por favor ingrese su Sexo"); form.sexo[0].focus(); return; }
		
		 if (form.cedula.value == "")
	  { alert("Por favor confirme su No. de Cedula"); form.cedula.focus(); return; }
		
		/*
	  
	  if ((form.registro.value == "") && (form.opnacionalidad[0].checked))
	  { alert("Por favor confirme su Registro");  return; }

	  if ((form.numero_pasaporte.value == "") && (form.opnacionalidad[1].checked))
	  { alert("Por favor ingrese No. de Pasaporte"); return; }
	
	

	  
/*	  if (form.tema2.value == "") 
	  { alert("Por favor confirme El Departamento"); form.tema2.focus(); return; }
*/	
	  if ((form.idgrupo.value == "") && (form.opnacionalidad[0].checked))
	  { alert("Por favor confirme Municio"); form.idgrupo.focus(); return; }
	/*
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


		  	<?
				 $sqll = "	SELECT licencia,cedula,tipolicencia,iddepartamento_nac,idmunicipio_nac ,iddepartamento_nac1,idmunicipio_nac1,iddepartamento_dpi,idmunicipio_pdi
		 FROM ASESOR where idasesor = '$codpersona'";
		$query9 = mssql_query($sqll);
		  while($vec = mssql_fetch_row($query9))
{	
	$licen = $vec[0];
	$cel = $vec[1];
	$tipolecencia2 = $vec[2];
	$depar_naci = $vec[3];
	$muni_naci = $vec[4];
	$depar_naci1 = $vec[5];
	$muni_naci2 = $vec[6];
	$depar_dpi = $vec[7];
	$muni_dpi = $vec[8];
	
	//$parentesco4 = trim(get_parentescos1($vec[2]));

				
}

 $sqls = "	select  year(fecha_ingreso),activo,  day(fecha_ingreso), month(fecha_ingreso)
	    from tb_datos_laborales where activo= 1 and id_asesor =  '$codpersona'";
	  	$query10 = mssql_query($sqls);
		  while($vec = mssql_fetch_row($query10))
		  {
		    
			$unidad_ejecutora = $vec[0];
			$reglon_presupuestario = $vec[1];
			$dir_pertenece = $vec[2];
			$puesto_funcional = $vec[3];
			$pueto_nominal = $vec[4];
			$viceminis = $vec[5];
			$fecha_ing = $vec[0];
			$sede_pertenece = $vec[8];
			$dia5 = $vec[2];
			$mes5=$vec[3];
			$fuentes=$vec[11];
			$partidas=$vec[12];
			
		  }
		  
	  



		?>
		
		
<body>
<table width="598" border="0" align="left" cellspacing="0">
  <tr bgcolor="#0066CC">
    <td colspan="7" bgcolor="#FFFFFF"><div align="left"><span class="Estilo1 Estilo2 style1"><span class="titulo">Actualizacion  de Empleados </span></span><span class="style5">&nbsp;&nbsp;</span><span class="Estilo67"><font color="#6699FF" face="Arial, Helvetica, sans-serif">&nbsp;&nbsp;Fecha</font> <font face="Arial, Helvetica, sans-serif"> <? echo'<font color="#003399"><strong>'.date("d")."/".date("m")."/".date("Y").'</strong></font>'; ?> <? echo'<font color="#003399"><strong>'.$hora.'</strong></font>'; ?> </font></span></div></td>
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
<p><a href="ficha.php?num_gafete=<?php print $num_gafete; ?>" target="_blank">Generar CV empleado</a></p>
<p><a href="contrato.php?num_gafete=<?php print $num_gafete; ?>" target="_blank">Generar Contrato</a></p>
<!--
<p>&nbsp;</p> -->

<form action="cpersona.php?busca=1" method="post" enctype="multipart/form-data" name="form1" id="form1" >

 <div id="TabbedPanels1" class="TabbedPanels">

      <ul id="tabs1" class="mctabs">
        <li><a href="#view1">Datos Personales</a></li>
        <li><a href="#view2">Datos Academicos</a></li>
        <li><a href="#view3">Datos Laborales</a></li>
	    <li><a href="#view4">Datos relacionados</a></li>
      </ul>
	  
  <div id="view1">
    <table width="1116" border="0">
      <tr>
        <td height="32"><span class="Estilo73">
          <?
			if (!empty($row[39]) )
			{
				
				print '<img src="fotos/'.trim($num_gafete).'/'.$row[39].'" width="73" height="89" />';
			}
				
			?>
        </span></td>
        <td><span class="Estilo73">DPI<font color="#FF0000">*</font><font color="#FF0000"></font></span><strong><span class="Estilo73"><font color="#FF0000"><strong>*</strong></font></span>
            <input name="num_gafete" id="num_gafete" size="18" value="<? echo $row[30];?>" readonly/>
        </strong></td>
        <td height="58" class="Estilo73">DPI Extendido en</td>
        <td><span class="Estilo74">
          <select name="select4" class="TituloMedios" id="select3" onchange="javascript:cargarCombo('subactividad.php', 'registro2', 'Div_Subactividad2')" >
            <option value=''> Seleccione </option>
            <?      
			$sql = "select dpi.codigo_registro,dpi.registro, dep.nombre_departamento, dep.codigo_departamento from dbo.tb_registro as dpi inner join dbo.tb_departamento as dep on dpi.codigo_departamento= dep.codigo_departamento where dpi.codigo_departamento >0";
			$resultdeplug = mssql_query($sql);
			while ($dpiLugare = mssql_fetch_array($resultdeplug))
			  {
			  if ($depar_dpi ==  $dpiLugare[0] )
					{
						print '<option selected value="'. $dpiLugare['codigo_registro'].'">'.$dpiLugare['nombre_departamento'].'</option>';		
					}else{
						print '<option  value="'. $dpiLugare['codigo_registro'].'">'.$dpiLugare['nombre_departamento'].'</option>';		
					}

			  }
			  	
			
			
			 ?>
          </select>
          <br />
          <span class="Estilo73">
          <select name="select3"  id="select4" class="TituloMedios">
            <?      
		    $sql2 = "select codigo_departamento from tb_registro where codigo_registro = $depar_dpi";
	$result = mssql_query($sql2);
	$res = mssql_fetch_array($result);
	$cdepartamento = $res['codigo_departamento']; 
		  
			$sql = " select codigo_municipio, nombre_municipio, muestra_muni from tb_municipio where codigo_departamento =$cdepartamento";
			$resultdpi = mssql_query($sql);
			while ($dpilugar = mssql_fetch_array($resultdpi))
			  {
			  if ($muni_naci ==  $dpilugar[0] )
					{
						print '<option selected value="'. $dpilugar['codigo_municipio'].'">'.$dpilugar['nombre_municipio'].'</option>';		
					}else{
						print '<option  value="'. $dpilugar['codigo_municipio'].'">'.$dpilugar['nombre_municipio'].'</option>';		
					}

			  }
			  	
			
			
			 ?>
          </select>
        </span></span></td>
      </tr>
      <tr>
        <td><span class="Estilo73">Primer Nombre <font color="#FF0000"><strong>**</strong></font></span></td>
        <td><span class="Estilo7">
          <input name="nombre" type="text" class="Estilo7" id="nombre" size="30" onkeyup="javascript:this.value=this.value.toUpperCase();" value="<? echo $row[0];?>" />
        </span></td>
        <td height="37"><span class="Estilo73">Segundo Nombre</span></td>
        <td><input name="nombre2" type="text" class="Estilo7" id="nombre2" size="30" onkeyup="javascript:this.value=this.value.toUpperCase();" value="<? echo $row[1];?>" /></td>
      </tr>
      <tr>
        <td><span class="Estilo73">Tercer Nombre</span></td>
        <td><span class="Estilo7">
          <input name="nombre3" type="text" class="Estilo7" id="nombre3" size="30" onkeyup="javascript:this.value=this.value.toUpperCase();" value="<? echo $row[2];?>" />
        </span></td>
        <td width="152">&nbsp;</td>
        <td width="434">&nbsp;</td>
      </tr>
      <tr>
        <td height="37"><span class="Estilo73">Primer Apellido<font color="#FF0000"><strong>**</strong></font></span></td>
        <td><input name="apellidos" type="text" class="Estilo7" id="apellidos" size="30" onkeyup="javascript:this.value=this.value.toUpperCase();" value="<? echo $row[3];?>" /></td>
        <td><span class="Estilo73">Segundo Apellido</span></td>
        <td><span class="Estilo7">
          <input name="apellido2" type="text" class="Estilo7" id="apellido2" size="30" onkeyup="javascript:this.value=this.value.toUpperCase();" value="<? echo $row[4];?>" />
        </span></td>
      </tr>
      <tr>
        <td height="34"><span class="Estilo73">Apellido de Casada</span></td>
        <td><span class="Estilo7">
          <input name="apellidocasada" type="text" class="Estilo7" id="apellidocasada" size="30" onkeyup="javascript:this.value=this.value.toUpperCase();" value="<? echo $row[5];?>" />
        </span></td>
        <td><span class="Estilo73">Estado Civil<font color="#FF0000"><strong>**</strong></font></span></td>
        <td><span class="Estilo22">
          <select name="estado_civil" class="TituloMedios" id="estado_civil"  >
            <option selected="selected" value=''> Seleccione </option>
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
      </tr>
      <tr>
        <td class="Estilo73">Fecha de Nacimiento: </td>
        <td class="Estilo73">
		dia
		<select name="mes1" class="Estilo1">
		<?
	$i=1;
		
	 while ($i<=31)
	  {
	  if ($i == $dia7)
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
          <select name="mes1" class="Estilo1">
            <option></option>
            <?
	$i=1;
		
	 while ($i<=12)
	  {
			  if ($i == $mes7)
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
          <select name="ano1" class="Estilo1">
            <option></option>
            <?
	$i=1900;		
	 while ($i<=date('Y'))
	  {
		  if ($i == $fecha_ing7)
		  {
			print ' <option selected value="'.$i.'" >'.$i.'</option>';
		  }else{
			print '<option value="'.$i.'">'.$i.'</option>';
		  }	  
	  $i++;
	  }
	 
	?> 
	</select></td>
        <td class="Estilo73">Lugar de Nacimiento </td>
        <td><p class="Estilo74">
            <!-- primer combo -->
            <!-- primer combo -->
            <select name="select" class="TituloMedios" id="select" onchange="javascript:cargarCombo('subactividad.php', 'registro2', 'Div_Subactividad2')" >
              <option value=''> Seleccione </option>
              <?      
			$sql = "select dpi.codigo_registro,dpi.registro, dep.nombre_departamento, dep.codigo_departamento from dbo.tb_registro as dpi inner join dbo.tb_departamento as dep on dpi.codigo_departamento= dep.codigo_departamento where dpi.codigo_departamento >0";
			$resultnaci = mssql_query($sql);
			while ($rownaci = mssql_fetch_array($resultnaci))
			  {
			  if ($depar_naci1 ==  $rownaci[0] )
					{
						print '<option selected value="'. $rownaci['codigo_registro'].'">'.$rownaci['nombre_departamento'].'</option>';		
					}else{
						print '<option  value="'. $rownaci['codigo_registro'].'">'.$rownaci['nombre_departamento'].'</option>';		
					}

			  }
			  	
			
			
			 ?>
            </select>
            <br />
            <span class="Estilo73">
            <select name="select2"  id="select2" class="TituloMedios">
              <?      
		    $sql2 = "select codigo_departamento from tb_registro where codigo_registro =$depar_naci1";
	$result = mssql_query($sql2);
	$res = mssql_fetch_array($result);
	$cdepartamento = $res['codigo_departamento']; 
		  
			$sql = " select codigo_municipio, nombre_municipio, muestra_muni from tb_municipio where codigo_departamento =$cdepartamento";
			$resultestado = mssql_query($sql);
			while ($rowestado = mssql_fetch_array($resultestado))
			  {
			  if ($muni_naci ==  $rowestado[0] )
					{
						print '<option selected value="'. $rowestado['codigo_municipio'].'">'.$rowestado['nombre_municipio'].'</option>';		
					}else{
						print '<option  value="'. $rowestado['codigo_municipio'].'">'.$rowestado['nombre_municipio'].'</option>';		
					}

			  }
			  	
			
			
			 ?>
            </select>
        </span></p></td>
      </tr>
      
      <tr>
        <td height="33"><span class="Estilo73">Nacionalidad<font color="#FF0000"><strong>**</strong></font></span></td>
        <td><span class="Estilo73">
		<? 
		if($row[18] == 1)
		{
			echo "<input name='opnacionalidad' type='radio' onclick='imprimir();' value='1' checked='checked' />
          Guatemalteco
  		<input name='opnacionalidad' type='radio' value='2' onclick='imprimir();'/>
          Otro";
		}
		else
		{
		 echo "<input name='opnacionalidad' type='radio' onclick='imprimir();' value='1'  />
          Guatemalteco
  		<input name='opnacionalidad' type='radio' value='2' onclick='imprimir(); checked='checked'/>
          Otro";
		}
		?>
          </span></td>
        <td class="Estilo73">Genero:</td>
        <td><span class="Estilo73">
		<? 
		if($row[6] == 'M')
		{
			echo "<input name='generopersona' type='radio' onclick='imprimir();' value='1' checked='checked' />
          M
  		<input name='generopersona' type='radio' value='2' onclick='imprimir();'/>
          F";
		}
		else
		{
		 echo "<input name='generopersona' type='radio' onclick='imprimir();' value='1'  />
          Hombre
  		<input name='generopersona' type='radio' value='2' onclick='imprimir(); checked='checked'/>
          Mujer";
		}
		?>
		</span></td>
      </tr>
      <tr>
        <td class="Estilo73">Grupo Etnico</td>
        <td><select name="idgrupoetnico" class="TituloMedios" id="idgrupoetnico" >
            <option value='0'>Ninguno</option>
            <? 



		  
$sql = "select idgrupoetnico, grupoetnico from asesor_grupoetnico";
			$result = mssql_query($sql);
			while ($grupoet = mssql_fetch_array($result))
			  { 
			  	
				?>
            <? 
		   
		  
					if ($idgrupoetnico ==$grupoet[0])
					{
						print '<option selected value="'.$grupoet['idgrupoetnico'].'">'.$grupoet['grupoetnico'].'</option>';		
					}else{
						print '<option value="'.$grupoet['idgrupoetnico'].'">'.$grupoet['grupoetnico'].'</option>';	
					}
					
				?>
            <? } ?>
        </select></td>
        <td class="Estilo73">Comunidad Lung&uuml;istica: </td>
        <td><span class="Estilo74">
          <select name="select4" class="TituloMedios" id="select3" onchange="javascript:cargarCombo('subactividad.php', 'registro2', 'Div_Subactividad2')" >
            <option value=''> Seleccione </option>
            <?      
			$sql = "select * from dbo.tb_linguistica";
			$resultdeplug = mssql_query($sql);
			while ($dpiLugare = mssql_fetch_array($resultdeplug))
			  {
			  if ($idlinguistica ==  $dpiLugare[0] )
					{
						print '<option selected value="'. $dpiLugare[0].'">'.$dpiLugare[1].'</option>';		
					}else{
						print '<option  value="'. $dpiLugare[0].'">'.$dpiLugare[1].'</option>';		
					}

			  }
			  	
			
			
			 ?>
          </select>
       </span></td>
      </tr>
      <tr>
        <td height="42" class="Estilo73">Numero de telefono </td>
        <td><span class="Estilo22">
          <input name="cedula" type="text" class="Estilo7" id="cedula" size="18" value="<? echo $cel;?>" />
        </span></td>
        <td><span class="Estilo73">Fotografia<font color="#FF0000"><strong>**</strong></font></span></td>
        <td><input name="userfile" type="file" id="userfile" /></td>
        <?
				 $sqll = "SELECT idgrupoetnico FROM ASESOR where idasesor  = '$codpersona'";
		$query9 = mssql_query($sqll);
		  while($vec = mssql_fetch_row($query9))
{	
	$grupo = $vec[0];
	//$parentesco4 = trim(get_parentescos1($vec[2]));

				
}
		?>
        </tr>
      <tr>
        <td height="55"><span class="Estilo73">Tipo de Licencia</span></td>
        <td><span class="Estilo74">
          <select name="tipo_licencia" id="tipo_licencia" >
            <option value='0'>seleccione</option>
            <? 
		  
		   
		  
					if ($tipolecencia2 =='A')
					{
					    print '<option selected value="B">B</option>';
						print '<option selected value="C">C</option>';
						print '<option selected value="M">M</option>';	
						print '<option selected value="A">A</option>';		
					}
					if ($tipolecencia2 =='B')
					{
					    print '<option selected value="A">A</option>';
						print '<option selected value="B">B</option>';
						print '<option selected value="C">C</option>';
						print '<option selected value="M">M</option>';
						print '<option selected value="B">B</option>';		
					}
					if ($tipolecencia2 =='C')
					{
						print '<option selected value="A">A</option>';
						print '<option selected value="B">B</option>';
						print '<option selected value="M">M</option>';
						print '<option selected value="C">C</option>';		
						
					}
					if ($tipolecencia2 =='M')
					{
						
						print '<option selected value="A">A</option>';
						print '<option selected value="B">B</option>';
						print '<option selected value="C">C</option>';
						print '<option selected value="M">M</option>';	
						
					}
					
					
					
					
					
					
				?>
          </select>
  &nbsp;&nbsp;&nbsp; </span><span class="Estilo73">Numero</span><span class="Estilo74"><span class="Estilo7">
  <input type="text" name="num_licencia" size = "20" value=" <? echo $licen; ?>" />
</span>&nbsp; </span></td>
        <td height="36"><span class="Estilo73">NIT</span></td>
        <td><span class="Estilo22">
          <input name="cedula2" type="text" class="Estilo7" id="cedula2" size="18" value="<? echo $row[7];?>" />
        </span></td>
      </tr>
      <tr>
        <td height="45" class="Estilo73">Datos Familirares </td>
        <td colspan="3"><p></p>
            <strong>
            <?
		

function get_parentescos()
{
	
$query = mssql_query("select id_parentesco,parentesco from parentesco order by id_parentesco");																									
	if ($query)
		{

			while($row = mssql_fetch_row($query))	
			{
				$opciones = $opciones."<option value = ".$row[0]. ">".$row[1]."</option>";
			}
			
	}
	return $opciones;
}


function get_parentescos1($valor)
{
	
$query = mssql_query("select id_parentesco,parentesco from parentesco order by id_parentesco");																									
	if ($query)
		{

			while($row = mssql_fetch_row($query))	
			{
				if($row[0] == $valor)
				{
					$opciones = $opciones."<option selected value = ".$row[0]. ">".$row[1]."</option>";						
				}else{
					$opciones = $opciones."<option value = ".$row[0]. ">".$row[1]."</option>";
				}
					
			}
			
	}
	return $opciones;
}


function seledias($diases1)
{
	$i=1;
		
	 while ($i<=31)
	  {
	  if ($i == $diases1)
	  {
	  	$seled = $seled.' <option selected value="'.$i.'" >'.$i.'</option>';
	  }else{
	  	$seled = $seled.'<option value="'.$i.'">'.$i.'</option>';
	  }
	  
	  $i++;
	 } 
return $seled;	
}	
	
	 
	 function selemeses ($meses1){
	 $i=1;
	 while ($i<=12)
	  {
			  if ($i == $meses1)
			  {
				$selem = $selem.' <option selected value="'.$i.'" >'.$i.'</option>';
			  }else{
				$selem = $selem.'<option value="'.$i.'">'.$i.'</option>';
			  }
			  $i++;
	  }
	  return $selem;
	}
	
	function seleanios ($anios1){
	 $i=1900;		
	 while ($i<=date('Y'))
	  {
		  if ($i == $anios1)
		  {
			$selea = $selea.' <option selected value="'.$i.'" >'.$i.'</option>';
		  }else{
			$selea = $selea.'<option value="'.$i.'">'.$i.'</option>';
		  }	  
	  $i++;
	  }
	
	return $selea;
	 }
	?>
            <p><strong> Familiares</strong> </p>
          <table width="93%" height="16" border="0" cellspacing="0" id="tabla4">
              <tr>
                <th width="15" height="16" class="HelloUser" scope="col">#</th>
                <th width="98" class="HelloUser" scope="col">Nombre</th>
                <th width="91" class="HelloUser" scope="col">Parentesco</th>
                <th width="106" class="HelloUser" scope="col">Telefono</th>
              </tr>
            </table>
          <br />
            <input name="button" type="button" class="ProgressWriting" onclick="agregar4()" value="Agregar  Familiar" />
            <input name="button" type="button" class="ProgressWriting" onclick="borrarUltima4()" value="Borrar  Familiar" />
            <?

$o = get_parentescos();
echo '<script>
var contLin4 = 1;
function agregar4() {
	var tr, td;

	tr = document.all.tabla4.insertRow();
	td = tr.insertCell();
	td.innerHTML = contLin4 +"";

	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"nombre_familiar["+contLin4+"]\" type=\"text\" id=\"textfield\" size=\"20\">";

	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"tipo_parentesco["+contLin4+"]\" id=\"select\">';
	echo $o;
	echo '</select>";';
	
	echo '	

	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"telefonofam["+contLin4+"]\" type=\"text\" id=\"textfield\" size=\"20\">";

	td = tr.insertCell();

	contLin4++;
}

function borrarUltima4() {
	ultima = document.all.tabla4.rows.length - 1;
	if (ultima !=0)
	{
	 document.all.tabla4.deleteRow(ultima);
	 contLin4--;
	}
}
';


echo '

function agregar701(veta1,veta2,v3,v4,v5,v6,v7) {



	var tr, td;
	tr = document.all.tabla4.insertRow();
	
	td = tr.insertCell();
	td.innerHTML = contLin4 +"";
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"nombre_familiar["+contLin4+"]\" type=\"text\" id=\"textfield\" value=\""+veta1+"\" size=\"30\">";
	
	
	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"tipo_parentesco["+contLin4+"]\" id=\"select\">"+veta2+"</select>";
	

	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"telefonofam["+contLin4+"]\" type=\"text\" id=\"textfield\" value=\""+v7+"\" size=\"30\">";
			
	
	td = tr.insertCell();
	
	
	contLin4++;
}



function prueba()
{
	alert("que tal a todos");
}

</script>';

$query1 = "select f.id_familiares,f.nombre_familiar,f.tipo_parentesco,day(f.fecha_nac),month(f.fecha_nac),year(f.fecha_nac),f.lugar_ocupacion,f.telefono from tb_familiares f, parentesco p where idasesor='$codpersona' and f.tipo_parentesco = p.id_parentesco";

$query = mssql_query($query1);


while($vec = mssql_fetch_row($query))
{	
	$name4 = $vec[1];
	$parentesco4 = trim(get_parentescos1($vec[2]));
	$dia4 = trim(seledias($vec[3]));
	$mes4 = trim(selemeses($vec[4]));
	$anio4 = trim(seleanios($vec[5]));
	$escuela4 = $vec[6];
	$telefono4 = $vec[7];

	echo "<script>";	
	print "agregar701(";
	print "'$name4'"; 
	print ',';
	print "'$parentesco4'";
	print ',';
	print "'$anio4'";
	print ',';
	print "'$mes4'";
	print ',';
	print "'$dia4'";
	print ',';
	print "'$escuela4'";
	print ',';
	print "'$telefono4'";
	print ")";	
	echo "</script>";				
}



?></td>
      </tr>
      <tr>
        <td height="55">&nbsp;</td>
        <td>&nbsp;</td>
        <td height="36">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="35" class="Estilo73">Correo Electronico </td>
        <td colspan="3"><?
		
		/**                codigo de correos                **/
		
		


function get_ofi($ofi)
{


		
	if ($ofi == 1)
	{
		$opciones = "<option selected value = 1>SI</option><option value = 2>NO </option>";
	}else{
		$opciones = "<option value = 1>SI</option><option selected value = 2>NO </option>";
	}
	
	return $opciones;
}

	
	?>
          Correos Electronicos
          <table width="60%" border="0" cellspacing="0" id="tabla5">
        <tr>
          <th width="31" class="HelloUser" scope="col">#</th>
          <th width="179" class="HelloUser" scope="col">Correo </th>
          <th width="60" class="HelloUser" scope="col">Oficial</th>
        </tr>
      </table>
          <br />
      <input name="button2" type="button" class="ProgressWriting" onclick="agregar5()" value="Agregar  Correo" />
      <input name="button2" type="button" class="ProgressWriting" onclick="borrarUltima5()" value="Borrar  Correo" />
      <span class="HelloUser">
      <?



/*$query = mssql_query("select t.id_telefono,t.telefono,a.toficial,t.extensiont,t.iddireccion,t.id_tipo_telefono,t.telefono 
from tb_telefono t, tb_oficial a where t.idasesor = '$codpersona' and a.oficial = t.oficial");*/


$query = mssql_query("select id_correo,idasesor,correo,oficial from tb_correo where idasesor = '$codpersona'");



echo '<script>

var contLin5 = 1;	

function agregar5() {
	var tr, td;
	
	tr = document.all.tabla5.insertRow();
	td = tr.insertCell();
	td.innerHTML = contLin5 +"";
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"correo["+contLin5+"]\" type=\"text\" id=\"textfield\" size=\"60\">";
		
	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"oficialc["+contLin5+"]\" id=\"select\">';
	echo $condicional;
	echo '</select>";

	
	td = tr.insertCell();
	contLin5++;
}';


echo ' 
function agregar55(veta1,veta2) {


	var tr, td;
	tr = document.all.tabla5.insertRow();
	
	td = tr.insertCell();
	td.innerHTML = contLin5 +"";
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"correo["+contLin5+"]\" type=\"text\" id=\"textfield\" value=\""+veta1+"\" size=\"60\">";
	
			
	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"oficialc["+contLin5+"]\" id=\"select\">"+veta2+"</select>";
	
	
	td = tr.insertCell();
	contLin5++;
}

function borrarUltima5() {
	ultima = document.all.tabla5.rows.length - 1;
	if (ultima !=0)
	{
	 document.all.tabla5.deleteRow(ultima);
	 contLin5--;
	}
}

function prueba()
{
	alert("que tal a todos");
}

</script>';




while($veta = mssql_fetch_row($query))
{	

	$conve = $veta[2];
	$oficil = trim(get_ofi($veta[3]));	



	echo "<script>";	
	print "agregar55(";
	print "'$conve'"; 
	print ',';
	print "'$oficil'";
	print ")";	
	echo "</script>";				
}

?>
    </span></td>
      </tr>
      <tr>
        <td height="58" class="Estilo73">&nbsp;</td>
        <td>&nbsp;</td>
        <td class="Estilo73">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="21" class="Estilo73">&nbsp;</td>
        <td colspan="3">&nbsp;</td>
      </tr>
      <tr>
        <td height="35" class="Estilo73">&nbsp;</td>
        <td colspan="3">&nbsp;</td>
      </tr>
      <tr>
        <td height="29" class="Estilo73">&nbsp;</td>
        <td colspan="3">&nbsp;</td>
      </tr>
      <tr>
        <td class="Estilo22">&nbsp;</td>
        <td>&nbsp;</td>
        <td class="Estilo22">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td class="Estilo22">&nbsp;</td>
        <td>&nbsp;</td>
        <td class="Estilo22">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
    <p>&nbsp;</p>
  </div>
  
  
  <div id="view2">
    
	
	 <table width="100%">
     
          	<tr>
        	<td class="TabbedPanelsTab">Estudios Realizados</td>
        </tr>

     
    
      <tr>	
       <td><table width="69%" align="center" cellpadding="1" cellspacing="1" bordercolor="#000000" bgcolor="#FFFFFF">
              <tr>
                <td width="737" height="31" colspan="3"><div align="center">
                    <div align="center">
                      <table width="772" 
                        border="0" align="center" cellpadding="0" cellspacing="1" bordercolor="#CCCCCC" bgcolor="#CCCCCC" class="TuringHelp" id="table27">
                        <tbody>
                          <tr>
<td width="218" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><font color="#FFFFFF">Codigo </font></td>
<td width="81" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Nivel Academinco</font></span></td>
<td width="81" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Centro de Estudios</font></span></td>
<td width="236" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Titulo</font></span></td>
<td width="120" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Estado </font></span></td>
<td width="120" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Fecha Ingreso </font></span></td>
<td width="59" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Eliminar </font></span></td>
                          </tr>
                          <?
						  

		if (!empty($num_gafete))
		{					 						
				estudios_realizados($codpersona);
				
		}

?>
                          <tr>
                            <td width="218"></td>
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
	 <!-- </div><!--fin view 3-->
     	 <tr>
     	  <td class="TabbedPanelsTab">Capacitaciones</td>
   	  </tr>
      
           <? //aqui empieza ?>
      <tr>	
       <td><table width="69%" align="center" cellpadding="1" cellspacing="1" bordercolor="#000000" bgcolor="#FFFFFF">
              <tr>
                <td width="737" height="19" colspan="3"><div align="center">
                    <div align="center">
                      <table width="735" 
                        border="0" align="center" cellpadding="0" cellspacing="1" bordercolor="#CCCCCC" bgcolor="#CCCCCC" class="TuringHelp" id="table27">
                        <tbody>
                          <tr>
<td width="20" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><font color="#FFFFFF">Codigo </font></td>
<td width="200" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="Estilo7" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Curso</font></span></td>

<td width="150" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Fecha Ingreso </font></span></td>
<td width="120" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Lugar</font></span></td>
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
     	  <td><? include("capacitaciones.php"); ?>
   	      <br /></td>
   	 </tr>
      
    
                         <tr>
                            <table width="1116" border="0">
              <tr>
                <td height="29" class="Estilo73">Idiomas </td>
                <td colspan="3"><?
		
		/**                codigo IDIOMA               **/
		
		
function get_idiomas($idio)
{
	
$query = mssql_query("select id_idioma,idioma from tb_idioma order by id_idioma  ");																									
	if ($query)
		{

			while($row = mssql_fetch_row($query))	
			{
				$opciones = $opciones."<option value = ".$row[0]. ">".$row[1]."</option>";
			}
			
	}
	return $opciones;
}



function get_idiomas1($idios)
{
	
$query = mssql_query(" select id_idioma, idioma from tb_idioma order by id_idioma ");																									
	if ($query)
		{

			while($row = mssql_fetch_row($query))	
			{
				if($row[0] == $idios)
				{
					$opciones = $opciones."<option selected value = ".$row[0]. ">".$row[1]."</option>";						
				}else{
					$opciones = $opciones."<option value = ".$row[0]. ">".$row[1]."</option>";
				}
					
			}
			
	}
	return $opciones;
}


function get_ofi5($ofi)
{

		
	if ($ofi == 1)
	{
		$opciones = "<option selected value = 1>SI</option><option value = 2>NO </option>";
	}else{
		$opciones = "<option value = 1>SI</option><option selected value = 2>NO </option>";
	}
	
	return $opciones;
}
function get_ofi6($ofi)
{

		
	if ($ofi == 1)
	{
		$opciones = "<option selected value = 1>SI</option><option value = 2>NO </option>";
	}else{
		$opciones = "<option value = 1>SI</option><option selected value = 2>NO </option>";
	}
	
	return $opciones;
}

function get_ofi7($ofi)
{

		
	if ($ofi == 1)
	{
		$opciones = "<option selected value = 1>SI</option><option value = 2>NO </option>";
	}else{
		$opciones = "<option value = 1>SI</option><option selected value = 2>NO </option>";
	}
	
	return $opciones;
}
	



	
	?>
                    <br />
                    <table width="73%" border="0" cellspacing="0" id="tabla30">
                      <tr>
                        <th width="31" class="HelloUser" scope="col">#</th>
                        <th width="100" class="HelloUser" scope="col"><div align="center">Idioma</div></th>
                        <th width="179" class="HelloUser" scope="col">Centro de Estudios</th>
                        <th width="40" class="HelloUser" scope="col">escribe</th>
                        <th width="30" class="HelloUser" scope="col">lee</th>
                        <th width="30" class="HelloUser" scope="col">habla</th>
                      </tr>
                    </table>
                  <p>
                      <input name="button3" type="button" class="ProgressWriting" onclick="agregar30()" value="Agregar Idioma" />
                      <input name="button3" type="button" class="ProgressWriting" onclick="borrarUltima30()" value="Borrar Idioma" />
                      <?

$op = get_idiomas();



echo '<script>
var contLin30 = 1;
function agregar30() {
	var tr, td;

	tr = document.all.tabla30.insertRow();
	td = tr.insertCell();
	td.innerHTML = contLin30 +"";
		
	

	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"idioma["+contLin30+"]\" id=\"select\" >';
	echo $op;
	echo '</select>";			
	
	
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"centroidi["+contLin30+"]\" type=\"text\" id=\"textfield\" size=\"30\">";	
	
	
	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"escribe["+contLin30+"]\" id=\"select\">';
	echo $condicional;
	echo '</select>";

	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"lee["+contLin30+"]\" id=\"select\">';
	echo $condicional;
	echo '</select>";

	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"habla["+contLin30+"]\" id=\"select\">';
	echo $condicional;
	echo '</select>";
	
	


	td = tr.insertCell();

	contLin30++;
}';

echo '

function agregar90(esp1,esp2, esp3, esp4, esp5){
   
   var tr, td;
	

	tr = document.all.tabla30.insertRow();
	td = tr.insertCell();
	td.innerHTML = contLin30 +"";
	

	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"idioma["+contLin30+"]\" id=\"select\">"+esp1+"</select>";';
	
	echo '	
	
	
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"centroidi["+contLin30+"]\" type=\"text\" id=\"textfield\"  value=\""+esp2+"\" size=\"30\">";
	
	
	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"escribe["+contLin30+"]\" id=\"select\"> "+esp3+"</select>";';
	
	echo '

	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"lee["+contLin30+"]\" id=\"select\">"+esp4+"</select>";';
	
	echo ';

	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"habla["+contLin30+"]\" id=\"select\">"+esp5+"</select>";';

	echo '
	
	
	


	td = tr.insertCell();

	contLin30++;


}


function borrarUltima30() {
	ultima = document.all.tabla30.rows.length - 1;
	if (ultima !=0)
	{
	 document.all.tabla30.deleteRow(ultima);
	 contLin30--;
	}
}
</script>';


$query = mssql_query("select us.id_idiomaref, us.centro_estudios, us.escribe, us.lee,
		us.habla from tb_idiomas as us inner join tb_idioma as id on us.id_idiomaref = id.id_idioma  where us.idasesor    = '$codpersona'");

while($vetas = mssql_fetch_row($query))
{	



	$idioma23 = trim(get_idiomas1($vetas[0]));
	$centroeduc = $vetas[1];
	$escribe23 = trim(get_ofi5($vetas[2]));
	$lee23 = trim(get_ofi6($vetas[3]));
	$habla23 = trim(get_ofi7($vetas[4]));
	
	
		

	
	echo "<script>";	
	print "agregar90(";
	print "'$idioma23'"; 
	print ',';
	print "'$centroeduc'";
	print ',';
	print "'$escribe23'";
	print ',';
	print "'$lee23'";
	print ',';
	print "'$habla23'";	
	print ")";	
	echo "</script>";			
}

?>
                  </p></td>
              </tr>
            </table>
        </tr>
                        </tbody>
      </table>
    </div>
                 
  </div></td>
              </tr>
            </table>
    <? $query_nom_fun = "select * from tb_datos_laborales where id_asesor = $codpersona";
	
	$result_nom_fun = mssql_query($query_nom_fun);
	
	$row_nom_fun = mssql_fetch_array($result_nom_fun);
	?>
            <div id="view3">
    <table width="1117" border="0">
      <tr>
        <td><span class="Estilo73">Partida presupuestaria <font color="#FF0000"><strong>**</strong></font></span></td>
        <td><select name="partida_presupues" class="TituloMedios Estilo73" id="select13" >
            <option value='0'> Ninguno </option>
            <? 
$sql = "select id_partida_presupuestaria, nombre_partida from tb_partida";
			$result = mssql_query($sql);
			while ($row = mssql_fetch_array($result))
			  { 
			  	
				if ($row_nom_fun['id_partida_presupuestaria']  == $row[0])
					{
						print '<option selected value="'.$row[0].'">'.$row[1].'</option>';		
					}else{
						print '<option value="'.$row[0].'">'.$row[1].'</option>';	
					}
             } ?>
        </select></td>
        <td><span class="Estilo73">Reglon Presupuestario <font color="#FF0000"><strong>**</strong></font></span></td>
        <td><select name="reglon_presupuestario" class="TituloMedios Estilo73" id="select6" >
            <option value='0'> Ninguno </option>
            <? 
$sql = "select id_reglon_presupuestario, reglon from tb_reglon_presupuestario";
			$result = mssql_query($sql);
			while ($row = mssql_fetch_array($result))
			  { 
			  		if ($row_nom_fun['id_reglon_presupuestario'] ==$row[0])
					{
						print '<option selected value="'.$row[0].'">'.$row[1].'</option>';		
					}else{
						print '<option value="'.$row[0].'">'.$row[1].'</option>';	
					}
            } ?>
        </select> </td>
      </tr>
      <tr>
	 
	
        <td width="181">Nominal</td>
        <td width="212">&nbsp;</td>
        <td width="188">Funcional</td>
        <td width="508">&nbsp;</td>
      </tr>
      <tr>
        <td><span class="Estilo73">Puesto Nominal <font color="#FF0000"><strong>**</strong></font></span></td>
        <td><select name="puesto_nominal" class="TituloMedios Estilo73" id="select7" >
            <option value='0'> Ninguno </option>
            <? 
$sql = "select id_puesto_nominal, puesto_nominal from tb_puesto_nominal";
			$result = mssql_query($sql);
			while ($row = mssql_fetch_array($result))
			  { 
			  	
				if ($row_nom_fun['id_puesto_nominal']  ==$row[0])
					{
						print '<option selected value="'.$row[0].'">'.$row[1].'</option>';		
					}else{
						print '<option value="'.$row[0].'">'.$row[1].'</option>';	
					}
            } ?>
        </select></td>
        <td><span class="Estilo73">Puesto funcional <font color="#FF0000"><strong>**</strong></font></span></td>
        <td><select name="puesto_funcional" class="TituloMedios Estilo73" id="select8" >
            <option value='0'> Ninguno </option>
            <? 
$sql = "select id_puesto_funcional, puesto from tb_puesto_funcional";
			$result = mssql_query($sql);
			while ($row = mssql_fetch_array($result))
			  { 
			  if ($row_nom_fun['id_puesto_funcional'] ==$row[0])
					{
						print '<option selected value="'.$row[0].'">'.$row[1].'</option>';		
					}else{
						print '<option value="'.$row[0].'">'.$row[1].'</option>';	
					}
            } ?>
        </select></td>
      </tr>
      <tr>
        <td><span class="Estilo73">Unidad Ejecutora <font color="#FF0000"><strong>**</strong></font></span></td>
        <td><select name="unidad_ejecutora" class="TituloMedios Estilo73" id="select5" >
            <option value='0'> Ninguno </option>
            <? 
$sql = "select id_unidad_ejecutora, unidad_ejecutora from tb_unidad_ejecutora";
			$result = mssql_query($sql);
			while ($row = mssql_fetch_array($result))
			  { 
			  	
				
           
					if ($row_nom_fun['id_unidad_ejecutoraN'] == $row[0])
					{
						print '<option selected value="'.$row[0].'">'.$row[1].'</option>';		
					}else{
						print '<option value="'.$row[0].'">'.$row[1].'</option>';	
					}
					
             } ?>
        </select></td>
        <td><span class="Estilo73">Unidad Ejecutora <font color="#FF0000"><strong>**</strong></font></span></td>
        <td><select name="unidad_ejecutora" class="TituloMedios Estilo73" id="unidad_ejecutora_func" >
            <option value='0'> Ninguno </option>
            <? 
$sql = "select id_unidad_ejecutora, unidad_ejecutora from tb_unidad_ejecutora";
			$result = mssql_query($sql);
			while ($row = mssql_fetch_array($result))
			  { 
			  	
				
           
					if ($row_nom_fun['id_unidad_ejecutoraM'] ==$row[0])
					{
						print '<option selected value="'.$row[0].'">'.$row[1].'</option>';		
					}else{
						print '<option value="'.$row[0].'">'.$row[1].'</option>';	
					}
					
             } ?>
        </select></td>
      </tr>
      <tr>
        <td><span class="Estilo73">Viceministerio al que pertenece <font color="#FF0000"><strong>**</strong></font></span></td>
        <td><select name="vice_pertenece" class="TituloMedios Estilo73" id="select11" >
            <option value='0'> Ninguno </option>
            <? 
$sql = "select id_viceministerio, nombre from tbl_viceministerio";
			$result = mssql_query($sql);
			while ($row = mssql_fetch_array($result))
			  { 
			  	
				if ($row_nom_fun['id_viceministerioN']  == $row[0])
					{
						print '<option selected value="'.$row[0].'">'.$row[1].'</option>';		
					}else{
						print '<option value="'.$row[0].'">'.$row[1].'</option>';	
					}
             } ?>
        </select></td>
        <td><span class="Estilo73">Viceministerio al que pertenece <font color="#FF0000"><strong>**</strong></font></span></td>
        <td><select name="vice_pertenece" class="TituloMedios Estilo73" id="veceministerio_perteneciente_func" >
            <option value='0'> Ninguno </option>
            <? 
$sql = "select id_viceministerio, nombre from tbl_viceministerio";
			$result = mssql_query($sql);
			while ($row = mssql_fetch_array($result))
			  { 
			  	
				if ($row_nom_fun['id_viceministerioM']  ==$row[0])
					{
						print '<option selected value="'.$row[0].'">'.$row[1].'</option>';		
					}else{
						print '<option value="'.$row[0].'">'.$row[1].'</option>';	
					}
             } ?>
        </select></td>
      </tr>
      <tr>
        <td><span class="Estilo73">Dependencia en la que se encuentra <font color="#FF0000"><strong>**</strong></font></span></td>
        <td><select name="depen_encuentra" class="TituloMedios Estilo73" id="select10" >
            <option value='0'> Ninguno </option>
            <? 
$sql = "select id_sede, nombre from tb_sede";
			$result = mssql_query($sql);
			while ($row = mssql_fetch_array($result))
			  { 
			  	
				if ($row_nom_fun['id_depenN'] ==$row[0])
					{
						print '<option selected value="'.$row[0].'">'.$row[1].'</option>';		
					}else{
						print '<option value="'.$row[0].'">'.$row[1].'</option>';	
					}
            } ?>
        </select></td>
        <td><span class="Estilo73">Dependencia en la que se encuentra <font color="#FF0000"><strong>**</strong></font></span></td>
        <td><select name="depen_encuentra" class="TituloMedios Estilo73" id="dependencia_encuentra_func" >
            <option value='0'> Ninguno </option>
            <? 
$sql = "select id_sede, nombre from tb_sede";
			$result = mssql_query($sql);
			while ($row = mssql_fetch_array($result))
			  { 
			  	
				if ($row_nom_fun['id_depenM'] ==$row[0])
					{
						print '<option selected value="'.$row[0].'">'.$row[1].'</option>';		
					}else{
						print '<option value="'.$row[0].'">'.$row[1].'</option>';	
					}
            } ?>
        </select></td>
      </tr>
      <tr>
        <td><span class="Estilo73">Direccion a la que pertenece <font color="#FF0000"><strong>**</strong></font></span></td>
        <td><select name="dir_pertenece" class="TituloMedios Estilo73" id="select12" >
            <option value='0'> Ninguno </option>
            <? 
$sql = "select id_direccion_pertenece, direccion_nombre from tb_direccion_pertenece";
			$result = mssql_query($sql);
			while ($row = mssql_fetch_array($result))
			  { 
			  	
				if ($row_nom_fun['id_direccion_perteneceN']  ==$row[0])
					{
						print '<option selected value="'.$row[0].'">'.$row[1].'</option>';		
					}else{
						print '<option value="'.$row[0].'">'.$row[1].'</option>';	
					}
            } ?>
        </select></td>
        <td><span class="Estilo73">Direccion a la que pertenece <font color="#FF0000"><strong>**</strong></font></span></td>
        <td><select name="dir_pertenece" class="TituloMedios Estilo73" id="direcion_pertenece_func" >
            <option value='0'> Ninguno </option>
            <? 
$sql = "select id_direccion_pertenece, direccion_nombre from tb_direccion_pertenece";
			$result = mssql_query($sql);
			while ($row = mssql_fetch_array($result))
			  { 
			  	
				if ($row_nom_fun['id_direccion_perteneceM']  ==$row[0])
					{
						print '<option selected value="'.$row[0].'">'.$row[1].'</option>';		
					}else{
						print '<option value="'.$row[0].'">'.$row[1].'</option>';	
					}
            } ?>
        </select></td>
      </tr>
      <tr>
        <td><span class="Estilo73">Unidad a la que pertenece&nbsp;<font color="#FF0000"><strong>**</strong></font></span></td>
        <td><select name="dir_pertenece" class="TituloMedios Estilo73" id="unidad_pertenencia_nom" >
            <option value='0'> Ninguno </option>
            <? 
$sql = "select id_unidad, nombre_unidad from tb_unidad_asesor";
			$result = mssql_query($sql);
			while ($row = mssql_fetch_array($result))
			  { 
			  	
				if ($row_nom_fun['id_unidad_perteneceN']  ==$row[0])
					{
						print '<option selected value="'.$row[0].'">'.$row[1].'</option>';		
					}else{
						print '<option value="'.$row[0].'">'.$row[1].'</option>';	
					}
            } ?>
        </select></td>
        <td><span class="Estilo73">Unidad a la que pertenece&nbsp;<font color="#FF0000"><strong>**</strong></font></span></td>
        <td><select name="dir_pertenece" class="TituloMedios Estilo73" id="unidad_pertenencia_func" >
            <option value='0'> Ninguno </option>
            <? 
$sql = "select id_unidad, nombre_unidad from tb_unidad_asesor";
			$result = mssql_query($sql);
			while ($row = mssql_fetch_array($result))
			  { 
			  	
				if ($row_nom_fun['id_unidad_perteneceM']  ==$row[0])
					{
						print '<option selected value="'.$row[0].'">'.$row[1].'</option>';		
					}else{
						print '<option value="'.$row[0].'">'.$row[1].'</option>';	
					}
            } ?>
        </select></td>
      </tr>
      <tr>
        <td><span class="Estilo73">Ubicacion fisica &nbsp;<font color="#FF0000"><strong>**</strong></font></span></td>
        <td><select name="dir_pertenece" class="TituloMedios Estilo73" id="ubicacion_fisica_nom" >
            <option value='0'> Ninguno </option>
            <? 
$sql = "select id_ubicacion, nombre from tb_ubicacion_asesor";
			$result = mssql_query($sql);
			while ($row = mssql_fetch_array($result))
			  { 
			  	
				if ($row_nom_fun['id_ubicacion_fisicaN']  ==$row[0])
					{
						print '<option selected value="'.$row[0].'">'.$row[1].'</option>';		
					}else{
						print '<option value="'.$row[0].'">'.$row[1].'</option>';	
					}
            } ?>
        </select></td>
        <td><span class="Estilo73">Ubicacion fisica &nbsp;<font color="#FF0000"><strong>**</strong></font></span></td>
        <td><select name="dir_pertenece" class="TituloMedios Estilo73" id="ubicacion_fisica_func" >
            <option value='0'> Ninguno </option>
            <? 
$sql = "select id_ubicacion, nombre from tb_ubicacion_asesor";
			$result = mssql_query($sql);
			while ($row = mssql_fetch_array($result))
			  { 
			  	
				if ($row_nom_fun['id_ubicacion_fisicaM']  ==$row[0])
					{
						print '<option selected value="'.$row[0].'">'.$row[1].'</option>';		
					}else{
						print '<option value="'.$row[0].'">'.$row[1].'</option>';	
					}
            } ?>
        </select></td>
      </tr>
      <tr>
        <td><span class="Estilo73">Fecha ingreso <font color="#FF0000"><strong>**</strong></font></span></td>
        <td><span class="Estilo73">&nbsp;d&iacute;a
          <!--input name="dia3" type="text" class="Estilo1" id="dia3" maxlength="2"  size="2"-->
              <select name="dia1" class="Estilo1">
                <option></option>
                <?
	$i=1;
		
	 while ($i<=31)
	  {
	  if ($i == $dia5)
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
          <select name="mes1" class="Estilo1">
            <option></option>
            <?
	$i=1;
		
	 while ($i<=12)
	  {
			  if ($i == $mes5)
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
          <select name="ano1" class="Estilo1">
            <option></option>
            <?
	$i=1900;		
	 while ($i<=date('Y'))
	  {
		  if ($i == $fecha_ing)
		  {
			print ' <option selected value="'.$i.'" >'.$i.'</option>';
		  }else{
			print '<option value="'.$i.'">'.$i.'</option>';
		  }	  
	  $i++;
	  }
	 
	?>
          </select>
        </span></td>
        <td><span class="Estilo73">Estatus</span></td>
        <td><span class="Estilo6">
          <select name="empleado_activo" id="select9" disabled="disabled">
            <option selected="selected" value="1">Activo</option>
            <option value="2">Inactivo</option>
          </select>
        </span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><span class="Estilo73">Salario<font color="#FF0000"><strong>**</strong></font></span></td>
        <td colspan="3"><? 
		
		function get_bonos()
{
	
$consulta = mssql_query("select id_bonos,descripcion from tb_bonos order by id_bonos asc");																									
	if ($consulta)
		{

			while($row = mssql_fetch_row($consulta))	
			{
				$opciones = $opciones."<option value = ".$row[0]. ">".$row[1]."</option>";
			}
			
	}
	return $opciones;
}

		function get_bonos2($rr)
{
	
$consulta = mssql_query("select id_bonos,descripcion from tb_bonos order by id_bonos asc");																									
	if ($consulta)
		{

			while($row = mssql_fetch_row($consulta))	
			{
				if($row[0] == $rr)
				{
					$opciones = $opciones."<option selected value = ".$row[0]. ">".$row[1]."</option>";						
				}else{
					$opciones = $opciones."<option value = ".$row[0]. ">".$row[1]."</option>";
				}
			}
			
	}
	return $opciones;
}


		
		?>
          <table width="40%" border="0" cellspacing="0" id="tabla65">
            <tr>
              <th width="31" class="HelloUser" scope="col">(+)</th>
              <th width="179" class="HelloUser" scope="col">Tipo de Bonificacion</th>
              <th width="60" class="HelloUser" scope="col">Valor</th>
            </tr>
          </table>
		  <?
		  $p = get_bonos();

echo '<script>
var contLin65 = 1;
function agregar65() {
	var tr, td;

	tr = document.all.tabla65.insertRow();
	td = tr.insertCell();
	td.innerHTML = "Bono "+contLin65 +""		
	
	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"bono["+contLin65+"]\" id=\"select\">';
	echo $p;
	echo '</select>";		
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"cuentabono["+contLin65+"]\" type=\"hidden\" id=\"cuentabono\">";
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"valorbono["+contLin65+"]\" type=\"text\" id=\"valorbono\">";

	

	contLin65++;
}

function borrarUltima65() {
	ultima = document.all.tabla65.rows.length - 1;
	if (ultima !=0)
	{
	 document.all.tabla65.deleteRow(ultima);	
	 contLin65--;
	}
}

function agregar655(t1, t2) {
	var tr, td;

	tr = document.all.tabla65.insertRow();
	td = tr.insertCell();
	td.innerHTML = "Bono "+contLin65 +""		
	
	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"bono["+contLin65+"]\" id=\"select\">"+t1+"</select>";		
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"cuentabono["+contLin65+"]\" type=\"hidden\" id=\"cuentabono\">";
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"valorbono["+contLin65+"]\" type=\"text\" id=\"valorbono\" value=\""+t2+"\" size=\"30\">";

	

	contLin65++;
}



</script>';

 $query1 = "select codigo_bono , valor from tb_bono  where idasesor = '$codpersona'";

$query = mssql_query($query1);


while($vec = mssql_fetch_row($query))
{	

	$descrip = trim(get_bonos2($vec[0]));
	$valor = $vec[1];


	echo "<script>";	
	print "agregar655(";
	print "'$descrip'"; 
	print ',';
	print "'$valor'";
	print ',';
	print "'$anio4'";
	
	print ")";	
	echo "</script>";				
}


?>
        <p>
          <input name="button4" type="button" class="ProgressWriting" onclick="agregar65()" value="Agregar Bono" />
          <input name="button4" type="button" class="ProgressWriting" onclick="borrarUltima65()" value="Borrar Bono" />
</p></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="4"><div align="center">Historial Laboral </div></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><span class="Estilo73">Historial Laboral <font color="#FF0000"><strong>**</strong></font></span></td>
        <td colspan="3"><table width="73%" border="0" cellspacing="0" id="tabla40">
          <tr>
            <th width="31" class="HelloUser" scope="col">#</th>
            <th width="50" class="HelloUser" scope="col">Entidad</th>
            <th width="35" class="HelloUser" scope="col">Puesto</th>
            <th width="30" class="HelloUser" scope="col">Observaci&oacute;nes</th>
          </tr>
        </table>
          <?
echo '<script>
var contLin40 = 1;
function agregar40() {
	var tr, td;

	tr = document.all.tabla40.insertRow();
	td = tr.insertCell();
	td.innerHTML = contLin40 +"";
		
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"empresae["+contLin40+"]\" type=\"text\" id=\"textfield\" size=\"20\">";	
		
	
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"puestoemp["+contLin40+"]\" type=\"text\" id=\"textfield\" size=\"20\">";
	
	
		

	td = tr.insertCell();
	td.innerHTML = 	"<textarea name=\"atribucionesemp["+contLin40+"]\" cols=\"20\" rows=\"6\">";

	td = tr.insertCell();

	contLin40++;
}

function borrarUltima40() {
	ultima = document.all.tabla40.rows.length - 1;
	if (ultima !=0)
	{
	 document.all.tabla40.deleteRow(ultima);
	 contLin40--;
	}
}


function agregar4300(r1,r2,r3) {
	var tr, td;

	tr = document.all.tabla40.insertRow();
	td = tr.insertCell();
	td.innerHTML = contLin40 +"";
		
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"empresae["+contLin40+"]\" type=\"text\" id=\"textfield\" value=\""+r1+"\" size=\"30\">";	
		
	
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"puestoemp["+contLin40+"]\" type=\"text\" id=\"textfield\"value=\""+r2+"\" size=\"30\">";
	
	
		

	td = tr.insertCell();
	td.innerHTML = 	"<textarea name=\"atribucionesemp["+contLin40+"]\" cols=\"20\" rows=\"6\" placeholder=\""+r3+"\"> "+r3+ "</textarea>";

	td = tr.insertCell();

	contLin40++;
}

</script>';


 $query = mssql_query("select entidad, puesto,atribuciones from tb_experiencia_laboral where idasesor    = '$codpersona'");

while($vetas = mssql_fetch_row($query))
{	


	$entidad = $vetas[0];
	$puesto = $vetas[1];
	$atribuciones = $vetas[2];

	
	
	echo "<script>";	
	print "agregar4300(";
	print "'$entidad'"; 
	print ',';
	print "'$puesto'";
	print ',';
	print "'$atribuciones'";
	
	print ")";	
	echo "</script>";			
}

?>
          <br />
          <input name="button5" type="button" class="ProgressWriting" onclick="agregar40()" value="Agregar ITEM" />
          <input name="button5" type="button" class="ProgressWriting" onclick="borrarUltima40()" value="Borrar ITEM" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
  </div>
  
  <div id="view4">
    <table width="1117" border="0">
      <tr>
        <td width="91">&nbsp;</td>
        <td width="834">&nbsp;</td>
        <td width="81">&nbsp;</td>
        <td width="83">&nbsp;</td>
      </tr>
      <tr>
        <td><span class="Estilo73">Complementos<font color="#FF0000"><strong>**</strong></font></span></td>
        <td colspan="3"><table width="40%" border="0" cellspacing="0" id="tabla51">
          <tr>
            <th width="31" class="HelloUser" scope="col"></th>
            <th width="179" class="HelloUser" scope="col"></th>
            <th width="60" class="HelloUser" scope="col"></th>
          </tr>
          <tr>
            <th width="31" class="HelloUser" scope="col">#</th>
            <th width="179" class="HelloUser" scope="col">Requisito</th>
            <th width="60" class="HelloUser" scope="col">Archivo</th>
          </tr>
        </table>
          <?

function get_requisitos()
{
	
$consulta = mssql_query("select codigo_requisito,requisito,unico from tb_requisito order by requisito asc");																									
	if ($consulta)
		{

			while($row = mssql_fetch_row($consulta))	
			{
				$opciones = $opciones."<option value = ".$row[0]. ">".$row[1]."</option>";
			}
			
	}
	return $opciones;
}

$p = get_requisitos();



function get_requisitos2($var)
{
	
$consulta = mssql_query("select codigo_requisito,requisito,unico from tb_requisito order by requisito asc");																									
	if ($consulta)
		{

			while($row = mssql_fetch_row($consulta))	
			{
				if($row[0] == $var)
				{
					$opciones = $opciones."<option selected value = ".$row[0]. ">".$row[1]."</option>";						
				}else{
					$opciones = $opciones."<option value = ".$row[0]. ">".$row[1]."</option>";
				}
			}
			
	}
	return $opciones;
}



 $query993 = "select gafete, codigo_requisito, archivo from tb_requisitos as  tr inner join asesor as un on tr.idasesor = un.idasesor  where un.idasesor  = '$codpersona'";

$query = mssql_query($query993);


while($vec = mssql_fetch_row($query))
{	
	$name4 = $vec[0];
		
}




echo '<script>
var contLin51 = 1;
function agregar51() {
	var tr, td;

	tr = document.all.tabla51.insertRow();
	td = tr.insertCell();
	td.innerHTML = "R"+contLin51 +""		
	
	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"requisito["+contLin51+"]\" id=\"select\">';
	echo $p;
	echo '</select>";		
	


	

	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"fichero"+contLin51+"\" type=\"file\" id=\"fichero\">";


	contLin51++;
}

function borrarUltima51() {
	ultima = document.all.tabla51.rows.length - 1;
	if (ultima !=0)
	{
	 document.all.tabla51.deleteRow(ultima);	
	 contLin51--;
	}
}



function agregar5190(q1,q2,q3) {
	var tr, td;
	

	tr = document.all.tabla51.insertRow();
	td = tr.insertCell();
	td.innerHTML = "R"+contLin51 +""		
	
	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"requisito["+contLin51+"]\" id=\"select\">"+q1+"</select>";	
	
	td = tr.insertCell();
	td.innerHTML = 	"<a href=\" fotos/"+q3+"/anexo/"+q2+" \"  target=\"_blank\"> Ver Adjunto </a>";


	contLin51++;
}

</script>';



 $query1 = "select gafete, codigo_requisito, archivo from tb_requisitos as  tr inner join asesor as un on tr.idasesor = un.idasesor  where un.idasesor  = '$codpersona'";

$query = mssql_query($query1);


while($vec = mssql_fetch_row($query))
{	
	$name4 = $vec[0];
	$cdreq = trim(get_requisitos2($vec[1]));
	 $archi = $vec[2];

	echo "<script>";	
	print "agregar5190(";
	print "'$cdreq'"; 
	print ',';
	print "'$archi'";
	print ',';

	print "'$name4'";
	
	print ")";	
	echo "</script>";				
}




?>
          <br />
          <input name="button6" type="button" class="ProgressWriting" onclick="agregar51()" value="Agregar Requisito" />
          <input name="button6" type="button" class="ProgressWriting" onclick="borrarUltima51()" value="Borrar Requisito" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
  </div>
  
  
<input name="modificar" id="modificar1" type="radio" value="1" onclick="cargar();"/>
SI<span class="Estilo22">
<input name="modificar" id="modificar2" type="radio" value="2" onclick="cargar();" />
NO </span>
<input name="actualizar" type="submit"  class="TuringHelp" id="actualizar" onclick="Validar(this.form)" value="ACTUALIZAR DATOS" disabled="disabled">
<br />
<a href="ficha.php?num_gafete=<?php print $num_gafete; ?>" target="_blank"></a>
</form> 



</body>
<!--<script type="text/javascript"> 
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
</script> -->
</html>
