<html>
<head>
<style type="text/css">
<!--
.Estilo2 {font-size: x-small}
-->
</style>
<script language="javascript" src="../../includes/calendar.js"></script>
</head>
<body>
<table width="100%" border=1 cellspacing="0" id="tabla7">
  <tr>
    <th scope="col"><span class="Estilo2">#</span></th>
    <th scope="col"><span class="Estilo2">Usuario responsable</span></th>
    <th scope="col"><span class="Estilo2">Dependencia</span></th>
    <th scope="col"><span class="Estilo2">Fecha operado </span></th>
    <th scope="col"><span class="Estilo2">Operado por</span></th>
  </tr>
  <? 
  $qry_responsable_det="select * from tb_inventario_responsable_det where codigo_inventario_enc='$id'";    
  $res_qry_responsable_det=$query($qry_responsable_det);  
  $registros_responsable=$num_rows($res_qry_responsable_det);
  $cnt_responsable=1;	   	   	  
  while($row_qry_responsable_det=$fetch_array($res_qry_responsable_det)) //devuelve los id de empleados que han sido responsables de este equipo
  {
	 $myuser=$_SESSION["param_conexion"]["$i"][1];
	  $responsable[$cnt_responsable]=$row_qry_responsable_det["codigo_usuario_responsable"];
	  $fecha_entrega[$cnt_responsable]=$row_qry_responsable_det["fecha_entrega"];
	  $creado_por[$cnt_responsable]=$row_qry_responsable_det["usuario_creo"];
	  $cnt_responsable++;	 
  }	   	   	  
  $cnt_responsable=1; 
  $qry_responsable_nombre_det="SELECT (a.apellido +' '+ a.apellido2 +' '+ a.apellidocasada +', '+ a.nombre +' '+ a.nombre2 +' '+ a.nombre3) as empleado, a.activo, a.idasesor, a.gafete,
                			d.nombre AS dependencia
							FROM asesor a INNER JOIN
                			direccion d ON a.iddireccion = d.iddireccion
							where idasesor in (";
  while ($cnt_responsable<=count($responsable))  //para concatenar los id de empleados, encontrados en el qry anterior
  {
	$qry_responsable_nombre_det.="$responsable[$cnt_responsable], ";	
    $cnt_responsable++;
  }
	$qry_responsable_nombre_det.="5000)";
	conectardb($rrhh);	
	$res_qry_responsable_nombre_det=$query($qry_responsable_nombre_det);
	$cnt_responsable=1;
  	while($row_qry_responsable_nombre_det=$fetch_array($res_qry_responsable_nombre_det))
   {
	  echo '<tr>';
	  echo '<td>&nbsp;</td>';  	  
	  ////////////////////////////////////////inicia despliegue de nombre de responsable  
	  echo '<td>';
	  echo $row_qry_responsable_nombre_det["empleado"];
	  echo '</td>'; 	  
	  ////////////////////////////////////////inicia despliegue de dependencia	 
	  echo '<td>';
	  echo $row_qry_responsable_nombre_det["dependencia"];
	  echo '</td>'; 	  
	  ////////////////////////////////////////inicia despliegue de fecha de entrega	 
	  echo '<td>';
	  echo $fecha_entrega[$cnt_responsable];
	  echo '</td>'; 	  
	  ////////////////////////////////////////inicia despliegue de tecnico que ingreso el objeto al sistema	 
	  echo '<td>';
	  echo $creado_por[$cnt_responsable];
	  echo '</td>'; 	  
	  echo '</tr>';
	  $cnt_responsable++;
  }
  ?>
  <!-- <tr>
    <th width="17" scope="col">&nbsp;</th>
	<input type="hidden" name="nombre[0][1]" id="hiddenField"/>    
    <th scope="col" colspan="3"><a href="javascript:void(0)" onclick="buscar=window.open('../../../../clinica/busca_persona.php?tipo=nombre&posi=0','Buscar','width=650,height=525,menubar=no,scrollbars=yes,toolbar=no,location=no,directories=no,resizable=no,top=100,left=250'); return false;"><input name="nombre[0][0]" type="text" id="textfield3" value="[CLIC AQUI PARA SELECCIONAR EL USUARIO]" size="30" disabled />
	</a>
	</th>
	<th scope="col"><? echo $_SESSION["user_name"]; ?></th>
  </tr> -->
</table>
<br>
</body>
</html>