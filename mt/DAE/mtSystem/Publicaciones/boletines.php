<?
session_start();
require("../../includes/var.inc");
require('../../includes/cnn/inc_header.inc');
require_once('../../includes/function.php');
$dbms=new DBMS($conexion);
$dbms->bdd=$database_cnn;
$dbms2=new DBMS($conexion);
$dbms2->bdd=$database_cnn;
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
</head>
<? require("../menu.php"); ?>
<body>
<? require("../header.php"); ?>
<table width="95%" border="0" align="center">
  <tr>
    <td><?
	$idclasificacion = $_POST['idclasificacion'];
	$nombre = $_POST['nombre'];
	$descripcion = $_POST['descripcion'];
	$fecha = $_POST['fecha'];
	$confidencial = intval($_POST['confidencial']);
	//$userfile = $_POST['userfile'];

	$fecha= substr($fecha,6,4)."/".substr($fecha,3,2)."/".substr($fecha,0,2);

	if (strlen($nombre)>0)
	{
		$qry_miembro = "insert into 
					tbl_publicacion(
								idclasificacion,
								nombre,
								fecha,
								descripcion,
								confidencial)
				  		values(
				  				'$idclasificacion',
								'$nombre',
								'$fecha',
								'$descripcion',
								'$confidencial')";
		$dbms->sql = $qry_miembro;
		$dbms->QueryI();
		$Fields= get_value("select max(idpublicacion) as idpublicacion from tbl_publicacion",$dbms);
		$idpublicacion = $Fields["idpublicacion"];
		/////////////////////////////////// inserta adjuntos ///////////////////////////////////////////////////////
		$mtusuario = $_SESSION['vs_mt_idusuario'];	
		$lineas = sizeof($userfile);
		$cnt = 0;
		$ban = 0;
		while ($cnt <= $lineas)
		{
			$nombre_archivo = $HTTP_POST_FILES['userfile']['name'][$cnt];
			$tipo_archivo = $HTTP_POST_FILES['userfile']['type'][$cnt];
			$tamano_archivo = $HTTP_POST_FILES['userfile']['size'][$cnt];
		
			$tmpfile = "upload/".$mtusuario."_".date("d").date("m").date("Y").date("H").date("i").date("s")."_".$nombre_archivo;
			
			if (strlen($userfile[$cnt])>0)
			{
				if(move_uploaded_file($_FILES['userfile']['tmp_name'][$cnt],$tmpfile))
				{ 
					$query = "insert into tbl_publicacionarchivo
							(idpublicacion, nombre, url)
						  values 
							('$idpublicacion','$nombre_archivo','$tmpfile')";
					$dbms->sql = $query;
					$dbms->QueryI();
				}
			}	
			$cnt ++;		
		}
		alert("Datos guardados satisfactoriamente");
	}
?>
        <form action="boletines.php" method="post" enctype="multipart/form-data" name="form1">
          <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="panel">
            <tr>
              <td colspan="4" class="grey"><strong>Ingreso de publicaciones</strong></td>
            </tr>
            <tr>
              <td colspan="4">&nbsp;</td>
            </tr>
            <tr>
              <td width="75">&nbsp;</td>
              <td width="115">Sector:</td>
              <td width="497" colspan="-1"><select name="idclasificacion" id="idclasificacion">
                  <?
                $dbms->sql="select 
                                idclasificacion,nombre
                            from 
                                tbl_clasificacion
                            order by nombre"; 
                $dbms->Query(); 
                $cnt=0;
                while($Fields=$dbms->MoveNext()) 
                {
                    print "<option value=\"".$Fields["idclasificacion"]."\"> ".$Fields["nombre"]."</option>"; 
                }
            ?>
              </select></td>
              <td width="190" colspan="-1">&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>Fecha: </td>
              <td colspan="-1"><input name="fecha" type="text" id="dateArrival" size="10" 
    value ="<? print date("d")."-".date("m")."-".date("Y");?>" class="textfield"/>
                  <img src="images/iconCalendar.gif" width="16" height="16" border="0" onclick="popUpCalendar(this, form1.dateArrival, 'dd-mm-yyyy');"/></td>
              <td colspan="-1">&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>Nombre: </td>
              <td><input name="nombre" type="text" id="nombre" size="80" class="textfield"/></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>Descripción:</td>
              <td><textarea name="descripcion" id="descripcion" cols="59" rows="5"></textarea></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>Confidencial:</td>
              <td><input name="confidencial" type="checkbox" id="confidencial" value="1"/></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>
			  <?
			  	require("adjunto.php");
              ?>              </td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="4"><div align="center">
                <input type="button" name="btn1" value="Guardar datos" onclick="verificar()" class="button" /><br>
              </div></td>
            </tr>
            <tr>
              <td colspan="4">
              <div align="center">
              	<?
                	$vec[0] = "Nombre";
                	$vec[1] = "Fecha";
                	$vec[2] = "Descripcion";
					
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
									where p.idclasificacion = c.idclasificacion
								 order by c.nombre,p.fecha";
					getTablaAgrupada($query,3,$vec,$vec2,$vec3,$dbms,95,"","boletinesborra.php?idpublicacion=","sector");
				
				?>  
              </div>
              </td>
            </tr>
          </table>
        </form></td>
  </tr>
</table>
<? 	require("../footer.php"); ?>
</BODY>
</html>