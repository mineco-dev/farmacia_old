<?php

// #################################################################//
// #  script by WingNut                        www.wingnut.net.ms  #//
// #                                                               #//
// #  this script has been published under the gnu public license  #//
// #  you may edit the script but never delete this comment! thx.  #//
// #################################################################//
// --begin editable region

// Root directory
$root_dir = ".";

// Thumbnail Columns
$columns = 7;

// Maximal size of thumbnails in pixel
$thumbwidth = 100;

// Slideshow 0=no 1=yes
$slideshow = 1;

// --end editable region
//##################################################################//
// Do not change anything by now unless you know what you are doing!
?>
<html>
<head>
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="author" content="Thomas Holtk�tter">
<meta name="keywords" content="EasyGallery, WingNut, projects, wingnut.net.ms">
<style type="text/css">
BODY{margin: 0 auto;}
*{margin:0;padding:0;}
.error{margin-left:8px;background-color:#999;width:100%;height:40px;font-family: Verdana, Arial, Helvetica, sans-serif;font-size:11px;font-weight:bold;}
.select {font-family: Verdana, Arial, Helvetica, sans-serif;font-size:11px;font-weight:bold;color:#666;margin-left:8px;margin-top:8px;border: 0px;}
.thumbnails{background-color:#FFF;border:#fff 2px solid;}
</style>
<script type="text/javascript" language="javascript" src="lytebox/lytebox.js"></script>
<link rel="stylesheet" href="lytebox/lytebox.css" type="text/css" media="screen" />
</head>
<body>

<?php
// --begin preprocessing
$phpself = $_SERVER['PHP_SELF'];
extract($_POST);

// filetypes
$filetypes = array("jpg", "jpeg");
$k = sizeof($filetypes);
for ($i=0; $i<$k; $i++)
{
  $filetypes[] = strtoupper($filetypes[$i]);
}

// extract local image folders
if (strpos($root_dir,'www')===0)
{
  $root_dir = 'http://'.$root_dir;
}
$local = parse_url($root_dir);
if (strpos($root_dir,'http://')===0)
{
  foreach (count_chars($phpself,1) as $i=>$val)
  {
    if (chr($i)=='/')
    {
	  $root_dir = substr($local['path'],1);
      for ($j=1;$j<$val;$j++)
        $root_dir='../'.$root_dir;
    }
  }
  if (strpos($root_dir,$local['path'])===0)
  {
    $root_dir = ".";
  }
}

// scanning directory for folders and check if they contain image files
if (!is_dir($root_dir))
{
  echo "<div class=\"error\">";
  echo "<span class=\"content\"><br>ERROR: folder not found.</span>";
  echo "</div>";
  exit();
}
$root_handle = opendir($root_dir);
while ($dirname = readdir($root_handle))
{
  $var1 = strcmp($dirname,'.');
  $var2 = strcmp($dirname,'..');
  $var3 = is_dir($root_dir.'/'.$dirname);
  if (($var1!=0) && ($var2!=0) && ($var3==1))
  {
	$dir_handle = opendir($root_dir.'/'.$dirname);
	$postmp = 0;
	while ($filename = readdir($dir_handle))
	{
  	  for ($i=0;$i<sizeof($filetypes);$i++)
  	  {
    	$postmp = strpos($filename, $filetypes[$i]);
		if ($postmp>0)
		{
		  $folders[] = $root_dir.'/'.$dirname;
		  break 2;
		}
  	  }
   	}
	closedir($dir_handle);
  }
}
if (!$folders)
{
  echo "<div class=\"error\">";
  echo "<span class=\"content\"><br>ERROR: Searched folders don't contain any image! Please change the \$root_dir.</span>";
  echo "</div>";
  exit();
}

// !!! if you dont want your folders in reverse order change rsort() to sort()
rsort($folders);

// set initial variable $ordner
if (!isset($ordner))
  $ordner = $folders[0];

// scanning directories for image files
if (is_dir($ordner)){
  $dir_handle = opendir($ordner);
  while ($filename = readdir($dir_handle))
  {
    for ($i=0; $i<sizeof($filetypes); $i++)
    {
      $pos = strpos($filename, $filetypes[$i]);
	  $var1 = strcmp($filename,'.');
      $var2 = strcmp($filename,'..');
      $var3 = is_file($ordner.'/'.$filename);
      if (($var1 != 0) && ($var2 != 0) && ($var3 == 1) && ($pos > 0))
   	  {
  	    $files[] = $filename;
   	  }
	  if ($filename=="thumbnails")
	  {
	    $thumbs = 1;
	  }
    }
  }
  sort($files);
  $size = sizeof($files);
  closedir($dir_handle);
  closedir($root_handle);
}
else
{
  echo "<div class=\"error\">";
  echo "<span class=\"content\"><br>ERROR: folder not found.</span>";
  echo "</div>";
  exit();
}
// --end preprocessing

// --begin form
echo "<div>\n";
echo "<form name=\"fotoalbum\" method=\"post\" action=\"$phpself\">\n";
echo "<select name=\"ordner\" onchange=\"document.fotoalbum.submit();\" class=\"select\">\n";
$carpeta="";
while ($folder = each($folders))
{
  if ($ordner == $folder["value"])
  {
	$carpeta="$ordner";
  	echo "<option selected value=\"$ordner\">";
  }
  else
  {
    echo "<option value=\"";
	echo $folder["value"];
	echo "\">";
  }
  $text = $folder["value"];
  while (strrpos($text,"/"))
  {
    $text = substr($text, strrpos($text,"/")+1);
  }

  // !!! if you want to add special chars to your folders uncomment or add the lines you need

  // GERMAN
  //$text = str_replace("ae", "�", $text); // Replace all ae with �
  //$text = str_replace("oe", "�", $text); // Replace all oe with �
  //$text = str_replace("ue", "�", $text); // Replace all ue with �
  //$text = str_replace("sz", "�", $text); // Replace all sz with �
  //$text = str_replace("AE", "�", $text); // Replace all AE with �
  //$text = str_replace("OE", "�", $text); // Replace all OE with �
  //$text = str_replace("UE", "�", $text); // Replace all UE with �

  // SCANDINAVIAN
  //$text = str_replace("ae", "�", $text); // Replace all ae with �
  //$text = str_replace("oe", "�", $text); // Replace all oe with �
  //$text = str_replace("aa", "�", $text); // Replace all aa with �
  //$text = str_replace("AE", "�", $text); // Replace all AE with �
  //$text = str_replace("OE", "�", $text); // Replace all OE with �
  //$text = str_replace("AA", "�", $text); // Replace all AA with �

  $text = str_replace("_", " ", $text); // Replace all _ with SPACE
  echo $text;
  echo "</option>\n";
}
echo "</select>\n";
require("$carpeta/datos.inc");
print "
	  <br>
	  <table width=\"372\" border=\"0\" align=\"center\" cellspacing=\"5\">
	  <tr>
		<td class=\"l_text\"><div align=\"right\">Empresa: </div></td>
		<td class=\"h_text\">".substr($ordner, strrpos($ordner,"/")+1)."</td>
	  </tr>
	  <tr>
		<td width=\"97\" class=\"l_text\"><div align=\"right\">Contacto: </div></td>
		<td width=\"265\" class=\"h_text\">$contacto</td>
	  </tr>
	  <tr>
		<td width=\"97\" class=\"l_text\"><div align=\"right\">Nit: </div></td>
		<td width=\"265\" class=\"h_text\">$nit</td>
	  </tr>
	  <tr>
		<td width=\"97\" class=\"l_text\"><div align=\"right\">C�digo de Exportador: </div></td>
		<td width=\"265\" class=\"h_text\">$codigo</td>
	  </tr>
	  <tr>
		<td width=\"97\" class=\"l_text\"><div align=\"right\">Direcci&oacute;n: </div></td>
		<td width=\"265\" class=\"h_text\">$direccion</td>
	  </tr>
	  <tr>
		<td class=\"l_text\"><div align=\"right\">Tel�fono:</div></td>
		<td class=\"h_text\">$telefono</td>
	  </tr>
	  <tr>
		<td class=\"l_text\"><div align=\"right\">Correo: </div></td>
		<td class=\"h_text\">$correo</td>
	  </tr>
	</table>";
echo "</form>\n";
echo "</div>\n";
// --end form

// --begin print images
$xpos=8;
$ypos=6;
$count = 0;
$newthumbs = false;
$divheight = ceil(count($files)/$columns) * ($thumbwidth+6) + 6;
echo "<table height=$divheight width=100% cellspacing=0 cellpadding=0><tr valign=top><td>\n";
for ($y=0;$y<count($files);$y++)
{
  $tn_src = $ordner."/thumbnails/tn_".$files[$count];
  if (file_exists($tn_src))
  {
    $image = GetImageSize($tn_src);
	if ($image[0]==$image[1]){}
	elseif ($image[0]<$image[1]) $xpos += intval(($image[1]-$image[0])/2);
	else $ypos += intval(($image[0]-$image[1])/2);
    echo "<div id=\"livethumbnail\" style=\"left:".$xpos."px; top:".$ypos."px; position:relative; zindex:1;\">";
    if($slideshow!=1){
	  echo "<a href=\"".$ordner."/".$files[$count]."\" rel=lytebox[".$ordner."]>";
	}
	else{
	  echo "<a href=\"".$ordner."/".$files[$count]."\" rel=lyteshow[".$ordner."]>";
	}
    echo "<img src=\"$tn_src\" class=\"thumbnails\" alt=\"$files[$count]\" style=\"width:$image[0]; height:$image[1]; left:0px; top:0px; position:absolute;\"></a></div>\n";
	if ($image[0]==$image[1]){}
	elseif ($image[0]<$image[1]) $xpos -= intval(($image[1]-$image[0])/2);
	else $ypos -= intval(($image[0]-$image[1])/2);
  }
  else
  {
  	$modules = get_loaded_extensions();
	if(!in_array("gd", $modules)){
	  echo "<div class=\"error\">";
      echo "<span class=\"content\"><br>Your Webserver doesn't provide the GD library, which is required to create thumbnails. Please create and add your thumbnails manually.</span>";
      echo "</div>";
      exit();
	}
	if(createthumb($ordner,$files[$count],$thumbwidth))
	{
	  echo "tn_$files[$count] created.<br>";
	  $newthumbs = true;
    }
	else
	{
	  echo "<div class=\"error\">";
      echo "<span class=\"content\"><br>Thumbnail Creation failed.</span>";
      echo "</div>";
      exit();
	}
  }
  $count++;
  if($count%$columns==0)
  {
    $ypos += $thumbwidth+6;
    $xpos = 8;
  }
  else
  {
    $xpos += $thumbwidth+6;
  }
}
if($newthumbs)
{
  echo "<script>location.reload()</script>";
}
echo "</td></tr></table>\n";
echo '<p><a href=http://wingnut.freitagmorgen.de style=margin-left:8px></a></p>';
// dont even think about removing this link!
echo "\n</body>";

function createthumb($name,$file,$maxsize)
{
  list($width, $height) = getimagesize("$name/$file");
  $width = min($width, $height);
  $tn = imagecreatetruecolor($maxsize, $maxsize);
  $image = imagecreatefromjpeg("$name/$file");
  imagecopyresampled($tn, $image, 0, 0, 0, 0, $maxsize, $maxsize, $width, $width);
  imagejpeg($tn, "$name/thumbnails/tn_$file", 70);
  return true;
}
?>
<script>
<!--
var zoom = 4;
var speed = 4;
var real = 0;
var intervalIn;
var divs = document.getElementsByTagName('div');
for (var i=0; i<divs.length; i++)
{
  if (divs[i].id == 'livethumbnail')
  {
	var myimg = divs[i].getElementsByTagName('img')[0];
	myimg.smallSrc = myimg.getAttribute('src');
	myimg.smallWidth = parseInt(myimg.getAttribute('width'));
	myimg.smallHeight = parseInt(myimg.getAttribute('height'));
	divs[i].onmouseover = scaleIn;
	divs[i].onmouseout = scaleOut;
	if (!myimg.smallWidth)
    {
    <?php
    if (isset($image)){
	  if ($image[0] > $image[1])
	  {
        echo "myimg.smallWidth = $image[0];\n";
        echo "myimg.smallHeight = $image[1];\n";
      }
      else
	  {
        echo "myimg.smallWidth = $image[1];\n";
 	    echo "myimg.smallHeight = $image[0];\n";
      }
	}
    ?>
      real = 0;
    }
    else
    {
  	  real = 1;
    }
  }
}

function scaleIn()
{
  var myimg = this.getElementsByTagName('img')[0];
  this.style.zIndex = 20;
  myimg.src = myimg.smallSrc;
  var count = 0;
  var real = 0;
  intervalIn = window.setInterval(scaleStepIn, 1);
  return false;

  function scaleStepIn()
  {
	var widthIn = parseInt(myimg.style['width']);
	var heightIn = parseInt(myimg.style['height']);
	var topIn = parseInt(myimg.style['top']);
	var leftIn = parseInt(myimg.style['left']);
	if(widthIn >= heightIn) {
	  widthIn += speed;
	  heightIn += Math.floor(speed * (3/4));
	  topIn -= (Math.floor(speed * (3/8)));
	  leftIn -= (speed/2);
	}
	else
	{
	  widthIn += Math.floor(speed * (3/4));
	  heightIn += speed;
	  topIn -= (speed/2);
	  leftIn -= (Math.floor(speed * (3/8)));
	}
	myimg.style['width'] = widthIn;
	myimg.style['height'] = heightIn;
	myimg.style['top'] = topIn;
	myimg.style['left'] = leftIn;
	count++;
	if (count >= zoom)
	  window.clearInterval(intervalIn);
  }
}
function scaleOut()
{
  window.clearInterval(intervalIn);
  var myimg = this.getElementsByTagName('img')[0];
  myimg.src = myimg.smallSrc;
  this.style.zIndex = 10;
  var mydiv = this;
  var interval = window.setInterval(scaleStepOut, 1);
  return false;

  function scaleStepOut()
  {
	var width = parseInt(myimg.style['width']);
	var height = parseInt(myimg.style['height']);
	var top = parseInt(myimg.style['top']);
	var left = parseInt(myimg.style['left']);
	if(width >= height) {
	  width -= speed;
	  height -= Math.floor(speed * (3/4));
  	  if(width < myimg.smallWidth + 4) {
	    myimg.style['width'] = myimg.smallWidth;
	    myimg.style['height'] = myimg.smallHeight;
	    myimg.style['top'] = 0;
	    myimg.style['left'] = 0;
		mydiv.style['zIndex'] = 1;
		window.clearInterval(interval);
	  }
	  else{
	    myimg.style['width'] = width;
	    myimg.style['height'] = height;
	    myimg.style['left'] = left + (speed/2);
	    myimg.style['top'] = top + (Math.floor(speed * (3/8)));
	  }
	}
	else
	{
	  width -= Math.floor(speed * (3/4));
	  height -= speed;
	  if(real==1)
	  {
	    if(width < myimg.smallWidth + 4)
	    {
	      myimg.style['width'] = myimg.smallWidth;
	      myimg.style['height'] = myimg.smallHeight;
		  myimg.style['top'] = 0;
	      myimg.style['left'] = 0;
		  mydiv.style['zIndex'] = 1;
	      window.clearInterval(interval);
		}
		else{
		  myimg.style['width'] = width;
	      myimg.style['height'] = height;
	      myimg.style['top'] = top + (speed/2);
	      myimg.style['left'] = left + (Math.floor(speed * (3/8)));
		}
	  }
	  else
	  {
	  	if(height < myimg.smallWidth + 4)
	    {
	      myimg.style['width'] = myimg.smallHeight;
	      myimg.style['height'] = myimg.smallWidth;
		  myimg.style['top'] = 0;
	      myimg.style['left'] = 0;
		  mydiv.style['zIndex'] = 1;
	      window.clearInterval(interval);
		}
		else{
		  myimg.style['width'] = width;
	      myimg.style['height'] = height;
	      myimg.style['top'] = top + (speed/2);
	      myimg.style['left'] = left + (Math.floor(speed * (3/8)));
		}
	  }
	}
  }
}
//-->
</script>
</html>