<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
</head>

<body>

<?



	$hostname_cnn = "nhernandez";
	$database_cnn = "biblioteca";
	$username_cnn = "sa";
	$password_cnn = "sa";
	$conexion = mssql_connect($hostname_cnn,$username_cnn,$password_cnn);
	mssql_select_db($database_cnn,$conexion);
//include("inc_coneccion.inc");


		$doc = new DOMDocument();
           $doc->load( 'digit3_c.xml' );
           $books = $doc->getElementsByTagName( "RECORD" );
           foreach( $books as $book ){
                  $authors = $book->getElementsByTagName( "Tag_1" );
                   $codigo = $authors->item(0)->nodeValue;
				   				   
					 $publishers = $book->getElementsByTagName( "Tag_2" );
					 $tip_documento = $publishers->item(0)->nodeValue;
	   
					 $titles = $book->getElementsByTagName( "Tag_3" );
					 $tema = $titles->item(0)->nodeValue;
		
					 $tag_41 = $book->getElementsByTagName( "Tag_4" );
					 $titulo = $tag_41->item(0)->nodeValue;
	
					 $tag_51 = $book->getElementsByTagName( "Tag_5" );
					 $autor = $tag_51->item(0)->nodeValue;
					 
					 $tag_61 = $book->getElementsByTagName( "Tag_6" );
					 $lugar = $tag_61->item(0)->nodeValue;
					 
					 $tag_71 = $book->getElementsByTagName( "Tag_7" );
					 $fecha_impresion = $tag_71->item(0)->nodeValue;
	
					 $tag_81 = $book->getElementsByTagName( "Tag_8" );
					 $resumen = $tag_81->item(0)->nodeValue;
		
					 $tag_91 = $book->getElementsByTagName( "Tag_9" );
					 $palabras_clave = $tag_91->item(0)->nodeValue;
	
					 $tag_101 = $book->getElementsByTagName( "Tag_10" );
					 $anaquel = $tag_101->item(0)->nodeValue;
	
					 $tag_111 = $book->getElementsByTagName( "Tag_11" );
					 $entrepano = $tag_111->item(0)->nodeValue;
	
					 $tag_121 = $book->getElementsByTagName( "Tag_12" );
					 $fecha_ingreso = $tag_121->item(0)->nodeValue;

					//list ($dia,$mes,$ano) = split("/",$fecha_ingreso,3);
				
					list($day, $mes, $year) = split('[/.-]', $fecha_ingreso);
					
					$fecha_ingreso = $year.'-'.$mes.'-'.$day;
						

$consulta = "insert into tb_libros (codigo,tip_documento,tema,titulo,autor,lugar,fecha_impresion,resumen,palabras_clave,anaquel,entrepano,fecha_ingreso) values ('$codigo','$tip_documento','$tema','$titulo','$autor','$lugar','$fecha_impresion','$resumen','$palabras_clave','$anaquel','$entrepano','$fecha_ingreso')";	

mssql_query($consulta);				 
           }

?> 

 





</body>
</html>
