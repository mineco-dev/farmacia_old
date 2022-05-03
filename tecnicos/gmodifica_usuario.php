<?
	session_start();
	include("validate.php");
	$grupo_id=3;
    if (($_SESSION["group_id"]) < $grupo_id) 
	include("logout.php");		
?>
<html>
<head>
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
<?
					require_once('../connection/helpdesk.php'); 
					$query="SELECT * FROM usuario where codigo_usuario='$cbo_usuario'";
					$result=mssql_query($query);	
					while($row=mssql_fetch_array($result))
					{
						$nombres=$row["nombres"];
						$apellidos=$row["apellidos"];
						$nombre_usuario=$row["nombre_usuario"];
						$extension=$row["extension"];
						$contrasena=$row["contrasena"];
						$nivel=$row["nivel"];
						$activo=$row["activo"];
						$dependencia=$row["codigo_dependencia"];
						$codigo_usuario=$row["codigo_usuario"];
					}
					echo('</select>');					
				?>
  <form name="form" method="post" action="gmodifica_usuario2.php">
    <table width="100%" border="0" bordercolor="#0000FF">
      <tr> 
        <td><div align="center"><strong>Modificar usuario</strong></div></td>
      </tr>
      <tr> 
        <td><center>
            <table width="100%" border="0" cellspacing="5">
              <tr> 
                <td width="18%"> <div align="left">Nombres:</div></td>
                <td> 
                  <div align="left">
                    <input name="txt_nombres" type="text" id="txt_nombres" value="<? echo $nombres ?>" size="20" maxlength="50">
                  </div></td>
                <td>Apellidos</td>
                <td><input name="txt_apellidos" type="text" id="txt_apellidos" value="<? echo $apellidos ?>" size="20"></td>
              </tr>
              <tr>
                <td><div align="left">Dependencia</div></td>
                <td width="20%">
				<?
					require_once('../connection/helpdesk.php'); 
					$query="SELECT * FROM dependencia ORDER BY nombre_dependencia";
					$result=mssql_query($query);	
					echo('<select name="cbo_dependencia">');
					$nombre=":: Seleccione ::";
					echo'<option value="0">'.$nombre.'</option>';
					while($row=mssql_fetch_array($result))
					{
						echo'<option value="'.$row["codigo_dependencia"].'">'.$row["nombre_dependencia"].'</option>';
					}
					echo('</select>');
					mssql_close($s);
				?></td>
                <td width="10%">Usuario:</td>
                <td width="52%"><input name="txt_usuario" type="text" id="txt_usuario" value="<? echo $nombre_usuario ?>" size="20" maxlength="20"></td>
              </tr>
              <tr>
                <td>Contrase&ntilde;a:</td>
                <td><input name="txt_contrasena" type="password" id="txt_contrasena2" value="<? echo contrasena ?>;" size="20"></td>
                <td>Verificar:</td>
                <td><input name="txt_verificar" type="password" id="txt_verificar" value="<? echo contrasena ?>;" size="20"></td>
              </tr>
              <tr>
                <td>:Nivel:</td>
                <td><input name="txt_nivel" type="text" id="txt_nivel" value="<? echo $nivel ?>" size="5"></td>
                <td>Extensi&oacute;n</td>
                <td><input name="txt_extension" type="text" id="txt_extension" value="<? echo $extension ?>" size="20"></td>
              </tr>
              <tr> 
                <td><div align="left">Activo?</div></td>
                <td><div align="center">
                  <select name="cbo_activo" size="1" id="cbo_activo">
                    <option value="0">-- Seleccione --</option>
                    <option value="1">SI</option>
                    <option value="2">NO</option>
                  </select>
                  </div></td>
                <td><input name="bt_guardar" onClick="Validar(this.form)" type="button" id="bt_guardar2" value="Actualizar"></td>
                <td>
                  <div align="left">
                    <input name="bt_cancelar" onClick="Refrescar(this.form)" type="button" id="bt_cancelar2" value="Cancelar">
                  </div></td></tr>
            </table>
          </center></td>
      </tr>
      <tr> 
        <td><div align="center">
          <input name="txt_codigo_usuario" type="hidden" id="txt_codigo_usuario" value="<? echo $codigo_usuario ?>">
          </div></td>
      </tr>
    </table>
  </form>
</center>
</body>
</html>
