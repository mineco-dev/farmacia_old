<?
header("Cache-Control: no-cache, must-revalidate"); 
?>

<HTML>
<BODY>
<?
echo "<FORM METHOd=\"POST\" ACTION=$PHP_SELF >";
echo "Destinatario: <INPUT NAME=destinatario value=$destinatario><P>";
echo "Texto del mail <TEXTAREA NAME=texto COLUMNS=20 ROWS=10 >";
echo $texto;
echo "</TEXTAREA><P>";
echo "<INPUT TYPE=SUBMIT NAME=boton VALUE=Enviar>";
echo "</FORM>";

if ($boton=="Enviar")
mail("$destinatario",$motivo, $texto,"FROM: info@bdat.com\nX-Mailer: PHP");
?>
</BODY>
</HTML>

