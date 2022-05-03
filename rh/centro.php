<?PHP
	session_start();
	if ($_SESSION['seguridad']==1)
	{
		print "";
	}else{
		header('Location: error.php');
	}
?>
<html>




<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<base target="principal">
<style type="text/css">
<!--
body {
	background-image: url(imagen/Theme_Marcos/marco11.gif);
}
.Estilo1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 13px;
}
-->
</style>
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
</head>

<body>
<p>&nbsp;</p>
<blockquote>
  <blockquote>
    <blockquote>
      <blockquote>
        <blockquote>
          <blockquote>
            <blockquote>
              <p>&nbsp;	</p>
            </blockquote>
          </blockquote>
        </blockquote>
        <p>
          <script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','570','height','400','src','ifiles/centro1','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','movie','ifiles/centro1' ); //end AC code
</script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="570" height="400">
            <param name="movie" value="ifiles/centro1.swf">
            <param name="quality" value="high">
            <embed src="ifiles/centro1.swf" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="570" height="400"></embed>
          </object></noscript>
</p>
      </blockquote>
    </blockquote>
  </blockquote>
</blockquote>
</body>

</html>
