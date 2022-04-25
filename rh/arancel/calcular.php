<?


require "conversor.php";

?>


<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
<!--
body {
	background-image: url(FONDO1.JPG);
	font-family: Tahoma, Geneva, sans-serif;
}
.Estilo2 {font-family: Arial, Helvetica, sans-serif; font-weight: bold; color: #FFFFFF; }
-->

.yep{
	width: 450px;
	margin: 50px auto;
	text-align: center;
}
h1{
	margin: 20px 0;
	color: #60bf8f;
	font: normal 28px Georgia, serif;
}
h2{
	margin: 20px 0;
	color: #60bf8f;
	font: normal 22px Georgia, serif;
}
p{
	float: left;
	display: inline;
	width: 180px;
	margin: 20px;
	text-align: left;
}
label{
	color: #797774;
	display: block;
	font-size: 12px;
	font-weight: bold;
	margin: 8px 0 3px 0;
}
dl,dt,dd,ul,li{
	margin: 0;
	padding: 0;
	list-style: none;
}
ul{
	clear: both;
}
li{
	font-size: 10px;
}
li a{
	color: #004a7f;
	text-decoration: none;
}
li a:hover{
	color: #328dcf;
	border-bottom: 1px solid #328dcf;
}
dl{
	font-size: 12px;
	text-align: left;
}
dt, dd.default{
	font-family: monaco, "Bitstream Vera Sans Mono", "Courier New", courier, monospace;
	font-weight: bold;
}
dt{
	clear: left;
	float: left;
	width: 140px;
	padding: 5px;
	text-align: right;
}
dd{
	margin: 5px 0 30px 160px;
	padding: 5px;
}
.default{
	margin: 0 0 0 160px;
	background: #eee;
}
.dp_selected{
	color: #fff;
	background: #328dcf;
}
.style25 {width: 450px; margin: 50px auto; text-align: center; font-size: 12px; color: #CCCCCC; }
.style28 {color: #666666}
</style>



<script type="text/javascript">
 /*               
function handleEnter (field, event) {
		var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
		if (keyCode == 13) {
			var i;
			for (i = 0; i < field.form.elements.length; i++)
				if (field == field.form.elements[i])
					break;
						i = (i + 1) % field.form.elements.length;
						field.form.elements[i].focus();
			return false;
		} 
		else
		return true;
	}      

function formCheck(formobj){

	var fieldRequired = Array("id_recibo","deposito","consumidor","cantidad");

	var fieldDescription = Array("Numero de Recibo","Numero de deposito","Nombre del Consumidor","Cantidad");

	var alertMsg = "Porfavor llene los siguientes campos:\n";
	
	var l_Msg = alertMsg.length;
	
	for (var i = 0; i < fieldRequired.length; i++){
		var obj = formobj.elements[fieldRequired[i]];
		if (obj){
			switch(obj.type){
			case "select-one":
				if (obj.selectedIndex == -1 || obj.options[obj.selectedIndex].text == ""){
					alertMsg += " - " + fieldDescription[i] + "\n";
				}
				break;
			case "select-multiple":
				if (obj.selectedIndex == -1){
					alertMsg += " - " + fieldDescription[i] + "\n";
				}
				break;
			case "text":
			case "textarea":
				if (obj.value == "" || obj.value == null){
					alertMsg += " - " + fieldDescription[i] + "\n";
				}
				break;
			default:
			}
			if (obj.type == undefined){
				var blnchecked = false;
				for (var j = 0; j < obj.length; j++){
					if (obj[j].checked){
						blnchecked = true;
					}
				}
				if (!blnchecked){
					alertMsg += " - " + fieldDescription[i] + "\n";
				}
			}
		}
	}

	if (alertMsg.length == l_Msg){
		return true;
	}else{
		alert(alertMsg);
		return false;
	}
}
*/
</script>

</head>

<body>
<html>
<form action="<?=$_SERVER['PHP_SELF'];?>">
<table width="855" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td width="845" bgcolor="#FFFFFF"><div align="left">
        </div>        
      </td>
    </tr>
<tr>
      <td height="247" bgcolor="#FFFFFF"><TABLE width="100%" border="0" align="center" cellpadding="0" cellspacing="2" bordercolor="#666666">
        <TR bgcolor="#FFDAA5">
          <TD height="21" colspan="2" bgcolor="#FFFFFF">&nbsp;</TD>
          </TR>
        <TR bgcolor="#CCCCCC">
          <TD height="19" colspan="2" bgcolor="#FFFFFF"><span class="yep">Calculo del Arancel para pagos del Registro de Garantias Mobiliarias </span></TD>
          </TR>
        <TR bgcolor="#FFDAA5">
          <TD height="2" colspan="2" bgcolor="#FFFFFF"><hr></TD>
          </TR>
        <TR bgcolor="#FFDAA5">
          <TD height="28" bgcolor="#FFFFFF">&nbsp;</TD>
          <TD bgcolor="#FFFFFF">&nbsp;</TD>
        </TR>
        <TR bgcolor="#FFDAA5">
          <TD width="169" height="23" bordercolor="#999999" bgcolor="#000000"><span class="style25">Seleccione Tipo de Servicio :</span></TD>
          <TD width="686" bordercolor="#999999" bgcolor="#FFFFFF"><div align="left"><span class="style28">
            <select name="id_rubro" size="1" id="descripcion">
              <?
		/* aca hace la insercion de la informacion dependiendo de los resultados asi sera 
	   el mensaje que se despliegue */  
    if (!($link=mysql_connect("localhost","",""))) 
   { 
      echo "Error conectando a la base de datos."; 
      exit(); 
   } 
   if (!mysql_select_db("rgm",$link)) 
   { 
      echo "Error seleccionando la base de datos."; 
      exit(); 
   } 
 	   $result=mysql_query("select id_rubro,descripcion from rubro",$link); 
		if ($result) // verifica si la base de datos dejo hacer la insercion
		{
		/* Insercion con exito*/		
			while ($row = mysql_fetch_row($result))
			{
				print "<option value='$row[0]'>$row[1]</option>";
			}
		} else {
			/* Error en la insercion*/
			print "<p class='Estilo1'>No se pudo insertar la inforci&oacute;n !!!ERROR!!</p>";
		}			
		mysql_close($link);
?>
            </select>
  &nbsp;</span></div></TD>
        </TR>
        
        <TR bgcolor="#FFDAA5">
          <TD height="22" bordercolor="#999999" bgcolor="#000000"><span class="style25">Cantidad de la Garantia:</span></TD>
          <TD bordercolor="#999999" bgcolor="#FFFFFF"><INPUT NAME="cantidad" TYPE="text" SIZE="15" MAXLENGTH="15" value="0.00"></TD>
        </TR>
        <TR bgcolor="#FFDAA5">
          <TD height="26" colspan="2" bgcolor="#FFFFFF">&nbsp;</TD>
          </TR>
        <TR>
          <TD height="28" colspan="2"><input name="btnInsertar"type="submit" class="dp_selected"id="btnInsertar" value="Calcular Arancel">
            <input name="btnLImpiar" type="reset" class="dp_selected" id="btnLImpiar" value="Reintentar"></TD>
        </TR>
        <TR>
          <TD height="28" colspan="2">
		  <?
		  
		
		  
		  if (!($link=mysql_connect("localhost","",""))) 
   { 
      echo "Error conectando a la base de datos."; 
      exit(); 
   } 
   if (!mysql_select_db("rgm",$link)) 
   { 
      echo "Error seleccionando la base de datos."; 
      exit(); 
   } 
 	   $result=mysql_query("select id_rubro,descripcion,valor from rubro where id_rubro = '$id_rubro'",$link); 
		if ($result) // verifica si la base de datos dejo hacer la insercion
		{
		
		
			$row=mysql_fetch_row($result);
			$motivo = $row[1];
			$valorarancelario = $row[2];
			$id_rubro = $row[0];
			$importe = 0.00;
			
			if ($id_rubro == 1)
			{
				if ($cantidad > 9000)
				{
					$aumentado = round(($cantidad - 9000)/1000);
					$pagar = $valorarancelario + ($aumentado * 1.50);
					$resultado = convertir($pagar);
				}else{
					$resultado  = convertir($valorarancelario);	
				}
			}
			
			if($id_rubro>1)
			{
				$resultado  = convertir($valorarancelario);
			}
			
			if ($resultado)
			{	
					
					print "</br>";
					print "<span class = 'style28'>Servicio: </span>";
					print "<span class = 'style28'>".$motivo."</span>";
					print "</br>";
					print "<span class = 'style28'>Cantidad de la Garantia:  Q.</span> ";
//					print "</br>";
					print "<span class = 'style28'>".$cantidad."</span>";
					print "</br>";
					print "<span class = 'style28'>El valor del arancel correspodiente: Q.</span> ";
					//print "</br>";
					print "<span class = 'style28'>".$valorarancelario."</span>";
					print "</br>";
					print "<span class = 'style28'>El Importe Arancelario a Pagar es de: Q.</span>";
					if ($id_rubro ==1)
					{
							print "<span class = 'style28'>".$pagar."</span>";
					}else{
							print "<span class = 'style28'>".$valorarancelario."</span>";
					}

					print "</br>";
					print "<span class = 'style28'>En letras: </span>";
					print "</br>";					
					print "<span class = 'style28'>".$resultado."</span>";
					print "</br>";
					//print "En Numeros: ";
					//print "Q. ".$resultado;
					print "</br>";
					if ($id_rubro == 8)
					{
						print "Se cobraran Q 5.00 por Hoja Adicional a la Certificacion"; 
					}
					if ($id_rubro == 9)
					{
						print "Se cobraran Q 2.00 por Hoja Adicional a la Consulta Electronica"; 
					}
					print "</br>";
					print "<span class = 'style28'>Gracias por utilizar este servicio</span";
			}
		/* Insercion con exito*/		
			/*while ($row = mysql_fetch_row($result))
			{
				//print "<option value='$row[0]'>$row[1]</option>";
  			  $importe = $row[2] * $cantidad;
			*/
		} else {
			/* Error en la insercion*/
			print "<p class='Estilo1'>No se pudo insertar la inforci&oacute;n !!!ERROR!!</p>";
		}			
		mysql_close($link);
		
			  
		  ?>		  </TD>
        </TR>
        <TR>
          <TD height="28" colspan="2">&nbsp;</TD>
          </TR>
        </TABLE>
      <div align="center"></div></td>
    </tr>
  </table>
  <div align="center">  </div>
</FORM> 


<p>&nbsp;</p>
</body> 
</html> 