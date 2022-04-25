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
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
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
<form name="form1" id="form1" action="bbienes.php<? print "?tipo=$tipo&posi=$posi";?>">
  <p>Busqueda de Bienes
    <input type="hidden" name="tipo" id="hiddenField" value="<? print $tipo;?>">
    <input type="hidden" name="posi" id="hiddenField2" value="<? print $posi;?>">
  </p>
  <table width="95%" border="0">
    
    <tr>
      <td width="19%"><div align="left">Nombre del bien:</div></td>
      <td width="52%"><div id="Div_municipio">
        <input name="descripcion" type="text" id="textfield2" size="40" />
      </div></td>
      <td width="29%" valign="bottom"><div align="center">
        <input type="submit" name="button2" id="button2" value="Iniciar B�squeda">
      </div></td>
    </tr>
  </table>
  <?
  print "<br>";
  
       	$vec[0] = "Descripcion";
		$vec[1] = "codigo_bien";

		$vec2[0] = "descripcion";
		$vec2[1] = "codigo_bien";
	
		$vec3[0] = "width=\"90%\"";
		$vec3[1] = "width=\"10%\"";
	
		$query =" select  
						descripcion,
						codigo_bien
				 from
					tb_bien
				 where
				 	length('$descripcion') > 0 and 
					descripcion like '%$descripcion%' 
				 order by descripcion";

		getTabla($query,1,$vec,$vec2,$vec3,$dbms,95,"","","1",$tipo,$posi);
  ?>
  <p>&nbsp;</p>
  <div id="embebida" style="background-color:white;" width="100px" height="50px"></div>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</form>
</body>
</html>
