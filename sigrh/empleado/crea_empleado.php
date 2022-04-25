<?
	require('../includes/cnn/inc_header.inc');
	$dbms=new DBMS(conectardb($rrhh));	
	$dbms->bdd=$database_cnn;
	require('../includes/funciones.php');
?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="TabbedPanels1" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup">
    <li class="TabbedPanelsTab" tabindex="0">Datos</li>
    <li class="TabbedPanelsTab" tabindex="0">Historial Trabajo</li>
    <li class="TabbedPanelsTab" tabindex="0">Documentos</li>
  </ul>
  <div class="TabbedPanelsContentGroup">
    <div class="TabbedPanelsContent">Datos del Empleado
      <form action="gcrea_empleado.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
        <table width="739" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="168">Nombre</td>
            <td width="286">Segundo Nombre</td>
            <td width="199">Tercer Nombre </td>
          </tr>
          <tr>
            <td><label>
              <input type="text" name="nombre" id="nombre" />
            </label></td>
            <td><input type="text" name="nombre2" id="nombre2" /></td>
            <td><input type="text" name="nombre3" id="nombre3" /></td>
          </tr>
          <tr>
            <td>Apellido</td>
            <td>Segundo Apellido </td>
            <td>Apellido Casada</td>
          </tr>
          <tr>
            <td><input type="text" name="apellido" id="apellido" /></td>
            <td><input type="text" name="apellido2" id="apellido2" /></td>
            <td><input type="text" name="apellido3" id="apellido3" /></td>
          </tr>
          <tr>
            <td>NIT</td>
            <td>DPI</td>
            <td>Padr&oacute;n Electoral</td>
          </tr>
          <tr>
            <td><input type="text" name="nit" id="nit" /></td>
            <td><input type="text" name="dpi" id="dpi" /></td>
            <td><input type="text" name="padron" id="padron" /></td>
          </tr>
          <tr>
            <td>IGSS</td>
            <td>C&eacute;dula</td>
            <td>Fecha Nacimiento</td>
          </tr>
          <tr>
            <td><input type="text" name="igss" id="igss" /></td>
            <td><table width="308" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="93">Departamento</td>
                <td width="71">Municipio</td>
                <td width="144">Registro</td>
              </tr>
              <tr>
                <td><select name="cbo_departamento" id="cbo_departamento">                
                </select></td>
                <td><select name="cbo_municipio" id="cbo_Municipio">                
                </select></td>
                <td><input type="text" name="registro" id="registro" /></td>
              </tr>
            </table></td>
            <td><table width="178" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="48">D&iacute;a</td>
                <td width="40">Mes</td>
                <td width="55">A&ntilde;o</td>
              </tr>
              <tr>
                <td><select name="cbo_dia" id="cbo_dia">
                <?	$i=1;  while ($i<=31) {  ?>
                    <option value="<? echo $i; ?>"><? echo $i; ?></option>
                    <?  $i++;  }?>
                </select></td>
                <td><select name="cbo_mes" id="cbo_mes">
                <? 	$i=1; 	 while ($i<=12){ ?>
                <option value="<? echo $i; ?>"><? echo $i; ?></option> <?  $i++;}?>
                </select></td>
                <td><select name="cbo_anio" id="cbo_anio">
                <? 	$i=1920; while ($i<=date('Y')) { ?>
                <option value="<? echo $i; ?>"><? echo $i; ?></option>
                <?  $i++;
	 }
	 
	?>
                </select></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td>Profesi&oacute;n</td>
            <td>Colegiado</td>
            <td>Estado Civil</td>
          </tr>
          <tr>
            <td><label>
             <select name="cbo_profesion"  id="cbo_profesion" >
             <?
                $query = "select codigo_profesion, profesion from tb_profesion order by profesion";
                $dbms->sql=$query;
                $dbms->Query();
                while($Fields=$dbms->MoveNext())
                {
                    print "<option value = ".$Fields["codigo_profesion"]. ">".$Fields["profesion"]."</option>";
                }
            ?>
              
            </select>
            </label></td>
            <td><input type="text" name="colegiado" id="colegiado" /></td>
            <td><select name="cbo_ecivil" id="cbo_ecivil">
             <?
                $query = "SELECT id_ecivil,estado  FROM tb_estado_civil";
                $dbms->sql=$query;
                $dbms->Query();
                while($Fields=$dbms->MoveNext())
                {
                    print "<option value = ".$Fields["id_ecivil"]. ">".$Fields["estado"]."</option>";
                }
            ?>
            </select></td>
          </tr>
          <tr>
            <td>G&eacute;nero</td>
            <td>Direcci&oacute;n</td>
            <td>Fotograf&iacute;a</td>
          </tr>
          <tr>
            <td><select name="cbo_genero" id="cbo_genero">
            <?
                $query = "select id_genero, genero from tb_genero";
                $dbms->sql=$query;
                $dbms->Query();
                while($Fields=$dbms->MoveNext())
                {
                    print "<option value = ".$Fields["id_genero"]. ">".$Fields["genero"]."</option>";
                }
            ?>
            </select></td>
            <td><label>
              <textarea name="direccion" id="direccion" cols="35" rows="3"></textarea>
            </label></td>
            <td><label>
              <input type="file" name="userfile" id="userfile" />
            </label></td>
          </tr>
          <tr>
            <td>Estado</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><select name="cbo_activo" id="cbo_activo">
           <option value="1" selected>Activo</option>
          <option value="0">No Activo</option>
            </select></td>
            <td><label>
              <input type="submit" name="enviar" id="enviar" value="Guardar" />
            </label></td>
            <td>&nbsp;</td>
          </tr>
        </table>
      </form>
    </div>
    <div class="TabbedPanelsContent">
      <p>Historial de Trabajo</p>
      <form id="form2" name="form2" method="post" action="">
      <table width="653" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="104">Rengl&oacute;n</td>
          <td width="453">Dependencia</td>
          <td width="96">&nbsp;</td>
        </tr>
        <tr>
          <td><label>
            <select name="renglon" id="renglon">
             <?
                $query = "SELECT id_renglon, renglon  FROM tb_renglon";
                $dbms->sql=$query;
                $dbms->Query();
                while($Fields=$dbms->MoveNext())
                {
                    print "<option value = ".$Fields["id_renglon"]. ">".$Fields["renglon"]."</option>";
                }
            ?>

            </select>
          </label></td>
          <td><select name="cbo_dependencia" id="cbo_dependencia">
            <?
                $query = "select codigo_dependencia, nombre_dependencia from dependencia order by nombre_dependencia";
                $dbms->sql=$query;
                $dbms->Query();
                while($Fields=$dbms->MoveNext())
                {
                    print "<option value = ".$Fields["codigo_dependencia"]. ">".$Fields["nombre_dependencia"]."</option>";
                }
            ?>
          </select></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
      </form>
      
      <p>&nbsp;</p>
    </div>
     <div class="TabbedPanelsContent">
      <p>Documentos</p>
      <form id="form2" name="form2" method="post" action="">
      <table width="653" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><label></label></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
      </form>
      
      <p>&nbsp;</p>
    </div>
  </div>
</div>
<script type="text/javascript">
<!--
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
//-->
</script>
</body>
</html>
