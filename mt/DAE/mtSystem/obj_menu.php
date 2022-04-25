<?
function get_menu($dbms,$dbms2)
{
	$cadena = "var mtraiz = '".get_valor(1,$dbms)."';";
				
	$dbms->sql = "select distinct m.idmenu,m.nombre 
					from menu m, submenu sm, tbl_rolsubmenu rsm
					where 
						rsm.idsubmenu = sm.idsubmenu and
						sm.idmenu = m.idmenu and 
						rsm.idrol = ".$_SESSION['vs_mt_idrol']."
					order by m.orden";				
				
	$dbms->Query();
	$cadena = $cadena. " var MENU_ITEMS = [";
	$ban1=0;										
	while ($Fields=$dbms->MoveNext())
	{
		if ($ban1 > 0) $cadena = $cadena.",";
		$cadena = $cadena. "['";
		$cadena = $cadena . $Fields["nombre"]."', null, null,";
						
		$dbms2->sql="select  sm.nombre,sm.url,sm.target  
					from menu m, submenu sm, tbl_rolsubmenu rsm
					where 
						rsm.idsubmenu = sm.idsubmenu and
						sm.idmenu = m.idmenu and 
						rsm.idrol = 1 and
						sm.idmenu = ".$Fields["idmenu"]." 
					order by sm.orden";
	
		$dbms2->Query();
		$ban2=0;
		while ($Fields2=$dbms2->MoveNext())
		{
			if ($ban2>0) $cadena = $cadena.",";
			$cadena = $cadena. "[";
			$cadena = $cadena. $Fields2["nombre"].",".$Fields2["url"].",".$Fields2["target"];
			$cadena = $cadena. "]";
			$ban2++;
		}										
		$cadena = $cadena. "]";
		$ban1++;
	}
	$cadena = $cadena."];";
	return $cadena;
}
?>
<html> 
<head>
	<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
	<link rel="stylesheet" href="<? print $raiz."mtSystem/";?>menu.css">
</head>
<body>
<script language="JavaScript" src="<? print $raiz."mtSystem/";?>menu.js"></script>
<?
	print "<script language=\"JavaScript\">";
    $menu = get_menu($dbms,$dbms2);
	print $menu;
    print "</script>";
?>
<script language="JavaScript" src="<? print $raiz."mtSystem/";?>menu_tpl.js"></script>
<script language="JavaScript">
	new menu (MENU_ITEMS, MENU_TPL);
</script>
</body>
</html>
