<?
	$grupo_id=9;
	include("../restringir.php");	
?>
<html>
<head>
<script LANGUAGE="JavaScript">
function Validar(form)
{
if (form.txt_ticket.value == "")
  { 
  	alert("Debe ingresar el No. de ticket previamente asignado"); 
	form.txt_ticket.focus(); 
	return;
  }
if (!numerico(form.txt_ticket.value))
    { 
        alert("Debe ingresar un n�mero de ticket v�lido");
		form.txt_ticket.focus(); 
		return;
	}	
function numerico(valor)
{ 
	   ticket=valor.toString();
	   var nuLongitud = ticket.length;
	   var i= 0;
	   var bobandera = "TRUE";
	   for(i=0;i<nuLongitud;i++)
	   {
		  switch(ticket.charAt(i))
		  {
				case '1': case '2': case '3':
				case '4': case '5': case '6':
				case '7': case '8': case '9': case '0':
				bobandera = "TRUE";
				break;
				default:
				bobandera = "FALSE";				
		  } //end switch           
	   }//end for
	   if (bobandera == "FALSE") return false
	   else return true;      
}

function Refrescar(form)
{
	form.reset();
	form.txt_ticket.focus(); 
}
form.submit();
}
</script>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<center>
  <form name="form" method="GET" action="greasignar_ticket.php">
    <table width="50%" border="0" bordercolor="#0000FF">
      <tr> 
        <td><div align="center"><strong>Reasignar ticket:</strong></div></td>
      </tr>
      <tr> 
        <td><center>
            <table width="92%" border="0" cellspacing="5">
              <tr> 
                <td width="11%" height="25" bgcolor="#C9CDED"> <div align="center"></div>
                  <div align="center">No.
                </div></td>
                <td width="49%" bgcolor="#C9CDED"><input name="txt_ticket" type="text" id="txt_ticket"></td>
                <td width="40%" bgcolor="#99CCFF">
                  <div align="left">
                    <input name="bt_consultar" onClick="Validar(this.form)" type="button" id="bt_consultar" value="Consultar">
                  </div>                  
                  <div align="center">
                </div></td>
              </tr>
            </table>
          </center></td>
      </tr>
      <tr> 
        <td><div align="center">
          </div></td>
      </tr>
    </table>
  </form>
</center>
</body>
</html>
