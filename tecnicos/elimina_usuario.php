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
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>
<center>
  <form name="form" method="post" action="gelimina_usuario.php">
    <table width="100%" border="0" bordercolor="#0000FF">
      <tr> 
        <td><div align="center"><strong>Elimina usuario</strong></div></td>
      </tr>
      <tr> 
        <td><center>
            <table width="100%" border="0" cellspacing="5">
              <tr> 
                <td width="12%"> <div align="left">Nombres:</div></td>
                <td colspan="2"> 
                  <div align="left"><? echo $nombres ?>                  </div></td>
                <td colspan="2">&nbsp;</td>
              </tr>
              <tr>
                <td>Apellidos:</td>
                <td colspan="2"><? echo $apellidos ?></td>
                <td colspan="2">&nbsp;</td>
              </tr>
              <tr>
                <td>Usuario:</td>
                <td colspan="2"><? echo $usuario ?></td>
                <td colspan="2">&nbsp;</td>
              </tr>
              <tr>
                <td><div align="left">Extensi&oacute;n</div></td>
                <td width="18%"><? echo $extension ?></td>
                <td width="16%">&nbsp;</td>
                <td colspan="2">&nbsp;</td>
              </tr>
              <tr>
                <td>Dependencia:</td>
                <td colspan="3"><?
					//Para desplegar como primer elemento del combo el titulo actual					
					$consulta="SELECT * FROM dependencia where codigo_dependencia='$dependencia'";
					$result=$query($consulta);	
					while($row=$fetch_array($result))
					{
						$nombre=$row["nombre_dependencia"];
						echo $nombre;
					}					
				?></td>
                <td width="54%">&nbsp;</td>
              </tr>
              <tr>
                <td>Nivel:</td>
                <td><? echo $nivel ?></td>
                <td>&nbsp;</td>
                <td colspan="2">&nbsp;</td>
              </tr>
              <tr> 
                <td><div align="left">Eliminar?</div></td>
                <td>
                  <div align="left">
                    <select name="cbo_baja" size="1" id="select">
                      <option value="1" selected>NO</option>
                      <option value="2">SI</option>
                    </select>
                  </div></td>
                <td><input name="bt_borrar" type="submit" id="bt_borrar" value="Procesar petici&oacute;n"></td>
                <td colspan="2">
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
