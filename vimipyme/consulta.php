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
?>

<!DOCTYPE html>
<html>
<head>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="estilos.css" rel="stylesheet" type="text/css">
</head>

<body>
<table border="0" width="100%" class="Estilo1 Estilo18">
	<tr class="Estilo69">
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
	<tr><td><font face="Arial, Helvetica, sans-serif" size="2"><br><strong><a href="boleta_empresarial_.php"><strong><< Regresar a Ingreso >></strong></a></strong></font></td>
	</tr>
	
</table>
<p class="Estilo69" align="left">

</p>
<table width="91%"  border="0" align="center">
    <tr>
      <th colspan="2" scope="col"><p class="Estilo3"><span class="Estilo1 Estilo8">
      </span>ViceMinisterio de Micro, Peque&ntilde;a y Mediana Empresa<br>Ministerio de Econom�a de Guatemala </p></th>
    </tr>
  </table>
<table border="0" align="center" class="Estilofondocol2">
<form name="form1" action="consulta.php" method="post">
<tr class="Estilo69"><td align="center" colspan="3">Nombre de Empresa <input type="text" name="empresa" maxlength="200" size="75" onKeyUp="javascript:this.value=this.value.toUpperCase();"></td></tr>
  <tr class="Estilo1">
    <td class="Estilo7">
	<div align="left" class="Estilo69">Departamento
    <?
		include('INCLUDES/inc_header.inc');
	$dbms=new DBMS($conexion); 
	
	$conection = mssql_connect("server_appl","sa","sa") or die("no se puede conectar a SQL Server");
	mssql_select_db("RRHH",$conection);
    ?>
		<select name="iddepartamento" class="TituloMedios" id="iddepartamento"  onChange="javascript:cargarCombo('subactividades3.php', 'iddepartamento', 'Div_Subactividades3')">
          <option value='0'> Seleccione </option>
          <? 
			   

				$dbms->sql="select iddepartamento, nombre_departamento from asesor_departamento"; 
				$dbms->Query(); 
				while($Fields=$dbms->MoveNext()) 
				{
					print "<option value=\"".$Fields["iddepartamento"]."\">".$Fields["nombre_departamento"]."</option>"; 
				}
			?>
        </select>

		</span></span> 
</td>
    <td class="Estilo69">	
    
	<span class="Estilo7">      
		<div align="left">
		  <div id="Div_Subactividades3"> Municipio
				<label for="SubActividad3"></label> 
                <select name="idmunicipio"  id="Subactividades3" class="TituloMedios">
            </select>
</div>
        </div>
	</span>
	
	</div>

</td></tr>
<tr class="Estilo69"><Td align="center">Filtro Solo por Departamento <input type="radio" name="filtrodm" value="1">
<Td align="center">o Departamento y Municipio <input type="radio" name="filtrodm" value="2"></Td></tr>
<tr class="Estilo69"><td align="center" width="50%"><input type="submit" name="submit" value="Buscar"></td>
<input type="hidden" name="busca" value="1">
</form>

<form name="form2" action="consulta.php" method="post">
<td align="center"><input type="submit" name="submit" value="Limpiar Consulta"></td></tr>
<input type="hidden" name="busca" value="0">
</form>
</table>


<? 
 if ($_POST['busca'] == 1)
 {

?> 
<table border="0" align="center">
<Tr class="Estilo69" bgcolor="#6699FF"><td colspan="7" align="center">Listado de Empresas Asistentes al I Evento de MIPYME</td></Tr>
<tr class="Estilo69"><td bgcolor="#C9CDED">Empresa</td><td bgcolor="#99CCFF">Direccion</td><td bgcolor="#C9CDED">Zona</td><td bgcolor="#99CCFF">Telefono</td><Td bgcolor="#C9CDED">Departamento</Td><td bgcolor="#99CCFF">Municipio</td><Td bgcolor="#C9CDED"></Td>
</tr>
<?
	$conection = mssql_connect("server_appl","sa","sa") or die("no se puede conectar a SQL Server");
	mssql_select_db("vimipyme",$conection);
	include('INCLUDES/inc_header.inc');
	$dbms=new DBMS($conexion); 
	
    $sql = "select a.id_empresa, a.nombre_empresa, a.direccion, a.zona, a.id_departamento, a.id_municipio, a.telefono, a.nombre_contacto, 
		    a.celular_contacto,	a.fecha_establecio, a.fax, a.email, a.web, a.id_tipo_negocio, a.otro_tipo_negocio, a.id_asociacion, a.otro_tipo_asociacion,  
 			a.producto_principal, a.cantidad_empleados, a.id_actividad_economica, a.otro_actividad_economica, a.id_mercado, a.asistencia_tecnica, 
 			a.espec_as_tecnica, a.administracion, a.asistencia_crediticia, a.espec_as_cred, b.nombre_departamento, c.nombre_municipio 
			from empresa a,	 RRHH.dbo.asesor_departamento b, RRHH.dbo.asesor_municipio c
			where a.id_municipio = c.idmunicipio and c.iddepartamento = b.iddepartamento ";
	if (isset($_POST['busca']) )
	 {
	   $sql= $sql." and a.nombre_empresa like '%".$_POST['empresa']."%'";
 	 }
	if (isset($_POST['iddepartamento']) and ($_POST['iddepartamento'] > 0) )
	  {
   	   $sql= $sql." and a.id_departamento = ".$_POST['iddepartamento'];
	  }
	  
	if (isset($_POST['filtrodm']) and ($_POST['filtrodm'] == 2) ) 
	 {
		if (isset($_POST['idmunicipio']))
		  {
		   $sql= $sql." and a.id_municipio = ".$_POST['idmunicipio']." ";
		  }
	 }	
	$sql= $sql." order by 2 asc";

//echo $sql;
$result = mssql_query($sql);
$rsRows = mssql_num_rows($result);
while ($row = mssql_fetch_array($result) )
 {?>
  <Tr class="Estilo67">
   <!--td><? //echo $row['id_empresa']; ?></td-->
   <td class="Estilofondocol2"><? echo $row['nombre_empresa']; ?></td>
   <td class="Estilofondocol"><? echo $row['direccion']; ?></td>
   <td class="Estilofondocol2"><? echo $row['zona']; ?></td>
   <td class="Estilofondocol"><? echo $row['telefono']; ?></td>
   <td class="Estilofondocol2"><? echo $row['nombre_departamento']; ?></td>
   <td class="Estilofondocol"><? echo $row['nombre_municipio']; ?></td>
   <td class="Estilofondocol2"><a href="edita_boleta_emp.php?eid=<? echo $row['id_empresa']; ?>"><img src="imagenes/b_edit.png" border="0"></a></td>
   </Tr>
<? }
?>

<TR class="estilo69"><TD colspan="7" class="Estilo69"><strong><? echo 'TOTAL DE REGISTROS==> '.$rsRows; ?></strong></TD></TR>
</table>

<?
}
?>


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
