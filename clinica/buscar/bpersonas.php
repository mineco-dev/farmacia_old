<?
	require('../includes/inc_header.inc');
	$dbms=new DBMS($conexion);
	$dbms->bdd=$database_cnn;
	require('../includes/funciones.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/estilos.css" rel="stylesheet" type="text/css" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<style>
.exemplo {
background-color: #EEEEEE;
margin: 10px;
padding: 10px;
height: auto;
width: auto;
border: thin dashed #666666;
} 
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
</style>
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

    element.innerHTML = '<img src="../images/loading.gif" />';

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

<script language="JavaScript" type="text/javascript" src="ajax_request.js"></script>
<script type="text/javascript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
//  var cad= <? //print "&tipo=$tipo&pos=$pos";?>;
//  alert (cad);
//  eval(targ+".location='bpersonas.php?op="+selObj.options[selObj.selectedIndex].value+"'"); 
//  obtenVal(selObj.options[selObj.selectedIndex].value);
	document.form1.submit();

}

function obtenVal(op){
	
	var urlarg = '';
	if (op > 0)
	{
	    if (op == 1) urldestino = 'individual.php?';
	    if (op == 2) urldestino = 'representantemandatario.php?';
	    ajax_request(urldestino,'embebida',true);
	}
}
//-->
</script>
</head>
<body>
<form name="form1" id="form1" action="bpersonas.php<? print "?tipo=$tipo&posi=$posi";?>">
  <table width="100%" border="0">
    <tr>
      <td bgcolor="#666666"><span class="style1">Instrucciones</span></td>
    </tr>
    <tr>
      <td>Para poder buscar a la persona tiene que seleccionar el tipo de persona que es: </td>
    </tr>
    <tr>
      <td><ul>
        <li>Individual: desplegara un formulario para que seleccione el Orden de la cedula, y luego tendra que escribir el numero de cedula y seleccionar el municipio donde fue extendida, luego de haber llenado los datos tiene que presionar sobre el boto &quot;Buscar&quot;.</li>
      </ul></td>
    </tr>
    <tr>
      <td><ul>
        <li>Juridico: desplegara un formulario para que ingrese el No. de Inscripci&oacute;n, el No. de Folio y el No. de Libro de la entidad, , luego de haber llenado los datos tiene que presionar sobre el boto &quot;Buscar&quot;.</li>
      </ul></td>
    </tr>
    <tr>
      <td><ul>
        <li>Extranjera: desplegara un formulario para que ingrese el No. de pasaporte de esta persona, luego de haber llenado los datos tiene que presionar sobre el boto &quot;Buscar&quot;.</li>
      </ul></td>
    </tr>
    <tr>
      <td>Si despues de haber llenado los datos y presionado sobre el boton &quot;Buscar&quot; no genera ningun registro a seleccionar, entonces puede ingresar los datos nuevos presionando sobre el enlace que dice &quot;<a href="../operador/apersona.php" target="_blank">Agregar nueva persona</a>&quot;</td>
    </tr>
  </table>
  <p>Tipo de persona
    <input type="hidden" name="tipo" id="hiddenField" value="<? print $tipo;?>">
    <input type="hidden" name="posi" id="hiddenField2" value="<? print $posi;?>">

    <select name="op" id="op" onChange="MM_jumpMenu('parent',this,0)">
      <option value="0">Seleccione</option>
      <option value="1"<? if (intval($op) == 1) print "selected";?>> Individual</option>
      <option value="2"<? if (intval($op) == 2) print "selected";?>>Juridico</option>
      <option value="3"<? if (intval($op) == 3) print "selected";?>>Extranjero</option>
      <option value="4"<? if (intval($op) == 4) print "selected";?>>Juridico Extranjero</option>
    </select>
  </p>
  <? if (intval($op) == 1) 
  {
  ?>
  <table width="72%" border="0">
    <tr>
      <td width="16%"><div align="center">Orden</div></td>
      <td width="22%"><div align="center">Registro</div></td>
      <td width="29%"><div align="center">Extendida en:</div></td>
      <td width="33%" valign="bottom"><div align="center"></div></td>
    </tr>
    <tr>
      <td><div align="center">
          <select name="orden" id="orden" onChange="javascript:cargarCombo('municipio.php', 'orden', 'Div_municipio')">
            <?
	  		$query = "select codigo_registro,codigo_departamento, registro from tb_registro order by registro";
			$dbms->sql=$query;
			$dbms->Query();
			print "<option value = 0>- Seleccione -</option>";
			while($Fields=$dbms->MoveNext())
			{
				print "<option value = ".$Fields["codigo_departamento"]. ">".utf8_decode($Fields["registro"])."</option>";
			}
		?>
          </select>
      </div></td>
      <td><div align="center">
          <input type="text" name="registro" id="textfield2" />
      </div></td>
      <td><div id="Div_municipio">
		  <select name="municipio"  id="select3">
		  </select>
	  </div></td>
      <td width="33%" valign="bottom"><div align="center">
        <input name="cmd_buscar" type="button"onClick="validar(this.form)" id="cmd_guardar" value="Buscar" >
      </div></td>
    </tr>
  </table>
  <?
  print "<br>";
  
       	$vec[0] = "Nombres";
		$vec[1] = "Apellidos";
		$vec[2] = "Cedula";
		$vec[3] = "Extendida en";

		$vec2[0] = "nombre";
		$vec2[1] = "apellido";
		$vec2[2] = "cedula";
		$vec2[3] = "ubica";
		$vec2[4] = "codigo_persona_individual";
	
		$vec3[0] = "width=\"25%\"";
		$vec3[1] = "width=\"25%\"";
		$vec3[2] = "width=\"10%\"";
		$vec3[3] = "width=\"35%\"";
		$vec3[4] = "width=\"15%\"";
	
		$query =" select 
						concat(p.primer_nombre,' ',p.segundo_nombre,' ',p.tercer_nombre) as nombre,
						concat(p.primer_apellido,' ',p.segundo_apellido,' ',p.apellido_casada) as apellido,
						concat(r.registro,' ',p.cedula) as cedula,
						concat(m.nombre_municipio,', ',d.nombre_departamento) as ubica,
						p.codigo_persona_individual				
				 from
					tb_persona p, tb_registro r, tb_municipio m,tb_departamento d
				 where
					p.codigo_municipio = m.codigo_municipio and
					r.codigo_departamento = d.codigo_departamento and 
					m.codigo_departamento = d.codigo_departamento and 
					r.codigo_departamento = $orden and 
					p.cedula='$registro' and 
					p.codigo_municipio = $municipio 
				 order by p.primer_apellido,p.segundo_apellido";
		//print $query;
		getTabla($query,4,$vec,$vec2,$vec3,$dbms,95,"","","1",$tipo,$posi);
  
  }
  ?>
  <? if (intval($op) == 2) 
  {
  ?>
  <table width="72%" border="0">
    <tr>
      <td width="18%"><div align="center">No. Inscripci&oacute;n</div></td>
      <td width="19%"><div align="center">Folio</div></td>
      <td width="18%"><div align="center">Libro</div></td>
      <td width="45%" valign="bottom"><div align="center"></div></td>
    </tr>
    <tr>
      <td><div align="center">
          <input type="text" name="inscripcion" id="inscripcion" />
      </div></td>
      <td><div align="center">
          <input type="text" name="folio" id="textfield" />
      </div></td>
      <td><div align="center">
          <input type="text" name="libro" id="textfield4" />
      </div></td>
      <td width="45%" valign="bottom"><div align="center">
        <input name="cmd_buscar" type="button"onClick="validar(this.form)" id="cmd_guardar" value="Buscar" >
      </div></td>
    </tr>
  </table>
  <?
  print "<br>";
  
       	$vec[0] = "Razon";
       	$vec[1] = "No. Inscripción";
		$vec[2] = "Folio";
		$vec[3] = "Libro";

		$vec2[0] = "razon";
		$vec2[1] = "inscripcion";
		$vec2[2] = "folio";
		$vec2[3] = "libro";
		$vec2[4] = "codigo_persona_individual";
	
		$vec3[0] = "width=\"25%\"";
		$vec3[1] = "width=\"25%\"";
		$vec3[2] = "width=\"10%\"";
		$vec3[3] = "width=\"35%\"";
	
		$query =" select 
						concat('Razon ',p.razon_social) as razon,
						concat('Inscripcion No ',p.inscrito_numero) as inscripcion,
						concat('Folio ',p.folio) as folio,
						concat('Libro ',p.libro) as libro,
						p.codigo_persona_individual
				 from
					tb_persona p, tb_municipio m,tb_departamento d
				 where
					p.codigo_municipio_reside = m.codigo_municipio and
					m.codigo_departamento = d.codigo_departamento and 
					p.inscrito_numero ='$inscripcion' and 
					p.folio ='$folio' and 
					p.libro ='$libro' 
				 order by p.inscrito_numero, p.folio, p.libro";
//		print $query;
		getTabla($query,4,$vec,$vec2,$vec3,$dbms,95,"","","1",$tipo,$posi);
  
  }
  ?>
  <? if (intval($op) == 3) 
  {
  ?>
  <table width="72%" border="0">
    <tr>
      <td width="17%"><div align="center"></div></td>
      <td width="22%"><div align="center"></div></td>
      <td width="33%" valign="bottom"><div align="center"></div></td>
    </tr>
    <tr>
      <td><div align="right">No. Pasaporte</div></td>
      <td><div align="center">
          <input type="text" name="pasaporte" id="textfield5" />
      </div></td>
      <td width="33%" valign="bottom"><div align="center">
        <input name="cmd_buscar" type="button"onClick="validar(this.form)" id="cmd_guardar" value="Buscar" >
      </div></td>
    </tr>
  </table>
  <?
  	print "<br>";
  
       	$vec[0] = "Nombre";
		$vec[1] = "Apellido";
		$vec[2] = "Pasaporte";

		$vec2[0] = "nombre";
		$vec2[1] = "apellido";
		$vec2[2] = "pasaporte";
		$vec2[3] = "codigo_persona_individual";
	
		$vec3[0] = "width=\"25%\"";
		$vec3[1] = "width=\"25%\"";
		$vec3[2] = "width=\"10%\"";
	
		$query =" select 
						concat(p.primer_nombre,' ',p.segundo_nombre,' ',p.tercer_nombre) as nombre,
						concat(p.primer_apellido,' ',p.segundo_apellido,' ',p.apellido_casada) as apellido,
						p.numero_pasaporte as pasaporte,
						p.codigo_persona_individual				
				 from
					tb_persona p
				 where
					length(p.numero_pasaporte) > 0 and 
					p.numero_pasaporte = '$pasaporte'  
				 order by p.primer_apellido,p.segundo_apellido";
		getTabla($query,3,$vec,$vec2,$vec3,$dbms,95,"","","1",$tipo,$posi);
  }
  ?>
  
   <? 
   //aqui empieza lo que voy a agregar para realizar una busqued por juridico extranjero
   if (intval($op) == 4) 
  {
  ?>
  <table width="72%" border="0">
    <tr>
      <td width="58%"><div align="left">Raz&oacute;n Social</div></td>
      <td width="42%" valign="bottom"><div align="center"></div></td>
    </tr>
    <tr>
      <td><div align="center">
        <input name="razonsocial" type="text" id="razonsocial" size="50" />
      </div></td>
      <td width="42%" valign="bottom"><div align="center">
        <input name="cmd_buscar" type="button"onClick="validar(this.form)" id="cmd_guardar" value="Buscar" >
      </div></td>
    </tr>
  </table>
  <?
  print "<br>";
  
       	$vec[0] = "Razon";
       	$vec[1] = "Nombre Comercial";

		$vec2[0] = "razon";
		$vec2[1] = "ncomercial";
		$vec2[2] = "codigo_persona_individual";
	
		$vec3[0] = "width=\"25%\"";
		$vec3[1] = "width=\"25%\"";
	
		$query =" select 
						p.razon_social as razon,
						p.nombre_comercial as ncomercial,
						p.codigo_persona_individual
				 from
					tb_persona p
				 where
				 	p.razon_social like '%$razonsocial%' and
					length('$razonsocial') > 0 
				 order by p.razon_social";
				 
		getTabla($query,2,$vec,$vec2,$vec3,$dbms,95,"","","1",$tipo,$posi);
  
  }
  ?>

  
  
  
  
  
  
  <p>&nbsp;</p>
  <div id="embebida" style="background-color:white;" width="100px" height="50px"></div>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</form>
</body>
<script type="text/javascript">
function valor(objeto)
{
	try {
		if ((objeto.value+0) == 0)
			return false;
		else
			return true;
	} catch(e) 
	{
		return false;
	}
}
function validar(form)
{
//////////////////////// General ///////////////////////////////////////////////////
	if (form['op'].selectedIndex == 0)
	{alert('Debe seleccionar el tipo de persona que es(Individual, Juridico, Extranjero) antes de realizar la busqueda'); return};
//////////////////////// Individual ///////////////////////////
	if (form['op'].selectedIndex == 1)
	{
		if (form['orden'].selectedIndex == 0)
		{
			alert('Debe seleccionar alg�n orden de cedula antes de continuar, ej. A-1, B-2 ...'); 
			return
		};
		if (form['registro'].value == "")
		{
			alert('Debe ingresar el número de cedula...'); 
			return
		};
	}
	
//////////////////////// juridico ///////////////////////////
	if (form['op'].selectedIndex == 2)
	{
		if (form['inscripcion'].value == "")
		{
			alert('Debe ingresar el número de inscripción de la entidad juridica...'); 
			return
		};
		if (form['folio'].value == "")
		{
			alert('Debe ingresar el número de folio de la entidad juridica...'); 
			return
		};
		if (form['libro'].value == "")
		{
			alert('Debe ingresar el número de libro de la entidad juridica...'); 
			return
		};
	}
//////////////////////// Extranjera //////////////////////////////////////////////////////
	if (form['op'].selectedIndex == 3)
	{
		if (form['pasaporte'].value == "")
		{
			alert('Debe ingresar el número de pasaporte de la persona extranjera'); 
			return
		};
	}
/////////////////////// FIN VALIDACIONES //////////////////////////////////////////////	
	form.submit();
}
</script>
</html>
