
<?

session_start();
if (!isset($_SESSION["subgerencia"])) $dependencia=33;
else $dependencia=($_SESSION["subgerencia"]);
require("../../../includes/funciones.php");
require("../../../includes/sqlcommand.inc");
session_register("ingresando_obj");
$_SESSION["ingresando_obj"]=true;

		conectardb($inventarioadmin);

if($var == 1)
{
		
		$query = 'select mo.modelo,i.color,i.numero_inventario,i.numero_serie,i.numero_sicoin,
m.marca,o.tipo,i.ubicacion,memo.capacidad_memoria,hd.capacidad_disco,
procesador.velocidad_procesador,si.software, si.serie,i.codigo_usuario_responsable,ie.numero_etiqueta
from tb_inventario i 
left join cat_tipo_objeto o on i.codigo_tipo_objeto = o.codigo_tipo_objeto 
left join cat_marca m on i.codigo_marca = m.codigo_marca
left join cat_modelo mo on i.codigo_modelo = mo.codigo_modelo
left join cat_capacidad_memoria memo on i.codigo_capacidad_memoria = memo.codigo_capacidad_memoria
left join cat_capacidad_disco hd on i.codigo_capacidad_disco = hd.codigo_capacidad_disco
left join cat_velocidad_procesador procesador on i.codigo_velocidad_procesador = procesador.codigo_velocidad_procesador
left join tb_inventario_softwareinstall_det si on i.codigo_inventario_enc = si.codigo_inventario_enc
left join tb_inventario_etiqueta_det ie on i.codigo_inventario_enc = ie.codigo_inventario_enc where numero_etiqueta = "'.$numero_etiqueta.'"
order by o.tipo desc';


		
		$salida = mssql_query($query);
		print '<table>';
		
		while ($vec = mssql_fetch_row($salida))
		{	
			print '<tr>';
			for ($x = 0;$x<=14;$x++)
			{
				print '<td>';
				print $vec[$x];					
				print '</td>';
				
			}
			print '</tr>';

		}
		print '</table>';
		
}		
?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  Numero de Etiqueta
    <input type="text" name="textfield" />
	   <input type="hidden" name="var" value="1" />
</form>
</body>
</html>
