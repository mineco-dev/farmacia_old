<?
	require("../includes/funciones.php");
	require("../includes/sqlcommand.inc");
?>
<?
if (isset($_REQUEST["txt_subcategoria"]))
{	
	if ($_REQUEST["txt_subcategoria"]!="")
	{	
		conectardb($almacen);
		$nueva_subcategoria=strtoupper($_REQUEST["txt_subcategoria"]);	
		$categoria=$_REQUEST["cbo_categoria"];	
		$subcategoria=$_REQUEST["txt_subcategoria"];	
		$qry_si_existe="select * from cat_subcategoria where subcategoria='$nueva_subcategoria' or (codigo_categoria_mineco=$categoria and codigo_subcategoria_mineco=$subcategoria)";
		$res_qry_si_existe=$query($qry_si_existe);	
		$existe=false;	
		while($row_subcategoria=$fetch_array($res_qry_si_existe))
		{
			echo "esta subcategoria ya esta ingresada";
			$existe=true;
		}
		if ($existe==false)
		{	
			$nombre_usuario=$_SESSION["user_name"];			
			$qry_subcategoria="INSERT INTO cat_subcategoria(subcategoria, codigo_categoria_mineco, codigo_subcategoria_mineco, activo, usuario_creo, fecha_creado) 
							VALUES ('$nueva_subcategoria',$categoria, $subcategoria, 1,'$nombre_usuario', getdate())";
			$query($qry_subcategoria);
			if (isset($_REQUEST["txt_ref"])) 
				header("Location: cat_producto.php"); 
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
  if (form.txt_subcategoria.value == "" && form.txt_buscar.value == "")
  { 
  	alert("Escriba el nombre de la subcategor�a"); 
	form.txt_subcategoria.focus(); 
	return;
 }
   if (form.cbo_categoria.value == "0" && form.txt_subcategoria.value != "")
  { 
  	alert("Seleccione la categoria a la que pertenece"); 
	form.cbo_categoria.focus(); 
	return;
 }
  form.submit();
}
function Refrescar(form)
{
	form.reset();
	form.txt_subcategoria.focus(); 
}
</script>
<link href="../helpdesk.css" rel="stylesheet" type="text/css">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
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
          <div align="center">INGRESO DE NUEVAS SUB-CATEGORIAS</div>
        </div></td>
      </tr>
      <tr>
        <td><img src="../images/e05.gif" width="21" height="21"> <span class="defaultfieldname">Para ingresar una nueva subcategor&iacute;a de productos </span><b onClick="expandcontent('subcategoria')" style="cursor:hand; cursor:pointer"> [Haga clic aqu&iacute;] </B><span class="defaultfieldname">por favor aseg&uacute;rese que  no exista, realizando previamente una b&uacute;squeda. </span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><center>
		<div id="subcategoria" class="switchcontent">
            <table width="95%"  border="1" cellpadding="0" cellspacing="0">
              <tr>			  
                <td><table width="100%" border="0" cellspacing="0">
                  <tr>
                    <td height="8" colspan="2"><img src="../images/linea.gif" width="100%" height="6"></td>
                  </tr>
                  <tr>
                    <td width="36%" height="25"><span class="tituloproducto">Ingrese la nueva subcategor&iacute;a:</span> </td>
                    <td width="64%"><input name="txt_subcategoria" type="text" id="txt_categoria3" value="" size="50"></td>
                  </tr>
                  <tr>
                    <td height="27"><span class="tituloproducto">Codigo de subcategoria: </span></td>
                    <td height="27" valign="bottom"><input name="txt_subcategoria" type="text" id="txt_subcategoria"></td>
                  </tr>
                  <tr>
                    <td height="27"><span class="tituloproducto">A que categor&iacute;a pertenece: </span></td>
                    <td height="27" valign="bottom"><span class="tituloproducto">
                      <?
				  	conectardb($almacen);
					$qry_categoria="SELECT * FROM cat_categoria WHERE activo=1 ORDER BY categoria";										
					$res_qry_categoria=$query($qry_categoria);	
					echo('<select name="cbo_categoria">');
					$nombre=":: Seleccione ::";
					//echo'<option value="0">'.$nombre.'</option>';
					while($row_categoria=$fetch_array($res_qry_categoria))
					{
						echo'<option value="'.$row_categoria["codigo_categoria"].'">'.$row_categoria["categoria"].'</option>';
					}
					echo('</select>');				
					$free_result($res_qry_categoria);
				?>
                      <? 
				  	if (isset($_REQUEST["ref"]))
				  {
				  ?>
                      <input name="txt_ref" type="hidden" id="txt_ref" value="<? echo $_REQUEST["ref"]; ?>">
                      <?
				  }
				  ?>
                    </span></td>
                  </tr>
                  <tr>
                    <td height="8" colspan="2"><span class="tituloproducto"> </span>
                        <div align="left"><span class="tituloproducto"><img src="../images/linea.gif" width="100%" height="6"> </span></div></td>
                  </tr>
                </table></td>
              </tr>			 
            </table>
		</div>	
            </center></td>
      </tr>
      <tr>
        <td><span class="tituloproducto">
          <input name="bt_guardar" onClick="Validar(this.form)" type="button" id="bt_guardar4" value="Guardar">
        </span></td>
      </tr>
      <tr>
        <td>        <div align="left" class="Estilo1">
          <div align="right"><strong><strong>            [<a href="subcategoria.php?in=A" alt="Muestra los registros que inician con A">A</a>] [<a href="subcategoria.php?in=B">B</a>] [<a href="subcategoria.php?in=C">C</a>] [<a href="subcategoria.php?in=D">D</a>] [<a href="subcategoria.php?in=E">E</a>] [<a href="subcategoria.php?in=F">F</a>] [<a href="subcategoria.php?in=G">G</a>] [<a href="subcategoria.php?in=H">H</a>] [<a href="subcategoria.php?in=I">I</a>] [<a href="subcategoria.php?in=J">J</a>] [<a href="subcategoria.php?in=K">K</a>] [<a href="subcategoria.php?in=L">L</a>] [<a href="subcategoria.php?in=M">M</a>] [<a href="subcategoria.php?in=N">N</a>] [<a href="subcategoria.php?in=O">O</a>] [<a href="subcategoria.php?in=P">P</a>] [<a href="subcategoria.php?in=Q">Q</a>] [<a href="subcategoria.php?in=R">R</a>] [<a href="subcategoria.php?in=S">S</a>] [<a href="subcategoria.php?in=T">T</a>] [<a href="subcategoria.php?in=U">U</a>] [<a href="subcategoria.php?in=V">V</a>] [<a href="subcategoria.php?in=W">W</a>] [<a href="subcategoria.php?in=X">X</a>] [<a href="subcategoria.php?in=Y">Y</a>] [<a href="subcategoria.php?in=Z">Z</a>] <a href="subcategoria.php?in=all">[TODO]</a>            
            <input name="txt_buscar" type="text" id="txt_buscar2" size="20">
            <input name="bt_buscar" onClick="Validar(this.form)" type="button" id="bt_buscar" value="Buscar">
          </strong></strong></div>
        </div></td>
      </tr>
    </table>
    <table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" id="table17">
      <tr align="center" bgcolor="#006699" class="thead">
        <td width="42%" class="titulotabla"><strong>Sub-categor&iacute;as previamente ingresadas</strong><span class="Estilo3 thead"><strong></strong></span>        <div align="right"><strong>
              <strong>              </strong>
        </strong></div></td>
        <td class="titulotabla">Categor&iacute;a a la que pertenece </td>
        <td width="5%" colspan="-1" class="thead Estilo3"><span class="titulotabla"><strong>Editar</strong></span></td>
        <td width="6%" class="titulotabla"><strong>Estado</strong></td>
      </tr>
		<?
				if ($_REQUEST["txt_buscar"]!="")
				{
				$busqueda=strtoupper($_REQUEST["txt_buscar"]);					
				$consulta = "SELECT c.categoria, s.subcategoria, s.activo, s.codigo_subcategoria FROM cat_subcategoria s
						     inner join cat_categoria c on c.codigo_categoria=s.codigo_categoria_mineco
							 where subcategoria like '%$busqueda%'";					
				}
				else	
				if (isset($_REQUEST["in"]))	
				{
					$inicial=$_REQUEST["in"];
					if ($inicial!="all")
						$consulta = "SELECT c.categoria, s.subcategoria, s.activo, s.codigo_subcategoria FROM cat_subcategoria s
						     		 inner join cat_categoria c on c.codigo_categoria=s.codigo_categoria_mineco
							         where subcategoria like '$inicial%'";
						else
							$consulta = "SELECT c.categoria, s.subcategoria, s.activo, s.codigo_subcategoria FROM cat_subcategoria s
						     			inner join cat_categoria c on c.codigo_categoria=s.codigo_categoria_mineco
							 			order by subcategoria";
				}
				else
				{
					$consulta = "SELECT c.categoria, s.subcategoria, s.activo, s.codigo_subcategoria FROM cat_subcategoria s
						         inner join cat_categoria c on c.codigo_categoria=s.codigo_categoria_mineco
							     where subcategoria like 'A%'";
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
					echo '<tr class='.$clase.'><td>'.$row["subcategoria"].'</td><td>'.$row["categoria"].'</td><td><center><a href="editar_subcategoria.php?id='.$row["codigo_subcategoria"].'"><img src="../images/iconos/ico_editar.jpg" alt="Modificar información"></a></center></td><td><center><a href="cambia_stat.php?id='.$row["codigo_subcategoria"].'&stat=2&ref=2"><img src="../images/iconos/ico_activo.gif" alt="Activo"></a></center></td></tr>';					
					else
						echo '<tr class='.$clase.'><td>'.$row["subcategoria"].'</td><td>'.$row["categoria"].'</td><td><center><a href="editar_subcategoria.php?id='.$row["codigo_subcategoria"].'"><img src="../images/iconos/ico_editar.jpg" alt="Modificar información"></a></center></td><td><center><a href="cambia_stat.php?id='.$row["codigo_subcategoria"].'&stat=1&ref=2"><img src="../images/iconos/ico_desactivado.gif" alt="Desactivado"></a></center></td></tr>';										
					$i++;
				}
				$free_result($result);
			 ?>
    </table>
  </form>
  <p>
    <!-- /forum rules and admin links -->
  </p>
</div>
<div align="left"></div>
            
</body>

</html>
