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
<script LANGUAGE="JavaScript">
function Validar(form)
{
 if (form.txt_categoria.value == "")
  { 
  	alert("Ingrese categor�a"); 
	form.txt_categoria.focus(); 
	return;
  }
  form.submit();
}
function Refrescar(form)
{
	form.reset();
	form.txt_categoria.focus(); 
}
</script>
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>
<center>
  <form name="form" method="post" action="geditar_cat.php">
    <table width="100%" border="0" align="center" bordercolor="#0000FF">
      <tr> 
        <td><div align="center"><strong>Editar categor&iacute;a </strong></div></td>
      </tr>
      <tr> 
        <td><center>
            <table width="100%" border="0" cellspacing="5">
              <tr> 
                <td width="11%" bgcolor="#CCFFCC"> <div align="left">Descripci&oacute;n:</div></td>
                <td bgcolor="#99CCCC"> 
                  <div align="left">
                    <input name="txt_categoria" type="text" id="txt_categoria" value="<? echo $categoria ?>" size="35" maxlength="60">
                  </div></td>
              </tr>
              <tr>
                <td bgcolor="#CCFFCC">&iquest;Uso interno?</td>
                <td bgcolor="#99CCCC"><select name="cbo_interno" size="1" id="cbo_interno">
                    <option value="0" selected>SELECCIONE</option>
                    <option value="1">SI</option>
                    <option value="2">NO</option>
                </select></td>
              </tr>
              <tr> 
                <td bgcolor="#CCFFCC"><div align="left">
                  <input name="bt_guardar" onClick="Validar(this.form)" type="button" id="bt_guardar2" value="Guardar">
                </div></td>
                <td bgcolor="#99CCCC"><div align="center">
                  </div>                
                <input name="txt_codigo" type="hidden" id="txt_codigo" value="<? echo $id ?>">                  <div align="center">
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
