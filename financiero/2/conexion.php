<?php
function conectar()
{
	mysql_connect("localhost", "root", "kalki");
	mysql_select_db("ajax");
}

function desconectar()
{
	mysql_close();
}
?>