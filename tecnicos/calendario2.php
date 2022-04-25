<html>
<head>
<style type="text/css">@import url(calendario/calendar-win2k-1.css);</style>
<script type="text/javascript" src="calendario/calendar.js"></script>
<script type="text/javascript" src="calendario/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendario/calendar-setup.js"></script>
<script type="text/javascript">
    Calendar.setup({
        inputField     :    "f_date_b",           //*
        ifFormat       :    "%m/%d/%Y %I:%M %p",
        showsTime      :    true,
        button         :    "f_trigger_b",        //*
        step           :    1
    });
</script>
</head>
<body>
<input type="text" name="date" id="f_date_b"/><button type="reset" id="f_trigger_b">...</button>
</body>
</html> 

