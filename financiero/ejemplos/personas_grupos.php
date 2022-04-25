<?
	session_start();
	
	include("barra_inferior.php");
	include("conectarse.php");

	// Verifica si hubo inicio de sesión
	if ($_SESSION['Bandera'] != "SI")
	{
		cambiar_ventana("test.php");
		exit;
	}

	$link=conectarse("mp");

function fecha_std_inv($fecha_std)
  {
	$fechard= substr($fecha_std,8,2);
//		echo $fechard."<br>";
	$fecharm= substr($fecha_std,5,2);
//		echo $fecharm."<br>";
	$fechara= substr($fecha_std,0,4);
//		echo $fechara."<br>";
	$hora = substr($fecha_std,11,10);
//		echo $hora."<br>";
	$fechar_in = $fechard."/".$fecharm."/".$fechara." ".$hora;
//		echo "-$fechar_in-";
    return $fechar_in;
  }

	function fecha_std($fecha_std)
	{
		$fechard= substr($fecha_std,0,2);
//		echo $fechard."<br>";
		$fecharm= substr($fecha_std,3,2);
//		echo $fecharm."<br>";
		$fechara= substr($fecha_std,6,4);
		//echo $fechara."<br>";
		$hora = substr($fecha_std,10,10);
		//echo $hora."<br>";
		$fechar_in = $fechara."/".$fecharm."/".$fechard." ".$hora;
//		echo "-$fechar_in-";
	return $fechar_in;
	}

// define la sede actual
  $querysede = "select id_sede from municipio where defa = 1";
  $resede = mysql_query($querysede);
  while ($row = mysql_fetch_array($resede))
   {
    $id_sede_caso = $row['id_sede'];
   }					
  if ($id_sede_caso == null)				   
   {
    error_msg('El Municipio asignado como Default no tiene una Sede asignada, \n por favor vaya al catalogo de Sedes, Generela y asignela al Municipio');
   }
// termina define la sede actual


// Valores iniciales para la paginacion
//$PagNow =1;
	$rangoini = (25 * $PagNow) - 25;
	$rangofin = 25;
//	$sqlsel = @mysql_query("select id_grupo, nip from personas_grupo");
	$sqlsel = @mysql_query("select a.nip, a.id_grupo, b.grupo, c.nombre, d.sede from personas_grupo a, grupo b, empleado c, sedes d where a.id_grupo = b.id_grupo and a.nip = c.nip and substr(a.nip,1,4) != '9999' and b.id_sede = d.id_sede");
	$Total = @mysql_num_rows($sqlsel);
	$maxpag = ceil($Total / 25);	
	if ($maxpag == 0) {$maxpag = 1;}


//valida si las variables existen para declararlas
if (isset($_POST['ins'])) {	$ins=$_POST['ins']; /*echo $ins."<br>";*/ } else { $ins=0; }
//if (isset($_POST['ins'])) {	$ins=$_POST['ins']; /*echo $ins."<br>";*/ } else { $ins=0; }
if (isset($_GET['eli'])) { $eli=$_GET['eli']; /*echo $eli."<br>";*/ } else { $eli=0; }
if (isset($_GET['id'])) { $id=$_GET['id']; /*echo $id."<br>"; */} else { $id=0; }
if (isset($_POST['nip']))
{
//echo "Si existe tipo de archivo ".$_POST['tipo_archivo']." valor" ;
if (empty($_POST['nip']))
 {
    envia_msg("El valor a ingresar no puede ser nulo. Verifique sus datos");
//    header("Location: tipo_archivo.php");
	cambiar_ventana("personas_grupos.php");
	exit;
 }
}

// Elimina el registro
	if ($eli == 1)
	{
/*		$query = "select * from otratabla where idtabla = '$id'";
		$result = mysql_query($query,$link);
		if (mysql_fetch_row($result))
		{
			envia_msg("El calibre no puede ser eliminado");
		}
		else
		{ */
			$query = "delete from personas_grupo where nip = '$id'";
			$result = @mysql_query($query,$link);
			cambiar_ventana("personas_grupos.php");
		   exit;
//		}
	}

	// Graba el nuevo valor en la tabla
	if ($ins == 1)
	{
      $query = "select * from personas_grupo where nip = '$nip'";
 	  $result = mysql_query($query,$link);
	  if (mysql_fetch_row($result))
	   {
		envia_msg("El empleado ingresado ya esta asignado a un grupo. Verifique sus datos");
	   }
  	  else
	   {
	    $personas = 0;
//		echo "personas ".$personas."<br>";
		$id_grupo = $_POST['id_grupo'];
		$fecha_ini = fecha_std($_POST['fechaini'].'08:00');
		$fecha_fin = fecha_std($_POST['fechafin'].'08:00');

//		echo "grupo ".$id_grupo."<br><br>";
//		echo "cuenta per ".$_GET['cuenta_per']."<br><br>";
//		echo "cadena ".$_GET['cadena']."<br><br>";
		
/*	   foreach ($cadena as $indice=>$valor)
		{
			$actual = "INSERT INTO personas_grupo (nip, id_grupo) values ($valor, id_grupo)";
			$datos = mysql_query($actual,$link);
		}*/
		
	    for ($personas=1; $personas <= $_POST['cant_per']; $personas++)
		 {
//			$query = "insert into personas_grupo values ('$nip','$id_grupo')";
            if (isset($_POST['nip'.$personas]))
			 {
				//$cadena = ("nip".$personas);
	//			echo $cadena."<br>";
			$niper = $_POST['nip'.$personas];
			
//			echo $_POST['nip'.$personas]."<br>";
//			echo $_POST[$cadena]."<br>";
			$query = "insert into personas_grupo (nip,id_grupo) values ($niper,'$id_grupo')";
			$result = mysql_query($query,$link);
//			if ($_POST[$cadena] != "")
//			 {
 			  $query_historial = "insert into historial_grupos (id_hist_grupos, fecha, nip, id_grupo, fecha_inicio, fecha_fin, id_sede_caso)
							values (null, now(), $niper, $id_grupo, '$fecha_ini', '$fecha_fin', $id_sede_caso);";
//			 }
//			echo $query_historial."<br>";
			$result_hist = mysql_query($query_historial,$link);							
		   }
		 }
	   }
	   cambiar_ventana("personas_grupos.php");
	   exit;
	}

?>
<script language="JavaScript"><!--

// Esta funcion verifica que se hayan ingresado todos los datos obligatorios

	function Verifica()
	{
	    if(form1.id_grupo.value == "" || form1.nip.value == "")
		{alert('Debe ingresar obligatoriamente ambos');
		return false}
	}

	function CambioOpcion(targ,selObj,restore)
	{
		eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
		if (restore) selObj.selectedIndex=0;
	}
//--></script>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML><!-- InstanceBegin template="/Templates/layout.dwt" codeOutsideHTMLIsLocked="false" -->
<HEAD>
<!-- InstanceBeginEditable name="doctitle" -->
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<!-- InstanceEndEditable --><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!-- InstanceBeginEditable name="head" -->


<link href="Templates/tablas-eec.css" rel="stylesheet" type="text/css">
<!-- InstanceEndEditable -->
<link href="tablas-eec.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
	margin-left: 10px;
	margin-top: 10px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style></HEAD>

<BODY>
<div align="center" class="tablas" id="1"><!-- InstanceBeginEditable name="contenido" -->
<span class="en_tabla">
<!-- Tabla para altas -->
</span>
<form  name="form1" action="personas_grupos.php" method="POST" onSubmit="return Verifica()">
    <!--span class="en_tabla"-->
	<table border="0"  width="100%" height="150" align="center" class="en_tabla"> 
	<table border="0" align="center"> 
	<!--/span-->
    <TR align="center"><TD colspan="2" class="en_tabla"><strong>ASIGNACION DE ESPECIALISTAS A GRUPOS</strong></TD><TR>
	<TR><TD colspan="2">&nbsp;</TD></TR>
	<TD class="en_tabla"><strong>Sede</strong></TD>
	  <TD class="en_tabla">
  	    <select name="id_sede" id="id_sede" onChange="CambioOpcion('self',this,0)">
		   <?
		   if ($id_sede_caso == 1)
		    { ?>
		      <option selected value="">-- Seleccione Sede -</option>
			  <?
		   	 $sqlsel_sede = "select id_sede, sede from sedes";
			}
		   else
		    {
			 $sqlsel_sede = "select id_sede, sede from sedes where id_sede = $id_sede_caso";
			}
			$result_sede = @mysql_query($sqlsel_sede);
			if (@mysql_affected_rows() == 0)
		 	 {
			  echo "No hay sedes registradas en el catalogo";
		 	 }
			else 
			 {
			  while ($row = mysql_fetch_array($result_sede))
			   { 
				$id_se = $row['id_sede'];
			  	$sed = $row['sede'];
				?> 
		        <!--option value="<? //echo $row['id_grupo']; ?>"><? //echo $row['grupo']; ?></option-->
		  	    <?
	    		if ($id_se == ($sede))
				 {
				  $selected = 'selected="selected"';
				 } 
			    else
				 {
				  $selected = "";
				 }
	 		    echo "<option ".$selected." value=\"personas_grupos.php?sede=".$id_se."\">".$sed."</option>\n";
	      	   } // fin while
			 } // fin else ?> 
        </select>
		</td>
    </tr>
	  
	<TR>
    <TD class="en_tabla"><strong>Asignar al Grupo</strong></TD>
	  <TD class="en_tabla">
	    <select name="id_grupo">
	      <option selected value="">-- Seleccione Grupo -</option>
 	      <?
     $pergru = array();
     $cotides = array();
	 $i = 0;
	 $cuenta_per = 0;
	 if ($id_sede_caso == 1)
	  {
	   $sqlsel_nip = "select id_grupo, grupo from grupo where id_Sede = $_GET[sede]";
	  }
	 else
	  {
       $sqlsel_nip = "select id_grupo, grupo from grupo where id_Sede = $id_sede_caso";	  
	  }
	$result_nip = @mysql_query($sqlsel_nip);
	if (mysql_num_rows($result_nip) == 0)
	{
	  echo "Todos los especialistas estan asignados";
	}
	else 
	{
	while ($row = mysql_fetch_array($result_nip))
	 { 
	 ?> 
	      <option value="<? echo $row['id_grupo']; ?>"><? echo $row['grupo']; ?></option>
     <?
	 }
	} ?>
        </select>
 	  </td> 
	</tr>
		<td class="en_tabla"><strong>Fecha Inicial&nbsp;&nbsp;
	<input name="fechaini" type="text" id="fechaini" size="16" maxlength="16" value="<? echo date("d/m/Y");?>"></strong></td>
	<td class="en_tabla"><strong>Fecha Final&nbsp;&nbsp;
	<input name="fechafin" type="text" id="fechafin" size="16" maxlength="16" value="<? echo date("d/m/Y");?>"></strong></td>


 	<span class="en_tabla">
 	<?
	 $sqlsel_nip = "select nip, nombre from empleado a where nip not in (select nip from personas_grupo) and (substr(nip,1,4)) != '9999' and nip != '11111111' and id_sede = $id_sede_caso order by 2";	
	 $result_nip = @mysql_query($sqlsel_nip);
	 $cant_per = @mysql_num_rows($result_nip);
	 if ($cant_per == 0 )
  	  {?>
    </span>
 	<tr><td colspan="2" class="en_tabla"><font color="#FF0000"><strong><br>
       Todos los especialistas tienen grupo asignado</strong></font></td></tr>
    <span class="en_tabla">
    <? }
	 else
	  { ?>
    </span>
    <TR><TD class="en_tabla" bgcolor="#D9E9CC"><strong>Especialista</strong></TD><TD class="en_tabla" bgcolor="#EBEBEB"><strong>Asignar</strong></TD><td></TR>
		<TR>
	    <? 
	 	$cuenta_per = 0;
		while ($row = mysql_fetch_array($result_nip))
		 { 
	  	  $cadena = ("nip".($cuenta_per+1));
	//      echo $cadena." ";
		  $valarray = $row['nip'];
		  ?><TD class="en_tabla"><? echo $row['nombre']; ?></TD><TD class="en_tabla">
        <?
	      printf("<input name=\"$cadena\" type=\"checkbox\" value=\"$valarray\">");
		  ?>
	    </TD></tr>
		<span class="en_tabla">
 	<?
		  $cuenta_per = $cuenta_per +1;
		 } 
	?>
 	</td> 
	</tr>

	    </span>
	 <TR>
	   <TD align="center" colspan="2">
   	     <p>
	       <span class="en_tabla">
	     <input type="hidden" name="cant_per" value="<? echo $cant_per;?>">
	     <input type="hidden" name="cuenta_per" value="<? echo $cuenta_per;?>">
	     <input type="hidden" name="ins" value="1">
	       </span></p>
   	     <table width="400" border="0" cellpadding="0" cellspacing="0" bgcolor="#D9E9CC">
           <tr>
             <td><div align="center">
               <span class="en_tabla">
               <input type="submit" name="agregar" value="Agregar">
               </span></div></td>
           </tr>
         </table>   	     </TD>
  </form> 
    <span class="en_tabla">
	</TR>
	<? } ?>
	</table>
    </span>
  <tr><td>&nbsp;</td></tr>
    <span class="en_tabla">
</table>
<!--Termina tabla de altas-->

<?
$sql_sel="select * from personas_grupo";
$result=@mysql_query($sql_sel,$link);
$cant_reg = @mysql_affected_rows();
//echo $cant_reg;
if ($cant_reg == 0)
 {
  echo "<p align=\"center\"><font color=\"#FF0000\"><strong>No hay registros en la base</strong></font></p>";
//  echo "<p align=\"center\"><INPUT align=\"center\" TYPE=\"button\" VALUE=\"Regresar\" onClick=\"history.back(1)\"><!--/p-->";	 
//  echo "<!--p align=\"center\"--> <input type=\"button\" value=\"Cerrar ventana\" onclick=window.close();></p>";
  exit;
 }
else
 {
  ?>
	</span>
    <TABLE  BORDER=0 align="center" CELLPADDING=2 CELLSPACING=2 class="en_tabla">
		<TR align="center">
		<TD bgcolor="#D6E7C7" class="en_tabla" ><strong>Grupo</strong></strong></TD>
		<TD bgcolor="#EBEBEB" class="en_tabla" ><strong>Sede</strong></TD>
		<TD bgcolor="#D6E7C7" class="en_tabla" ><strong>Especialista</strong></TD>
		<TD bgcolor="#EBEBEB" class="en_tabla"><strong>&nbsp;</strong></TD>
		<!--td bgcolor="#EBEBEB">&nbsp;</td-->
	    <!--td>&nbsp;</td-->
		</TR>
		<?
//		$sql_sel="select a.nip, a.id_grupo, b.grupo, c.nombre from personas_grupo a, grupo b, empleado c where a.id_grupo = b.id_grupo and a.nip = c.nip order by 2 limit $rangoini,$rangofin";
		$sql_sel="select a.nip, a.id_grupo, b.grupo, c.nombre, d.sede from personas_grupo a, grupo b, empleado c, sedes d where a.id_grupo = b.id_grupo and a.nip = c.nip and substr(a.nip,1,4) != '9999' and b.id_sede = d.id_sede order by 2 limit $rangoini,$rangofin";
		$result=@mysql_query($sql_sel,$link);
		$correlativo = 0;
		while($row = @mysql_fetch_array($result)) 
		 {?>
			<tr>
			<td bgcolor="#D6E7C7" class="en_tabla">
		    <? // $correlativo = $correlativo + 1 ;
			echo $row["grupo"];/*echo $correlativo;*/ ?>
			</td>
			<td bgcolor="#EBEBEB" class="en_tabla"><? echo $row["sede"]; ?></td>
			<td bgcolor="#D6E7C7" class="en_tabla"><? echo $row["nombre"]; ?></td>
			<!--td bgcolor="#D6E7C7" class="en_tabla"><a href="edicion.php?tabla=personas_grupo&pag=personas_grupos.php&id=<? echo $row["nip"]; ?>" title="Editar" target="mainFrame"><img src="images/iconos/b_edit.png" width="16" height="16" border="0"></a></td-->		
			<td bgcolor="#EBEBEB" class="en_tabla"><a href="personas_grupos.php?eli=1&id=<? echo $row["nip"]; ?>" title="Eliminar" target="mainFrame"><img src="images/iconos/button_drop.png" width="11" height="13" border="0"></a></td>
			</tr>
		<?
	/*	  printf("<tr><td align='center'>%d</td> <td align='center'>%s</td> </tr>",
		  $row["id_tipo_archivo"],$row["tipo_archivo"]);*/
		
		 }
	//	 	  <td align='center'><a href=\"cancelorden.php\">Cancelar</a></td> 
		@mysql_free_result($result);
	 } 
	?>
  </table>
	
	
	<span class="en_tabla">
	<!--Paginagion de consulta -->
	</span>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<form name="form3" method="post" action="">
	<table border="0" align="center">
     <tr>
		<?
			if ($PagNow != 1)
			{
				echo "<td><a href=\"validapag.php?linkant=personas_grupos.php&pag=-1&maxpag=".$maxpag."\">Anterior</a></td>";
			}
			if ($maxpag > 10)
			{
				for ($contpag = $PagNow;($contpag <= $maxpag) && ($contpag <= ($PagNow + 9));$contpag++)
				{ 
					echo "<td><a href=\"validapag.php?linkant=personas_grupos.php&pag=".$contpag."&maxpag=".$maxpag."\">".$contpag."</a></td>";
				}
			}
			else
			{
			 if ($maxpag > 1 ) { 
				for ($contpag = 1;($contpag <= $maxpag) && ($contpag <= ($PagNow + 9));$contpag++)
				{ 
					echo "<td><a href=\"validapag.php?linkant=personas_grupos.php&pag=".$contpag."&maxpag=".$maxpag."\">".$contpag."</a></td>";
				}
			  }
			}
			
			if ($PagNow != $maxpag)
			{
				echo "<td><a href=\"validapag.php?linkant=personas_grupos.php&pag=0&maxpag=".$maxpag."\">Siguiente</a></td>";
			}
		?>  
    </tr>
  </table>
</form>
<!-- InstanceEndEditable --></div>
<p align="center">&nbsp;</p>
</BODY>
<!-- InstanceEnd --></HTML>
