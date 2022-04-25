<?	
//$grupo_id=4;
//include("../restringir.php");	
require('../../connection/helpdesk.php'); 

?><head>
	<script LANGUAGE="JavaScript">
	function Validar(form)
	{
	  if (form.cadenatexto.value == "")
	  { 
		alert("Escriba una breve descripción"); 
		form.cadenatexto.focus(); 
		return;
	  }
	  form.submit();
	}
	function Refrescar(form)
	{
		form.reset();
		form.cadenatexto.focus(); 
	}
	</script>
</head>
 ="center">	CONTRATOS	</p>
<form action="gcrear_publicacion.php" method="post" enctype="multipart/form-data"> 
    <table width="681" border="0">
      <tr>
        <td height="39">Contrato</td>
        <td>
          <input type="text" name="contrato" id="contrato" value="<? echo ?>" />        </td>
      </tr>
      <tr>
        <td height="39">Rengl&oacute;n</td>
        <td><label>
          <input type="text" name="renglon" id="renglon" />
        </label></td>
      </tr>
      <tr>
        <td height="39">Dependencia</td>
        <td><label>
          <input type="text" name="dependencia" id="dependencia" />
        </label></td>
      </tr>
      <tr><!--
        <td height="39">Dependencia:</td>
        <td><?php /*?><?
					require_once('../connection/helpdesk.php'); 
					$query="SELECT * FROM dependencia ORDER BY nombre_dependencia";
					$result=mssql_query($query);	
					echo('<select name="cbo_dependencia">');
					$nombre=":: Seleccione ::";
					echo'<option value="0">'.$nombre.'</option>';
					while($row=mssql_fetch_array($result))
					{
						echo'<option value="'.$row["codigo_dependencia"].'">'.$row["nombre_dependencia"].'</option>';
					}
					echo('</select>');					
				?><?php */?></td>-->
      </tr>
      <tr>
        <td height="39">Nombre</td>
        <td><label>
          <input type="text" name="nombre" id="nombre" />
        </label></td>
      </tr>
      <tr>
        <td width="144" height="105">Descripci&oacute;n:</td>
        <td width="527"><textarea name="cadenatexto" cols="50" rows="4" id="cadenatexto"></textarea></td>
      </tr>
      
      <tr>
       <!-- <td>D&iacute;as de vigencia?</td>
        <td><select name="cbo_vigencia" size="1" id="cbo_vigencia">
          <option value="700" selected>NO CADUCA</option>
          <option value="1">1 DIA</option>
          <option value="2">2 DIAS</option>
          <option value="3">3 DIAS</option>
          <option value="4">4 DIAS</option>
          <option value="5">5 DIAS</option>
          <option value="10">10 DIAS</option>
          <option value="15">15 DIAS</option>
          <option value="20">20 DIAS</option>
          <option value="25">25 DIAS</option>
          <option value="30">30 DIAS</option>
        </select></td>-->
      </tr>
      <tr>
        <td>Archivo:</td>
        <td><input name="userfile" type="file">
        <input type="hidden" name="MAX_FILE_SIZE" value="100000"></td>
      </tr>
    </table>
  <p>        <input type="button" value="Publicar" onClick="Validar(this.form)"> 
  </p>
</form> 
