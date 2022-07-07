<?PHP
	require("../includes/funciones.php");
	require("../includes/sqlcommand.inc");
	/* ni_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL); */ 
 
	$posi=$_REQUEST['posi'];
	$tipo=$_REQUEST['tipo'];
	$tipox=$_REQUEST['tipox'];
	$cat=$_REQUEST['cat'];
	$subcat=$_REQUEST['subcat'];
	$codprod=$_REQUEST['codp'];
	
?>
<?PHP
if (isset($_REQUEST["txt_lote"]))
{	
	if ($_REQUEST["txt_lote"]!="")
	{	
		conectardb($almacen);
		$nuevo_lote=strtoupper($_REQUEST["txt_lote"]);	
		$qry_si_existe="select * from lotes_existencia where lote='$nuevo_lote' and codigo_bodega=8";
		$res_qry_si_existe=$query($qry_si_existe);	
		$existe=false;	
		while($row_medida=$fetch_array($res_qry_si_existe))
		{
			echo '<script language="javascript">alert("Este lote ya fué ingresado");</script>';
			$existe=true;
		}
		if ($existe==false)
		{	
			$fecha_vence=($_REQUEST["f_vence"]);
			$cant_ingreso=($_REQUEST["cant_ingreso"]);
			
			$fecha_ingreso=($_REQUEST["f_ingreso"]);
			$lote=($_REQUEST["txt_lote"]);

			/* $qry_ultimo_lote="select max(rowid) as ultimo_lote from lotes_existencia";		
			$res_qry_ultimo_lote=$query($qry_ultimo_lote);				
			while($row_lote=$fetch_array($res_qry_ultimo_lote))
			{
				$ultimo_codigo_lote=$row_lote["ultimo_lote"]+1;
			}	 */			
			//$nombre_usuario=$_SESSION["user_name"];
			$qry_lote="INSERT INTO lotes_existencia(codigo_bodega, codigo_categoria, codigo_subcategoria, codigo_producto, fecha_vence, ingreso,  fecha_ingreso, estado, lote ) 
							VALUES (8,$cat,$subcat,$codprod,'$fecha_vence',$cant_ingreso,'$fecha_ingreso',1, '$lote')";
			$query($qry_lote);
			/* echo("<hr>");
			echo($qry_lote);
			echo("<hr>"); */
			
			if (isset($_REQUEST["txt_ref2"])) 			  
				header("Location: LoteIngreso.php"); 
		} 
	}
}
?>
<html>
<head>

<script type="text/javascript">
/***********************************************
* Contractible Headers script- � Dynamic Drive (www.dynamicdrive.com)
* This notice must stay intact for legal use. Last updated Mar 23rd, 2004.
* Visit http://www.dynamicdrive.com/ for full source code
***********************************************/

var enablepersist="on" //Enable saving state of content structure using session cookies? (on/off)
var collapseprevious="no" //Collapse previously open content when opening present? (yes/no)

if (document.getElementById){
document.write('<style type="text/css">')
document.write('.switchcontent{display:none;}')
document.write('</style>')
}

function getElementbyClass(classname){
ccollect=new Array()
var inc=0
var alltags=document.all? document.all : document.getElementsByTagName("*")
for (i=0; i<alltags.length; i++){
if (alltags[i].className==classname)
ccollect[inc++]=alltags[i]
}
}

function contractcontent(omit){
var inc=0
while (ccollect[inc]){
if (ccollect[inc].id!=omit)
ccollect[inc].style.display="none"
inc++
}
}

function expandcontent(cid){
if (typeof ccollect!="undefined"){
if (collapseprevious=="yes")
contractcontent(cid)
document.getElementById(cid).style.display=(document.getElementById(cid).style.display!="block")? "block" : "none"
}
}

function revivecontent(){
contractcontent("omitnothing")
selectedItem=getselectedItem()
selectedComponents=selectedItem.split("|")
for (i=0; i<selectedComponents.length-1; i++)
document.getElementById(selectedComponents[i]).style.display="block"
}

function get_cookie(Name) { 
var search = Name + "="
var returnvalue = "";
if (document.cookie.length > 0) {
offset = document.cookie.indexOf(search)
if (offset != -1) { 
offset += search.length
end = document.cookie.indexOf(";", offset);
if (end == -1) end = document.cookie.length;
returnvalue=unescape(document.cookie.substring(offset, end))
}
}
return returnvalue;
}

function getselectedItem(){
if (get_cookie(window.location.pathname) != ""){
selectedItem=get_cookie(window.location.pathname)
return selectedItem
}
else
return ""
}

function saveswitchstate(){
var inc=0, selectedItem=""
while (ccollect[inc]){
if (ccollect[inc].style.display=="block")
selectedItem+=ccollect[inc].id+"|"
inc++
}

document.cookie=window.location.pathname+"="+selectedItem
}

function do_onload(){
uniqueidn=window.location.pathname+"firsttimeload"
getElementbyClass("switchcontent")
if (enablepersist=="on" && typeof ccollect!="undefined"){
document.cookie=(get_cookie(uniqueidn)=="")? uniqueidn+"=1" : uniqueidn+"=0" 
firsttimeload=(get_cookie(uniqueidn)==1)? 1 : 0 //check if this is 1st page load
if (!firsttimeload)
revivecontent()
}
}


if (window.addEventListener)
window.addEventListener("load", do_onload, false)
else if (window.attachEvent)
window.attachEvent("onload", do_onload)
else if (document.getElementById)
window.onload=do_onload

if (enablepersist=="on" && document.getElementById)
window.onunload=saveswitchstate

</script>

<script LANGUAGE="JavaScript">
function Validar(form)
{
  if (form.txt_lote.value == "" && form.txt_buscar.value == "")
  { 
  	alert("Escriba el lote que deseado"); 
	form.txt_medida.focus(); 
	return;
 }
  form.submit();
}
function Refrescar(form)
{
	form.reset();
	form.txt_medida.focus(); 
}
</script>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script language="JavaScript" type="text/javascript" src="../includes/ajax_request.js"></script>  


<link href="../helpdesk.css" rel="stylesheet" type="text/css">

<meta http-equiv="Content-Type" content="text/html"; charset="windows-1252">
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<style type="text/css">
<!--
.Estilo1 {font-size: 12px}
.Estilo3 {color: #FFFFFF}
-->
</style>
</head>

<body>

<div align="left">
  <form name="form1" method="post" action="">
    <table width="100%" border="0" bordercolor="#ECE9D8">
      <tr>
        <td><div align="left" class="titulocategoria">
          <div align="center">INGRESO DE NUEVOS LOTES </div>
        </div></td>
      </tr>
      <tr>
        <td><img src="../images/e05.gif" width="21" height="21"> <span class="defaultfieldname">Para ingresar un nuevo lote al catálogo </span><b onClick="expandcontent('medida')" style="cursor:hand; cursor:pointer"> [Haga clic aqu&iacute;] </B><span class="defaultfieldname">por favor aseg&uacute;rese que  no exista, realizando previamente una b&uacute;squeda. </span></td>
      </tr>
      <tr>
        <td><center>
		<div id="medida" class="switchcontent">
            <table width="100%" border="0" cellspacing="5">
              <tr>
                <td height="8"><img src="../images/linea.gif" width="100%" height="6"></td>
              </tr>
              <tr>
                <td height="25"><label for="txt_lote" class="tituloproducto">Ingrese el lote</span>                  
				<input name="txt_lote" type="text" id="txt_lote" value="" size="25">				
				<?PHP 
				  	if (isset($_REQUEST["ref"]))
				  {
				  ?>
				  	<input name="txt_ref2" type="hidden" id="txt_ref2" value="<?PHP echo $_REQUEST["ref"]; ?>">
				  <?PHP
				  }
				  ?>
                 
                </td>			
            
			  </tr>
			  <tr>
				  <td>
				 	<label for="f_vence" class="tituloproducto">Fecha Vencimiento
					 <input type="date" name="f_vence" id="f_vence" required></label> 
				  </td>
			  </tr>
			  <tr>
				  <td>
				 	<label for="cant_ingreso" class="tituloproducto">Cantidad ingresada
					 <input type="number" name="cant_ingreso" id="cant_ingreso" required>
					 </label> 
				  </td>
			  </tr>
				  
			  <tr>
				  <td>
				 	<label for="f_ingreso" class="tituloproducto">Fecha de ingreso
					 	<input type="date" name="f_ingreso" id="f_ingreso" required>
					</label>
				  </td>
			  </tr>
			  <tr>
				  <td> 
				  	<span class="tituloproducto">
					  <input name="bt_guardar" onClick="Validar(this.form)" type="button" id="bt_guardar" value="Guardar" style="align='center'">
				  	</span>
				  </td>
			  </tr>
            </table>
		</div>
        </center></td>
      </tr>
      <tr>
        <td><img src="../images/linea.gif" width="100%" height="6"></td>
      </tr>
      <tr>
        <td><b onClick="expandcontent('aleg1')" style="cursor:hand; cursor:pointer"><span class="curriculo"><img src="../images/e05.gif" width="21" height="21"></span></b> <span class="defaultfieldname">Para realizar una b&uacute;squeda puede escribir el nombre del lote, o parte del mismo, para realizar una b&uacute;squeda espec&iacute;fica.</span></td>
      </tr>
      <tr>
        <td>        
			<div align="left" class="Estilo1">
          		<div align="right">
			  		<strong>
					  	<!--<a href="LoteIngreso.php?in=all">[TODO]</a>-->            
            			<input name="txt_buscar" type="text" id="txt_buscar2" size="20">
            			<input name="bt_buscar" onClick="Validar(this.form)" type="button" id="bt_buscar" value="Buscar">
          			</strong>
		  		</div>
        	</div>
		</td>
      </tr>
    </table>
    <table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" id="table17">
      <tr align="center" bgcolor="#006699" class="thead">
	  	<td width="10%"class="titulotabla">
			<span class="Estilo3 thead">
				<strong>Seleccionar</strong>
			</span>
		</td>
        <td width="20%"class="titulotabla">
			<span class="Estilo3 thead">
				<strong>Lotes</strong>
			</span>
		</td>
		<td width="20%" class="titulotabla">
			<span class="Estilo3 thead">
				<strong>fecha vencimineto</strong>
			</span>
		</td>
		<td width="15%" class="titulotabla">
			<span class="Estilo3 thead">
				<strong>Cantidad ingresada</strong>
			</span>
		</td>
		
        <td width="10%" class="titulotabla">
			<span class="titulotabla">
				<strong>Editar</strong>
			</span>
		</td>
        <td width="10%" class="titulotabla">
			<span>
				<strong>Estado</strong>
			</span>
				
		</td>
      </tr>
		<?PHP
		
			if ($_REQUEST["txt_buscar"]!="")
				{
					$busqueda=strtoupper($_REQUEST["txt_buscar"]);					
					$consulta = "SELECT * FROM lotes_existencia where lote like '%$busqueda%'";					
				}
			else	
				if (isset($_REQUEST["in"]))	
				{
					$inicial=$_REQUEST["in"];
					if ($inicial!="all")
					{
						$consulta = "SELECT * FROM lotes_existencia where lote like '$inicial%'";
					}
					else
					{
						$consulta = "SELECT * FROM lotes_existencia where codigo_categoria ='$cat' and codigo_subcategoria='$subcat' and codigo_producto='$codprod' order by fecha_vence";
						echo("<hr>");
						echo($consulta);
						echo("<hr>");
					}
				}
				else
				{
					$consulta = "SELECT * FROM lotes_existencia where lote like '%%' and codigo_categoria ='$cat' and codigo_subcategoria='$subcat' and codigo_producto='$codprod' order by fecha_vence asc";
					/* echo("<hr>");
					echo($consulta);
					echo("<hr>"); */
				}
				conectardb($almacen);
				$result=$query($consulta);
				$i = 0;				
				while($row=$fetch_array($result))
				{
					$clase = "detalletabla2";
					if ($i % 2 == 0) 
					{
						$clase = "detalletabla1";
					}
					$estado=$row["estado"];
					if ($estado==1)					
					echo '<tr class='.$clase.'>
							<td class="boton_x"><center><img src="../images/iconos/ico_ir.gif"></center></td>
							<td>'.$row["lote"].'</td>
							<td>'.$row["fecha_vence"].'</td>
							<td>'.$row["ingreso"].'</td>
							
							<td><center><a href="editar_lote.php?id='.$row["rowid"].'"><img src="../images/iconos/ico_editar.png" width="27" height = "29" alt="Modificar información"></a></center></td>
							<td><center><a href="cambia_stat.php?id='.$row["rowid"].'&stat=2&ref=3"><img src="../images/iconos/ico_activo.gif" alt="Activo"></a></center></td></tr>';					
					else
						echo '<tr class='.$clase.'>
						<td class="boton_x"><center><img src=\"../images/iconos/ico_ir.gif\" border=\"0\" alt=\"Seleccionar esta categoria\"></center></td>
							  <td>'.$row["lote"].'</td>
							  <td>'.$row["fecha_vence"].'</td>
							  <td>'.$row["ingreso"].'</td>
							
							  <td><center><a href="editar_lote.php?id='.$row["rowid"].'"><img src="../images/iconos/ico_editar.png" width="27" height = "29" alt="Modificar información"></a></center></td>
							  <td><center><a href="cambia_stat.php?id='.$row["rowid"].'&stat=1&ref=3"><img src="../images/iconos/ico_desactivado.gif" alt="Desactivado"></a></center></td></tr>';										
					$i++;
				}
				$free_result($result);
			 ?>
      <tr><td width="42%"></tbody>
    </table>
  </form>
  <p>&nbsp;</p>
</div>
<!-- /forum rules and admin links -->
<br />
			<div align="left"></div>


<script type="text/javascript">   
	window.onload = function(){
        $(".boton_x").click(function(){
            var valores2= new Array();
            $(this).parents("tr").find("td").each(function(){
                valores2.push($(this).html())
            });

			var posi = '<?php echo $posi; ?>';
			var tipo = '<?php echo $tipo; ?>';
			var tipox = '<?php echo $tipox; ?>';
			

			window.opener.document.getElementById(tipox+"["+posi+"][1]").value = valores2[1];
			window.opener.document.getElementById(tipox+"["+posi+"][2]").value = valores2[2];
			window.opener.document.getElementById(tipox+"["+posi+"][3]").value = valores2[3];
			window.opener.document.getElementById(tipox+"["+posi+"][11]").value = valores2[1];
			window.opener.document.getElementById(tipox+"["+posi+"][21]").value = valores2[2];
			window.opener.document.getElementById(tipox+"["+posi+"][31]").value = valores2[3];

			window.close();
			window.opener.focus();

        });
	};


</script>
  
</body>

</html>
