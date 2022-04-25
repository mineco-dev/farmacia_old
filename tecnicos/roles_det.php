<?	
 ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
$grupo_id=17; // Para agentes de seguridad 
include("../restringir.php");	
?>
<html>
<head>
<script LANGUAGE="JavaScript">
function Validar(form)
{
 if (form.cbo_dependencia.value == "0")
  { 
  	alert("Seleccione la dependencia a la que pertenece el grupo"); 
	form.cbo_dependencia.focus(); 
	return;
 }
 if (form.cbo_permiso.value == "0")
  { 
  	alert("Seleccione el tipo de permiso asignado para este grupo"); 
	form.cbo_permiso.focus(); 
	return;
 }
 if (form.cbo_grupo.value == "0")
  { 
  	alert("Seleccione el grupo al que desea darle acceso"); 
	form.cbo_grupo.focus(); 
	return;
 }
   form.submit();
}
function Refrescar(form)
{
	form.reset();
	form.cbo_dependencia.focus(); 
}
</script>
<link href="../helpdesk.css" rel="stylesheet" type="text/css">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
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
<? 

				if (isset($_REQUEST["id"])) 
					{
						$codigo_usuario=$_REQUEST["id"];
						//session_register('codigo_usuario');
						$_SESSION['codigo_usuario'] =$codigo_usuario;
					}
					else $codigo_usuario=($_SESSION["codigo_usuario"]);	//codigo del usuario
?>
  <form name="form1" method="post" action="agrega_rol_det.php">
    <table width="100%" border="2" bordercolor="#ECE9D8">
      <tr>
        <td bordercolor="#0000FF"><div align="center"><span class="tcat Estilo6"><strong>Asignaci&oacute;n de roles por Usuario </strong></span></div></td>
      </tr>
      <tr>
        <td bordercolor="#FFFFFF"><center>
            <table width="100%" border="0" cellspacing="5">
              <tr>
                <td width="6%" height="25">Usuario:</td>
                <td colspan="2" class="titulocategoria">
				  <span class="alt1">
				  <?						  
				  		require_once('../connection/helpdesk.php');  	

						$consulta2="SELECT * FROM usuario WHERE activo = 1 and codigo_usuario= ".$codigo_usuario;
					
						$result2 = mssql_query($consulta2);
						while($row2=mssql_fetch_array($result2))
						{
							echo $row2["nombres"].' '.$row2["apellidos"];
						}
					?>
				  </span>				  </td>
                <td width="57%"><div align="right"><span class="Estilo4"> </span></div></td>
              </tr>
              <tr>
                <td height="25"><div align="left">Grupo:</div></td>
                <td height="25" colspan="3"><div align="left"><span class="alt1">
                </span></div>
                  <div align="left"><span class="alt1">
                    <?					
					$consulta2="SELECT * FROM grupo_enc where activo=1 ORDER BY nombre_grupo";
					$result2=mssql_query($consulta2);	
					echo('<select name="cbo_grupo">');
					$nombre2=":: Nombre de grupo ::";
					echo'<option value="0">'.$nombre2.'</option>';
					while($row2=mssql_fetch_array($result2))
					{
						echo'<option value="'.$row2["codigo_grupo_enc"].'">'.$row2["nombre_grupo"].'</option>';
					}
					echo('</select>');						
				?>
</span></div></td>
              </tr>
              <tr>
                <td height="25"><span class="alt1">Permisos: </span></td>
                <td height="25"><span class="alt1">
                  <?					
					$consulta3="SELECT * FROM tb_tipo_permiso where activo=1 ORDER BY codigo_tipo_permiso";
					$result3=mssql_query($consulta3);	
					echo('<select name="cbo_permiso">');
					$nombre3=":: Tipo de permiso ::";
					echo'<option value="0">'.$nombre3.'</option>';
					while($row3=mssql_fetch_array($result3))
					{
						echo'<option value="'.$row3["codigo_tipo_permiso"].'">'.$row3["codigo_tipo_permiso"].'-'.$row3["tipo_permiso"].'</option>';
					}
					echo('</select>');						
				?>
                </span></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td height="25">Dependencia:</td>
                <td height="25"><div align="left"><span class="alt1"><span class="Estilo4"><?					
					$consulta1="SELECT * FROM dependencia ORDER BY nombre_dependencia";
					$result1=mssql_query($consulta1);	
					echo('<select name="cbo_dependencia">');
					$nombre=":: Seleccione ::";
					echo'<option value="0">'.$nombre.'</option>';
					while($row1=mssql_fetch_array($result1))
					{
						echo'<option value="'.$row1["codigo_dependencia"].'">'.$row1["nombre_dependencia"].'</option>';
					}
					echo('</select>');					
				?>
                </span>
                </span></div></td>
                <td width="8%"><span class="alt1">
                  <input name="bt_agregar" onClick="Validar(this.form)" type="button" id="bt_agregar2" value="Agregar">
                </span></td>
                <td><div align="right"><span class="Estilo4"><a href="index.php" target="body" class="Estilo4"><span class="alt1">
                </span></a></span></div></td>
              </tr>
            </table>
        </center></td>
      </tr>
    </table>
    <table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" id="table17">
        <tr align="center" bgcolor="#006699" class="thead">
          <td class="Estilo3 thead"><strong>Dependencia</strong></td>
          <td class="thead Estilo3"><strong>Grupo</strong></td>
          <td class="thead Estilo3"><strong>Descripci&oacute;n</strong></td>
          <td class="thead Estilo3"><strong>Tipo permiso</strong></td>
          <td class="thead Estilo3"><strong>Borrar</strong></td>
        </tr>
		<?				
				$consulta4 = "SELECT a.nombre_dependencia, a.codigo_dependencia, b.codigo_grupo_enc, b.nombre_grupo, c.codigo_usuario, 
							  c.codigo_grupo_enc, c.codigo_rol, c.codigo_dependencia, p.tipo_permiso from rol c 
							  inner join dependencia a on a.codigo_dependencia=c.codigo_dependencia 
							  inner join grupo_enc b on b.codigo_grupo_enc=c.codigo_grupo_enc
							  left join tb_tipo_permiso p on c.permisos=p.codigo_tipo_permiso 
							  where c.codigo_usuario='$codigo_usuario' order by c.codigo_dependencia";
				$result4=mssql_query($consulta4);
				$i = 0;				
				while($row4=$fetch_array($result4))
				{					
					$clase = "detalletabla2";
					if ($i % 2 == 0) 
					{
						$clase = "detalletabla1";
					}			
						echo '<tr class='.$clase.'><td>'.$row4["nombre_dependencia"].'</td><td align="center">'.$row4["nombre_grupo"].'</td><td align="center">'.$row4["tipo_permiso"].'</td><td>Pendiente</td><td><center><a href="borrar_rol.php?id='.$row4["codigo_rol"].'"><img src="../images/iconos/ico_borrar.jpg"></a></center></td></tr>';
					$i++;
				}
				$close($s);				
				session_write_close();
			 ?>
    </table>
  </form>
</div>
<!-- /forum rules and admin links -->
<br />
			<div align="left"></div>
            
</body>

</html>
