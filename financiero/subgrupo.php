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
	$rangoini = (10 * $_SESSION['PagNow']) - 10;
	$rangofin = 10;
	
	$sqlsel_g = "select a.id_subgrupo, a.subgrupo, b.grupo from grupo b, subgrupo a where a.id_grupo=b.id_grupo";	
	$resu_g = mssql_query($sqlsel_g);
	$Total = mssql_num_rows($resu_g);
	$maxpag = ceil($Total / 10);	
	
	$sqlsel = "select top 10 a.id_subgrupo, a.subgrupo, b.grupo from grupo b, subgrupo a where a.id_grupo=b.id_grupo and a.id_subgrupo BETWEEN $rangoini and $Total";

	if ($maxpag == 0) {$maxpag = 1;}


if (isset($_POST['ins'])) {	$ins=$_POST['ins']; /*echo $ins."<br>";*/ } else { $ins=0; }
	if (isset($_GET['eli'])) { $eli=$_GET['eli']; /*echo $eli."<br>";*/ } else { $eli=0; }
	if (isset($_GET['id'])) { $id=$_GET['id']; /*echo $id."<br>"; */} else { $id=0; }
	
	if ( $sstipo != 1)
	{
//	 cambiar_ventana('mtlogin.php');
	}

 if ( isset($_POST['inserta']) && ($_POST['inserta'] == 1) ) 
	{
		$verifica = "select subgrupo from subgrupo where subgrupo = '".$_POST['subgrupo']."'";
		$resver = mssql_query($verifica);
		if (mssql_num_rows($resver) > 0) 
			{
			 envia_msg('El subgrupo que desea ingresar ya existe en el sistema');
			}
		else
			{
				$sql="insert into subgrupo (subgrupo, id_grupo, ident_subgrupo) 
						values ('".$_POST['subgrupo']."',".$_POST['grupo'].",'".$_POST['ident_subgrupo']."') ";
				$result = mssql_query($sql); 
				$rsRows = mssql_query("select @@rowcount as rows");
				 $rows = mssql_fetch_assoc($rsRows); 
					 //  envia_msg( $rows['rows']);
					 //envia_msg(mssql_rows_affected($result) );
			   if ( $rows['rows'] == 1 )
				 {
					envia_msg('Se insert� exitosamente el registro');	
				 }	
				else
				 {
					error_msg('No se pudo insertar el registro');	
				 }
			  }
	}


	// Elimina el registro
	if ($eli == 1)
	{

			$selec = "delete from subgrupo where id_subgrupo = '$id'";
			echo $selec;
			$result = mssql_query($selec);
			$rsRows = mssql_query("select @@rowcount as rows");
			$rows = mssql_fetch_assoc($rsRows); 
	  	    if ( $rows['rows'] == 1 )
			 {
		 	    envia_msg("Registro eliminado exitosamente");
			 }
			 else
			 {
			     envia_msg("No se pudo eliminar el registro");
			 }
//		}
//		header("Location: agencias.php");
		cambiar_ventana("subgrupo.php");
		exit;

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
</script>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="HojaEstilo.css" rel="stylesheet" type="text/css">

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
	color: #000000;
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

<form name="form1" method="post" action="subgrupo.php" onSubmit="return Verifica()">
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
    <td colspan="7"><div align="center"><span class="Estilo1 Estilo2"> SUBGRUPOS</span></div></td>
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
    <td class="Estilo22" align="right">Grupo <font color="#FF0000"><strong>**</strong></font></td>
    <td class="Estilo7">
		<select name="grupo" >
		<? 
			$sql="select id_grupo, ident_grupo, grupo from grupo";
			$result  = mssql_query($sql);
			while ($row = mssql_fetch_array($result))
			 { ?>
			  	<option value="<? echo $row['id_grupo']; ?>"><? echo $row['ident_grupo'].' '.$row['grupo']; ?></option>
		<?	 }
		?>
		</select>
	</td>
  </tr>

  <tr class="Estilo1" >
    <td class="Estilo22" align="right">SubGrupo <font color="#FF0000"><strong>**</strong></font></td>
    <td class="Estilo7"><input name="ident_subgrupo" type="text" class="Estilo7" maxlength="2"  size="2" onKeyUp="javascript:this.value=this.value.toUpperCase();"></td>
  </tr>


  <tr class="Estilo1" >
    <td class="Estilo22" align="right">Concepto <font color="#FF0000"><strong>**</strong></font></td>
    <td class="Estilo7"><input name="subgrupo" type="text" class="Estilo7" maxlength="150"  size="100" onKeyUp="javascript:this.value=this.value.toUpperCase();"></td>
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

<table border="0" align="center" class="Estilo1 ">
  <tr>
    <td bgcolor="#C9CDED"><strong>Grupo</strong></td>
    <td bgcolor="#99CCFFF" width="500" align="center"><strong>SubGrupo</strong></td>
    <td bgcolor="#C9CDED">&nbsp;</td>
    <!--td bgcolor="#99CCFF">&nbsp;</td-->
  </tr>
 	<?php
//	echo "$rangoini.'--'.$rangofin";
//	$sqlsel = "select id_grupo, grupo from grupo where id_grupo in($rangoini, $rangofin) order by 1";
//	$sqlsel = "select id_grupo, grupo from grupo where id_grupo >= $rangoini and id_grupo <= $rangofin order by 1";
		//	$sqlsel = "select a.grupo, a.ident_grupo, b.id_subgrupo, b.subgrupo, b.ident_subgrupo from grupo a, subgrupo b where a.id_grupo = b.id_grupo"; //and b.id_subgrupo >= $rangoini and b.id_subgrupo <= $rangofin order by 3";
//	echo $sqlsel;
//	$sqlsel = "SELECT * FROM ( SELECT *, ROW_NUMBER() OVER (ORDER BY id_grupo) as row FROM grupo ) as grupo WHERE row > $rangoini and row <= $rangofin";

	$result = mssql_query($sqlsel);
	$correlativo = 0;
		while($row = @mssql_fetch_array($result)) 
		{
		
		$cod = $row[0];
	?>
	<tr>
		<td bgcolor="#C9CDED"><? echo $row['ident_grupo'].' '.$row["grupo"]; ?></td>
		<td bgcolor="#99CCFF"><? echo $row["ident_subgrupo"].' '.$row["subgrupo"]; ?></td>
		
		<!--td bgcolor="#C9CDED">		
		<a href="edicion_subgrupo.php?tabla=subgrupo&pag=subgrupo.php&id=<? //echo $row["id_subgrupo"]; ?>" title="Editar" target="mainFrame"><img src="images/iconos/b_edit.png" width="16" height="16" border="0"></a></td-->
		
		
		<td bgcolor="#C9CDED"><a href="editar_subgrupo.php?codigo=<? echo $cod; ?>"> <img src="images/iconos/b_edit.png" width="16" height="16" border="0"></a></td>
		
		
	    <!--td bgcolor="#99CCFF"><a href="subgrupo.php?eli=1&id=<?//echo $row["id_subgrupo"]; ?>" title="Eliminar" target="self"><img src="images/iconos/button_drop.png" width="16" height="16" border="0"></a></td-->
	</tr>
	<?
 		}
		@mysql_free_result($sqlsel);
	?>
</table>

<form name="form3" method="post" action="">
  <table border="1" align="center" bgcolor="#C9CDED" class="Estilo1">
    <tr>
		<?
			if ($PagNow != 1)
			{
			 echo "<td>*".$maxpag."</td>";
				echo "<td><a href=\"validapag.php?linkant=subgrupo.php&pag=-1&maxpag=".$maxpag."\">Anterior</a></td>";
			}
			if ($maxpag > 10)
			{ 
			 echo "<td>**".$maxpag."</td>";
				for ($contpag = $PagNow;($contpag <= $maxpag) && ($contpag <= ($PagNow + 9));$contpag++)
				{ 
					echo "<td><a href=\"validapag.php?linkant=subgrupo.php&pag=".$contpag."&maxpag=".$maxpag."\">".$contpag."</a></td>";
				}
			}
			else
			{
				if ($maxpag > 1)
				{
					for ($contpag = 1;($contpag <= $maxpag) && ($contpag <= ($PagNow + 9));$contpag++)
					{ 
						echo "<td><a href=\"validapag.php?linkant=subgrupo.php&pag=".$contpag."&maxpag=".$maxpag."\">".$contpag."</a></td>";
					}
				}
			}
			
			if ($PagNow != $maxpag)
			{
				echo "<td><a href=\"validapag.php?linkant=subgrupo.php&pag=0&maxpag=".$maxpag."\">Siguiente</a></td>";
			}
		?>  
    </tr>
  </table>
</form>

</body>
</html>
