<?PHP
	require("../includes/funciones.php");
	require("../includes/sqlcommand.inc");
?>
<?PHP
if (isset($_REQUEST["id"]))
{	
		$rowid=$_REQUEST["id"];
		conectardb($almacen);
		$latabla="cat_medida";
		$campo_condicion="codigo_medida";
		$qry_medida="select * from $latabla where $campo_condicion='$rowid'";
		$res_qry_medida=$query($qry_medida);
		while($row=$fetch_array($res_qry_medida))
		{	
			$medida=$row["unidad_medida"];
		}
}
?>
<html>
<head>
<script LANGUAGE="JavaScript">
function Validar(form)
{
  if (form.txt_medida.value == "" && form.txt_buscar.value == "")
  { 
  	alert("Escriba el nombre de la categor�a"); 
	form.txt_medida.focus(); 
	return;
 }
  form.submit();
}
function Refrescar(form)
{
	form.reset();
	form.txt_medida.focus(); 
}
</script>
<link href="../helpdesk.css" rel="stylesheet" type="text/css">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<style type="text/css">
<!--
.Estilo1 {font-size: 12px}
.Estilo3 {color: #FFFFFF}
-->
</style>
</head>

<body>
<div align="left">
  <table width="100%"  border="0">
    <tr>
      <td width="7%"><a href="medida.php"><img src="../images/iconos/ico_izquierda.gif" alt="Volver a pantalla anterior" width="58" height="30" border="0"></a></td>
      <td width="93%"><div align="center"><span class="titulocategoria">Modificaci&oacute;n de unidades de medida</span></div></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center"><img src="../images/linea.gif" width="100%" height="6"></div></td>
    </tr>
  </table>
  <form name="form1" method="post" action="geditar_medida.php">
    <table width="90%" border="0" align="center" bordercolor="#ECE9D8">
      <tr>
        <td><center>
            <table width="80%" border="0" align="center" cellspacing="5">
              <tr>
                <td height="25"><p><span class="tituloproducto">Realice las correcciones que correspondan</span></p>
                  <p><span class="titulomenu">Unidad de medida:</span> 
                    <input name="txt_medida" type="text" id="txt_medida" value="<?PHP echo $medida; ?>" size="50">				
                    <input name="bt_actualizar" onClick="Validar(this.form)" type="button" id="bt_actualizar" value="Actualizar">
                    <input name="txt_id" type="hidden" id="txt_id" value="<?PHP echo $rowid; ?>">
                  </p></td>			
            
			  </tr>
            </table>
        </center></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><div align="center" class="Estilo1">
        </div></td>
      </tr>
    </table>
    <div align="left">
      <table width="100%"  border="0">
        <tr>
          <td><div align="center"><span class="titulomedida">Control de cambios</span></div></td>
        </tr>
        <tr>
          <td><div align="center"><img src="../images/linea.gif" width="100%" height="6"></div></td>
        </tr>
        <tr>
          <td><div align="center"><span class="Estilo1">
            <?PHP  include("abcregistro.php"); ?>
          </span></div></td>
        </tr>
      </table>
      <p><span class="Estilo1">
      </span></p>
    </div>
    <!-- /forum rules and admin links -->
  </form>
  <p align="center"><br />
  </p>
</div>
<div align="center"></div>
</body>

</html>
