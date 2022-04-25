<?
session_start();
/*include('conectarse.php');

	include('../includes/inc_header_sistema.inc');
	$dbms=new DBMS($conexion); */

	

?>


<!DOCTYPE html>
<html>
<head>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
<!--
.Estilo1 {color: #0000FF}
-->
</style>
</head>
<script>
function Enviar1()
{ 


document.forms[0].action = "apersona.php"; 
document.forms[0].submit();
window.close();
} 



</script>

<body>


<form name="form2" method="post" action="apersona.php" enctype="multipart/form-data">
<input value="69" type="hidden" name="id">

  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <table align="center" width="424">
<tr>
<td align="center"><span class="Estilo1">
Los datos estan repetidos, ya existe la persona a la que desea ingresar. </span></td>

</tr>
<tr>
<td align="center">
  <p>&nbsp;   </p>
  <p>
     <input name="Submit" type="submit" class="Estilo1" onFocus="Enviar1()" value="CONTINUAR" >
     <!--input  value="SALIR"  type="submit"   onFocus="Enviar1()" -->
    </p></td>
</tr>
</table>





  <p>&nbsp;</p>
  <p>&nbsp;</p>
</form>

</body>
</html>
