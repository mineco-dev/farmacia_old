<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

	<!-- <link rel="pingback" href="inove/xmlrpc.php" />
	<!-- style START -->
	<!-- default style -- <style type="text/css" media="screen">@import url(inove/style.css );</style>>	
	<!-- for translations -->
	<!--[if IE]>
	<link rel="stylesheet" href="http://www.rpsc.gob.gt/wp/wp-content/themes/inove/ie.css" type="text/css" 	media="screen" />
	<![endif]-->
	<!-- style END -->
	<!-- script START -->
	<script type="text/javascript" src="inove/js/base.js"></script>	
	<script type="text/javascript" src="inove/js/menu.js"></script>
	<!-- script END -->

<style >

/*body {	
	color:#555;
	font-family:Verdana,Helvetica,Sans-serif;
	font-size:9px;
}*/


{margin:15px ; padding:15px ; border: 0px;} 

body {color:#555;
	font-family:Verdana,Helvetica,Sans-serif;
	font-size:9px;
} 

#global {
			width:900px ; 
			margin: 4px auto ; 
			float: left 
		} 

#cabecera {
			background-color: white; 
			width:910px; 
		  } 

#navegacion {background-color: gray } 

#contenido { width: 900px ; float:left; background-color: #ffffff; 
margin-bottom:1px;
border: 1px solid #000000;
padding: 0;
} 

#menu {background-color: black; width: 400px ; float:left; text-align:left; background-color: black; 
margin-bottom:1px;
border: 1px solid #000000;
padding: 0;
font-family: Verdana, Arial, Helvetica, sans-serif;
color:white;


} 

#vis {background-color: white; width: 450px ; float:left; text-align:left; background-color: black; 
margin-bottom:1px;
border: 1px solid #000000;
padding: 0;
font-family: Verdana, Arial, Helvetica, sans-serif;
color:gray;
height:30;



} 


#menu li {list-style:none } 

#pie { 
height:120px;
background-color: #ffffff repeat-y; 
border: 1px solid #cccccc; 
margin-right:2px;
padding: 0;
}


div#tabla{
float:justify;
width: 900px;
height:800px;
background-color: #ffffff; 
border: 0px solid #cccccc; 
margin-right:2px;
padding: 0;
}


div#tabla_apartado{
float:left;
width: 500;
height:240px;
background-color: #ffffff; 
margin-bottom:1px;
border: 1px solid #5b4cf4;
padding: 0;
}

div#tabla_apartado2{
float:right;
width: 490px;
height:240px;
background-color: #ffffff; 
margin-bottom:1px;
border: 1px solid #5b4cf4;
padding: 0;
}

div#tabla_footer{
float:center;
width: 600px;
height:100px;
background-color: #ffffff; 
margin-bottom:1px;
border: 1px solid #000000;
padding: 0;
}

.style1 {font-size: 12px}
.style2 {font-size: 10px}
</style>


<script>
function cargar()
{

var x = window.document.form1.modificar[0].value;

//alert(x);

if (window.document.form1.modificar[0].checked)
{
	window.document.form1.actualizar.disabled = false;
//	window.document.form1.cmd_cantidad.disabled = false;
	}else{
			window.document.form1.actualizar.disabled = true;
	}
/*if(window.document.form1.modificar[0].checked)	
{
	window.document.form1.cmd_cantidad.disabled = false;
	}*/

}
</script>



<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>

<? 

include('../includes/inc_header_sistema.inc');
	
$consulta = mssql_query("select a.idasesor,a.nombre+' '+a.nombre2+' '+a.apellido+' '+a.apellido2 as nombre from asesor a");																									
	
		$carpeta_notas = "fotos/".$num_gafete."/notas";

		if(!is_dir($carpeta_notas)){
			@mkdir($carpeta_notas, 0700);			
		}	
	
function anotacion($codpersona)
{	
		
	$value = "select gafete from asesor where idasesor = '$codpersona'";
	$gaf = mssql_query($value);
	$gafete = mssql_fetch_array($gaf);
	
							
		$qry_insertar_notas ="select x.id_observaciones, y.observacion, x.observacion, x.adjunto,convert(varchar(10),x.fecha,21) from tb_observaciones x,
 tb_observacion y where x.tipo_observacion = y.codigo_observacion and x.idasesor = '$codpersona'";
		$result = mssql_query($qry_insertar_notas);	
					$cnt = 1;
					while ($vec = mssql_fetch_array($result))
					{	
					
					
		 					  print '';
		  					  print"<tr> ";
  							  print "<input type='hidden' name='cuenta[".$cnt."]'/>";
							  print"<input name='masterkey[".$cnt."]' type='hidden' value=".$vec[0].">";
							  print"<input name='mllave[".$cnt."]' type='hidden' value=".$vec[0].">";
							  print"<TD width='120'><span class='style9'>$vec[1]</span></TD>";
  							  print"<TD width='200'><span class='style9'><input type='text' name='finput[".$cnt."]' value=".$vec[4]." size = '10'> 
							  <script language='JavaScript'>
	new tcal ({
		'formname': 'form1',
		'controlname': 'finput[".$cnt."]'
	});

	</script> </span></TD>";							  
							  print"<TD width='350'><span class='style9'>$vec[2]</span></TD>";							  						  							
							  print "<td width='110'> <a href='fotos/".$gafete[0]."/notas/".$vec[3]."' target = '_blank'>ver</a></td>";
							  print "<td width='110'> <input type='file' name='nfiles".$cnt."' />";
							  print"<TD width='70'><span class='style9'><input type='checkbox' name='checkbox_notas[".$cnt."]' id='checkbox_notas[".$cnt."]'/></span></TD>";							
							  print"</tr>";		 																				
					
						
					
						
						$cnt ++;
					}
					
						
		}

	
	
	
function fun1($codpersona)
{	
	print '<table width="400" border="0" align="left" cellpadding="0" cellspacing="0">';		
	$value = "select gafete from asesor where idasesor = '$codpersona'";
	$gaf = mssql_query($value);
	$gafete = mssql_fetch_array($gaf);
	
							
		$qry_insertar_notas ="select x.id_observaciones, y.observacion, x.observacion, x.adjunto,convert(varchar(10),x.fecha,21) from tb_observaciones x,
tb_observacion y where x.tipo_observacion = y.codigo_observacion and x.idasesor = '$codpersona'";
		$result = mssql_query($qry_insertar_notas);	
					$cnt = 1;
					while ($vec = mssql_fetch_array($result))
					{										
		 					  print '';
		  					  print"<tr> ";
  							  print"<input type='hidden' name='cuenta[".$cnt."]'/>";
							  print"<input name='masterkey[".$cnt."]' type='hidden' value=".$vec[0].">";
							  print"<input name='mllave[".$cnt."]' type='hidden' value=".$vec[0].">";
							  print"<TD width='180'>$vec[1]</span></TD>";
  							  print"<TD width='120'>$vec[4]</TD>";							  
							  print"<TD width='220'>$vec[2]</span></TD>";							  						  							
							/*  print "<td width='110'> <a href='fotos/".$gafete[0]."/notas/".$vec[3]."' target = '_blank'>ver</a></td>";*/
							 /* print "<td width='110'> <input type='file' name='nfiles".$cnt."' />";
							  print"<TD width='70'><span class='style9'><input type='checkbox' name='checkbox_notas[".$cnt."]' id='checkbox_notas[".$cnt."]'/></span></TD>";*/
							  print"</tr>";		 																				
						$cnt ++;
					}
					
						
		}


print '</table>';

 ?>

<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<link href="../includes/estilos.css" rel="stylesheet" type="text/css" />
<link href="../css/cssWeb.css" type=text/css rel=StyleSheet>
</head>

<body>

<form name="form1" id="form1" action="" method="post" enctype="multipart/form-data">





<table width="90%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" class="cuadritoGris">
  <tr>
    <td width="43%" class="fondo_gris style1"><span class="style2">Control de Vacaciones</span>  </td>
  </tr>
  
  <tr>
    <td><p>&nbsp;
      </p>
      <p>
        <select name="empleado" id="empleado">
          <?
		while ($vec = mssql_fetch_row($consulta)) 	
		{
			print '<option value="'.$vec[0].'">'.$vec[1].'</option>';
		}
	?>
          </select>
        <input name="guardar" type="submit" class="fondo_gris" id="guardar" value="Seleccionar Empleado">
    &nbsp;</p></td>
  </tr>
</table>


<p>&nbsp;</p>

<div id="global">
<div id="cabecera">

<div  id="vis">Permisos Asignados</div>
<div id="vis">Periodo Vacacional </div>

</div> 
<div id="navegacion"><span class="style8">

              <div align="right">
                <input name="modificar" id="modificar1" type="radio" value="1" onClick="cargar();"/>
              SI<span class="Estilo22">
              <input name="modificar" id="modificar2" type="radio" value="2" onClick="cargar();" /> 
              NO
              </span> 
              <input name="actualizar" type="submit"  class="TuringHelp" id="actualizar" value="ACTUALIZAR DATOS" disabled >
              </div>
</div> 
<div id="contenido"> 
<div id="menu"> 

<? fun1($empleado);  ?>

</div> 

<div id="menu"> 

<? include("vacaciones.php"); ?>


</div> 



</div> 

<div id="pie">

		<? include("permisos.php");?>

</div>



 
</div> 









</body>

</form>

</html>




