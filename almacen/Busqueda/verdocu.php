<?PHP 
//require("conexion.php");




require("../../includes/funciones.php");
require("../../includes/sqlcommand.inc");	

	//$dbms=new DBMS(conectardb($almacen));	
	//$dbms->bdd=$database_cnn;
	

conectardb($almacen);

$despacho=$_GET['despacho']; 
$ingreso= $_GET['ingreso'];

if ($despacho) {

	$idsolicitud=$despacho;
   
	$Fields="select d.rowid, d.codigo_producto, p.producto, c.categoria,  d.codigo_categoria, d.codigo_subcategoria, e.solicitante, 
e.fecha_requisicion,  e.observaciones, dep.nombre, e.codigo_estatus, es.estatus, d.codigo_renglon, d.cantidad_autorizada,
d.codigo_requisicion_enc, b.bodega, e.usuario_despacho,
 d.cantidad_solicitada from tb_requisicion_det d
inner join tb_requisicion_enc e on
e.codigo_requisicion_enc = d.codigo_requisicion_enc
inner join cat_producto p on p.codigo_producto = d.codigo_producto and p.codigo_categoria = d.codigo_categoria and p.codigo_subcategoria = d.codigo_subcategoria
inner join cat_categoria c on d.codigo_categoria = c.codigo_categoria 
inner join cat_bodega b on
b.codigo_bodega = d.codigo_bodega
inner join direccion dep
on dep.iddireccion = e.codigo_dependencia
inner join cat_estatus es on
e.codigo_estatus = es.codigo_estatus
where d.codigo_requisicion_enc = '$idsolicitud'";
	
	$res_qry_producto=$query($Fields);
		while($row=$fetch_array($res_qry_producto))
		{				
			
			$codigo=$row["codigo_requisicion_enc"];
			$rowid=$row["rowid"];
			$producto=$row["producto"];
			$solicitante=$row["solicitante"];
			$categoria=$row["categoria"];
			$estatus=$row["codigo_estatus"];
			$observaciones=$row["observaciones"];
			$bodega=$row["bodega"];	
			$dependencia=$row["nombre"];
			$fecha=$row["fecha_requisicion"];	
			$codigo_producto=$row["codigo_producto"];
		
		$despacho=$row["usuario_despacho"];
		}


			//session_register("hoja_despacho");
	        $_SESSION["hoja_despacho"]=$codigo;
?>

<!DOCTYPE html>
<html>
<head>
<script src="../estados/ver/SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
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
<script LANGUAGE="JavaScript">
function Validar(form)
{
  if (form.txt_id.value == "")
  { 
  	alert("Debe de llevar un id"); 
	form.txt_id.focus(); 
	return;
  }
 
  
  function numerico(valor)
{ 
	   campo=valor.toString();
	   var nuLongitud = campo.length;
	   var i= 0;
	   var bobandera = "TRUE";
	   for(i=0;i<nuLongitud;i++)
	   {
		  switch(campo.charAt(i))
		  {
				case '1': case '2': case '3':
				case '4': case '5': case '6':
				case '7': case '8': case '9': case '0':
				bobandera = "TRUE";
				break;
				default:
				bobandera = "FALSE";				
		  } //end switch           
	   }//end for
	   if (bobandera == "FALSE") return false
	   else return true;      
}
    form.submit();
}
function Refrescar(form)
{
	form.reset();
	form.txt_producto.focus(); 
}

</script>
<SCRIPT>
function trim(s){
	s = s.replace(/\s+/gi, ''); //sacar espacios repetidos dejando solo uno
	s = s.replace(/^\s+|\s+$/gi,''); //sacar espacios blanco principio y final
	return s;
}

function verificar (form) {
	try
	{
		if (form['pregunta'].value.length == 0)
		{
			alert("Debe ingresar la descripcion de la información a solicitar");
		}else
		{
			if (confirm('¿Esta seguro de guardar estos datos?')) form.submit();
		}
	}catch (ee)	
	{
		alert("Debe ingresar la descripción de la información a solicitar");
	}
}

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
		if (window.document.form1.opnacionalidad[1].checked)
		{
		   document.getElementById("div_extranjero").style.display = "inline";
		   document.getElementById("div_nacional").style.display = "none";
		}else
		{
		   document.getElementById("div_extranjero").style.display = "none";
		   document.getElementById("div_nacional").style.display = "none";
		}
	}
}
</SCRIPT>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../HojaEstilo.css" rel="stylesheet" type="text/css" />
<link href="../estilos/style.css" rel="stylesheet" type="text/css" media="screen" />
<link href="../estados/ver/SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css">
</head>
<body>
<form name="form" method="post" action="gautorizar_producto.php">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">

<tr>
<td>
<div id="TabbedPanels1" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup">
    <li class="TabbedPanelsTab" tabindex="0"><strong>Detalles de la Requisicion</strong></li>
    </ul>
  <div class="TabbedPanelsContentGroup">
    <div class="TabbedPanelsContent">
  
     
     
      <table width="99%" cellspacing="4" class="panel">
 
       
       
       
         <tr>
          <td valign="top">&nbsp;</td>
        <td colspan="2"> <input name="txt_id" type="hidden" id="txt_id" value="<?PHP echo $codigo; ?>">   </td>
          </tr>
        
        <tr>
          <td valign="top">&nbsp;</td>
          <td bgcolor="#FEF8DE">Fecha</td>
          <td colspan="2"><?PHP print $fecha; ?></td>
          </tr>
       
        <tr>
          <td width="8" valign="top">&nbsp;</td>
          <td width="134" bgcolor="#FEF8DE">Solicitante</td>
          <td colspan="2"><?PHP print $solicitante; ?></td>
          </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          <td bgcolor="#FEF8DE">Dependencia</td>
          <td colspan="2"><?PHP print $dependencia; ?></td>
          </tr>

 <tr>
          <td valign="top">&nbsp;</td>
          <td bgcolor="#FEF8DE">Despacho</td>
          <td colspan="2"><?PHP print $despacho ?></td>
          </tr>
      
       

        <tr>
          <td valign="top">&nbsp;</td>
          <td bgcolor="#FEF8DE">Observaciones</td>
          <td colspan="2"><?PHP print $observaciones; ?></td>
          </tr>
      
          
      <tr>
             <p align="left"><a target="_blank" href="../estados/ver/rpt_despachod.php"><img src="../../images/iconos/ico_print.jpg" alt="Clic para Imprimir este documento" width="60" height="60" /></a>
            
             </tr> 
                    
     
                    
           
     
      </table>
      <div align="center"></div>
        <br>
     
          <?PHP
    
	 $consulta = mssql_query ($Fields)  or die ("Fallo en la consulta");
  
	    
   // Mostrar resultados de la consulta
    
	  $nfilas = mssql_num_rows ($consulta);
      
	  if ($nfilas > 0)
      {
         print ("<TABLE>\n");
         print ("<TR>\n");
         
		 print ("<TH>No. Req</TH>\n");
		 print ("<TH>Producto</TH>\n");
         print ("<TH>Codigo Producto</TH>\n");
		 print ("<TH>Categoria</TH>\n");
         print ("<TH>SubCategoria</TH>\n");
		
		 print ("<TH>Estado</TH>\n");
		 print ("<TH>Cantidad Solicitada</TH>\n");
		  print ("<TH>Cantidad Despachada</TH>\n");
        
		 print ("<TH>Bodega</TH>\n");
		 print ("</TR>\n");
            $cnt = 1;
		for ($i=0; $i<$nfilas; $i++)
         {
            $resultado = mssql_fetch_array ($consulta);
            print ("<TR>\n");
		     
			print ("<TD>" . $resultado['codigo_requisicion_enc'] . "</TD>\n");
			print ("<TD>" . $resultado['producto'] . "</TD>\n");
            print ("<TD>" . $resultado['codigo_producto'] . "</TD>\n");
			print ("<TD>" . $resultado['codigo_categoria'] . "</TD>\n");
            print ("<TD>" . $resultado['codigo_subcategoria'] . "</TD>\n");
			
			print ("<TD>" . $resultado['estatus'] . "</TD>\n"); 
			print ("<TD>" . $resultado['cantidad_solicitada'] . "</TD>\n");
			print ("<TD>" . $resultado['cantidad_autorizada'] . "</TD>\n");
			
		

			print ("<TD>" . $resultado['bodega'] . "</TD>\n"); 
		   $cnt++;
					
   }
	 		
		 print ("</TABLE>\n");
		 echo "<ul> </ul>";
	  
	  }
      else
         print ("No hay noticias disponibles");
    ?>    
    </div>
    </div>
</div>
</td>
</tr>       
</table>
</form>
<p>&nbsp;</p>
<script type="text/javascript">
<!--
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
//-->
</script>
</body>
</html>




<?php	



}else if($ingreso){


$idsolicitud=$ingreso;


  $Fields = "select distinct d.rowid, d.codigo_producto, p.producto, c.categoria,  d.codigo_categoria, d.codigo_subcategoria, e.solicitante, e.fecha_ingreso, 
  cast (e.observaciones as varchar(255))as observaciones, dep.nombre, d.codigo_renglon,  e.codigo_programa,  e.codigo_actividad, d.costo_unidad,
  d.precio_total, e.userfile, d.codigo_ingreso_enc,e.no_ingreso, b.bodega, prove.nombre as proveedor, prove.nit, d.cantidad_ingresada 
  from tb_ingreso_det d
  inner join tb_ingreso_enc e on
  d.codigo_ingreso_enc =e.codigo_ingreso_enc
  inner join cat_producto p on p.codigo_producto = d.codigo_producto and p.codigo_categoria = d.codigo_categoria and p.codigo_subcategoria = d.codigo_subcategoria
  inner join cat_categoria c on d.codigo_categoria = c.codigo_categoria 
  inner join cat_bodega b on b.codigo_bodega = d.codigo_bodega
  inner join direccion dep on dep.iddireccion = e.codigo_dependencia
  inner join tb_proveedor prove on prove.rowid = e.codigo_proveedor
  where e.no_ingreso = $idsolicitud";
	
	$res_qry_producto=$query($Fields);
		while($row=$fetch_array($res_qry_producto))
		{				
			
			$codigo=$row["codigo_ingreso_enc"];
			$producto=$row["producto"];
			$solicitante=$row["solicitante"];
			$categoria=$row["categoria"];
			$actividad=$row["actividad"];
			$programa=$row["programa"];
			$observaciones=$row["observaciones"];
			$bodega=$row["bodega"];	
			$dependencia=$row["nombre"];
			$userfile=$row["userfile"];	
			$fecha=$row["fecha_ingreso"];	
			$codigo_producto=$row["codigo_producto"];	
		    $proveedor=$row["proveedor"];	
			$nit=$row["nit"];	
	
		}

		   //session_register("hoja_ingreso");
	       $_SESSION["hoja_ingreso"]=$codigo;
?>

	
<!DOCTYPE html>
<html>
<head>
<script src="../ingresos_egresos/ver/SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
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
<script LANGUAGE="JavaScript">
function Validar(form)
{
  if (form.txt_id.value == "")
  { 
  	alert("Debe de llevar un id"); 
	form.txt_id.focus(); 
	return;
  }
 
  
  function numerico(valor)
{ 
	   campo=valor.toString();
	   var nuLongitud = campo.length;
	   var i= 0;
	   var bobandera = "TRUE";
	   for(i=0;i<nuLongitud;i++)
	   {
		  switch(campo.charAt(i))
		  {
				case '1': case '2': case '3':
				case '4': case '5': case '6':
				case '7': case '8': case '9': case '0':
				bobandera = "TRUE";
				break;
				default:
				bobandera = "FALSE";				
		  } //end switch           
	   }//end for
	   if (bobandera == "FALSE") return false
	   else return true;      
}
    form.submit();
}
function Refrescar(form)
{
	form.reset();
	form.txt_producto.focus(); 
}

</script>
<SCRIPT>
function trim(s){
	s = s.replace(/\s+/gi, ''); //sacar espacios repetidos dejando solo uno
	s = s.replace(/^\s+|\s+$/gi,''); //sacar espacios blanco principio y final
	return s;
}

function verificar (form) {
	try
	{
		if (form['pregunta'].value.length == 0)
		{
			alert("Debe ingresar la descripcion de la información a solicitar");
		}else
		{
			if (confirm('¿Esta seguro de guardar estos datos?')) form.submit();
		}
	}catch (ee)	
	{
		alert("Debe ingresar la descripción de la información a solicitar");
	}
}

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
		if (window.document.form1.opnacionalidad[1].checked)
		{
		   document.getElementById("div_extranjero").style.display = "inline";
		   document.getElementById("div_nacional").style.display = "none";
		}else
		{
		   document.getElementById("div_extranjero").style.display = "none";
		   document.getElementById("div_nacional").style.display = "none";
		}
	}
}
</SCRIPT>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../HojaEstilo.css" rel="stylesheet" type="text/css" />
<link href="../estilos/style.css" rel="stylesheet" type="text/css" media="screen" />
<link href="../ingresos_egresos/ver/SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css">
</head>
<body>
<!--action="gautorizar_producto.php"-->
<form name="form" method="post" >
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">

<tr>
<td>
<div id="TabbedPanels1" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup">
    <li class="TabbedPanelsTab" tabindex="0"><strong>Detalles del Ingreso</strong></li>
    </ul>
  <div class="TabbedPanelsContentGroup">
    <div class="TabbedPanelsContent">
  
     
     
      <table width="99%" cellspacing="4" class="panel">

 <?PHP

// <a href="../../documentos/'.$userfile.' "target=_blank""><img src="../imagenes/ico_ver.png" width="50" height="50"></a>
 // echo '<tr><td><center></center></td>
 // <td><center><a href="rpt_ingreso_det2.php "target=_blank""><img src="../../../images/iconos/ico_print.jpg" width="50" height="50"></a></center></td>
 // </tr>';
  echo '<tr><td><center></center></td>
 <td><center><a href="../ingresos_egresos/ver/impresionDOM.php "target=_blank""><img src="../../images/iconos/ico_print.jpg" width="50" height="50"></a></center></td>
 </tr>';
 

 ?>
 
       
       
       
         <tr>
          <td valign="top">&nbsp;</td>
        <td colspan="2"> <input name="txt_id" type="hidden" id="txt_id" value="<?PHP echo $codigo; ?>">   </td>
          </tr>
        
        <tr>
          <td valign="top">&nbsp;</td>
          <td bgcolor="#FEF8DE">Fecha</td>
          <td colspan="2"><?PHP print $fecha; ?></td>
          </tr>
       
        <tr>
          <td width="8" valign="top">&nbsp;</td>
          <td width="134" bgcolor="#FEF8DE">Solicitante</td>
          <td colspan="2"><?PHP print $solicitante; ?></td>
          </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          <td bgcolor="#FEF8DE">Dependencia</td>
          <td colspan="2"><?PHP print $dependencia; ?></td>
          </tr>
<!--  <tr>
          <td valign="top">&nbsp;</td>
          <td bgcolor="#FEF8DE">Programa</td>
          <td colspan="2"><?PHP print $programa; ?></td>
          </tr>
         
         <tr>
          <td valign="top">&nbsp;</td>
          <td bgcolor="#FEF8DE">Actividad</td>
          <td colspan="2"><?PHP print $actividad; ?></td>
          </tr> -->
       
        <tr>
          <td valign="top">&nbsp;</td>
          <td bgcolor="#FEF8DE">Proveedor</td>
          <td colspan="2"><?PHP print $proveedor; ?></td>
          </tr>
          
           <tr>
          <td valign="top">&nbsp;</td>
          <td bgcolor="#FEF8DE">Nit</td>
          <td colspan="2"><?PHP print $nit; ?></td>
          </tr>
      

        <tr>
          <td valign="top">&nbsp;</td>
          <td bgcolor="#FEF8DE">Observaciones</td>
          <td colspan="2"><?PHP print $observaciones; ?></td>
          </tr>
      
     

                    
           
     
      </table>
      <div align="center"></div>
        <br>
     
          <?PHP
    
	 $consulta = mssql_query ($Fields)  or die ("Fallo en la consulta");
  
	    
   // Mostrar resultados de la consulta
    
	 $nfilas = mssql_num_rows ($consulta);
      if ($nfilas > 0)
      {
       print ("<TABLE>\n");
       print ("<TR>\n");
       print ("<TH>No.</TH>\n");
       print ("<TH>No. Ingreso</TH>\n");
       print ("<TH>Producto</TH>\n");
       print ("<TH>Categoria</TH>\n");
       print ("<TH>Subategoria</TH>\n");
       print ("<TH>producto</TH>\n");
       print ("<TH>Renglon</TH>\n");
       print ("<TH>Cantidad Ingresada</TH>\n");
       print ("<TH>Costo Unidad</TH>\n");
       print ("<TH>Costo Total</TH>\n");
       print ("<TH>Bodega</TH>\n");
       print ("</TR>\n");

         for ($i=0; $i<$nfilas; $i++)
         {
            $resultado = mssql_fetch_array ($consulta);
            print ("<TR>\n");
            print ("<TD >" . $resultado['codigo_ingreso_enc'] . "</TD>\n");
             print ("<TD>" . $resultado['no_ingreso'] . "</TD>\n");
            print ("<TD>" . $resultado['producto'] . "</TD>\n");
            print ("<TD>" . $resultado['codigo_categoria'] . "</TD>\n");
            print ("<TD>" . $resultado['codigo_subcategoria'] . "</TD>\n");
            print ("<TD>" . $resultado['codigo_producto'] . "</TD>\n");
            print ("<TD>" . $resultado['codigo_renglon'] . "</TD>\n");
            print ("<TD>" . $resultado['cantidad_ingresada'] . "</TD>\n");
            print ("<TD>" . $resultado['costo_unidad'] . "</TD>\n");
            print ("<TD>" . $resultado['precio_total'] . "</TD>\n");
            print ("<TD>" . $resultado['bodega'] . "</TD>\n");
		 }

    print ("</TABLE>\n");
    echo "<ul> </ul>";
      }
      else
         print ("No hay datos disponibles");
    ?>
    </div>
    </div>
</div>
</td>
</tr>       
</table>
</form>
<p>&nbsp;</p>
<script type="text/javascript">
<!--
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
//-->
</script>
</body>
</html>

<?php

}

?>