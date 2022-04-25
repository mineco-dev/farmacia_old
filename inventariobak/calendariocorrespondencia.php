<?
session_start();	$_SESSION['folder'] = "";


function calcula_numero_dia_semana($dia,$mes,$ano){
	$numerodiasemana = date('w', mktime(0,0,0,$mes,$dia,$ano));
	if ($numerodiasemana == 0)
		$numerodiasemana = 6;
	else
		$numerodiasemana--;
	return $numerodiasemana;
}

//funcion que devuelve el �ltimo d�a de un mes y a�o dados
function ultimoDia($mes,$ano){
    $ultimo_dia=28;
    while (checkdate($mes,$ultimo_dia + 1,$ano)){
       $ultimo_dia++;
    }
    return $ultimo_dia;
}

function mostrarempleados($fec)
{
	$direccionid = $_SESSION['siddireccion'];
	$usuarioid = $_SESSION[idempleado];
	$ret ="";

	include('../INCLUDES/inc_header.inc');
	$dbms=new DBMS($conexion); 
/*	require_once('Connections/redes.php');
	mysql_select_db($database_redes);*/
	//$sSQL="Select * From empleados where habilitado <> 'n' and iddireccion = $direccionid and protempore = 1 order by nombres";

	$sSQL1="Select c.idasesor,e.nombre,e.apellido From calendario c, asesor e where fecha = '$fec'
	and e.idasesor = c.idasesor group by c.idasesor,e.nombre,e.apellido order by nombre";
	$sSQL1 = "Select c.idasesor idasesor,e.nombre nombre,e.apellido apellido
				From calendario c, asesor e
				where fecha = '$fec' and
					e.idasesor = c.idasesor and
					e.idasesor = $usuarioid
				group by c.idasesor,e.nombre,e.apellido
				union
				select d.idusuario idempleado,e.nombres nombre,e.apellidos apellido
				from documentoselabora d, asesor e
				where fecha = '$fec' and
				    e.idasesor = $usuarioid and
					e.idasesor = d.idusuario
				group by d.idusuario,e.nombre,e.apellido
				order by nombre";
	//$ret = $sSQL1;
	$result1=mssql_query($sSQL1);
	while ($row1=mssql_fetch_array($result1))
	{
		$mtcad = "enlace";
		$usu = $row1['idasesor'];
		$emp = $row1['nombre']." ".$row1['apellido'];

 $cnt = "select count(*) cantidad from calendario where fecha < fechaingreso and idasesor = $usu and fecha='$fec' and protempore = 1";

		$result12=mssql_query($cnt);
		$row12=mssql_fetch_array($result12);
		if (intval($row12['cantidad'])>0) $mtcad = "enlace2";

		$cnt = "select count(pp.idpermiso) cantidad2 from permisopersonal pp,fechapermiso fp
		  where
		    fp.fecha < pp.fecha and
			pp.idpermiso = fp.idpermiso and
			pp.idusuario = $usu and
			pp.fecha='$fec'";
		$result12=mssql_db_query($cnt);
		$row12=mssql_fetch_array($result12);
		if (intval($row12['cantidad2'])>0) $mtcad = "enlace3";

//esto de aqui porque solo se necesita para correspondencia.
		//$enlace = "<a href='mostraractividad.php?usu=$usu&fecha=$fec' class='$mtcad'>$emp</a>";
		$enlace = "<img src=\"imagen/visualizar.gif\" width=\"16\" height=\"16\">";
		$enlace = "<img src=\"imagen/arrow2.jpg\" width=\"16\" height=\"16\">";
		$ret = $ret."<p>$enlace</p>";
	}
	return $ret;
}

function dame_nombre_mes($mes){
	 switch ($mes){
	 	case 1:
			$nombre_mes="Enero";
			break;
	 	case 2:
			$nombre_mes="Febrero";
			break;
	 	case 3:
			$nombre_mes="Marzo";
			break;
	 	case 4:
			$nombre_mes="Abril";
			break;
	 	case 5:
			$nombre_mes="Mayo";
			break;
	 	case 6:
			$nombre_mes="Junio";
			break;
	 	case 7:
			$nombre_mes="Julio";
			break;
	 	case 8:
			$nombre_mes="Agosto";
			break;
	 	case 9:
			$nombre_mes="Septiembre";
			break;
	 	case 10:
			$nombre_mes="Octubre";
			break;
	 	case 11:
			$nombre_mes="Noviembre";
			break;
	 	case 12:
			$nombre_mes="Diciembre";
			break;
	}
	return $nombre_mes;
}

function dame_estilo($dia_imprimir){
	global $mes,$ano,$dia_solo_hoy,$tiempo_actual;
	//dependiendo si el d�a es Hoy, Domigo o Cualquier otro, devuelvo un estilo
	if ($dia_solo_hoy == $dia_imprimir && $mes==date("n", $tiempo_actual) && $ano==date("Y", $tiempo_actual)){
		//si es hoy
		$estilo = " class='hoy'";
	}else{
		$fecha=mktime(12,0,0,$mes,$dia_imprimir,$ano);
		if (date("w",$fecha)==0){
			//si es domingo
			$estilo = " class='domingo'";
		}else{
			//si es cualquier dia
			$estilo = " class='diario'";
		}
	}
	return $estilo;
}

function mostrar_calendario($mes,$ano){
	global $parametros_formulario;
	//tomo el nombre del mes que hay que imprimir
	$nombre_mes = dame_nombre_mes($mes);

	//construyo la cabecera de la tabla
	echo "<table width=75% cellspacing=0 cellpadding=0 border=1><tr><td colspan=7 align=center class=tit >";
	echo "<table width=100% cellspacing=0 cellpadding=0 border=1><tr><td valign='top' align=left style=font-size:10pt;font-weight:bold;color:white>";
	//calculo el mes y ano del mes anterior
	$mes_anterior = $mes - 1;
	$ano_anterior = $ano;
	if ($mes_anterior==0){
		$ano_anterior--;
		$mes_anterior=12;
	}

	//&lt;&lt;
	echo "<a style=color:white;text-decoration:none href=indexcorrespondencia.php?$parametros_formulario&nuevo_mes=$mes_anterior&nuevo_ano=$ano_anterior></a></td>";
	   echo "<td align=center class=tit>Mes Actual $nombre_mes $ano</td>";
	   echo "<td valign='top' align=right style=font-size:6pt;font-weight:bold;color:white>";
	//calculo el mes y ano del mes siguiente
	$mes_siguiente = $mes + 1;
	$ano_siguiente = $ano;
	if ($mes_siguiente==13){
		$ano_siguiente++;
		$mes_siguiente=1;
	}
	//&gt;&gt;
	echo "<a style=font-size:6pt;color:white;text-decoration:none href=indexcorrespondencia.php?$parametros_formulario&nuevo_mes=$mes_siguiente&nuevo_ano=$ano_siguiente></a></td></tr></table></td></tr>";
	echo '	<tr>
			    <td width=14% align=center class=altn>Lu</td>
			    <td width=14% align=center class=altn>Ma</td>
			    <td width=14% align=center class=altn>Mi</td>
			    <td width=14% align=center class=altn>Ju</td>
			    <td width=14% align=center class=altn>Vi</td>
			    <td width=14% align=center class=altn>Sa</td>
			    <td width=14% align=center class=altn>Do</td>
			</tr>';

	//Variable para llevar la cuenta del dia actual
	$dia_actual = 1;

	//calculo el numero del dia de la semana del primer dia
	$numero_dia = calcula_numero_dia_semana(1,$mes,$ano);
	//echo "Numero del dia de demana del primer: $numero_dia <br>";

	//calculo el �ltimo dia del mes
	$ultimo_dia = ultimoDia($mes,$ano);

	//escribo la primera fila de la semana
	echo "<tr>";
	for ($i=0;$i<7;$i++){
		if ($i < $numero_dia){
			//si el dia de la semana i es menor que el numero del primer dia de la semana no pongo nada en la celda
			echo "<td></td>";
		} else {
			$ff = $ano."/".$mes."/".$dia_actual;
			echo "<td valign='top' align=center><a href='javascript:devuelveFecha($dia_actual,$mes,$ano)'". dame_estilo($dia_actual) .">$dia_actual </a>".mostrarempleados($ff)."</td>";
			$dia_actual++;
		}
	}
	echo "</tr>";

	//recorro todos los dem�s d�as hasta el final del mes
	$numero_dia = 0;
	while ($dia_actual <= $ultimo_dia){
		//si estamos a principio de la semana escribo el <TR>
		$ff = $ano."/".$mes."/".$dia_actual;

		if ($numero_dia == 0)
			echo "<tr>";
		echo "<td valign='top' align=center><a href='javascript:devuelveFecha($dia_actual,$mes,$ano)'". dame_estilo($dia_actual) .">$dia_actual</a>".mostrarempleados($ff)."</td>";

		$dia_actual++;
		$numero_dia++;
		//si es el u�timo de la semana, me pongo al principio de la semana y escribo el </tr>
		if ($numero_dia == 7){
			$numero_dia = 0;
			echo "</tr>";
		}
	}

	//compruebo que celdas me faltan por escribir vacias de la �ltima semana del mes
	for ($i=$numero_dia;$i<7;$i++){
		echo "<td></td>";
	}

	echo "</tr>";
	echo "</table>";
}

function formularioCalendario($mes,$ano){
	global $parametros_formulario;
echo '
	<br>
	<table align="center" cellspacing="2" cellpadding="2" border="0" class=tform>
	<tr><form action="indexcorrespondencia.php?' . $parametros_formulario . '" method="POST">';
echo '
    <td align="center" valign="top">
		Mes: <br>
		<select name=nuevo_mes>
		<option value="1"';
if ($mes==1)
 echo "selected";
echo'>Enero
		<option value="2" ';
if ($mes==2)
	echo "selected";
echo'>Febrero
		<option value="3" ';
if ($mes==3)
	echo "selected";
echo'>Marzo
		<option value="4" ';
if ($mes==4)
	echo "selected";
echo '>Abril
		<option value="5" ';
if ($mes==5)
		echo "selected";
echo '>Mayo
		<option value="6" ';
if ($mes==6)
	echo "selected";
echo '>Junio
		<option value="7" ';
if ($mes==7)
	echo "selected";
echo '>Julio
		<option value="8" ';
if ($mes==8)
	echo "selected";
echo '>Agosto
		<option value="9" ';
if ($mes==9)
	echo "selected";
echo '>Septiembre
		<option value="10" ';
if ($mes==10)
	echo "selected";
echo '>Octubre
		<option value="11" ';
if ($mes==11)
	echo "selected";
echo '>Noviembre
		<option value="12" ';
if ($mes==12)
    echo "selected";
echo '>Diciembre
		</select>
		</td>';
echo '
	    <td align="center" valign="top">
		A&ntilde;o: <br>
		<select name=nuevo_ano>';

for ($cont=2005;$cont<$ano+3;$cont++){
	echo "<option value='$cont'";
	if ($ano==$cont)
   		echo " selected";
   	echo ">$cont";
}
echo '
	</select>
		</td>';
echo '
	</tr>
	<tr>
	    <td colspan="2" align="center"><input type="Submit" value="[ IR A ESE MES ]"></td>
	</tr>
	<tr>
	    <!--td colspan="2" align="center"><a href="menuProtempore.php">Menu</a> </td-->
	</tr>

	</table><br>

	<br>

	</form>';
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Funci�n que escribe en la p�gina un fomrulario preparado para introducir una fecha y enlazado con el calendario para seleccionarla comodamente
////////////////////////////////////////////////////////////////////////////////////////////////////////////
function escribe_formulario_fecha_vacio($nombrecampo,$nombreformulario){
	global $raiz;
	echo '
	<INPUT name="'.$nombrecampo.'" size="10">
	<input type=button value="Seleccionar fecha" onclick="muestraCalendario(\''. $raiz.'\',\''. $nombreformulario .'\',\''.$nombrecampo.'\')">
	';
}
?>