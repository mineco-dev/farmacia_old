<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<?
require_once('../connection/helpdesk.php');
$usuario_mayus=strtoupper($txt_usuario);
$consulta = "SELECT * FROM usuario";
$result=mssql_query($consulta);
$entro=1;
while($row=mssql_fetch_array($result))
{
	if(strtoupper($row["nombre_usuario"]) == $usuario_mayus)
	{
		$entro=0;
	}
}
if($entro == 1)
{
	$query = "EXEC proc_usuario_add @vapellidos='$txt_apellidos', @vnombres='$txt_nombres', @vnombre_usuario=$usuario_mayus, @vcodigo_grupo_enc='$cbo_grupo', @vcodigo_dependencia='$cbo_dependencia', @vcontrasena='$txt_contrasena', @vnivel='$txt_nivel', @vextension='$txt_extension'";
	mssql_query($query);
	mssql_close($s);
	include('usuario_add.php');
}	
else
{
echo('<strong><font size="5"><Center><font color="#FF0000">Este usuario ya se encuentra ingresado en el sistema</font></Center></font></strong>');
}
?>
<style type="text/css">
<!--
.Estilo1 {font-size: large}
-->
</style>
<table width="100%" border="4">
  <tr>
    <td bgcolor="#FFFFFF"><div align="center" class="Estilo1">
        <p>LA TRANSACCI&Oacute;N SE HA REALIZADO </p>
        <p> SATISFACTORIAMENTE !!</p>
    </div></td>
  </tr>
</table>
