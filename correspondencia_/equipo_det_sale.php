<?
	//Validar la sesion 
	session_start();		
	$usuario_id=($_SESSION["user_id"]);   //codigo del usuario que inicio la sesion
	include("../validate.php");
	$grupo_id=3;
	if (($_SESSION["group_id"]) < $grupo_id) 
	include("../logout.php");		
?>
<html>
<head>
<link href="../../helpdesk.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<style type="text/css">
<!--
.Estilo1 {font-size: 12px}
.Estilo3 {color: #FFFFFF}
.Estilo4 {
	color: #000000;
	font-size: 24px;
}
-->
</style>
</head>
<body>
<div align="left">
  <form name="form1" method="post" action="gegresa_visita.php">
    <table width="100%" border="2" bordercolor="#ECE9D8">
      <tr>
        <td><div align="center"><span class="tcat">Equipo ingresado por el visitante <span class="titulocategoria">
<?			
	$entro_equipo=2;	
	$id=($_SESSION["user_id"]);
	$usuario_id=($_SESSION["user_id"]);
	require_once('../../connection/helpdesk.php');
	$consulta = "SELECT * FROM seg_equipo_det WHERE codigo_visita=$id";
	$result=mssql_query($consulta);	
	while($row=mssql_fetch_array($result))
	{		   		
		$entro_equipo=1;
	}					
	$consulta = "select  a.nombre_visitante as visitante, b.gafete_asignado, b.codigo_visita, b.arma, b.casillero from seg_visitante a inner join seg_visita b on a.codigo_visitante=b.codigo_visitante where codigo_visita=$id";
	$result=$query($consulta);
	while($row=$fetch_array($result))		
	{
		$visitante=$row["visitante"];
		$gafete=$row["gafete_asignado"];
		$arma=$row["arma"];
		$casillero=$row["casillero"];
	}		
?>
        </span></span></div></td>
      </tr>
      <tr>
        <td><center>
            <table width="100%" border="0" cellspacing="5">
              <tr>
                <td width="8%" height="25">Gafete:</td>
                <td class="titulocategoria"><? echo $gafete;?> </td>
                <td width="59%">&nbsp;</td>
              </tr>
              <tr>
                <td height="25">Visitante</td>
                <td height="25" colspan="2"><span class="titulocategoria"><? echo $visitante;?></span></td>
              </tr>
              <tr>
                <td height="25" colspan="3"><div align="left"><span class="titulocategoria">
				  <? 
					if ($arma==1) echo "El arma se encuentra en el casillero N�mero: $casillero";
				?>
                </span></div></td>
              </tr>
            </table>
        </center></td>
      </tr>
    </table>
    <table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" id="table17">
        <tr align="center" bgcolor="#006699" class="thead">
          <td width="12" colspan="2" class="Estilo3 thead"><strong>Descripci&oacute;n</strong></td>
          <td width="16%" class="Estilo3 thead"><strong>No. de serie </strong></td>
          <td width="13%" class="Estilo3 thead"><span class="Estilo3 thead"><span class="thead Estilo3"><strong>Propiedad </strong></span></span></td>
          <td width="14%" class="Estilo3 thead"><span class="thead Estilo3"><strong>Sale equipo </strong></span></td>
          <td width="31%" class="Estilo3 thead"><span class="thead Estilo3"><strong>Observaci&oacute;n</strong></span></td>
        </tr>
		<?		
		if ($entro_equipo==1)		
		{
				$consulta3 = "SELECT a.nombre_equipo as equipo, b.codigo_visita, b.numero_serie, b.codigo_equipo_det, c.descripcion, b.retirado FROM seg_equipo a inner join seg_equipo_det b on a.codigo_equipo=b.codigo_equipo inner join seg_mov_equipo c on b.codigo_mov_equipo=c.codigo_mov_equipo where b.codigo_visita='$id' and b.retirado=2";
				$result3=$query($consulta3);
				$i = 0;				
				while($row3=$fetch_array($result3))
				{					
					$clase = "detalletabla2";
					if ($i % 2 == 0) 
					{
						$clase = "detalletabla1";
					}			
						echo '<tr class='.$clase.'><td colspan="2">'.$row3["equipo"].'</td><td>'.$row3["numero_serie"].'</td><td>'.$row3["descripcion"].'</td><td><center><a href="sale_equipo.php?id='.$row3["codigo_equipo_det"].'"><img src="../imagenes/iconos/ico_borrar.jpg"></a></center></td><td><center><a href="observacion_equipo_sale.php?id='.$row3["codigo_equipo_det"].'"><img src="../imagenes/iconos/ico_editar.jpg"></a></center></td></tr>';										
					$i++;
				}
		}
		$close($s);				
?>
	 
    </table>
    <p align="center"><span class="alt1">
      <input name="bt_agregar" type="submit" id="bt_agregar" value="Operar salida del visitante">
      </span>    </p>
  </form>
  <p>&nbsp;</p>
</div>
<!-- /forum rules and admin links -->
<br />
			<div align="left"></div>            
</body>
</html>
