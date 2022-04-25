<?	
$grupo_id=5;
include("../restringir.php");	
?>
<html>
<head>
<link href="../helpdesk.css" rel="stylesheet" type="text/css">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<META HTTP-EQUIV="REFRESH" CONTENT="100;URL=lista_mensajes.php">
<style type="text/css">
<!--
.Estilo2 {
	color: #333333;
	font-weight: bold;
}
-->
</style>
</head>
<body>
<p>&nbsp;</p>
<center>
  <form name="form1" method="post" action="">
    <table width="90%" border="0" bordercolor="#0000FF">
      <tr>
        <td width="33%"><div align="center"></div>          
        <div align="center"><a href="mensajes.php">Nuevo mensaje</a></div></td>
        <td width="48%"><div align="center"><strong>Mensajes de texto</strong></div></td>
        <td width="19%">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3"><center>
            <table width="99%" border="0" class="tablaazul">
              <tr>
                <td width="25%" bordercolor="#000000"><div align="center"><strong>Remitente</strong></div>
                    <div align="center"></div></td>
                <td width="41%" bordercolor="#000000"><div align="center"><strong>Asunto</strong></div></td>
                <td width="28%"><div align="center" class="Estilo2">Fecha</div></td>
                <td width="6%"><div align="center"><strong>Borrar?</strong></div></td>
              </tr>
              <?
				require_once('../connection/helpdesk.php');
				$consulta = "SELECT * FROM view_lista_mensajes where codigo_usuario_rec='$user'";
				$result=$query($consulta);
				$i = 0;				
				while($row=$fetch_array($result))
				{
					$clase = "detalletabla2";
					if ($i % 2 == 0) 
					{
						$clase = "detalletabla1";
					}
					echo '<tr class='.$clase.'><td><center>'.$row["nombres"].'&nbsp;'.$row["apellidos"].'</center></td><td><center><a href="ver_mensaje.php?id='.$row["codigo_mensaje"].'">'.$row["asunto"].'</td><td>'.$row["fecha"].'</td><td><center><a href="gborrar_mensaje.php?id='.$row["codigo_mensaje"].'"><img src="../images/iconos/ico_borrar.jpg" alt="Eliminar mensaje"></a></center></td></tr>';					
//					<a href="ver_seguimiento.php?id='.$row3["ticket"].'">
					$i++;
				}
				$close($s);
			 ?>
            </table>
        </center></td>
      </tr>
      <tr>
        <td colspan="3">&nbsp;</td>
      </tr>
    </table>
  </form>
</center>
</body>
</html>
