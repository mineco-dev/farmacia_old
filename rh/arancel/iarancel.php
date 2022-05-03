<html>
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<body>
<p>&nbsp;</p>


<style type="text/css">
<!--
.Estilo1 {color: #FFFFFF}
.Estilo2 {
	color: #993300;
	font-weight: bold;
	font-size: 20pt;
}
.style3 {color: #993300}
.style3 {
	font-family: "Courier New", Courier, mono;
	font-weight: bold;
}
.style8 {
		font-family: Verdana, Arial, Helvetica, sans-serif;
		font-size: 11px;
}
.style9 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
}
-->
</style>
<?
//  Autentificator
//  Gesti�n de Usuarios PHP+Mysql+sesiones
//  by Pedro Noves V. (Cluster)
//  clus@hotpop.com
// ------------------------------------------
		require("aut_verifica.inc.php");
		$nivel_acceso=10; // Nivel de acceso para esta p�gina.
// se chequea si el usuario tiene un nivel inferior
// al del nivel de acceso definido para esta p�gina.
// Si no es correcto, se mada a la p�gina que lo llamo con
// la variable de $error_login definida con el n� de error segun el array de
// aut_mensaje_error.inc.php
	if ($nivel_acceso <= $_SESSION['usuario_nivel']){
	header ("Location: $redir?error_login=5");
	exit;
}
?>
<?php 
   $centinela = 0;
   include("conex.php"); 
   $link=Conectarse(); 
   /*$codigo=$_GET['codigo'];*/  
   $id_recibo=$_GET['id_recibo'];       
   $oficina=$_GET['oficina'];       
   $lugar=$_GET['lugar'];    
   $consumidor=$_GET['consumidor'];    
   $importe=$_GET['importe'];    
   $fdia=$_GET['fdia'];
   $fmes=$_GET['fmes'];
   $fanio=$_GET['fanio'];
   $fecha=$fanio.'-'.$fmes.'-'.$fdia;   
   $fecha1=$fdia.'/'.$fmes.'/'.$fanio;   
   $usuario=$_SESSION['usuario_id'];    
   $id_regional=$_GET['id_regional'];   
   $cletras=$_GET['cletras'];    
   $cantidad=$_GET['cantidad'];   
   $id_rubro=$_GET['id_rubro'];   
   $deposito=$_GET['deposito'];   
   $id_recibo = trim($id_recibo);

	
	
   if (!($link=mysql_connect("localhost","",""))) 
   { 
      echo "Error conectando a la base de datos."; 
      exit(); 
   } 
   if (!mysql_select_db("diaco",$link)) 
   { 
      echo "Error seleccionando la base de datos."; 
      exit(); 
   }  		
   				
   	
	$prueba = mysql_query("select id_recibo from recibo where id_recibo = '$id_recibo'",$link);
	if ($prueba)
	{
		while ($array = mysql_fetch_row($prueba))
		{
			if ($array[0] == $id_recibo)
			{
				$centinela = 1;
			}
		}
	}
	
	
	
		if ($centinela == 0)
		{
        mysql_query("insert into recibo (id_recibo,oficina,fecha,lugar,consumidor,cletras,id_rubro,id_regional,usuario,deposito,fdia,fmes,fanio,importe,cantidad) values ('$id_recibo','$oficina','$fecha','$lugar','$consumidor','$cletras','$id_rubro','$id_regional','$usuario','$deposito','$fdia','$fmes','$fanio','$importe','$cantidad')",$link); 																																																	  																	   	     


		}else
		{
			echo" ";
			echo "    LOS DATOS NO HAN SIDO GRABADOS PORQUE YA EXISTEN Y PODRIAN GENERAR VALORES DUPLICADOS ";
		}						
    


$rubro = mysql_query("select descripcion from rubro r, recibo re where r.id_rubro = re.id_rubro and re.id_recibo = '$id_recibo'",$link);
if ($rubro)
{
	$vector = mysql_fetch_row($rubro);
}

mysql_close($link);  

?>
<table width="462" align="center">
  <tr>
    <td height="47">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="12" height="20"><span class="style8"> &nbsp;</span></td>
    <td width="232"><span class="style9"><? print $oficina; ?></span></td>
    <td width="202"><span class="style8"><? print $id_recibo; ?></span></td>
  </tr>
  <tr>
    <td height="20">&nbsp;</td>
    <td><span class="style9"><? print $lugar; ?></span></td>
    <td><span class="style9"><? print $fecha1; ?></span></td>
  </tr>
  <tr>
    <td height="20">&nbsp;</td>
    <td><span class="style9"><? print $consumidor; ?></span></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="20">&nbsp;</td>
    <td><span class="style9"><? print $vector[0]; ?></span></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="22">&nbsp;</td>
    <td><span class="style9"><? print $cantidad; ?></span></td>
    <td><span class="style8"></span></td>
  </tr>
  <tr>
    <td height="33"><span class="style8"></span></td>
    <td>&nbsp;</td>
    <td><span class="style8"><? print $importe; ?></span></td>
  </tr>
  <tr>
    <td height="27">&nbsp;</td>
    <td><span class="style9"><? print $cletras; ?></span></td>
    <td><span class="style8"></span></td>
  </tr>
  <tr>
    <td height="37"><span class="style8"></span></td>
    <td>&nbsp;</td>
    <td><span class="style8"></span></td>
  </tr>
</table>
  <p>&nbsp;</p>
  <p>&nbsp;	</p>
  <blockquote>
  <blockquote>
    <blockquote>
      <blockquote>
        <blockquote>
          <blockquote>
            <blockquote>
              <blockquote>
                <blockquote>
                  <blockquote>
                    <blockquote>
                      <blockquote>
                        <blockquote>
                          <blockquote>
                            <blockquote>
                              <blockquote>
                                <blockquote>
                                  <p class="style9"></p>
                                  <p>&nbsp;</p>
                                  <p>&nbsp;</p>
                                  <p class="style3">&nbsp;</p>
                                </blockquote>
                              </blockquote>
                            </blockquote>
                          </blockquote>
                        </blockquote>
                      </blockquote>
                    </blockquote>
                  </blockquote>
                </blockquote>
              </blockquote>
            </blockquote>
          </blockquote>
        </blockquote>
      </blockquote>
    </blockquote>
  </blockquote>
</blockquote>
</body>
</html>

