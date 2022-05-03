
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<link href="../css/cssWeb.css" type=text/css rel=StyleSheet>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<style type="text/css">
<!--
.style9 {font-size: 10px}
-->
</style>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
	<link rel="stylesheet" type="text/css" href="../css/clasificacion.css">
	<link href="images/cssWeb.css" type=text/css rel=StyleSheet>
	<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-1.css" title="win2k-1" />
	<script type="text/javascript" src="calendar/calendar.js"></script>
	<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
	<script type="text/javascript" src="calendar/calendar-setup.js"></script>
		
	<style>
		#search, ul { padding: 3px; width: 150px; border: 1px solid #999; font-family: verdana; arial, sans-serif; font-size: 12px;}
	ul { list-style-type: none; font-family: verdana; arial, sans-serif; font-size: 12px;  margin: 5px 0 0 0}
	li { margin: 0 0 5px 0; cursor: default; color: red;}
	li:hover { background: #ffc; }
.Estilo3 {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-size: 12px;
}
    body {
	background-color: #f8f8f8;
	background-image: url(../imagen/bg.gif);
}
.style1 {font-family: Arial, Helvetica, sans-serif}
    .style4 {font-family: Verdana, Arial, Helvetica, sans-serif; }
    </style>
	
</head>

<body>
<form action="<?=$_SERVER['PHP_SELF'];?>">
<table width="85%" border="0" align="center" cellpadding="0" cellspacing="6" bgcolor="#f8f8f8">
<tbody>
          <tr >
            <td colspan="6" class="HelpGrayOption"><div align="right"><a href="menu.php" target="_self"><img src="../imagen/bac.jpg" width="71" height="18" border="0" /> </a></div></td>
          </tr>
          <tr >
            <td height="55" colspan="6" class="DarkerBlueLink"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="80%"><img src="../imagen/cronologia.jpg" width="237" height="30" /></td>
                  <td width="20%" rowspan="2"><img src="../imagen/expedientes.gif" width="105" height="109" class="BasicFontInBorder4" /></td>
                </tr>
                <tr>
                  <td height="19" class="BlueWriting"><blockquote>
                    <p class="BlueBasicFont"> Visualizacion del seguimiento de los expedientes </p>
                  </blockquote></td>
              </tr>
              </table></td>
          </tr>
          <tr class="BasicFontInBorder4">
            <td colspan="6" class="HelpGrayOption">Expediente: <? print "2008-".$codigo;?>&nbsp;</td>
          </tr>
       <tr>
            
            <td width="20%" class="BasicFontInBorder3">Fecha</td>
            <td width="31%" class="BasicFontInBorder3">Observaciones</td>
            <td width="22%" class="BasicFontInBorder3">Estatus</td>
            <td width="27%" class="BasicFontInBorder3">Verificador</td>
      </tr>
       
       

         
			<?
			require ('../class/conexion.inc');
			$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
			mysql_select_db($BASE_DATOS,$db);

			$vcodigo = "2008-".$codigo;

			$result = mysql_query("SELECT concat(dayofmonth(tb1.fecha),'/',month(tb1.fecha),'/',year(tb1.fecha),' ',hour(tb1.fecha),':',minute(tb1.fecha),':',second(tb1.fecha)),tb1.observaciones,tb2.detalle,tb3.nombre_verificador FROM tb_cronologia tb1, tb_estado tb2, tb_verificadores tb3 WHERE tb1.codigo_verificador = tb3.codigo_verificador and tb1.codigo_estado = tb2.codigo_estado and tb1.expediente = '$vcodigo'");
			
			

			if ($result ) // verifica si la base de datos dejo hacer la insercion
			{

				while($row = mysql_fetch_row($result))
				{
						  print"<tr> ";
                          print"<TD width='100'><span class='TuringHelp'><font color='#335B96'>$row[0]</font></span></TD>";
						  print"<TD width='300'><span class='TuringHelp'>$row[1]</span></TD>";
                          print"<TD width='135'><span class='TuringHelp'>$row[2]</span></TD>";
	                      print"<TD width='200'><span class='TuringHelp'>$row[3]</span></TD>";
						  print"<TD width='200'><span class='TuringHelp'>$row[4]</span></TD>";
			              print"</tr>";		 							
				}		
				
			}// result
						

		mysql_close($db);		

?>
<tr>
	<td class="HelpGrayOption">Imagen del Bien</td>
	<td><?PHP 
			$dirx = 'bienes/'.$vcodigo;
			if (is_dir($dirx))
			{
			$directorio=opendir($dirx);  			
			
			while ($archivo = readdir($directorio)){  
			 if($archivo=='.' or $archivo=='..' or $archivo =='Thumbs.db'){  
				 echo "";  
			 }else {  
			 	$out = $dirx."/".trim($archivo);
				}
			}
			print '<a href='.$out.' target="_blank"><img src='.$out.' width="105" height="109" class="BasicFontInBorder4" /></a>'; 
			}else{
			print "vacio";
			}
			
	?></td>
	<td class="HelpGrayOption">Digitalizacion del Contrato</td>
	<td><?PHP

		$dirx = 'contratos/'.$vcodigo;
		if (is_dir($dirx))
		{
		$directorio=opendir($dirx);  								
			while ($archivo = readdir($directorio)){  
			 if($archivo=='.' or $archivo=='..' or $archivo =='Thumbs.db'){  
				 echo "";  
			 }else {  
			 	$out = $dirx."/".trim($archivo);
				}
			}
			print '<a href='.$out.' target="_blank"><img src='.$out.' width="105" height="109" class="BasicFontInBorder4" /></a>'; 
			}else{ print "vacio"; }
	?></td>
	
</tr>
    </tbody> 
  </table>
<p align="center">&nbsp;</p>
</form>

</body>
</html>
