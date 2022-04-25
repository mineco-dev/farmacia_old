<? 
/* if ($_POST['codigo'] ==$_GET['codigo'])
 {

		require_once('helpdesk.php');  
		include("conectarse.php");

		$dispo = $_POST['tipo_dispositivo'];
		

		$SQL = "update cat_tipo_dispositivo set tipo_dispositivo = $dispo where id_capacidad =".$_['codigo'];		
		print $SQL;

			$result = mssql_query($SQL);

}*/
?>


<?
//session_start();	

//require_once('helpdesk.php');  
include('INCLUDES/inc_header.inc');
include("conectarse.php");





//include('valida.php');
//include('conexion.php');
 

$codi = $_GET['codigo'];
 
 

 $result2 = mssql_query ("select  id_renglon, renglon from renglon where id_renglon = $codi");
		
				while ($row = mssql_fetch_array ($result2)) 
				{
 
 
 
 
?>

<!DOCTYPE html>
<html>
<head>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!-- TemplateParam name="OptionalRegion1" type="boolean" value="true" -->
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

<table border="0" width="100%" class="Estilo1 Estilo18">
	<tr>
		<td align="left" bgcolor="#990000" width="15%" >
		<strong><font color="#FFFFFF" size="-1"><? print 'Usuario: '.$_SESSION['user']; ?></font></strong>
		</td>
		<td align="right"  width="70%" >
		<a href="visita.php"><!--img src="tareas.gif" width="16" height="16" border="0"-->[ <-- Regresar al Menu ]</a>
		</td>
		

	</tr>
</table>

</head>
<script LANGUAGE="JavaScript">
function Validar(form)
{


	if (confirm('�Esta seguro de actualizar estos datos?')){ 
    //  document.form.submit() 
		form.submit();
   		} 

}
</script>


<body>




<p ></p>
<table width="400" border="0" align="center" cellspacing="0">
<tr>
<th colspan="2" scope="col" align="center"><p class="Estilo3"><span class="Estilo1 Estilo8">
</span>Ministerio de Econom�a de Guatemala </p>
  <p ></p></th>

</tr>
  <tr bgcolor="#0066CC">
    <td colspan="7"><div align="center"><span class="Estilo1 Estilo2">Edita Datos Renglon</span></div></td>
  </tr>
  
</table>


		
				  
		  <form name="form1" method="post" action="guardar_renglon.php ">
		  
		  
	        <table width="300" border="0" align="center" cellspacing="0">
              			  

 <tr class="Estilo1" >
    <td class="Estilo22" align="right">Codigo<font color="#FF0000"></font></td>

						
				<td class="Estilo7">
						

						<input name="id_renglon"  disabled="disabled" type="text" id="id_renglon"  maxsize="1"  size="1" onKeyUp="javascript:this.value=this.value.toUpperCase();" value="<? print $row['id_renglon'];  ?>">

				</td>
			  </tr>
			  

<tr class="Estilo1">
    <td class="Estilo22" align="right">Renglon<font color="#FF0000"></font></td>

                <th width="467" scope="col">
                  <div align="left">
                    <input name="renglon" type="text" class="Estilo7" id="renglon" maxsize="50"  size="50"   onKeyUp="javascript:this.value=this.value.toUpperCase();" value="<? print $row['renglon'];  ?>">                
                  </div></th>
         
              </tr>
              </tr>
            </table>
			
			
			
			
			
			
			</table>
			
	     

	<div align="center"></div>
<p align="center" class="Estilo1 Estilo6">&nbsp;</p>

			<table border="0" width="100%" id="table3" >
                  <tr>
                    <td>
									
									
							<input type="hidden" name="codigo" value="<? print $_GET['codigo'];?>">
                      <p align="center">
                        <label>
                        <!--input type="submit" name="Submit" value="Enviar"-->
			 <input name="cmd_guardar" type="button"onClick="Validar(this.form)" id="cmd_guardar" value="Actualizar" >    
                        </label>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


        
                    </td>
                  </tr>
            </table>
	        <p>
	          <label></label>
	        </p>
	        <p>&nbsp;</p>
	        <p>&nbsp;            </p>
			
			
			
		
			
		  </form>
		  
		  <?
		  }
		  ?>
		  
		  
		  
		  
</blockquote>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;        </p>
</body>
</html>