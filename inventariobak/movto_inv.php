<?
session_start();
include('conectarse.php');
$_SESSION['nivel']=1;
$query = 'mssql_query';

/*if  (( !$_SESSION['usr_val']) || ($_SESSION['usr_val'] == 'N') || ($_SESSION['usr_val'] == '') )
		{
		//envia_msg('2-'.$_SESSION['nivel']);
		 if ($_SESSION['nivel'] == 1)
			{
			 cambiar_ventana('mtlogin.php');
			}
		if ($_SESSION['nivel'] == 4)
			{
			 cambiar_ventana('../mtlogin.php');
			}

		  if ($_SESSION['nivel'] == 2)
			{
			 cambiar_ventana('../../mtlogin.php');
			}
		 if ($_SESSION['nivel'] == 3)
			{
			 cambiar_ventana('../../../mtlogin.php');
			}
		}*/

/*	if ( $sstipo != 1)
	{
	 cambiar_ventana('mtlogin.php');
	}*/

	include('INCLUDES/inc_header.inc');
	$dbms=new DBMS($conexion); 
	
/* esta funcion se utiliza para poder recuperar la descripcion de catalogos necesarios para colocarlo en la tabla de concatenacion de valores si son modificados*/	
 function valor_registro($param_field,$param_table,$param_cond,$val_cond)
  {
 	$sql= "select $param_field from $param_table where $param_cond = '$val_cond'";
//	echo $sql;
	$result = mssql_query($sql);
	while ($row = mssql_fetch_array($result))
	  {   
	    return($row[0]);
	  }
  }
/* termina la funcion de recuperacion de descripcion de catalogos...*/


 if ( isset($_POST['inserta']) && ($_POST['inserta'] == 1) ) 
	{
   $crea_registro =0;
   $usr = $_SESSION['idempleado'];
   $und_ant = $_SESSION['id_ubicacion_fisica'];
   $existe = 0;
			 		$consulta_r = "EXEC proc_add_bitacora_inventario_empleado
								@v_inventario ='$_POST[idi]', 
								@v_empleado = '$_POST[id_asesor]', 
								@v_empleado_old = '$_POST[id_asesor_old]', 
								@v_descripcion = '$_POST[descripcion]', 
								@v_unidad_anterior ='$und_ant',
								@v_unidad_actual ='$_POST[id_direccion_new]',
								@v_codigo_usuario_creo ='$usr'";
//					echo $consulta_r."<br>";							
						$result_r=mssql_query($consulta_r);	
						session_write_close();
						$crea_registro = 1;

/*				$sql= "update m_inventario set id_anio_reg_it = '$_POST[anio_reg_it_new]',
						id_institucion_reg_it = '$_POST[insti_reg_it_new]',
						id_registro_informatica = '$_POST[reg_it_new]'
						where id_inventario = '$_POST[idi]'";
//echo $sql.'<br>';
				$result =mssql_query($sql);
				$result = mssql_query($sql);
				$rsRows = mssql_query("select @@rowcount as rows");
				$rows = mssql_fetch_assoc($rsRows); 
				if ( $rows['rows'] == 1 )
				 {*/
					envia_msg('Se actualiz� exitosamente el registro');	
					cambiar_ventana('consulta.php');

/*				 }	
				else
				 {
					envia_msg('No se pudo actualizar el registro');	
				 }*/
		
	} // fin del if  if ( isset($_POST['inserta']) && ($_POST['inserta'] == 1) ) 

?>

<script language="JavaScript">
	function Verifica()
	 {
		

//		if (form1.nombre.value == "" || form1.apellido.value == "" || form1.idregistro.value == "" || form1.cedula.value == "" || form1.iddepartamento.value == "" || form1.usuario.value = "" || form1.password.value == "" || form1.iddepartamento2 == value ""  )
		if (form1.id_asesor.value == "" || form1.descripcion.value == "" )
			{
				alert('Por favor llene los campos requeridos **');
				return false
			}
		}
 
/* 	function Deshabilita()
	 {
      alert(document.id_tipo_negocio.value);
	  if (document.id_tipo_negocio.value == 4)
	   {
	    alert("a");
	    document.tipo_negocio_desc.disabled=true;
	   }
	   else
   	   {
	   	    alert("b");
	    document.tipo_negocio_desc.disabled=false;
	   }

	 }*/

function validarEntero(numero){ 
      //Compruebo si es un valor num�rico 
      if (isNaN(numero)) { 
            //entonces (no es numero) devuelvo el valor cadena vacia 
            alert("Solo puede ingresar numeros en el campo");
			return ""
//   		    document.numeros.numero.focus();
      }else{ 
            //En caso contrario (Si era un n�mero) devuelvo el valor 
            return numero
           // document.numeros.numero.focus();
      } 
}
// valida ingreso unicamente numerico
function validar(e) { // 1
    tecla = (document.all) ? e.keyCode : e.which; // 2
    if (tecla==8) return true; // 3
//    patron =/[A-Za-z\s]/; // 4
	patron = /[\d\.]/; 
    te = String.fromCharCode(tecla); // 5
    return patron.test(te); // 6
} 



   


   
</script>

<div style="display:none">
<script type="text/javascript" src="resources/js/Fecha.js" ></script>
<script type="text/javascript" src="resources/js/Calendario.js" ></script>
<script type="text/javascript" src="resources/js/Calendario1.js" ></script>
<link rel="STYLESHEET" type="text/css" href="resources/css/calendario.css"></link>
</div>

<script language="JavaScript" src="incluciones/popcalendar.js"></script>
<script language="JavaScript">
function fechadinamica(link) {
	popcalendar.selectWeekendHoliday(1,1)
	popcalendar.show(link, null, "")
}
popcalendar = getCalendarInstance()
popcalendar.shadow = 1
popcalendar.initCalendar()
</script>




<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="HojaEstilo.css" rel="stylesheet" type="text/css">


<link rel="stylesheet" type="text/css" media="all" href="calendario/skins/aqua/theme.css" title="Aqua" />
<link rel="alternate stylesheet" type="text/css" media="all" href="calendar-blue.css" title="winter" />
<link rel="alternate stylesheet" type="text/css" media="all" href="calendar-blue2.css" title="blue" />
<link rel="alternate stylesheet" type="text/css" media="all" href="calendar-brown.css" title="summer" />
<link rel="alternate stylesheet" type="text/css" media="all" href="calendar-green.css" title="green" />
<link rel="alternate stylesheet" type="text/css" media="all" href="calendar-win2k-1.css" title="win2k-1" />
<link rel="alternate stylesheet" type="text/css" media="all" href="calendar-win2k-2.css" title="win2k-2" />
<link rel="alternate stylesheet" type="text/css" media="all" href="calendar-win2k-cold-1.css" title="win2k-cold-1" />
<link rel="alternate stylesheet" type="text/css" media="all" href="calendar-win2k-cold-2.css" title="win2k-cold-2" />
<link rel="alternate stylesheet" type="text/css" media="all" href="calendar-system.css" title="system" />

<!-- import the calendar script -->
<script type="text/javascript" src="calendar.js"></script>

<!-- import the language module -->
<script type="text/javascript" src="calendario/lang/calendar-en.js"></script>

<!-- other languages might be available in the lang directory; please check
your distribution archive. -->

<!-- helper script that uses the calendar -->
<script type="text/javascript">

var oldLink = null;
// code to change the active stylesheet
function setActiveStyleSheet(link, title) {
  var i, a, main;
  for(i=0; (a = document.getElementsByTagName("link")[i]); i++) {
    if(a.getAttribute("rel").indexOf("style") != -1 && a.getAttribute("title")) {
      a.disabled = true;
      if(a.getAttribute("title") == title) a.disabled = false;
    }
  }
  if (oldLink) oldLink.style.fontWeight = 'normal';
  oldLink = link;
  link.style.fontWeight = 'bold';
  return false;
}

// This function gets called when the end-user clicks on some date.
function selected(cal, date) {
  cal.sel.value = date; // just update the date in the input field.
  if (cal.dateClicked && (cal.sel.id == "sel1" || cal.sel.id == "sel3"))
    // if we add this call we close the calendar on single-click.
    // just to exemplify both cases, we are using this only for the 1st
    // and the 3rd field, while 2nd and 4th will still require double-click.
    cal.callCloseHandler();
}

// And this gets called when the end-user clicks on the _selected_ date,
// or clicks on the "Close" button.  It just hides the calendar without
// destroying it.
function closeHandler(cal) {
  cal.hide();                        // hide the calendar
//  cal.destroy();
  _dynarch_popupCalendar = null;
}

// This function shows the calendar under the element having the given id.
// It takes care of catching "mousedown" signals on document and hiding the
// calendar if the click was outside.
function showCalendar(id, format, showsTime, showsOtherMonths) {
  var el = document.getElementById(id);
  if (_dynarch_popupCalendar != null) {
    // we already have some calendar created
    _dynarch_popupCalendar.hide();                 // so we hide it first.
  } else {
    // first-time call, create the calendar.
    var cal = new Calendar(1, null, selected, closeHandler);
    // uncomment the following line to hide the week numbers
    // cal.weekNumbers = false;
    if (typeof showsTime == "string") {
      cal.showsTime = true;
      cal.time24 = (showsTime == "24");
    }
    if (showsOtherMonths) {
      cal.showsOtherMonths = true;
    }
    _dynarch_popupCalendar = cal;                  // remember it in the global var
    cal.setRange(1900, 2070);        // min/max year allowed.
    cal.create();
  }
  _dynarch_popupCalendar.setDateFormat(format);    // set the specified date format
  _dynarch_popupCalendar.parseDate(el.value);      // try to parse the text in field
  _dynarch_popupCalendar.sel = el;                 // inform it what input field we use

  // the reference element that we pass to showAtElement is the button that
  // triggers the calendar.  In this example we align the calendar bottom-right
  // to the button.
  _dynarch_popupCalendar.showAtElement(el.nextSibling, "Br");        // show the calendar

  return false;
}

var MINUTE = 60 * 1000;
var HOUR = 60 * MINUTE;
var DAY = 24 * HOUR;
var WEEK = 7 * DAY;

// If this handler returns true then the "date" given as
// parameter will be disabled.  In this example we enable
// only days within a range of 10 days from the current
// date.
// You can use the functions date.getFullYear() -- returns the year
// as 4 digit number, date.getMonth() -- returns the month as 0..11,
// and date.getDate() -- returns the date of the month as 1..31, to
// make heavy calculations here.  However, beware that this function
// should be very fast, as it is called for each day in a month when
// the calendar is (re)constructed.
function isDisabled(date) {
  var today = new Date();
  return (Math.abs(date.getTime() - today.getTime()) / DAY) > 10;
}

function flatSelected(cal, date) {
  var el = document.getElementById("preview");
  el.innerHTML = date;
}

function showFlatCalendar() {
  var parent = document.getElementById("display");

  // construct a calendar giving only the "selected" handler.
  var cal = new Calendar(0, null, flatSelected);

  // hide week numbers
  cal.weekNumbers = false;

  // We want some dates to be disabled; see function isDisabled above
  cal.setDisabledHandler(isDisabled);
  cal.setDateFormat("%A, %B %e");

  // this call must be the last as it might use data initialized above; if
  // we specify a parent, as opposite to the "showCalendar" function above,
  // then we create a flat calendar -- not popup.  Hidden, though, but...
  cal.create(parent);

  // ... we can show it here.
  cal.show();
}
</script>



<style type="text/css">
<!--
.Estilo1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.Estilo2 {
	color: #FFFFFF;
	font-weight: bold;
	font-size: 16px;
}
.Estilo6 {color: #FF0000}
.Estilo7 {font-family: Arial, Helvetica, sans-serif}
.Estilo8 {font-size: larger}
.Estilo22 {font-size: 11px}
.Estilo31 {font-size: 12px; font-weight: bold; }
.Estilo3 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #666666;
}
.Estilo13 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo46 {color: #666666; font-weight: bold;}
.Estilo47 {color: #000000}
.Estilo61 {	font-family: Arial, Helvetica, sans-serif;
	font-size: 24px;
	font-weight: bold;
}
.Estilo64 {
	color: #000000;
	font-size: 11px;
	font-family: Arial, Helvetica, sans-serif;
}
body {
	background-image: url(Fondo%20de%20Fiesta.jpg);
}
.Estilo28 {font-size: 12px}
.Estilo67 {font-size: 9px}
.Estilo69 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; }
a:link {
	color: #999999;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
	color: #FF0000;
}
a:active {
	text-decoration: none;
}
-->
</style>

</head>
<table border="0" width="100%" class="Estilo1 Estilo18">
	<tr>
		<td align="left" bgcolor="#990000" width="15%" >
		<strong><font color="#FFFFFF" size="-1"><? print 'Usuario: '.$_SESSION['user']; ?></font></strong>
		</td>
		<td align="right"  width="70%">
		<a href="visita.php"><!--img src="tareas.gif" width="16" height="16" border="0"-->[ <-- Inicio ]</a>
		</td>
		<!--td align="right" >
		<a href="mtlogin.php"><!--img src="tareas.gif" width="16" height="16" border="0">[ Cerrar Sesión ]</a>
		</td-->
	</tr>
	<tr><!--td><font face="Arial, Helvetica, sans-serif" size="2"><br><strong><a href="consulta.php"><< Consultas >></a></strong></font></td-->

	</tr>
	
</table>

<form name="form1" method="post" action="movto_inv.php" onSubmit="return Verifica()">
<!--form name="form1" method="post" action="asesoringreso.php"-->
  <table width="91%"  border="0" align="center">
    <tr>
      <th colspan="2" scope="col"><p class="Estilo3"><span class="Estilo1 Estilo8">
      </span>Ministerio de Econom�a de Guatemala<br>
      SubGerencia Financiera - SubGerencia de Inform�tica<br>
	  Sección de Inventarios</p>
        </th>
    </tr>
  </table>

  <p class="Estilo8 Estilo7"></p>
  <table border="0" align="center" cellspacing="0">
  <tr bgcolor="#0066CC">
    <td colspan="7"><div align="center"><span class="Estilo1 Estilo2"> MOVIMIENTO DE INVENTARIO DE EQUIPO DE COMPUTO </span></div></td>
    </tr>
	      <?
$conection = mssql_connect("server_appl","sa","sa") or die("no se puede conectar a SQL Server");
 mssql_select_db("inventario",$conection);
 
 $query = "select id_registro_inventario, id_producto, sicoin, id_marca, modelo, no_serie, id_ubicacion_fisica, id_inventario_padre, id_anio_reg_it,
				id_institucion_reg_it, id_registro_informatica, id_tipo_dispositivo, nit, factura, CONVERT(varchar,fecha_compra,105) fecha_compra, valor_compra, 
				CONVERT(varchar,fecha_garantia_fin,105) fecha_garantia_fin from m_inventario where id_inventario = $_GET[idi]";
//echo $query;
 $resulta = mssql_query($query);
 while ($rows = mssql_fetch_array($resulta))
  {
   /* variables de sesion para verificar cambios */		 
	$_SESSION['id_registro_inventario'] = $rows[0];
	$_SESSION['id_producto'] = $rows[1];
	$_SESSION['sicoin'] = $rows[2];
 	$_SESSION['id_marca'] = $rows[3];
	$_SESSION['modelo'] = $rows[4];
	$_SESSION['no_serie'] = $rows[5];
	$_SESSION['id_ubicacion_fisica'] = $rows[6];
	$_SESSION['id_inventario_padre'] = $rows[7];
	$_SESSION['id_anio_reg_it'] = $rows[8];
	$_SESSION['id_institucion_reg_it'] = $rows[9];
	$_SESSION['id_registro_informatica'] = $rows[10];
	$_SESSION['id_tipo_dispositivo'] = $rows[11];
	$_SESSION['nit'] = $rows[12];
	$_SESSION['factura'] = $rows[13];
	$_SESSION['fecha_compra'] = $rows[14];
	$_SESSION['valor_compra'] = $rows[15];
	$_SESSION['fecha_garantia_fin'] = $rows[16];
  
  
   $query_inv_asigna = "select id_empleado from inventario_x_usuario where id_inventario = $_GET[idi]";
   $res_inv_asigna = mssql_query($query_inv_asigna);
   while ($rowinv = mssql_fetch_array($res_inv_asigna))
    {
	 $id_as_inv = $rowinv[0];
//	 envia_msg('empleado '.$id_as_inv);
	}

//envia_msg('ubicacion '.$rows[6]);
   ?>
	
  <!--tr>
    <td><span class="Estilo67"><font color="#6699FF" face="Arial, Helvetica, sans-serif">Fecha</font></span></td>
    <td> <span class="Estilo67">
	<font face="Arial, Helvetica, sans-serif">
	<? //echo'<font color="#003399"><strong>'.date("d")."/".date("m")."/".date("Y").'</strong></font>'; ?> 
	<? //echo'<font color="#003399"><strong>'.$hora.'</strong></font>'; ?>	</font></span></td>
    </tr>&nbsp;</td>
  </tr-->
  <tr><Td><br></Td></tr>
  <tr class="Estilo1">
    <td class="Estilo22" align="right">Registro Inventario<font color="#FF0000"><strong></strong></font></td>
    <td class="Estilo7"><input name="reg_inventario" type="text" class="Estilo7" disabled maxlength="100"  size="50" value="<? echo $rows['id_registro_inventario']; ?>" onKeyUp="javascript:this.value=this.value.toUpperCase();"></td>
  </tr>

	  <tr class="Estilo1" >
		<td class="Estilo22" align="right">Dispositivo<font color="#FF0000"><strong></strong></font></td>
		<td class="Estilo7"><select name="id_producto" onChange="checarcombo();" disabled><? 
			$sql_prod = "select id_producto, descripcion from cat_producto order by 2";
			$result_prod = mssql_query($sql_prod);
			while ($row_prod = mssql_fetch_array($result_prod))
			  { 
			   if ($row_prod['id_producto'] == $rows['id_producto']) 
			    {
			  ?>
					<option value="<? echo $row_prod['id_producto']; ?>" selected ><? echo $row_prod['descripcion']; ?></option>
 			<?  } 
			  else
			    {?>
					<option value="<? echo $row_prod['id_producto']; ?>" ><? echo $row_prod['descripcion']; ?></option>
			<?  }  // fin else
			  } // fin while ?>
		</select> 
		</td>
  	</tr>
	  <tr class="Estilo1" >
		<td class="Estilo22" align="right">Tipo de Dispositivo<font color="#FF0000"><strong></strong></font></td>
		<td class="Estilo7">  <select name="id_tipo_dispositivo" disabled><? 
			$sql = "select id_tipo_dispositivo, tipo_dispositivo from cat_tipo_dispositivo order by 2";
			$result = mssql_query($sql);
			while ($row = mssql_fetch_array($result))
			  { 
			  	if ($row[0] == $rows['id_tipo_dispositivo'])
				 {
				?>
					<option value="<? echo $row['id_tipo_dispositivo']; ?>" selected><? echo $row['tipo_dispositivo']; ?></option>
				<? } 
			     else { ?>
					<option value="<? echo $row['id_tipo_dispositivo']; ?>"><? echo $row['tipo_dispositivo']; ?></option>
				<? } ?>

			<? } ?>
		</select> 
		</td>
  	</tr>	
	  <tr class="Estilo1" >
		<td class="Estilo22" align="right">Marca<font color="#FF0000"><strong></strong></font></td>
		<td class="Estilo7"> <select name="id_marca" disabled><? 
			$sql_marca = "select id_marca, marca from cat_marca order by 2";
			$result_marca = mssql_query($sql_marca);
			while ($row_marca = mssql_fetch_array($result_marca))
			  { 
			  	if ($row_marca[0] == $rows['id_marca'])
				 {
				?> <option value="<? echo $row_marca['id_marca']; ?>" selected><? echo $row_marca['marca']; ?></option>
			  <? } 
			     else { ?>					
				 <option value="<? echo $row_marca['id_marca']; ?>"><? echo $row_marca['marca']; ?></option>
				 <? } ?>
			<? } ?>
			</select> 
		</td>
  	</tr>	
	
  <tr class="Estilo1">
	  <td class="Estilo22" align="right">Modelo<font color="#FF0000"><strong></strong></font>
	  <td class="Estilo7"><input type="text" name="modelo" maxlength="30" disabled value="<? echo $rows['modelo']; ?>"></td>
  </tr>
  
  <tr class="Estilo1">
	  <td class="Estilo22" align="right">Serie No.<font color="#FF0000"><strong></strong></font>
	  <td class="Estilo7"><input type="text" name="serie" maxlength="30" disabled value="<? echo $rows['no_serie']; ?>"></td>
  </tr>
  <tr class="Estilo1">
	  <td class="Estilo22" align="right">Sicoin<font color="#FF0000"><strong></strong></font>
	  <td class="Estilo7"><input type="text" name="sicoin" maxlength="30" disabled value="<? echo $rows['sicoin']; ?>"></td>
  </tr>
  <tr class="Estilo1">
	  <td class="Estilo22" align="right">Etiqueta de Seguridad Actual <font color="#FF0000"><strong></strong></font>
	  <td class="Estilo7"><input type="hidden" name="anio_reg_it" maxlength="4" size="4" value="2008"><strong>2008</strong> -
	  <select name="insti_reg_it" disabled>
	  <? $query = "select id_institucion_reg_it, institucion_reg_it from cat_institucion_reg_it order by 2";
	     $result = mssql_query($query);
		 while($row = mssql_fetch_array($result))
		  { 
		  if ($row[0] == $rows['id_institucion_reg_it']) 
		    { ?>
		     <option selected value="<? echo $row[0]; ?>"><? echo $row[1]; ?></option>		   
		 <? }
		 else
		    {
		  ?>
		     <option value="<? echo $row[0]; ?>"><? echo $row[1]; ?></option>
	  <?    }
	      }
	  ?>
	  </select>
	  <input type="hidden" name="insti_reg_it" value="<? echo $rows['id_institucion_reg_it']; ?>">
	  - <input type="text" name="reg_it" disabled size="6" maxlength="6" value="<? echo $rows['id_registro_informatica']; ?>" onkeypress="return validar(event)">
	  <input type="hidden" name="reg_it" value="<? echo $rows['id_registro_informatica']; ?>"></td>
  </tr>
  <?
	$conection = mssql_connect("server_appl","sa","sa") or die("no se puede conectar a SQL Server");
	mssql_select_db("RRHH",$conection);
  ?>
  <tr class="Estilo1" >
		<td class="Estilo22" align="right">Ubicación F�sica<font color="#FF0000"><strong></strong></font></td>
		<td class="Estilo7"> <? 
			$sql_dir= "select iddireccion, nombre from direccion order by nombre";
			$result_dir = mssql_query($sql_dir);
 		 ?>  
		  <select name="id_direccion_old"  disabled><option></option>
		<?	while ($row_dir = mssql_fetch_array($result_dir))
			  {
			    if ($row_dir[0] == $rows['id_ubicacion_fisica']) 
				 {?>
					<option selected value="<? echo $row_dir['iddireccion']; ?>"><? echo $row_dir['nombre']; ?></option>
			  <? }
			  else
			    {  ?>
					<option value="<? echo $row_dir['iddireccion']; ?>"><? echo $row_dir['nombre']; ?></option>
			<?	}
			   } ?>
	  </select>	  
  	  <input type="hidden" name="id_direccion" value="<? echo $rows['id_ubicacion_fisica']; ?>">
	  </td>
  	</tr>	
	
	<TR class="Estilo1">
	<td class="Estilo22" align="right">Asignado a<font color="#FF0000"><strong></strong></font></td>	
	<td class="Estilo7">
	<div align="left">
		  <div id="Div_Subactividades4"> 
				<label for="SubActividad4"></label> 
                 <?			$sql_as= "select idasesor, nombre, nombre2, nombre3, apellido, apellido2, apellidocasada from asesor where nombre != 'ADMINISTRADOR'  order by 2, 5 ";
			$result_as = mssql_query($sql_as);
//		echo $sql_as;
 		 ?>  <select name="id_asesor_old" disabled>
		<?	while ($row_as = mssql_fetch_array($result_as))
			  { 
			    if ($row_as[0] == $id_as_inv )
				 {?>
				<option value="<? echo $row_as['idasesor']; ?>" selected><? echo $row_as['nombre'].' '.$row_as['nombre2'].' '.$row_as['nombre3'].' '.$row_as['apellido'].
					' '.$row_as['apellido2'].' '.$row_as['apellidocasada']; ?></option>
			<?   }
			    else
				{ ?>
				<option value="<? echo $row_as['idasesor']; ?>"><? echo $row_as['nombre'].' '.$row_as['nombre2'].' '.$row_as['nombre3'].' '.$row_as['apellido'].
					' '.$row_as['apellido2'].' '.$row_as['apellidocasada']; ?></option>
			<?	}
			   } ?>
			</select> 
		 <input type="hidden" name="idi" value="<? echo $_GET['idi']; ?>">
	  	 <input type="hidden" name="id_asesor_old" value="<? echo $id_as_inv; ?>">
</div>
        </div></tD>
	</TR>
<? 
/* CAMBIO DE EMPLEADO Y UBICACION FISICA */ ?>
  <tr class="Estilo1" >
		<td class="Estilo22" align="right"> Ubicación F�sica del <br>Empleado a Reasignar <font color="#FF0000"><strong>**</strong></font></td>
		<td class="Estilo7"> <? 
			$sql_dir= "select iddireccion, nombre from direccion order by nombre";
			$result_dir = mssql_query($sql_dir);
 		 ?>  
		  <select name="id_direccion_new" onChange="javascript:cargarCombo('subactividades5.php', 'id_direccion_new', 'Div_Subactividades5')"><option></option>
		<?	while ($row_dir = mssql_fetch_array($result_dir))
			  { ?>
					<option value="<? echo $row_dir['iddireccion']; ?>"><? echo $row_dir['nombre']; ?></option>
			<?	
			   } ?>
	  </select>	  
	  </td>
  	</tr>	

	<TR class="Estilo1">
	<td class="Estilo22" align="right">Reasignar a<font color="#FF0000"><strong>**</strong></font></td>	
	<td class="Estilo7">
	<div align="left">
		  <div id="Div_Subactividades5"> 
				<label for="SubActividad5"></label> 
                 <select name="id_asesor"  id="id_asesor" >

            </select>

</div>
        </div></tD>
	</TR>
<? /* TERMINA CAMBIO DE EMPLEADO Y UBICACION FISICA*/ ?>
	<tr class="Estilo1" >
		<td class="Estilo22" align="right">Motivo por el cual se<br> realiza el movimiento<font color="#FF0000">**</font></td>
		<td class="Estilo7"><textarea name="descripcion" class="Estilo7" rows="4" cols="60" onKeyUp="javascript:this.value=this.value.toUpperCase();"></textarea>
		</td>
  	</tr>					
  <input type="hidden" name="inserta" value="1">

</table>
 <? } // finaliza while inicial
 ?>
<table width="50%"  border="0" align="center">
  <tr>
    <th width="43%" scope="row">&nbsp;</th>
    <td width="31%"><div align="right"><span class="Estilo1 Estilo6"><font color="#FF0000">** Campos Requeridos</font>
        <input type="submit" name="Submit" value="Registrar">
      <!--img src="images/flecha4.JPG" width="43" height="39"--> </span></div></td>
  </tr>
</table>
</form>

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
    element.innerHTML = '<img src="Imagenes/loading.gif" />'; 
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


</body>
</html>
