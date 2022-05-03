<?

function get_cantidad($status)
{
	global $dbms;
	$dbms->sql="select count(*) canti
				 from
					tbl_miembro m
				 where
					m.gvida = '$status' ";
	$dbms->Query();
	$Fields=$dbms->MoveNext();
	return $Fields["canti"];
}

function get_data()
{
	$texto = "<pie><slice title='Si Asisten' pull_out='true' color='#FCD202'>".get_cantidad("Si")."</slice><slice title='No Asisten' color='#FF0F00'>".get_cantidad("No")."</slice></pie>";
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
