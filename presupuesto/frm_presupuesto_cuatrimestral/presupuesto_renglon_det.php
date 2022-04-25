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
		while (i<=contLin4) { 	
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


			// Creo objeto AJAX y envio peticion al servidor funciona muy bien 100%
			
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
	td.innerHTML = 	"<a href=\"javascript:void(0)\" onDblClick=\"buscar=window.open(\'../frm_buscar_renglon/buscar.php?tipo=bien&posi="+contLin4+"\',\'Buscar4\',\'width=700,height=500,menubar=no, scrollbars=yes,toolbar=no,location=no,directories=no,resizable=no,top=100,left=250\'); return false;\"><input name=\"bien["+contLin4+"][0]\" type=\"text\" value=\"\" id=\"textfield\"  alt=\"Doble clic para consultar el catalogo\" size=\"10\"></a>";
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"justificacion["+contLin4+"]\" type=\"text\" id=\"textfield\" size=\"40\" maxsize=\"100\">";

	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"cmes1["+contLin4+"]\" type=\"text\" id=\"select\" size=\"3\">";
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"cmes2["+contLin4+"]\" type=\"text\" id=\"cmes2["+contLin4+"]\" size=\"3\">";
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"cmes3["+contLin4+"]\" type=\"text\" id=\"cmes3["+contLin4+"]\" size=\"3\">";
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"cmes4["+contLin4+"]\" type=\"text\" id=\"cmes4["+contLin4+"]\" size=\"3\">";
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"dmes1["+contLin4+"]\" type=\"text\" id=\"dmes1["+contLin4+"]\" size=\"3\">";
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"dmes2["+contLin4+"]\" type=\"text\" id=\"dmes2["+contLin4+"]\" size=\"3\">";
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"dmes3["+contLin4+"]\" type=\"text\" id=\"dmes3["+contLin4+"]\" size=\"3\">";
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"dmes4["+contLin4+"]\" type=\"text\" id=\"dmes4["+contLin4+"]\" size=\"3\">";
	
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
    <th width="10" rowspan="2" scope="col"><span class="Estilo2">#</span></th>
    <th width="77" rowspan="2" scope="col"><span class="Estilo2">Rengl&oacute;n</span></th>
    <th width="524" rowspan="2" scope="col"><div align="center" class="Estilo2">Justificaci&oacute;n </div></th>
    <th height="19" colspan="4" scope="col">Comprometido</th>

  </tr>
  <tr>
    <th width="53" height="19" scope="col"><span class="Estilo2"> Mes 1</span></th>
    <th width="54" scope="col"><span class="Estilo2">Mes 2 </span></th>
    <th width="53" scope="col"><span class="Estilo2">Mes 3 </span></th>
    <th width="54" scope="col"><span class="Estilo2">Mes 4 </span></th>
  </tr>
  

  
  <?
  

  $cnt_montos=1; 
  $qry_valores="select c.codigo,a.justificacion,a.comprometido_mes1,a.comprometido_mes2,
				a.comprometido_mes3,a.comprometido_mes4, a.codigo_periodo, b.codigo_grupo,      b.codigo_presupuesto_anual
				from tb_presupuesto_det a,tb_presupuesto_anual b, cat_renglon c
				where a.codigo_presupuesto_anual = b.codigo_presupuesto_anual 
				and b.codigo_presupuesto_anual ='$id'
				and a.codigo_renglon = c.codigo_renglon
				and a.codigo_periodo = '$c'";    
  $res = mssql_query($qry_valores);

  while($vec=mssql_fetch_array($res))
  {
	  echo '<tr>';
	  
	  echo '<td align="center">';  
      echo('<input  name="codigo_presupuesto_anual['.$cnt_montos.']" type="hidden" id="codigo_presupuesto_anual['.$cnt_montos.']"  value="'.$vec[8].'"/>');
	  echo '</td>';

	  echo '<td>';
 	  echo('<input  name="codigo_renglon['.$cnt_montos.']" type="text" id="codigo_renglon['.$cnt_montos.']"  value="'.$vec[0].'"/>');
	  echo '</td>'; 	  
	  	  
	   echo '<td align="center">';  
      echo('<input  name="justifi['.$cnt_montos.']" type="text" size="40"  id="justificacion['.$cnt_montos.']"  value="'.$vec[1].'"/>');
	  echo '</td>';
	  
	   echo '<td align="center">';  
      echo('<input  name="comprometido_mes1['.$cnt_montos.']" type="text" size="3" id="comprometido_mes1['.$cnt_montos.']"  value="'.$vec[2].'"/>');
	  echo '</td>';
	  
	   echo '<td align="center">';  
      echo('<input  name="comprometido_mes2['.$cnt_montos.']" type="text" size="3" id="comprometido_mes2['.$cnt_montos.']"  value="'.$vec[3].'"/>');
	  echo '</td>';

	   echo '<td align="center">';  
      echo('<input  name="comprometido_mes3['.$cnt_montos.']" type="text" size="3" id="comprometido_mes3['.$cnt_montos.']"  value="'.$vec[4].'"/>');
	  echo '</td>';

	   echo '<td align="center">';  
      echo('<input  name="comprometido_mes4['.$cnt_montos.']" type="text" size="3" id="comprometido_mes4['.$cnt_montos.']"  value="'.$vec[5].'"/>');
	  echo '</td>';

	  echo '</tr>';
	  $cnt_montos++;
  }
  ?>
  
  
</table>
<br>
<input name="Bot&oacute;n" type="button" onClick="agregar4();" value="Agregar l&iacute;nea">
<input name="Bot&oacute;n" type="button" onClick="borrarUltima4();" value="Borrar l&iacute;nea"> 

</body>
</html>