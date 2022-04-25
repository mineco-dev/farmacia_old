<?
	require("../includes/funciones.php");
	require("../includes/sqlcommand.inc");	
?>

<!DOCTYPE html>
<html>
<head>

<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!--<link href="estilos/style.css" rel="stylesheet" type="text/css" media="screen" />-->
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css">
<script language="javascript" src="calendar/calendar.js"></script>
</head>
<body>
<form name="frm_ingreso" id="frm_ingreso" action="gingreso.php" enctype="multipart/form-data" method="post"  >
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td><div class="TabbedPanelsContentGroup"> 
    <div class="TabbedPanelsContent">
      <table width="99%" border="0" align="center" cellpadding="0" cellspacing="0" class="panel">
        <tr>
          <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="4">&nbsp;</td>
        </tr>
 
        <tr>
          <td valign="top">&nbsp;</td>
          <td>Fecha,</td>
          <td colspan="2"><? echo date("d-m-Y"); ?></td>
        </tr>
        <tr>
          <td width="92" valign="top">&nbsp;</td>
          <td width="191">No. Ingreso</td>
          <td width="627" colspan="2"><input name="ingreso" type="text" id="ingreso" size="12"></td>
        </tr>
   
   <tr>
          <td valign="top">&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
        </tr>
    

  <tr>
              <td valign="top">&nbsp;</td>
               <td>Gestion</td>
               <td colspan="2">
                  <?
					conectardb($bitacora);											
					//print($almacen);
					$qry_tipo_docto="SELECT * FROM bgestion WHERE activo=1  ORDER BY nombre";										
					$res_qry_tipo_docto=$query($qry_tipo_docto);	
					echo('<select name="cbo_gestion">');
					$nombre=":: Seleccione ::";
					while($row_tipo_docto=$fetch_array($res_qry_tipo_docto))
					{
						echo'<option value="'.$row_tipo_docto["idgestion"].'">'.$row_tipo_docto["nombre"].'</option>';
					}
					echo('</select>');				
					$free_result($res_qry_tipo_docto);									 
				?>                    </td>
              </tr>
                  <tr>
          <td valign="top">&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
        </tr>
            
  
        <tr>
          <td valign="top"><div align="center"></div></td>
          <td valign="top">Unidad Ejecutora</td>
          <td colspan="2"><?
					conectardb($bitacora);											
					$qry_tipo_docto="SELECT * FROM bunidad_ejecutora WHERE activo=1 order by nombre";										
					$res_qry_tipo_docto=$query($qry_tipo_docto);	
					echo('<select name="cbo_ue">');
					$nombre=":: Seleccione ::";
				
					while($row_tipo_docto=$fetch_array($res_qry_tipo_docto))
					{
						echo'<option value="'.$row_tipo_docto["idunidad"].'">'.$row_tipo_docto["nombre"].''.$row_tipo_docto["descripcion"].'</option>';
					}
					echo('</select>');				
					$free_result($res_qry_tipo_docto);									 
				?>                    </td>
        </tr>
 <td valign="top">&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
       
        <tr>
          <td valign="top"><div align="center"></div></td>
          <td valign="top">Dependencia</td>
          <td colspan="2">
			 	 <?
					conectardb($bitacora);											
					$qry_tipo_dependencia="select * from dependencia where activo=1 order by nombre_dependencia";										
					$res_qry_tipo_dependencia=$query($qry_tipo_dependencia);	
					echo('<select name="cbo_dependencia">');
					$nombre=":: Seleccione ::";
				while($row_tipo_dependencia=$fetch_array($res_qry_tipo_dependencia))
					{
						echo'<option value="'.$row_tipo_dependencia["codigo_dependencia"].'">'.$row_tipo_dependencia["nombre_dependencia"].'</option>';
					}
					echo('</select>');				
					$free_result($res_qry_tipo_dependencia);									 
				?>			         </td>
        </tr>
 <td valign="top">&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
      <tr>
   <td valign="top">&nbsp;</td>
   <td valign="top">Solicitante</td>
	  <td colspan="2"> <a href="javascript:void(0)" onclick="buscar=window.open('busca_persona.php?tipo=nombre&posi=0','Buscar','width=650,height=525,menubar=no,scrollbars=yes,toolbar=no,location=no,directories=no,resizable=no,top=100,left=250'); return false;"><input name="nombre[0][0]" type="text" id="textfield3" value="[CLIC AQUI PARA SELECCIONAR SOLICITANTE]" size="55" disabled/>
	</a>
	  <input name="nombre[0][2]" type="hidden" id="hiddenField" size="55"/>
      <input type="hidden" name="nombre[0][1]" id="hiddenField"/>      </td>
	   </tr>
    

        <tr>
          <td valign="top">&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
        </tr>
        
        
 <tr>
              <td valign="top">&nbsp;</td>
               <td>No. de Cuenta</td>
               <td colspan="2">
                 <?
					conectardb($bitacora);											
					$qry_tipo_dependencia="select * from bcuenta  where activo =1 order by cuenta";										
					$res_qry_tipo_dependencia=$query($qry_tipo_dependencia);	
					echo('<select name="cbo_cuenta">');
					$nombre=":: Seleccione ::";
					while($row_tipo_dependencia=$fetch_array($res_qry_tipo_dependencia))
					{
						echo'<option value="'.$row_tipo_dependencia["id_cuenta"].'">'.$row_tipo_dependencia["cuenta"].'</option>';
					}
					echo('</select>');				
					$free_result($res_qry_tipo_dependencia);									 
				?>		         </td>
              </tr>
                  <tr>
          <td valign="top">&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
        </tr>
                  <tr>
                    <td valign="top">&nbsp;</td>
                    <td>No. de Cheque</td>
                    <td colspan="2"><input name="cheque" type="text" id="cheque" size="15"></td>
                  </tr>
                  <tr>
                    <td valign="top">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td colspan="2">&nbsp;</td>
                  </tr>
                  <tr>
                    <td valign="top">&nbsp;</td>
                    <td>Cantidad</td>
                    <td colspan="2"><input name="cantidad" type="number" id="cantidad" size="15"></td>
                  </tr>
                  <tr>
                    <td valign="top">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td colspan="2">&nbsp;</td>
                  </tr>
            
        <tr>
          <td width="92" valign="top">&nbsp;</td>
          <td width="191">No. Documento</td>
          <td width="627" colspan="2"><input name="ndocto" type="text" id="ndocto" size="15"></td>
        </tr>
 
        <tr>
          <td valign="top">&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          <td>Fecha de Documento:</td>
          <td colspan="2"><?
			$day = date("d");
			$month = date("m");
			$year = date("Y");
			require_once('calendar/classes/tc_calendar.php');
			$myCalendar = new tc_calendar("date1", true);
			$myCalendar->setIcon("calendar/images/iconCalendar.gif");
			$myCalendar->setDate($day, $month, $year);
			$myCalendar->writeScript();
		?>              </td>
        </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td width="92" valign="top">&nbsp;</td>
          <td width="191">No. Factura</td>
          <td width="627" colspan="2"><input name="factura" type="text" id="factura" size="12"></td>
        </tr>
   

    <tr>
          <td valign="top">&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
        </tr>
    <tr>
           <td valign="top">&nbsp;</td>
          <td>Fecha de Factura:</td>
        <td colspan="2">
                <?
			$day = date("d");
			$month = date("m");
			$year = date("Y");
			require_once('calendar/classes/tc_calendar.php');
			$myCalendar = new tc_calendar("date2", true);
			$myCalendar->setIcon("calendar/images/iconCalendar.gif");
			$myCalendar->setDate($day, $month, $year);
			$myCalendar->writeScript();
		?>
        </span></span></td>
      </tr>
      <tr>
          <td valign="top">&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
        </tr>
      <tr>
             <td valign="top">&nbsp;</td>
            <td>Proveedor</td>
            <td colspan="2"><input name="proveedor" type="text" id="Proveedor" size="50"></td>
      </tr> 
         <tr>
          <td valign="top">&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
        </tr>
       
       
         
          <td colspan="2">&nbsp;</td>
        </tr>
            <tr>
               <td valign="top">&nbsp;</td>
              <td><div align="left">Observaciones</div></td>
              <td><textarea name="observaciones" id="observaciones" cols="50" rows="5"></textarea></td>
            </tr>
      <tr>
        <tr>
          <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="4">&nbsp;</td>
        </tr>
      </table>
     
  
      </tr>
      </table>
  </td>
</tr>
</table>

<p align="center">
  <input name="cmd_guardar" type="button" onClick="validar(this.form)" id="cmd_guardar" value="Guardar hoja de ingreso" >
</p>


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
function validarEntero(numero){ 
  if ((isNaN(numero)) && (numero > 0)) { 
		alert("Solo puede ingresar numeros validos en el campo");
		return "";
  }else{ 
		return numero;
  } 
}
function validar(form)
{
//////////////////////// Encabezado ///////////////////////////////////////////////////
/*	
if ((form['txt_no'].value) == ""){alert('Escriba el n�mero de documento de ingreso'); form['txt_no'].focus();  return};	
if ((form['proveedor[0][1]'].value) == ""){alert('Seleccione el proveedor'); form['proveedor[0][1]'].focus();  return};
	if ((form['cbo_tipo_docto'].value) == "0"){alert('Seleccione el tipo de documento que respalda el ingreso'); form['cbo_tipo_docto'].focus();  return};	
	if ((form['cbo_empresa'].value) == "0"){alert('Seleccione la empresa'); form['cbo_empresa'].focus();  return};	
	if ((form['cbo_bodega'].value) == "0"){alert('Seleccione la bodega'); form['cbo_bodega'].focus();  return};	
	if ((form['cbo_actividad'].value) == "0"){alert('Seleccione el programa'); form['cbo_actividad'].focus();  return};	
	if ((form['cbo_programa'].value) == "0"){alert('Seleccione la empresa'); form['cbo_programa'].focus();  return};	
	if ((form['txt_no_serie'].value) == ""){alert('Escriba el n�mero de documento de ingreso'); form['txt_no_serie'].focus();  return};	
	if ((form['txt_no_ingreso'].value) == ""){alert('Escriba el n�mero de documento de ingreso'); form['txt_no_ingreso'].focus();  return};	*/

	if ((form['ingreso'].value) == ""){alert('Escriba el n�mero de documento de ingreso'); form['ingreso'].focus();  return};		
	if ((form['nombre[0][1]'].value) == ""){alert('Seleccione el nombre del solicitante'); form['nombre[0][1]'].focus();  return};	
	if ((form['observaciones'].value) == ""){alert('Escriba alguna observacion'); form['observaciones'].focus();  return};
	
   
	//if ((form['nombre[0][1]'].value+0) == 0){alert('Debe seleccionar un solicitante'); return};
	//if (form['actuacion'].selectedIndex == 0){alert('Debe seleccionar en que calidad actua el solicitante'); return};
//////////////////////// Detalle //////////////////////////////////////////////////////////	
	//	ban = 0; for (i=1;i<100;i++) { if (validarEntero(form['ingresado['+i+']']!="")) ban = 1; } if (ban == 0) {alert('No se acepta el ingreso de letras y comas en Cantidad recibida'); return};	
		/*ban = 0; for (i=1;i<100;i++) { if (valor(form['bien['+i+'][1]'])) ban = 1; } if (ban == 0) {alert('Falta el detalle de los productos ingresados'); return};
        ban = 0; for (i=1;i<100;i++) { if (valor(form['bien['+i+'][2]'])) ban = 1; } if (ban == 0) {alert('Falta el codigo de categoria'); return};
		ban = 0; for (i=1;i<100;i++) { if (valor(form['bien['+i+'][3]'])) ban = 1; } if (ban == 0) {alert('Falta el codigo de subcategoria'); return};
		ban = 0; for (i=1;i<100;i++) { if (valor(form['bien['+i+'][5]'])) ban = 1; } if (ban == 0) {alert('Falta el el renglon'); return};
		ban = 0; for (i=1;i<100;i++) { if (valor(form['ingresado['+i+']'])) ban = 1; } if (ban == 0) {alert('Falta las unidades ingresadas'); return};
		ban = 0; for (i=1;i<100;i++) { if (valor(form['costo_unitario['+i+']'])) ban = 1; } if (ban == 0) {alert('Falta el costo unitario'); return};
		*/

/////////////////////// FIN VALIDACIONES //////////////////////////////////////////////	
	
	if (confirm('�Esta seguro de guardar estos datos?')) form.submit();
}
</script>
</html>