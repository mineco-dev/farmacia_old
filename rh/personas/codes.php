<?

	include('conectarse.php');
	include('../includes/inc_header_sistema.inc');
	
	
	
	$h = mssql_query("select id_contratacion_gobierno,idasesor,idasesor,salario,temporal from tb_contratacion_gobierno");

	
	while($r = mssql_fetch_row($h))
	{

	mssql_query("update tb_contratacion_gobierno set sueldo = '$r[3]' where id_contratacion_gobierno = '$r[0]'");
	
		
	}
	
	if ($r)
	{
		echo 'listo';
	}
	
	
?>