<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
</head>

<body>

<?


////   CREACION DE LA MATRIZ DEL ARCHIVO XML


function CargarXML($ruta_fichero) 
{ 
		$contenido = ""; 
		if($da = fopen($ruta_fichero,"r")) 
	{ 
		while ($aux= fgets($da,2048)) 
		{ 
			$contenido.=$aux; 
		} 
		fclose($da); 
	} 
	else 
	{ 
			echo "Error: no se ha podido leer el archivo <strong>$ruta_fichero</strong>"; 
	} 
	
	$contenido=ereg_replace("�","NI",$contenido); 
	
	
	$tagnames = array ("Tag_1","Tag_2","Tag_3","Tag_4","Tag_5","Tag_6","Tag_7","Tag_8","Tag_9","Tag_10","Tag_11","Tag_12"); 

	
	print phpinfo();
	
	print "</br>";
	
	print $contenido[3];
	
	
	if (!$xml = domxml_open_mem($contenido)) 
	{ 
		echo "Ha ocurrido un error al procesar el documento<strong> \"$ruta_fichero\"</strong> a XML <br>"; 
		exit; 
	} 
	else 
	{ 
		$raiz = $xml->document_element(); 
	
		$tam=sizeof($tagnames); 
	
		for($i=0; $i<$tam; $i++) 
		{ 
			$nodo = $raiz->get_elements_by_tagname($tagnames[$i]); 
			$j=0; 
			foreach ($nodo as $etiqueta) 
			{ 
				$matriz[$j][$tagnames[$i]]=$etiqueta->get_content(); 
				$j++; 
			} 
		} 
		
			return $matriz; 
	} 
} 
	
	
$matriz=CargarXML("DIGIT3.xml"); 

$num_noticias=sizeof($matriz); 

for($i=0;$i<$num_noticias;$i++) 
{ 
	echo ' 
	<table border=1> 
	<tr><td align=center>'.$matriz[$i]["Tag_1"].'</td></tr> 
	<tr><td>'.$matriz[$i]["Tag_2"].'</td></tr> 
	<tr><td>'.$matriz[$i]["Tag_3"].'</td></tr> 
	<tr><td>'.$matriz[$i]["Tag_4"].'</td></tr> 
	<tr><td>'.$matriz[$i]["Tag_5"].'</td></tr> 
	<tr><td>'.$matriz[$i]["Tag_6"].'</td></tr> 
	<tr><td>'.$matriz[$i]["Tag_7"].'</td></tr> 
	<tr><td>'.$matriz[$i]["Tag_8"].'</td></tr> 
	<tr><td>'.$matriz[$i]["Tag_9"].'</td></tr> 
	<tr><td>'.$matriz[$i]["Tag_10"].'</td></tr> 
	<tr><td>'.$matriz[$i]["Tag_11"].'</td></tr> 
	<tr><td align=right >'.$matriz[$i]["Tag_12"].'</td></tr> 
	</table><br> 
	'; 
} 

 
?>




</body>
</html>
