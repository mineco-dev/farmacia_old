<?
	$grupo_id=9;
	include("../restringir.php");	
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
  if (form.cbo_interno.value == "0")
  { 
  	alert("Debe indicar si esta categor�a estar� disponible para los usuarios o ser� utilizada solo por la dependencia"); 
	form.cbo_interno.focus(); 
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
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>
<center>
  <form name="form" method="post" action="gcrea_cat.php">
    <table width="100%" border="0" align="center" bordercolor="#0000FF">
      <tr> 
        <td><div align="center"><strong>Agregar Categor&iacute;a</strong></div></td>
      </tr>
      <tr> 
        <td><center>
            <table width="100%" border="0" cellspacing="5">
              <tr> 
                <td width="11%" bgcolor="#CCFFCC"> <div align="left">Categor&iacute;a:</div></td>
                <td bgcolor="#99CCCC"> 
                  <div align="left">
                    <input name="txt_categoria" type="text" id="txt_categoria" size="40" maxlength="50">
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
                <td bgcolor="#CCFFCC">
                  <div align="center">
                    <input name="bt_guardar" onClick="Validar(this.form)" type="button" id="bt_guardar2" value="Guardar">
                  </div></td>
                <td bgcolor="#99CCCC">
                  <div align="left">
                    <input name="bt_cancelar" onClick="Refrescar(this.form)" type="button" id="bt_cancelar" value="Cancelar">
                    <input name="txt_dependencia" type="hidden" id="txt_dependencia" value="<? echo $dependencia ?>">
                  </div>                  <div align="center">
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
