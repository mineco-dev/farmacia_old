<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"><!--Fecha Actual:1/22/2009 7:57:04 PM-->

 
	
		<script language="javascript">
			function popUp(url)
			{
				sealWin=window.open(url,'win','toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=0,resizable=0,width=400,height=130,top=70,left=100');
				self.name = 'mainWin';
			}
			function validar()
			{


				if (document.all.SWEPassword.value.length==0)	{
					alert('Debe informar la clave')
					return false
				}
				var objDoc = new ActiveXObject('Msxml.DOMDocument');

				objDoc.async=false;
				// ACH
				// Cambie el orden del chequeo, antes pedia primero el xml y si le daba ok (usuario y clave validos)
				// buscaba si era usuario habilitado de Siebel. Ahora valido primero que sea usuario habilitado
				// (tabla tbl_migracion_siebel) y despues que sea usuario y clave valido
				objDoc.load('loginBrokers/UsuarioLiberadoSiebel.asp?SWEUserName=' + document.all.SWEUserName.value + '&SWEPassword=' + document.all.SWEPassword.value);
				if (objDoc.selectSingleNode('Respuesta').selectSingleNode('Pertenencia').text == 'Y')
				{
					objDoc.load('gateway.asp?SWEUserName=' + document.all.SWEUserName.value + '&SWEPassword=' + document.all.SWEPassword.value);
					if (objDoc.selectSingleNode('Respuesta').text == 'OK'){
						document.all.clave.action = 'FINSECHANNEL_ESN/start.swe'
					}
					else if (objDoc.selectSingleNode('Respuesta').text == 'Expirada')
						{
							document.all.usua.value = document.all.SWEUserName.value;
							document.all.clave.action = 'Password.asp';
						}
					else {
						alert(objDoc.selectSingleNode('Respuesta').text)
						return false
					}
				}
				else {
					//Desde este punto debo continuar con las validaciones contra Canal ZUrich P&C antiguo
					//Canal Zurich Recuperador, Canal Zurich Legales o Canal Zurich Vida.


					objDoc.load('loginBrokers/XMLlogonSiebelPC.asp?SWEUserName=' + document.all.clave.SWEUserName.value + '&SWEPassword=' + document.all.clave.SWEPassword.value);
					if (objDoc.parseError.errorCode != 0)
						{
							alert('Error de Sistema: ' + objDoc.parseError.reason);
							return false;
						}
					if (objDoc.selectSingleNode('Respuesta').selectSingleNode('Pertenencia').text == 'Y')
						{
							document.all.clave.usua.value = document.all.clave.SWEUserName.value;
							document.all.clave.pass.value = document.all.clave.SWEPassword.value;
							if (objDoc.selectSingleNode('Respuesta').selectSingleNode('varSession').text == 'S') {
								document.all.clave.codFamilia.value = objDoc.selectSingleNode('Respuesta').selectSingleNode('CodFamilia').text
							}
							document.all.clave.action = objDoc.selectSingleNode('Respuesta').selectSingleNode('Direccion').text;
							//ACH le pasaba la dir con los parametros de esta forma, pero me da error 405,
							//por eso agregue los hidden usua y pass
						}
					else
						{
							alert('Usuario o Password Incorrecta');
							return false;
						}
				}
			document.all.clave.submit();
}
		</script>

		<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
		<link href="Canal%20Zurich_files/navigation_corporate.html" type="text/css" rel="stylesheet" id="navigation_corporate.css">
		<link href="ifiles/box_ie_MCMS.html" type="text/css" rel="stylesheet" id="box_ie_MCMS.css">
		<link href="ifiles/navigation.css" rel="stylesheet" type="text/css" media="screen">
		<link href="ifiles/content_ie.css" rel="stylesheet" type="text/css" media="screen">
		<link href="ifiles/box_ie.css" rel="stylesheet" type="text/css" media="screen">
	</head><body leftmargin="0" topmargin="0" marginheight="0" marginwidth="0">
		<div align="center"><!--<p>DESARROLLO</p>-->
			<table id="header" border="0" cellpadding="0" cellspacing="0" width="735">
				<colgroup>
					<col width="150">
					<col width="585">
				</colgroup>
				<tbody>
				  <tr>
				    <td height="33" align="center" valign="bottom" id="zurichLogo2">&nbsp;</td>
			      </tr>
				  <tr>
					<td height="71" align="center" valign="bottom" id="zurichLogo">
						<img src="ifiles/MINECO.gif" alt="Zurich logo" border="0" width="539" height="71">					</td>
				  </tr>
			</tbody></table>
<table id="header" border="0" cellpadding="0" cellspacing="0" width="735">
				<tbody><tr class="tabRow">
					<td class="tabSelected" width="150" height="20" nowrap="nowrap">
						<a href="http://www.mineco.gob.gt/" class="tabSelected" accesskey="1" style="padding-left: 7px;">P�gina Inicial</a>					</td>
			  <td class="navSeperator">
						<img src="ifiles/spacer.gif" border="0" width="1" height="1">
					</td>
			    	<td class="tabNormal" width="100%">&nbsp;</td>
				</tr>
				<tr>
					<td class="tabBg" colspan="3">
						<img src="Canal%20Zurich_files/spacer.gif" alt=" " border="0" width="1" height="5">
					</td>
				</tr>
			</tbody></table>
		  	<table id="contentArea" border="0" cellpadding="0" cellspacing="0" width="735">
  				<tbody><tr>
					<td colspan="2">
						<table border="0" cellpadding="0" cellspacing="0" width="100%">
							<tbody><tr>
								<td align="left" valign="top">
									<img src="ifiles/agoodconnection1.gif" alt="Zurich y usted. Una buena conexión" class="cotizador">
									<p class="titulo">
										<img src="ifiles/spacer.gif" width="13">Bienvenido al Sistema de Recursos Humanos On-Line Ministerio de Economia. &nbsp;<span>�</span>									</p>
							  </td>
								<td align="right">
									<span id="Titleplaceholder1">
										<img src="ifiles/home_image_zurich.jpeg" alt="Gente trabajando">
									</span>
								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>
				<tr>
					<td class="leftNavBg" width="150">
						<img src="ifiles/spacer.gif" alt="" border="0" width="150" height="1">
						<p class="cotizadortitulo">Registro de ID</p>
						<p class="linkboxlink" style="margin-left: 10px; margin-right: 10px;"><a href="" class="linkboxlink">USi usted no tiene un ID de Usuario para accesar al sistema, haga click aqu� &nbsp;<span>�</span></a></p>
				  </td>
      					<td id="content" width="585">
						<form id="clave" action="acceso.php" method="post">
							<table class="form" style="margin-left: 0px; margin-top: 0px; width: 580px;" border="0" cellpadding="6" cellspacing="0">
								<tbody><tr>
									<td colspan="2" style="text-align: left;">
										<h1>ID de Usuario</h1>									</td>
								</tr>
								<tr>
									<td style="text-align: right;">
										<label id="field1">Usuario</label>									</td>
									<td>
										<input id="username" name="username" value="" class="text" style="width: 220px;" ;="" type="text">									</td>
								</tr>
								<tr>
									<td style="text-align: right;">
										<label id="field2">Password</label>									</td>
									<td>
										<input id="userpassword" name="userpassword" value="" class="text" style="width: 220px;" ;="" type="password">									</td>
								</tr>
								<tr>
									<td height="54">&nbsp;</td>
									<td><div align="center">
									    <input type="submit" class="titulo" value="Login">  
									    <input value="ExecuteLogin" name="SWECmd" class="button" style="margin-left: 180px;" border="0" type="hidden">
									    <input name="usua" id="usua" value="" type="hidden">
									    <input name="pass" id="pass" value="" type="hidden">
									    <input name="codFamilia" id="codFamilia" value="" type="hidden">									
								      </div></td>
								</tr>
							</tbody></table>
							<div style="background-color: rgb(255, 255, 255); height: 60px; margin-top: 5px;" align="right"></div>
<a href="javascript:popUp('https://servicecenter.verisign.com/cgi-bin/Xquery.exe?Template=authCertByIssuer&amp;remote_host=https://digitalid.certisur.com/global/cgi-bin/haydn.exe&amp;form_file=../fdf/authCertByIssuer.fdf&amp;issuerSerial=5228b4ab0f0683e85e602c325be3a613')">						</a></form>
<a href="javascript:popUp('https://servicecenter.verisign.com/cgi-bin/Xquery.exe?Template=authCertByIssuer&amp;remote_host=https://digitalid.certisur.com/global/cgi-bin/haydn.exe&amp;form_file=../fdf/authCertByIssuer.fdf&amp;issuerSerial=5228b4ab0f0683e85e602c325be3a613')">					</a></td>
				</tr>
			</tbody></table>
			<table id="footer" border="0" cellpadding="0" cellspacing="0" width="735">
				<tbody><tr>
				      	<td align="right">
						<a accesskey="l" href="http://www.mineco.gob.gt">Gobierno</a>
						<img src="ifiles/global_nav_separator.gif" alt="" width="1">
						<a href="http://servicios.mineco.gob.gt/" class="bottomline">Copyright Sub-Gerencia de Informatica � 2009 Guatemala</a>					</td>
    				</tr>
			</tbody></table>
		</div>
	</body></html>