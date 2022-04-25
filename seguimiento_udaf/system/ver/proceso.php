<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<script src="SpryAssets2/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="SpryAssets2/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="100%%" border="0" align="center">
  <tr>
    <td>
    <div id="TabbedPanels12" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup">
    <li class="TabbedPanelsTab" tabindex="0">Todo</li>
    <li class="TabbedPanelsTab" tabindex="0">Traslados</li>
<!--    <li class="TabbedPanelsTab" tabindex="0">Materiales</li>
    <li class="TabbedPanelsTab" tabindex="0">Cobros</li>-->
    <li class="TabbedPanelsTab" tabindex="0">Observaciones</li>
    <li class="TabbedPanelsTab" tabindex="0">Adjuntos</li>
   <!-- <li class="TabbedPanelsTab" tabindex="0">Respuesta</li>-->
  </ul>
  <div class="TabbedPanelsContentGroup">
    <div class="TabbedPanelsContent">
      <strong>Traslados</strong>
      <?
				$vec[0] = "Fecha";
				$vec[1] = "Hora";
				$vec[2] = "Usuario Envia";
				$vec[3] = "Usuario Recibe";
				$vec[4] = "Descripcion";
			
				$vec2[0] = "fecha";
				$vec2[1] = "hora";
				$vec2[2] = "usuario1";
				$vec2[3] = "usuario2";
				$vec2[4] = "descripcion";
			
				$vec3[0] = "width=\"10%\"";
				$vec3[1] = "width=\"10%\"";
				$vec3[2] = "width=\"20%\"";
				$vec3[3] = "width=\"20%\"";
				$vec3[4] = "width=\"40%\"";
			
				$query ="select CONVERT(nvarchar(10), t.fechahora, 103) as fecha,
								CONVERT(nvarchar(10), t.fechahora, 108) as hora, 
								u1.nombres+' '+u1.apellidos as usuario1,
								u2.nombres+' '+u2.apellidos as usuario2,
								t.descripcion
						 from
							helpdesk.dbo.btraslado t,
							helpdesk.dbo.usuario u1,
							helpdesk.dbo.usuario u2
						 where 
						 	t.idusuario1 = u1.codigo_usuario and 
						 	t.idusuario2 = u2.codigo_usuario and 
							t.id_documento = '$id_documento'
						 order by t.fechahora desc";		 
				getTabla($query,5,$vec,$vec2,$vec3,$dbms,95,"","","");
			?>
    <br>
   <?php /*?> <strong>Materiales</strong>
    <?
				$vec[0] = "Fecha";
				$vec[1] = "Hora";
				$vec[2] = "Usuario";
				$vec[3] = "Cantidad";
				$vec[4] = "Tipo";
				$vec[5] = "Descripcion";
			
				$vec2[0] = "fecha";
				$vec2[1] = "hora";
				$vec2[2] = "nombreusuario";
				$vec2[3] = "cantidad";
				$vec2[4] = "tipomaterial";
				$vec2[5] = "descripcion";
				$vec2[6] = "idmaterialentregado";
			
				$vec3[0] = "width=\"10%\"";
				$vec3[1] = "width=\"10%\"";
				$vec3[2] = "width=\"20%\"";
				$vec3[3] = "width=\"10%\"";
				$vec3[4] = "width=\"10%\"";
				$vec3[5] = "width=\"40%\"";
			
				$query ="select CONVERT(nvarchar(10), m.fechahora, 103) as fecha,
								CONVERT(nvarchar(10), m.fechahora, 108) as hora, 
								u.nombres+' '+u.apellidos as nombreusuario,
								m.cantidad, 
								tm.descripcion as tipomaterial,
								m.descripcion, idmaterialentregado, m.idusuario
						 from
							informacion.dbo.tbl_tipomaterial tm, 
							informacion.dbo.tbl_materialentregado m,
							helpdesk.dbo.usuario u
						 where 
						 	m.idusuario = u.codigo_usuario and 
							tm.idtipomaterial = m.idtipomaterial and
							m.idsolicitud = $idsolicitud and
							m.activo = 1 
						 order by m.fechahora desc";		 
						 
				getTabla_valida($query,6,$vec,$vec2,$vec3,$dbms,95,"","../solicitud/borrar.php?tbl_=materialentregado&cmp_=materialentregado&idreg=","","idusuario",$_SESSION['user_id']);
			?>
    <br>
    <strong>Cobros</strong>
      <?
				$vec[0] = "Fecha";
				$vec[1] = "Hora";
				$vec[2] = "Usuario";
				$vec[3] = "Valor";
				$vec[4] = "Forma";
				$vec[5] = "Descripcion";
			
				$vec2[0] = "fecha";
				$vec2[1] = "hora";
				$vec2[2] = "nombreusuario";
				$vec2[3] = "valor";
				$vec2[4] = "tipocobro";
				$vec2[5] = "descripcion";
				$vec2[6] = "idcobro";
			
				$vec3[0] = "width=\"10%\"";
				$vec3[1] = "width=\"10%\"";
				$vec3[2] = "width=\"20%\"";
				$vec3[3] = "width=\"10%\"";
				$vec3[4] = "width=\"10%\"";
				$vec3[5] = "width=\"40%\"";
			
				$nombreusuario = $_SESSION['user_name'];
				
				$query ="select CONVERT(nvarchar(10), c.fechahora, 103) as fecha,
								CONVERT(nvarchar(10), c.fechahora, 108) as hora, 
								u.nombres+' '+u.apellidos as nombreusuario,
								c.valor, 
								tc.nombre as tipocobro,
								c.descripcion,c.idcobro,c.idusuario
						 from
							informacion.dbo.tbl_tipocobro tc, informacion.dbo.tbl_cobro c,
							helpdesk.dbo.usuario u
						 where 
						 	c.idusuario = u.codigo_usuario and 
							tc.idtipocobro = c.idtipocobro and
							c.idsolicitud = $idsolicitud and
							c.activo = 1 
						 order by c.fechahora desc";
				getTabla_valida($query,6,$vec,$vec2,$vec3,$dbms,95,"","../solicitud/borrar.php?tbl_=cobro&cmp_=cobro&idreg=","","idusuario",$_SESSION['user_id']);
			?><?php */?>
    <br>
    <strong>Observaciones</strong>
      <?
				$vec[0] = "Fecha";
				$vec[1] = "Hora";
				$vec[2] = "Usuario";
				$vec[3] = "Observaciones";
			
				$vec2[0] = "fecha";
				$vec2[1] = "hora";
				$vec2[2] = "nombreusuario";
				$vec2[3] = "descripcion";
				$vec2[4] = "id_seguimiento";
			
				$vec3[0] = "width=\"10%\"";
				$vec3[1] = "width=\"10%\"";
				$vec3[2] = "width=\"20%\"";
				$vec3[3] = "width=\"60%\"";
			
				$nombreusuario = $_SESSION['user_name'];
				
				$query ="select CONVERT(nvarchar(10), m.fechahora, 103) as fecha,
							CONVERT(nvarchar(10), m.fechahora, 108) as hora, 
							u.nombres+' '+u.apellidos as nombreusuario,
							m.descripcion , m.id_usuario
							from
							helpdesk.dbo.bseguimiento m, 
							helpdesk.dbo.usuario u
						where 
						m.id_usuario = u.codigo_usuario and 
						m.id_documento = $id_documento
						order by m.fechahora desc";
				getTabla_valida($query,4,$vec,$vec2,$vec3,$dbms,95,"","../solicitud/borrar.php?tbl_=seguimiento&cmp_=seguimiento&idreg=","","idusuario",$_SESSION['user_id']);
				
			?>
    <br>
    <strong>Adjuntos</strong>
    <?
				$vec[0] = "Fecha";
				$vec[1] = "Hora";
				$vec[2] = "Usuario";
				$vec[3] = "Archivo";
				$vec[4] = "Descripcion";
			
				$vec2[0] = "fecha";
				$vec2[1] = "hora";
				$vec2[2] = "nombreusuario";
				$vec2[3] = "original";
				$vec2[4] = "descripcion";
				$vec2[5] = "url";
				$vec2[6] = "idarchivo";
			
				$vec3[0] = "width=\"10%\"";
				$vec3[1] = "width=\"10%\"";
				$vec3[2] = "width=\"20%\"";
				$vec3[3] = "width=\"20%\"";
				$vec3[4] = "width=\"40%\"";
			
				$nombreusuario = $_SESSION['user_name'];
				
				$query ="select CONVERT(nvarchar(10), a.fechahora, 103) as fecha,
								CONVERT(nvarchar(10), a.fechahora, 108) as hora, 
								u.nombres+' '+u.apellidos as nombreusuario,
								a.original original, 
								a.descripcion, 
								a.url url,a.id_archivo,a.id_usuario
						 from
							helpdesk.dbo.barchivos a, helpdesk.dbo.usuario u
						 where 
							a.id_usuario = u.codigo_usuario and 
							a.id_documento = $id_documento and
							a.activo = 1 
						 order by a.fechahora desc";

				getTablaArchivo_valida($query,5,$vec,$vec2,$vec3,$dbms,95,"","../solicitud/borrar.php?tbl_=archivo&cmp_=archivo&idreg=","si","idusuario",$_SESSION['user_id']);
				
			?>
    <br>
<!--   <strong>//Respuesta</strong>-->
  <?
//				$vec[0] = "Fecha ingreso";
//				$vec[1] = "Hora ingreso";
//				$vec[2] = "Fecha finalizada";
//				$vec[3] = "Hora finalizada";
//				$vec[4] = "Forma de Entrega";
//				$vec[5] = "Tipo de entrega";
//				$vec[6] = "idrespuesta";
//			
//				$vec2[0] = "fecha";
//				$vec2[1] = "hora";
//				$vec2[2] = "fecha2";
//				$vec2[3] = "hora2";
//				$vec2[4] = "forma";
//				$vec2[5] = "tiporespuesta";
//				$vec2[6] = "idrespuesta";
//			
//				$vec3[0] = "width=\"10%\"";
//				$vec3[1] = "width=\"10%\"";
//				$vec3[2] = "width=\"10%\"";
//				$vec3[3] = "width=\"10%\"";
//				$vec3[4] = "width=\"30%\"";
//				$vec3[5] = "width=\"30%\"";
////				$vec3[6] = "width=\"30%\"";
//			
//				$nombreusuario = $_SESSION['user_name'];
//				
//				$query ="select CONVERT(nvarchar(10), s.fechahora, 103) as fecha,
//								CONVERT(nvarchar(10), s.fechahora, 108) as hora, 
//								CONVERT(nvarchar(10), r.fechahora, 103) as fecha2,
//								CONVERT(nvarchar(10), r.fechahora, 108) as hora2, 
//								f.nombre as forma,
//								tr.nombre as tiporespuesta,
//								r.idrespuesta,r.idusuario
//						 from
//							informacion.dbo.tbl_respuesta r, 
//							informacion.dbo.tbl_formaentrega f, 
//							informacion.dbo.tbl_solicitud s, 
//							informacion.dbo.tbl_tiporespuesta tr
//						 where 
//							r.idsolicitud = s.idsolicitud and 
//							r.idtiporespuesta = tr.idtiporespuesta and 
//							r.idforma = f.idforma and 
//							r.idrespuesta = 
//								(select 
//									max(idrespuesta) 
//								from tbl_respuesta rr 
//								where rr.idsolicitud = $idsolicitud) and 
//							s.idsolicitud = $idsolicitud and
//							r.activo = 1 
//						 ";
//				getTablaResolucion_valida($query,6,$vec,$vec2,$vec3,$dbms,95,"","../solicitud/borrar.php?tbl_=respuesta&cmp_=respuesta&idreg=","si","idusuario",$_SESSION['user_id']);
//
//			?>
    </div>
    <p><span class="TabbedPanelsContent">
      <?
				$vec[0] = "Fecha";
				$vec[1] = "Hora";
				$vec[2] = "Usuario Envia";
				$vec[3] = "Usuario Recibe";
				$vec[4] = "Descripcion";
			
				$vec2[0] = "fecha";
				$vec2[1] = "hora";
				$vec2[2] = "usuario1";
				$vec2[3] = "usuario2";
				$vec2[4] = "descripcion";
			
				$vec3[0] = "width=\"10%\"";
				$vec3[1] = "width=\"10%\"";
				$vec3[2] = "width=\"20%\"";
				$vec3[3] = "width=\"20%\"";
				$vec3[4] = "width=\"40%\"";
			
				$query ="select CONVERT(nvarchar(10), t.fechahora, 103) as fecha,
								CONVERT(nvarchar(10), t.fechahora, 108) as hora, 
								u1.nombres+' '+u1.apellidos as usuario1,
								u2.nombres+' '+u2.apellidos as usuario2,
								t.descripcion
						 from
							helpdesk.dbo.btraslado t,
							helpdesk.dbo.usuario u1,
							helpdesk.dbo.usuario u2
						 where 
						 	t.idusuario1 = u1.codigo_usuario and 
						 	t.idusuario2 = u2.codigo_usuario and 
							t.id_documento = '$id_documento'
						 order by t.fechahora desc";		 
				getTabla($query,5,$vec,$vec2,$vec3,$dbms,95,"","","");
			?>
    </span>
    <div class="TabbedPanelsContent">
      <?
				$vec[0] = "Fecha";
				$vec[1] = "Hora";
				$vec[2] = "Usuario";
				$vec[3] = "Descripcion";
			
				$vec2[0] = "fecha";
				$vec2[1] = "hora";
				$vec2[2] = "nombreusuario";
				$vec2[3] = "descripcion";

			
				$vec3[0] = "width=\"10%\"";
				$vec3[1] = "width=\"10%\"";
				$vec3[2] = "width=\"20%\"";
				$vec3[3] = "width=\"50%\"";				
			
				$query ="select CONVERT(nvarchar(10), m.fechahora, 103) as fecha,
	CONVERT(nvarchar(10), m.fechahora, 108) as hora, 
	u.nombres+' '+u.apellidos as nombreusuario,
	m.descripcion , m.id_usuario
from
	helpdesk.dbo.bseguimiento m, 
	helpdesk.dbo.usuario u
	where 
	m.id_usuario = u.codigo_usuario and 
	m.id_documento = $id_documento
	order by m.fechahora desc";		 
						 
				getTabla_valida($query,4,$vec,$vec2,$vec3,$dbms,95,"","../solicitud/borrar.php?tbl_=materialentregado&cmp_=materialentregado&idreg=","","idusuario",$_SESSION['user_id']);
			?>
    </div>
    <div class="TabbedPanelsContent">
      <?
				$vec[0] = "Fecha";
				$vec[1] = "Hora";
				$vec[2] = "Usuario";
				$vec[3] = "Descripcion";

			
				$vec2[0] = "fecha";
				$vec2[1] = "hora";
				$vec2[2] = "nombreusuario";
				$vec2[3] = "Descripcion";

			
				$vec3[0] = "width=\"10%\"";
				$vec3[1] = "width=\"10%\"";
				$vec3[2] = "width=\"20%\"";
				$vec3[3] = "width=\"10%\"";
				$vec3[4] = "width=\"10%\"";
				$vec3[5] = "width=\"40%\"";
			
				$nombreusuario = $_SESSION['user_name'];
				
				$query ="select CONVERT(nvarchar(10), a.fechahora, 103) as fecha,
								CONVERT(nvarchar(10), a.fechahora, 108) as hora, 
								u.nombres+' '+u.apellidos as nombreusuario,
								a.original original, 
								a.descripcion, 
								a.url url,a.id_archivo,a.id_usuario
						 from
							helpdesk.dbo.barchivos a, helpdesk.dbo.usuario u
						 where 
							a.id_usuario = u.codigo_usuario and 
							a.id_documento = $id_documento and
							a.activo = 1 
						 order by a.fechahora desc";
				getTabla_valida($query,4,$vec,$vec2,$vec3,$dbms,95,"","../solicitud/borrar.php?tbl_=cobro&cmp_=cobro&idreg=","","idusuario",$_SESSION['user_id']);
			?>
    </div>
    <div class="TabbedPanelsContent">
      <?
				$vec[0] = "Fecha";
				$vec[1] = "Hora";
				$vec[2] = "Usuario";
				$vec[3] = "Observaciones";
			
				$vec2[0] = "fecha";
				$vec2[1] = "hora";
				$vec2[2] = "nombreusuario";
				$vec2[3] = "descripcion";
				$vec2[4] = "idseguimiento";
			
				$vec3[0] = "width=\"10%\"";
				$vec3[1] = "width=\"10%\"";
				$vec3[2] = "width=\"20%\"";
				$vec3[3] = "width=\"60%\"";
			
				$nombreusuario = $_SESSION['user_name'];
				
				$query ="select CONVERT(nvarchar(10), s.fechahora, 103) as fecha,
								CONVERT(nvarchar(10), s.fechahora, 108) as hora, 
								u.nombres+' '+u.apellidos as nombreusuario,
								s.descripcion,s.idseguimiento,s.idusuario
						 from
							informacion.dbo.tbl_seguimiento s,helpdesk.dbo.usuario u
						 where 
						 	s.idusuario = u.codigo_usuario and 
							s.idsolicitud = $idsolicitud and
							s.activo = 1 
						 order by s.fechahora desc";
				getTabla_valida($query,4,$vec,$vec2,$vec3,$dbms,95,"","../solicitud/borrar.php?tbl_=seguimiento&cmp_=seguimiento&idreg=","","idusuario",$_SESSION['user_id']);
				
			?>
    </div>
    <div class="TabbedPanelsContent">
      <?
				$vec[0] = "Fecha";
				$vec[1] = "Hora";
				$vec[2] = "Usuario";
				$vec[3] = "Archivo";
				$vec[4] = "Descripcion";
			
				$vec2[0] = "fecha";
				$vec2[1] = "hora";
				$vec2[2] = "nombreusuario";
				$vec2[3] = "original";
				$vec2[4] = "descripcion";
				$vec2[5] = "url";
				$vec2[6] = "idarchivo";
			
				$vec3[0] = "width=\"10%\"";
				$vec3[1] = "width=\"10%\"";
				$vec3[2] = "width=\"20%\"";
				$vec3[3] = "width=\"20%\"";
				$vec3[4] = "width=\"40%\"";
			
				$nombreusuario = $_SESSION['user_name'];
				
				$query ="select CONVERT(nvarchar(10), a.fechahora, 103) as fecha,
								CONVERT(nvarchar(10), a.fechahora, 108) as hora, 
								u.nombres+' '+u.apellidos as nombreusuario,
								a.original original, 
								a.descripcion, 
								a.url url,a.idarchivo,a.idusuario
						 from
							informacion.dbo.tbl_archivo a, helpdesk.dbo.usuario u
						 where 
							a.idusuario = u.codigo_usuario and 
							a.idsolicitud = $idsolicitud and
							a.activo = 1 
						 order by a.fechahora desc";

				getTablaArchivo_valida($query,5,$vec,$vec2,$vec3,$dbms,95,"","../solicitud/borrar.php?tbl_=archivo&cmp_=archivo&idreg=","si","idusuario",$_SESSION['user_id']);
				
			?>
    </div>
    <div class="TabbedPanelsContent">
      <?
				$vec[0] = "Fecha ingreso";
				$vec[1] = "Hora ingreso";
				$vec[2] = "Fecha finalizada";
				$vec[3] = "Hora finalizada";
				$vec[4] = "Forma de Entrega";
				$vec[5] = "Tipo de entrega";
				$vec[6] = "idrespuesta";
			
				$vec2[0] = "fecha";
				$vec2[1] = "hora";
				$vec2[2] = "fecha2";
				$vec2[3] = "hora2";
				$vec2[4] = "forma";
				$vec2[5] = "tiporespuesta";
				$vec2[6] = "idrespuesta";
			
				$vec3[0] = "width=\"10%\"";
				$vec3[1] = "width=\"10%\"";
				$vec3[2] = "width=\"10%\"";
				$vec3[3] = "width=\"10%\"";
				$vec3[4] = "width=\"30%\"";
				$vec3[5] = "width=\"30%\"";
//				$vec3[6] = "width=\"30%\"";
			
				$nombreusuario = $_SESSION['user_name'];
				
				$query ="select CONVERT(nvarchar(10), s.fechahora, 103) as fecha,
								CONVERT(nvarchar(10), s.fechahora, 108) as hora, 
								CONVERT(nvarchar(10), r.fechahora, 103) as fecha2,
								CONVERT(nvarchar(10), r.fechahora, 108) as hora2, 
								f.nombre as forma,
								tr.nombre as tiporespuesta,
								r.idrespuesta,r.idusuario
						 from
							informacion.dbo.tbl_respuesta r, 
							informacion.dbo.tbl_formaentrega f, 
							informacion.dbo.tbl_solicitud s, 
							informacion.dbo.tbl_tiporespuesta tr
						 where 
							r.idsolicitud = s.idsolicitud and 
							r.idtiporespuesta = tr.idtiporespuesta and 
							r.idforma = f.idforma and 
							r.idrespuesta = 
								(select 
									max(idrespuesta) 
								from tbl_respuesta rr 
								where rr.idsolicitud = $idsolicitud) and 
							s.idsolicitud = $idsolicitud and
							r.activo = 1 
						 ";
				getTablaResolucion_valida($query,6,$vec,$vec2,$vec3,$dbms,95,"","../solicitud/borrar.php?tbl_=respuesta&cmp_=respuesta&idreg=","si","idusuario",$_SESSION['user_id']);

			?>
    </div>
    <div class="TabbedPanelsContent">
      <?
				$vec[0] = "Fecha ingreso";
				$vec[1] = "Hora ingreso";
				$vec[2] = "Fecha finalizada";
				$vec[3] = "Hora finalizada";
				$vec[4] = "Forma de Entrega";
				$vec[5] = "Tipo de entrega";
				$vec[6] = "idrespuesta";
			
				$vec2[0] = "fecha";
				$vec2[1] = "hora";
				$vec2[2] = "fecha2";
				$vec2[3] = "hora2";
				$vec2[4] = "forma";
				$vec2[5] = "tiporespuesta";
				$vec2[6] = "idrespuesta";
			
				$vec3[0] = "width=\"10%\"";
				$vec3[1] = "width=\"10%\"";
				$vec3[2] = "width=\"10%\"";
				$vec3[3] = "width=\"10%\"";
				$vec3[4] = "width=\"30%\"";
				$vec3[5] = "width=\"30%\"";
//				$vec3[6] = "width=\"30%\"";
			
				$nombreusuario = $_SESSION['user_name'];
				
				$query ="select CONVERT(nvarchar(10), s.fechahora, 103) as fecha,
								CONVERT(nvarchar(10), s.fechahora, 108) as hora, 
								CONVERT(nvarchar(10), r.fechahora, 103) as fecha2,
								CONVERT(nvarchar(10), r.fechahora, 108) as hora2, 
								f.nombre as forma,
								tr.nombre as tiporespuesta,
								r.idrespuesta,r.idusuario
						 from
							informacion.dbo.tbl_respuesta r, 
							informacion.dbo.tbl_formaentrega f, 
							informacion.dbo.tbl_solicitud s, 
							informacion.dbo.tbl_tiporespuesta tr
						 where 
							r.idsolicitud = s.idsolicitud and 
							r.idtiporespuesta = tr.idtiporespuesta and 
							r.idforma = f.idforma and 
							r.idrespuesta = 
								(select 
									max(idrespuesta) 
								from tbl_respuesta rr 
								where rr.idsolicitud = $idsolicitud) and 
							s.idsolicitud = $idsolicitud and
							r.activo = 1 
						 ";
				getTablaResolucion_valida($query,6,$vec,$vec2,$vec3,$dbms,95,"","../solicitud/borrar.php?tbl_=respuesta&cmp_=respuesta&idreg=","si","idusuario",$_SESSION['user_id']);

			?>
    </div>
  </div>
</div>    </td>
  </tr>
</table>
<script type="text/javascript">
<!--
var TabbedPanels12 = new Spry.Widget.TabbedPanels("TabbedPanels12", {defaultTab:1});
//-->
</script>
</body>
</html>
