<?php
function conectar()
{
	mysql_connect("server_appl", "sa", "sa");
	mysql_select_db("financiero");
}

function desconectar()
{
	mysql_close();
}
?>