<?php
	$grupo_id=13;
	include("../restringir.php");		
?>
<html>
<head>
<link href="../helpdesk.css" rel="stylesheet" type="text/css">
<script LANGUAGE="JavaScript">
function Validar(form)
{
 if (form.txt_nombres.value == "")
  { 
  	alert("Ingrese Nombres"); 
	form.txt_nombres.focus(); 
	return;
  }
  if (form.txt_apellidos.value == "")
  { 
  	alert("Ingrese apellidos"); 
	form.txt_apellidos.focus(); 
	return;
  }
 if (form.txt_usuario.value == "")
  { 
  	alert("Por Favor Ingrese nombre de usuario"); 
	form.txt_usuario.focus(); 
	return;
  }
 if (form.txt_contrasena.value == "")
  { 
  	alert("Ingrese la contrase�a  para el usuario"); 
	form.txt_contrasena.focus(); 
	return;
  }
 if (form.txt_verificar.value == "")
  { 
  	alert("Debe verificar la contrase�a ingresada"); 
	form.txt_contrasena.focus(); 
	return;
  }
  if (form.txt_nivel.value == "")
  { 
  	alert("Indique en que nivel se encuentra el usuario"); 
	form.txt_nivel.focus(); 
	return;
  } 
 if (form.cbo_dependencia.value == "0")
  { 
  	alert("Por Favor Seleccione la dependencia"); 
	form.cbo_dependencia.focus(); 
	return;
  }
 if ((form.txt_contrasena.value)!=(form.txt_verificar.value))
  { 
  	alert("No se puede verificar la contrase�a, no coincide"); 
	form.txt_contrasena.focus(); 
	return;
  }
  form.submit();
}
function Refrescar(form)
{
	form.reset();
	form.txt_nombres.focus(); 
}
</script>
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>
<center>
  <form name="form" method="post" action="gcrea_usuario.php">
    <table width="100%" border="0" bordercolor="#0000FF">
      <tr> 
        <td><div align="center"><strong>Agregar usuario</strong></div></td>
      </tr>
      <tr> 
        <td><center>
            <table width="100%" border="0" cellspacing="5">
              <tr> 
                <td width="11%" bgcolor="#CCFFCC"> <div align="left">Nombres:</div></td>
                <td bgcolor="#99CCCC"> 
                  <div align="left">
                    <input name="txt_nombres" type="text" id="txt_nombres" size="20" maxlength="50">
                </div></td>
                <td bgcolor="#CCFFCC">Apellidos:</td>
                <td colspan="2" bgcolor="#99CCCC"><input name="txt_apellidos" type="text" id="txt_apellidos" size="20"></td>
              </tr>
              <tr>
                <td bgcolor="#CCFFCC"><div align="left">Usuario:</div></td>
                <td width="19%" bgcolor="#99CCCC"><input name="txt_usuario" type="text" id="txt_usuario2" size="20" maxlength="20"></td>
                <td width="10%" bgcolor="#CCFFCC">Extensi&oacute;n</td>
                <td colspan="2" bgcolor="#99CCCC"><input name="txt_extension" type="text" id="txt_extension2" size="20"></td>
              </tr>
              <tr>
                <td bgcolor="#CCFFCC">Contrase&ntilde;a:</td>
                <td bgcolor="#99CCCC"><input name="txt_contrasena" type="password" id="txt_contrasena2" size="20"></td>
                <td bgcolor="#CCFFCC">Verificar:</td>
                <td colspan="2" bgcolor="#99CCCC"><input name="txt_verificar" type="password" id="txt_verificar" size="20"></td>
              </tr>
              <tr>
                <td colspan="3" bgcolor="#99CCCC"><?php
					require_once('../connection/helpdesk.php'); 
					$query="SELECT * FROM dependencia where activo=1 ORDER BY nombre_dependencia";
					$result=mssql_query($query);	
					echo('<select name="cbo_dependencia">');
					$nombre=":: Dependencia ::";
					echo'<option value="0">'.$nombre.'</option>';
					while($row=mssql_fetch_array($result))
					{
						echo'<option value="'.$row["codigo_dependencia"].'">'.$row["nombre_dependencia"].'</option>';
					}
					echo('</select>');					
				?></td>
                <td width="9%" bgcolor="#99CCCC">Nivel:</td>
                <td width="51%" bgcolor="#99CCCC"><input name="txt_nivel" type="text" id="txt_nivel3" size="5"></td>
              </tr>
              <tr> 
                <td><div align="left">
                  <input name="bt_guardar" onClick="Validar(this.form)" type="button" id="bt_guardar2" value="Guardar">
                </div></td>
                <td><div align="center">
                  <input name="bt_cancelar" onClick="Refrescar(this.form)" type="button" id="bt_cancelar" value="Cancelar">
                  </div></td>
                <td>&nbsp;</td>
                <td colspan="2"><div align="center">
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
