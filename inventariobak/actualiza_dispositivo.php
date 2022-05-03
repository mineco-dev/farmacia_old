<?
session_start();	
require_once('helpdesk.php');  
include("conectarse.php");

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



//include('valida.php');
//include('conexion.php');
 

$codi = $_GET['codigo'];
 
 

 $result2 = mssql_query ("select  id_tipo_dispositivo, tipo_dispositivo from cat_tipo_dispositivo where id_tipo_dispositivo = $codi");
		
				while ($row = mssql_fetch_array ($result2)) 
				{
 
 
 
 
?>

<!DOCTYPE html>
<html>
<head>
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!-- TemplateParam name="OptionalRegion1" type="boolean" value="true" -->
<link href="estilos.css" rel="stylesheet" type="text/css">





<style type="text/css">
<!--
.Estilo1 {color: #FFFFFF}
-->
</style>
<table border="0" width="100%" class="Estilo69">
	<tr>
		<td align="left" bgcolor="#990000" width="15%" >
		<strong><font color="#FFFFFF" size="-1"><? print 'Usuario: '.$_SESSION['user']; ?></font></strong>
		</td>
		<td align="right"  width="70%">
		<a href="visita.php"><!--img src="tareas.gif" width="16" height="16" border="0"-->[ <-- Inicio ]</a>
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




<p>&nbsp;</p>
<table width="797" border="0" align="center" cellspacing="0">
  <tr bgcolor="#0066CC">
    <td colspan="7"><div align="center"><span class="Estilo69 Estilo1">Edita Datos Tipo Dispositivo</span></div></td>
  </tr>
  
</table>

<blockquote>
		 
				  
		  <form name="form1" method="post" action="guardar_actualiza_dispositivo.php ">
		  
		  
	        <table width="622" border="0" align="center">
              <tr>
			  
			  <td width="135"  scope="col" height="28" >
						<strong><div align="right"><span class="69">Codigo</span></div> </strong></td>
						
				<td>
						

						<input name="id_tipo_dispositiva"  disabled="disabled" type="text" id="id_tipo_dispositivo" size="10" onKeyUp="javascript:this.value=this.value.toUpperCase();" value="<? print $row['id_tipo_dispositivo'];  ?>">

				</td>
			  </tr>
			  
			                  <th width="135" scope="col"><div align="right"><span class="69">Tipo Dispositivo</span></div></th>
                <th width="467" scope="col">
                  <div align="left">
                    <input name="tipo_dispositivo" type="text" id="tipo_dispositivo" size="35" maxlength="50" onKeyUp="javascript:this.value=this.value.toUpperCase();" value="<? print $row['tipo_dispositivo'];  ?>">                
                  </div></th>
         
              </tr>
              </tr>
            </table>
			
			
			<p>&nbsp;</p>
			
			
			
			</table>
			
	        <p>&nbsp;</p>

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
