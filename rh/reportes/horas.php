<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
</head>

<body>


<?
$horas='23:30';

 function calcular_tiempo_trasnc($hora1,$hora2){ 
    $separar[1]=explode(':',$hora1); 
    $separar[2]=explode(':',$hora2); 

$total_minutos_trasncurridos[1] = ($separar[1][0]*60)+$separar[1][1]; //se toman los minutos de la primera hora y se multiplica por 60
$total_minutos_trasncurridos[2] = ($separar[2][0]*60)+$separar[2][1]; // se toman los minutos de la segunda hora y se multiplica por 60
$total_minutos_trasncurridos = $total_minutos_trasncurridos[1]-$total_minutos_trasncurridos[2]; //diferencia entre hora 1 y hora 2

 	if($total_minutos_trasncurridos<=59) 
	 	
	return($total_minutos_trasncurridos.' Minutos');
	
 elseif($total_minutos_trasncurridos>59)
 	{ 
		$HORA_TRANSCURRIDA = round($total_minutos_trasncurridos/60); // calcula las horas cuando llega a 59 para divirlo en 60 minutos
		
	if($HORA_TRANSCURRIDA<=9) $HORA_TRANSCURRIDA='0'.$HORA_TRANSCURRIDA; 
		$MINUITOS_TRANSCURRIDOS = $total_minutos_trasncurridos%60; //calcula los minutos transcurridos para cuando es 9 mod

		 if($MINUITOS_TRANSCURRIDOS<=9) $MINUITOS_TRANSCURRIDOS='0'.$MINUITOS_TRANSCURRIDOS;
			 return ($HORA_TRANSCURRIDA.':'.$MINUITOS_TRANSCURRIDOS.' Horas'); 

	} 
} 
//llamamos la función e imprimimos 
echo calcular_tiempo_trasnc($horas,'17:30'); 
?> 



</body>
</html>
