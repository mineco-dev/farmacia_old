<?

function get_data()
{
	global $dbms;
	$texto = "<pie>";
	$dbms->sql="select count(*) as cantidad, m.nombre
				from
					tbl_municipio m, tbl_miembro mi
				where 
					mi.idmunicipio = m.idmunicipio
				group by m.nombre";
	$dbms->Query();
	$cnt=0;
	while ($Fields=$dbms->MoveNext())
	{
		$texto.="<slice title='".$Fields["nombre"]."' color='".get_color($cnt)."'>".$Fields["cantidad"]."</slice>";
		$cnt++;
	}
	$texto .= "</pie>";
	return $texto;
}

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
</head>

<body>
<!-- saved from url=(0013)about:internet -->
<!-- ampie script-->
<script type="text/javascript" src="ampie/swfobject.js"></script>
	<div id="flashcontent">
		<strong>Necesita actualizar el flash player</strong>
	</div>

	<script type="text/javascript">
		// <![CDATA[		
		var so = new SWFObject("ampie/ampie.swf", "ampie", "600", "340", "8", "#FFFFFF");
		so.addVariable("path", "ampie/");
		so.addVariable("settings_file", encodeURIComponent("ampie_settings.xml"));
		so.addVariable("chart_data", encodeURIComponent("<? print get_data();?>"));
		so.write("flashcontent");
		// ]]>
	</script>
<!-- end of ampie script -->
</body>
</html>
