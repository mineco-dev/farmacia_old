<?
	$grupo_id=13;
	include("../restringir.php");		
?>
<?
	$id=$_REQUEST["id"];
	require_once('../connection/helpdesk.php');
	$consulta = "SELECT * FROM categoria where codigo_categoria='$id'";
	$result=$query($consulta);	
	while($row=$fetch_array($result))
	{	
		$categoria=$row["categoria"];
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
  <form name="form" method="post" action="gelimina_cat.php">
    <table width="100%" border="0" bordercolor="#0000FF">
      <tr> 
        <td><div align="center"><strong>Elimina categor&iacute;a </strong></div></td>
      </tr>
      <tr> 
        <td><center>
            <table width="100%" border="0" align="center" cellspacing="5">
              <tr> 
                <td width="12%" bgcolor="#CCFFCC"> <div align="left">Categor&iacute;a:</div></td>
                <td colspan="2" bgcolor="#99CCCC"> 
                  <div align="left"><? echo $categoria ?>                  </div></td>
                <td width="54%">&nbsp;</td>
              </tr>
              <tr> 
                <td bgcolor="#CCFFCC"><div align="left">Eliminar?</div></td>
                <td width="18%" bgcolor="#99CCCC">
                  <div align="left">
                    <select name="cbo_baja" size="1" id="select">
                      <option value="1" selected>NO</option>
                      <option value="2">SI</option>
                    </select>
                  </div></td>
                <td width="16%" bgcolor="#99CCCC"><input name="bt_borrar" type="submit" id="bt_borrar" value="Procesar petici&oacute;n"></td>
                <td>
                  <div align="left">
                    <input name="txt_codigo" type="hidden" id="txt_codigo2" value="<? echo $id ?>">
                  </div></td>
              </tr>
            </table>
          </center></td>
      </tr>
      <tr> 
        <td bgcolor="#FFFFFF"><div align="center">&nbsp;
        </div></td>
      </tr>
    </table>
  </form>
</center>
</body>
</html>
