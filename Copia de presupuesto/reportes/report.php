<?
	require("../../../includes/funciones.php");
	require("../../../includes/sqlcommand.inc");
	session_register("ingresando_obj");
	$_SESSION["ingresando_obj"]=true;


  
	require_once('../../../connection/helpdesk.php');	

	conectardb($presupuesto);		
			
			
function get_cantidad($status)
{
	global $dbms;
	$dbms->sql="select count(*) canti
				 from
					tbl_solicitud s
				 where
					s.idstatus in ($status) and
					s.idstatus <> 6";
	$dbms->Query();
	$Fields=$dbms->MoveNext();
	return $Fields["canti"];
}

function get_data()
{
	$texto = "<pie><slice title='Pendientes' pull_out='true' color='#FF0F00'>".get_cantidad("5")."</slice><slice title='Proceso' color='#FCD202'>".get_cantidad("1")."</slice><slice title='Finalizadas'>".get_cantidad("2,3,4,5,7,8")."</slice></pie>";
	return $texto;
}

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
</head>




<body>


<link href="../../../includes/helpdesk.css" rel="stylesheet" type="text/css">
<script src="../../../includes/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="../../../includes/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<script language='javascript' src="../../../includes/buscar_calendario/popcalendar.js"></script>
<script type="text/javascript" src="select_dependientes_3_niveles.js"></script>
<script type="text/javascript"> 

<!-- saved from url=(0013)about:internet -->
<!-- ampie script-->
<script type="text/javascript" src="ampie/swfobject.js"></script>
	<div id="flashcontent">
		<strong>Necesita actualizar el flash player</strong>
	</div>

	<script type="text/javascript">
		// <![CDATA[		
		var so = new SWFObject("ampie/ampie.swf", "ampie", "620", "340", "8", "#FFFFFF");
		so.addVariable("path", "ampie/");
		so.addVariable("settings_file", encodeURIComponent("ampie_settings.xml"));
		so.addVariable("chart_data", encodeURIComponent("<? print get_data();?>"));
		so.write("flashcontent");
		// ]]>
	</script>
<!-- end of ampie script -->
</body>
</html>
			
			
			
			
			
			
			
			
	