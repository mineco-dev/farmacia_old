<?

$action=trim($HTTP_GET_VARS['action']);
switch($action):
	case 'login':
	
		//aqui se envia los parametros de la tabla login
			
		$good_email="cromero@diaco.gob.gt";
		$good_pass="carolina";
		$sub = trim($_POST['sub']);
		$email = trim($_POST['email']);
		$password =trim($_POST['password']);
		$sep=',';
		sleep(2); 
		$msg="El Correo Electronico y el Password No Corresponden PorFavor Vuelva a Intentarlo";
		if ( $password == $good_pass ){

		   
		   // si se utilizan sesiones aqui deben de inicializarse
		   
		   print 'success,marcos.php,1';
		}
		else{
		   print 'error'.$sep.$msg;
		}
//		print 'success,index.php';
	break;
	default:
		print 'error,going somewhere ?';
endswitch;

function fun_isemail($strng){
 return preg_match('/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/i',$strng);
}
?>