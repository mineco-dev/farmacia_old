<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
</head>

<body>
<?
	$hostname_cnn = "server_appl";
	$database_cnn = "biblioteca";
	$username_cnn = "biblioteca";
	$password_cnn = "biblioteca2009";
	$conexion = mssql_connect($hostname_cnn,$username_cnn,$password_cnn);
	mssql_select_db($database_cnn,$conexion);
echo $conexion; 
		   $doc = new DOMDocument();
           $doc->load( 'DIGITBD.xml' );
           $books = $doc->getElementsByTagName( "RECORD" );
           foreach( $books as $book )
		   {
                     $authors = $book->getElementsByTagName( "Tag_1" );
                     $codigo = $authors->item(0)->nodeValue;
				   
				    /* $tag_41 = $book->getElementsByTagName( "Tag_2" );
					 $titulo = $tag_41->item(0)->nodeValue;			   
				
					 $titles2 = $book->getElementsByTagName( "Tag_3" );
					 $tema2 = $titles2->item(0)->nodeValue;
					 
					 $tag_51 = $book->getElementsByTagName( "Tag_4" );
					 $autor = $tag_51->item(0)->nodeValue;
						
					 $tag_71 = $book->getElementsByTagName( "Tag_5" );
					 $fecha_impresion = $tag_71->item(0)->nodeValue;
					
					 $tag_61 = $book->getElementsByTagName( "Tag_6" );
					 $lugar = $tag_61->item(0)->nodeValue;
					
					 $publishers = $book->getElementsByTagName( "Tag_7" );
					 $tip_documento = $publishers->item(0)->nodeValue;
	   
					  $tag_81 = $book->getElementsByTagName( "Tag_8" );
					 $resumen = $tag_81->item(0)->nodeValue;
					 
					$titles = $book->getElementsByTagName( "Tag_9" );
					 $tema = $titles->item(0)->nodeValue;
		
					 $tag_101 = $book->getElementsByTagName( "Tag_10" );
					 $anaquel = $tag_101->item(0)->nodeValue;
	
					 $tag_111 = $book->getElementsByTagName( "Tag_11" );
					 $entrepano = $tag_111->item(0)->nodeValue;
	
					 $tag_121 = $book->getElementsByTagName( "Tag_12" );
					 $fecha_ingreso = $tag_121->item(0)->nodeValue;*/ 
	
				}										
					$consulta = "insert into tb_libros			(codigo,tip_documento,tema,titulo,autor,lugar,fecha_impresion,resumen,anaquel,entrepano,fecha_ingreso_txt) values ('$codigo','$tip_documento','$tema','$titulo','$autor','$lugar','$fecha_impresion','$resumen','$anaquel','$entrepano','$fecha_ingreso')";	
//	mssql_query($consulta);			 	
	echo $consulta;

?> 
</body>
</html>
