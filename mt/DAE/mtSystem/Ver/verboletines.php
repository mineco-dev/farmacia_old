<?
session_start();
require("../../includes/var.inc");
require('../../includes/cnn/inc_header.inc');
require_once('../../includes/function.php');
$dbms=new DBMS($conexion);
$dbms->bdd=$database_cnn;
$dbms2=new DBMS($conexion);
$dbms2->bdd=$database_cnn;

$idmes = intval($_GET['idmes']);

if ($idmes==0) $idmes = intval(date("m"));

$idmes1 = $idmes -1;
$idmes2 = $idmes +1;
if ($idmes1 == 0) $idmes1 = 12;
if ($idmes2 == 13) $idmes2 = 1;

?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8/>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>

<link href="../style.css" rel="stylesheet" type="text/css" />
<link href="../../style.css" rel="stylesheet" type="text/css" />
<script language=javascript src="../../includes/FormCheck.js"></script>
<script language=javascript src="../../includes/custom-form-elements.js"></script>

<SCRIPT>
function trim(s){
	s = s.replace(/\s+/gi, ''); //sacar espacios repetidos dejando solo uno
	s = s.replace(/^\s+|\s+$/gi,''); //sacar espacios blanco principio y final
	return s;
}

function verificar () {
    if(	checkField(document.form1.nombre, isAlphanumeric, false ))
			document.form1.submit();
}
</SCRIPT>
<script language="javascript" src="popcalendar.js"></script>

	<!-- Meta Tags -->
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="robots" content="index, follow" />
	
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="css/default.css" />
    <link rel="stylesheet" type="text/css" href="css/lightwindow.css" />
    
	<!-- JavaScript -->
	<script type="text/javascript" src="javascript/prototype.js"></script>
	<script type="text/javascript" src="javascript/effects.js"></script>
	<script type="text/javascript" src="javascript/lightwindow.js"></script>
    
</head>
<? require("../menu.php"); ?>
<body>

<? require("../header.php"); ?>
<table width="95%" border="0" align="center">
  <tr>
    <td>
        <form action="boletines.php" method="post" enctype="multipart/form-data" name="form1">
          <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="panel">
            <tr>
              <td width="877" class="grey"><strong>Ver publicaciones</strong></td>
            </tr>
            <tr>
              <td><div align="center">
                <table width="50%%" border="0">
                  <tr>
                    <td><div align="center"><a href="verboletines.php?idmes=<?=$idmes1?>"><img src="../img/izq.jpg" border="0" /></a></div></td>
                    <td><div align="center" class="errorbox">
                        <?=get_mes($idmes)?>
                    </div></td>
                    <td><div align="center"><a href="verboletines.php?idmes=<?=$idmes2?>"><img src="../img/der.jpg" border="0" /></a></div></td>
                  </tr>
                </table>
              </div>                </td>
            </tr>
            <tr>
              <td><div align="center"><br />
              </div></td>
            </tr>
            <tr>
              <td>
              <div align="center">
              	<?
                	$vec[0] = "Nombre";
                	$vec[1] = "Fecha";
                	$vec[2] = "Descripción";
					
					$vec2[0] = "nombre";
					$vec2[1] = "fecha";
					$vec2[2] = "descripcion";
					$vec2[3] = "idpublicacion";
					
					$vec3[0] = "width=\"25%\"";
					$vec3[1] = "width=\"10%\"";
					$vec3[2] = "width=\"65%\"";
				
					$query =" select c.nombre as sector,p.nombre,date_format(p.fecha,'%d/%m/%Y') as fecha,
									p.descripcion, p.idpublicacion
								 from
									tbl_publicacion p, tbl_clasificacion c
									where 
										p.idclasificacion = c.idclasificacion and 
										month(p.fecha) = $idmes 
								 order by c.nombre,p.fecha";
					getTablaAgrupada($query,3,$vec,$vec2,$vec3,$dbms,95,"detalle.php?idpublicacion=","","sector");
				
				?>  
              </div>              </td>
            </tr>
          </table>
        </form></td>
  </tr>
</table>
<? 	require("../footer.php"); ?>

</BODY>
</html>