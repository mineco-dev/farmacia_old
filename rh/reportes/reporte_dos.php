<?
	require("../../includes/funciones.php");
	require("../../includes/sqlcommand.inc");
	conectardb($rrhh);
?>
<html>
<head>
<script LANGUAGE="JavaScript">
function Validar(form)
{
  if (form.txt_buscar.value == "")
  { 
  	alert("Puede buscar por nombre, apellido, extensión o dependencia"); 
	form.txt_buscar.focus(); 
	return;
  }  
function Refrescar(form)
{
	form.reset();
	form.txt_buscar.focus(); 
}
form.submit();
}
</script>
<link href="../../css/helpdesk.css" rel="stylesheet" type="text/css">
<link href="../../css/box_ie.css" rel="stylesheet" type="text/css" media="screen">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<style type="text/css">
<!--
.Estilo3 {color: #FFFFFF}
.Estilo4 {font-size: 9px}
.style2 {
	font-family: "Times New Roman", Times, serif;
	font-size: 24px;
	color: #666666;
}
-->
</style>
</head>

<body>

<div align="left">

    <table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#000000">
      <tr>
        <td><div align="center">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="13%"><img src="../../images/rrhh123.png" width="216" height="95"></td>
              <td width="72%"><div align="center" class="legal1">
                <p>Listado Personal por Dependencia y Reglon Presupeustario del MINECO<br>
				<?
				if ($_REQUEST["rg"])
				{
					if ($_REQUEST["rg"]==1)  echo 'Asesores 029';
					else
					if ($_REQUEST["rg"]==2)  echo 'Asesores 011 y 022';
					else
					if ($_REQUEST["rg"]==3)  echo 'Asesores 018';
				}
				?>
				</p>
                </div></td>
              <td width="15%"><div align="center"><img src="../../images/rrhh12.png" width="82" height="95"></div></td>
            </tr>
          </table>
          </div></td>
      </tr>
    </table>
    
	
<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" id="table17">     
      <td width="86"></thead>
      <tr align="center" bgcolor="#006699" class="boxTitleBgLightBlue">
          <td><strong>Codigo</strong></td>
          
          <td width="369"><strong>VICEMINISTERIO</strong></td>
          <td width="296">REGLON 011 </td>
          <td width="444">REGLON 022 </td>
          <td width="444">REGLON 029 </td>
          <td width="444">SUBGRUPO 18 </td>
          <td width="444">REGLON 089 </td>
          <td width="444"><strong>TOTAL POR VICEMINISERIO </strong></td>
</tr>


<?	
// query de Carlos Romero
/*	$query = "select p.puesto,g.sueldo,a.idasesor, g.renglon from asesor a, puesto p, tb_contratacion_gobierno g where a.idasesor = g.idasesor and a.id_puesto = p.id_puesto;"; */

if ($_REQUEST["rg"]) //cuando se desea un reporte por renglones
{
	if ($_REQUEST["rg"]==1)  //cuando es 029
	{
		$query = " select   a.idasesor, (a.nombre+' '+a.nombre2+' '+a.apellido+' '+a.apellido2) as nombre_empleado,dp.direccion_nombre, 
				 pnm.puesto_nominal , bon.valor
				 from asesor a	inner join dbo.tb_datos_laborales as dlb on dlb.id_asesor = a.idasesor inner join 
				 tb_direccion_pertenece as dp on dp.id_direccion_pertenece = dlb.id_direccion_pertenece inner join
				 tb_puesto_nominal as pnm on dlb.id_puesto_nominal = pnm.id_puesto_nominal inner join tb_bono as bon on
				 bon.idasesor = a.idasesor
				 where a.activo=1  and dlb.id_reglon_presupuestario=3 and bon.codigo_bono = 1  order by dp.direccion_nombre";
	}
	else
	if ($_REQUEST["rg"]==2) //cuando es 022 o 011
	{ 
		$query = "select   a.idasesor, (a.nombre+' '+a.nombre2+' '+a.apellido+' '+a.apellido2) as nombre_empleado,dp.direccion_nombre, 
				 pnm.puesto_nominal , bon.valor
				 from asesor a	inner join dbo.tb_datos_laborales as dlb on dlb.id_asesor = a.idasesor inner join 
				 tb_direccion_pertenece as dp on dp.id_direccion_pertenece = dlb.id_direccion_pertenece inner join
				 tb_puesto_nominal as pnm on dlb.id_puesto_nominal = pnm.id_puesto_nominal inner join tb_bono as bon on
				 bon.idasesor = a.idasesor
				 where a.activo=1  and (dlb.id_reglon_presupuestario=1 or dlb.id_reglon_presupuestario=2  ) and bon.codigo_bono = 1 order by dp.direccion_nombre";
		}
	else
	if ($_REQUEST["rg"]==3) //cuando es 018 o 189
	{
		$query = " select   a.idasesor, (a.nombre+' '+a.nombre2+' '+a.apellido+' '+a.apellido2) as nombre_empleado,dp.direccion_nombre, 
				 pnm.puesto_nominal , bon.valor
				 from asesor a	inner join dbo.tb_datos_laborales as dlb on dlb.id_asesor = a.idasesor inner join 
				 tb_direccion_pertenece as dp on dp.id_direccion_pertenece = dlb.id_direccion_pertenece inner join
				 tb_puesto_nominal as pnm on dlb.id_puesto_nominal = pnm.id_puesto_nominal inner join tb_bono as bon on
				 bon.idasesor = a.idasesor
				 where a.activo=1  and (dlb.id_reglon_presupuestario=4 or dlb.id_reglon_presupuestario=5  ) and bon.codigo_bono = 1 order by dp.direccion_nombre";
	
	}
}
	else
		{
		
		           // Viceministerio de Integración y Comercio Exterio reglones
		      		 $query = "select count (dlb.id_asesor)   from tb_datos_laborales as dlb inner join tbl_viceministerio as vice on dlb.id_viceministerio = vice.id_viceministerio
					inner join tb_reglon_presupuestario as rps on dlb.id_reglon_presupuestario=rps.id_reglon_presupuestario where dlb.id_reglon_presupuestario=1
					and dlb.id_viceministerio = 1";
		             $query2 = "select count (dlb.id_asesor)   from tb_datos_laborales as dlb inner join tbl_viceministerio as vice on dlb.id_viceministerio = vice.id_viceministerio
					inner join tb_reglon_presupuestario as rps on dlb.id_reglon_presupuestario=rps.id_reglon_presupuestario where dlb.id_reglon_presupuestario=2
					and dlb.id_viceministerio = 1";
		             $query3 = "select count (dlb.id_asesor)   from tb_datos_laborales as dlb inner join tbl_viceministerio as vice on dlb.id_viceministerio = vice.id_viceministerio
					inner join tb_reglon_presupuestario as rps on dlb.id_reglon_presupuestario=rps.id_reglon_presupuestario where dlb.id_reglon_presupuestario=3
					and dlb.id_viceministerio = 1";
		            $query4 = "select count (dlb.id_asesor)   from tb_datos_laborales as dlb inner join tbl_viceministerio as vice on dlb.id_viceministerio = vice.id_viceministerio
					inner join tb_reglon_presupuestario as rps on dlb.id_reglon_presupuestario=rps.id_reglon_presupuestario where (dlb.id_reglon_presupuestario=4 or 
					dlb.id_reglon_presupuestario=5 )and dlb.id_viceministerio = 1";
					$query5 = "select count (dlb.id_asesor)   from tb_datos_laborales as dlb inner join tbl_viceministerio as vice on dlb.id_viceministerio = vice.id_viceministerio
					inner join tb_reglon_presupuestario as rps on dlb.id_reglon_presupuestario=rps.id_reglon_presupuestario where dlb.id_reglon_presupuestario=5
					and dlb.id_viceministerio = 1";
				$do=mssql_query($query);
				$do1=mssql_query($query2);
				$do2=mssql_query($query3);
				$do3=mssql_query($query4);
				$do4=mssql_query($query5);
				
				
		
              while($vector = mssql_fetch_row($do)){  $a=$vector[0];}
			  while($vector1 = mssql_fetch_row($do1)){  $a1=$vector1[0];}
			  while($vector2 = mssql_fetch_row($do2)){  $a2=$vector2[0];}
			  while($vector3 = mssql_fetch_row($do3)){  $a3=$vector3[0];}
			  while($vector4 = mssql_fetch_row($do4)){  $a4=$vector4[0];}
			  $b=$a+$a1+$a2+$a3+$a4;

					// Viceministerio de Integración y Comercio Exterio reglones
					
					// Viceministerio de Integración y Comercio Exterio reglones
		      		 $querya = "select count (dlb.id_asesor)   from tb_datos_laborales as dlb inner join tbl_viceministerio as vice on dlb.id_viceministerio = vice.id_viceministerio
					inner join tb_reglon_presupuestario as rps on dlb.id_reglon_presupuestario=rps.id_reglon_presupuestario where dlb.id_reglon_presupuestario=1
					and dlb.id_viceministerio = 2";
		             $query2a = "select count (dlb.id_asesor)   from tb_datos_laborales as dlb inner join tbl_viceministerio as vice on dlb.id_viceministerio = vice.id_viceministerio
					inner join tb_reglon_presupuestario as rps on dlb.id_reglon_presupuestario=rps.id_reglon_presupuestario where dlb.id_reglon_presupuestario=2
					and dlb.id_viceministerio = 2";
		             $query3a = "select count (dlb.id_asesor)   from tb_datos_laborales as dlb inner join tbl_viceministerio as vice on dlb.id_viceministerio = vice.id_viceministerio
					inner join tb_reglon_presupuestario as rps on dlb.id_reglon_presupuestario=rps.id_reglon_presupuestario where dlb.id_reglon_presupuestario=3
					and dlb.id_viceministerio = 2";
		            $query4a = "select count (dlb.id_asesor)   from tb_datos_laborales as dlb inner join tbl_viceministerio as vice on dlb.id_viceministerio = vice.id_viceministerio
					inner join tb_reglon_presupuestario as rps on dlb.id_reglon_presupuestario=rps.id_reglon_presupuestario where (dlb.id_reglon_presupuestario=4 or 
					dlb.id_reglon_presupuestario=5 )and dlb.id_viceministerio = 2";
					$query5a = "select count (dlb.id_asesor)   from tb_datos_laborales as dlb inner join tbl_viceministerio as vice on dlb.id_viceministerio = vice.id_viceministerio
					inner join tb_reglon_presupuestario as rps on dlb.id_reglon_presupuestario=rps.id_reglon_presupuestario where dlb.id_reglon_presupuestario=5
					and dlb.id_viceministerio = 2";
				$doa=mssql_query($querya);
				$do1a=mssql_query($query2a);
				$do2a=mssql_query($query3a);
				$do3a=mssql_query($query4a);
				$do4a=mssql_query($query5a);
				
				
		
              while($vector = mssql_fetch_row($doa)){    $c=$vector[0];}
			  while($vector1 = mssql_fetch_row($do1a)){  $c1=$vector1[0];}
			  while($vector2 = mssql_fetch_row($do2a)){  $c2=$vector2[0];}
			  while($vector3 = mssql_fetch_row($do3a)){  $c3=$vector3[0];}
			  while($vector4 = mssql_fetch_row($do4a)){  $c4=$vector4[0];}
			  $b2=$c+$c1+$c2+$c3+$c4;

					// Viceministerio de Integración y Comercio Exterio reglones
					
					
					// Viceministerio de Integración y Comercio Exterio reglones
		      		 $queryb = "select count (dlb.id_asesor)   from tb_datos_laborales as dlb inner join tbl_viceministerio as vice on dlb.id_viceministerio = vice.id_viceministerio
					inner join tb_reglon_presupuestario as rps on dlb.id_reglon_presupuestario=rps.id_reglon_presupuestario where dlb.id_reglon_presupuestario=1
					and dlb.id_viceministerio = 3";
		             $query2b = "select count (dlb.id_asesor)   from tb_datos_laborales as dlb inner join tbl_viceministerio as vice on dlb.id_viceministerio = vice.id_viceministerio
					inner join tb_reglon_presupuestario as rps on dlb.id_reglon_presupuestario=rps.id_reglon_presupuestario where dlb.id_reglon_presupuestario=2
					and dlb.id_viceministerio = 3";
		             $query3b = "select count (dlb.id_asesor)   from tb_datos_laborales as dlb inner join tbl_viceministerio as vice on dlb.id_viceministerio = vice.id_viceministerio
					inner join tb_reglon_presupuestario as rps on dlb.id_reglon_presupuestario=rps.id_reglon_presupuestario where dlb.id_reglon_presupuestario=3
					and dlb.id_viceministerio = 3";
		            $query4b= "select count (dlb.id_asesor)   from tb_datos_laborales as dlb inner join tbl_viceministerio as vice on dlb.id_viceministerio = vice.id_viceministerio
					inner join tb_reglon_presupuestario as rps on dlb.id_reglon_presupuestario=rps.id_reglon_presupuestario where (dlb.id_reglon_presupuestario=4 or 
					dlb.id_reglon_presupuestario=5 )and dlb.id_viceministerio = 3";
					$query5b = "select count (dlb.id_asesor)   from tb_datos_laborales as dlb inner join tbl_viceministerio as vice on dlb.id_viceministerio = vice.id_viceministerio
					inner join tb_reglon_presupuestario as rps on dlb.id_reglon_presupuestario=rps.id_reglon_presupuestario where dlb.id_reglon_presupuestario=5
					and dlb.id_viceministerio = 3";
				$dob=mssql_query($queryb);
				$do1b=mssql_query($query2b);
				$do2b=mssql_query($query3b);
				$do3b=mssql_query($query4b);
				$do4b=mssql_query($query5b);
				
				
		
              while($vector = mssql_fetch_row($dob)){    $d=$vector[0];}
			  while($vector1 = mssql_fetch_row($do1b)){  $d1=$vector1[0];}
			  while($vector2 = mssql_fetch_row($do2b)){  $d2=$vector2[0];}
			  while($vector3 = mssql_fetch_row($do3b)){  $d3=$vector3[0];}
			  while($vector4 = mssql_fetch_row($do4b)){  $d4=$vector4[0];}
			  $b3=$d+$d1+$d2+$d3+$d4;

					// Viceministerio de Integración y Comercio Exterio reglones
					
					
					
					// Viceministerio de Integración y Comercio Exterio reglones
		      		 $queryc = "select count (dlb.id_asesor)   from tb_datos_laborales as dlb inner join tbl_viceministerio as vice on dlb.id_viceministerio = vice.id_viceministerio
					inner join tb_reglon_presupuestario as rps on dlb.id_reglon_presupuestario=rps.id_reglon_presupuestario where dlb.id_reglon_presupuestario=1
					and dlb.id_viceministerio = 4";
		             $query2c = "select count (dlb.id_asesor)   from tb_datos_laborales as dlb inner join tbl_viceministerio as vice on dlb.id_viceministerio = vice.id_viceministerio
					inner join tb_reglon_presupuestario as rps on dlb.id_reglon_presupuestario=rps.id_reglon_presupuestario where dlb.id_reglon_presupuestario=2
					and dlb.id_viceministerio = 4";
		             $query3c = "select count (dlb.id_asesor)   from tb_datos_laborales as dlb inner join tbl_viceministerio as vice on dlb.id_viceministerio = vice.id_viceministerio
					inner join tb_reglon_presupuestario as rps on dlb.id_reglon_presupuestario=rps.id_reglon_presupuestario where dlb.id_reglon_presupuestario=3
					and dlb.id_viceministerio = 4";
		            $query4c = "select count (dlb.id_asesor)   from tb_datos_laborales as dlb inner join tbl_viceministerio as vice on dlb.id_viceministerio = vice.id_viceministerio
					inner join tb_reglon_presupuestario as rps on dlb.id_reglon_presupuestario=rps.id_reglon_presupuestario where (dlb.id_reglon_presupuestario=4 or 
					dlb.id_reglon_presupuestario=5 )and dlb.id_viceministerio = 4";
					$query5c = "select count (dlb.id_asesor)   from tb_datos_laborales as dlb inner join tbl_viceministerio as vice on dlb.id_viceministerio = vice.id_viceministerio
					inner join tb_reglon_presupuestario as rps on dlb.id_reglon_presupuestario=rps.id_reglon_presupuestario where dlb.id_reglon_presupuestario=5
					and dlb.id_viceministerio = 4";
				$doc=mssql_query($queryc);
				$do1c=mssql_query($query2c);
				$do2c=mssql_query($query3c);
				$do3c=mssql_query($query4c);
				$do4c=mssql_query($query5c);
				
				
		
              while($vector = mssql_fetch_row($doc)){    $e=$vector[0];}
			  while($vector1 = mssql_fetch_row($do1c)){  $e1=$vector1[0];}
			  while($vector2 = mssql_fetch_row($do2c)){  $e2=$vector2[0];}
			  while($vector3 = mssql_fetch_row($do3c)){  $e3=$vector3[0];}
			  while($vector4 = mssql_fetch_row($do4c)){  $e4=$vector4[0];}
			  $b4=$e+$e1+$e2+$e3+$e4;

					// Viceministerio de Integración y Comercio Exterio reglones
					
					
					
					// Viceministerio de Integración y Comercio Exterio reglones
		      		 $queryd = "select count (dlb.id_asesor)   from tb_datos_laborales as dlb inner join tbl_viceministerio as vice on dlb.id_viceministerio = vice.id_viceministerio
					inner join tb_reglon_presupuestario as rps on dlb.id_reglon_presupuestario=rps.id_reglon_presupuestario where dlb.id_reglon_presupuestario=1
					and dlb.id_viceministerio = 6";
		             $query2d = "select count (dlb.id_asesor)   from tb_datos_laborales as dlb inner join tbl_viceministerio as vice on dlb.id_viceministerio = vice.id_viceministerio
					inner join tb_reglon_presupuestario as rps on dlb.id_reglon_presupuestario=rps.id_reglon_presupuestario where dlb.id_reglon_presupuestario=2
					and dlb.id_viceministerio = 6";
		             $query3d = "select count (dlb.id_asesor)   from tb_datos_laborales as dlb inner join tbl_viceministerio as vice on dlb.id_viceministerio = vice.id_viceministerio
					inner join tb_reglon_presupuestario as rps on dlb.id_reglon_presupuestario=rps.id_reglon_presupuestario where dlb.id_reglon_presupuestario=3
					and dlb.id_viceministerio = 6";
		            $query4d = "select count (dlb.id_asesor)   from tb_datos_laborales as dlb inner join tbl_viceministerio as vice on dlb.id_viceministerio = vice.id_viceministerio
					inner join tb_reglon_presupuestario as rps on dlb.id_reglon_presupuestario=rps.id_reglon_presupuestario where (dlb.id_reglon_presupuestario=4 or 
					dlb.id_reglon_presupuestario=5 )and dlb.id_viceministerio = 6";
					$query5d = "select count (dlb.id_asesor)   from tb_datos_laborales as dlb inner join tbl_viceministerio as vice on dlb.id_viceministerio = vice.id_viceministerio
					inner join tb_reglon_presupuestario as rps on dlb.id_reglon_presupuestario=rps.id_reglon_presupuestario where dlb.id_reglon_presupuestario=5
					and dlb.id_viceministerio = 6";
				$dod=mssql_query($queryd);
				$do1d=mssql_query($query2d);
				$do2d=mssql_query($query3d);
				$do3d=mssql_query($query4d);
				$do4d=mssql_query($query5d);
				
				
		
              while($vector = mssql_fetch_row($dod)){    $f=$vector[0];}
			  while($vector1 = mssql_fetch_row($do1d)){  $f1=$vector1[0];}
			  while($vector2 = mssql_fetch_row($do2d)){  $f2=$vector2[0];}
			  while($vector3 = mssql_fetch_row($do3d)){  $f3=$vector3[0];}
			  while($vector4 = mssql_fetch_row($do4d)){  $f4=$vector4[0];}
			  $b5=$f+$f1+$f2+$f3+$f4;

					// Viceministerio de Integración y Comercio Exterio reglones
					
					
	 		
		}



				
								
				
?>


		<tr align="center " class="boxBgStone">
          <td><strong>1</strong></td>
          
          <td width="369"><strong>Viceministerio de Integración y Comercio Exterior</strong></td>
          <td width="296"><?  echo $a ?> </td>
          <td width="444"><?  echo $a1 ?> </td>
          <td width="444"><?  echo $a2 ?> </td>
          <td width="444"><?  echo $a3 ?> </td>
          <td width="444"><?  echo $a4 ?> </td>
          <td width="444"><?  echo $b ?> </td>
		</tr>
		
		
		<tr align="center " class="boxBgWhite">
          <td><strong>2</strong></td>
          
          <td width="369"><strong>Viceministerio Adminstrativo y Financiero</strong></td>
          <td width="296"><?  echo $c ?> </td>
          <td width="444"><?  echo $c1 ?> </td>
          <td width="444"><?  echo $c2 ?> </td>
          <td width="444"><?  echo $c3 ?> </td>
          <td width="444"><?  echo $c4 ?> </td>
          <td width="444"><?  echo $b2 ?> </td>
		</tr>
		
		<tr align="center " class="boxBgStone">
          <td><strong>3</strong></td>
          
          <td width="369"><strong>Viceministerio de la Micro, Peque�a y Mediana Empresa</strong></td>
          <td width="296"><?  echo $d ?> </td>
          <td width="444"><?  echo $d1 ?> </td>
          <td width="444"><?  echo $d2 ?> </td>
          <td width="444"><?  echo $d3 ?> </td>
          <td width="444"><?  echo $d4 ?> </td>
          <td width="444"><?  echo $b3 ?> </td>
		</tr>
		
		
		<tr align="center " class="boxBgWhite">
          <td><strong>4</strong></td>
          
          <td width="369"><strong>Viceministerio Adminstrativo y Financiero</strong></td>
          <td width="296"><?  echo $e ?> </td>
          <td width="444"><?  echo $e1 ?> </td>
          <td width="444"><?  echo $e2 ?> </td>
          <td width="444"><?  echo $e3 ?> </td>
          <td width="444"><?  echo $e4 ?> </td>
          <td width="444"><?  echo $b4 ?> </td>
		</tr>
		
		<tr align="center " class="boxBgStone">
          <td><strong>5</strong></td>
          
          <td width="369"><strong>Despacho superior</strong></td>
          <td width="296"><?  echo $f ?> </td>
          <td width="444"><?  echo $f1 ?> </td>
          <td width="444"><?  echo $f2 ?> </td>
          <td width="444"><?  echo $f3 ?> </td>
          <td width="444"><?  echo $f4 ?> </td>
          <td width="444"><?  echo $b5 ?> </td>
		</tr>
		
		
		<tr align="center " class="boxBgWhite">
          <td><strong></strong></td>
          
         
          <td width="369"><strong>TOTAL EMPLEADOS</strong></td>
          <td width="296"><?  echo $h=$a+$c+$d+$e+$f ?> </td>
          <td width="444"><?  echo $h1=$a1+$c1+$d1+$e1+$f1 ?> </td>
          <td width="444"><?  echo $h2=$a2+$c2+$d2+$e2+$f2 ?> </td>
          <td width="444"><?  echo $h3=$a3+$c3+$d3+$e3+$f3 ?> </td>
          <td width="444"><?  echo $h4=$a4+$c4+$d4+$e4+$f4 ?> </td>
          <td width="444"><?  echo $h5=$b+$b2+$b3+$b4+$b5?> </td>
		</tr>
		
      </tbody>
  </table>

  <p>&nbsp;</p>
</div>
<!-- /forum rules and admin links -->
<br />
			<div align="left"></div>
            
</body>

</html>
