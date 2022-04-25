<html>
<head>
	<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
	
  <!-- calendar stylesheet -->
  <link rel="stylesheet" type="text/css" media="all" href="calendario/calendar-win2k-cold-1.css" title="win2k-cold-1" />

  <!-- main calendar program -->
  <script type="text/javascript" src="calendario/calendar.js"></script>

  <!-- language for the calendar -->
  <script type="text/javascript" src="calendario/lang/calendar-en.js"></script>

  <!-- the following script defines the Calendar.setup helper function, which makes
       adding a calendar a matter of 1 or 2 lines of code. -->
  <script type="text/javascript" src="calendario/calendar-setup.js"></script>  
</head>
<body>
<form action="#" method="get">
<input type="text" name="date" id="f_date_a" />
<input type="text" name="date" id="f_calcdate" />
</form>

<script type="text/javascript">
    function catcalc(cal) {
        var date = cal.date;
        var time = date.getTime()
        // use the _other_ field
        var field = document.getElementById("f_calcdate");
        if (field == cal.params.inputField) {
            field = document.getElementById("f_date_a");
            time -= Date.WEEK; // substract one week
        } else {
            time += Date.WEEK; // add one week
        }
        var date2 = new Date(time);
        field.value = date2.print("%Y-%m-%d %H:%M");
    }
    Calendar.setup({
        inputField     :    "f_date_a",   // id of the input field
        ifFormat       :    "%Y-%m-%d %H:%M",       // format of the input field
        showsTime      :    true,
        timeFormat     :    "24",
        onUpdate       :    catcalc
    });
    Calendar.setup({
        inputField     :    "f_calcdate",
        ifFormat       :    "%Y-%m-%d %H:%M",
        showsTime      :    true,
        timeFormat     :    "24",
        onUpdate       :    catcalc
    });
</script>

</body>
</html> 

