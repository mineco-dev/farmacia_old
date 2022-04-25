<html>
<head>
<script LANGUAGE="JavaScript">
function Validar(form)
{
  form.submit();
}
function Refrescar(form)
{
	form.reset();
	form.txt_buscar.focus(); 
}
</script>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>
<center>
  <form name="form" method="GET" action="gconsulta_extension.php">
    <table width="50%" border="1" bordercolor="#CCCCCC">
      <tr> 
        <td><div align="center">
          <p><strong>Consulta de  extensi&oacute;n telef&oacute;nica<br>
          </strong><strong>Seleccione la dependencia o escriba el nombre o parte del mismo</strong></p>
          </div></td>
      </tr>
      <tr> 
        <td><center>
            <table width="92%" border="0" cellspacing="5">
              <tr>
                <td height="25">Dependencia:</td>
                <td colspan="2"><?
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
              </tr>
              <tr> 
                <td width="30%" height="25"> <div align="left">Nombre <strong>o</strong> apellido: </div></td>
                <td width="33%">
                  <div align="left">                    </div>                  
                  <div align="left">
                    <input name="txt_buscar" type="text" id="txt_extension2" size="20" maxlength="25">
                  </div></td>
                <td width="37%"><input name="bt_consultar" onClick="Validar(this.form)" type="button" id="bt_consultar" value="Iniciar B&uacute;squeda"></td>
              </tr>
            </table>
          </center></td>
      </tr>
      <tr> 
        <td><div align="center">Si desea ver el listado general de extensiones haga clic en BUSCAR sin ingresar ning&uacute;n dato. </div></td>
      </tr>
    </table>
  </form>
</center>
</body>
</html>
