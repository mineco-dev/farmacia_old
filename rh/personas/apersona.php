<?
//session_start();
$nombre_usuario=$_SESSION["user_name"];
include('conectarse.php');
include('../includes/inc_header_sistema.inc');


if ($inserta == 1)
 {
 

	include('../includes/inc_header_sistema.inc');
	function valida_empleado($reg,$num)		
	{
		$ret = 0;
		$query = "select 
					count(*) cnt
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
	
$opnacionalidad = 1;

		
		
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
		move_uploaded_file($HTTP_POST_FILES['userfile']['tmp_name'], $nombre_carpeta."/".trim($nombre_archivo));
		 
	 		 
		 	
		
		//compruebo si las caracter�sticas del archivo son las que deseo 
		
		
/*
		if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "jpg") || strpos($tipo_archivo, "pdf")) && ($tamano_archivo <= 500000 ))) 
		{ 
			echo "La extensión o el tama�o de los archivos no es correcta. <br><br><table><tr><td><li>Se permiten archivos .gif o .jpg<br><li>se permiten archivos de 500 Kb m�ximo.</td></tr></table>"; 
		}
		else
		{
	
	move_uploaded_file($HTTP_POST_FILES['userfile']['tmp_name'], $nombre_carpeta."/".trim($nombre_archivo));


		} 
	

		
 
	/**********************************************/
	
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
		   if(move_uploaded_file($HTTP_POST_FILES[$archi]['tmp_name'], $carpeta."/".$nombre_archivo_def))
		   {}else{'Error el fichero no fue copiado correctamente';}			
	     }

	$files[$cnt]=$nombre_archivo_def;	
$cnt++;
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
				
		if ($fichero_name!="")
		{
 		   $tipo_archivo = $HTTP_POST_FILES[$archi]['type']; 
		   $extension = split('[.]',$fichero_name);
		   $extension = $extension[sizeof($extension)-1];		
		   $tamano_archivo = $HTTP_POST_FILES[$archi]['size']; 		
		   		   		   
		   $nombre_archivo_def=$codigo_archivo.".".$extension;			   
		   if(move_uploaded_file($HTTP_POST_FILES[$archi]['tmp_name'], $carpeta_bonos."/".$nombre_archivo_def))
		   {}else{'Error el fichero no fue copiado correctamente';}			
	     }

	$filesbono[$cnt]=$nombre_archivo_def;	
$cnt++;
}

	$flag = 0;
	$flag1 = 0;
	
	
if (valida_empleado($registro,$cedula) > 0) $flag=1;
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

	$fecha_naci =  "$ano-$mes-$dia";  
	if ($opnacionalidad == 1) // nacional
	{
		$idnacionalidad = 1;

		$sqpersona = "insert into asesor(nombre,nombre2,nombre3,apellido,apellido2, 
		apellidocasada, sexo, cedula,  nit, activo, estadocivil,fecha_nacimiento,gafete, nacionalidad,userfilefoto
		,idgrupoetnico,tipolicencia,licencia,iddepartamento_nac1,idmunicipio_nac1,iddepartamento_dpi,idmunicipio_pdi,id_linguistica,direccion_persona,zona_persona,colonia_residencia)
		 
		values ('$nombre',  '$nombre2', '$nombre3', '$apellidos', '$apellido2', '$apellidocasada', '$sexo', '$cedula', '$nit', '1','$estado_civil',
		'$fecha_naci','$num_gafete','$idnacionalidad','$nombre_archivo','$idgrupoetnico','$tipo_licencia','$num_licencia',
		'$lnac','$mnac','$dpiext','$munidpi','$lingui','$dirasesor','$zonap','$dirasesor2')";
	

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
		$sql = "select max(idasesor) from asesor";
		$result = mssql_query($sql);
		$row = mssql_fetch_array($result);
		$codpersona =  $row[0];
		//envia_msg($codpersona);
		//print $codpersona;
		
	
/**********************   ***********************************************************************/	
                $escolaridad5 = " insert into dbo.id_escolaridad_as (id_asesor,escribre,lee,habla,escoladidad)
  values ('$codpersona','$escribre','$lee','$habla','$escolaridad1')";
     $result2 = mssql_query($escolaridad5);
	 
	 
  
               $fecha_ingresoper =  "$ano1-$mes1-$dia1";
				$sqpersona2 = "  insert into tb_datos_laborales (
             id_asesor,
             id_partida_presupuestaria,
             id_reglon_presupuestario,
             id_puesto_nominal,
             id_unidad_ejecutoraN,
             id_viceministerioN,
             id_depenN,
             id_direccion_perteneceN,
             id_unidad_perteneceN, 
             id_ubicacion_fisicaN,
             activo,
             id_puesto_funcional,
             id_unidad_ejecutoraM,
             id_viceministerioM,
             id_depenM,
             id_direccion_perteneceM,
             id_unidad_perteneceM,
             id_ubicacion_fisicaM,
             fecha_ingreso)
             values ('$codpersona','$partida_presupues','$reglon_presupuestario','$puestoOficial_nonimal','$UnidadEjecutora_nominal',
                     '$viceministerioNominal','$dep_pertence_nominal','$Dir_nominal','$unidad_nonimal','$Ubicacion_nominal',1,
                     '$puesto_funcional','$unidad_ejecutora_funcional','$viceministerio_funcional','$depen_funcional','$dir_funcional',
                     '$unidad_funcional','$ubicacion_funcional','$fecha_ingresoper ')";
               $result2 = mssql_query($sqpersona2);

		$cnt = 1;
		while ($cnt <= count($requisito))
		{	
					
			//$fichero = 'fichero';
			$codigo_requisito = $requisito[$cnt];
			$archi = $files[$cnt];
			//$fecha2 = $anior[$cnt].'-'.$meser[$cnt].'-'.$diar[$cnt];
			
			
				$qry_insertar_requisitos ="insert into tb_requisitos";
			$qry_insertar_requisitos.=" (codigo_requisito,archivo,idasesor) ";
				$qry_insertar_requisitos.=" values ('$codigo_requisito','$archi','$codpersona')";
				//$qry_insertar_requisitos.="(codigo_requisito,fecha2,archivo,idasesor)";
				//$qry_insertar_requisitos.="values ($codigo_requisito,'$fecha2','$archi',$codpersona)";
	
				$result = mssql_query($qry_insertar_requisitos);
				
			
		
		$cnt++;
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
		while ($cnt <= count($bono))
		{
			$valor = $valorbono[$cnt];
			$fichero = 'ficherobono';
			$codigo_bono = $bono[$cnt];
			//$archi = $filesbono[$cnt];
			//$fecha2 = $aniobono[$cnt].'-'.$mesbono[$cnt].'-'.$diabono[$cnt];
			
			if (!empty($codigo_bono))
			{
				$qry_insertar_bono ="insert into tb_bono";
				$qry_insertar_bono.="(codigo_bono,idasesor,valor)";
         		//$qry_insertar_bono.="values ($codigo_bono,'$fecha2','$archi',$codpersona,$valor)";
				$qry_insertar_bono.="values ($codigo_bono,$codpersona,$valor)";
	
				$result = mssql_query($qry_insertar_bono);
				//print $qry_insertar_bono;
				
			}
		
		$cnt++;
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
		while ($cnt <= count($discapacidad5))
		{
			$qry_insertar_discapacidad ="insert into dbo.tb_discapacidad_persona";
			$qry_insertar_discapacidad.="(id_asesor,id_discapacidad,cuenta,especifica) ";
			$qry_insertar_discapacidad.="values ('$codpersona','$discapacidad5[$cnt]','$discapacidad','$especifica50[$cnt]')";
			$result = mssql_query($qry_insertar_discapacidad);
			$cnt ++;
		}
		
		
		$cnt = 1;
		while ($cnt <= count($codigo_cole))
		{
		        $nombre_coles = $nombre_cole[$cnt];
		        $fecha_vence[$cnt] = $aniovence[$cnt].'-'.$mesvence[$cnt].'-'.$diavence[$cnt];
			$qry_insertar_cole ="insert into tb_colegiado ";		
		$qry_insertar_cole.="(id_asesor, codigo, nombre_cole, fecha_vence) ";
		 	$qry_insertar_cole.="values('$codpersona','$codigo_cole[$cnt]','$nombre_coles','$fecha_vence[$cnt]')";
			$result = mssql_query($qry_insertar_cole);
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
			$qry_insertar_curso.="(curso,idasesor,fecha,lugar,institucion) ";
			$qry_insertar_curso.="values ('$curso_cap[$cnt]', '$codpersona','$fecha_cap[$cnt]','$lugar_cap[$cnt]','$institucion[$cnt]')";
			$result = mssql_query($qry_insertar_curso);
			$cnt ++;
		}
		$cnt = 1;
		while ($cnt <= count($empresaexp))
		{
		//envia_msg($oficialcg[$cng]);
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
		     
			//$fecha_ingreso_emp[$cnt] = $anioempi[$cnt].'-'.$mesempi[$cnt].'-'.$diaempi[$cnt];
			//$fecha_egreso_emp[$cnt] = $anioempf[$cnt].'-'.$mesempf[$cnt].'-'.$diaempf[$cnt];
			
			$qry_insertar_explaboral ="insert into tb_experiencia_laboral";
			$qry_insertar_explaboral.="(entidad,idasesor,puesto,atribuciones) ";
			$qry_insertar_explaboral.="values ('$empresae[$cnt]', '$codpersona','$puestoemp[$cnt]','$atribucionesemp[$cnt]')";	
			$result = mssql_query($qry_insertar_explaboral);
			$cnt ++;
		}
		
		$cnt = 1;
		while ($cnt <= count($titulo))
		{
			$fecha_estudio[$cnt] = $anioaca[$cnt].'-'.$mesaca[$cnt].'-'.$diaaca[$cnt];
			$qry_insertar_academicos ="insert into estudios_realizados";
			$qry_insertar_academicos.="(titulo,idasesor,nivel_academico,fecha,centro_estudios,id_estadoEstudio) ";
			$qry_insertar_academicos.="values ('$titulo[$cnt]', '$codpersona','$nivel[$cnt]','$fecha_estudio[$cnt]','$centroaca[$cnt]','$estadoEstudio[$cnt]')";			
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
		
		
		
		
		
		
		//cambiar_ventana("oculto.php?valor=$valor");
		session_write_close();
		

		echo '<p class="HolloUserRow">Los datos del gafete '.$num_gafete.' fueron Guardados Exitosamente  </p>' ;
	}else
	{
		cambiar_ventana("ocultoerr.php");
	}	

}



/*
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
*/
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
	$renglon = $renglon."<option value=189>18</option>";	
	
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


</script>

<script language="JavaScript" src="calendar_db.js"></script>
<link rel="stylesheet" href="calendar.css">

<!--<link href="../css/cssWeb.css" type=text/css rel=StyleSheet>-->
<link href="template1/mctabs.css" rel="stylesheet" type="text/css" /> <!--se agrego toda la linea>
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
.Estilo70 {color: #0033FF; font-size: 14px; }
.Estilo71 {font-size: 14px}
.Estilo72 {font-family: Arial, Helvetica, sans-serif; font-size: 14px; }
.Estilo73 {font-size: 12px}
.Estilo74 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo75 {color: #000000}
</style>
<script language="JavaScript">
function imprimir()
{
//	alert(window.document.form1.opnacionalidad[0].value);
//	alert(window.document.form1.opnacionalidad[1].value);


    /*Nacionalidad*/
	if (window.document.form1.escolaridad1[1].checked)
	{
	   document.getElementById("div_estudio").style.display = "none";
	   document.getElementById("div_noestudio").style.display = "inline";
	}else
	{
	   document.getElementById("div_estudio").style.display = "inline";
	   document.getElementById("div_noestudio").style.display = "none";
	}
	
	if (window.document.form1.discapacidad[1].checked)
	{
	   document.getElementById("div_sidiscapacidad").style.display = "none";
	   document.getElementById("div_nodiscapacidad").style.display = "inline";
	}else
	{
	   document.getElementById("div_sidiscapacidad").style.display = "inline";
	   document.getElementById("div_nodiscapacidad").style.display = "none";
	}
	
	
	if (window.document.form1.reglon_presupuestario[1].selected || window.document.form1.reglon_presupuestario[2].selected)
	{
	   document.getElementById("div_011").style.display = "inline";
	   document.getElementById("div_029").style.display = "none";
	}
	else
	{
	   document.getElementById("div_011").style.display = "none";
	   document.getElementById("div_029").style.display = "inline";
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

/*
	 textoCampo = window.document.form1.zona.value 
	 textoCampo = validarEntero(textoCampo) 
	 window.document.form1.zona.value = textoCampo 

	 textoCampo = window.document.form1.codigo_postal.value 
	 textoCampo = validarEntero(textoCampo) 
	 window.document.form1.codigo_postal.value = textoCampo 
*/
	  if (form.nombre.value == "")
	  { alert("Por favor ingrese su Primer Nombre"); form.nombre.focus(); return; }
	  
	  if (form.apellidos.value == "")
	  { alert("Por favor ingrese su Primer Apellido"); form.apellidos.focus(); return; }
	  


 if (form.num_gafete.value == "")
	  { alert("Por favor ingrese numero de DPI"); form.num_gafete.focus(); return; }

if (form.estado_civil.value == 0)
		{ alert("Por favor seleccione su Estado Civil"); form.estado_civil.focus(); return; }


	  if ((!form.sexo[0].checked) && (!form.sexo[1].checked))
		{ alert("Por favor ingrese el genero"); form.sexo[0].focus(); return; }
	  
	
	  
	  if (form.cedula.value == "")
	  { alert("Por favor seleccione el Municipio"); form.cedula.focus(); return; }

	  /*if ((form.numero_pasaporte.value == "") && (form.opnacionalidad[1].checked))
	  { alert("Por favor ingrese No. de Pasaporte"); return; }
	

	/*  if ((form.idgrupo.value == "") && (form.opnacionalidad[0].checked))
	  { alert("Por favor confirme Municio"); form.idgrupo.focus(); return; }*/
	
	/*	if (form.calle.value == "")
		  { alert("Por favor ingrese la calle");  return; }

		if (form.numero.value == "")
		  { alert("Por favor ingrese el numero de la casa"); return; }
		
		if (form.zona.value == "")
		  { alert("Por favor ingrese la zona"); return; }
		
		if (form.tema.value == "")
		  { alert("Por favor seleccione el departamento de residencia"); return; }
		  
		  if ((form.dia.value == "") || (form.mes.value == "") ||(form.ano.value == ""))
	  { alert("Por favor ingrese fecha de cumplea�os"); form.dia.focus(); form.mes.focus(); form.ano.focus(); return; }*/
	  

  
function valor(objeto)
{
	try {

		if ((objeto.value) == 1)
			return true;
		else
			return false;
	} catch(e) 
	{
		return false;
	}
}

function valorcoma(objeto)
{

if (objeto.value == 1)
{
	var num = objeto.value;
	var cuenta = 0;
	num += "";
	

	for (i = 0; i < num.length; i++) {

			if (num.charat(i) == ",")
			{
				cuenta++;	
			}
			
			
	}
	
	if (cuenta>0)
			{
				return true
			}else{
				return false
	}
}

}



function isnum( numstr ) {
// return immediately if an invalid value was passed in


if (numstr+"" == "undefined" || numstr+"" == "null" || numstr+"" == "") 
return false;

var isvalid = true;
var deccount = 0; // number of decimal points in the string

// convert to a string for performing string comparisons.


numstr += ""; 

// loop through string and test each character. if any
// character is not a number, return a false result.
// include special cases for negative numbers (first char == '-')
// and a single decimal point (any one char in string == '.'). 
for (i = 0; i < numstr.length; i++) {
// track number of decimal points
if (numstr.charat(i) == ".")
deccount++;

if (!((numstr.charat(i) >= "0") && (numstr.charat(i) <= "9") || 
(numstr.charat(i) == "."))) {
isvalid = false;
break;
} else if ((numstr.charat(i) == "." && numstr.length == 1) ||
(numstr.charat(i) == "." && deccount > 1)) {
isvalid = false;
break;
} 
//if (!((numstr.charat(i) >= "0") && (numstr.charat(i) <= "9")) || 
} // end for 

return isvalid;
} // end isnum


//ban = 0; for (i=1;i<100;i++) { if (valor(form['oficialcg['+i+']'])) ban = 1; } if (ban == 0) {alert('Debe seleccionar por lo menos una Contratacion Vigente'); return};
//ban2 = 0; for (j=1;j<100;j++) {if valor(form(['partida['+j+']'])) ban2 = 1; } if (ban2 == 0) {alert('Debe poner una partida presupuestaria o colocar No tiene'); return};* 

/*
ban = 0; for (i=1;i<100;i++) { if (valorcoma(form['valorbono['+i+']'])) ban = 1; } if (ban == 0) {alert('No ingrese comas1'); return};
*/




if (confirm('Esta acción graba y finaliza el ingreso de datos, desea finalizar?')){ 
    //  document.form.submit() 
		form.submit();
  	} 
}
</script>
</head>

<body>
<table width="824" border="0" align="center"cellspacing="0">
  <tr bgcolor="#0066CC">
    <td colspan="7" bgcolor="#FFFFFF"><div align="center"><span class="Estilo1 Estilo2 style1"><span class="Estilo70">Ingreso de Personas MINECO </span></span><span class="Estilo71">&nbsp;</span><span class="Estilo72"><font color="#6699FF" face="Arial, Helvetica, sans-serif">&nbsp;&nbsp;Fecha</font> <font face="Arial, Helvetica, sans-serif"> <? echo'<font color="#003399"><strong>'.date("d")."/".date("m")."/".date("Y").'</strong></font>'; ?> <? echo'<font color="#003399"><strong>'.$hora.'</strong></font>'; ?> </font></span><span class="Estilo70"><img src="../../images/rrhh123.png" width="216" height="95" /></span></div></td>
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
      <? //}?></tr></td>
  </tr>
</table>
<form action="apersona.php?inserta=1" method="post" enctype="multipart/form-data" name="form1" id="form1">
   <div id="TabbedPanels1" class="TabbedPanels">
  <!--<div class="container1">-->
      <ul id="tabs1" class="mctabs">
        <li><a href="#view1">Datos Personales</a></li>
        <li><a href="#view2">Datos Academicos</a></li>
        <li><a href="#view3">Datos Laborales</a></li>
	    <li><a href="#view4">Datos relacionados</a></li>
      </ul>
	  
  <!-- <div id="TabbedPanels1" class="TabbedPanels">
    <ul class="TabbedPanelsTabGroup">
      <li class="TabbedPanelsTab" tabindex="0">Datos Personales</li>
      <li class="TabbedPanelsTab" tabindex="0">Datos Familiares</li>
      <li class="TabbedPanelsTab" tabindex="0">Datos Academicos</li>
      <li class="TabbedPanelsTab" tabindex="0">Experiencia Laboral</li>
      <li class="TabbedPanelsTab" tabindex="0">Historial Medico</li>
	  <li class="TabbedPanelsTab" tabindex="0">Requisitos</li>
  	  <li class="TabbedPanelsTab" tabindex="0">Observaciones</li>
 	  <li class="TabbedPanelsTab" tabindex="0">Salarios</li>
	  <li class="TabbedPanelsTab" tabindex="0">Reportes</li>
    </ul> --->
	
	
	<!-- datos Relacionados -->	
	
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
    <td colspan="3"><? include("trequisitos.php");?></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

	  
	  </div>
	<!-- datos Relacionados -->
	 <!-- datos laborales -->
		 <div id="view3">
		<table width="1117" border="0">
  <tr>
    <td width="181">&nbsp;</td>
    <td width="212">&nbsp;</td>
    <td width="188">&nbsp;</td>
    <td width="508">&nbsp;</td>
  </tr>
  <tr>
    <td><span class="Estilo73">Reglon Presupuestario <font color="#FF0000"><strong>**</strong></font></span></td>
    <td><select name="reglon_presupuestario" class="TituloMedios Estilo73" id="select"  onchange="imprimir();">
      <option value='1'> Ninguno </option>
      <? 
$sql = "select id_reglon_presupuestario, reglon from tb_reglon_presupuestario";
			$result = mssql_query($sql);
			while ($row = mssql_fetch_array($result))
			  { 
			  	
				?>
      <option value="<? echo $row['0']; ?>"><? echo $row['1']; ?></option>
      <? } ?>
    </select></td>
    <td class="Estilo73"><span class="Estilo75">Partida presupuestaria</span><font color="#FF0000"><strong> <font color="#FF0000"><strong>**</strong></font></strong></font></td>
    <td><select name="partida_presupues" class="TituloMedios Estilo73" id="select12" >
        <option value='0'> Ninguno </option>
        <? 
$sql = "select id_partida_presupuestaria, nombre_partida from tb_partida";
			$result = mssql_query($sql);
			while ($row = mssql_fetch_array($result))
			  { 
			  	
				?>
        <option value="<? echo $row['0']; ?>"><? echo $row['1']; ?></option>
        <? } ?>
      </select></td>
  </tr>
  <tr>
    <td colspan="2">
</p>
<p>
  
  
    
        
   	</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  
  </table>
  <span id="div_029" style="display:none">
<table width="1117" border="0">
  <tr>
    <td colspan="2"><div align="center"></div></td>
    <td colspan="2"><div align="center"></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><span class="Estilo73">Tipo de Servicio <font color="#FF0000"><strong>**</strong></font></span></td>
    <td><span class="Estilo74">
      <input name="puesto_funcional" type="text" class="Estilo7" id="dirasesor2" size="40" onkeyup="javascript:this.value=this.value.toUpperCase();" />
    </span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><span class="Estilo73">Unidad Ejecutora <font color="#FF0000"><strong>**</strong></font></span></td>
    <td><select name="unidad_ejecutora_funcional" class="TituloMedios Estilo73" id="select22" >
      <option value='0'> Ninguno </option>
      <? 
$sql = "select id_unidad_ejecutora, unidad_ejecutora from tb_unidad_ejecutora";
			$result = mssql_query($sql);
			while ($row = mssql_fetch_array($result))
			  { 
			  	
				?>
      <option value="<? echo $row['0']; ?>"><? echo $row['1']; ?></option>
      <? } ?>
    </select></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><span class="Estilo73">Viceministerio al que pertenece <font color="#FF0000"><strong>**</strong></font></span></td>
    <td><select name="viceministerio_funcional" class="TituloMedios Estilo73" id="select23" >
      <option value='0'> Ninguno </option>
      <? 
$sql = "select id_viceministerio, nombre from tbl_viceministerio";
			$result = mssql_query($sql);
			while ($row = mssql_fetch_array($result))
			  { 
			  	
				?>
      <option value="<? echo $row['0']; ?>"><? echo $row['1']; ?></option>
      <? } ?>
    </select></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><span class="Estilo73">Dependencia en la que se encuentra <font color="#FF0000"><strong>**</strong></font></span></td>
    <td><select name="depen_funcional" class="TituloMedios Estilo73" id="select24" >
      <option value='0'> Ninguno </option>
      <? 
$sql = "select id_sede, nombre from tb_sede";
			$result = mssql_query($sql);
			while ($row = mssql_fetch_array($result))
			  { 
			  	
				?>
      <option value="<? echo $row['0']; ?>"><? echo $row['1']; ?></option>
      <? } ?>
    </select></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><span class="Estilo73">Direccion a la que pertenece <font color="#FF0000"><strong>**</strong></font></span></td>
    <td><select name="dir_funcional" class="TituloMedios Estilo73" id="select25" >
      <option value='0'> Ninguno </option>
      <? 
$sql = "select id_direccion_pertenece, direccion_nombre from tb_direccion_pertenece";
			$result = mssql_query($sql);
			while ($row = mssql_fetch_array($result))
			  { 
			  	
				?>
      <option value="<? echo $row['0']; ?>"><? echo $row['1']; ?></option>
      <? } ?>
    </select></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><span class="Estilo74"><!--
	  query que se utilizo
	  $sql = "select id_unidad, nombre_unidad from dbo.tb_unidad_asesor where activo =1"; --->
    </span></td>
    <td><span class="Estilo73">Unidad a la que pertenece <font color="#FF0000"><strong>**</strong></font></span></td>
    <td><span class="Estilo74">
      <input name="unidad_funcional" type="text" class="Estilo7" id="unidad_nonimal" size="40" onkeyup="javascript:this.value=this.value.toUpperCase();" />
      <!--
	  query que se uso
	  $sql = "select id_unidad, nombre_unidad from dbo.tb_unidad_asesor where activo =1"; -->
    </span></td>
  </tr>
  <tr>
    <td><span class="Estilo73">
      <!-- Ubicacion Fisica  -->
      <font color="#FF0000"><strong>
        <!--** -->
      </strong></font></span></td>
    <td><!--
	<select name="Ubicacion_nominal" class="TituloMedios Estilo73" id="select19" >
        <option value='0'> Ninguno </option>
        <? $Ubicacion_nominal=0;
  //$sql = "SELECT id_ubicacion, nombre FROM   dbo.tb_ubicacion_asesor where activo =1";
	//		$result = mssql_query($sql);
		//	while ($row = mssql_fetch_array($result))
			//  { 
			  	
				?>
        <option value="<? //echo $row['0']; ?>"><? //echo $row['1']; ?></option>
        <? //} ?>
    </select> --></td>
    <td><span class="Estilo73">Ubicacion Fisica <font color="#FF0000"><strong>**</strong></font></span></td>
    <td><select name="ubicacion_funcional" class="TituloMedios Estilo73" id="select27" >
      <option value='0'> Ninguno </option>
      <? 
$sql = "SELECT id_ubicacion, nombre FROM   dbo.tb_ubicacion_asesor where activo =1";
			$result = mssql_query($sql);
			while ($row = mssql_fetch_array($result))
			  { 
			  	
				?>
      <option value="<? echo $row['0']; ?>"><? echo $row['1']; ?></option>
      <? } ?>
    </select></td>
  </tr>
</table>
</span>

  <span id="div_011" style="display:inline">
  <table width="1117" border="0">
  <tr>
  
    <td colspan="2"><div align="center">Nominal</div></td>
    <td colspan="2"><div align="center">Funcional</div></td>
  </tr>
  <tr>
    <td><span class="Estilo73">Puesto Oficial <font color="#FF0000"><strong>**</strong></font></span></td>
    <td><select name="puestoOficial_nonimal" class="TituloMedios Estilo73" id="select14" onclick="imprimir();" checked="checked" >
        <option value='0'> Ninguno </option>
        <? 
$sql = "select id_puesto_nominal, puesto_nominal from tb_puesto_nominal";
			$result = mssql_query($sql);
			while ($row = mssql_fetch_array($result))
			  { 
			  	
				?>
        <option value="<? echo $row['0']; ?>"><? echo $row['1']; ?></option>
        <? } ?>
    </select></td>
    <td><span class="Estilo73">Puesto<font color="#FF0000"><strong>**</strong></font></span></td>
    <td><span class="Estilo74">
      <input name="puesto_funcional" type="text" class="Estilo7" id="dirasesor2" size="40" onkeyup="javascript:this.value=this.value.toUpperCase();" />
    </span></td>
  </tr>
  <tr>
    <td><span class="Estilo73">Unidad Ejecutora <font color="#FF0000"><strong>**</strong></font></span></td>
    <td><select name="UnidadEjecutora_nominal" class="TituloMedios Estilo73" id="select15" >
        <option value='0'> Ninguno </option>
        <? 
$sql = "select id_unidad_ejecutora, unidad_ejecutora from tb_unidad_ejecutora";
			$result = mssql_query($sql);
			while ($row = mssql_fetch_array($result))
			  { 
			  	
				?>
        <option value="<? echo $row['0']; ?>"><? echo $row['1']; ?></option>
        <? } ?>
    </select></td>
    <td><span class="Estilo73">Unidad Ejecutora <font color="#FF0000"><strong>**</strong></font></span></td>
    <td><select name="unidad_ejecutora_funcional" class="TituloMedios Estilo73" id="select22" >
        <option value='0'> Ninguno </option>
        <? 
$sql = "select id_unidad_ejecutora, unidad_ejecutora from tb_unidad_ejecutora";
			$result = mssql_query($sql);
			while ($row = mssql_fetch_array($result))
			  { 
			  	
				?>
        <option value="<? echo $row['0']; ?>"><? echo $row['1']; ?></option>
        <? } ?>
    </select></td>
  </tr>
  <tr>
    <td><span class="Estilo73">Viceministerio al que pertenece <font color="#FF0000"><strong>**</strong></font></span></td>
    <td><select name="viceministerioNominal" class="TituloMedios Estilo73" id="select16" >
        <option value='0'> Ninguno </option>
        <? 
$sql = "select id_viceministerio, nombre from tbl_viceministerio";
			$result = mssql_query($sql);
			while ($row = mssql_fetch_array($result))
			  { 
			  	
				?>
        <option value="<? echo $row['0']; ?>"><? echo $row['1']; ?></option>
        <? } ?>
    </select></td>
    <td><span class="Estilo73">Viceministerio al que pertenece <font color="#FF0000"><strong>**</strong></font></span></td>
    <td><select name="viceministerio_funcional" class="TituloMedios Estilo73" id="select23" >
        <option value='0'> Ninguno </option>
        <? 
$sql = "select id_viceministerio, nombre from tbl_viceministerio";
			$result = mssql_query($sql);
			while ($row = mssql_fetch_array($result))
			  { 
			  	
				?>
        <option value="<? echo $row['0']; ?>"><? echo $row['1']; ?></option>
        <? } ?>
    </select></td>
  </tr>
  <tr>
    <td><span class="Estilo73">Dependencia en la que se encuentra <font color="#FF0000"><strong>**</strong></font></span></td>
    <td><select name="dep_pertence_nominal" class="TituloMedios Estilo73" id="select17" >
        <option value='0'> Ninguno </option>
        <? 
$sql = "select id_sede, nombre from tb_sede";
			$result = mssql_query($sql);
			while ($row = mssql_fetch_array($result))
			  { 
			  	
				?>
        <option value="<? echo $row['0']; ?>"><? echo $row['1']; ?></option>
        <? } ?>
    </select></td>
    <td><span class="Estilo73">Dependencia en la que se encuentra <font color="#FF0000"><strong>**</strong></font></span></td>
    <td><select name="depen_funcional" class="TituloMedios Estilo73" id="select24" >
        <option value='0'> Ninguno </option>
        <? 
$sql = "select id_sede, nombre from tb_sede";
			$result = mssql_query($sql);
			while ($row = mssql_fetch_array($result))
			  { 
			  	
				?>
        <option value="<? echo $row['0']; ?>"><? echo $row['1']; ?></option>
        <? } ?>
    </select></td>
  </tr>
  <tr>
    <td><span class="Estilo73">Direccion a la que pertenece <font color="#FF0000"><strong>**</strong></font></span></td>
    <td><select name="Dir_nominal" class="TituloMedios Estilo73" id="select20" >
        <option value='0'> Ninguno </option>
        <? 
$sql = "select id_direccion_pertenece, direccion_nombre from tb_direccion_pertenece";
			$result = mssql_query($sql);
			while ($row = mssql_fetch_array($result))
			  { 
			  	
				?>
        <option value="<? echo $row['0']; ?>"><? echo $row['1']; ?></option>
        <? } ?>
    </select></td>
    <td><span class="Estilo73">Direccion a la que pertenece <font color="#FF0000"><strong>**</strong></font></span></td>
    <td><select name="dir_funcional" class="TituloMedios Estilo73" id="select25" >
        <option value='0'> Ninguno </option>
        <? 
$sql = "select id_direccion_pertenece, direccion_nombre from tb_direccion_pertenece";
			$result = mssql_query($sql);
			while ($row = mssql_fetch_array($result))
			  { 
			  	
				?>
        <option value="<? echo $row['0']; ?>"><? echo $row['1']; ?></option>
        <? } ?>
    </select></td>
  </tr>
  <tr>
    <td><span class="Estilo73">Unidad a la que pertenece <font color="#FF0000"><strong>**</strong></font></span></td>
    <td><span class="Estilo74">
      <input name="unidad_nonimal" type="text" class="Estilo7" id="puesto_funcional" size="40" onkeyup="javascript:this.value=this.value.toUpperCase();" />
	  <!--
	  query que se utilizo
	  $sql = "select id_unidad, nombre_unidad from dbo.tb_unidad_asesor where activo =1"; --->
    </span></td>
    <td><span class="Estilo73">Unidad a la que pertenece <font color="#FF0000"><strong>**</strong></font></span></td>
    <td><span class="Estilo74">
      <input name="unidad_funcional" type="text" class="Estilo7" id="unidad_nonimal" size="40" onkeyup="javascript:this.value=this.value.toUpperCase();" />
	  <!--
	  query que se uso
	  $sql = "select id_unidad, nombre_unidad from dbo.tb_unidad_asesor where activo =1"; -->
    </span></td>
  </tr>
  <tr>
    <td><span class="Estilo73"> <!-- Ubicacion Fisica  --><font color="#FF0000"><strong> <!--** --></strong></font></span></td>
    <td>
	<!--
	<select name="Ubicacion_nominal" class="TituloMedios Estilo73" id="select19" >
        <option value='0'> Ninguno </option>
        <? $Ubicacion_nominal=0;
  //$sql = "SELECT id_ubicacion, nombre FROM   dbo.tb_ubicacion_asesor where activo =1";
	//		$result = mssql_query($sql);
		//	while ($row = mssql_fetch_array($result))
			//  { 
			  	
				?>
        <option value="<? //echo $row['0']; ?>"><? //echo $row['1']; ?></option>
        <? //} ?>
    </select> --></td>
    <td><span class="Estilo73">Ubicacion Fisica <font color="#FF0000"><strong>**</strong></font></span></td>
    <td><select name="ubicacion_funcional" class="TituloMedios Estilo73" id="select27" >
        <option value='0'> Ninguno </option>
        <? 
$sql = "SELECT id_ubicacion, nombre FROM   dbo.tb_ubicacion_asesor where activo =1";
			$result = mssql_query($sql);
			while ($row = mssql_fetch_array($result))
			  { 
			  	
				?>
        <option value="<? echo $row['0']; ?>"><? echo $row['1']; ?></option>
        <? } ?>
    </select></td>
  </tr>
  </table>
  </span>
  <table width="1117" border="0">
  <tr>
    <td><span class="Estilo73">Fecha ingreso <font color="#FF0000"><strong>**</strong></font></span></td>
    <td><span class="Estilo73">d&iacute;a
      <!--input name="dia3" type="text" class="Estilo1" id="dia3" maxlength="2"  size="2"-->
          <select name="dia1" class="Estilo1">
            <option></option>
            <?
	$i=1;
		
	 while ($i<=31)
	  {
	  ?>
            <option value="<? echo $i; ?>"><? echo $i; ?></option>
            <?  $i++;
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
	  ?>
        <option value="<? echo $i; ?>"><? echo $i; ?></option>
        <?  $i++;
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
	  ?>
        <option value="<? echo $i; ?>"><? echo $i; ?></option>
        <?  $i++;
	 }
	 
	?>
      </select>
    </span></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
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
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="Estilo73">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><span class="Estilo73">Salario<font color="#FF0000"><strong>**</strong></font></span></td>
    <td colspan="3"><? include("salarios.php");?></td>
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
    <td colspan="4"><? include("experiencia_laboral.php"); ?></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

		</div>
		<!-- datos laborales -->
		
		
    <div id="view1">

<!-- FORMULARIO DATO PERSONALES---> 

<table width="1116" border="0">
  <tr>
    <td height="32"><span class="Estilo73">DPI<font color="#FF0000"><strong>**</strong></font></span></td>
    <td><strong>
      <input name="num_gafete" id="num_gafete" size="18" />
    </strong></td>
    <td>&nbsp;</td>
    <td><span class="Estilo74"><br />
    </span></td>
  </tr>
  <tr>
    <td height="32"><span class="Estilo73">Primer Nombre <font color="#FF0000"><strong>**</strong></font></span></td>
    <td><span class="Estilo74">
      <input name="nombre" type="text" class="Estilo7" id="nombre" size="30" onkeyup="javascript:this.value=this.value.toUpperCase();" />
    </span></td>
    <td><span class="Estilo73">Segundo Nombre<font color="#FF0000"><strong>**</strong></font></span></td>
    <td><input name="nombre2" type="text" class="Estilo7" id="nombre2" value="UNICO NOMBRE" onkeyup="javascript:this.value=this.value.toUpperCase();" size="30" /></td>
  </tr>
  <tr>
    <td width="94" height="32"><span class="Estilo73">Tercer Nombre</span></td>
    <td width="418"><span class="Estilo74">
      <input name="nombre3" type="text" class="Estilo7" id="nombre3" size="30"  onkeyup="javascript:this.value=this.value.toUpperCase();" />
    </span></td>
    <td width="152">&nbsp;</td>
    <td width="434">&nbsp;</td>
  </tr>
  
  <tr>
    <td height="37"><span class="Estilo73">Primer Apellido<font color="#FF0000"><strong>**</strong></font></span></td>
    <td><input name="apellidos" type="text" class="Estilo7" id="apellidos" onkeyup="javascript:this.value=this.value.toUpperCase();" size="30" /></td>
    <td><span class="Estilo73">Segundo Apellido<font color="#FF0000"><strong>**</strong></font></span></td>
    <td><span class="Estilo74">
      <input name="apellido2" type="text" class="Estilo7" id="apellido2" value="UNICO APELLIDO" size="30" onkeyup="javascript:this.value=this.value.toUpperCase();" />
    </span></td>
  </tr>
  <tr>
    <td height="34"><span class="Estilo73">Apellido de Casada</span></td>
    <td><span class="Estilo74">
      <input name="apellidocasada" type="text" class="Estilo7" id="apellidocasada" size="30" onkeyup="javascript:this.value=this.value.toUpperCase();" />
    </span></td>
    <td><span class="Estilo73">Estado Civil<font color="#FF0000"><strong>**</strong></font></span></td>
    <td><span class="Estilo73">
      <select name="estado_civil" class="TituloMedios" id="estado_civil" >
        <option selected="selected" value=''> Seleccione </option>
        <option value='S'> Soltero (a) </option>
        <option value='C'> Casado (a)</option>
      </select>
    </span></td>
  </tr>
  <tr>
    <td height="34"><span class="Estilo73">Fecha nacimiento<font color="#FF0000"><strong>**</strong></font></span></td>
    <td><span class="Estilo73">&nbsp;d&iacute;a
        <!--input name="dia3" type="text" class="Estilo1" id="dia3" maxlength="2"  size="2"-->
        <select name="dia" class="Estilo1">
          <option></option>
          <?
	$i=1;
		
	 while ($i<=31)
	  {
	  ?>
          <option value="<? echo $i; ?>"><? echo $i; ?></option>
          <?  $i++;
	 }
	 
	?>
        </select>
mes
<!--input name="mes3" type="text" class="Estilo1" id="mes3" size="2" maxlength="2"-->
<select name="mes" class="Estilo1">
  <option></option>
  <?
	$i=1;
	 while ($i<=12)
	  {
	  ?>
  <option value="<? echo $i; ?>"><? echo $i; ?></option>
  <?  $i++;
	 }
	 
	?>
</select>
a&ntilde;o
<!--input name="ano3" type="text" class="Estilo1" id="ano3" size="4" maxlength="4"-->
<select name="ano" class="Estilo1">
  <option></option>
  <?
	$i=1900;
	 while ($i<=date('Y'))
	  {
	  ?>
  <option value="<? echo $i; ?>"><? echo $i; ?></option>
  <?  $i++;
	 }
	 
	?>
</select>
    </span></td>
    <td><span class="Estilo73">Lugar de Nacimiento </span></td>
    <td><span class="Estilo74">
      <select name="lnac" class="TitulosMedios"  id="lnac" onchange="javascript:cargarCombo('lnacimiento.php', 'lnac', 'lnac_div')"  >
        <option value=''> Seleccione </option>
        <?      
			$sql = "select dpi.codigo_registro,dpi.registro, dep.nombre_departamento, dep.codigo_departamento from dbo.tb_registro as dpi inner join dbo.tb_departamento as dep on dpi.codigo_departamento= dep.codigo_departamento where dpi.codigo_departamento >0";
			$result = mssql_query($sql);
			while ($row = mssql_fetch_array($result))
			  { 
			  	
				?>
        <option value="<? echo $row['codigo_registro']; ?>"><? echo $row['nombre_departamento']; ?></option>
        <? } ?>
      </select>
      <br />
    </span>
      <div class="Estilo73" id="lnac_div"> <span class="Estilo7">
        <label for="lnacimiento"></label>
        <select name="mnac"  id="mnac" class="TituloMedios">
          <option value=''> Municipio </option>
        </select>
      </span> </div></td>
  </tr>
  <tr>
    <td height="34"><span class="Estilo73">Nacionalidad<font color="#FF0000"><strong>**</strong></font></span></td>
    <td><span class="Estilo73">
      <input name="opnacionalidad" type="radio" onclick="imprimir();" value="1" checked="checked" />
Guatemalteco
<input name="opnacionalidad" type="radio" value="2" onclick="imprimir();"/>
Otros</span></td>
    <td><span class="Estilo73">Genero:<font color="#FF0000"><strong>**</strong></font></span></td>
    <td><span class="Estilo73">M
        <input name="sexo" type="radio" value="M" />
F
<input name="sexo" type="radio" value="F" />
    </span></td>
  </tr>
  <tr>
    <td height="36"><span class="Estilo73">Pueblo de Pertenencia <font color="#FF0000"><strong>**</strong></font></span></td>
    <td><select name="idgrupoetnico" class="TituloMedios Estilo73" id="idgrupoetnico" >
      <option value='0'> Ninguno </option>
      <? 
$sql = "select idgrupoetnico, grupoetnico from asesor_grupoetnico";
			$result = mssql_query($sql);
			while ($row = mssql_fetch_array($result))
			  { 
			  	
				?>
      <option value="<? echo $row['idgrupoetnico']; ?>"><? echo $row['grupoetnico']; ?></option>
      <? } ?>
    </select></td>
    <td class="Estilo73">Comunidad Ling&uuml;istica <font color="#FF0000"><strong>**</strong></font></td>
    <td><select name="lingui" class="TituloMedios Estilo73" id="select11" >
      <option value='0'> Ninguno </option>
      <? 
$sql = "select id_linguistica,nombre from dbo.tb_linguistica order by nombre asc ";
			$result = mssql_query($sql);
			while ($row = mssql_fetch_array($result))
			  { 
			  	
				?>
      <option value="<? echo $row[0]; ?>"><? echo $row[1]; ?></option>
      <? } ?>
    </select></td>
  </tr>
  <tr>
    <td height="33"><span class="Estilo73">Numero de telefono </span></td>
    <td><span class="Estilo7">
      <input name="cedula" type="text" class="Estilo7" id="cedula" size="30" maxlength="13" />
    </span></td>
    <td><span class="Estilo73">Fotografia<font color="#FF0000"><strong>**</strong></font></span></td>
    <td><input name="userfile" type="file" id="userfile" /></td>
  </tr>
  <tr>
    <td height="38"><span class="Estilo73">Tipo de Licencia de conducir </span></td>
    <td><span class="Estilo74">
      <select name="tipo_licencia" id="tipo_licencia" >
        }
	    
        <option selected="selected" value="NULL"> Selecione </option>
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C">C</option>
        <option value="M">M</option>
      </select>
&nbsp;&nbsp;&nbsp; </span><span class="Estilo73">Numero</span><span class="Estilo74">
<input type="text" name="num_licencia" size = "20" />
&nbsp; </span></td>
    <td class="Estilo73">NIT</td>
    <td><span class="Estilo74">
      <input name="nit" type="text" class="Estilo7" id="nit" size="30" onkeyup="javascript:this.value=this.value.toUpperCase();" />
    </span></td>
  </tr>
  <tr>
    <td height="45" colspan="4" class="Estilo73"><div align="center">DIRECCION DE RESIDENCIA </div></td>
    </tr>
  <tr>
    <td height="45" class="Estilo73">Direccion<font color="#FF0000"><strong>**</strong></font></td>
    <td><span class="Estilo74">
      <input name="dirasesor" type="text" class="Estilo7" id="apellidocasada2" size="60" onkeyup="javascript:this.value=this.value.toUpperCase();" />
    </span></td>
    <td><span class="Estilo73">Zona<font color="#FF0000"><strong>**</strong></font></span></td>
    <td><span class="Estilo73">
      <select name="zonap" class="Estilo1">
      
        <option value="0" selected="selected">SELECCIONE ZONA</option>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		<option value="6">6</option>
		<option value="7">7</option>
		<option value="8">8</option>
		<option value="9">9</option>
		<option value="10">10</option>
		<option value="11">11</option>
		<option value="13">13</option>
		<option value="14">14</option>
		<option value="15">15</option>
		<option value="16">16</option>
		<option value="17">17</option>
		<option value="18">18</option>
		<option value="19">19</option>
		<option value="20">20</option>
		<option value="21">21</option>
		<option value="22">22</option>
		<option value="23">23</option>
		<option value="24">24</option>
		<option value="25">25</option>
      </select>
    </span></td>
  </tr>
  <tr>
    <td height="45" class="Estilo73">Colonia/Residencial<strong><font color="#FF0000">**</font></strong></td>
    <td><span class="Estilo74">
      <input name="dirasesor2" type="text" class="Estilo7" id="dirasesor" size="40" onkeyup="javascript:this.value=this.value.toUpperCase();" />
    </span></td>
    <td class="Estilo73">Departamento y Municipio </td>
    <td><span class="Estilo74">
      <select name="dpiext" class="TitulosMedios"  id="dpiext" onchange="javascript:cargarCombo('dpiextendido.php', 'dpiext', 'dpiext_div')"  >
        <option value=''> Departamento </option>
        <?      
			$sql = "select dpi.codigo_registro,dpi.registro, dep.nombre_departamento, dep.codigo_departamento from dbo.tb_registro as dpi inner join dbo.tb_departamento as dep on dpi.codigo_departamento= dep.codigo_departamento where dpi.codigo_departamento >0";
			$result = mssql_query($sql);
			while ($row = mssql_fetch_array($result))
			  { 
			  	
				?>
        <option value="<? echo $row['codigo_registro']; ?>"><? echo $row['nombre_departamento']; ?></option>
        <? } ?>
      </select>
    </span>
      <div class="Estilo73" id="dpiext_div"> <span class="Estilo7">
        <label for="dpiextendido"></label>
        <select name="munidpi"  id="munidpi" class="TituloMedios">
          <option value=''> Municipio </option>
        </select>
      </span> </div></td>
  </tr>
  <tr>
    <td height="45" class="Estilo73">&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td height="45" class="Estilo73">Datos Familirares </td>
    <td colspan="3"> <span class="Estilo73">
      <? include("familiares.php"); ?>
    </span></td>
    </tr>
  <tr>
    <td height="35" class="Estilo73">Correo Electronico </td>
    <td colspan="3"><span class="Estilo73">
      <? include("correo.php"); ?>
    </span></td>
    </tr>
  <tr>
    <td height="29" class="Estilo73">&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td height="29" colspan="4" class="Estilo73"><div align="center">DISCAPACIDAD</div></td>
    </tr>
  <tr>
    <td height="29" class="Estilo73">Tiena alguna Discapacidad</td>
    <td colspan="3"><span class="Estilo73">
      <input name="discapacidad" type="radio" onclick="imprimir();" value="1" checked="checked" /> 
      SI
      <input name="discapacidad" type="radio" value="2" onclick="imprimir();"/>
      NO
    </span></td>
  </tr>
  <tr>
    <td height="29" class="Estilo73">&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
  </table>
  <span id="div_sidiscapacidad" style="display:inline">
  <table width="1116" border="0">
  <tr>
  
    <td height="29" class="Estilo73">Discapacidad</td>
    <td colspan="3"><span class="Estilo73">
      <? include("discapacidad.php"); ?>
    </td>
    </tr>
	</table>
	</span>
	<span id="div_nodiscapacidad" style="display:none">
	</span>
	
	<table width="1116" border="0">
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



<!-- FORMULARIO DATO PERSONALES---> 
     </div>
     <div id="view2">
	  
	  <table width="1116" border="0">
  <tr>
    <td width="147" height="37" class="Estilo73">Cuenta con Escolaridad<font color="#FF0000"><strong>**</strong></font> </td>
    <td width="861"><span class="Estilo73">
      <input name="escolaridad1" type="radio" onclick="imprimir();" value="1" checked="checked" />
      Si
      <input name="escolaridad1" type="radio" value="2" onclick="imprimir();"/>
      No
    </span></td>
	<!--  aqui esta -->
	
	 
	
    <td width="44">&nbsp;</td>
    <td width="46">&nbsp;</td>
  </tr>
  <tr>
    <td height="37" class="Estilo73">&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
  </table>
  
  <span id="div_estudio" style="display:inline">
   <table width="1116" border="0">
  <tr>
    <td width="153" height="37" class="Estilo73">Estudios Realizados </td>
    <td colspan="3"><? include("estudios_realizados.php"); ?></td>
    </tr>
	</table>
	</span>
	
	 <span id="div_noestudio" style="display:none">
   <table width="1116" border="0">
  <tr>
    <td height="37" class="Estilo73">Escribir</td>
    <td width="153" height="37" class="Estilo73"><span class="Estilo74">
      <select name="escribre" >
        <option selected="selected" value="NULL"> Selecione </option>
        <option value="1">SI</option>
        <option value="2">NO</option>
      </select>
    </span></td>
    <td width="153" height="37" class="Estilo73">Leer<span class="Estilo74">
      <select name="lee" >
        <option selected="selected" value="NULL"> Selecione </option>
        <option value="1">SI</option>
        <option value="2">NO</option>
      </select>
      <? $habla =1;  ?>
    </span></td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td height="37" class="Estilo73">&nbsp;</td>
    <td height="37" class="Estilo73">&nbsp;</td>
    <td height="37" class="Estilo73">&nbsp;</td>
    <td colspan="3"></td>
  </tr>
  <tr>
    <td width="153" height="37" class="Estilo73">OFICIO U OCUPACION </td>
	<td height="37" colspan="3" class="Estilo73"><? include("estudios_realizados2.php"); ?></td>
	</tr>
	</table>
	
	
	</span>
	
	
	<table width="1116" border="0">
  <tr>
    <td height="50" class="Estilo73">&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
  
  <tr >
    <td   height="50" class="Estilo73">Capacitaciones</td>
    <td colspan="3"><? include("capacitaciones.php"); ?></td>
    </tr>
  <tr>
 
    <td height="34">&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td height="34"><span class="Estilo73">Idiomas </span></td>
    <td colspan="3"><span class="Estilo73">
      <? include("otros_idiomas.php"); ?>
    </span></td>
  </tr>
  <tr>
    <td height="34">&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td height="34"><span class="Estilo73">Colegiado</span></td>
    <td colspan="3"><span class="Estilo73">
      <? include("colegiado.php"); ?>
    </span></td>
    </tr>
</table>

	  
	  <p>&nbsp;</p>
     </div>
	  
  </div>
  
  </div>
  

  
  <p align="center">
   
  </p>
  <input name="cmd_guardar" type="button" onClick="Validar(this.form)" id="cmd_guardar" value="Guardar Datos" >
</form>
<script type="text/javascript">
<!--
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels");
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
