<script language="javascript">
function Verifica()
 {
	if ( this.tabla.value == "" || this.tablamax.value == "")
		{
			alert('Por favor llene los campos requeridos **');
			return false
		}
	else
		{
			var i, resultado, j;
			alert("el valor de tablamax es",this.tablamax.value)
			for (i=1;i<=this.tablamax.value;i++)
			{	
				j = this.tabla.value
				resultado = j*i
				document.write(i + "<BR>" + "<BR>")
				alert("el valor de i es ",i)
				alert("el valor de i es ",j)
				alert(resultado)
				document.write("<BR>" + this.tabla.value + "<BR>")
				document.write("<BR>" + resultado + "<BR>")
			}

		}			
 }
</script>

<!DOCTYPE html>
<html>
<head>
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>
<!--form name="form1" action="ciclo.html" method="post" onSubmit="return Verifica()"-->
<form name="form1" action="ciclo.html"  method="post">
<table align="center">
	<tr>
		<Td align="center">
			Ingrese el numero de Tabla de multiplicar que desea generar 
		</Td>
	</tr>
	<tr>
		<Td align="center">
			**<input type="text" name="tabla" maxlength="3" size="3">
		</Td>
	</tr>
	<tr>
		<Td align="center">
			Hasta que numero desea generar la tabla
		</Td>
	</tr>
	<tr>
		<Td align="center">
			**<input type="text" name="tablamax" maxlength="3" size="3">
		</Td>
	</tr>
		<tr>
		<Td align="center">
	<input type="submit" value="Generar" onClick="return Verifica()">
		</Td>
	</tr>


</table>
<input type="hidden" name="genera" value="1">

</form>
<?
/*if ( isset($_POST['genera']) && ($_POST['genera'] == 1) )
	{ ?>
<table border="1" align="center">
<?	for ($i=1;$i<=$_POST['tablamax'];$i++)
		{
		?>
		<tr>
		<td align="center"><? echo $_POST['tabla']; ?></td> 
		<td align="center">*</td>
		<td align="center"><? echo $i; ?></td> 
		<td align="center">=</td>
		<td align="center"><? echo $_POST['tabla']*$i; ?></td>
	</tr>	
	<?	}  ?>
</table>
<?	} */
?>
</body>
</html>
