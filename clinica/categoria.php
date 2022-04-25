<?
	require("../includes/funciones.php");
	require("../includes/sqlcommand.inc");
?>
<?
if (isset($_REQUEST["txt_categoria"]))
{	
	if ($_REQUEST["txt_categoria"]!="")
	{	
		conectardb(18);
		$nueva_categoria=strtoupper($_REQUEST["txt_categoria"]);	
		$qry_si_existe="select * from cat_categoria where categoria='$nueva_categoria'";
		$res_qry_si_existe=$query($qry_si_existe);	
		$existe=false;	
		while($row_categoria=$fetch_array($res_qry_si_existe))
		{
			echo "esta categoria ya esta ingresada";
			$existe=true;
		}
		if ($existe==false)
		{	
			$nombre_usuario=$_SESSION["user_name"];
			$qry_categoria="INSERT INTO cat_categoria(categoria, activo, usuario_creo, fecha_creado) 
							VALUES ('$nueva_categoria',1,'$nombre_usuario', getdate())";
			$query($qry_categoria);
		}
	}
}
?>
<html>
<head>
<script LANGUAGE="JavaScript">
function Validar(form)
{
  if (form.txt_categoria.value == "" && form.txt_buscar.value == "")
  { 
  	alert("Escriba el nombre de la categor�a"); 
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
  <form name="form1" method="post" action="">
    <table width="100%" border="0" bordercolor="#ECE9D8">
      <tr>
        <td><div align="left" class="titulocategoria">
          <div align="center">INGRESO DE NUEVAS  CATEGORIAS</div>
        </div></td>
      </tr>
      <tr>
        <td><center>
            <table width="100%" border="0" cellspacing="5">
              <tr>
                <td height="8"><img src="../images/linea.gif" width="100%" height="6"></td>
              </tr>
              <tr>
                <td height="25"><span class="tituloproducto">Ingrese la nueva categor&iacute;a:</span>                  <input name="txt_categoria" type="text" id="txt_categoria" value="" size="50">				
                  <input name="bt_guardar" onClick="Validar(this.form)" type="button" id="bt_guardar" value="Guardar">
                  <input name="txt_ref" type="hidden" id="txt_ref" value="<? echo $ref; ?>">
                </td>			
            
			  </tr>
            </table>
        </center></td>
      </tr>
      <tr>
        <td><img src="../images/linea.gif" width="100%" height="6"></td>
      </tr>
      <tr>
        <td>        <div align="left" class="Estilo1">
          <div align="right"><strong><strong>            [<a href="categoria.php?in=A" alt="Muestra los registros que inician con A">A</a>] [<a href="categoria.php?in=B">B</a>] [<a href="categoria.php?in=C">C</a>] [<a href="categoria.php?in=D">D</a>] [<a href="categoria.php?in=E">E</a>] [<a href="categoria.php?in=F">F</a>] [<a href="categoria.php?in=G">G</a>] [<a href="categoria.php?in=H">H</a>] [<a href="categoria.php?in=I">I</a>] [<a href="categoria.php?in=J">J</a>] [<a href="categoria.php?in=K">K</a>] [<a href="categoria.php?in=L">L</a>] [<a href="categoria.php?in=M">M</a>] [<a href="categoria.php?in=N">N</a>] [<a href="categoria.php?in=O">O</a>] [<a href="categoria.php?in=P">P</a>] [<a href="categoria.php?in=Q">Q</a>] [<a href="categoria.php?in=R">R</a>] [<a href="categoria.php?in=S">S</a>] [<a href="categoria.php?in=T">T</a>] [<a href="categoria.php?in=U">U</a>] [<a href="categoria.php?in=V">V</a>] [<a href="categoria.php?in=W">W</a>] [<a href="categoria.php?in=X">X</a>] [<a href="categoria.php?in=Y">Y</a>] [<a href="categoria.php?in=Z">Z</a>] <a href="categoria.php?in=all">[TODO]</a>            
            <input name="txt_buscar" type="text" id="txt_buscar2" size="20">
            <input name="bt_buscar" onClick="Validar(this.form)" type="button" id="bt_buscar" value="Buscar">
          </strong></strong></div>
        </div></td>
      </tr>
    </table>
    <table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" id="table17">
      <tr align="center" bgcolor="#006699" class="thead">
        <td colspan="3" class="titulotabla"><strong>Categor&iacute;as previamente ingresadas</strong><span class="Estilo3 thead"><strong></strong></span>        <div align="right"><strong>
              <strong>              </strong>
        </strong></div></td>
        <td width="5%" colspan="-1" class="thead Estilo3"><span class="titulotabla"><strong>Editar</strong></span></td>
        <td width="6%" class="titulotabla"><strong>Estado</strong></td>
      </tr>
		<?
				if ($_REQUEST["txt_buscar"]!="")
				{
				$busqueda=strtoupper($_REQUEST["txt_buscar"]);					
				$consulta = "SELECT * FROM cat_categoria where categoria like '%$busqueda%'";					
				}
				else	
				if (isset($_REQUEST["in"]))	
				{
					$inicial=$_REQUEST["in"];
					if ($inicial!="all")
						$consulta = "SELECT * FROM cat_categoria where categoria like '$inicial%'";
						else
							$consulta = "SELECT * FROM cat_categoria order by categoria";
				}
				else
				{
					$consulta = "SELECT * FROM cat_categoria where categoria like 'A%'";
				}
				conectardb($almacen);
				$result=$query($consulta);
				$i = 0;				
				while($row=$fetch_array($result))
				{
					$clase = "detalletabla2";
					if ($i % 2 == 0) 
					{
						$clase = "detalletabla1";
					}
					$estado=$row["activo"];
					if ($estado==1)					
					echo '<tr class='.$clase.'><td colspan="3">'.$row["categoria"].'</td><td><center><a href="editar_categoria.php?id='.$row["codigo_categoria"].'"><img src="../images/iconos/ico_editar.jpg" alt="Modificar información"></a></center></td><td><center><a href="cambia_stat.php?id='.$row["codigo_categoria"].'&stat=2&ref=1"><img src="../images/iconos/ico_activo.gif" alt="Activo"></a></center></td></tr>';					
					else
						echo '<tr class='.$clase.'><td colspan="3">'.$row["categoria"].'</td><td><center><a href="editar_categoria.php?id='.$row["codigo_categoria"].'"><img src="../images/iconos/ico_editar.jpg" alt="Modificar información"></a></center></td><td><center><a href="cambia_stat.php?id='.$row["codigo_categoria"].'&stat=1&ref=1"><img src="../images/iconos/ico_desactivado.gif" alt="Desactivado"></a></center></td></tr>';										
					$i++;
				}
				$free_result($result);
			 ?>
      <tr><td width="42%"></tbody>
    </table>
  </form>
  <p>&nbsp;</p>
</div>
<!-- /forum rules and admin links -->
<br />
			<div align="left"></div>
            
</body>

</html>
