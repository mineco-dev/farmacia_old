<?php
function conectar()
{
	mysql_connect("localhost", "", "");
	mysql_select_db("rgm");
}

function desconectar()
{
	mysql_close();
}

function validaIngreso($valor)
{
	// Funcion utilizada para validar el dato a ingresar recibido por POST
	if(eregi("^[a-zA-Z0-9.@ ]{4,40}$", $valor)) return TRUE;
	else return FALSE;
}

function verificaExistencia($valor)
{
	/* Funcion encargada de verificar la existencia del apodo recibido en base de datos.
	Devuelve TRUE si el apodo existe, FALSE de lo contrario */
	$consulta=mysql_query("SELECT no_colegiado FROM tb_abogado WHERE no_colegiado='$valor'") or die(mysql_error());
	$registro=mysql_fetch_row($consulta);
	
	if(!empty($registro)) return TRUE;
	else return FALSE;
}
function mostrarnombre($valor)
{
	/* Funcion encargada de verificar la existencia del apodo recibido en base de datos.
	Devuelve TRUE si el apodo existe, FALSE de lo contrario */
	$consulta=mysql_query("SELECT concat(nombre1_abogado,' ',nombre2_abogado,' ',apellido1_abogado,' ',apellido2_abogado) FROM tb_abogado WHERE no_colegiado='$valor'") or die(mysql_error());
	$reg=mysql_fetch_row($consulta);
	
	return $reg[0];
}


if(isset($_POST["ingreso"]))
{

	$valor=trim($_POST["ingreso"]);
	$cod=$_POST["codigo"];
	
	if(validaIngreso($valor))
	{
		conectar();

			mysql_query("UPDATE detalle_contrato_bien SET codigo_bien = '$valor' WHERE codigo_detalle_contrato = '$cod'") or die(mysql_error());
			echo "La Clasificacion ha sido Ingresada";	
		desconectar();
	}
}
elseif(isset($_POST["verificacion"]))
{

	$valor=trim($_POST["verificacion"]);

	if(validaIngreso($valor))
	{
		conectar();

		if(verificaExistencia($valor))
		{
			 echo mostrarnombre($valor)." Numero de Colegiado Activo";
		}else echo "Este numero de colegiado no se encuentra ACTIVO";
		desconectar();
	}
}


?>