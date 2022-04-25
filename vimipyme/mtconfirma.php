<?php
session_start();
			session_register('sdireccion');
			  session_register('user');
			  session_register('usr_val');
			  session_register('psswd');
			  session_register('stratado');
			  session_register('sidtratado');
			  session_register('sdireccio');
			  session_register('sotros');
  			  session_register('sstipo');
			  session_register('empleado');

			  session_register('ssalon');
			  session_register('slugar');
			  session_register('shora');
  			  session_register('sdescripcion');
			  session_register('sreunion');
 session_register('idempleado');
 session_register('sstipo');
 /*********** lo agregue para la correspondencia ************/
 session_register('codigoUsuario');
 session_register('pagina'); // esta variable indica que pagina tiene el usuario
 session_register('usuario');
 session_register('rolUsuario');
 session_register('deptoUsuario');


$mtval="";
	include('INCLUDES/inc_header.inc');

	$dbms=new DBMS($conexion); 
	include('conectarse.php');
	$usrcor_ = $_POST['mtusuario'];
	$passcor_ =  $_POST['mtpassword'];
/*envia_msg('usuario '.$_SESSION['usrcor']);	
envia_msg('password '.$_SESSION['passcor']);	
envia_msg('password '.$usrcor_);	
envia_msg('password '.$passcor_);	*/
/*			envia_msg($_POST['mtusuario']);
			envia_msg($_POST['mtpassword']);*/
	//envia_msg(md5($_POST['mtpassword']));
//	$mtpassword = '15bb6e037e2732124a1dc509c02777d6';
	$mtpassword = 'de5b2e8b4242a7c5c282d8d61846aaa1';
	$mtpw = '5a671febd7538bcd6bb69f62e52b26bf';
//	$qtv = "SELECT * from asesor where usuario = '$mtusuario' and password = '$mtpassword' and habilitado = 'Y'";
/*    if (  ($usrcor_ == 'registro1') && (md5($passcor_) == $mtpassword)  || 
		  ($usrcor_ == 'registro2') && (md5($passcor_) == $mtpassword) ||
		 ($usrcor_ == 'registro3') && (md5($passcor_) == $mtpassword) ||
		 ($usrcor_ == 'registro4') && (md5($passcor_) == $mtpassword) ||
		 ($usrcor_ == 'registro5') && (md5($passcor_) == $mtpassword) ||
		 ($usrcor_ == 'registro6') && (md5($passcor_) == $mtpassword) */
 		if ( ($usrcor_ == 'ycastaneda') && (md5($passcor_) == $mtpassword) ||
		    ($usrcor_ == 'administrador') && (md5($passcor_) == $mtpw) )
  	     {							
			cambiar_ventana("boleta_empresarial_.php?mtusuario=".$usrcor_."&mtpsw=".$passcor_);
			  $validado=true;
			  $_SESSION['empleado'] = $usrcor_;
			  $_SESSION['codigoUsuario'] =  $usrcor_;
			  $_SESSION['user'] =$usrcor_;
			  $_SESSION['psswd'] = $mtpassword;
				$_SESSION['sotros'] = "0";
			$_SESSION['usr_val']='S';
			envia_mensaje('clave correcta');
		} 
		else
		{
			$mtmsg = "Usuario no valido";
			$_SESSION['usr_val']='N';
			cambiar_ventana("mtlogin.php?mtcadena=$mtmsg");
			exit;
        }
?>