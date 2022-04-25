<?
	session_start();
	include("validate.php");
	$grupo_id=14;
    if (($_SESSION["group_id"]) < $grupo_id) 
	include("logout.php");		
?>
<html>
<head>
<script LANGUAGE="JavaScript">
function Validar(form)
{
 if (form.txt_categoria.value == "")
  { 
  	alert("Ingrese el nombre de la categoria"); 
	form.txt_categoria.focus(); 
	return;
  }
  form.submit();
}
function Refrescar(form)
{
	form.reset();
	form.txt_categoria.focus(); 
}
</script>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<link href="../helpdesk.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>
<center>
  <form name="form" method="post" action="gcat_categoria.php">
    <table width="68%" border="2" bordercolor="#ECE9D8">
      <tr> 
        <td><div align="center"><strong>Cat&aacute;logo de categor&iacute;as</strong></div></td>
      </tr>
      <tr> 
        <td><center>
            <table width="100%" border="0" cellspacing="5">
              <tr> 
                <td width="36%" height="25"> <div align="right">Nueva categoria:</div></td>
                <td width="64%"><div align="center"> 
                    <input name="txt_categoria" type="text" id="txt_categoria" size="30" maxlength="25">
                  </div></td>
              </tr>
            </table>
          </center></td>
      </tr>
      <tr> 
        <td><div align="center">
            <input name="bt_guardar" onClick="Validar(this.form)" type="button" id="bt_guardar" value="Guardar">
            <input name="bt_cancelar" onClick="Refrescar(this.form)" type="button" id="bt_cancelar" value="Cancelar">
          </div></td>
      </tr>
    </table>
	   <p>&nbsp;</p>
	   <table width="100%" border="0" bgcolor="#0066CC">
         <tr>
           <td>&nbsp;</td>
         </tr>
       </table>
	   <table width="100%" border="0" bordercolor="#0000FF">	
      <tr> 
        <td><div align="center"><strong>Categor&iacute;as  ingresadas al sistema </strong></div></td>
      </tr>
      <tr> 
        <td><center>
            <table width="100%" border="1">
              <tr> 
                <td width="11%"><div align="center">#</div></td>
                <td width="89%"><div align="center"><strong>Nombre categoria </strong></div></td>
              </tr>
              <?
				require_once('../connection/helpdesk.php');
				$consulta = "SELECT * FROM categoria where activo=1 order by categoria";
				$result=mssql_query($consulta);
				$i = 0;				
				while($row=mssql_fetch_array($result))
				{
					$clase = "detalletabla2";
					if ($i % 2 == 0) 
					{
						$clase = "detalletabla1";
					}	
                	echo '<tr class='.$clase.'><td>'.$row["codigo_categoria"].'</td><td>'.$row["categoria"].'</td></tr>';
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
