<?	
$grupo_id=5;
include("../restringir.php");	
?>
<html>
<head>
  <script LANGUAGE="JavaScript">
  function Validar(form)
  {
    if (form.txt_contrasena.value == "")
    { 
     alert("Ingrese su nueva contrase�a"); 
     form.txt_contrasena.focus(); 
     return;
   }
   if (form.txt_verificar.value == "")
   { 
     alert("Debe verificar la contrase�a ingresada"); 
     form.txt_contrasena.focus(); 
     return;
   } 
   if ((form.txt_contrasena.value)!=(form.txt_verificar.value))
   { 
     alert("La contrase�a ingresada no coincide"); 
     form.txt_contrasena.focus(); 
     return;
   }
   form.submit();
 }
 function Refrescar(form)
 {
   form.reset();
   form.txt_contrasena.focus(); 
 }
 </script>
 <title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>
  <center>
    <form name="form" method="post" action="gcambiar_pwd.php">
      <table width="100%" border="0" bordercolor="#0000FF">
        <tr> 
          <td><div align="center"><strong>Cambiar contrase&ntilde;a </strong></div></td>
        </tr>
        <tr> 
          <td><center>
            <table width="33%" border="4" cellspacing="5" bordercolor="#CCCCCC">
              <tr>
                <td width="49%" bgcolor="#C9CDED">Nueva contrase&ntilde;a:</td>
                <td width="51%" bgcolor="#99CCFF"><input name="txt_contrasena" type="password" id="txt_contrasena2" size="20"></td>
              </tr>
              <tr>
                <td bgcolor="#C9CDED">Verificar contrase&ntilde;a: </td>
                <td bgcolor="#99CCFF"><input name="txt_verificar" type="password" id="txt_verificar" size="20"></td>
              </tr>
              <tr> 
                <td bgcolor="#C9CDED">
                  <div align="right">
                    <input name="bt_guardar" onClick="Validar(this.form)" type="button" id="bt_guardar3" value="Guardar">
                  </div></td>
                  <td bgcolor="#99CCFF">
                    <div align="left">
                      <input name="bt_cancelar" onClick="Refrescar(this.form)" type="button" id="bt_cancelar3" value="Cancelar">
                    </div>                  <div align="center">
                  </div></td>
                </tr>
              </table>
            </center></td>
          </tr>
          <tr> 
            <td><div align="center">
            </div></td>
          </tr>
        </table>
      </form>
    </center>
  </body>
  </html>
