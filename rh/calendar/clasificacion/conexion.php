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
?>