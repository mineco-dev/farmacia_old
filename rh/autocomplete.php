<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
	
	<script type="text/javascript" src="js/prototype.js"></script>
	<script type="text/javascript" src="js/effects.js"></script>
	<script type="text/javascript" src="js/controls.js"></script>
	
	<style>
		#search, ul { padding: 3px; width: 150px; border: 1px solid #999; font-family: verdana; arial, sans-serif; font-size: 12px;}
	ul { list-style-type: none; font-family: verdana; arial, sans-serif; font-size: 12px;  margin: 5px 0 0 0}
	li { margin: 0 0 5px 0; cursor: default; color: red;}
	li:hover { background: #ffc; }
	</style>
	
</head>

<body>

<h2>Autocompletion example</h2>


<p>
This example accompanies the <a href="http://wiseguysonly.com/2006/04/14/ajax-autocompletion-for-the-impatient/">Ajax Autocompletion tutorial on my site</a>.
</p>

<p>
The database searches a few of my favourite musicians - the best place to start is by typing "the";
</p>


	
	<div>
		<label>Type here</label> <input name="search" type="text" id="search" size="100" maxlenght="100"/>
	</div>
	
	
	<div id="hint"></div>
	
	<script type="text/javascript">	
		new Ajax.Autocompleter("search","hint","server.php");
	</script>

</body>
</html>
