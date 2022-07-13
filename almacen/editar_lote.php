<?PHP
	require("../includes/funciones.php");
	require("../includes/sqlcommand.inc");
?>
<?PHP
$cat=$_REQUEST['cat'];
$subcat=$_REQUEST['subcat'];
$codprod=$_REQUEST['codp'];

if (isset($_REQUEST["id"]))
{	
		$rowid=$_REQUEST["id"];
		conectardb($almacen);
		$latabla="lotes_existencia";
		$campo_condicion="rowid";
		$qry_medida="select * from $latabla where $campo_condicion='$rowid'";
		$res_qry_medida=$query($qry_medida);
		while($row=$fetch_array($res_qry_medida))
		{	
			$rowid=$row["rowid"];
      $fecha_vence=$row["fecha_vence"];
      $cantidad=$row["ingreso"];
      $lote=$row["lote"];
		}
}
?>
<html>
<head>
<script LANGUAGE="JavaScript">
function Validar(form)
{
  if (form.txt_lote.value == "" && form.txt_buscar.value == "")
  { 
  	alert("Escriba el lote"); 
	    form.txt_lote.focus(); 
	  return;
  }
  form.submit();
  
}

function Refrescar(form)
{
	form.reset();
	form.txt_lote.focus(); 
}
</script>
<link href="../helpdesk.css" rel="stylesheet" type="text/css">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
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
      <td width="7%"><a href="LoteIngreso.php"><img src="../images/iconos/ico_izquierda.gif" alt="Volver a pantalla anterior" width="58" height="30" border="0"></a></td>
      <td width="93%"><div align="center"><span class="titulocategoria">Modificaión de Lotes</span></div></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center"><img src="../images/linea.gif" width="100%" height="6"></div></td>
    </tr>
  </table>
  <form name="form1" method="post" action="geditar_lote.php?cat='.$cat.'&subcat='.$subcat.'& codprod='.$codprod.'">
    <table width="90%" border="0" align="center" bordercolor="#ECE9D8">
      <tr>
        <td><center>
            <table width="80%" border="0" align="center" cellspacing="5">
            <tr>
                <td height="25"><p><span class="tituloproducto">Realice las correcciones que correspondan</span></p>

                </td>			
			        </tr>
              <tr>
                <td>
                <label for="txt_lote" class="titulomenu"> <p>Lote</p>  
                    <input name="txt_lote" type="text" id="txt_lote" value="<?PHP echo $lote; ?>" size="20">
                  </label>
                </td>
                <td>
                </td>
              </tr>
              <tr>
                <td>
                  
                    <label for="txt_cant" class="titulomenu"> <p>Cantidad Ingresada</p>  
                    <input name="txt_cant" type="number" id="txt_cant" value="<?PHP echo $cantidad; ?>" size="20">
                    </label>
                  
                </td>
              </tr>

              <tr>
                <td>
                <label for="txt_fecha_v" class="titulomenu"> <p>Fecha vence</p> 
                      <input name="txt_fecha_v" type="date" id="txt_fecha_v" value="<?PHP echo $fecha_vence; ?>" size="20">               
                      </span>     
                  
                </td>
              </tr>
              <tr>
                <td colspan="2"><center><input name="bt_actualizar" onClick="Validar(this.form)" type="button" id="bt_actualizar" value="Actualizar"></center> </td>
                </tr>
                <tr>
                  <input type="hidden" name="txt_id" id="txt_id" value="<?PHP echo $rowid; ?>">                
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
