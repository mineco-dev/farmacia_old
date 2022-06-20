<?PHP
	require("../includes/funciones.php");
	require("../includes/sqlcommand.inc");
?>
<?PHP
if (isset($_REQUEST["txt_lote"]))
{	
	if ($_REQUEST["txt_lote"]!="")
	{	
		conectardb($almacen);
		$nuevo_lote=strtoupper($_REQUEST["txt_lote"]);	
		$qry_si_existe="select * from lotes_existencia where lote='$nuevo_lote'";
		$res_qry_si_existe=$query($qry_si_existe);	
		$existe=false;	
		while($row_medida=$fetch_array($res_qry_si_existe))
		{
			echo '<script language="javascript">alert("Este lote ya fué ingresado");</script>';
			$existe=true;
		}
		/* if ($existe==false)
		{	
			$qry_ultima_medida="select max(codigo_medida) as ultima_medida from cat_medida";
			$res_qry_ultima_medida=$query($qry_ultima_medida);				
			while($row_medida=$fetch_array($res_qry_ultima_medida))
			{
			$ultimo_codigo_medida=$row_medida["ultima_medida"]+1;
			}			
			$nombre_usuario=$_SESSION["user_name"];
			$qry_medida="INSERT INTO cat_medida(codigo_medida, unidad_medida, activo, usuario_creo, fecha_creado, codigo_bodega) 
							VALUES ('$ultimo_codigo_medida', '$nueva_medida',1,'$nombre_usuario', getdate(), '$bodega')";
			$query($qry_medida);
			if (isset($_REQUEST["txt_ref2"])) 			  
				header("Location: cat_producto.php"); 
		}  */
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
                <td height="25"><label for="txt_lote" class="tituloproducto">Ingres el lote</span>                  
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
				 	<label for="cant_existente" class="tituloproducto">Cantidad en existencia 
					 	<input type="number" name="cant_existente" id="cant_existente" required>
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
        <td><b onClick="expandcontent('aleg1')" style="cursor:hand; cursor:pointer"><span class="curriculo"><img src="../images/e05.gif" width="21" height="21"></span></b> <span class="defaultfieldname">Para realizar b&uacute;squedas puede pulsar sobre una de las letras encerradas entre [], o bien escriba el nombre o parte del mismo para realizar una b&uacute;squeda espec&iacute;fica.</span></td>
      </tr>
      <tr>
        <td>        <div align="left" class="Estilo1">
          <div align="right"><strong><strong>            [<a href="medida.php?in=A" alt="Muestra los registros que inician con A">A</a>] [<a href="medida.php?in=B">B</a>] [<a href="medida.php?in=C">C</a>] [<a href="medida.php?in=D">D</a>] [<a href="medida.php?in=E">E</a>] [<a href="medida.php?in=F">F</a>] [<a href="medida.php?in=G">G</a>] [<a href="medida.php?in=H">H</a>] [<a href="medida.php?in=I">I</a>] [<a href="medida.php?in=J">J</a>] [<a href="medida.php?in=K">K</a>] [<a href="medida.php?in=L">L</a>] [<a href="medida.php?in=M">M</a>] [<a href="medida.php?in=N">N</a>] [<a href="medida.php?in=O">O</a>] [<a href="medida.php?in=P">P</a>] [<a href="medida.php?in=Q">Q</a>] [<a href="medida.php?in=R">R</a>] [<a href="medida.php?in=S">S</a>] [<a href="medida.php?in=T">T</a>] [<a href="medida.php?in=U">U</a>] [<a href="medida.php?in=V">V</a>] [<a href="medida.php?in=W">W</a>] [<a href="medida.php?in=X">X</a>] [<a href="medida.php?in=Y">Y</a>] [<a href="medida.php?in=Z">Z</a>] <a href="medida.php?in=all">[TODO]</a>            
            <input name="txt_buscar" type="text" id="txt_buscar2" size="20">
            <input name="bt_buscar" onClick="Validar(this.form)" type="button" id="bt_buscar" value="Buscar">
          </strong></strong></div>
        </div></td>
      </tr>
    </table>
    <table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" id="table17">
      <tr align="center" bgcolor="#006699" class="thead">
        <td class="titulotabla">
			<span class="Estilo3 thead">
				<strong>Lotes existentes</strong>
			</span>
		</td>
		<td class="titulotabla">
			<span class="Estilo3 thead">
				<strong>fecha vencimineto</strong>
			</span>
		</td>
		<td class="titulotabla">
			<span class="Estilo3 thead">
				<strong>Cantidad ingresada</strong>
			</span>
		</td>
		<td class="titulotabla">
			<span class="Estilo3 thead">
				<strong>Existencia</strong>
			</span>
		</td>
        <td width="5%" colspan="-1" class="titulotabla">
			<span class="titulotabla">
				<strong>Editar</strong>
			</span>
		</td>
        <td width="6%" class="titulotabla">
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
						$consulta = "SELECT * FROM lotes_existencia where lote like '$inicial%'";
					else
						$consulta = "SELECT * FROM lotes_existencia order by lote";
					}
			else
			{
				$consulta = "SELECT * FROM lotes_existencia where lote like '%%' order by lote asc";
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
					$estado=$row["activo"];
					if ($estado==1)					
					echo '<tr class='.$clase.'>
							<td colspan="3">'.$row["lote"].'</td>
							<td>'.$row["fecha_vence"].'</td>
							<td>'.$row["ingreso"].'</td>
							<td>'.$row["existencia"].'</td>
							<td><center><a href="editar_lote.php?id='.$row["codigo_medida"].'"><img src="../images/iconos/ico_editar.png" width="27" height = "29" alt="Modificar información"></a></center></td>
							<td><center><a href="cambia_stat.php?id='.$row["codigo_medida"].'&stat=2&ref=3"><img src="../images/iconos/ico_activo.gif" alt="Activo"></a></center></td></tr>';					
					else
						echo '<tr class='.$clase.'><td>'.$row["lote"].'</td>
							  <td>'.$row["fecha_vence"].'</td>
							  <td>'.$row["ingreso"].'</td>
							  <td>'.$row["existencia"].'</td>
							  <td><center><a href="editar_lote.php?id='.$row["codigo_medida"].'"><img src="../images/iconos/ico_editar.png" width="27" height = "29" alt="Modificar información"></a></center></td>
							  <td><center><a href="cambia_stat.php?id='.$row["codigo_medida"].'&stat=1&ref=3"><img src="../images/iconos/ico_desactivado.gif" alt="Desactivado"></a></center></td></tr>';										
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
            
</body>

</html>
