<?	
$grupo_id=9;
include("../restringir.php");	
?>
<head>
<link href="estilo.css" rel="stylesheet" type="text/css">
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
</head>
<body background="fondos/fondo.gif" style="background-attachment: fixed">
 <div align="center">
   <p><? include("../dependencia.php"); ?></p>
   <p align="left">Datos para el encabezado de la minuta </p>
   <form method="post" name="form1" action="minuta_det.php">
      <div align="left">
</div>
     <table width="100%" align="center" bordercolor="#FFFFFF" bgcolor="#FFFFFF" id="table3">
       <tr valign="baseline">
         <td width="20%" align="right" nowrap bgcolor="#C9CDED"><div align="left"><b>N&uacute;mero:</b></div></td>
         <td width="80%" bgcolor="#99CCFF"><input name="txt_numero" type="text" id="txt_numero" value="/<? echo date('Y'); ?>">
         </td>
       </tr>
       <tr valign="baseline">
         <td align="right" nowrap bgcolor="#C9CDED"><div align="left"><strong>Fecha de reuni&oacute;n :</strong></div></td>
         <td bgcolor="#99CCFF"><input name="txt_fecha" type="text" id="txt_fecha" value=" de <? echo date('Y'); ?>" size="54"></td>
       </tr>
       <tr valign="baseline">
         <td align="center" valign="middle" nowrap bordercolor="#FFFFFF" bgcolor="#C9CDED"><div align="left">
            <p><b>Asistentes: </b><b class="alt2"></b> </p>
         </div></td>
         <td bgcolor="#99CCFF">
		 <?
		 $comitegerencial="Lic. Joel Arriaza, Gerente; Lic. Cesar Augusto Alvarez, Subgerente Administrativo;";
		 $comitegerencial.=" Licda. Silvia Garcia, Unidad de Planificaci�n; Lic. Erick Gamboa, Subgerente Financiero;";
		 $comitegerencial.=" Licda. Z�mara Vel�squez, Subgerente de Recursos Humanos; Ing. Ervin Cano Romero, Subgerente de Inform�tica.";
		 
		 $comofi="Lic. Joel Arriaza, Gerente; Licda. Silvia Garcia, Unidad de Planificaci�n; Ing. Ervin Cano Romero, Subgerente de Inform�tica;";
		// $comofi.=" Lic. Carlos Rodriguez; Licda. Patricia Berganza; Licda. Pahola Fuentes."; 
?>
         <textarea name="txt_asistentes" cols="50" rows="5" id="txt_asistentes"><? if (isset($id)) echo $comofi; 
		 else echo $comitegerencial; ?>
		 </textarea></td>
       </tr>
       <tr valign="baseline">
         <td height="27" align="right" nowrap bgcolor="#C9CDED"><div align="left"><strong>&iquest;Incluir seguimiento? </strong></div></td>
         <td bgcolor="#99CCFF"><select name="cbo_seguimiento" size="1" id="cbo_seguimiento">
           <option value="2" selected>NO</option>
           <option value="1">SI</option>
         </select></td>
       </tr>
       <tr valign="baseline">
         <td height="27" align="right" nowrap bgcolor="#C9CDED">&nbsp;</td>
         <td bgcolor="#99CCFF"><input name="bt_enviar" type="submit" value="Continuar">
         <input name="txt_codigo_dependencia" type="hidden" id="txt_codigo_dependencia" value="<? echo $dependencia ?>"></td>
       </tr>
     </table>
   </form>
</div>
