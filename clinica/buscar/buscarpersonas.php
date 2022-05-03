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
</style>
<script language="JavaScript" type="text/javascript" src="ajax_request.js"></script>
<script type="text/javascript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  obtenVal(selObj.options[selObj.selectedIndex].value);
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
<p><a href="javascript:void(0)" onClick="window.opener.document.getElementById('nombre').value = 'hola'; window.opener.focus(); return false;">Modificar valor en ventana madre</a>: pulsando el enlace se modifica el valor del elemento <code>'formulario_poc_163'</code> al tiempo que el foco se desplaza sobre la ventana madre: </p>
<form name="form" id="form" action="buscarpersonas.php">
  Tipo de persona
  <select name="jumpMenu" id="jumpMenu" onChange="MM_jumpMenu('parent',this,0)">
    <option value="0">Seleccione</option>
    <option value="1">Individual</option>
    <option value="2">Juridico</option>
    <option value="3">Extranjero</option>
  </select>
  
  <div id="embebida" style="background-color:white;" width="100px" height="50px"></div>
  <p>&nbsp;  </p>
  <p>
    <input name="" type="button" value="Buscar">
    </p>
  <p>&nbsp;</p>
</form>
</body>
</html>