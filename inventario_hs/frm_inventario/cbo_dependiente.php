<?
require("../../includes/funciones.php");
require("../../includes/sqlcommand.inc");
?> 
<?						
		if (isset($cbo)) //verifico si hay objeto seleccionado
		{						
			$qry_plantilla="SELECT p.codigo_propiedad, p.propiedad, p.codigo_tipo_propiedad, p.tb_origen, p.validar, p.texto_validacion, 
							p.campo_origen, p.campo_llave, p.tamano, p.etiqueta, p.orden, p.tb_destino, p.campo_destino, p.combo_destino, p.combo_origen, p.tipo_combo, pl.condicion
						    FROM tb_propiedad p 
							inner join tb_plantilla pl on
							pl.codigo_propiedad=p.codigo_propiedad and pl.codigo_objeto=2
						    where p.codigo_propiedad='$cbo'
						    order by orden";					
	
			conectardb($inventarioopera);							
			$res_qry_plantilla=$query($qry_plantilla);				
			$i=1;			
			while($row_qry_plantilla=$fetch_array($res_qry_plantilla))
			{							
				if ($row_qry_plantilla["codigo_tipo_propiedad"]==2)
				{
						$latabla=$row_qry_plantilla["tb_origen"];
						$campoorigen=$row_qry_plantilla["campo_origen"];
						$campollave=$row_qry_plantilla["campo_llave"];	
						$condicion=$row_qry_plantilla["condicion"];					
						$qry_cbo="SELECT * FROM $latabla where $condicion and $llave_origen='$Id' order by $campoorigen";						
						//$qry_cbo="SELECT * FROM $latabla where $campollave='$Id' order by $campoorigen";																					
						
						$res_qry_cbo=$query($qry_cbo);							
					if ($row_qry_plantilla["tipo_combo"]==2)
					{	
						echo('<select name="'.$row_qry_plantilla["propiedad"].'">');
						echo'<option value="0">--Seleccione--</option>';				
						while($row_qry_cbo=$fetch_array($res_qry_cbo))
						{
							echo'<option value="'.$row_qry_cbo["$campollave"].'">'.$row_qry_cbo["$campoorigen"].'</option>';
						}
						echo('</select>');	
					}
					else
					if (($row_qry_plantilla["tipo_combo"]==3) || ($row_qry_plantilla["tipo_combo"]==4))
						{	
							$nombre_div=$row_qry_plantilla["combo_destino"];													
							echo('<select name="'.$row_qry_plantilla["propiedad"].'" id="'.$row_qry_plantilla["propiedad"].'" onChange="javascript:cargarCombo(\'cbo_dependiente.php?cbo='.$row_qry_plantilla["combo_destino"].'&llave_origen='.$campollave.'\', \''.$row_qry_plantilla["propiedad"].'\', \''.$nombre_div.'\')">');
							echo'<option value="0">--Seleccione--</option>';				
							while($row_qry_cbo=$fetch_array($res_qry_cbo))
							{
								echo'<option value="'.$row_qry_cbo["$campollave"].'">'.$row_qry_cbo["$campoorigen"].'</option>';
							}
							echo('</select>');	
						}							
						$free_result($res_qry_cbo);					
				} // fin de cada combo.
				echo '</td></tr>';
			}	 //fin de creacion de campos.	
	}
	//$free_result($res_qry_plantilla);
?>