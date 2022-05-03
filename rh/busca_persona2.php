<?
	require("../includes/funciones.php");
	require("../includes/sqlcommand.inc");
?>
<html>
<head>
<script LANGUAGE="JavaScript">
function Validar(form)
{
  if (form.txt_buscar.value == "")
  { 
  	alert("Escriba el nombre o apellido del empleado para realizar la b�squeda"); 
	form.txt_buscar.focus(); 
	return;
 }  
  form.submit();
}
function Refrescar(form)
{
	form.reset();
	form.txt_buscar.focus(); 
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
  <form name="form1" method="post" action="">
    <table width="100%" border="0" bordercolor="#ECE9D8">
      <tr>
        <td colspan="2"><div align="left" class="titulocategoria">
          <div align="center">FORMULARIO PARA B&Uacute;SQUEDA DE EMPLEADOS </div>
        </div></td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2"><div align="left"><img src="../images/e05.gif" width="21" height="21"><span class="defaultfieldname">Ver personal ordenado alfabeticamente por su primer apellido.</span></div></td>
      </tr>
      <tr>
        <td colspan="2"><strong><strong>[<a href="busca_persona.php?in=A" alt="Muestra los registros que inician con A">A</a>] [<a href="busca_persona.php?in=B">B</a>] [<a href="busca_persona.php?in=C">C</a>] [<a href="busca_persona.php?in=D">D</a>] [<a href="busca_persona.php?in=E">E</a>] [<a href="busca_persona.php?in=F">F</a>] [<a href="busca_persona.php?in=G">G</a>] [<a href="busca_persona.php?in=H">H</a>] [<a href="busca_persona.php?in=I">I</a>] [<a href="busca_persona.php?in=J">J</a>] [<a href="busca_persona.php?in=K">K</a>] [<a href="busca_persona.php?in=L">L</a>] [<a href="busca_persona.php?in=M">M</a>] [<a href="busca_persona.php?in=N">N</a>] [<a href="busca_persona.php?in=O">O</a>] [<a href="busca_persona.php?in=P">P</a>] [<a href="busca_persona.php?in=Q">Q</a>] [<a href="busca_persona.php?in=R">R</a>] [<a href="busca_persona.php?in=S">S</a>] [<a href="busca_persona.php?in=T">T</a>] [<a href="busca_persona.php?in=U">U</a>] [<a href="busca_persona.php?in=V">V</a>] [<a href="busca_persona.php?in=W">W</a>] [<a href="busca_persona.php?in=X">X</a>] [<a href="busca_persona.php?in=Y">Y</a>] [<a href="busca_persona.php?in=Z">Z</a>] <a href="busca_persona.php?in=all">[TODO]</a></strong></strong></td>
      </tr>
      <tr>
        <td height="26" colspan="2">          <div align="left"><b onClick="expandcontent('aleg1')" style="cursor:hand; cursor:pointer"><span class="curriculo"><img src="../images/e05.gif" width="21" height="21"></span></b> <span class="defaultfieldname">O escriba el nombre del empleado o parte del mismo o bien la dependencia a la que pertenece.</span>
          </div></td>
      </tr>
      <tr>
        <td width="96%" height="26">        <div align="left" class="Estilo1">
          <div align="left">
            <p><strong><strong>            </strong></strong><strong><strong>
<input name="txt_buscar" type="text" id="txt_buscar2" size="50">
                <input name="bt_buscar" onClick="Validar(this.form)" type="button" id="bt_buscar" value="Buscar">
    </strong></strong></p>
            </div>
        </div></td>
        
		<? 
			if (isset($_REQUEST["in"])) 
			{
				echo '<td width="4%" class="color_verde" align="center">';
				echo $_REQUEST["in"];
				echo '</td>';
			}			
		?>
      </tr>
    </table>
    <table class="tborder" cellpadding="0" cellspacing="1" border="0" width="100%" id="table17">
      <tr align="center" bgcolor="#006699" class="thead">
        <td width="9%" class="titulotabla"><div align="center"><strong>Seleccionar
        </strong></div></td>
		<td width="6%" class="titulotabla"><div align="center"><strong>Gafete
        </strong></div></td>
        <td width="45%" class="titulotabla"><strong>Apellidos y nombres</strong></td>
        <td width="40%" class="titulotabla">Dependencia</td>
      </tr>
		<?
				if ($_REQUEST["txt_buscar"]!="")
				{
				$busqueda=strtoupper($_REQUEST["txt_buscar"]);					
				$consulta = "SELECT (a.apellido +' '+ a.apellido2 +' '+ a.apellidocasada +', '+ a.nombre +' '+ a.nombre2 +' '+ a.nombre3) as empleado, a.activo, a.idasesor, a.gafete,
                			d.nombre AS dependencia
							FROM asesor a 
							left join tb_contratacion_gobierno g on a.idasesor=g.idasesor
							inner join direccion d on g.entidad_gobierno=d.iddireccion							
							where (a.apellido like '%$busqueda%' or a.apellido2 like '%$busqueda%' or a.nombre like '%$busqueda%' or a.nombre2 like '%$busqueda%' or d.nombre like '%$busqueda%')";

				}
				else	
				if (isset($_REQUEST["in"]))	
				{
					$inicial=$_REQUEST["in"];					
					if ($inicial!="all")
						$consulta = "SELECT (a.apellido +' '+ a.apellido2 +' '+ a.apellidocasada +', '+ a.nombre +' '+ a.nombre2 +' '+ a.nombre3) as empleado, a.activo, a.idasesor, a.gafete,
				                    d.nombre AS dependencia
									FROM asesor a 
									left join tb_contratacion_gobierno g on a.idasesor=g.idasesor
									inner join direccion d on g.entidad_gobierno=d.iddireccion	
									where a.apellido like '$inicial%'";
							       
						else
							$consulta = "SELECT (a.apellido +' '+ a.apellido2 +' '+ a.apellidocasada +', '+ a.nombre +' '+ a.nombre2 +' '+ a.nombre3) as empleado, a.activo, a.idasesor, a.gafete,
				                        d.nombre AS dependencia
									    FROM asesor a 
										left join tb_contratacion_gobierno g on a.idasesor=g.idasesor
										inner join direccion d on g.entidad_gobierno=d.iddireccion											
							 			order by a.apellido, a.apellido2, a.apellidocasada, a.nombre";
				}
				else
				{
					$consulta =     "SELECT top 10(a.apellido +' '+ a.apellido2 +' '+ a.apellidocasada +', '+ a.nombre +' '+ a.nombre2 +' '+ a.nombre3) as empleado, a.activo, a.idasesor, a.gafete,
				                    d.nombre AS dependencia
									FROM asesor a 
									left join tb_contratacion_gobierno g on a.idasesor=g.idasesor
									inner join direccion d on g.entidad_gobierno=d.iddireccion	
							     	where a.apellido like 'a%'";
				}
				conectardb($rrhh);
				$result=$query($consulta);
				$i = 0;				
				while($row=$fetch_array($result))
				{
					$completo=$row["empleado"];
					$clase = "detalletabla2";
					if ($i % 2 == 0) 
					{
						$clase = "detalletabla1";
					}
					if ($row["activo"]==1)
					{
						echo '<tr class='.$clase.'>';
						echo '<td><center><a href="personas/cpersona.php?num_gafete='.$row["gafete"].'&busca=1"><img src="../images/iconos/ico_ir.gif" border="0" alt="Seleccionar este empleado"></a></center></td>';					
						echo '<td>'.$row["gafete"].'</td>';										
						echo '<td>'.$row["empleado"].'&nbsp;<img src="../images/iconos/ico_activo.gif" border="0" alt="Este empleado esta ACTIVO"></td><td>'.$row["dependencia"].'</td></tr>';										
					}
					else
					{
						echo '<tr class='.$clase.'>';
						echo '<td><center><a href="personas/cpersona.php?num_gafete='.$row["gafete"].'&busca=1"><img src="../images/iconos/ico_ir.gif" border="0" alt="Seleccionar este empleado"></a></center></td>';					
						echo '<td>'.$row["gafete"].'</td>';										
						echo '<td>'.$row["empleado"].'&nbsp;<img src="../images/iconos/ico_desactivado.gif" border="0" alt="Este empleado esta INACTIVO, para activarlo modifique este registro"></td><td>'.$row["dependencia"].'</td></tr>';										
					}
					$i++;
				}				
				$free_result($result);				
			 ?>
    </table>
  </form>
  <p>&nbsp;</p>
</div>
</body>
</html>
