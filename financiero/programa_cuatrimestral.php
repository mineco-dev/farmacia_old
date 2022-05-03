<?
session_start();
include('conectarse.php');
$_SESSION['nivel']=1;
session_register('PagNow');


/*
if  (( !$_SESSION['usr_val']) || ($_SESSION['usr_val'] == 'N') || ($_SESSION['usr_val'] == '') )
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
		}
*/
	include('INCLUDES/inc_header.inc');
	$dbms=new DBMS($conexion); 
	$PagNow=1;
// Valores iniciales para la paginacion
	$rangoini = (10 * $PagNow) - 10;
	$rangofin = 10;
	$sqlsel = mssql_query("select id_grupo, grupo from grupo");
	$Total = mssql_num_rows($sqlsel);
	$maxpag = ceil($Total / 10);	
	if ($maxpag == 0) {$maxpag = 1;}

	if ( $sstipo != 1)
	{
//	 cambiar_ventana('mtlogin.php');
	}

 if ( isset($_POST['inserta']) && ($_POST['inserta'] == 1) ) 
	{
		$verifica = "select grupo from grupo where grupo = ".$_POST['nombre'];
		$resver = mssql_query($verifica);
		if (mssql_num_rows($resver) > 0) 
			{
			 envia_msg('El grupo que desea ingresar ya existe en el sistema');
			}
		else
			{
				$sql="insert into grupo (grupo) 
						values (".$_POST['nombre'].") ";
				$result = mssql_query($sql); 
				$rsRows = mssql_query("select @@rowcount as rows");
				 $rows = mssql_fetch_assoc($rsRows); 
					 //  envia_msg( $rows['rows']);
					 //envia_msg(mssql_rows_affected($result) );
			   if ( $rows['rows'] == 1 )
				 {
					envia_msg('Se inserto exitosamente el registro');	
				 }	
				else
				 {
					error_msg('No se pudo insertar el registro');	
				 }
			  }
	}

?>

<script language="JavaScript">
	function Verifica()
	 {
		

//		if (form1.nombre.value == "" || form1.apellido.value == "" || form1.idregistro.value == "" || form1.cedula.value == "" || form1.iddepartamento.value == "" || form1.usuario.value = "" || form1.password.value == "" || form1.iddepartamento2 == value ""  )
		if (form1.nombre.value == "")
			{
				alert('Por favor llene los campos requeridos **');
				return false
			}
		}
 

	function validarEntero(numero)
	{ 
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
	
	function CambioOpcion(targ,selObj,restore)
	{
		eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
		if (restore) selObj.selectedIndex=0;
	}

	function validatexto(id,tamax)
	 {
	  // Obtenemos el texto del area.
	  textoArea = document.getElementById(id).value;
	
	  // El numero de caracteres es su longitud
	  numeroCaracteres = textoArea.length;
	
	  // Eliminamos los caracteres en blanco del inicio y del final.
	  // Como no tenemos funciones del tipo trim, rtrim y ltrim usamos
	  // expresiones regulares
	  // El ^ indica principio de cadena
	  inicioBlanco = /^ /
	  // El $ indica final de cadena
	  finBlanco = / $/
	  // El global (g) es para obtener todas las posibles combinaciones
	  variosBlancos = /[ ]+/g 
	
	  textoArea = textoArea.replace(inicioBlanco,"");
	  textoArea = textoArea.replace(finBlanco,"");
	  textoArea = textoArea.replace(variosBlancos," ");
		 if(textoArea.length >= tamax)
		 { 
		 alert('Has superado el tama�o m�ximo permitido! El maximo es: '+tamax+' letras.'); 
//		 document.write('Has superado el tama�o m�ximo permitido! El maximo es: '+tamax+' letras.'); 
		 //alert('Has superado el tama�o m�ximo permitido! El maximo es: '+tamax+' y tu introduciste: '+numeroCaracteres+' letras.'); 
		 //alert ('Cantidad: 'numeroCaracteres);
		 }
	 }


</script>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!--link href="HojaEstilo.css" rel="stylesheet" type="text/css"-->
<script type="text/javascript">

// valida ingreso unicamente numerico
function validar(e) { // 1
    tecla = (document.all) ? e.keyCode : e.which; // 2
    if (tecla==8) return true; // 3
//    patron =/[A-Za-z\s]/; // 4
	patron = /[.\d]/; 
    te = String.fromCharCode(tecla); // 5
    return patron.test(te); // 6
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

<body>
<table border="0" width="100%" class="Estilo1 Estilo18">
	<tr>
		<td align="left" bgcolor="#990000" width="15%" >
		<strong><font color="#FFFFFF" size="-1"><? print 'Usuario: '.$_SESSION['user']; ?></font></strong>
		</td>
		<td align="right"  width="70%">
		<a href="visita.php"><!--img src="tareas.gif" width="16" height="16" border="0"-->[ <-- Regresar al Menu ]</a>
		</td>
		<!--td align="right" >
		<a href="mtlogin.php"><!--img src="tareas.gif" width="16" height="16" border="0">[ Cerrar Sesión ]</a>
		</td-->

	</tr>
</table>

<form name="form1" method="post" action="grupo.php" onSubmit="return Verifica()">
<!--form name="form1" method="post" action="asesoringreso.php"-->
  <table width="91%"  border="0" align="center">
    <tr>
      <th colspan="2" scope="col"><span class="Estilo3"><span class="Estilo1 Estilo8">
        <input type="hidden" name="empresa_registro" value="<? print $empresa_registro;?>">
        <input type="hidden" name="registro2" value="<? print $registro;?>">
      </span>Ministerio de Econom�a de Guatemala </span></th>
    </tr>
  </table>

  <p class="Estilo8 Estilo7"></p>
  <table border="0" align="center" cellspacing="0">
  <tr bgcolor="#0066CC">
    <td colspan="7"><div align="center"><span class="Estilo1 Estilo2"> PRESUPUESTO CUATRIMESTRAL</span></div></td>
    </tr>
  <tr>
  	<td>&nbsp;</td>
    <!--td><span class="Estilo67"><font color="#6699FF" face="Arial, Helvetica, sans-serif">Fecha</font></span></td>
    <td> <span class="Estilo67">
	<font face="Arial, Helvetica, sans-serif">
	<? //echo'<font color="#003399"><strong>'.date("d")."/".date("m")."/".date("Y").'</strong></font>'; ?> 
	<? //echo'<font color="#003399"><strong>'.$hora.'</strong></font>'; ?>	</font></span></td>
    </tr>&nbsp;</td-->
  </tr>
  <tr class="Estilo1" >
    <td class="Estilo22" align="right">Programa<font color="#FF0000"></font></td>
    <td class="Estilo7">
		<?  
//*** 		 se utiliza la variable de sesion con que hara login
			$_SESSION['empleado']=27;  
			$sql_pro = "select b.ident_programa, b.programa from empleado_programa a, programa b where a.id_asesor = ".$_SESSION['empleado']." and a.id_programa = b.id_programa"; 
			$res_pro = mssql_query($sql_pro);
			$row_pro = mssql_fetch_row($res_pro);
			echo $row_pro[0].' '.$row_pro[1];
		?>
		<input name="programa" type="hidden" class="Estilo7" maxsize="2"  size="2" value="<? echo $row_pro[0]; ?>" onKeyUp="javascript:this.value=this.value.toUpperCase();">
	</td>
  </tr>
   <tr class="Estilo1" >
    <td class="Estilo22" align="right">Actividad<font color="#FF0000"><strong>**</strong></font></td>
    <td class="Estilo7">
		<? 
			$sql_pro = "select a.id_actividad, a.ident_actividad, a.actividad from actividad a, programa b, empleado_programa c 
						where c.id_asesor = ".$_SESSION['empleado']." and a.id_programa = b.id_programa
						and b.id_programa = c.id_programa"; 
			$res_pro = mssql_query($sql_pro);
		?><select name="actividad"> 
		    <? while ($row_pro = mssql_fetch_row($res_pro))
			   { 
			?>
			<option value="<? echo $row_pro[0]; ?>"><? echo $row_pro[1].' '.$row_pro[2]; ?></option> 
			<?	}
			?> 
		</select>
	</td>
  </tr> 
  
	<tr class="Estilo1">
		<td class="Estilo22" align="right">Grupo<font color="#FF0000"><strong>**</strong></font></td>
		<td width="200"  id="fila_1" class="Estilo22"><span lang="es-gt"> <span lang="es-gt">
			<span lang="es-gt"><span lang="es-gt">
			<select name="grupo" id="grupo"  onChange="CambioOpcion('self',this,0)">
			  <option value=0> Seleccione </option>
			  <? 
					$dbms->sql="select id_grupo, ident_grupo, grupo from grupo"; 
					$dbms->Query(); 
					while($Fields=$dbms->MoveNext()) 
					{
						$id_gru = $Fields['id_grupo'];
						$gru = $Fields['grupo'];
						if ($id_gru == ($_GET['idg']))
						 {
						  $selected = 'selected="selected"';
						 } 
						else
						 {
						  $selected = "";
						 }
						print "<option ".$selected."value=\""."programa_cuatrimestral.php?idg=".$Fields["id_grupo"]."\">".$Fields["ident_grupo"].' '.$Fields["grupo"]."</option>\n"; 
//						echo "<option ".$selected." value=\"programa_cuatrimestral.php?idg=".$id_se."\">".$sed."</option>\n";
					}
				?>
			</select>
			</span></span> </span> </span>
		</td>
	</tr> 
	
	<tr class="Estilo1">
		<td class="Estilo22" align="right">Renglon<font color="#FF0000"><strong>**</strong></font></td>
		<td width="200"  id="fila_1" class="Estilo22"><span lang="es-gt"> <span lang="es-gt">
			<span lang="es-gt"><span lang="es-gt">
			<select name="renglon" id="renglon"  onChange="CambioOpcion('self',this,0)">
			  <option value=0> Seleccione </option>
			  <? 
					$dbms->sql="select id_renglon, ident_renglon, renglon from renglon where id_grupo=".$_GET['idg']; 
					$dbms->Query(); 
					while($Fields=$dbms->MoveNext()) 
					{
						$id_ren = $Fields['id_renglon'];
						$ren = $Fields['renglon'];
						if ($id_ren == ($_GET['idr']))
						 {
						  $selected = 'selected="selected"';
						 } 
						else
						 {
						  $selected = "";
						 }
						print "<option ".$selected."value=\""."programa_cuatrimestral.php?idg=".$_GET['idg']."&idr=".$Fields["id_renglon"]."\">".$Fields["ident_renglon"].' '.$Fields["renglon"]."</option>\n"; 
//						echo "<option ".$selected." value=\"programa_cuatrimestral.php?idg=".$id_se."\">".$sed."</option>\n";
					}
				?>
			</select>
			</span></span> </span> </span>
		</td>
	</tr> 
	
	<tr class="Estilo1">
		<td class="Estilo22" align="right">Fuente de Financiamiento<font color="#FF0000"><strong>**</strong></font></td>
		<td width="200"  id="fila_1" class="Estilo22"><span lang="es-gt">
			<select name="fuente" id="fuente"  onChange="CambioOpcion('self',this,0)">
			  <option value=0> Seleccione </option>
			  <? 
					$dbms->sql="select id_fuente, fuente, denominacion from fuente_financiamiento where clasifica=2"; 
					$dbms->Query(); 
					while($Fields=$dbms->MoveNext()) 
					{
						$id_fuent = $Fields['id_fuente'];
						$fuent = $Fields['fuente'];
						$denom = $Fields['denominacion'];
						if ($id_fuent == ($_GET['fuen']))
						 {
						  $selected = 'selected="selected"';
						 } 
						else
						 {
						  $selected = "";
						 }
//						print "<option value=\"".$id_fuent."\">".$Fields["fuente"].' '.$Fields["denominacion"]."</option>\n"; 
						print "<option ".$selected."value=\""."programa_cuatrimestral.php?idg=".$_GET['idg']."&idr=".$_GET['idr']."&fuen=".$Fields['id_fuente']."&cuatri=$cuat"."\">".$denom."</option>\n"; 
//						echo "<option ".$selected." value=\"programa_cuatrimestral.php?idg=".$id_se."\">".$sed."</option>\n";
					}
				?>
			</select>
			</span>
		</td>
	</tr> 
	
	<tr class="Estilo1">
		<td class="Estilo22" align="right">Cuatrimestre<font color="#FF0000"><strong>**</strong></font></td>
		<td width="200"  id="fila_1" class="Estilo22"><span lang="es-gt">
			<select name="cuatrim" id="cuatrim" onChange="CambioOpcion('self',this,0)">
			<?
				for ($cuat=1;$cuat<4;$cuat++)
					{
						if ($cuat == ($_GET['cuatri']))
						 {
						  $selected = 'selected="selected"';
						 } 
						else
						 {
						  $selected = "";
						 }
						print "<option ".$selected."value=\""."programa_cuatrimestral.php?idg=".$_GET['idg']."&idr=".$_GET['idr']."&fuen=".$_GET['fuen']."&cuatri=$cuat"."\">".$cuat."</option>\n"; 
					}
			?>
			</select>
			</span>
		A�o<font color="#FF0000"><strong>**</strong></font>
			<select name="anio">
			  <option value=<? echo date('Y'); ?>><? echo date('Y'); ?></option>
			  <? if ( date('m') > 8 ) { ?>
	  			  <option value=<? echo date('Y')+1; ?>><? echo date('Y')+1; ?></option>
			  <? } ?>
			</select>
			</span>
		</td>
	</tr> 

	<tr class="Estilo1"><td align="right"><strong>Mes /</strong></td><Td><strong>Monto Q.</strong></Td></tr>		
					<?
				for ($meses=1;$meses<=4;$meses++)
					{ ?>

	<tr class="Estilo1">
		<td class="Estilo22" align="right"> 
					
			<? 		
				if ($_GET['cuatri']==1)
					{
					$mes1='Enero';
					$mes2='Febrero';
					$mes3='Marzo';
					$mes4='Abril';					
					}
				else
					{
						if ($_GET['cuatri']==2)
							{
							$mes1='Mayo';
							$mes2='Junio';
							$mes3='Julio';
							$mes4='Agosto';					
							}
						else
							{
							if ($_GET['cuatri']==3)
								{
								$mes1='Septiembre';
								$mes2='Octubre';
								$mes3='Noviembre';
								$mes4='Diciembre';					
								}
							}

					}
						if ($meses == 1)	
						 {
						 echo $mes1;
						 } 
 						if ($meses == 2)	
						 {
 						 echo $mes2;
						 } 
 						if ($meses == 3)	
						 {
 						 echo $mes3;
						 } 
 						if ($meses == 4)	
						 {
 						 echo $mes4;
						 } ?>
						 </td>
	 					<td width="200"  id="fila_1" class="Estilo22"><span lang="es-gt">
						</span>
						<font color="#FF0000"><strong></strong></font>
						<input type="text" name="monto<? echo $meses; ?>" size="10" maxlength="12" onkeypress="return validar(event)" >
						</span>
						<br>
					</td>
	<?				}
			?>

	</tr> 



	  <tr class="Estilo1" >
		<td class="Estilo22" align="right" valign="top">Justificación<font color="#FF0000"><strong>**</strong></font></td>
		<td class="Estilo7"><textarea name="justifica" cols="60" rows="10" onkeypress="validatexto('justifica','250');" onChange="validatexto('justifica','250');"></textarea></td>
	  </tr>
	<input name="inserta" type="hidden" size="1" value="1">
	
	</table>
<table width="77%"  border="0" align="center">
  <tr>
    <th width="43%" scope="row">&nbsp;</th>
    <td width="31%"><div align="right"><span class="Estilo1 Estilo6"><font color="#FF0000">** Campos Requeridos</font>
        <input type="submit" name="Submit" value="Guardar">
      <!--img src="images/flecha4.JPG" width="43" height="39"--> </span></div></td>
  </tr>
</table>
</form>

<!--table border="0" align="center" class="Estilo1 ">
  <tr>
    <td bgcolor="#C9CDED" align="center"><strong>Grupo</strong></td>
    <td bgcolor="#99CCFFF" width="200" align="center"><strong>Concepto</strong></td>
    <td bgcolor="#C9CDED">&nbsp;</td>
    <td bgcolor="#99CCFF">&nbsp;</td>
  </tr>
 	<?php
//	echo "$rangoini.'--'.$rangofin";
//	$sqlsel = "select id_grupo, grupo from grupo where id_grupo in($rangoini, $rangofin) order by 1";
//	$sqlsel = "select id_grupo, grupo from grupo where id_grupo >= $rangoini and id_grupo <= $rangofin order by 1";
	$sqlsel = "select id_grupo, ident_grupo, grupo from grupo ";//where id_grupo >= $rangoini and id_grupo <= $rangofin order by 1";
//	echo $sqlsel;
//	$sqlsel = "SELECT * FROM ( SELECT *, ROW_NUMBER() OVER (ORDER BY id_grupo) as row FROM grupo ) as grupo WHERE row > $rangoini and row <= $rangofin";

/*	$result = mssql_query($sqlsel);
	$correlativo = 0;
		while($row = @mssql_fetch_array($result)) 
		{
	?>
	<tr>
		<td bgcolor="#C9CDED"><? echo $row["ident_grupo"]; ?></td>
		<td bgcolor="#99CCFF"><? echo $row["grupo"]; ?></td>
		<td bgcolor="#C9CDED"><a href="edicion_grupo.php?tabla=grupo&pag=grupo.php&id=<? echo $row["id_grupo"]; ?>" title="Editar" target="mainFrame"><img src="images/iconos/b_edit.png" width="16" height="16" border="0"></a></td>
	    <td bgcolor="#99CCFF"><a href="grupo.php?eli=1&id=<? echo $row["id_grupo"]; ?>" title="Eliminar" target="mainFrame"><img src="images/iconos/button_drop.png" width="16" height="16" border="0"></a></td>
	</tr>
	<?
 		}
		@mysql_free_result($sqlsel);*/
	?>
</table>

<!--form name="form3" method="post" action="">
  <table border="1" align="center">
    <tr>
		<?
			/*if ($PagNow != 1)
			{
				echo "<td><a href=\"validapag.php?linkant=grupo.php&pag=-1&maxpag=".$maxpag."\">Anterior</a></td>";
			}
			if ($maxpag > 10)
			{
				for ($contpag = $PagNow;($contpag <= $maxpag) && ($contpag <= ($PagNow + 9));$contpag++)
				{ 
					echo "<td><a href=\"validapag.php?linkant=grupo.php&pag=".$contpag."&maxpag=".$maxpag."\">".$contpag."</a></td>";
				}
			}
			else
			{
				if ($maxpag > 1)
				{
					for ($contpag = 1;($contpag <= $maxpag) && ($contpag <= ($PagNow + 9));$contpag++)
					{ 
						echo "<td><a href=\"validapag.php?linkant=grupo.php&pag=".$contpag."&maxpag=".$maxpag."\">".$contpag."</a></td>";
					}
				}
			}
			
			if ($PagNow != $maxpag)
			{
				echo "<td><a href=\"validapag.php?linkant=grupo.php&pag=0&maxpag=".$maxpag."\">Siguiente</a></td>";
			}*/
		?>  
    </tr>
  </table>
</form-->

<!--script type="text/javascript"> 
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







<script type="text/javascript"> 
var peticion1 = false; 
var  testPasado = false; 
try { 
  peticion1 = new XMLHttpRequest(); 
  } catch (trymicrosoft) { 
  try { 
  peticion1 = new ActiveXObject("Msxml2.XMLHTTP"); 
  } catch (othermicrosoft) { 
  try { 
  peticion1 = new ActiveXObject("Microsoft.XMLHTTP"); 
  } catch (failed) { 
  peticion1 = false; 
  } 
  } 
} 
if (!peticion1) 
alert("ERROR AL INICIALIZAR!"); 
  
function cargarCombo1 (url, comboAnterior1, element_id1) { 
    //Obtenemos el contenido del div 
    //donde se cargaran los resultados 
    var element1 =  document.getElementById(element_id1); 
    //Obtenemos el valor seleccionado del combo anterior 
    var valordepende1 = document.getElementById(comboAnterior1) 
    var x = valordepende1.value 
    //construimos la url definitiva 
    //pasando como parametro el valor seleccionado 
    var fragment_url = url+'?Id='+x; 
    element1.innerHTML = '<img src="Imagenes/loading.gif" />'; 
    //abrimos la url 
    peticion1.open("GET", fragment_url); 
    peticion1.onreadystatechange = function() { 
        if (peticion1.readyState == 4) { 
//escribimos la respuesta 
element1.innerHTML = peticion1.responseText; 
        } 
    } 
   peticion1.send(null); 
} 
</script>





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
</script-->


</body>
</html>
