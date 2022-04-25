<?
session_start();
$nombre_usuario=$_SESSION["user_name"];
include('conectarse.php');
include('../includes/inc_header_sistema.inc');
$dbms=new DBMS($conexion); 
$dbms->bdd=$database_cnn;


if ($inserta == 1)
 {
 
 

/*$cnt = 0;
		while ($cnt <= count($id_contratacion_gobierno))
		{			
			if ($oficiacg[$cnt] == '1')
			{			
				$contador++;
			}else{
				//envia_msg($prueba);
			}
			$cnt ++;
		}
if ($contador==0)
{
$x="Debe de ingresar una contratacion valida";
	envia_msg($x);
}*/
 
 
 
 
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
		//copiar el archivo grafico
		
		
		//tomo el valor de un elemento de tipo texto del formulario 
		/*$cadenatexto = $_POST["cadenatexto"]; 
		echo "Escribi� en el campo de texto: " . $cadenatexto . "<br><br>"; */
		
		//datos del arhivo
		 
		 
   	    $nombre_carpeta = "fotos/".$num_gafete;
		if(!is_dir($nombre_carpeta)){
			@mkdir($nombre_carpeta, 0700);
		}else{
			$msg = "Ya existe ese directorio\n";
		
		}  
		 		 
		 
		$nombre_archivo = $HTTP_POST_FILES['userfile']['name']; 
		$tipo_archivo = $HTTP_POST_FILES['userfile']['type']; 
		$tamano_archivo = $HTTP_POST_FILES['userfile']['size']; 
		//compruebo si las caracter�sticas del archivo son las que deseo 
		if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "jpg") || strpos($tipo_archivo, "pdf")) && ($tamano_archivo < 100000))) { 
		/*	echo "La extensión o el tama�o de los archivos no es correcta. <br><br><table><tr><td><li>Se permiten archivos .gif o .jpg<br><li>se permiten archivos de 100 Kb m�ximo.</td></tr></table>"; */
		}else{ 
			if (move_uploaded_file($HTTP_POST_FILES['userfile']['tmp_name'], $nombre_carpeta."/".$nombre_archivo)){ 
			  // echo "El archivo ha sido cargado correctamente."; 
			}else{ 
			   echo "Ocurri� alg�n error al subir el fichero. No pudo guardarse."; 
			} 
		} 
 
	/**********************************************/
	
	
	
	
	    $carpeta = "fotos/".$num_gafete."/anexo";
		if(!is_dir($carpeta)){
			@mkdir($carpeta, 0700);
		}else{
			$msg = "Ya existe ese directorio\n";
		
		}  
		 		 
$f=1;
while ($f <=9)
{
		$fname ='file'.$f; 	 
		$nombre_ar = $HTTP_POST_FILES[$fname]['name']; 
		//envia_msg($f);
		$anexo[$f] = $nombre_ar;		
		//envia_msg($anexo[$f]);		
		$tipo_archivo = $HTTP_POST_FILES[$fname]['type']; 
		$tamano_archivo = $HTTP_POST_FILES[$fname]['size']; 
		//compruebo si las caracter�sticas del archivo son las que deseo 
		if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "jpg") || strpos($tipo_archivo, "pdf") || strpos($tipo_archivo, "doc" || strpos($tipo_archivo, "xls" || strpos($tipo_archivo, "docx")))) && ($tamano_archivo < 100000))) { 
			echo ".."; 
		}else{ 
			if (move_uploaded_file($HTTP_POST_FILES[$fname]['tmp_name'], $carpeta."/".$nombre_ar)){ 
			  // echo "El archivo ha sido cargado correctamente."; 
			}else{ 
			   echo "No se pudieron cargar archivos adjuntos"; 
			} 
		} 
 
	/**********************************************/
	
$f++;	
}	

/*$testinput11 = $_REQUEST['testinput11'];
$testinput12 = $_REQUEST['testinput12'];
$testinput21 = $_REQUEST['testinput21'];
$testinput22 = $_REQUEST['testinput22'];
$testinput31 = $_REQUEST['testinput31'];
$testinput32 = $_REQUEST['testinput32'];*/


/*$i = 1;
while ($i<10)
{	
	envia_msg($valor);
	envia_msg($anexo[$i]);
	$i++;
}*/
	
	
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
		nombre_estado_provincia, fecha_nacimiento,zona,tipolicencia,licencia,iddepartamento_reside,gafete,idgrupoetnico,direccion_para_notificaciones,igss,empadronamiento,gruposanguineo,altura,peso,userfilefoto, usuario_creacion, fecha_creacion) 
		 values ('$nombre',  '$nombre2', '$nombre3', '$apellidos', '$apellido2', '$apellidocasada', '$sexo', '$cedula', '$nit', $empleado_activo, '$colonia', '$aldea',
		'$caserio',
		'$calle', '$numero', $idgrupo, $registro, '$estado_civil', '$idnacionalidad', $profesion, $idgrupo2, '$numero_pasaporte', '$provincia', 
		'$fecha_naci','$zona','$tipo_licencia','$num_licencia',$tema,'$num_gafete','$idgrupoetnico','$direccion_para_notificaciones','$igss','$empadronamiento','$g_sanguineo','$altura','$peso','$nombre_archivo', '$nombre_usuario', getdate())";

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
		$sql = "select max(idasesor) from asesor ";
		$result = mssql_query($sql);
		$row = mssql_fetch_array($result);
		$codpersona =  $row[0];
		//envia_msg($codpersona);
		//print $codpersona;
		
	
/**********************  AQUI ESTOY ***********************************************************************/	
				
		$vec[1] = 'testinput11';
		$cev[1] = 'testinput12';
		$vec[2] = 'testinput21';
		$cev[2] = 'testinput22';
		$vec[3] = 'testinput31';
		$cev[3] = 'testinput32';

		while ($cnt < 10)
		{	
			$tmp = 'checkbox'.$cnt;
			$valor = $_REQUEST[$tmp];									
			if($cnt < 4)
			{	
			
			 
 		
				$fecha1 = $_REQUEST[$vec[$cnt]];
				$fecha2 = $_REQUEST[$cev[$cnt]];		
				
  			/* envia_msg($fecha1);
 			 envia_msg($fecha2);*/
				
			}
			
			$codigo_requisito = $cnt;
			$archi = $anexo[$cnt];
			
		//$tipo_docto = 'select'.$cnt;
		if (!empty($valor))
		{
			$qry_insertar_requisitos ="insert into tb_requisitos";
			$qry_insertar_requisitos.="(codigo_requisito,fecha1,fecha2,archivo,idasesor)";
			$qry_insertar_requisitos.="values ($codigo_requisito,'$fecha1','$fecha2','$archi',$codpersona)";

			$result = mssql_query($qry_insertar_requisitos);
			
		}
			
			$cnt ++;
		}

		$cnt = 1;
		while ($cnt <= count($telefono))
		{
			$qry_insertar_telefono ="insert into tb_telefono";
			$qry_insertar_telefono.="(telefono,idasesor,extensiont,oficial,iddireccion) ";
			$qry_insertar_telefono.="values ('$telefono[$cnt]', '$codpersona','$extensiont[$cnt]','$oficialt[$cnt]','$iddireccion[$cnt]')";
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
		envia_msg($oficialcg[$cng]);
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
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>


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
	 
/*	 textoCampo = window.document.form1.telefono.value 
	 textoCampo = validarEntero(textoCampo) 
	 window.document.form1.telefono.value = textoCampo 
*/	




	  if (form.num_gafete.value == "")
	  { alert("Por favor ingrese El Gafete"); form.num_gafete.focus(); return; }

	  if (form.nombre.value == "")
	  { alert("Por favor ingrese su Primer Nombre"); form.nombre.focus(); return; }
	  
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
	  if ((!form.sexo[0].checked) && (!form.sexo[1].checked))
		{ alert("Por favor ingrese su Sexo"); form.sexo[0].focus(); return; }
	  
	  if ((form.registro.value == "") && (form.opnacionalidad[0].checked))
	  { alert("Por favor seleccione el No. de orden de la c�dula");  return; }
	  
	  if (form.cedula.value == "")
	  { alert("Escriba el No. de registro de la c�dula"); form.cedula.focus(); return; }

	  if ((form.numero_pasaporte.value == "") && (form.opnacionalidad[1].checked))
	  { alert("Por favor ingrese No. de Pasaporte"); return; }
	
	
	 /* if (form.cedula.value == "")
	  { alert("Por favor confirme su No. de Cedula"); form.cedula.focus(); return; }*/
	  
/*	  if (form.tema2.value == "") 
	  { alert("Por favor confirme El Departamento"); form.tema2.focus(); return; }
*/	
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
		  
		  function valor(objeto)
{
	try {
//		if ((objeto.value+0) == 0)
		if ((objeto.value) == 1)
			return true;
		else
			return false;
	} catch(e) 
	{
		return false;
	}
}


ban = 0; for (i=1;i<100;i++) { if (valor(form['oficialcg['+i+']'])) ban = 1; } if (ban == 0) {alert('Debe seleccionar por lo menos una Contratacion Vigente'); return};


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
  <div id="TabbedPanels1" class="TabbedPanels">
    <ul class="TabbedPanelsTabGroup">
      <li class="TabbedPanelsTab" tabindex="0">Datos Personales</li>
      <li class="TabbedPanelsTab" tabindex="0">Datos de Residencia</li>
      <li class="TabbedPanelsTab" tabindex="0">Datos Academicos</li>
      <li class="TabbedPanelsTab" tabindex="0">Experiencia Laboral</li>
      <li class="TabbedPanelsTab" tabindex="0">Historial Medico</li>
      <li class="TabbedPanelsTab" tabindex="0">Requisitos</li>
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
            <td colspan="3" class="Estilo7"><div align="right" class="Estilo22">Fecha nacimiento<font color="#FF0000"></font></div></td>
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
	$i=1920;
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
              <?      $sql = "select codigo_profesion, profesion from tb_profesion ";
			$result = mssql_query($sql);
			while ($row = mssql_fetch_array($result))
			  { 
			  	
				?>
              <option value="<? echo $row['codigo_profesion']; ?>" selected="selected"><? echo $row['profesion']; ?></option>
              <? } ?>
            </select></td>
            <td colspan="3" class="Estilo7"><div align="right" class="Estilo22"></div></td>
            <td colspan="-1"><!--input name="tipolicencia" type="text" class="Estilo1" id="tipolicencia" size="30"--></td>
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
		   <table width="100%" border="0" cellpadding="0" cellspacing="0">
		  
		  

<table width="80%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="BasicFontInBorder2">#</td>
    <td class="BasicFontInBorder2">Requisito</td>
    <td class="BasicFontInBorder2">Valido</td>
    <td class="BasicFontInBorder2">Archivo</td>
    <td colspan="2" class="BasicFontInBorder2"><div align="center">Fecha Validez </div></td>
    <td class="BasicFontInBorder2">Tipo de Documento </td>
  </tr>
  <tr>
    <td width="1%" class="BasicFontInBorder3">1</td>
    <td width="18%" class="BasicFontInBorder3">Colegiado Activo </td>
    <td width="6%" class="BasicFontInBorder3">
    <div align="center">
    <input name="checkbox1" type="checkbox" id="checkbox1" value="checkbox">
    </div></td>
    <td width="25%" class="BasicFontInBorder3">
    <input name="file1" type="file" id="file1"></td>
    <td width="19%" class="BasicFontInBorder3">
	<input name="testinput11" type="text" id="testinput11" size="8" />
	<script language="JavaScript">
	new tcal ({
		// form name
		'formname': 'form1',
		// input name
		'controlname': 'testinput11'
	});

	</script>
	</td>
    <td width="19%" class="BasicFontInBorder3">
	<input name="testinput12" type="text" id="testinput12" size="8" />
	<script language="JavaScript">
	new tcal ({
		// form name
		'formname': 'form1',
		// input name
		'controlname': 'testinput12'
	});

	</script></td>
    <td width="12%" class="BasicFontInBorder3"><select name="select9" id="select9">
      <option value="1">Unico</option>
      <option value="2">Renovable</option>
    </select></td>
	</tr>
  <tr>
    <td class="BasicFontInBorder3">2</td>
    <td class="BasicFontInBorder3">Boleto de Ornato </td>
    <td class="BasicFontInBorder3"><div align="center">
      <input type="checkbox" name="checkbox2" value="checkbox">
    </div></td>
    <td class="BasicFontInBorder3">
      <div align="left">
        <input type="file" name="file2">
      </div></td>
    <td class="BasicFontInBorder3">	<input name="testinput21" type="text" id="testinput21" size="8" />
	<script language="JavaScript">
	new tcal ({
		// form name
		'formname': 'form1',
		// input name
		'controlname': 'testinput21'
	});

	</script>&nbsp;</td>
    <td class="BasicFontInBorder3">	<input name="testinput22" type="text" id="testinput22" size="8" />
	<script language="JavaScript">
	new tcal ({
		'formname': 'form1',
		'controlname': 'testinput22'
	});

	</script>&nbsp;</td>
    <td class="BasicFontInBorder3"><select name="select1" id="select1">
      <option value="1">Unico</option>
      <option value="2">Renovable</option>
    </select></td>
  </tr>
  <tr>
    <td class="BasicFontInBorder3">3</td>
    <td class="BasicFontInBorder3">Antecedentes Penales </td>
    <td class="BasicFontInBorder3"><div align="center">
      <input type="checkbox" name="checkbox3" value="checkbox">
    </div></td>
    <td class="BasicFontInBorder3">
      <div align="left">
        <input type="file" name="file3">
      </div></td>
    <td class="BasicFontInBorder3">	<input name="testinput31" type="text" id="testinput31" size="8" />
	<script language="JavaScript">
	new tcal ({
		// form name
		'formname': 'form1',
		// input name
		'controlname': 'testinput31'
	});

	</script>&nbsp;</td>
    <td class="BasicFontInBorder3">	<input name="testinput32" type="text" id="testinput32" size="8" />
	<script language="JavaScript">
	new tcal ({
		// form name
		'formname': 'form1',
		// input name
		'controlname': 'testinput32'
	});

	</script>&nbsp;</td>
    <td class="BasicFontInBorder3"><select name="select2" id="select2">
      <option value="1">Unico</option>
      <option value="2">Renovable</option>
    </select></td>
  </tr>
  <tr>
    <td class="BasicFontInBorder3">4</td>
    <td class="BasicFontInBorder3">Cedula de Vecindad </td>
    <td class="BasicFontInBorder3"><div align="center">
      <input type="checkbox" name="checkbox4" value="checkbox">
    </div></td>
    <td class="BasicFontInBorder3">
      <div align="left">
        <input type="file" name="file4">
      </div></td>
    <td class="BasicFontInBorder3">&nbsp;</td>
    <td class="BasicFontInBorder3">&nbsp;</td>
    <td class="BasicFontInBorder3"><select name="select3" id="select3">
      <option value="1">Unico</option>
      <option value="2">Renovable</option>
    </select></td>
  </tr>
  <tr>
    <td class="BasicFontInBorder3">5</td>
    <td class="BasicFontInBorder3">Titulo de Nivel Medio </td>
    <td class="BasicFontInBorder3"><div align="center">
      <input type="checkbox" name="checkbox5" value="checkbox">
    </div></td>
    <td class="BasicFontInBorder3">
      <div align="left">
        <input type="file" name="file5">
      </div></td>
    <td class="BasicFontInBorder3">&nbsp;</td>
    <td class="BasicFontInBorder3">&nbsp;</td>
    <td class="BasicFontInBorder3"><select name="select4" id="select4">
      <option value="1">Unico</option>
      <option value="2">Renovable</option>
    </select></td>
  </tr>
  <tr>
    <td class="BasicFontInBorder3">6</td>
    <td class="BasicFontInBorder3">Titulo Universitario </td>
    <td class="BasicFontInBorder3"><div align="center">
      <input type="checkbox" name="checkbox6" value="checkbox">
    </div></td>
    <td class="BasicFontInBorder3">
      <div align="left">
        <input type="file" name="file6">
      </div></td>
    <td class="BasicFontInBorder3">&nbsp;</td>
    <td class="BasicFontInBorder3">&nbsp;</td>
    <td class="BasicFontInBorder3"><select name="select5" id="select5">
      <option value="1">Unico</option>
      <option value="2">Renovable</option>
    </select></td>
  </tr>
  <tr>
    <td class="BasicFontInBorder3">7</td>
    <td class="BasicFontInBorder3">Constancia de Estudios </td>
    <td class="BasicFontInBorder3"><div align="center">
      <input type="checkbox" name="checkbox7" value="checkbox">
    </div></td>
    <td class="BasicFontInBorder3">
      <div align="left">
        <input type="file" name="file7">
      </div></td>
    <td class="BasicFontInBorder3">&nbsp;</td>
    <td class="BasicFontInBorder3">&nbsp;</td>
    <td class="BasicFontInBorder3"><select name="select6" id="select6">
      <option value="1">Unico</option>
      <option value="2">Renovable</option>
    </select></td>
  </tr>
  <tr>
    <td class="BasicFontInBorder3">8</td>
    <td class="BasicFontInBorder3">Numero de Afiliacion Igss </td>
    <td class="BasicFontInBorder3"><div align="center">
      <input type="checkbox" name="checkbox8" value="checkbox">
    </div></td>
    <td class="BasicFontInBorder3">
      <div align="left">
        <input type="file" name="file8">
      </div></td>
    <td class="BasicFontInBorder3">&nbsp;</td>
    <td class="BasicFontInBorder3">&nbsp;</td>
    <td class="BasicFontInBorder3"><select name="select7" id="select7">
      <option value="1">Unico</option>
      <option value="2">Renovable</option>
    </select></td>
  </tr>
  <tr>
    <td class="BasicFontInBorder3">9</td>
    <td class="BasicFontInBorder3">Num. Identificacion Tributaria </td>
    <td class="BasicFontInBorder3"><div align="center">
      <input type="checkbox" name="checkbox9" value="checkbox">
    </div></td>
    <td class="BasicFontInBorder3">
      <div align="left">
        <input type="file" name="file9">
      </div></td>
    <td class="BasicFontInBorder3">&nbsp;</td>
    <td class="BasicFontInBorder3">&nbsp;</td>
    <td class="BasicFontInBorder3"><select name="select8" id="select8">
      <option value="1">Unico</option>
      <option value="2">Renovable</option>
    </select></td>
  </tr>
</table>		  		  
		</table>
		</div>
    </div>
 
  </div>
  <p align="center">
    <input name="cmd_guardar" type="button" onClick="Validar(this.form)" id="cmd_guardar" value="Guardar Datos" >
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
