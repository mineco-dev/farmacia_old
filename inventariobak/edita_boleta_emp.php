<?
session_start();
include('conectarse.php');
$_SESSION['nivel']=1;

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

/*	if ( $sstipo != 1)
	{
	 cambiar_ventana('mtlogin.php');
	}*/

	include('INCLUDES/inc_header.inc');
	$dbms=new DBMS($conexion); 
 if ( isset($_POST['inserta']) && ($_POST['inserta'] == 1) ) 
	{
/*		$verifica = "select nombre_empresa from empresa where nombre_empresa = '$_POST[nombre_empresa]'";
		$resver = mssql_query($verifica);
		if (mssql_num_rows($resver) > 0) 
			{
			 error_msg('La empresa que desea ingresar ya existe en el sistema');
			}
		else
			{*/
			if (empty($_POST["anio"]) || empty($_POST['mes']) || empty($_POST['dia']) )
			 {
			  $fecha_est = '';
			 }
			else
			 {
			  $fecha_est = $_POST["anio"].'/'.$_POST['mes'].'/'.$_POST['dia'];
			 }
			 if ($_POST['zona'] == 0)  { $zona = 0; } else { $zona = $_POST['zona']; }
 			 if (empty($_POST['celular_contacto']))  { $celular = 'null'; } else { $celular = $_POST['celular_contacto']; }
			 if (($_POST['fax'] == 0) || empty($_POST['fax'] ))  { $fax = 'null'; } else { $fax = $_POST['fax']; }
 			 if ( empty($_POST['email']) )  { $mail = 'null'; } else { $mail = $_POST['email']; }
  			 if ( empty($_POST['web']) )  { $web = 'null'; } else { $web = $_POST['web']; }
  			 if ( empty($_POST['id_tipo_negocio']))  { $id_tipo_negocio = 'null'; } else { $id_tipo_negocio = $_POST['id_tipo_negocio']; }
  			 if ( empty($_POST['tipo_negocio_desc']))  { $otro_tipo_negocio = 'null'; } else { $otro_tipo_negocio = $_POST['tipo_negocio_desc']; }
   			 if ( empty($_POST['id_asociacion']))  { $id_asociacion = 'null'; } else { $id_asociacion = $_POST['id_asociacion']; }
  			 if ( empty($_POST['asociacion']))  { $asociacion = 'null'; } else { $asociacion = $_POST['asociacion']; }
  			 if ( empty($_POST['producto']))  { $producto= 'null'; } else { $producto = $_POST['producto']; }
  			 if ( empty($_POST['personas']))  { $personas = 'null'; } else { $personas = $_POST['personas']; }
  			 if ( empty($_POST['id_actividad_economica']))  { $id_actividad_economica = 'null'; } else { $id_actividad_economica = $_POST['id_actividad_economica']; }
  			 if ( empty($_POST['otra_actividad_eco']))  { $otra_actividad_eco = ''; } else { $otra_actividad_eco = $_POST['otra_actividad_eco']; }
  			 if ( empty($_POST['id_mercado']))  { $id_mercado = 0; } else { $id_mercado = $_POST['id_mercado']; }
   			 if ( empty($_POST['asistencia_tecnica']))  { $asistencia_tecnica = 'null'; } else { $asistencia_tecnica = $_POST['asistencia_tecnica']; }
  			 if ( empty($_POST['espec_asitec']))  { $espec_asitec = 'null'; } else { $espec_asitec = $_POST['espec_asitec']; }
   			 if ( empty($_POST['id_administrada']))  { $id_administrada = 0; } else { $id_administrada = $_POST['id_administrada']; }
   			 if ( empty($_POST['asistencia_crediticia']))  { $asistencia_crediticia = 'null'; } else { $asistencia_crediticia = $_POST['asistencia_crediticia']; }
  			 if ( empty($_POST['espec_asicred']))  { $espec_asicred = 'null'; } else { $espec_asicred = $_POST['espec_asicred']; }
			 
 			if (isset($_POST['id_asociacion1'] )) { $idas1=1; } else {$idas1 = 0; }
			if (isset($_POST['id_asociacion2'] )) { $idas2=1; } else {$idas2 = 0; }
			if (isset($_POST['id_asociacion3'] )) { $idas3=1; } else {$idas3 = 0; }
			if (isset($_POST['id_asociacion4'] )) { $idas4=1; } else {$idas4 = 0; }
			if (isset($_POST['id_asociacion5'] )) { $idas5=1; } else {$idas5 = 0; }
			if (isset($_POST['id_asociacion6'] )) { $idas6=1; } else {$idas6 = 0; }
			if (isset($_POST['id_asociacion7'] )) { $idas7=1; } else {$idas7 = 0; }			
			if (isset($_POST['id_asociacion8'] )) { $idas8=1; } else {$idas8 = 0; }			

//	begin tran
			 $sql="update empresa set nombre_empresa='$_POST[nombre_empresa]', direccion='$_POST[direccion]', zona=$zona, id_departamento='$_POST[iddepartamento]',
						id_municipio='$_POST[idmunicipio]', telefono='$_POST[telefono]', nombre_contacto='$_POST[nombre_contacto]', celular_contacto=$celular, 
						fecha_establecio='$fecha_est', fax=$fax, email='$mail', web='$web', id_tipo_negocio= $id_tipo_negocio, otro_tipo_negocio='$otro_tipo_negocio', 
						id_asociacion=$id_asociacion, otro_tipo_asociacion='$asociacion', producto_principal='$producto', cantidad_empleados=$personas, 
						id_actividad_economica=$id_actividad_economica, otro_actividad_economica='$otra_actividad_eco', id_mercado=$id_mercado, 
						asistencia_tecnica=$asistencia_tecnica, espec_as_tecnica='$espec_asitec', administracion='$id_administrada', asistencia_crediticia=$asistencia_crediticia, 
						espec_as_cred='$espec_asicred', id_asociacion1=$idas1, id_asociacion2=$idas2, id_asociacion3=$idas3, id_asociacion4=$idas4, id_asociacion5=$idas5,
						id_asociacion6=$idas6, id_asociacion7=$idas7, id_asociacion8=$idas8								
						where id_empresa = ".$_POST['codigo_empresa'];
				$result = mssql_query($sql); 
//				echo $sql;
				$rsRows = mssql_query("select @@rowcount as rows");
				$rows = mssql_fetch_assoc($rsRows); 
					 //  envia_msg( $rows['rows']);
					 //envia_msg(mssql_rows_affected($result) );
			   if ( $rows['rows'] == 1 )
				 {
					envia_msg('Se actualiz� exitosamente el registro');	
					cambiar_ventana('consulta.php');
//					commit tran
				 }	
				else
				 {
					error_msg('No se pudo actualizar el registro');	
//					rollback tran
				 }
				 mssql_free_statement($result);
//			  }
	}

?>

<script language="JavaScript">
	function Verifica()
	 {
		

//		if (form1.nombre.value == "" || form1.apellido.value == "" || form1.idregistro.value == "" || form1.cedula.value == "" || form1.iddepartamento.value == "" || form1.usuario.value = "" || form1.password.value == "" || form1.iddepartamento2 == value ""  )
		if (form1.nombre_empresa.value == "" || form1.direccion.value == "" || form1.iddepartamento.value == "" || form1.idmunicipio.value == "" || form1.telefono.value == "" || form1.telefono.value == "" || form1.nombre_contacto.value == "")
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
	patron = /[\d]/; 
    te = String.fromCharCode(tecla); // 5
    return patron.test(te); // 6
} 


function modificarEstado(){
        if(document.getElementById("id_asociacion").checked)
                document.getElementById("asociacion").disabled =false;
        else
                document.getElementById("asociacion").disabled= true;
}


 function hab(){ 
    document.form1.asociacion.disabled = false; 
   } 


 function habilita(){ 
    document.form1.tipo_negocio_desc.disabled = false; 
   } 

   function deshabilita(){ 
    document.form1.tipo_negocio_desc.disabled = true; 
    document.form1.tipo_negocio_desc.value = ""; 
   } 



 function habilitar(){ 
    document.form1.otra_actividad_eco.disabled = false; 
   } 

   function deshabilitar(){ 
    document.form1.otra_actividad_eco.disabled = true; 
    document.form1.otra_actividad_eco.value = ""; 
   } 
</script>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
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
		<a href="mtlogin.php"><!--img src="tareas.gif" width="16" height="16" border="0"-->[ <-- Salir ]</a>
		</td>
		<!--td align="right" >
		<a href="mtlogin.php"><!--img src="tareas.gif" width="16" height="16" border="0">[ Cerrar Sesión ]</a>
		</td-->

	</tr>
</table>

<form name="form1" method="post" action="edita_boleta_emp.php" onSubmit="return Verifica()">
<!--form name="form1" method="post" action="asesoringreso.php"-->
  <table width="91%"  border="0" align="center">
    <tr>
      <th colspan="2" scope="col"><p class="Estilo3"><span class="Estilo1 Estilo8">
      </span>ViceMinisterio de Micro, Peque&ntilde;a y Mediana Empresa<br>Ministerio de Econom�a de Guatemala </p></th>
    </tr>
  </table>

  <p class="Estilo8 Estilo7"></p>
  <table  border="0" align="center" cellspacing="0">
  <tr bgcolor="#0066CC">
    <td colspan="7"><div align="center"><span class="Estilo1 Estilo2"> EDICION DE REGISTRO EMPRESARIAL </span></div></td>
    </tr>
	<?
	$conection = mssql_connect("server_appl","sa","sa") or die("no se puede conectar a SQL Server");
	 mssql_select_db("vimipyme",$conection);
	 
    $sql = "select a.id_empresa, a.nombre_empresa, a.direccion, a.zona, a.id_departamento, a.id_municipio, a.telefono, a.nombre_contacto, 
		    a.celular_contacto,	convert(varchar,a.fecha_establecio,105) fecha_establecio, a.fax, a.email, a.web, a.id_tipo_negocio, a.otro_tipo_negocio, a.id_asociacion, a.otro_tipo_asociacion,  
 			a.producto_principal, a.cantidad_empleados, a.id_actividad_economica, a.otro_actividad_economica, a.id_mercado, a.asistencia_tecnica, 
 			a.espec_as_tecnica, a.administracion, a.asistencia_crediticia, a.espec_as_cred, b.nombre_departamento, c.nombre_municipio,
			a.id_asociacion1, a.id_asociacion2, a.id_asociacion3, a.id_asociacion4, a.id_asociacion5, a.id_asociacion6, a.id_asociacion7, a.id_asociacion8, usuario, fecha_registro
			from empresa a,	 RRHH.dbo.asesor_departamento b, RRHH.dbo.asesor_municipio c
			where a.id_municipio = c.idmunicipio and c.iddepartamento = b.iddepartamento 
			and a.id_empresa = ".$_GET['eid'];
	$result =  mssql_query($sql);
	while ($row = mssql_fetch_array($result))
	 {
   ?>
  <tr><Td><br></Td></tr>
  <tr class="Estilo1" >
    <td class="Estilo22" align="right">Nombre de la Empresa<font color="#FF0000"><strong>**</strong></font></td>
    <td class="Estilo7"><input name="nombre_empresa" type="text" class="Estilo7" maxlength="100"  size="50" onKeyUp="javascript:this.value=this.value.toUpperCase();"
	 					value="<? echo $row['nombre_empresa']; ?>">
						<input type="hidden" name="codigo_empresa" value="<? echo $_GET['eid']; ?>"></td>
  </tr>
  <tr class="Estilo1" >
  <tr class="Estilo1" >
    <td class="Estilo22" align="right">Dirección<font color="#FF0000"><strong>**</strong></font></td>
    <td class="Estilo7"><input name="direccion" type="text" class="Estilo7" maxlength="200"  size="50" onKeyUp="javascript:this.value=this.value.toUpperCase();" 
						value="<? echo $row['direccion']; ?>">
  	Zona<font color="#FF0000"><strong></strong></font>
		<select name="zona" class="Estilo1">
				<option></option>		
		<?
		$i=1;
			
		 while ($i<=25)
		  {
		  if ($i ==  $row['zona'])
		   {
		 ?>
			<option selected value="<? echo $i; ?>"><? echo $i; ?></option>
		 <?  
		   }
		  else
 		   {
		 ?>
			<option value="<? echo $i; ?>"><? echo $i; ?></option>
		 <?  
		   }

		 $i++;
		 }
		 
		?>
	</select></td>
  </tr>
   <tr class="Estilo1"><td></td><td colspan="2"><font color="#FF0000"><strong>No incluya la zona en dirección por favor ingresela en el campo respectivo</strong></font></td></tr>
  <tr class="Estilo1">
    <td class="Estilo22" align="right">Departamento<font color="#FF0000"><strong>**</strong></font></td>
    <td class="Estilo7">
	<div align="left">
    <?
	$conection = mssql_connect("server_appl","sa","sa") or die("no se puede conectar a SQL Server");
	mssql_select_db("RRHH",$conection);
    ?>
		<select name="iddepartamento" class="TituloMedios" id="iddepartamento" onFocus="javascript:cargarCombo('subactividades4.php', 'iddepartamento', 'Div_Subactividades3')"  onChange="javascript:cargarCombo('subactividades4.php', 'iddepartamento', 'Div_Subactividades3')">
          <option value='0'> Seleccione </option>
          <? 
			   

				$dbms->sql="select iddepartamento, nombre_departamento from asesor_departamento"; 
				$dbms->Query(); 
				while($Fields=$dbms->MoveNext()) 
				{
				  if  ( $Fields["iddepartamento"] == $row['id_departamento'])
				   {
					print "<option selected value=\"".$Fields["iddepartamento"]."\">".$Fields["nombre_departamento"]."</option>"; 
				   }
				  else
				   {
					print "<option value=\"".$Fields["iddepartamento"]."\">".$Fields["nombre_departamento"]."</option>"; 
				   }

				}
			?>
        </select>

		</span></span> 
	  </td>
	</tr><tr class="Estilo7">
    <td class="Estilo22" align="right">	
Municipio<font color="#FF0000"><strong>**</strong></font>
</td>
    <td class="Estilo22">	
    
	<span class="Estilo6">      
		<div align="left">
		  <div id="Div_Subactividades3"> 
				<label for="SubActividad3"></label> 
                <select name="idmunicipio"  id="Subactividades3" class="TituloMedios">
				<? $dbms->sql="select  idmunicipio, nombre_municipio from asesor_municipio where iddepartamento = ".$row['id_departamento']; 
					$dbms->Query(); 
					while($Fields=$dbms->MoveNext()) 
					{
					  if  ( $Fields["idmunicipio"] == $row['id_municipio'])
					   {
						print "<option selected value=\"".$Fields["idmunicipio"]."\">".$Fields["nombre_municipio"]."</option>"; 
					   }
					  else
					   {
					   print "<option value=\"".$Fields["idmunicipio"]."\">".$Fields["nombre_municipio"]."</option>"; 
					   }
					}?>
            </select>
</div>
        </div>
	</span>
	</td>
  </tr>

        
   
   
  <tr class="Estilo1" >
    <td class="Estilo22" align="right">Telefono<font color="#FF0000"><strong>**</strong></font></td>
    <td class="Estilo7"><input name="telefono" type="text" class="Estilo7" maxlength="8"  size="8" onKeyUp="javascript:this.value=this.value.toUpperCase();" onkeypress="return validar(event)"
						value= "<? echo $row['telefono']; ?>">
    Fax<input name="fax" type="text" class="Estilo7" maxlength="8"  size="8" onKeyUp="javascript:this.value=this.value.toUpperCase();" onkeypress="return validar(event)"
		value= "<? echo $row['fax']; ?>"></td>
  </tr>
   <tr class="Estilo1" >
    <td class="Estilo22" align="right">Persona a contactar<font color="#FF0000"><strong>**</strong></font></td>
	<td class="Estilo22" align="left"><input name="nombre_contacto" type="text" class="Estilo7" maxlength="200"  size="75" onKeyUp="javascript:this.value=this.value.toUpperCase();"
									value= "<? echo $row['nombre_contacto']; ?>">
    Celular<font color="#FF0000"><strong></strong></font>
    <input name="celular_contacto" type="text" class="Estilo7" maxlength="8"  size="8" onKeyUp="javascript:this.value=this.value.toUpperCase();" onkeypress="return validar(event)"
		value= "<? echo $row['celular_contacto']; ?>"></td>
  </tr>
  <tr class="Estilo1" >
    <td class="Estilo22" align="right">Correo Electronico<font color="#FF0000"><strong></strong></font></td>
    <td class="Estilo7"><input name="email" type="text" class="Estilo7" maxlength="40"  size="40" onKeyUp="javascript:this.value=this.value.toLowerCase();" 
						value= "<? if ($row['email'] != 'null') { echo $row['email']; }?>">
</td>
  </tr>
  <tr class="Estilo1" >
    <td class="Estilo22" align="right">Website: www.<font color="#FF0000"><strong></strong></font></td>
    <td class="Estilo7"><input name="web" type="text" class="Estilo7" maxlength="200"  size="75" onKeyUp="javascript:this.value=this.value.toLowerCase();" 
						value= "<? if ($row['web'] != 'null') { echo $row['web']; } ?>"></td>
  </tr>
 
  <tr class="Estilo1">
    <td class="Estilo22" align="right">Fecha de Constitución<font color="#FF0000"><strong></strong></font></td>
      <td colspan="5" class="Estilo7"><span class="Estilo22">d�a
		<select name="dia" class="Estilo1">
			<option></option>		
	<?
	$i=1;
		
	 while ($i<=31)
	  {
		 if (substr($row['fecha_establecio'],0,2) == $i)
		  {  
	  ?>
		   <option selected value="<? echo $i; ?>"><? echo $i; ?></option>
	 <?   
		  }
		 else
		  { ?>
		   <option value="<? echo $i; ?>"><? echo $i; ?></option>
	 <?	  }
		  $i++;
	 }
	 
	?>
</select>
mes
<!--input name="mes3" type="text" class="Estilo1" id="mes3" size="2" maxlength="2"-->
<select name="mes" class="Estilo1">
	<option></option>		
	<?
	$i=1;
	 while ($i<=12)
	  {
		 if (substr($row['fecha_establecio'],3,2) == $i)
		  {
	  ?>
		<option  selected svalue="<? echo $i; ?>"><? echo $i; ?></option>
	  <?   
		  }
		 else
		  { ?>
		   <option value="<? echo $i; ?>"><? echo $i; ?></option>
	 <?	  }
		  $i++;
	 }
	 
	?>
</select>
a&ntilde;o
<!--input name="ano3" type="text" class="Estilo1" id="ano3" size="4" maxlength="4"--> 
<select name="anio" class="Estilo1">
			<option></option>		
	<?
	$i=1900;
	 while ($i<=date('Y'))
	  {
	   if (substr($row['fecha_establecio'],6,4) == $i)
		  {
	  ?>
		<option  selected svalue="<? echo $i; ?>"><? echo $i; ?></option>
	  <?   
		  }
		 else
		  { ?>
		   <option value="<? echo $i; ?>"><? echo $i; ?></option>
	 <?	  }
		  $i++;
	 }
	 
	?>
</select> 
<!--input name="edad" type="text" id="nacimiento" size="5"--> </span></td> 
  </tr>
  
  <tr class="Estilo1" >
    <td class="Estilo22" align="right">Información de la <br> Empresa o Negocio<font color="#FF0000"><strong></strong></font></td>
    <td class="Estilo22" align="left">
	 <? 

$conection = mssql_connect("server_appl","sa","sa") or die("no se puede conectar a SQL Server");

 mssql_select_db("vimipyme",$conection);


		$sql_tipo_neg = "select id_tipo_negocio, tipo_negocio from tipo_negocio";
	    $result_tn = mssql_query($sql_tipo_neg);
		while ($row_tn = mssql_fetch_array($result_tn))
		  {
		   if ($row_tn['id_tipo_negocio'] == $row['id_tipo_negocio'] )
		    {
			   if ( $row_tn['id_tipo_negocio'] == 5)
				 {
				  ?> 
					<input name="id_tipo_negocio" checked type="radio" value="<? echo $row_tn['id_tipo_negocio']; ?>" onclick="habilita()"> <!--onclick="modificarEstado()"> <!--onClick="return Deshabilita()"-->
				  <?
				 }
				else
				{
				  ?> 
					<input name="id_tipo_negocio" checked type="radio" value="<? echo $row_tn['id_tipo_negocio']; ?>" onclick="deshabilita()"> <!--onClick="return Deshabilita()"-->
				  <?
				 }
			}
		   else
		    {
			 $selected = '';
 			   if ( $row_tn['id_tipo_negocio'] == 5)
				 {
				  ?> 
					<input name="id_tipo_negocio" type="radio" value="<? echo $row_tn['id_tipo_negocio']; ?>" onclick="habilita()"> <!--onclick="modificarEstado()"> <!--onClick="return Deshabilita()"-->
				  <?
				 }
				else
				{
				  ?> 
					<input name="id_tipo_negocio" type="radio" value="<? echo $row_tn['id_tipo_negocio']; ?>" onclick="deshabilita()"> <!--onClick="return Deshabilita()"-->
				  <?
				 }

			}

		echo $row_tn['tipo_negocio'].'<br>'; 
		 }
	  ?>
 </td>
 </tr>
 <tr class="Estilo1">
    <td class="Estilo7" align="right">(Otros) Especifique</td>
		<td class="Estilo22" align="left"><input name="tipo_negocio_desc" type="text" class="Estilo7" maxlength="200" size="75" onKeyUp="javascript:this.value=this.value.toUpperCase();"
										 <? if ($row['id_tipo_negocio'] != 5) { ?> disabled <? } else { ?> value="<? echo $row['otro_tipo_negocio']; ?>" <? } ?> ></td>
  </tr>
<tr class="Estilo1" >
    <td class="Estilo22" align="right">Pertenece a alguna c�mara <br> o Asociación especifique<font color="#FF0000"><strong></strong></font></td>
    <td class="Estilo22" align="left">
	
	 <? 
	    $ingre = 1;
	    $sql_asoc = "select id_asociacion, asociacion from camara_asociacion";
	    $result_asoc = mssql_query($sql_asoc);
		while ($row_asoc = mssql_fetch_array($result_asoc))
		  {
		    $cadena='id_asociacion'.$ingre; // campo de la tabla consultada camara_asociacion
			$cadenasel = $row['id_asociacion'.$ingre]; // campo del query recargado de la empresa
			  if ($cadenasel == 1)
			   {
			  ?>   <input name="<? echo $cadena; ?>" checked type="checkbox" value="1"> <!--onClick="return Deshabilita()"-->
		    <? }
			 else
			   {
			    ?>   <input name="<? echo $cadena; ?>" type="checkbox" value="0"> <!--onClick="return Deshabilita()"-->
		 	    <? 
			   }
			echo $row_asoc['asociacion']."<br>";
			$ingre++;
		  }
	  ?>
 </td>
 </tr>
 <tr class="Estilo1">
    <td class="Estilo7" align="right">(Otros) Especifique</td>
		<td class="Estilo22" align="left"><input name="asociacion" type="text" class="Estilo7"  maxlength="200"  size="75" onKeyUp="javascript:this.value=this.value.toUpperCase();"
										value="<? if ($row['otro_tipo_asociacion'] != 'null') { echo $row['otro_tipo_asociacion']; }?>"></td>
  </tr>  
   <tr class="Estilo1" >
    <td class="Estilo22" align="right">Cuantas personas <br> trabajan en la empresa<font color="#FF0000"><strong></strong></font></td>
    <td class="Estilo7"><input name="personas" type="text" class="Estilo7" maxlength="3"  size="3" onKeyUp="javascript:this.value=this.value.toLowerCase();" onkeypress="return validar(event)"
						value="<? echo $row['cantidad_empleados']; ?>"></td>
  </tr>
   <tr class="Estilo1" >
    <td class="Estilo22" align="right">Especificar Producto Principal<font color="#FF0000"><strong></strong></font></td>
    <td class="Estilo7"><input name="producto" type="text" class="Estilo7" maxlength="150"  size="75" onKeyUp="javascript:this.value=this.value.toUpperCase();"
						value="<? if ($row['producto_principal']!='null') { echo $row['producto_principal']; }?>"></td>
  </tr>
  <tr class="Estilo1" >
    <td class="Estilo22" align="right">Actividad Econ�mica de su<br> empresa o negocio<font color="#FF0000"><strong></strong></font></td>
    <td class="Estilo22" align="left">
      <? $sql_actec = "select id_actividad_economica, actividad_economica from actividad_economica";
	    $result_actec = mssql_query($sql_actec);
		while ($row_actec = mssql_fetch_array($result_actec))
		  {
		    if ($row_actec['id_actividad_economica'] == 8)
			 {
			  if ($row_actec['id_actividad_economica'] == $row['id_actividad_economica'])
			   {
			  ?>
			  <input name="id_actividad_economica" checked type="radio"  value="<? echo $row_actec['id_actividad_economica']; ?>" onClick="return habilitar()">
			  <?
			   }
			  else
			   {
			   ?>
			  <input name="id_actividad_economica" type="radio"  value="<? echo $row_actec['id_actividad_economica']; ?>" onClick="return habilitar()">
			  <?
			   }
			   
	         }
			else
			 { 	
			   if ($row_actec['id_actividad_economica'] == $row['id_actividad_economica'])
			    {
			  ?>
			  <input name="id_actividad_economica" checked type="radio"  value="<? echo $row_actec['id_actividad_economica']; ?>" onClick="return deshabilitar()">
			  <? }
			  else
			   {
   			  ?>
			  <input name="id_actividad_economica" type="radio"  value="<? echo $row_actec['id_actividad_economica']; ?>" onClick="return deshabilitar()">
			  <? }
			  }
				  echo $row_actec['actividad_economica'].'<BR>';  }
	  ?>  </td>
  </tr>
  <tr class="Estilo1">
    <td class="Estilo7" align="right">(Otros) Especifique</td>
		<td class="Estilo22" align="left">
		<input name="otra_actividad_eco" type="text" class="Estilo7"  maxlength="200"  size="75" onKeyUp="javascript:this.value=this.value.toUpperCase();"
		 <? if ($row['id_actividad_economica'] == 8) { ?> value="<? echo $row['otro_actividad_economica']; ?>" <? } else { ?>  disabled <? } ?>  ></td>
		</td>
  </tr>  
  <tr class="Estilo1">
    <td class="Estilo7" align="right">Lugar (Mercados Principales)</td>
		<td class="Estilo22" align="left">
		<select name="id_mercado">
				<option value="1" <? if ($row['id_mercado'] == 1 ) { ?> selected <? } ?> >Local</option>
				<option value="2" <? if ($row['id_mercado'] == 2 ) { ?> selected <? } ?> >Nacional</option>
				<option value="3" <? if ($row['id_mercado'] == 3 ) { ?> selected <? } ?> >Internacional</option>
				<option value="4" <? if ($row['id_mercado'] == 4 ) { ?> selected <? } ?> >Regional</option>
				<option value="5" <? if ($row['id_mercado'] == 5 ) { ?> selected <? } ?> >Mixto</option>
		</select>
		</td>
  </tr> 
  <tr class="Estilo1">
    <td class="Estilo7" align="right">Empresa Administrada por</td>
		<td class="Estilo22" align="left">
			<input type="radio" name="id_administrada" value="1" <? if ($row['administracion'] == 1 ) { ?> checked <? } ?>>Hombres 
			<input type="radio" name="id_administrada" value="2" <? if ($row['administracion'] == 2 ) { ?> checked <? } ?>>Mujeres
			<input type="radio" name="id_administrada" value="3" <? if ($row['administracion'] == 3 ) { ?> checked <? } ?>>Ambos</td>
  </tr>  
 
  <tr class="Estilo1">
    <td class="Estilo7" align="right">Ha recibido Asistencia T�cnica</td>
		<td class="Estilo22" align="left">
		   <input type="radio" name="asistencia_tecnica" value="1" <? if ($row['asistencia_tecnica'] == 1 ) { ?> checked <? } ?>>Si 
	  <input type="radio" name="asistencia_tecnica" value="2" <? if ($row['asistencia_tecnica'] == 2 ) { ?> checked <? } ?>> No</td>
  </tr>  
  <tr class="Estilo1">
    <td class="Estilo7" align="right">Especifique</td>
		<td class="Estilo22" align="left"><input name="espec_asitec" type="text" class="Estilo7"  maxlength="200"  size="75" onKeyUp="javascript:this.value=this.value.toUpperCase();"
										value= "<? if ($row['espec_as_tecnica']!= 'null') { echo $row['espec_as_tecnica']; } ?>"></td>
  </tr>  
  <tr class="Estilo1">
    <td class="Estilo7" align="right">Ha recibido Asistencia Crediticia</td>
		<td class="Estilo22" align="left">
			<input type="radio" name="asistencia_crediticia" value="1" <? if ($row['asistencia_crediticia'] == 1 ) { ?> checked <? } ?>> Si 
			<input type="radio" name="asistencia_crediticia" value="2" <? if ($row['asistencia_crediticia'] == 2 ) { ?> checked <? } ?>> No</td>
  </tr>  
  <tr class="Estilo1">
    <td class="Estilo7" align="right">Especifique</td>
		<td class="Estilo22" align="left"><input name="espec_asicred" type="text" class="Estilo7"  maxlength="200"  size="75" onKeyUp="javascript:this.value=this.value.toUpperCase();"
										value= "<? if ($row['espec_as_cred']!= 'null') {  echo $row['espec_as_cred']; } ?>"></td>
  </tr>  

  <input type="hidden" name="inserta" value="1">

<?
	 } // fin 	while ($row = mssql_fetch_array($result))
?>
</table>
<table width="77%"  border="0" align="center">
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