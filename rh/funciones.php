<?
session_start(); 
function conectardb($grupo_rol)
{	
	$myserver="128.5.8.85";
	$bd_usuario = "dev"; 
	$bd_password = "12345678"; 
	if (isset($_SESSION["param_conexion"]))
	{
		$grupos=count($_SESSION["param_conexion"]);
		$i=1;
		while ($i<=$grupos)
		{
			if ($_SESSION["param_conexion"]["$i"][3]==$grupo_rol)
			{
				$myuser=$_SESSION["param_conexion"]["$i"][1];
				$mypass=$_SESSION["param_conexion"]["$i"][2];
				$mydb=$_SESSION["param_conexion"]["$i"][4];
			}
			$i++;		
		}	
	$server=mssql_connect($myserver, $bd_usuario, $bd_password) or die ("no se pudo conectar al servidor $myserver");
	$database=mssql_select_db($mydb, $server);	
	return($server);
	}
	else
	{
		require_once('../connection/helpdesk.php');
	}
}
function desconectardb($s)
{
	mssql_close($s);
}

function dia()
{
	$i=1;	
	 while ($i<=31)
	  {
					
                    $dia = $dia."<option value=".$i.">".$i."</option>";
          $i++;
	 }
	 return $dia;
}	

function mes()
{
	$i=1;	
	 while ($i<=12)
	  {
					
                    $mes = $mes."<option value=".$i.">".$i."</option>";
          $i++;
	 }
	 return $mes;
}		

function anio()
{
	$i=2009;	
	 while ($i<=2025)
	  {
					
                    $anio = $anio."<option value=".$i.">".$i."</option>";
          $i++;
	 }
	 return $anio;
}	
?>
