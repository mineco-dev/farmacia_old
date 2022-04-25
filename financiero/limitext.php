<!DOCTYPE html>
<html>
<!-- TWO STEPS TO INSTALL LIMIT TEXTAREA:

  1.  Copy the coding into the HEAD of your HTML document
  2.  Add the last code into the BODY of your HTML document  -->

<!-- STEP ONE: Paste this code into the HEAD of your HTML document  -->

<HEAD>

<SCRIPT LANGUAGE="JavaScript">
<!-- Original:  Ronnie T. Moore -->
<!-- Web Site:  The JavaScript Source -->

<!-- Dynamic 'fix' by: Nannette Thacker -->
<!-- Web Site: http://www.shiningstar.net -->

<!-- This script and many more are available free online at -->
<!-- The JavaScript Source!! http://javascript.internet.com -->

<!-- Begin
function textCounter(field, countfield, maxlimit) {
if (field.value.length > maxlimit) // if too long...trim it!
field.value = field.value.substring(0, maxlimit);
// otherwise, update 'characters left' counter
else 
countfield.value = maxlimit - field.value.length;
}
// End -->
</script>
</HEAD>

<!-- STEP TWO: Copy this code into the BODY of your HTML document  -->

<BODY>

<!-- textCounter() parameters are:  text field, the count field, max length -->

<center>
<form name=myform action="YOUR-SCRIPT.CGI">
<font size="1" face="arial, helvetica, sans-serif"> ( You may enter up to 125 characters. )<br>
<textarea name=message wrap=physical cols=28 rows=4 onKeyDown="textCounter(this.form.message,this.form.remLen,125);" onKeyUp="textCounter(this.form.message,this.form.remLen,125);"></textarea>
<br>
<input readonly type=text name=remLen size=3 maxlength=3 value="125"> characters left</font>
</form>
</center>

<p><center>
<font face="arial, helvetica" SIZE="-2">Free JavaScripts provided<br>
by <a href="http://javascriptsource.com">The JavaScript Source</a></font>
</center><p>

<!-- Script Size:  1.37 KB -->
</html>
