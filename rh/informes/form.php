
<? 

include('conectarse.php');
include('../includes/inc_header_sistema.inc');
function get_depe()
{
$consulta = mssql_query("select iddireccion,nombre from direccion where activo=1 order by nombre");																									
	if ($consulta)
		{while($row = mssql_fetch_row($consulta))	
			{	$opciones = $opciones."<option value = ".$row[0]. ">".$row[1]."</option>";
			}
	}
	return $opciones;
}

$p = get_depe();

function year ()

{
	
}



?> 


<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<link rel="stylesheet" type="text/css" href="view.css" media="all">
<script type="text/javascript" src="view.js"></script>


</head>
<body id="main_body" >
	
	<img id="top" src="top.png" alt="">
	<div id="form_container">
	
		<h1><a>Informes</a></h1>
		<form id="form1" class="appnitro" enctype="multipart/form-data" method="post" action="gform.php">
					<div class="form_description">
			<h2>Informes Personal por contrato</h2>
			<p></p>
		</div>						
			<ul >			
					<li id="li_4" >
		<label class="description" for="element_4">Renglón </label>
		<div>
		<select class="element select medium" id="element_4" name="element_4"> 
			<option value="" selected="selected">Seleccione</option>
<option value="1" >029</option>
<option value="2" >grupo 18</option>
		</select>
		</div> 
		</li>		<li id="li_5" >
		<label class="description" for="element_5">Dependencia </label>
		<div>
		<select class="element select medium" id="element_5" name="element_5"> 
			<option value="">Seleccione</option>
            <? print ($p); ?>
		</select>
		</div> 
		</li>		<li id="li_1" >
		<label class="description" for="element_1">Salario </label>
		<span class="symbol">Q</span>
		<span>
			<input id="element_1_1" name="element_1_1" class="element text currency" size="10" value="" type="text" />		
			<label for="element_1_1">Quetzales</label>
		</span>		
		 
		</li>		<li id="li_6" >
		<label class="description" for="element_6">Mes </label>
		<div>
		<select class="element select medium" id="element_6" name="element_6"> 
			<option value="" selected="selected">Seleccione</option>
<option value="1" >Enero</option>
<option value="2" >Febrero</option>
<option value="3" >Marzo</option>
<option value="4" >Abril</option>
<option value="5" >Mayo</option>
<option value="6" >Junio</option>
<option value="7" >Julio</option>
<option value="8" >Agosto</option>
<option value="9" >Septiembre</option>
<option value="10" >Octubre</option>
<option value="11" >Noviembre</option>
<option value="12" >Diciembre</option>

		</select>
		</div> 
		</li>		<li id="li_7" >
		<label class="description" for="element_7">Año</label>
		<div>
		<select class="element select medium" id="element_7" name="element_7"> 
			<option value="" selected="selected">Seleccione</option>
<option value="1" >2014</option>


		</select>
		</div> 
		</li>		<li id="li_2" >
		<label class="description" for="element_2">Nombre </label>
		<span>
			<input id="element_2_1" name= "element_2_1" class="element text" maxlength="255" size="18" value=""/>
			<label>Nombre</label>
		</span>
		<span>
			<input id="element_2_2" name= "element_2_2" class="element text" maxlength="255" size="18" value=""/>
			<label>Apellidos</label>
		</span> 
		</li>		<li id="li_3" >
		<label class="description" for="element_3">Informe </label>
		<div>
			<input id="element_3" name="element_3" class="element file" type="file"/> 
		</div>  
		</li>
			
					<li class="buttons">
			    <input type="hidden" name="form_id" value="1" />
			    
				<input id="saveForm" class="button_text" type="submit" name="submit" value="Submit" />
		</li>
			</ul>
		</form>	
		<div id="footer">
			-informatica 2014-
		</div>
	</div>
	<img id="bottom" src="bottom.png" alt="">
	</body>
</html>