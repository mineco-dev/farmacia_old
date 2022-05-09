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
			@mkdir(trim($carpeta), 0700);
			@mkdir(trim($carpeta_bonos), 0700);
			@mkdir(trim($carpeta_notas), 0700);
		}else{
			$nombre_carpeta = "fotos/".$num_gafete;
			$msg = "Ya existe ese directorio\n";		
		}  
		
		
	 		 
		 
		$nombre_archivo = $HTTP_POST_FILES['userfile']['name']; 
		$x = $HTTP_POST_FILES['userfile']['tmp_name']; 
		$tipo_archivo = $HTTP_POST_FILES['userfile']['type']; 
		$tamano_archivo = $HTTP_POST_FILES['userfile']['size']; 
		
		
		//compruebo si las caracter�sticas del archivo son las que deseo 
		if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "jpg") || strpos($tipo_archivo, "pdf")) && ($tamano_archivo < 100000))) { 
		/*	echo "La extensión o el TAMAÑO de los archivos no es correcta. <br><br><table><tr><td><li>Se permiten archivos .gif o .jpg<br><li>se permiten archivos de 100 Kb m�ximo.</td></tr></table>"; */
		}else{ 
			if (move_uploaded_file($HTTP_POST_FILES['userfile']['tmp_name'], $nombre_carpeta."/".$nombre_archivo)){ 
			  // echo "El archivo ha sido cargado correctamente."; 
			}else{ 
			   echo "Ocurri� alg�n error al subir el fichero. No pudo guardarse."; 
			} 
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
		apellidocasada, sexo, cedula,  nit, activo, colonia, aldea1, caserio, calle, numero,idmunicipio_nac, idregistro, estadocivil, nacionalidad, codigo_profesion, idmunicipio_reside, pasaporte,
		nombre_estado_provincia, fecha_nacimiento,zona,tipolicencia,licencia,iddepartamento_reside,gafete,idgrupoetnico,direccion_para_notificaciones,igss,empadronamiento,gruposanguineo,altura,peso,userfilefoto, usuario_creacion, fecha_creacion, colegiado) 
		 values ('$nombre',  '$nombre2', '$nombre3', '$apellidos', '$apellido2', '$apellidocasada', '$sexo', '$cedula', '$nit', '$empleado_activo', '$colonia', '$aldea',
		'$caserio',
		'$calle', '$numero', '$idgrupo', '$registro', '$estado_civil', '$idnacionalidad', $profesion, '$idgrupo2', '$numero_pasaporte', '$provincia', 
		'$fecha_naci','$zona','$tipo_licencia','$num_licencia','$tema','$num_gafete','$idgrupoetnico','$direccion_para_notificaciones','$igss','$empadronamiento','$g_sanguineo','$altura','$peso','$nombre_archivo', '$nombre_usuario', getdate(),'$colegiado')";

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
				


		$cnt = 1;
		while ($cnt <= count($requisito))
		{	
					
			$fichero = 'fichero';
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


<script language="JavaScript" src="calendar_db.js"></script>
<link rel="stylesheet" href="calendar.css">
<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css"/>
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
	 textoCampo = window.document.form1.zona.value 
	 textoCampo = validarEntero(textoCampo) 
	 window.document.form1.zona.value = textoCampo 

	 textoCampo = window.document.form1.codigo_postal.value 
	 textoCampo = validarEntero(textoCampo) 
	 window.document.form1.codigo_postal.value = textoCampo 

	  if (form.nombre.value == "")
	  { alert("Por favor ingrese su Primer Nombre"); form.nombre.focus(); return; }
	  
	  if (form.apellidos.value == "")
	  { alert("Por favor ingrese su Primer Apellido"); form.apellidos.focus(); return; }
	  


 if (form.num_gafete.value == "")
	  { alert("Por favor ingrese El Gafete"); form.num_gafete.focus(); return; }

if (form.estado_civil.value == 0)
		{ alert("Por favor seleccione su Estado Civil"); form.estado_civil.focus(); return; }


	  if ((!form.sexo[0].checked) && (!form.sexo[1].checked))
		{ alert("Por favor ingrese su Sexo"); form.sexo[0].focus(); return; }
	  
	  if ((form.registro.value == "") && (form.opnacionalidad[0].checked))
	  { alert("Por favor seleccione el No. de orden de la c�dula");  return; }
	  
	  if (form.cedula.value == "")
	  { alert("Escriba el No. de registro de la c�dula"); form.cedula.focus(); return; }

	  if ((form.numero_pasaporte.value == "") && (form.opnacionalidad[1].checked))
	  { alert("Por favor ingrese No. de Pasaporte"); return; }
	

	  if ((form.idgrupo.value == "") && (form.opnacionalidad[0].checked))
	  { alert("Por favor confirme Municio"); form.idgrupo.focus(); return; }
	
		if (form.calle.value == "")
		  { alert("Por favor ingrese la calle");  return; }

		if (form.numero.value == "")
		  { alert("Por favor ingrese el numero de la casa"); return; }
		
		if (form.zona.value == "")
		  { alert("Por favor ingrese la zona"); return; }
		
		if (form.tema.value == "")
		  { alert("Por favor seleccione el departamento de residencia"); return; }
		  
		  if ((form.dia.value == "") || (form.mes.value == "") ||(form.ano.value == ""))
	  { alert("Por favor ingrese fecha de cumplea�os"); form.dia.focus(); form.mes.focus(); form.ano.focus(); return; }
	  

  
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


ban = 0; for (i=1;i<100;i++) { if (valor(form['oficialcg['+i+']'])) ban = 1; } if (ban == 0) {alert('Debe seleccionar por lo menos una Contratacion Vigente'); return};
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
<table width="598" border="0" align="left" cellspacing="0">
  <tr bgcolor="#0066CC">
    <td colspan="7" bgcolor="#FFFFFF"><div align="left"><span class="Estilo1 Estilo2 style1"><span class="style6">Formulario de Ingreso de Personas al Sistema</span></span><span class="style5">&nbsp;&nbsp;</span><span class="Estilo67"><font color="#6699FF" face="Arial, Helvetica, sans-serif">&nbsp;&nbsp;Fecha</font> <font face="Arial, Helvetica, sans-serif"> <? echo'<font color="#003399"><strong>'.date("d")."/".date("m")."/".date("Y").'</strong></font>'; ?> <? echo'<font color="#003399"><strong>'.$hora.'</strong></font>'; ?> </font></span></div></td>
  </tr>
  &nbsp;
  <tr>
    <td width="260"></td><td width="334"></td>
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
<br>
<p>&nbsp;</p>
<p>&nbsp;</p>
<form action="apersona.php?inserta=1" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <div id="TabbedPanels" class="TabbedPanels"> 
    <ul class="TabbedPanelsTabGroup"> 
      <li class="TabbedPanelsTab" tabindex="0">Datos Personales</li>
      <li class="TabbedPanelsTab" tabindex="0">Datos de Residencia</li>
      <li class="TabbedPanelsTab" tabindex="0">Datos Academicos</li>
      <li class="TabbedPanelsTab" tabindex="0">Experiencia Laboral</li>
      <li class="TabbedPanelsTab" tabindex="0">Historial Medico</li>
      <li class="TabbedPanelsTab" tabindex="0">Requisitos</li>
	  <li class="TabbedPanelsTab" tabindex="0">Salarios</li>
    </ul>
    <div class="TabbedPanelsContentGroup">
      <div class="TabbedPanelsContent">
        <table width="671" border="0" align="center" cellspacing="0">
          
          <tr class="Estilo1">
            <td height="34" class="Estilo22" ><strong>No. de GAFETE <font color="#FF0000"><strong>**</strong></font></strong></td>
            <td class="Estilo7"><span class="Estilo22"><strong>
              <input name="num_gafete" id="num_gafete" size="18" />
              &nbsp;&nbsp;
              
            </strong></span></td>
            <td colspan="3" class="Estilo7">&nbsp;</td>
            <td colspan="-1">&nbsp;</td>
          </tr>
          <tr class="Estilo1">
            <td width="133" height="34" class="Estilo22" > Primer Nombre <font color="#FF0000"><strong>**</strong></font></td>
            <td class="Estilo7" width="180"><input name="nombre" type="text" class="Estilo7" id="nombre" size="30" onKeyUp="javascript:this.value=this.value.toUpperCase();" /></td>
            <td colspan="3" class="Estilo7"><div align="right" class="Estilo22">Segundo Nombre </div></td>
            <td width="187" colspan="-1"><input name="nombre2" type="text" class="Estilo7" id="nombre2" size="30" onKeyUp="javascript:this.value=this.value.toUpperCase();" />
            <span class="Estilo6"> </span></td>
          </tr>
          <tr class="Estilo7">
            <td class="Estilo7"><span class="Estilo22">Tercer Nombre</span></td>
            <td class="Estilo7"><input name="nombre3" type="text" class="Estilo7" id="nombre3" size="30" onKeyUp="javascript:this.value=this.value.toUpperCase();" /></td>
            <td colspan="3" class="Estilo7"><div align="right" class="Estilo22">Primer Apellido<font color="#FF0000"><strong>**</strong></font></div></td>
            <td colspan="-1"><input name="apellidos" type="text" class="Estilo7" id="apellidos" size="30" onKeyUp="javascript:this.value=this.value.toUpperCase();" /></td>
          </tr>
          <tr class="Estilo7">
            <td class="Estilo7"><span class="Estilo22">Segundo Apellido</span></td>
            <td class="Estilo7"><input name="apellido2" type="text" class="Estilo7" id="apellido2" size="30" onKeyUp="javascript:this.value=this.value.toUpperCase();" /></td>
            <td colspan="3" class="Estilo7"><div align="right"><span class="Estilo22">Apellido de Casada</span></div></td>
            <td colspan="5" class="Estilo7"><input name="apellidocasada" type="text" class="Estilo7" id="apellidocasada" size="30" onKeyUp="javascript:this.value=this.value.toUpperCase();" /></td>
          </tr>
          <tr class="Estilo7">
            <td class="Estilo7"><span class="Estilo22">Estado Civil<font color="#FF0000"><strong>**</strong></font></span></td>
            <td class="Estilo7"><span class="Estilo22">
              <select name="estado_civil" class="TituloMedios" id="estado_civil" >
                <option selected value=''> Seleccione </option>
                <option value='S'> Soltero (a) </option>
                <option value='C'> Casado (a)</option>                
              </select>
            </span></td>
            <td colspan="3" class="Estilo7"><div align="right" class="Estilo22">Fecha nacimiento<font color="#FF0000"><strong>*</strong></font><font color="#FF0000"><strong>*</strong></font><font color="#FF0000"></font></div></td>
            <td colspan="5" class="Estilo7"><span class="Estilo22">&nbsp;d&iacute;a
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
              <!--input name="edad" type="text" id="nacimiento" size="5"-->
            </span></td>
          </tr>
          <tr class="Estilo1">
            <td><span class="Estilo22">Sexo:<font color="#FF0000"><strong>**</strong></font></span> </td>
            <td><span class="Estilo22"> M
              <input name="sexo" type="radio" value="M" />
              F
              <input name="sexo" type="radio" value="F" />
            </span></td>
          </tr>
          <tr class="Estilo1">
            <td class="Estilo22">NIT</td>
            <td class="Estilo7"><input name="nit" type="text" class="Estilo7" id="nit" size="30" onKeyUp="javascript:this.value=this.value.toUpperCase();" /></td>
            <td width="57">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ACTIVO</strong> </td>
            <!--td colspan="2" class="Estilo7"><div align="right" class="Estilo22">Igss</div></td-->
            <td width="99" colspan="-1"><!--input name="igss" type="text" class="Estilo1" id="igss" size="30"-->
                <span class="Estilo6"><select name="empleado_activo" id="empleado_activo"><option selected value="1">Activo</option><option value="2">Inactivo</option></select> </span></td>
          </tr>
          
          <tr class="Estilo7">
            <td class="Estilo7"><span class="Estilo22">Nacionalidad<font color="#FF0000"><strong>**</strong></font></span></td>
            <td colspan="4" class="Estilo7"><label>
              <input name="opnacionalidad" type="radio" onClick="imprimir();" value="1" checked="checked" />
              <span class="Estilo22">Guatemalteco
              <input name="opnacionalidad" type="radio" value="2" onClick="imprimir();"/> 
            Otros</span></label></td>
            <td colspan="-1">&nbsp;</td>
          </tr>
          
          <tr class="Estilo7">
            <td colspan="6" class="Estilo7">
			
			<span id="div_nacional" style="display:inline">
			<table width="100%" border="0">
              
              <tr class="Estilo7">
                <td width="13%" class="Estilo7"><div align="left"><span class="style8">C&eacute;dula de Vecindad</span></div></td>
                <td width="41%" class="Estilo7">&nbsp;</td>
                <td colspan="2" class="Estilo7"><div align="right" class="Estilo22">Fotografia</div></td>
                <td width="33%" colspan="-1"><input type="file" name="userfile" id="userfile" /></td>
              </tr>
              <tr class="Estilo7">
                <td class="Estilo7"><span class="Estilo22">Orden<font color="#FF0000"><strong>**</strong></font></span></td>
                <td class="Estilo7"><span class="Estilo22">
                  <select name="registro" class="TituloMedios" id="registro" onChange="javascript:cargarCombo('subactividades.php', 'registro', 'Div_Subactividades')" >
                    <option value=''> Seleccione </option>
                    <?      
			$sql = "select codigo_registro, registro from tb_registro ";
			$result = mssql_query($sql);
			while ($row = mssql_fetch_array($result))
			  { 
			  	
				?>
                    <option value="<? echo $row['codigo_registro']; ?>"><? echo $row['registro']; ?></option>
                    <? } ?>
                  </select>
                  Registro<font color="#FF0000"><strong>**</strong></font>
                  <input name="cedula" type="text" class="Estilo7" id="cedula" size="7" />
                </span></td>
                <td colspan="2" class="Estilo7"><div align="right">
                  <!--div align="right" class="Estilo22">
adjunte copia de C&eacute;dula</div-->
                  <span class="Estilo22">Numero de IGSS</span></div></td>
                <!--td c><span class="Estilo22"><input name="userfile" type="file" id="userfile" size="30">
    </span></td-->
                <td colspan="-1"><span class="Estilo22"><span class="Estilo47">
                  <input name="igss" type="text" class="Estilo7" id="igss"  onkeyup="javascript:this.value=this.value.toUpperCase();" />
                </span></span></td>
              </tr>
              <tr class="Estilo1">
                <td class="Estilo22">Municipio<font color="#FF0000"><strong>**</strong></font></td>
                <td class="Estilo7"><span class="Estilo47">
                  <div align="left"><div id="Div_Subactividades">
                      <label for="SubActividad"></label>
                      <select name="idgrupo"  id="idgrupo" class="TituloMedios">
                      </select>
                    </div></div>
                </span> </td>
                <td colspan="2" class="Estilo7"><div align="right">Empadronamiento</div></td>
                <td colspan="-1"><span class="Estilo47">
                  <input name="empadronamiento" type="text" class="Estilo7" id="empadronamiento"  onkeyup="javascript:this.value=this.value.toUpperCase();" />
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
				while ($row = mssql_fetch_array($result))
			  	{ 
					print "<option value=".$row['codigo_pais_origen'].">".$row['nombre_pais']."</option>";
				}

			?> 
</select>
            </span></td>
            <td colspan="2" class="Estilo7">&nbsp;</td>
            <td colspan="-1">&nbsp;</td>
          </tr>
			  <tr class="Estilo7">
                <td width="21%" class="Estilo7"><span class="Estilo22">Numero Pasaporte</span></td>
                <td width="52%" class="Estilo7"><input name="numero_pasaporte" type="text" class="Estilo7" id="numero_pasaporte" size="30" /></td>
                <td width="14" class="Estilo7">&nbsp;</td>
                <td width="13%" colspan="-1">&nbsp;</td>
              </tr>
            </table>			
			</span>            </td>
          </tr>
          
          <tr class="Estilo1">
            <td class="Estilo22">Profesion </td>
            <td class="Estilo7"><select name="profesion" class="TituloMedios" id="profesion" >
              <option value=''> Seleccione </option>
              <?      $sql = "select codigo_profesion, profesion from tb_profesion where activo=1 order by profesion";
			$result = mssql_query($sql);
			while ($row = mssql_fetch_array($result))
			  { 
			  	
				?>
              <option value="<? echo $row['codigo_profesion']; ?>" selected="selected"><? echo $row['profesion']; ?></option>
              <? } ?>
            </select></td>
            <td> No. Colegiado <td>
            <input name="colegiado" type="text" class="Estilo1" id="colegiado" size="10"/> </td>
          </tr>
          <tr class="Estilo1">
            <td class="Estilo22">Tipo de Licencia</td>
            <td colspan="5" class="Estilo7"><select name="tipo_licencia" id="tipo_licencia" ><option value="A">A</option><option value="B">B</option><option selected value="C">C</option><option value="M">M</option></select>
            &nbsp;&nbsp;&nbsp;              Numero
            <input type="text" name="num_licencia" size = "20">            &nbsp;</td>
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
              <input name="calle" type="text" class="Estilo7" id="calle"  onkeyup="javascript:this.value=this.value.toUpperCase();" />
            </span></td>
            <td  width="26%" align="right"><span class="Estilo22">Numero<font color="#FF0000"><strong>**</strong></font></span> </td>
            <td width="34%"><input name="numero" type="text" class="Estilo7" id="numero" size="5" onKeyUp="javascript:this.value=this.value.toUpperCase();" />            </td>
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
					while ($row = mssql_fetch_array($result))
					  { 
						
						?>
						<option value="<? echo $row['codigo_zona']; ?>"><? echo $row['numero_zona']; ?></option>
						<? } ?>
              </select>
            
            </div></td>
            <td width="26%" align="right" class="Estilo7"><span class="Estilo22">Colonia </span></td>
            <td width="34%"><div align="left" class="Estilo22">
                <input name="colonia" type="text" class="Estilo7" id="colonia"  onkeyup="javascript:this.value=this.value.toUpperCase();" />
            </div></td>
          </tr>
          <tr>
            <td width="15%" class="Estilo7"><div align="right" class="Estilo22">
                <div align="right" class="Estilo22">
                  <div align="left"> Aldea </div>
                </div>
            </div></td>
            <td class="Estilo7"><div align="left">
                <input name="aldea" type="text" class="Estilo7" id="aldea" onKeyUp="javascript:this.value=this.value.toUpperCase();" />
            </div></td>
            <td width="26%" align="right" class="Estilo7"><span class="Estilo22">Caserio </span></td>
            <td width="34%"><div align="left" class="Estilo22">
                <input name="caserio" type="text" class="Estilo7" id="caserio"  onkeyup="javascript:this.value=this.value.toUpperCase();" />
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
			while ($row = mssql_fetch_array($result))
			  { 
			  	
				?>
                  <option value="<? echo $row['codigo_departamento']; ?>"><? echo $row['nombre_departamento']; ?></option>
                  <? } ?>
                </select>
              </div>
            </span></td>
            <td width="26%" align="right"><span class="Estilo22">Municipio<font color="#FF0000"><strong>**</strong></font></span></td>
            <td width="34%"><div align="left">
                <div id="Div_Subactividades2">
                  <label for="SubActividad2"></label>
                  <select name="idgrupo2"  id="idgrupo2" class="TituloMedios">
                  </select>
                </div>
            </div></td>
          </tr>
         
          <tr>
            <td class="Estilo22">Notificaciones</td>
            <td colspan="2"><textarea name="direccion_para_notificaciones"  rows="6" cols="40"> </textarea>&nbsp;</td>
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
            <td><? include("familiares.php"); ?></td>
          </tr>
          <tr>
            <td><? include("correo.php"); ?></td>
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
     	<tr>
     	  <td><? include("estudios_realizados.php"); ?></td>
   	  </tr>
     	<tr>
     	  <td class="TabbedPanelsTab">Capacitaciones</td>
   	  </tr>
     	<tr>
     	  <td><? include("capacitaciones.php"); ?></td>
   	  </tr>
     	<tr>
     	  <td class="TabbedPanelsTab">Otros Idiomas </td>
   	  </tr>
     	<tr>
     	  <td><? include("otros_idiomas.php"); ?></td>
   	  </tr>
     </table>
     </div>
    
     <div class="TabbedPanelsContent">
      <table width="100%">
     	<tr>
        	<td class="TabbedPanelsTab">Historial Laboral </td>
        </tr>
     	<tr>
     	  <td><? include("experiencia_laboral.php"); ?></td>
   	  </tr>
     	<tr>
     	  <td class="TabbedPanelsTab">Plazas ocupadas dentro de MINECO</td>
   	  </tr>
     	<tr>
     	  <td><? include("contrataciones_gobierno.php"); ?></td>
   	  </tr>
     </table>
     </div>
     <div class="TabbedPanelsContent">
      <table width="100%">
     	
     	<tr>
     	  <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="16%" class="Estilo1"><div align="right">Grupo Sanguineo</div></td>
              <td width="18%" class="Estilo1">&nbsp;<select id="g_sanguineo" name="g_sanguineo"><option selected value="O+">O+</option><option value="O-">O-</option><option value="AB+">AB+</option><option value="AB-">AB-</option><option value="B+">B+</option><option value="B-">B-</option></select></td>
              <td width="14%" class="Estilo1"><div align="right">Grupo Etnico</div></td>
              <td width="52%">&nbsp;<select name="idgrupoetnico" class="TituloMedios" id="idgrupoetnico" >
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
            </tr>
            <tr>
              <td class="Estilo1"><div align="right">Altura</div></td>
              <td class="Estilo1">&nbsp;<input type="text" name="altura" size = "18">
                Cm</td>
              <td class="Estilo1"><div align="right">Peso</div></td>
              <td>&nbsp;<input type="text" name="peso" size = "18">
                <span class="Estilo1">Kg.</span></td>
            </tr>           
            
          </table></td>
   	  </tr>
     	<tr>
        	<td class="TabbedPanelsTab">Alergias</td>
        </tr>
     	<tr>
     	  <td><? include("alergias.php"); ?></td>
   	  </tr>
     	<tr>
     	  <td class="TabbedPanelsTab">Enfermedades</td>
   	  </tr>
     	<tr>
     	  <td><? include("enfermedad.php"); ?></td>
   	  </tr>
     </table>
     </div> 
	  <div class="TabbedPanelsContent">
<? include("trequisitos.php");?>
		</div>
        
		 <div class="TabbedPanelsContent">
<? include("salarios.php");?>
		</div>
        
    </div>
 
  </div>
  <p align="center">
    <input name="cmd_guardar" type="button" onClick="Validar(this.form)" id="cmd_guardar" value="Guardar Datos" >
  </p>
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
