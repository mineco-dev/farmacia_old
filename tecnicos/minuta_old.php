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
         <td width="20%" align="right" nowrap bgcolor="#CCFFCC"><div align="left"><b>N&uacute;mero:</b></div></td>
         <td width="80%" bgcolor="#99CCCC"><input name="txt_numero" type="text" id="txt_numero" value="/2007">
         </td>
       </tr>
       <tr valign="baseline">
         <td align="right" nowrap bgcolor="#CCFFCC"><div align="left"><strong>Fecha de reuni&oacute;n :</strong></div></td>
         <td bgcolor="#99CCCC"><input name="txt_fecha" type="text" id="txt_fecha" value=" de 2007" size="54"></td>
       </tr>
       <tr valign="baseline">
         <td align="center" valign="middle" nowrap bordercolor="#FFFFFF" bgcolor="#CCFFCC"><div align="left">
            <p><b>Asistentes: </b><b class="alt2"></b> </p>
         </div></td>
         <td bgcolor="#99CCCC">
         <textarea name="txt_asistentes" cols="50" rows="5" id="txt_asistentes">Lic. Oscar Andrade Elizondo, Gerente; Licda. Aura Marina Rios Estrada, Subgerente Administrativo; 
Licda. Silvia Garcia, Unidad de Planificaci�n; Lic. Carlos Och, Subgerente Financiero; Lic. Mario Bethancourt, Asesor;
Ing. Ervin Cano Romero, Subgerente de Inform�tica.</textarea>          </td>
       </tr>
       <tr valign="baseline">
         <td height="27" align="right" nowrap bgcolor="#CCFFCC"><div align="left"><strong>&iquest;Incluir seguimiento? </strong></div></td>
         <td bgcolor="#99CCCC"><select name="cbo_seguimiento" size="1" id="cbo_seguimiento">
           <option value="2" selected>NO</option>
           <option value="1">SI</option>
         </select></td>
       </tr>
       <tr valign="baseline">
         <td height="27" align="right" nowrap bgcolor="#CCFFCC">&nbsp;</td>
         <td bgcolor="#99CCCC"><input name="bt_enviar" type="submit" value="Continuar">
         <input name="txt_codigo_dependencia" type="hidden" id="txt_codigo_dependencia" value="<? echo $dependencia ?>"></td>
       </tr>
     </table>
   </form>
</div>
