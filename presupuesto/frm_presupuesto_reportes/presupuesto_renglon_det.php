<?
	
	conectardb($presupuesto);
	session_unregister("egreso");
	session_register("ingreso");
	$_SESSION["ingreso"]=true;
?>
<html>
<head>


<script>

function nuevoAjax()
{ 	
	var xmlhttp=false; 
	try 
	{ 
			xmlhttp=new ActiveXObject("Msxml2.XMLHTTP"); 
	}
	catch(e)
	{ 
		try
		{ 		
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); 
		} 
		catch(E) { xmlhttp=false; }
	}
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') { xmlhttp=new XMLHttpRequest(); } 
	
	return xmlhttp; 
} 



function cargaDatos(form)
{

var monitor = contLin4-1;


		function valor(objeto)
		{
			try {if ((objeto.value+0) == 0)return false;
			else
			return true;} catch(e) 
			{ return false;}
		}

		function a_entero(valor){  
		   valor = parseInt(valor.value);  
			if (isNaN(valor)) {  
				  return 0;  
			}else{  
				  return valor;  
			}  
		}  		
		


if (monitor > 1)
{
	
		saldo_valido = document.all.saldo_comparativo.value;
		acumulador1 = 0;
		acumulador2 = 0;
		acumulador3 = 0;
		acumulador4 = 0;
		

		var i = 1;
		while (i<contLin4) { 	
				/*setValue = 0;
				if (valor(form['cmes1['+i+']'])) setValue = 1; 	 	
					if (setValue == 0) {
						alert('Debe seleccionar por lo menos una Cantidad Valida'); 
						return;
				}*/
				acumulador1 = acumulador1 + a_entero(form['cmes1['+i+']']);
				acumulador2 = acumulador2 + a_entero(form['cmes2['+i+']']);
				acumulador3 = acumulador3 + a_entero(form['cmes3['+i+']']);
				acumulador4 = acumulador4 + a_entero(form['cmes4['+i+']']);

				i++;			
			}
			

			suma_acumulador = acumulador1+acumulador2+acumulador3+acumulador4;
			
			if (suma_acumulador>saldo_valido)
			{
				alert("La suma total de renglones es = "+suma_acumulador);
				alert('ALERTA Se ha sobrepasado el limite de saldo disponible para este grupo!!!');
			}

		function a_entero(valor){  
				valor = parseInt(valor.value);  
				if (isNaN(valor)) {  
				   return 0;  
				}else{  
				  return valor;  
				}  
		}  					
	
		txt_codigo_presupuesto_anual_campo = document.all.txt_codigo_presupuesto_anual.value;
		txt_codigo_periodo_campo = document.all.txt_codigo_periodo.value;		
			
		bien=String(form['bien['+valores+'][0]'].value);
		justificacion = String(form['justificacion['+valores+']'].value);
		cmes1=a_entero(form['cmes1['+valores+']']);
		cmes2=a_entero(form['cmes2['+valores+']']);
		cmes3=a_entero(form['cmes3['+valores+']']);
		cmes4=a_entero(form['cmes4['+valores+']']);
		dmes1=a_entero(form['dmes1['+valores+']']);
		dmes2=a_entero(form['dmes2['+valores+']']);
		dmes3=a_entero(form['dmes3['+valores+']']);
		dmes4=a_entero(form['dmes4['+valores+']']);


			// Creo objeto AJAX y envio peticion al servidor
			var ajax=nuevoAjax();
			ajax.open("GET", "gppto_renglon1.php?bien="+bien+"&justificacion="+justificacion+"&cmes1="+cmes1+"&cmes2="+cmes2+"&cmes3="+cmes3+"&cmes4="+cmes4+"&dmes1="+dmes1+"&dmes2="+dmes2+"&dmes3="+dmes3+"&dmes4="+dmes4+"&txtcodigoppto="+txt_codigo_presupuesto_anual_campo+"&txtperiodocampo="+txt_codigo_periodo_campo, true);
			ajax.send(null);
			
		valores++;	
 }	
}


function desCargaDatos(form)
{

var monitor = contLin4-1;


		if (monitor >= 1)
		{
		alert(monitor);
					// Creo objeto AJAX y envio peticion al servidor
					var valor = 0;
					var ajax=nuevoAjax();
					ajax.open("GET", "gppto_renglon2.php?valor"+valor, true);
					ajax.send(null);			
		}
 
 	
}

</script>


<?
echo '<script>
var contLin4 = 1;
var valores = 1;
function agregar4() {
	var tr, td;

	tr = document.all.tabla4.insertRow();
	td = tr.insertCell();
	td.innerHTML = contLin4 +"";	
		

	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"mes1["+contLin4+"][0]\" type=\"text\" id=\"textfield\" size=\"40\" maxsize=\"100\">";

	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"mes1["+contLin4+"][1]\" type=\"text\" id=\"select\" size=\"10\">";
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"mes1["+contLin4+"][2]\" type=\"text\" id=\"select\" size=\"10\">";
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"mes1["+contLin4+"][3]\" type=\"text\" id=\"select\" size=\"10\">";
					
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
</script>';
?>
<style type="text/css">
<!--
.Estilo2 {font-size: x-small}
-->
</style>
</head>
<body>
<table width="100%" border=1 cellspacing="0" id="tabla4">
  <tr>
    <th width="10" >#</th>
    <th width="77">Proveedor</th>
    <th height="19" width="77" >No.Orden/CUR</th>
    <th width="77">Fecha</th>
    <th width="77">Devengado</th>
  </tr>
  
  <?
  	$query_ejecucion = "select codigo_ejecucion_presupuesto,
	proveedor,no_orden,fecha,devengado,codigo_mes,codigo_ejecucion_presupuesto 	
	from tb_ejecucion_presupuesto where codigo_financiamiento_actividad = '$id' and
	codigo_presupuesto_anual = '$pr' and
	codigo_periodo = '$c'";
	
	

	
	$consulta_ejecucion = mssql_query($query_ejecucion);	

	// darle unique a codigo_mes;
	
	
	if ($consulta_ejecucion)
	{	
	$cnt = 1;			
		while($vector_ejecucion = mssql_fetch_row($consulta_ejecucion))
		{
		
		print '<tr>';
	print '<th width="10">'.$vector_ejecucion[0].'</th>';
	print '<th width="77"><input name="'.$umes1[$cnt][1].'" value="'.$vector_ejecucion[1].'" type="text" ></th>';
	print '<th width="17"><input name="'.$umes1[$cnt][2].'" value="'.$vector_ejecucion[2].'" type="text" ></th>';
	print '<th width="77"><input name="'.$umes1[$cnt][3].'" value="'.$vector_ejecucion[3].'" type="text" ></th>';
	print '<th width="77"><input name="'.$umes1[$cnt][4].'" value="'.$vector_ejecucion[4].'" type="text" ></th>';
	print '<input name="'.$umes1[$cnt][0].'" value="'.$vector_ejecucion[0].'" type="hidden" >';
	print '</tr>';

		$cnt++;
		}
		
	}
	
  ?>
  
  
  
</table>
<br>
<input name="Bot&oacute;n" type="button" onClick="agregar4();" value="Agregar l&iacute;nea">
<input name="Bot&oacute;n" type="button" onClick="borrarUltima4();" value="Borrar l&iacute;nea"> 

</body>
</html>