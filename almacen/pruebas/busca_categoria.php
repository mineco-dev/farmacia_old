<?PHP
	require("../includes/funciones.php");
	require("../includes/sqlcommand.inc");
?>
<?PHP
	if (isset($_REQUEST["tipo"]))
	{
		//session_register("tipo");
		$_SESSION["tipo"]=$_REQUEST["tipo"];
		//session_register("posi");
		$_SESSION["posi"]=$_REQUEST["posi"];
		$tipo=$_REQUEST["tipo"];
		$posi=$_REQUEST["posi"];
	}
	else
	{
		$tipo=$_SESSION["tipo"];
		$posi=$_SESSION["posi"];
	}	
?>
<html>
<head>
<script type="text/javascript">

var peticion = false;

var  testPasado = false;

try {

  peticion = new XMLHttpRequest();

  } catch (trymicrosoft) {

  try {

  peticion = new ActiveXObject("Msxml2.XMLHTTP");

  } catch (othermicrosoft) {

  try {

  peticion = new ActiveXObject("Microsoft.XMLHTTP");

  } catch (failed) {

  peticion = false;

  }

  }

}

if (!peticion)

alert("ERROR AL INICIALIZAR!");



function cargarCombo (url, comboAnterior, element_id) {

    //Obtenemos el contenido del div

    //donde se cargaran los resultados

    var element =  document.getElementById(element_id);

    //Obtenemos el valor seleccionado del combo anterior

    var valordepende = document.getElementById(comboAnterior)

    var x = valordepende.value

    //construimos la url definitiva

    //pasando como parametro el valor seleccionado

    var fragment_url = url+'?Id='+x;

    element.innerHTML = '<img src="../images/loading.gif" />';

    //abrimos la url

    peticion.open("GET", fragment_url);

    peticion.onreadystatechange = function() {

        if (peticion.readyState == 4) {

//escribimos la respuesta

element.innerHTML = peticion.responseText;

        }

    }

   peticion.send(null);

}

</script>

<script language="JavaScript" type="text/javascript" src="../includes/ajax_request.js"></script>
<script type="text/javascript">
<!--
function obtenVal(op){
	
	var urlarg = '';
	if (op > 0)
	{
	    if (op == 1) urldestino = 'individual.php?';
	    if (op == 2) urldestino = 'representantemandatario.php?';
	    ajax_request(urldestino,'embebida',true);
	}
}
//-->
</script>

<script LANGUAGE="JavaScript">
function Validar(form)
{
  if (form.txt_buscar.value == "")
  { 
  	alert("Escriba el nombre o apellido del empleado para realizar la b�squeda"); 
	form.txt_buscar.focus(); 
	return;
 }  
  form.submit();
}
function Refrescar(form)
{
	form.reset();
	form.txt_buscar.focus(); 
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
          <div align="center">FORMULARIO PARA CATEGORIAS</div>
        </div></td>
      </tr>
      <tr>
        <td><center>
            </center></td>
      </tr>
      <tr>
        <td>        <div align="left" class="Estilo1">
          <div align="left">
            <p><strong><strong>            [<a href="busca_categoria.php?in=A" alt="Muestra los registros que inician con A">A</a>] [<a href="busca_categoria.php?in=B">B</a>] [<a href="busca_categoria.php?in=C">C</a>] [<a href="busca_categoria.php?in=D">D</a>] [<a href="busca_categoria.php?in=E">E</a>] [<a href="busca_categoria.php?in=F">F</a>] [<a href="busca_categoria.php?in=G">G</a>] [<a href="busca_categoria.php?in=H">H</a>] [<a href="busca_categoria.php?in=I">I</a>] [<a href="busca_categoria.php?in=J">J</a>] [<a href="busca_categoria.php?in=K">K</a>] [<a href="busca_categoria.php?in=L">L</a>] [<a href="busca_categoria.php?in=M">M</a>] [<a href="busca_categoria.php?in=N">N</a>] [<a href="busca_categoria.php?in=O">O</a>] [<a href="busca_categoria.php?in=P">P</a>] [<a href="busca_categoria.php?in=Q">Q</a>] [<a href="busca_categoria.php?in=R">R</a>] [<a href="busca_categoria.php?in=S">S</a>] [<a href="busca_categoria.php?in=T">T</a>] [<a href="busca_categoria.php?in=U">U</a>] [<a href="busca_categoria.php?in=V">V</a>] [<a href="busca_categoria.php?in=W">W</a>] [<a href="busca_categoria.php?in=X">X</a>] [<a href="busca_categoria.php?in=Y">Y</a>] [<a href="busca_categoria.php?in=Z">Z</a>] <a href="busca_categoria.php?in=all">[TODO]</a><BR></strong></strong><strong><strong>
              <input name="txt_buscar" type="text" id="txt_buscar2" size="30">
                <input name="bt_buscar" onClick="Validar(this.form)" type="button" id="bt_buscar" value="Buscar">
    (ESCRIBA NOMBRE, APELLIDO O DEPENDENCIA)</strong></strong></p>
            </div>
        </div></td>
      </tr>
    </table>
    <table class="tborder" cellpadding="0" cellspacing="1" border="0" width="100%" id="table17">
      <tr align="center" bgcolor="#006699" class="thead">
        <td width="9%" class="titulotabla"><div align="center"><strong>Seleccionar
        </strong></div></td>
        <td width="51%" class="titulotabla"><strong>Categoria</strong></td>
        <td width="40%" class="titulotabla">Codigo</td>
      </tr>
		<?PHP
				if ($_REQUEST["txt_buscar"]!="")
				{
				$busqueda=strtoupper($_REQUEST["txt_buscar"]);					
				$consulta = "select  codigo_categoria, categoria, activo from cat_categoria
							where (codigo_categoria like '%$busqueda%' or categoria like '%$busqueda%') and (activo=1)";

				}
				else	
				if (isset($_REQUEST["in"]))	
				{
					$inicial=$_REQUEST["in"];
					echo "Listado de categoria inicia con $inicial";
					if ($inicial!="all")
						$consulta = "select  codigo_categoria, categoria, activo from cat_categoria
									where categoria like '$inicial%' and activo=1";
							       
						else
							$consulta = "select  codigo_categoria, categoria, activo from cat_categoria
										where activo=1
							 			order by codigo_categoria, categoria";
				}
				else
				{
					$consulta =     "select  codigo_categoria, categoria, activo from cat_categoria
							     	where categoria like 'a%' and activo=1";
				}
				conectardb($almacen);
				$result=$query($consulta);
				$i = 0;				
				while($row=$fetch_array($result))
				{
					$completo=$row["codigo_categoria"];
					$clase = "detalletabla2";
					if ($i % 2 == 0) 
					{
						$clase = "detalletabla1";
					}
					
					echo '<tr class='.$clase.'>';
					echo "<td><a href=\"javascript:void(0)\" onClick=\"window.opener.document.getElementById('$tipo"."[".$posi."][2]').value = '$completo'; 
					window.opener.document.getElementById('$tipo"."[".$posi."][2]').value = '".$row["codigo_categoria"]."';
					window.close();
					window.opener.focus(); 
					return false;\"><center><img src=\"../images/iconos/ico_ir.gif\" border=\"0\" alt=\"Seleccionar esta categoria\"></a></center></td>";					
					echo '<td>'.$row["codigo_categoria"].'</td><td>'.$row["categoria"].'</td></tr>';										
					$i++;
				}				
				$free_result($result);				
			 ?>
    </table>
  </form>
  <p>&nbsp;</p>
</div>
</body>

</html>
