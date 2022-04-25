<script type="text/javascript">
window.onload = function() {

if (document.getElementsByTagName) {

var s = document.getElementsByTagName("select");

if (s.length > 0) {

window.select_current = new Array();

for (var i=0, select; select = s[i]; i++) {
select.onfocus = function(){ window.select_current[this.id] = this.selectedIndex; }
select.onchange = function(){ restore(this); }
emulate(select);
}
}
}
}

function restore(e) {

if (e.options[e.selectedIndex].disabled) {
e.selectedIndex = window.select_current[e.id];
}
}

function emulate(e) {

for (var i=0, option; option = e.options[i]; i++) {

if (option.disabled) {
option.style.color = "graytext";
}
else {
option.style.color = "menutext";
}
}
}

function Disable(){

var select = document.getElementById("dropdown_number");

select.options[1].disabled = true; 
select.options[3].disabled = true; 
select.options[5].disabled = true; 
select.options[7].disabled = true; 
select.options[9].disabled = true; 

emulate(select);
}
</script>
<body>
<h1>stikiflem’s sample on disabling combobox items</h1>
<select id="dropdown_number" name="dropdown_number">
<option value="1">One</option>
<option value="2">Two</option>
<option value="3">Three</option>
<option value="4">Four</option>
<option value="5">Five</option>
<option value="6">Six</option>
<option value="7">Seven</option>
<option value="8">Eight</option>
<option value="9">Nine</option>
<option value="10">Ten</option>
</select>
<input type="button" value="Disable even numbers" onClick="Disable()" /> 

</body>

