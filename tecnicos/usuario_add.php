<?
	session_start();
    include("validate.php");
	$grupo_id=16;
    if (($_SESSION["group_id"]) != $grupo_id) 
	include("logout.php");		
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
 if (form.cbo_grupo.value == "0")
  { 
  	alert("Seleccione el grupo al cual pertenece el usuario"); 
	form.cbo_grupo.focus(); 
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
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>
<center>
  <form name="form" method="post" action="gusuario_add.php">
    <table width="100%" border="0" bordercolor="#0000FF">
      <tr> 
        <td><div align="center"><strong>Agregar usuario</strong></div></td>
      </tr>
      <tr> 
        <td><center>
            <table width="47%" border="0" cellspacing="5">
              <tr> 
                <td width="18%"> <div align="left">Nombres:</div></td>
                <td> 
                  <div align="left">
                    <input name="txt_nombres" type="text" id="txt_nombres" size="20" maxlength="50">
                    </div></td>
                <td>Apellidos</td>
                <td><input name="txt_apellidos" type="text" id="txt_apellidos" size="20"></td>
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
				?></td>
                <td width="10%">Usuario:</td>
                <td width="52%"><input name="txt_usuario" type="text" id="txt_usuario" size="20" maxlength="20"></td>
              </tr>
              <tr>
                <td>Contrase&ntilde;a:</td>
                <td><input name="txt_contrasena" type="password" id="txt_contrasena2" size="20"></td>
                <td>Verificar:</td>
                <td><input name="txt_verificar" type="password" id="txt_verificar" size="20"></td>
              </tr>
              <tr>
                <td>:Nivel:</td>
                <td><input name="txt_nivel" type="text" id="txt_nivel" size="5"></td>
                <td>Extensi&oacute;n</td>
                <td><input name="txt_extension" type="text" id="txt_extension" size="20"></td>
              </tr>
              <tr> 
                <td><div align="left">Grupo:</div></td>
                <td><div align="center">
                  <?
					require_once('../connection/helpdesk.php'); 
					$query="SELECT * FROM grupo_enc ORDER BY nombre_grupo";
					$result=mssql_query($query);	
					echo('<select name="cbo_grupo">');
					$nombre=":: Seleccione ::";					
					echo'<option value="0">'.$nombre.'</option>';
					while($row=mssql_fetch_array($result))
					{
						echo'<option value="'.$row["codigo_grupo_enc"].'">'.$row["nombre_grupo"].'</option>';
					}
					echo('</select>');					
				?>
                  </div></td>
                <td><input name="bt_guardar" onClick="Validar(this.form)" type="button" id="bt_guardar2" value="Guardar"></td>
                <td><div align="center">
                  <input name="bt_cancelar" onClick="Refrescar(this.form)" type="button" id="bt_cancelar2" value="Cancelar">
                  </div></td>
              </tr>
            </table>
          </center></td>
      </tr>
      <tr> 
        <td bgcolor="#0066CC"><div align="center">&nbsp;
        </div></td>
      </tr>
    </table>
    <table width="100%" border="0" bordercolor="#0000FF">
      <tr> 
        <td><div align="center"><strong>Listado de usuarios</strong></div></td>
      </tr>
      <tr> 
        <td><center>
            <table width="92%" border="1">
              <tr> 
                <td width="4%"><div align="center">#</div></td>
                <td width="27%"><div align="center"><strong>Nombre</strong></div></td>
                <td width="20%"><div align="center"><strong>Usuario</strong></div></td>
                <td width="49%"><div align="center"><strong>Dependencia</strong></div>                  
                  <div align="center"></div></td>
              </tr>
              <?
				require_once('../connection/helpdesk.php');
				$consulta = "SELECT * FROM view_usuario";
				$i=0;
				$result=mssql_query($consulta);
				while($row=mssql_fetch_array($result))
				{
				$clase = "detalletabla2";
					if ($i % 2 == 0) 
					{
						$clase = "detalletabla1";
					}					
                	echo '<tr class='.$clase.'><td><center>'.$row["codigo_usuario"].'</center></td><td>'.$row["nombres"].'&nbsp;'.$row["apellidos"].'</td><td>'.$row["usuario"].'</td><td>'.$row["dependencia"].'</td></tr>';
					$i++;
				}
				mssql_close($s);
			  ?>
            </table>
          </center></td>
      </tr>
      <tr> 
        <td>&nbsp;</td>
      </tr>
    </table>
  </form>
</center>
</body>
</html>
