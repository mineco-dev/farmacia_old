<?
function get_menu()
{
	require('../includes/cnn/inc_header.inc');
	$dbms=new DBMS($conexion);
	$dbms->bdd=$database_cnn;
	$dbms2=new DBMS($conexion);
	$dbms2->bdd=$database_cnn;
	require('../includes/function.php');

	$cadena = "";

	$cadena = "var mtraiz = '".get_valor(1,$dbms)."';";

	$dbms->sql="select idmenu,nombre from menu where idmenu<5 order by orden";
	$dbms->Query();
	
	$cadena = $cadena. " var MENU_ITEMS = [";
	$ban1=0;										
	while ($Fields=$dbms->MoveNext())
	{
		if ($ban1>0) $cadena = $cadena.",";
		$cadena = $cadena. "['";
		$cadena = $cadena . $Fields["nombre"]."', null, null,";
		$dbms2->sql="select nombre,url from submenu where idmenu = ".$Fields["idmenu"]." order by orden";
		$dbms2->Query();
		$ban2=0;
		while ($Fields2=$dbms->MoveNext())
		{
			if ($ban2>0) $cadena = $cadena.",";
			$cadena = $cadena. "[";
			$cadena = $cadena. $Fields2["nombre"].",".$Fields2["url"];
			$cadena = $cadena. "]";
			$ban2++;
		}										
		$cadena = $cadena. "]";
		$ban1++;
	}
	$cadena = $cadena."['Enlaces', null, null,
		['Pagina de la Iglesia', 'http://www.vidanueva.com.gt',{'tw':'_blank'}],
		['Pagina de la Radio', 'http://radio.vidanueva.com.gt',{'tw':'_blank'}]
	]"."];"
	return $cadena;
}

?>