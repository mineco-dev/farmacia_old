<?
	$grupo_id=13;
	include("../restringir.php");		
?>
<?
	$id=$_REQUEST["id"];
	require_once('../connection/helpdesk.php');
	$consulta = "SELECT * FROM usuario where codigo_usuario='$id'";
	$result=$query($consulta);	
	while($row=$fetch_array($result))
	{	
		$dependencia=$row["codigo_dependencia"];
		$nombres=$row["nombres"];
		$apellidos=$row["apellidos"];
		$usuario=strtolower($row["nombre_usuario"]);
		$extension=$row["extension"];
		$nivel=$row["nivel"];
	}	
?>
<html>
<head>
<link href="../helpdesk.css" rel="stylesheet" type="text/css">
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>
<center>
  <form name="form" method="post" action="gelimina_contrasena.php">
    <table width="100%" border="0" bordercolor="#0000FF">
      <tr> 
        <td><div align="center"><strong>Elimina usuario</strong></div></td>
      </tr>
      <tr> 
        <td><center>
            <table width="100%" border="0" cellspacing="5">
              <tr> 
                <td width="12%" bgcolor="#C9CDED"> <div align="left">Nombres:</div></td>
                <td colspan="2" bgcolor="#99CCFF"> 
                <div align="left"><? echo $nombres ?>                  </div></td>
                <td width="54%">&nbsp;</td>
              </tr>
              <tr>
                <td bgcolor="#C9CDED">Apellidos:</td>
                <td colspan="2" bgcolor="#99CCFF"><? echo $apellidos ?></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td bgcolor="#C9CDED">Usuario:</td>
                <td colspan="2" bgcolor="#99CCFF"><? echo $usuario ?></td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td bgcolor="#C9CDED"><div align="left">Reiniciar contrase&ntilde;a ?</div></td>
                <td width="18%" bgcolor="#99CCFF">
                  <div align="left">
                    <select name="cbo_baja" size="1" id="select">
                      <option value="2" selected>NO</option>
                      <option value="1">SI</option>
                    </select>
                </div></td>
                <td width="16%" bgcolor="#99CCFF"><input name="bt_borrar" type="submit" id="bt_borrar" value="Procesar petici&oacute;n"></td>
                <td>
                  <div align="left">
                    <input name="txt_codigo" type="hidden" id="txt_codigo2" value="<? echo $id ?>">
                    <input name="txt_contrasena" type="hidden" id="txt_contrasena" value="<? echo $usuario ?>">
</div></td>
              </tr>
            </table>
          </center></td>
      </tr>
      <tr> 
        <td bgcolor="#FFFFFF">NOTA: La contrase&ntilde;a predeterminada es igual al nombre del usuario.
<div align="left"></div></td></tr>
    </table>
  </form>
</center>
</body>
</html>
