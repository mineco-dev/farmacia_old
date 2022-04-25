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
		$usuario=$row["nombre_usuario"];
		$extension=$row["extension"];
		$nivel=$row["nivel"];
	}	
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
  if (form.txt_nivel.value == "")
  { 
  	alert("Indique en que nivel se encuentra el usuario"); 
	form.txt_nivel.focus(); 
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
  <form name="form" method="post" action="geditar_usuario.php">
    <table width="100%" border="0" bordercolor="#0000FF">
      <tr> 
        <td><div align="center"><strong>Editarr usuario</strong></div></td>
      </tr>
      <tr> 
        <td><center>
            <table width="100%" border="0" cellspacing="5">
              <tr> 
                <td width="11%"> <div align="left">Nombres:</div></td>
                <td> 
                  <div align="left">
                    <input name="txt_nombres" type="text" id="txt_nombres" value="<? echo $nombres ?>" size="20" maxlength="50">
                  </div></td>
                <td>Apellidos:</td>
                <td colspan="2"><input name="txt_apellidos" type="text" id="txt_apellidos" value="<? echo $apellidos ?>" size="20"></td>
              </tr>
              <tr>
          <td><div align="left">Usuario:</div></td>
                <td width="19%"><input name="txt_usuario" type="text" id="txt_usuario2" value="<? echo $usuario ?>" size="20" maxlength="20"></td>
                <td width="10%">Extensi&oacute;n</td>
                <td colspan="2"><input name="txt_extension" type="text" id="txt_extension2" value="<? echo $extension ?>" size="20"></td>
              </tr>
              <tr>
                <td colspan="3"><?
					//Para desplegar como primer elemento del combo el titulo actual					
					$consulta="SELECT * FROM dependencia where codigo_dependencia='$dependencia'";
					$result=$query($consulta);	
					while($row=$fetch_array($result))
					{
						$nombre=$row["nombre_dependencia"];
					}
					//Para mostrar los elementos siguientes del combo
					$consulta="SELECT * FROM dependencia where codigo_dependencia<>'$dependencia' order by nombre_dependencia";
					$result=$query($consulta);	
					echo('<select name="cbo_dependencia">');
					echo'<option value="0">'.$nombre.'</option>';
					while($row=$fetch_array($result))
					{
						echo'<option value="'.$row["codigo_dependencia"].'">'.$row["nombre_dependencia"].'</option>';
					}
					echo('</select>');
				?></td>
                <td width="9%">Nivel:</td>
                <td width="51%"><input name="txt_nivel" type="text" id="txt_nivel3" value="<? echo $nivel ?>" size="5"></td>
              </tr>
              <tr> 
                <td><div align="left">
                  <input name="bt_guardar" onClick="Validar(this.form)" type="button" id="bt_guardar2" value="Guardar">
                </div></td>
                <td><div align="center">
                  <input name="bt_cancelar" onClick="Refrescar(this.form)" type="button" id="bt_cancelar" value="Cancelar">
                  </div></td>
                <td><input name="txt_dependencia" type="hidden" id="txt_dependencia" value="<? echo $dependencia ?>">
                <input name="txt_codigo" type="hidden" id="txt_codigo" value="<? echo $id ?>"></td>
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
