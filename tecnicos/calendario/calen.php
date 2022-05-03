<html style="background-color: buttonface; color: buttontext;">
<head>
	<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
	
  <!-- calendar stylesheet -->
  <link rel="stylesheet" type="text/css" media="all" href="calendar-win2k-cold-1.css" title="win2k-cold-1" />

  <!-- main calendar program -->
  <script type="text/javascript" src="calendar.js"></script>

  <!-- language for the calendar -->
  <script type="text/javascript" src="lang/calendar-en.js"></script>

  <!-- the following script defines the Calendar.setup helper function, which makes
       adding a calendar a matter of 1 or 2 lines of code. -->
  <script type="text/javascript" src="calendar-setup.js"></script>  
</head>
<body>
<hr />
<p><b>Hidden field, display area, trigger image.</b> Very similar to the
previous example.  The difference is that we also have a trigger image.</p>

<form action="#" method="get" style="visibility: hidden">
<input type="hidden" name="date" id="f_date_e" />
</form>

<p>Your birthday: <span id="show_e">-- not entered --</span> <img
src="img.gif" id="f_trigger_e" style="cursor: pointer; border: 1px solid
red;" title="Date selector" onmouseover="this.style.background='red';"
onmouseout="this.style.background=''" />.</p>

<script type="text/javascript">
    Calendar.setup({
        inputField     :    "f_date_e",     // id of the input field
        ifFormat       :    "%Y/%d/%m",     // format of the input field (even if hidden, this format will be honored)
        displayArea    :    "show_e",       // ID of the span where the date is to be shown
        daFormat       :    "%A, %B %d, %Y",// format of the displayed date
        button         :    "f_trigger_e",  // trigger button (well, IMG in our case)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script>


</body>
</html> 

