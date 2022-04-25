<?
session_start();
include("conectarse.php");
$usr =   $_SESSION['idempleado'];
//$usr = 4;

$producto  = $_GET['pro'];
//print $producto;
//print 'aqui es';

if  (( !$_SESSION['usr_val']) || ($_SESSION['usr_val'] == 'N') || ($_SESSION['usr_val'] == '') )
		{
		//envia_msg('2-'.$_SESSION['nivel']);
		 if ($_SESSION['nivel'] == 1)
			{
			 cambiar_ventana('mtlogin.php');
			}
		if ($_SESSION['nivel'] == 4)
			{
			 cambiar_ventana('../mtlogin.php');
			}

		  if ($_SESSION['nivel'] == 2)
			{
			 cambiar_ventana('../../mtlogin.php');
			}
		 if ($_SESSION['nivel'] == 3)
			{
			 cambiar_ventana('../../../mtlogin.php');
			}
		}

require_once('helpdesk.php');  


?>
<?
//envia_msg($nit1);

?>

<?
$sql1 = "select nit from cat_proveedor where nit = '$nit1'";

$result = mssql_query($sql1);

 $rsRows = mssql_query("select @@rowcount as rows");
				$rows = mssql_fetch_assoc($rsRows); 
					 //  envia_msg( $rows['rows']);
					 //envia_msg(mssql_rows_affected($result) );
			   if ( $rows['rows'] > 0 )
				 {
					error_msg('ya existe el proveedor en el sistema ');	
					
//					commit tran
				 }	
				else
				 {
				 
				 $consulta = "EXEC proc_add_proveedor @v_nit='".strtoupper($nit1)."',  @v_proveedor='".strtoupper($proveedor)."', @v_direccion='$direccion', @v_telefono='$telefono', @v_email='$email',  @v_codigo_usuario_creo='$usr'";		
		$result=$query($consulta);	
		$close($s);		
		session_write_close();
					envia_msg('Se Ingreso exitosamente el Proveedor');	
					cambiar_ventana('proveedor.php');
//					rollback tran
				 }














/* ------------------ todo esto fue lo que quite-------------
while ($row = mssql_fetch_array ($result)) 

{
if (rtrim($nit1) == rtrim($row[0]))
//$a = $row[0];


{
$xm=1;
}
else
{
$xm=2;
}
?>
<?	//print $row[0];?>
<?
$a = $row[0];
}
envia_msg($nit1);
envia_msg("nit es igual al nit");
envia_msg($a);

?>


<?

if ($xm==1)
{
envia_msg("NIT YA EXISTENTE");
envia_msg("FAVOR HABLAR CON EL ADMINISTRADOR DEL SISTEMA");
cambiar_ventana('proveedor.php');
}
else
{
if(strlen($nit1) == 8)
{

//envia_msg($nit);



//aqui iva todo lo de almacenaje

		
envia_msg('los datos ya fueron guardados correctamente');
print ('los datos han sido guardados correctamente');
cambiar_ventana('proveedor.php');

}
else
{
envia_msg("NIT INCORRECTO");
cambiar_ventana('proveedor.php');
}
}
*/
?>