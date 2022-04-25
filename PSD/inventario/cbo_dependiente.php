<?
require("../includes/funciones.php");
require("../includes/sqlcommand.inc");
require_once('../connection/helpdesk.php');
?> 
<?		
		if (isset($cbo)) //verifico si hay objeto seleccionado
		{			
			$qry_plantilla="SELECT c.codigo_campo, c.campo, c.codigo_tipo_campo, c.tb_origen, c.validar, c.texto_validacion, c.tipo_combo, 
							c.campo_origen, c.campo_llave, c.tamano, c.etiqueta, c.orden, c.tb_destino, c.campo_destino, c.combo_destino, c.combo_origen, 
							p.condicion
							FROM tb_campo c inner join tb_plantilla p
							on c.codigo_campo=p.codigo_campo
							where p.codigo_campo='$cbo'
							order by orden"; 													
			$res_qry_plantilla=$query($qry_plantilla);	
			conectardb($inventarioadmin);		
			$i=1;			
			while($row_qry_plantilla=$fetch_array($res_qry_plantilla))
			{							
				if ($row_qry_plantilla["codigo_tipo_campo"]==2)
				{
						$latabla=$row_qry_plantilla["tb_origen"];
						$campoorigen=$row_qry_plantilla["campo_origen"];
						$campollave=$row_qry_plantilla["campo_llave"];	
						$condicion=$row_qry_plantilla["condicion"];					
						$qry_cbo="SELECT * FROM $latabla where $condicion and $llave_origen='$Id' order by $campoorigen"; 																					
						$res_qry_cbo=$query($qry_cbo);							
					if ($row_qry_plantilla["tipo_combo"]==2)
					{	
						echo('<select name="'.$row_qry_plantilla["campo"].'">');
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
							echo('<select name="'.$row_qry_plantilla["campo"].'" id="'.$row_qry_plantilla["campo"].'" onChange="javascript:cargarCombo(\'cbo_dependiente.php?cbo='.$row_qry_plantilla["combo_destino"].'&llave_origen='.$campollave.'\', \''.$row_qry_plantilla["campo"].'\', \''.$nombre_div.'\')">');
							echo'<option value="0">--Seleccione--</option>';				
							while($row_qry_cbo=$fetch_array($res_qry_cbo))
							{
								echo'<option value="'.$row_qry_cbo["$campollave"].'">'.$row_qry_cbo["$campoorigen"].'</option>';
							}
							echo('</select>');	
						}	
						/*else							
						if (($row_qry_plantilla["tipo_combo"]==2) || ($row_qry_plantilla["tipo_combo"]==4))
						{														
							echo '<div id="'.$nombre_div.'">';
							echo '<select name="'.$row_qry_plantilla["campo"].'"  id="'.$row_qry_plantilla["campo"].'" disabled>';
							echo '</select>';
							echo '</div>';
						}*/
						$free_result($res_qry_cbo);					
				} // fin de cada combo.
				echo '</td></tr>';
			}	 //fin de creacion de campos.	
	}
	//$free_result($res_qry_plantilla);
?>