<?
	require('../includes/inc_header.inc');
	$dbms=new DBMS($conexion);
	$dbms->bdd=$database_cnn;
?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<link href="../css/estilos.css" rel="stylesheet" type="text/css" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>

<table width="72%" border="0">
  <tr>
    <td width="18%"><div align="center">Orden</div></td>
    <td width="19%"><div align="center">Registro</div></td>
    <td width="18%"><div align="center">Extendida en:</div></td>
    <td width="45%" rowspan="2" valign="bottom"><div align="center"></div></td>
  </tr>
  <tr>
    <td><div align="center">
      <select name="orden" id="select">
      <?
	  		$query = "select codigo_registro,registro from tb_registro order by registro";
			$dbms->sql=$query;
			$dbms->Query();
			while($Fields=$dbms->MoveNext())
			{
				print "<option value = ".$Fields["codigo_registro"]. ">".$Fields["registro"]."</option>";
			}
		?>
      </select>
      </div></td>
    <td><div align="center">
      <input type="text" name="registro" id="textfield2" />
    </div></td>
    <td><div align="center">
      <input type="text" name="extendida" id="textfield3" />
    </div></td>
  </tr>
</table>
</body>
</html>
