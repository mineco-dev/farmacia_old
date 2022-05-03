<?	
$grupo_id=5;
include("../restringir.php");	
?>
 <?		
					require_once('../connection/helpdesk.php');  
					$consulta = "select * from view_lista_mensajes where codigo_mensaje='$id' and codigo_usuario_rec='$user'";
					$result=$query($consulta);
					while($row=$fetch_array($result))		
					{
						$remitente=$row["nombres"]." ".$row["apellidos"];
						$asunto=$row["asunto"];
						$fecha=$row["fecha"];
						$detalle=$row["descripcion"];
					}		
?>	
<html>
<head>
<link href="../helpdesk.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<style type="text/css">
<!--
.Estilo3 {color: #FFFFFF}
.Estilo4 {
	color: #0000FF;
	font-weight: bold;
}
.Estilo6 {font-size: 16px}
-->
</style>
</head>
<body>
<div align="left">
  <form name="form1" method="post" action="gborrar_mensaje.php">
    <table width="100%" border="0" bordercolor="#ECE9D8">
      <tr>
        <td><div align="center"><span class="tcat Estilo6"><strong>Mensaje de texto recibido el 
		<?
			echo $fecha;
		?>
		</strong></span></div></td>
      </tr>
      <tr>
        <td bordercolor="#FFFFFF"><center>
            <table width="100%" border="0" cellspacing="5">
              <tr>
                <td width="6%" height="25">De:</td>
                <td class="titulocategoria">  		<span class="tcat Estilo6"><strong>
                  <?
			echo $remitente;
		?>
                </strong></span> </td>
              </tr>
              <tr>
                <td height="25"><div align="left">Asunto:</div></td>
                <td height="25"><div align="left"><span class="alt1">
                </span></div>
                  <div align="left"><span class="tcat Estilo6"><strong>
                    <?
			echo $asunto;
		?>
                  </strong></span></div></td>
              </tr>
              <tr bordercolor="#000066">
                <td height="25" colspan="2"><div align="left"><span class="alt1">
                  <span class="tcat Estilo6"><strong>
</strong></span></span>
                    <table width="100%" border="1" bordercolor="#0000FF">
                      <tr>
                        <td><div align="justify"><span class="alt1"><span class="tcat Estilo6"><strong>
                            <?
			echo $detalle;
		?>
                        </strong></span></span></div></td>
                      </tr>
                    </table>
                  <span class="alt1"><span class="tcat Estilo6"><strong>                </strong></span> </span></div>                  <span class="alt1">
                  </span></td>
              </tr>
            </table>
        </center></td>
      </tr>
    </table>
    <p align="center"><span class="alt1">
      <input name="bt_borrar" type="submit" id="bt_agregar2" value="Regresar">
    </span></p>
  </form>
  <p>&nbsp;</p>
</div>
<!-- /forum rules and admin links -->
<br />
			<div align="left"></div>
            
</body>

</html>
