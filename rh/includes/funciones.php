<?
function getTabla($strquery,$ccol,$ncol,$campos,$tamano,$dbms,$width,$mod,$eli,$sel,$tipo,$posi)
{
	$col1 = "#EEEBE6";
	$col2 = "#FFFFFF";
	print
	"<table width=\"$width%\" border=\"0\" align=\"center\">
	  <tr bgcolor=\"#FFFFFC\" class=\"blue\">";

	$cnt = 0;
	while ($cnt < $ccol)
	{
		print "<td $tamano[$cnt] class=\"white\">$ncol[$cnt]</td>";
		$cnt ++;
	}
	if (intval($_SESSION['mttipousuario'])==1)
	{
		if (strlen(trim($mod)) > 0)	print "<td width=\"10%\" class=\"white\">Modificar</td>";
		if (strlen(trim($eli)) > 0)	print "<td width=\"10%\" class=\"white\">Borrar</td>";
	}
	if (strlen(trim($sel)) > 0)	print "<td width=\"10%\" class=\"white\">Seleccionar</td>";
	print "</tr>";
	$dbms->sql=$strquery;
	$dbms->Query();
	$ban = 0;
	$cantidad = 1;
	while($Fields=$dbms->MoveNext())
	{
		if (($ban - intval($ban/2)*2) != 0)
			$col= $col1;
		else
			$col= $col2;
		print "<tr bgcolor= \"$col\">";
		$cnt = 0;
		$completo="";
		while ($cnt < $ccol)
		{
			print "<td><span class=\"Estilo1\">".$Fields[$campos[$cnt]]."</span></td>";
			$completo=$completo.$Fields[$campos[$cnt]]." - ";
			$cnt ++;
		}
		if (intval($_SESSION['mttipousuario'])==1)
		{
			if (strlen(trim($mod)) > 0)
				print "<td><span class=\"Estilo1\"><a href=\"$mod".$Fields[$campos[$cnt]]."\">Modificar</span></td>";
			if (strlen(trim($eli)) > 0)
				print "<td><span class=\"Estilo1\"><a href=\"$eli".$Fields[$campos[$cnt]]."\">Borrar</span></td>";
		}
		if (strlen(trim($sel)) > 0)	
		{
			print "<td width=\"10%\" class=\"white\">";
			print "<a href=\"javascript:void(0)\" 
					onClick=\"window.opener.document.getElementById('$tipo"."[".$posi."][0]').value = '$completo'; 
					window.opener.document.getElementById('$tipo"."[".$posi."][1]').value = '".$Fields[$campos[$cnt]]."';
					window.close();
					window.opener.focus(); 
					return false;\">Seleccionar</a>";
			print "</td>";
		}

		print "</tr>";
		$cantidad++;
		$ban = $ban + 1;
	}
	print "</table>";
}

function get_renglon($idrenglon,$dbms)
{
	$dbms->sql="select 
					idrenglon,codigo,nombre,idgrupo
				from renglon where idrenglon = $idrenglon";
	$dbms->Query();
	$Fields=$dbms->MoveNext();
	return $Fields;
}
?>