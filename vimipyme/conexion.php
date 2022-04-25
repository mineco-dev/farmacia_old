<?php
function conectar()
{
	mssql_connect("server_appl", "sa", "sa");
	mssql_select_db("vimipyme");
}

function conectar_rrhh()
{
	mssql_connect("server_appl", "sa", "sa");
	mssql_select_db("rrhh");
}

function desconectar()
{
	mssql_close();
}
?>