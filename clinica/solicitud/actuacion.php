<?
	require('../includes/inc_header.inc');
	
	if ((intval($_REQUEST['Id'])==3) || (intval($_REQUEST['Id'])==4)) /* representante legal o mandatario */
	{
?>
<table width="100%" border="0">
  <tr>
    <td width="13%">Inscripcion No.</td>
    <td width="87%"><input type="text" name="inscripcion" id="inscripcion" /></td>
  </tr>
  <tr>
    <td>Folio</td>
    <td><input type="text" name="folio" id="Folio" /></td>
  </tr>
  <tr>
    <td>Libro</td>
    <td><input type="text" name="libro" id="libro" /></td>
  </tr>
  <tr>
    <td>Registro</td>
    <td><select name="registro"  id="registro">
      <? 
	$dbms=new DBMS($conexion);
	$dbms->bdd=$database_cnn;
	$dbms->sql="select 
					id_dominio_registral,descripcion 
				from 
					tb_dominio_registral 
				order by descripcion"; 
	$dbms->Query(); 
	while($Fields=$dbms->MoveNext()) 
	{
		print "<option value=\"".$Fields["id_dominio_registral"]."\">".$Fields["descripcion"]."</option>"; 
	}
?>
    </select></td>
  </tr>
</table>
<?
	}else
	{
	
	}

?>
