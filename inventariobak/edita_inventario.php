<?
session_start();
include('conectarse.php');
$_SESSION['nivel']=1;
$query = 'mssql_query';

/*if  (( !$_SESSION['usr_val']) || ($_SESSION['usr_val'] == 'N') || ($_SESSION['usr_val'] == '') )
		{
		//envia_msg('2-'.$_SESSION['nivel']);
		 if ($_SESSION['nivel'] == 1)
			{
			 cambiar_ventana('mtlogin.php');
			}
		if ($_SESSION['nivel'] == 4)
			{
			 cambiar_ventana('../mtlogin.php');
			}

		  if ($_SESSION['nivel'] == 2)
			{
			 cambiar_ventana('../../mtlogin.php');
			}
		 if ($_SESSION['nivel'] == 3)
			{
			 cambiar_ventana('../../../mtlogin.php');
			}
		}*/

/*	if ( $sstipo != 1)
	{
	 cambiar_ventana('mtlogin.php');
	}*/

	include('INCLUDES/inc_header.inc');
	$dbms=new DBMS($conexion); 
	
/* esta funcion se utiliza para poder recuperar la descripcion de catalogos necesarios para colocarlo en la tabla de concatenacion de valores si son modificados*/	
 function valor_registro($param_field,$param_table,$param_cond,$val_cond)
  {
 	$sql= "select $param_field from $param_table where $param_cond = '$val_cond'";
//	echo $sql;
	$result = mssql_query($sql);
	while ($row = mssql_fetch_array($result))
	  {   
	    return($row[0]);
	  }
  }
/* termina la funcion de recuperacion de descripcion de catalogos...*/


 if ( isset($_POST['inserta']) && ($_POST['inserta'] == 1) ) 
	{
/*		$verifica = "select id_inventario from m_inventario where id_registro_inventario = '$_POST[reg_inventario]'";
		$resver = mssql_query($verifica);
		if (mssql_num_rows($resver) > 0) 
			{
			 error_msg('El articulo que desea ingresar ya existe en el sistema');
			}
		else
			{ */
			 $existe_eti = 0;
/*			  if (!empty($_POST['reg_it'])) // verifica que la etiqueta no exista en bitacora y en inventario
			   {
			   	 $vereti = "select id_bitacora_etiqueta from bitacora_etiqueta where id_reg_it = '$_POST[reg_it]'";
				 $res_eti = mssql_query($vereti);
				 if (mssql_num_rows($res_eti) > 0) // SI EXISTE EN LA BITACORA INCREMENTA LA VARIABLE
				  {
				   $existe_eti++;
				  }
			   	 $veretinv = "select id_inventario from m_inventario where id_registro_informatica = '$_POST[reg_it]'";
				 $res_etinv = mssql_query($veretinv);
				 if (mssql_num_rows($res_etinv) > 0) // SI EXISTE EN EL MAESTRO DE INVENTARIO INCREMENTA LA VARIABLE
				  {
					$existe_eti++;
				  }
				 if ($existe_eti > 0)  // SI YA EXISTE ELIMINA EL VALOR PARA DEJARLO EN CERO. Y MUESTRA UNA ALERTA 
				  {
  				   $anreg = $_POST['anio_reg_it'];
  				   $inreg = $_POST['insti_reg_it'];;
   				   $regit = 0;
				   envia_msg('La Etiqueta de Seguridad ya esta asignada a un equipo por favor verifique...!');
   				   envia_msg('El dispositivo ser� registrado pero la Etiqueta de Seguridad no ser� asignada al dispositivo.');
				  }
				 else
				  {
  				   $anreg = $_POST['anio_reg_it'];
   				   $inreg = $_POST['insti_reg_it'];
   				   $regit = $_POST['reg_it'];
				  }
			   }
			  else
			   {*/
  				   $anreg = $_POST['anio_reg_it'];
   				   $inreg = $_POST['insti_reg_it'];
   				   $regit = $_POST['reg_it'];
//   				   $regit = 0;
//			   }
			 	require_once('helpdesk.php');  
//				include("conectarse.php");
//				$usr = $_POST['usuario'];
			   $usr = $_SESSION['idempleado'];
				$crea_registro =0;
				if (!empty($_POST['fecha_factura']))
				 {
				 	$ff = substr($_POST['fecha_factura'],6,4).'/'.substr($_POST['fecha_factura'],3,2).'/'.substr($_POST['fecha_factura'],0,2);
				 }
				else
				 {
				  $ff = NULL;
				 }
				if (!empty($_POST['fecha_garantia']))
				 {
					$fg = substr($_POST['fecha_garantia'],6,4).'/'.substr($_POST['fecha_garantia'],3,2).'/'.substr($_POST['fecha_garantia'],0,2);
				 }
				else
				 {
					 $fg = NULL;
				 }
				 
				 /* fechas garantia sesion */
				if (!empty($_SESSION['fecha_compra']))
				 {
				 	$ffs = substr($_SESSION['fecha_compra'],6,4).'/'.substr($_SESSION['fecha_compra'],3,2).'/'.substr($_SESSION['fecha_compra'],0,2);
				 }
				else
				 {
				  $ffs = NULL;
				 }
				if (!empty($_SESSION['fecha_garantia_fin']))
				 {
					$fgs = substr($_SESSION['fecha_garantia_fin'],6,4).'/'.substr($_SESSION['fecha_garantia_fin'],3,2).'/'.substr($_SESSION['fecha_garantia_fin'],0,2);
				 }
				else
				 {
					 $fgs = NULL;
				 }
				 /* fechas sesion */
				 
				 
				if ($_POST['valor'])
				 {
				  $valor = $_POST['valor']; 
				 }
				else
				 {
				  $valor = 0;
				 }

				$consulta = "EXEC proc_upd_inventario 
							@v_id_inventario ='$_POST[id_inventario_par]', 
							@v_registro_inventario ='$_POST[reg_inventario]', 
							@v_id_producto ='$_POST[id_producto]', 
							@v_sicoin = '$_POST[sicoin]', 
							@v_marca = '$_POST[id_marca]', 
							@v_modelo = '$_POST[modelo]', 
							@v_serie = '$_POST[serie]', 
							@v_ubicacion = '$_POST[id_direccion]', 
							@v_anio_registro_informatica = '$anreg', 
							@v_insti_registro_informatica = '$inreg', 
							@v_registro_informatica = '$regit', 
							@v_inventario_padre = '$_POST[id_inventario_padre]', 
							@v_id_asesor = '$_POST[id_asesor]', 
							@v_id_tipo_dispositivo='$_POST[id_tipo_dispositivo]', 
							@v_codigo_usuario_creo ='$usr',
							@v_factura = '$_POST[factura]',
							@v_proveedor = '$_POST[id_proveedor]',
							@v_fecha_factura = '$ff',
							@v_valor = $valor,
							@v_fecha_garantia = '$fg',
							@v_cod_ant = '$_POST[cod_antiguo]',
							@v_desc = '$_POST[desc_m_inv]',
							@v_acta = '$_POST[acta]',
							@v_serie_fac = '$_POST[serie_factura]' ";

//		echo $consulta.'<br>';							
				$result=$query($consulta);	
				$close($s);		
				session_write_close();
				
				/* verifica si hubo cambios */
		$texto_modifica = 'Se modificaron los datos siguientes del inventario: ';
	    if ($_SESSION['id_registro_inventario'] != $_POST['reg_inventario'])
		 {
		  $texto_modifica = $texto_modifica.' Id Inventario anterior '.$_SESSION['id_registro_inventario'].' x '.$_POST['reg_inventario'].'--';
		 }
		if ($_SESSION['id_producto'] != $_POST['id_producto'])
		 {
		  $texto_modifica = $texto_modifica.' Id Producto anterior ['.$_SESSION['id_producto'].'] '.valor_registro('descripcion','cat_producto','id_producto',$_SESSION['id_producto']).
		  ' x ['.$_POST['id_producto'].'] '.valor_registro('descripcion','cat_producto','id_producto',$_POST['id_producto']).'--';
		 }
		if ($_SESSION['sicoin'] != $_POST['sicoin'])
		 {
 		  $texto_modifica = $texto_modifica.' Sicoin anterior '.$_SESSION['sicoin'].' x '.$_POST['sicoin'].'--';
		 }
		if ($_SESSION['id_marca'] != $_POST['id_marca']) 
		 {
  		  $texto_modifica = $texto_modifica.' Marca anterior ['.$_SESSION['id_marca'].'] '.valor_registro('marca','cat_marca','id_marca',$_SESSION['id_marca']).
		  ' x ['.$_POST['id_marca'].'] '.valor_registro('marca','cat_marca','id_marca',$_POST['id_marca']).'--';
		 }
		if ($_SESSION['modelo'] != $_POST['modelo'])
		 {
		  $texto_modifica = $texto_modifica.' Modelo anterior '.$_SESSION['modelo'].' x '.$_POST['modelo'].'--';
		 }
		if ($_SESSION['no_serie'] != $_POST['serie'])
		 {
		  $texto_modifica = $texto_modifica.' Serie anterior '.$_SESSION['no_serie'].' x '.$_POST['serie'].'--';
		 }
/*		if ($_SESSION['id_ubicacion_fisica'] != $_POST['id_direccion'])
		 {
		  $texto_modifica = $texto_modifica.' Serie anterior '.$_SESSION['id_ubicacion_fisica'].' x '.$_POST['id_direccion'];
		 }*/
		if ($_SESSION['id_inventario_padre'] != $_POST['id_inventario_padre'])
		 {
		  $texto_modifica = $texto_modifica.' Componente del Inventario anterior '.$_SESSION['id_inventario_padre'].' x '.$_POST['id_inventario_padre'].'--';
		 }
		if ($_SESSION['id_tipo_dispositivo'] != $_POST['id_tipo_dispositivo'])
		 {
		  $texto_modifica = $texto_modifica.' Tipo Dispositivo anterior ['.$_SESSION['id_tipo_dispositivo'].'] '.valor_registro('tipo_dispositivo','cat_tipo_dispositivo','id_tipo_dispositivo',$_SESSION['id_tipo_dispositivo']).
		  ' x ['.$_POST['id_tipo_dispositivo'].'] '.valor_registro('tipo_dispositivo','cat_tipo_dispositivo','id_tipo_dispositivo',$_POST['id_tipo_dispositivo']).'--';
		 }
		if ($_SESSION['nit'] != $_POST['id_proveedor'])
		 {
		  $texto_modifica = $texto_modifica.' Proveedor anterior ['.$_SESSION['nit'].'] '.valor_registro('proveedor','cat_proveedor','nit',$_SESSION['nit']).
		  ' x ['.$_POST['id_proveedor'].'] '.valor_registro('proveedor','cat_proveedor','nit',$_POST['id_proveedor']).'--';
		 }
		if ($_SESSION['factura'] != $_POST['factura'])
		 {
		  $texto_modifica = $texto_modifica.' Factura anterior '.$_SESSION['factura'].' x '.$_POST['factura'].'--';
		 }
		if ($ffs != $ff)
		 {
		  $texto_modifica = $texto_modifica.' Fecha Compra anterior '.$ffs.' x '.$ff.'--';
		 }
		if ($_SESSION['valor_compra'] != $valor)
		 {
		  $texto_modifica = $texto_modifica.' Valor de Compra anterior '.$_SESSION['valor_compra'].' x '.$valor.'--';
		 }
		if ($fgs != $fg)
		 {
		  $texto_modifica = $texto_modifica.' Fecha Termina Garantia anterior '.$fgs.' x '.$fg.'--';
		 }
 		if ($_SESSION['codigo_antiguo'] != $_POST['cod_antiguo'])
		 {
		  $texto_modifica = $texto_modifica.' Codigo Antiguo anterior '.$_SESSION['codigo_antiguo'].' x '.$_POST['cod_antiguo'].'--';
		 }
 		if ($_SESSION['serie_factura'] != $_POST['serie_factura'])
		 {
		  $texto_modifica = $texto_modifica.' Serie Factura anterior '.$_SESSION['serie_factura'].' x '.$_POST['serie_factura'].'--';
		 }
 		if ($_SESSION['acta'] != $_POST['acta'])
		 {
		  $texto_modifica = $texto_modifica.' Acta anterior '.$_SESSION['acta'].' x '.$_POST['acta'].'--';
		 }		 
 		if ($_SESSION['descripcion_m'] != $_POST['desc_m_inv'])
		 {
		  $texto_modifica = $texto_modifica.' Descripcion Inv. anterior '.$_SESSION['descripcion_m'].' x '.$_POST['desc_m_inv'].'--';
		 }		 
		 
 
 		/* Si los datos son de cpu se verifica cambio del detalle de inventario */
		if	($_POST['id_producto'] == 2) // si es cpu verifica los cambios en los datos en la actualizacion
		 {
		    if ($_SESSION['id_sistema_operativo'] != $_POST['id_so'])
			 {
	 		  $texto_modifica = $texto_modifica.' Sistema Operativo anterior ['.$_SESSION['id_sistema_operativo'].'] '.valor_registro('licencia_producto','cat_licencia_producto','id_licencia_producto',$_SESSION['id_sistema_operativo']).
			  ' x ['.$_POST['id_so'].'] '.valor_registro('licencia_producto','cat_licencia_producto','id_licencia_producto',$_POST['id_so']).'--';
			 }
		    if ($_SESSION['id_paquete'] != $_POST['id_paq'])
			 {
	 		  $texto_modifica = $texto_modifica.' Paquete anterior ['.$_SESSION['id_paquete'].'] '.valor_registro('licencia_producto','cat_licencia_producto','id_licencia_producto',$_SESSION['id_paquete']).
			  ' x ['.$_POST['id_paq'].'] '.valor_registro('licencia_producto','cat_licencia_producto','id_licencia_producto',$_POST['id_paq']).'--';
			 }
		    if ($_SESSION['licencia_so_original'] != $_POST['lic_so_or'])
			 {
	 		  $texto_modifica = $texto_modifica.' Licencia Sistema Operativo Original anterior '.$_SESSION['licencia_so_original'].' x '.$_POST['lic_so_or'].'--';
			 }
			if ($_SESSION['licencia_so_instalada'] != $_POST['lic_so_ins'])
			 {
	 		  $texto_modifica = $texto_modifica.' Licencia Sistema Operativo Instalada anterior '.$_SESSION['licencia_so_instalada'].' x '.$_POST['lic_so_ins'].'--';
			 }			 
			if ($_SESSION['id_tipo_licencia'] != $_POST['id_tipo_licencia'])
			 {
	 		  $texto_modifica = $texto_modifica.' Tipo licencia anterior ['.$_SESSION['id_tipo_licencia'].'] '.valor_registro('tipo_licencia','cat_tipo_licencia','id_tipo_licencia',$_SESSION['id_tipo_licencia']).
			  ' x ['.$_POST['id_tipo_licencia'].'] '.valor_registro('tipo_licencia','cat_tipo_licencia','id_tipo_licencia',$_POST['id_tipo_licencia']).'--';
			 }
			if ($_SESSION['licencia_paq_instalada'] != $_POST['lic_paq_ins'])
			 {
	 		  $texto_modifica = $texto_modifica.' Licencia Paquete anterior '.$_SESSION['licencia_paq_instalada'].' x '.$_POST['lic_paq_ins'].'--';
			 }
			if ($_SESSION['id_tipo_procesador'] != $_POST['id_proc'])
			 {
	 		  $texto_modifica = $texto_modifica.' Tipo de Procesador anterior ['.$_SESSION['id_tipo_procesador'].'] '.valor_registro('procesador','cat_procesador','id_procesador',$_SESSION['id_tipo_procesador'])
			  .' x ['.$_POST['id_proc'].'] '.valor_registro('procesador','cat_procesador','id_procesador',$_POST['id_proc']).'--';
			 }
			if ($_SESSION['id_capacidad_procesador'] != $_POST['id_cap_proc'])
			 {
	 		  $texto_modifica = $texto_modifica.' Capacidad de Procesador anterior ['.$_SESSION['id_capacidad_procesador'].'] '.valor_registro('capacidad','cat_capacidad','id_capacidad',$_SESSION['id_capacidad_procesador']).
			  ' x ['.$_POST['id_cap_proc'].'] '.valor_registro('capacidad','cat_capacidad','id_capacidad',$_POST['id_cap_proc']).'--';
			 }
			if ($_SESSION['id_socket'] != $_POST['id_socket'])
			 {
	 		  $texto_modifica = $texto_modifica.' Paquete anterior ['.$_SESSION['id_socket'].'] '.valor_registro('tipo','cat_tipos_varios','id_tipos',$_SESSION['id_socket']).
			  ' x ['.$_POST['id_socket'].'] '.valor_registro('tipo','cat_tipos_varios','id_tipos',$_POST['id_socket']).'--';
			 }
			if ($_SESSION['id_memoria'] != $_POST['id_memoria'])
			 {
	 		  $texto_modifica = $texto_modifica.' Memoria anterior ['.$_SESSION['id_memoria'].'] '.valor_registro('capacidad','cat_capacidad','id_capacidad',$_SESSION['id_memoria']).
			  ' x ['.$_POST['id_memoria'].'] '.valor_registro('capacidad','cat_capacidad','id_capacidad',$_POST['id_memoria']).'--';
			 }
			if ($_SESSION['id_tipo_memoria'] != $_POST['id_tipo_mem'])
			 {
	 		  $texto_modifica = $texto_modifica.' Tipo Memoria anterior ['.$_SESSION['id_tipo_memoria'].'] '.valor_registro('tipo','cat_tipos_varios','id_tipos',$_SESSION['id_tipo_memoria']).
			  ' x ['.$_POST['id_tipo_mem'].'] '.valor_registro('tipo','cat_tipos_varios','id_tipos',$_POST['id_tipo_mem']).'--';
			 }
			if ($_SESSION['id_marca_memoria'] != $_POST['id_marca_mem'])
			 {
	 		  $texto_modifica = $texto_modifica.' Marca Memoria anterior ['.$_SESSION['id_marca_memoria'].'] '.valor_registro('marca','cat_marca','id_marca',$_SESSION['id_marca_memoria']).
			  ' x ['.$_POST['id_marca_mem'].'] '.valor_registro('marca','cat_marca','id_marca',$_POST['id_marca_mem']).'--';
			 }
			if ($_SESSION['no_serie_memoria'] != $_POST['serie_memoria'])
			 {
	 		  $texto_modifica = $texto_modifica.' Serie Memoria anterior '.$_SESSION['no_serie_memoria'].' x '.$_POST['serie_memoria'].'--';
			 }
			if ($_SESSION['id_disco_duro'] != $_POST['id_disco'])
			 {
	 		  $texto_modifica = $texto_modifica.' Disco Duro anterior ['.$_SESSION['id_disco_duro'].'] '.valor_registro('capacidad','cat_capacidad','id_capacidad',$_SESSION['id_disco_duro']).
			  ' x ['.$_POST['id_disco'].'] '.valor_registro('capacidad','cat_capacidad','id_capacidad',$_POST['id_disco']).'--';
			 }
 			if ($_SESSION['id_tipo_disco_duro'] != $_POST['id_tipo_disco'])
			 {
	 		  $texto_modifica = $texto_modifica.' Tipo Disco Duro anterior ['.$_SESSION['id_tipo_disco_duro'].'] '.valor_registro('tipo','cat_tipos_varios','id_tipos',$_SESSION['id_tipo_disco_duro']).
			  ' x ['.$_POST['id_tipo_disco'].'] '.valor_registro('tipo','cat_tipos_varios','id_tipos',$_POST['id_tipo_disco']).'--';
			  echo $texto_modifica;
			 }
			if ($_SESSION['id_marca_disco'] != $_POST['id_marca_disco'])
			 {
				$texto_modifica = $texto_modifica.' Marca Disco anterior ['.$_SESSION['id_marca_disco'].'] '.valor_registro('marca','cat_marca','id_marca',$_SESSION['id_marca_disco']).
				'  x ['.$_POST['id_marca_disco'].'] '.valor_registro('marca','cat_marca','id_marca',$_POST['id_marca_disco']).'--';
//			    valor_registro('marca','cat_marca',$_SESSION['id_marca_disco']);				
//				$texto_modifica = $texto_modifica.' Marca Disco anterior '.$_SESSION['id_marca_disco'].' x '.$_POST['id_marca_disco'].'--';
			 }
			if ($_SESSION['no_serie_disco'] != $_POST['serie_disco'])
			 {
	 		  $texto_modifica = $texto_modifica.' No. Serie Disco anterior '.$_SESSION['no_serie_disco'].' x '.$_POST['serie_disco'].'--';
			 }
			if ($_SESSION['descripcion'] != $_POST['descripcion'])
			 {
	 		  $texto_modifica = $texto_modifica.' Descripcion Det. Inv. anterior '.$_SESSION['descripcion'].' x '.$_POST['descripcion'].'--';
			 }

		 }
		/* finaliza Si los datos son de cpu se verifica cambio del detalle de inventario */
		
//envia_msg($texto_modifica);		
		if ($texto_modifica != 'Se modificaron los datos siguientes del inventario: ')
		 {
			//envia_msg($texto_modifica);
			$sql_mod_inv = "EXEC proc_bita_upd_inventario 
							@v_id_inventario ='$_POST[id_inventario_par]',
							@v_desc_mod_inv = '$texto_modifica',  
							@v_codigo_usuario_creo  ='$usr' ";
//		echo $sql_mod_inv.'<br>';									
			$result_mi = mssql_query($sql_mod_inv);	
			$close($s);		
			session_write_close();
		
		 }
				/* termina verifica cambios en maestro inventario*/
				
				
				$consulta = "select id_inventario from m_inventario where id_registro_inventario = '$_POST[reg_inventario]'";
				$result = $query($consulta);
				while ($row = mssql_fetch_array($result))
				{
				 $id_inv = $row[0];
 				 $crea_registro++;
//				 envia_msg($id_inv);
				}
				
				/* inserta detalle de inventario  */
					
			  if ($_POST['id_producto'] == 2) // si el producto es un cpu tiene detalle de inventario
				{
				if (!empty($id_inv)) // si existe el maestro asigna el inventario al empleado y si existe el registro de informatica lo agrega en bitacora etiqueta
				 {
//				envia_msg("el producto es cpu");
//					   envia_msg("Si entra en producto existente y detalle de inventario");
//					    $desc = $desc.' - AGREGADO EL '.getdate().' -'.$_POST['descripcion'];
					    $desc =  $_POST['descripcion'];
						$consulta_p = "EXEC proc_upd_det_inventario @v_inventario ='$id_inv', @v_id_so = '$_POST[id_so]', @v_paq = '$_POST[id_paq]', 
									@v_lic_orig = '$_POST[lic_so_or]', @v_lic_inst = '$_POST[lic_so_ins]', 	@v_id_tipo_lic = '$_POST[id_tipo_licencia]', 
									@v_lic_paq_inst = '$_POST[lic_paq_ins]', @v_id_tipo_proc = '$_POST[id_proc]', @v_id_cap_proc = '$_POST[id_cap_proc]', 
									@v_id_socket = '$_POST[id_socket]' , @v_id_memoria = '$_POST[id_memoria]',  @v_id_tipo_memoria ='$_POST[id_tipo_mem]', 
									@v_id_marca_mem = '$_POST[id_marca_mem]', @v_serie_mem = '$_POST[serie_memoria]', @v_id_disco = '$_POST[id_disco]', 
									@v_id_tipo_disco = '$_POST[id_tipo_disco]', @v_id_marca_disco = '$_POST[id_marca_disco]', @v_serie_disco = '$_POST[serie_disco]', 
									@v_descripcion = '$desc',  @v_codigo_usuario_creo  ='$usr' ";
//		echo $consulta_p.'<br>';									
						$result_p = mssql_query($consulta_p);	
						$close($s);		
						session_write_close();
				  } // fin del if ($_POST[id_producto] == 2) // si el producto es un cpu tiene detalle de inventario
				}	
		/* finaliza inserta detalle de invetnario //*/

				
				
				if (!empty($id_inv)) // si existe el maestro asigna el inventario al empleado y si existe el registro de informatica lo agrega en bitacora etiqueta
				 {
//	 				 envia_msg('Si entra en asignacion inventario'.$id_inv);
					//agrega la asignacion del inventario al empleado
/*					$consulta = "EXEC proc_upd_asigna_inventario_empleado @v_inventario ='$id_inv', @v_empleado = '$_POST[id_asesor]', 
								 @v_codigo_usuario_creo  ='$usr' ";
echo $consulta.'<br>';								 
					$result=$query($consulta);	*/
//					$close($s);		
//					session_write_close();
					
					// agrega el registro de bitacora etiqueta
//					if (!empty($_POST['reg_it']))
/*					if ($regit > 0)
					 {
//					 envia_msg('Registro es: '.$_POST['reg_it']);
						$consulta_r = "EXEC proc_upd_bitacora_reg_it 
								@v_inventario ='$id_inv', 
								@v_anio_registro_informatica = '$anreg', 
								@v_insti_registro_informatica = '$inreg', 
								@v_registro_informatica = '$regit', 
								@v_anio_registro_it_old = null, 
								@v_insti_registro_it_old = null, 
								@v_registro_it_old = null, 
								@v_motivo_cambio = 'Registro Inicial de Etiqueta', 
								@v_codigo_usuario_creo ='$usr'";
					echo $consulta_r."<br>";							
						$result_r=$query($consulta_r);	
						$close($s);		
						session_write_close();
	 				 } */ // fin	if (!empty($_POST['reg_it']))

		/* inserta detalle de inventario  */
					
/*					if ($_POST['id_producto'] == 2) // si el producto es un cpu tiene detalle de inventario
				{
//				envia_msg("el producto es cpu");
//					   envia_msg("Si entra en producto existente y detalle de inventario");
//					    $desc = $desc.' - AGREGADO EL '.getdate().' -'.$_POST['descripcion'];
					    $desc =  $_POST['descripcion'];
						$consulta_p = "EXEC proc_add_det_inventario @v_inventario ='$id_inv', @v_id_so = '$_POST[id_so]', @v_paq = '$_POST[id_paq]', 
									@v_lic_orig = '$_POST[lic_so_or]', @v_lic_inst = '$_POST[lic_so_ins]', 	@v_id_tipo_lic = '$_POST[id_tipo_licencia]', 
									@v_lic_paq_inst = '$_POST[lic_paq_ins]', @v_id_tipo_proc = '$_POST[id_proc]', @v_id_cap_proc = '$_POST[id_cap_proc]', 
									@v_id_socket = '$_POST[id_socket]' , @v_id_memoria = '$_POST[id_memoria]',  @v_id_tipo_memoria ='$_POST[id_tipo_mem]', 
									@v_id_marca_mem = '$_POST[id_marca_mem]', @v_serie_mem = '$_POST[serie_memoria]', @v_id_disco = '$_POST[id_disco]', 
									@v_id_tipo_disco = '$_POST[id_tipo_disco]', @v_id_marca_disco = '$_POST[id_marca_disco]', @v_serie_disco = '$_POST[serie_disco]', 
									@v_descripcion = '$desc',  @v_codigo_usuario_creo  ='$usr' ";
						$result_p = mssql_query($consulta_p);	
						$close($s);		
						session_write_close();
				} // fin del if ($_POST[id_producto] == 2) // si el producto es un cpu tiene detalle de inventario*/
					
		/* finaliza inserta detalle de invetnario //*/

				 }
/*				if ($_POST['id_producto'] == 2) // si el producto es un cpu tiene detalle de inventario
				{
				envia_msg("el producto es cpu");
					if (!empty($id_inv))  // si existe el maestro deinventario inserta el detalle
					 {
					   envia_msg("Si entra en producto existente y detalle de inventario");
//					    $desc = $desc.' - AGREGADO EL '.getdate().' -'.$_POST['descripcion'];
					    $desc =  $_POST['descripcion'];
						$consulta_p = "EXEC proc_add_det_inventario @v_inventario ='$id_inv', @v_id_so = '$_POST[id_so]', @v_paq = '$_POST[id_paq]', 
									@v_lic_orig = '$_POST[lic_so_or]', @v_lic_inst = '$_POST[lic_so_ins]', 	@v_id_tipo_lic = '$_POST[id_tipo_licencia]', 
									@v_lic_paq_inst = '$_POST[lic_paq_ins]', @v_id_tipo_proc = '$_POST[id_proc]', @v_id_cap_proc = '$_POST[id_cap_proc]', 
									@v_id_socket = '$_POST[id_socket]' , @v_id_memoria = '$_POST[id_memoria]',  @v_id_tipo_memoria ='$_POST[id_tipo_mem]', 
									@v_id_marca_mem = '$_POST[id_marca_mem]', @v_serie_mem = '$_POST[serie_memoria]', @v_id_disco = '$_POST[id_disco]', 
									@v_id_tipo_disco = '$_POST[id_tipo_disco]', @v_id_marca_disco = '$_POST[id_marca_disco]', @v_serie_disco = '$_POST[serie_disco]', 
									@v_descripcion = '$desc',  @v_codigo_usuario_creo  ='$usr' ";
				echo $consulta_p;
						$result_p = $query($consulta_p);	
				echo $result_p;						
						$close($s);		
						session_write_close();
					 } // fin de if (!empty($id_inv))  // si existe el maestro deinventario inserta el detalle
				} // fin del if ($_POST[id_producto] == 2) // si el producto es un cpu tiene detalle de inventario*/
//            }  // fin del else		if (mssql_num_rows($resver) > 0) 
			
			   if ( $crea_registro > 0 )
				 {
					envia_msg('Se actualiz� exitosamente el registro');	
					cambiar_ventana('consulta.php');

				 }	
				else
				 {
					envia_msg('No se pudo actualizar el registro');	
				 }
	} // fin del if  if ( isset($_POST['inserta']) && ($_POST['inserta'] == 1) ) 

?>

<script language="JavaScript">
	function Verifica()
	 {
		

//		if (form1.nombre.value == "" || form1.apellido.value == "" || form1.idregistro.value == "" || form1.cedula.value == "" || form1.iddepartamento.value == "" || form1.usuario.value = "" || form1.password.value == "" || form1.iddepartamento2 == value ""  )
		if (form1.id_direccion.value == "" || form1.id_asesor.value == "" || form1.reg_inventario.value == "" || form1.id_producto.value == "" || form1.reg_it.value == "")
			{
				alert('Por favor llene los campos requeridos **');
				return false
			}
		}
 
/* 	function Deshabilita()
	 {
      alert(document.id_tipo_negocio.value);
	  if (document.id_tipo_negocio.value == 4)
	   {
	    alert("a");
	    document.tipo_negocio_desc.disabled=true;
	   }
	   else
   	   {
	   	    alert("b");
	    document.tipo_negocio_desc.disabled=false;
	   }

	 }*/

function validarEntero(numero){ 
      //Compruebo si es un valor num�rico 
      if (isNaN(numero)) { 
            //entonces (no es numero) devuelvo el valor cadena vacia 
            alert("Solo puede ingresar numeros en el campo");
			return ""
//   		    document.numeros.numero.focus();
      }else{ 
            //En caso contrario (Si era un n�mero) devuelvo el valor 
            return numero
           // document.numeros.numero.focus();
      } 
}
// valida ingreso unicamente numerico
function validar(e) { // 1
    tecla = (document.all) ? e.keyCode : e.which; // 2
    if (tecla==8) return true; // 3
//    patron =/[A-Za-z\s]/; // 4
	patron = /[\d\.]/; 
    te = String.fromCharCode(tecla); // 5
    return patron.test(te); // 6
} 



   
function checarcombo(){ 
if(form1.id_producto.value=="2"){ 
    form1.id_tipo_licencia.disabled=false; 
    form1.id_so.disabled=false; 
    form1.id_paq.disabled=false; 
    form1.lic_so_or.disabled=false; 
    form1.lic_so_ins.disabled=false; 
    form1.lic_paq_ins.disabled=false; 
    form1.id_proc.disabled=false; 
    form1.id_cap_proc.disabled=false; 
    form1.id_socket.disabled=false; 
    form1.id_memoria.disabled=false; 
    form1.id_tipo_mem.disabled=false; 
    form1.id_marca_mem.disabled=false; 
    form1.serie_memoria.disabled=false; 
    form1.id_disco.disabled=false; 
    form1.id_tipo_disco.disabled=false; 
    form1.id_marca_disco.disabled=false; 
    form1.serie_disco.disabled=false; 
    form1.descripcion.disabled=false; 
}else{ 
    form1.id_tipo_licencia.disabled=true; 
	form1.id_so.disabled=true; 
    form1.id_paq.disabled=true; 
    form1.lic_so_or.disabled=true; 
    form1.lic_so_ins.disabled=true; 
    form1.lic_paq_ins.disabled=true; 
    form1.id_proc.disabled=true; 
    form1.id_cap_proc.disabled=true; 
    form1.id_socket.disabled=true; 
    form1.id_memoria.disabled=true; 
    form1.id_tipo_mem.disabled=true; 
    form1.id_marca_mem.disabled=true; 
    form1.serie_memoria.disabled=true; 
    form1.id_disco.disabled=true; 
    form1.id_tipo_disco.disabled=true; 
    form1.id_marca_disco.disabled=true; 
    form1.serie_disco.disabled=true; 
    form1.descripcion.disabled=true; 
} 
} 

   
</script>

<div style="display:none">
<script type="text/javascript" src="resources/js/Fecha.js" ></script>
<script type="text/javascript" src="resources/js/Calendario.js" ></script>
<script type="text/javascript" src="resources/js/Calendario1.js" ></script>
<link rel="STYLESHEET" type="text/css" href="resources/css/calendario.css"></link>
</div>

<script language="JavaScript" src="incluciones/popcalendar.js"></script>
<script language="JavaScript">
function fechadinamica(link) {
	popcalendar.selectWeekendHoliday(1,1)
	popcalendar.show(link, null, "")
}
popcalendar = getCalendarInstance()
popcalendar.shadow = 1
popcalendar.initCalendar()
</script>




<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="HojaEstilo.css" rel="stylesheet" type="text/css">


<link rel="stylesheet" type="text/css" media="all" href="calendario/skins/aqua/theme.css" title="Aqua" />
<link rel="alternate stylesheet" type="text/css" media="all" href="calendar-blue.css" title="winter" />
<link rel="alternate stylesheet" type="text/css" media="all" href="calendar-blue2.css" title="blue" />
<link rel="alternate stylesheet" type="text/css" media="all" href="calendar-brown.css" title="summer" />
<link rel="alternate stylesheet" type="text/css" media="all" href="calendar-green.css" title="green" />
<link rel="alternate stylesheet" type="text/css" media="all" href="calendar-win2k-1.css" title="win2k-1" />
<link rel="alternate stylesheet" type="text/css" media="all" href="calendar-win2k-2.css" title="win2k-2" />
<link rel="alternate stylesheet" type="text/css" media="all" href="calendar-win2k-cold-1.css" title="win2k-cold-1" />
<link rel="alternate stylesheet" type="text/css" media="all" href="calendar-win2k-cold-2.css" title="win2k-cold-2" />
<link rel="alternate stylesheet" type="text/css" media="all" href="calendar-system.css" title="system" />

<!-- import the calendar script -->
<script type="text/javascript" src="calendar.js"></script>

<!-- import the language module -->
<script type="text/javascript" src="calendario/lang/calendar-en.js"></script>

<!-- other languages might be available in the lang directory; please check
your distribution archive. -->

<!-- helper script that uses the calendar -->
<script type="text/javascript">

var oldLink = null;
// code to change the active stylesheet
function setActiveStyleSheet(link, title) {
  var i, a, main;
  for(i=0; (a = document.getElementsByTagName("link")[i]); i++) {
    if(a.getAttribute("rel").indexOf("style") != -1 && a.getAttribute("title")) {
      a.disabled = true;
      if(a.getAttribute("title") == title) a.disabled = false;
    }
  }
  if (oldLink) oldLink.style.fontWeight = 'normal';
  oldLink = link;
  link.style.fontWeight = 'bold';
  return false;
}

// This function gets called when the end-user clicks on some date.
function selected(cal, date) {
  cal.sel.value = date; // just update the date in the input field.
  if (cal.dateClicked && (cal.sel.id == "sel1" || cal.sel.id == "sel3"))
    // if we add this call we close the calendar on single-click.
    // just to exemplify both cases, we are using this only for the 1st
    // and the 3rd field, while 2nd and 4th will still require double-click.
    cal.callCloseHandler();
}

// And this gets called when the end-user clicks on the _selected_ date,
// or clicks on the "Close" button.  It just hides the calendar without
// destroying it.
function closeHandler(cal) {
  cal.hide();                        // hide the calendar
//  cal.destroy();
  _dynarch_popupCalendar = null;
}

// This function shows the calendar under the element having the given id.
// It takes care of catching "mousedown" signals on document and hiding the
// calendar if the click was outside.
function showCalendar(id, format, showsTime, showsOtherMonths) {
  var el = document.getElementById(id);
  if (_dynarch_popupCalendar != null) {
    // we already have some calendar created
    _dynarch_popupCalendar.hide();                 // so we hide it first.
  } else {
    // first-time call, create the calendar.
    var cal = new Calendar(1, null, selected, closeHandler);
    // uncomment the following line to hide the week numbers
    // cal.weekNumbers = false;
    if (typeof showsTime == "string") {
      cal.showsTime = true;
      cal.time24 = (showsTime == "24");
    }
    if (showsOtherMonths) {
      cal.showsOtherMonths = true;
    }
    _dynarch_popupCalendar = cal;                  // remember it in the global var
    cal.setRange(1900, 2070);        // min/max year allowed.
    cal.create();
  }
  _dynarch_popupCalendar.setDateFormat(format);    // set the specified date format
  _dynarch_popupCalendar.parseDate(el.value);      // try to parse the text in field
  _dynarch_popupCalendar.sel = el;                 // inform it what input field we use

  // the reference element that we pass to showAtElement is the button that
  // triggers the calendar.  In this example we align the calendar bottom-right
  // to the button.
  _dynarch_popupCalendar.showAtElement(el.nextSibling, "Br");        // show the calendar

  return false;
}

var MINUTE = 60 * 1000;
var HOUR = 60 * MINUTE;
var DAY = 24 * HOUR;
var WEEK = 7 * DAY;

// If this handler returns true then the "date" given as
// parameter will be disabled.  In this example we enable
// only days within a range of 10 days from the current
// date.
// You can use the functions date.getFullYear() -- returns the year
// as 4 digit number, date.getMonth() -- returns the month as 0..11,
// and date.getDate() -- returns the date of the month as 1..31, to
// make heavy calculations here.  However, beware that this function
// should be very fast, as it is called for each day in a month when
// the calendar is (re)constructed.
function isDisabled(date) {
  var today = new Date();
  return (Math.abs(date.getTime() - today.getTime()) / DAY) > 10;
}

function flatSelected(cal, date) {
  var el = document.getElementById("preview");
  el.innerHTML = date;
}

function showFlatCalendar() {
  var parent = document.getElementById("display");

  // construct a calendar giving only the "selected" handler.
  var cal = new Calendar(0, null, flatSelected);

  // hide week numbers
  cal.weekNumbers = false;

  // We want some dates to be disabled; see function isDisabled above
  cal.setDisabledHandler(isDisabled);
  cal.setDateFormat("%A, %B %e");

  // this call must be the last as it might use data initialized above; if
  // we specify a parent, as opposite to the "showCalendar" function above,
  // then we create a flat calendar -- not popup.  Hidden, though, but...
  cal.create(parent);

  // ... we can show it here.
  cal.show();
}
</script>



<style type="text/css">
<!--
.Estilo1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.Estilo2 {
	color: #FFFFFF;
	font-weight: bold;
	font-size: 16px;
}
.Estilo6 {color: #FF0000}
.Estilo7 {font-family: Arial, Helvetica, sans-serif}
.Estilo8 {font-size: larger}
.Estilo22 {font-size: 11px}
.Estilo31 {font-size: 12px; font-weight: bold; }
.Estilo3 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #666666;
}
.Estilo13 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo46 {color: #666666; font-weight: bold;}
.Estilo47 {color: #000000}
.Estilo61 {	font-family: Arial, Helvetica, sans-serif;
	font-size: 24px;
	font-weight: bold;
}
.Estilo64 {
	color: #000000;
	font-size: 11px;
	font-family: Arial, Helvetica, sans-serif;
}
body {
	background-image: url(Fondo%20de%20Fiesta.jpg);
}
.Estilo28 {font-size: 12px}
.Estilo67 {font-size: 9px}
.Estilo69 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; }
a:link {
	color: #999999;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
	color: #FF0000;
}
a:active {
	text-decoration: none;
}
-->
</style>


</head>

<body onload="checarcombo();">
<table border="0" width="100%" class="Estilo1 Estilo18">
	<tr>
		<td align="left" bgcolor="#990000" width="15%" >
		<strong><font color="#FFFFFF" size="-1"><? print 'Usuario: '.$_SESSION['user']; ?></font></strong>
		</td>
		<td align="right"  width="70%">
		<a href="visita.php"><!--img src="tareas.gif" width="16" height="16" border="0"-->[ <-- Inicio ]</a>
		</td>
		<!--td align="right" >
		<a href="mtlogin.php"><!--img src="tareas.gif" width="16" height="16" border="0">[ Cerrar Sesión ]</a>
		</td-->
	</tr>
	<tr><!--td><font face="Arial, Helvetica, sans-serif" size="2"><br><strong><a href="consulta.php"><< Consultas >></a></strong></font></td-->
	</tr>
	
</table>

<form name="form1" method="post" action="edita_inventario.php?idi=<? echo $_GET['idi']; ?>" onSubmit="return Verifica()">
<!--form name="form1" method="post" action="asesoringreso.php"-->
  <table width="91%"  border="0" align="center">
    <tr>
      <th colspan="2" scope="col"><p class="Estilo3"><span class="Estilo1 Estilo8">
      </span>Ministerio de Econom�a de Guatemala<br>
      SubGerencia Financiera - SubGerencia de Inform�tica<br>
	  Sección de Inventarios</p>
        </th>
    </tr>
  </table>

  <p class="Estilo8 Estilo7"></p>
  <table border="0" align="center" cellspacing="0">
  <tr bgcolor="#0066CC">
    <td colspan="7"><div align="center"><span class="Estilo1 Estilo2"> EDICION DE INVENTARIO DE EQUIPO DE COMPUTO </span></div></td>
    </tr>
	      <?
$conection = mssql_connect("server_appl","sa","sa") or die("no se puede conectar a SQL Server");
 mssql_select_db("inventario",$conection);
 
 $query = "select id_registro_inventario, id_producto, sicoin, id_marca, modelo, no_serie, id_ubicacion_fisica, id_inventario_padre, id_anio_reg_it,
				id_institucion_reg_it, id_registro_informatica, id_tipo_dispositivo, nit, factura, CONVERT(varchar,fecha_compra,105) fecha_compra, valor_compra, 
				CONVERT(varchar,fecha_garantia_fin,105) fecha_garantia_fin, descripcion, serie_factura, codigo_antiguo, acta from m_inventario where id_inventario = $_GET[idi]";
//echo $query;
 $resulta = mssql_query($query);
 while ($rows = mssql_fetch_array($resulta))
  {
   /* variables de sesion para verificar cambios */		 
	$_SESSION['id_registro_inventario'] = $rows[0];
	$_SESSION['id_producto'] = $rows[1];
	$_SESSION['sicoin'] = $rows[2];
 	$_SESSION['id_marca'] = $rows[3];
	$_SESSION['modelo'] = $rows[4];
	$_SESSION['no_serie'] = $rows[5];
	$_SESSION['id_ubicacion_fisica'] = $rows[6];
	$_SESSION['id_inventario_padre'] = $rows[7];
	$_SESSION['id_anio_reg_it'] = $rows[8];
	$_SESSION['id_institucion_reg_it'] = $rows[9];
	$_SESSION['id_registro_informatica'] = $rows[10];
	$_SESSION['id_tipo_dispositivo'] = $rows[11];
	$_SESSION['nit'] = $rows[12];
	$_SESSION['factura'] = $rows[13];
	$_SESSION['fecha_compra'] = $rows[14];
	$_SESSION['valor_compra'] = $rows[15];
	$_SESSION['fecha_garantia_fin'] = $rows[16];
	$_SESSION['descripcion_m'] = $rows[17];	
	$_SESSION['serie_factura'] = $rows[18];
	$_SESSION['codigo_antiguo'] = $rows[19];	
	$_SESSION['acta'] = $rows[20];
  
  
   $query_inv_asigna = "select id_empleado from inventario_x_usuario where id_inventario = $_GET[idi]";
   $res_inv_asigna = mssql_query($query_inv_asigna);
   while ($rowinv = mssql_fetch_array($res_inv_asigna))
    {
	 $id_as_inv = $rowinv[0];
	}

   ?>
	
  <!--tr>
    <td><span class="Estilo67"><font color="#6699FF" face="Arial, Helvetica, sans-serif">Fecha</font></span></td>
    <td> <span class="Estilo67">
	<font face="Arial, Helvetica, sans-serif">
	<? //echo'<font color="#003399"><strong>'.date("d")."/".date("m")."/".date("Y").'</strong></font>'; ?> 
	<? //echo'<font color="#003399"><strong>'.$hora.'</strong></font>'; ?>	</font></span></td>
    </tr>&nbsp;</td>
  </tr-->
  <tr><Td><br></Td></tr>
  <tr class="Estilo1">
    <td class="Estilo22" align="right">Registro Inventario<font color="#FF0000"><strong>**</strong></font></td>
    <td class="Estilo7"><input name="reg_inventario" type="text" class="Estilo7" maxlength="100"  size="50" value="<? echo $rows['id_registro_inventario']; ?>" onKeyUp="javascript:this.value=this.value.toUpperCase();"></td>
  </tr>

	  <tr class="Estilo1" >
		<td class="Estilo22" align="right">Dispositivo<font color="#FF0000"><strong>**</strong></font></td>
		<td class="Estilo7"><select name="id_producto" onChange="checarcombo();"><? 
			$sql_prod = "select id_producto, descripcion from cat_producto order by 2";
			$result_prod = mssql_query($sql_prod);
			while ($row_prod = mssql_fetch_array($result_prod))
			  { 
			   if ($row_prod['id_producto'] == $rows['id_producto']) 
			    {
			  ?>
					<option value="<? echo $row_prod['id_producto']; ?>" selected ><? echo $row_prod['descripcion']; ?></option>
 			<?  } 
			  else
			    {?>
					<option value="<? echo $row_prod['id_producto']; ?>" ><? echo $row_prod['descripcion']; ?></option>
			<?  }  // fin else
			  } // fin while ?>
		</select> 
		</td>
  	</tr>
	  <tr class="Estilo1" >
		<td class="Estilo22" align="right">Tipo de Dispositivo<font color="#FF0000"><strong>**</strong></font></td>
		<td class="Estilo7">  <select name="id_tipo_dispositivo"><? 
			$sql = "select id_tipo_dispositivo, tipo_dispositivo from cat_tipo_dispositivo order by 2";
			$result = mssql_query($sql);
			while ($row = mssql_fetch_array($result))
			  { 
			  	if ($row[0] == $rows['id_tipo_dispositivo'])
				 {
				?>
					<option value="<? echo $row['id_tipo_dispositivo']; ?>" selected><? echo $row['tipo_dispositivo']; ?></option>
				<? } 
			     else { ?>
					<option value="<? echo $row['id_tipo_dispositivo']; ?>"><? echo $row['tipo_dispositivo']; ?></option>
				<? } ?>

			<? } ?>
		</select> 
		</td>
  	</tr>	
	  <tr class="Estilo1" >
		<td class="Estilo22" align="right">Marca<font color="#FF0000"><strong>**</strong></font></td>
		<td class="Estilo7"> <select name="id_marca"><? 
			$sql_marca = "select id_marca, marca from cat_marca order by 2";
			$result_marca = mssql_query($sql_marca);
			while ($row_marca = mssql_fetch_array($result_marca))
			  { 
			  	if ($row_marca[0] == $rows['id_marca'])
				 {
				?> <option value="<? echo $row_marca['id_marca']; ?>" selected><? echo $row_marca['marca']; ?></option>
			  <? } 
			     else { ?>					
				 <option value="<? echo $row_marca['id_marca']; ?>"><? echo $row_marca['marca']; ?></option>
				 <? } ?>
			<? } ?>
			</select> 
		</td>
  	</tr>	
	
  <tr class="Estilo1">
	  <td class="Estilo22" align="right">Modelo<font color="#FF0000"><strong></strong></font>
	  <td class="Estilo7"><input type="text" name="modelo" maxlength="30" value="<? echo $rows['modelo']; ?>"></td>
  </tr>
  <tr class="Estilo1">
	  <td class="Estilo22" align="right">Serie No.<font color="#FF0000"><strong></strong></font>
	  <td class="Estilo7"><input type="text" name="serie" maxlength="30" value="<? echo $rows['no_serie']; ?>"></td>
  </tr>
  <tr class="Estilo1">
	  <td class="Estilo22" align="right">Sicoin<font color="#FF0000"><strong></strong></font>
	  <td class="Estilo7"><input type="text" name="sicoin" maxlength="30" value="<? echo $rows['sicoin']; ?>"></td>
  </tr>
  <tr class="Estilo1">
	  <td class="Estilo22" align="right">Codigo Antiguo<font color="#FF0000"><strong></strong></font>
	  <td class="Estilo7"><input type="text" name="cod_antiguo" maxlength="30" value="<? echo $rows['codigo_antiguo']; ?>"></td>
  </tr>  
  <tr class="Estilo1" >
    <td class="Estilo22" align="right">Componente del Inventario No.<font color="#FF0000"><strong></strong></font></td>
    <td class="Estilo7"><input name="id_inventario_padre" type="text" class="Estilo7" maxlength="100"  size="50" value="<? echo $rows['id_inventario_padre']; ?>" onKeyUp="javascript:this.value=this.value.toUpperCase();"></td>
  </tr>
 <tr class="Estilo1" >
		<td class="Estilo22" align="right">Descripción Adicional del Equipo <font color="#FF0000">&nbsp;</font></td>
		<td class="Estilo7"><textarea name="desc_m_inv" class="Estilo7" rows="3" cols="60" onKeyUp="javascript:this.value=this.value.toUpperCase();"><? echo $rows['descripcion']; ?></textarea>
		</td>
  	</tr>					
   <tr class="Estilo1" >
    <td class="Estilo22" align="right">No. Serie </td><td><input name="serie_factura" type="text" class="Estilo7" maxlength="5"  size="5" value="<? echo $rows['serie_factura']; ?>">  
	No. Factura de Compra<font color="#FF0000"><strong></strong></font>
    <input name="factura" type="text" class="Estilo7" maxlength="15"  size="15" value="<? echo $rows['factura']; ?>" onkeypress="return validar(event)"></td>
  </tr>
 <tr class="Estilo1" >
    <td class="Estilo22" align="right">Acta si no Existe Factura<font color="#FF0000"><strong></strong></font></td>
    <td class="Estilo7"><input name="acta" type="text" class="Estilo7" maxlength="15"  size="15" value="<? echo $rows['acta']; ?>" ></td>
  </tr>
   <tr class="Estilo1" >
    <td class="Estilo22" align="right">Proveedor <font color="#FF0000"><strong></strong></font></td>
	<td class="Estilo7"> <select name="id_proveedor"><? 
			$sql = "select nit, proveedor from cat_proveedor order by 2";
			$result = mssql_query($sql);
			while ($row = mssql_fetch_array($result))
			  { 
			  	if ($row[0] == $rows['nit'])
				 {
				?> <option value="<? echo $row[0]; ?>" selected><? echo $row[1]; ?></option>
			  <? } 
			     else { ?>					
				 <option value="<? echo $row[0]; ?>"><? echo $row[1]; ?></option>
				 <? } ?>
			<? } ?>
			</select> 
	  </td>  </tr>
		
  <tr class="Estilo1" >
    <td class="Estilo22" align="right">Fecha de Compra<font color="#FF0000"><strong></strong></font></td>

	<td class="Estilo7"><input type="text" name="fecha_factura" id="sel9" size="10" maxlength="10" value="<? echo $rows['fecha_compra']; ?>"
><input type="reset" value=" ... " 
onclick="return showCalendar('sel9', '%d-%m-%Y', '24', true);"></td>
  </tr>
 <tr class="Estilo1" >
    <td class="Estilo22" align="right">Valor de Dispositivo Q. <font color="#FF0000"><strong></strong></font></td>
    <td class="Estilo7"><input name="valor" type="text" class="Estilo7" maxlength="12"  size="12" value="<? echo $rows['valor_compra']; ?>" onkeypress="return validar(event)"></td>
  </tr>  
  <tr class="Estilo1" >
    <td class="Estilo22" align="right">Fecha de Finalización de Garant�a<font color="#FF0000"><strong></strong></font></td>
		<td class="Estilo7"><input type="text" name="fecha_garantia" id="sel8" size="10" maxlength="10" value="<? echo $rows['fecha_garantia_fin']; ?>"
><input type="reset" value=" ... " 
onclick="return showCalendar('sel8', '%d-%m-%Y', '24', true);"></td>

  </tr>


  <tr class="Estilo1">
	  <td class="Estilo22" align="right">Registro Informatica<font color="#FF0000"><strong>**</strong></font>
	  <td class="Estilo7"><input type="hidden" name="anio_reg_it" maxlength="4" size="4" value="2008"><strong>2008</strong> -
	  <select name="insti_reg_it" disabled>
	  <? $query = "select id_institucion_reg_it, institucion_reg_it from cat_institucion_reg_it order by 2";
	     $result = mssql_query($query);
		 while($row = mssql_fetch_array($result))
		  { 
		  if ($row[0] == $rows['id_institucion_reg_it']) 
		    { ?>
		     <option selected value="<? echo $row[0]; ?>"><? echo $row[1]; ?></option>		   
		 <? }
		 else
		    {
		  ?>
		     <option value="<? echo $row[0]; ?>"><? echo $row[1]; ?></option>
	  <?    }
	      }
	  ?>
	  </select>
	  <input type="hidden" name="insti_reg_it" value="<? echo $rows['id_institucion_reg_it']; ?>">
	  - <input type="text" name="reg_it" disabled size="6" maxlength="6" value="<? echo $rows['id_registro_informatica']; ?>" onkeypress="return validar(event)">
	  <input type="hidden" name="reg_it" value="<? echo $rows['id_registro_informatica']; ?>"></td>
  </tr>
  <?
	$conection = mssql_connect("server_appl","sa","sa") or die("no se puede conectar a SQL Server");
	mssql_select_db("RRHH",$conection);
  ?>
  <tr class="Estilo1" >
		<td class="Estilo22" align="right">Ubicación F�sica<font color="#FF0000"><strong>**</strong></font></td>
		<td class="Estilo7"> <? 
			$sql_dir= "select iddireccion, nombre from direccion where id_institucion_reg_it = ". $_SESSION['id_unidad']." order by nombre";
			$result_dir = mssql_query($sql_dir);
 		 ?>  
		  <select name="id_direccion" onChange="javascript:cargarCombo('subactividades3.php', 'id_direccion', 'Div_Subactividades3')" disabled><option></option>
		<?	while ($row_dir = mssql_fetch_array($result_dir))
			  {
			    if ($row_dir[0] == $rows['id_ubicacion_fisica']) 
				 {?>
					<option selected value="<? echo $row_dir['iddireccion']; ?>"><? echo $row_dir['nombre']; ?></option>
			  <? }
			  else
			    {  ?>
					<option value="<? echo $row_dir['iddireccion']; ?>"><? echo $row_dir['nombre']; ?></option>
			<?	}
			   } ?>
	  </select>	  
  	  <input type="hidden" name="id_direccion" value="<? echo $rows['id_ubicacion_fisica']; ?>">
	  </td>
  	</tr>	
   <!--tr class="Estilo1" >
		<td class="Estilo22" align="right">Asignado a<font color="#FF0000"><strong>**</strong></font></td>
		<td class="Estilo7"> <? 
/*			$sql_as= "select idasesor, nombre, nombre2, nombre3, apellido, apellido2, apellidocasada from asesor where nombre != 'ADMINISTRADOR' order by 2, 5 ";
			$result_as = mssql_query($sql_as);
 		 ?>  <select name="id_asesor"><option></option>
		<?	while ($row_as = mssql_fetch_array($result_as))
			  { ?>

					<option value="<? echo $row_as['idasesor']; ?>"><? echo $row_as['nombre'].' '.$row_as['nombre2'].' '.$row_as['nombre3'].' '.$row_as['apellido'].
					' '.$row_as['apellido2'].' '.$row_as['apellidocasada']; ?></option>
			<? } */?>
			</select> 
		</td>
  	</tr-->	

	<TR class="ESTILO1">
	<td class="Estilo22" align="right">Asignado a<font color="#FF0000"><strong>**</strong></font></td>	
	<td class="Estilo7">
	<div align="left">
		  <div id="Div_Subactividades3"> 
				<label for="SubActividad3"></label> 
                 <?			$sql_as= "select idasesor, nombre, nombre2, nombre3, apellido, apellido2, apellidocasada from asesor where nombre != 'ADMINISTRADOR'  order by 2, 5 ";
			$result_as = mssql_query($sql_as);
 		 ?>  <select name="id_asesor" disabled>
		<?	while ($row_as = mssql_fetch_array($result_as))
			  { 
			    if ($row_as[0] == $id_as_inv )
				 {?>
				<option value="<? echo $row_as['idasesor']; ?>" selected><? echo $row_as['nombre'].' '.$row_as['nombre2'].' '.$row_as['nombre3'].' '.$row_as['apellido'].
					' '.$row_as['apellido2'].' '.$row_as['apellidocasada']; ?></option>
			<?   }
			    else
				{ ?>
				<option value="<? echo $row_as['idasesor']; ?>"><? echo $row_as['nombre'].' '.$row_as['nombre2'].' '.$row_as['nombre3'].' '.$row_as['apellido'].
					' '.$row_as['apellido2'].' '.$row_as['apellidocasada']; ?></option>
			<?	}
			   } ?>
			</select> 
	  	  <input type="hidden" name="id_asesor" value="<? echo $id_as_inv; ?>">
</div>
        </div></tD>
	</TR>
	
<? 	/* ***************************** Detalle del inventario ******************************* */ 

	$conection = mssql_connect("server_appl","sa","sa") or die("No se puede conectar a SQL Server");
	mssql_select_db("inventario",$conection);
	
   $query_det_inv = "select id_inventario, id_sistema_operativo, id_paquete, licencia_so_original, licencia_so_instalada, id_tipo_licencia, licencia_paq_instalada,
						id_tipo_procesador, id_capacidad_procesador, id_socket, id_memoria, id_tipo_memoria, id_marca_memoria, no_serie_memoria, id_disco_duro, 
						id_tipo_disco_duro, id_marca_disco, no_serie_disco, descripcion 
						from det_inventario where id_inventario = $_GET[idi]";
   $res_det_inv = mssql_query($query_det_inv);
   while ($rowdinv = mssql_fetch_array($res_det_inv))
    {
	 $id_det_inv = $rowdinv[0];
	 $id_sistema_operativo = $rowdinv[1];
	 $id_paquete = $rowdinv[2];
	 $licencia_so_original = $rowdinv[3];
	 $licencia_so_instalada = $rowdinv[4];
	 $id_tipo_licencia = $rowdinv[5];
	 $licencia_paq_instalada = $rowdinv[6];
	 $id_tipo_procesador = $rowdinv[7];
	 $id_capacidad_procesador = $rowdinv[8];
	 $id_socket = $rowdinv[9];
	 $id_memoria = $rowdinv[10];
	 $id_tipo_memoria  = $rowdinv[11];
	 $id_marca_memoria = $rowdinv[12];
	 $no_serie_memoria = $rowdinv[13];
	 $id_disco_duro = $rowdinv[14];
	 $id_tipo_disco_duro = $rowdinv[15];
	 $id_marca_disco = $rowdinv[16];
	 $no_serie_disco = $rowdinv[17];
	 $descripcion = $rowdinv[18]; 
	 
	 /* variables de sesion para comparar*/
	 $_SESSION['id_det_inv'] = $rowdinv[0];
 	 $_SESSION['id_sistema_operativo'] = $rowdinv[1];
	 $_SESSION['id_paquete'] = $rowdinv[2];
	 $_SESSION['licencia_so_original'] = $rowdinv[3];
	 $_SESSION['licencia_so_instalada'] = $rowdinv[4];
	 $_SESSION['id_tipo_licencia'] = $rowdinv[5];
	 $_SESSION['licencia_paq_instalada'] = $rowdinv[6];
	 $_SESSION['id_tipo_procesador'] = $rowdinv[7];
	 $_SESSION['id_capacidad_procesador'] = $rowdinv[8];
	 $_SESSION['id_socket'] = $rowdinv[9];
	 $_SESSION['id_memoria'] = $rowdinv[10];
	 $_SESSION['id_tipo_memoria']  = $rowdinv[11];
	 $_SESSION['id_marca_memoria'] = $rowdinv[12];
	 $_SESSION['no_serie_memoria'] = $rowdinv[13];
	 $_SESSION['id_disco_duro'] = $rowdinv[14];
	 $_SESSION['id_tipo_disco_duro'] = $rowdinv[15];
	 $_SESSION['id_marca_disco'] = $rowdinv[16];
	 $_SESSION['no_serie_disco'] = $rowdinv[17];
	 $_SESSION['descripcion'] = $rowdinv[18]; 

	 }
	   ?>
     <input type="hidden" name="id_inventario_par" value="<? echo $_GET['idi']; ?>">
	<tr class="Estilo1" >
		<td class="Estilo22" align="right">Tipo de Licencia<font color="#FF0000"><strong>**</strong></font></td>
		<td class="Estilo7"> <select name="id_tipo_licencia"><? 
			$sql_tl = "select id_tipo_licencia, tipo_licencia from cat_tipo_licencia order by 2";
			$result_tl = mssql_query($sql_tl);
			while ($row_tl = mssql_fetch_array($result_tl))
			  { 
			    if ($row_tl[0] == $id_tipo_licencia)
				{ ?>
				   <option selected value="<? echo $row_tl['id_tipo_licencia']; ?>"><? echo $row_tl['tipo_licencia']; ?></option>
			<?	}
				else
				{
			  ?>
					<option value="<? echo $row_tl['id_tipo_licencia']; ?>"><? echo $row_tl['tipo_licencia']; ?></option>
			<?  }
			  } ?>
			</select> 
		</td>
  	</tr>		
	<tr class="Estilo1" >
		<td class="Estilo22" align="right">Sistema Operativo<font color="#FF0000"><strong>**</strong></font></td>
		<td class="Estilo7"> <select name="id_so"><? 
			$sql= "select id_licencia_producto, licencia_producto from cat_licencia_producto where id_tipo_licencia_prod = 1 order by 2";
			$result = mssql_query($sql);
			while ($row = mssql_fetch_array($result))
			  { 
			    if ($row[0] == $id_sistema_operativo ) 
				 { ?>
					<option selected value="<? echo $row[0]; ?>"><? echo $row[1]; ?></option>
			<?   }
				else
				 { ?>
					<option value="<? echo $row[0]; ?>"><? echo $row[1]; ?></option>
			<?   }
			  } ?>
			</select> 
		</td>
  	</tr>		
	<tr class="Estilo1" >
		<td class="Estilo22" align="right">Paquete Instalado<font color="#FF0000"><strong>**</strong></font></td>
		<td class="Estilo7"> <select name="id_paq"><? 
//			$sql= "select id_paq, paquete from cat_paquete order by 2";
			$sql= "select id_licencia_producto, licencia_producto from cat_licencia_producto where id_tipo_licencia_prod = 2 order by 2";
			$result = mssql_query($sql);
			while ($row = mssql_fetch_array($result))
			  {  
			    if ($row[0] == $id_paquete ) 
				 { ?>
					<option selected value="<? echo $row[0]; ?>"><? echo $row[1]; ?></option>
			<?   }
				else
				 { ?>
					<option value="<? echo $row[0]; ?>"><? echo $row[1]; ?></option>
			<?   }
			  } ?>
			</select> 
		</td>
  	</tr>		
	<tr class="Estilo1" >
		<td class="Estilo22" align="right">Licencia S.O. Original<font color="#FF0000">&nbsp;</font></td>
		<td class="Estilo7"> <input name="lic_so_or" type="text" class="Estilo7" maxlength="100"  value="<? echo $licencia_so_original; ?>" size="50" onKeyUp="javascript:this.value=this.value.toUpperCase();">
		</td>
  	</tr>		
	<tr class="Estilo1" >
		<td class="Estilo22" align="right">Licencia S.O. Instalada<font color="#FF0000"><strong></strong></font></td>
		<td class="Estilo7"> <input name="lic_so_ins" type="text" class="Estilo7" maxlength="100" value="<? echo $licencia_so_instalada; ?>"  size="50" onKeyUp="javascript:this.value=this.value.toUpperCase();">
		</td>
  	</tr>		
  	</tr>		
	<tr class="Estilo1" >
		<td class="Estilo22" align="right">Licencia Paquete Intalado<font color="#FF0000"><strong></strong></font></td>
		<td class="Estilo7"> <input name="lic_paq_ins" type="text" class="Estilo7" maxlength="100"  size="50" value="<? echo $licencia_paq_instalada; ?>" onKeyUp="javascript:this.value=this.value.toUpperCase();">
		</td>
  	</tr>		
   <tr class="Estilo1" >
		<td class="Estilo22" align="right">Procesador<font color="#FF0000"><strong>**</strong></font></td>
		<td class="Estilo7"> <select name="id_proc"><? 
			$sql= "select id_procesador, procesador from cat_procesador order by 2";
			$result = mssql_query($sql);
			while ($row = mssql_fetch_array($result))
			  {   
			    if ($row[0] == $id_tipo_procesador ) 
				 { ?>
					<option selected value="<? echo $row[0]; ?>"><? echo $row[1]; ?></option>
			<?   }
				else
				 { ?>
					<option value="<? echo $row[0]; ?>"><? echo $row[1]; ?></option>
			<?   }
			  } ?>
			</select> 
		</td>
  	</tr>			
   <tr class="Estilo1" >
		<td class="Estilo22" align="right">Capacidad Procesador<font color="#FF0000"><strong>**</strong></font></td>
		<td class="Estilo7"> <select name="id_cap_proc"><? 
			$sql= "select id_capacidad, capacidad from cat_capacidad where id_producto = 6 order by 2";
			$result = mssql_query($sql);
			while ($row = mssql_fetch_array($result))
			  {   
			    if ($row[0] == $id_capacidad_procesador ) 
				 { ?>
					<option selected value="<? echo $row[0]; ?>"><? echo $row[1]; ?></option>
			<?   }
				else
				 { ?>
					<option value="<? echo $row[0]; ?>"><? echo $row[1]; ?></option>
			<?   }
			  } ?>
			</select> 
		</td>
  	</tr>			
   <tr class="Estilo1" >
		<td class="Estilo22" align="right">Socket Procesador<font color="#FF0000"><strong>**</strong></font></td>
		<td class="Estilo7"> <select name="id_socket"><? 
			$sql= "select id_tipos, tipo from cat_tipos_varios where id_producto = 6 order by 2";
			$result = mssql_query($sql);
			while ($row = mssql_fetch_array($result))
			  {   
			    if ($row[0] == $id_socket) 
				 { ?>
					<option selected value="<? echo $row[0]; ?>"><? echo $row[1]; ?></option>
			<?   }
				else
				 { ?>
					<option value="<? echo $row[0]; ?>"><? echo $row[1]; ?></option>
			<?   }
			  } ?>
			</select>  
		</td>
  	</tr>			
	<tr class="Estilo1" >
		<td class="Estilo22" align="right">Memoria RAM Instalada<font color="#FF0000"><strong>**</strong></font></td>
		<td class="Estilo7"> <select name="id_memoria"><? 
			$sql= "select id_capacidad, capacidad from cat_capacidad where id_producto = 4 order by 2";
			$result = mssql_query($sql);
			while ($row = mssql_fetch_array($result))
			  {   
			    if ($row[0] == $id_memoria ) 
				 { ?>
					<option selected value="<? echo $row[0]; ?>"><? echo $row[1]; ?></option>
			<?   }
				else
				 { ?>
					<option value="<? echo $row[0]; ?>"><? echo $row[1]; ?></option>
			<?   }
			  } ?>
			</select> 
		</td>
  	</tr>				
	<tr class="Estilo1" >
		<td class="Estilo22" align="right">Tipo Memoria RAM<font color="#FF0000"><strong>**</strong></font></td>
		<td class="Estilo7"> <select name="id_tipo_mem"> <option></option><? 
			$sql= "select id_tipos, tipo from cat_tipos_varios where id_producto = 4 order by 2";
			$result = mssql_query($sql);
			while ($row = mssql_fetch_array($result))
			   {   
			    if ($row[0] == $id_tipo_memoria ) 
				 { ?>
					<option selected value="<? echo $row[0]; ?>"><? echo $row[1]; ?></option>
			<?   }
				else
				 { ?>
					<option value="<? echo $row[0]; ?>"><? echo $row[1]; ?></option>
			<?   }
			  } ?>
			</select> 
		</td>
  	</tr>				
	<tr class="Estilo1" >
		<td class="Estilo22" align="right">Marca Memoria RAM<font color="#FF0000"><strong>**</strong></font></td>
		<td class="Estilo7"> <select name="id_marca_mem"><? 
			$sql= "select id_marca, marca from cat_marca order by 2";
			$result = mssql_query($sql);
			while ($row = mssql_fetch_array($result))
			  {  
			    if ($row[0] == $id_marca_memoria) 
				 { ?>
					<option selected value="<? echo $row[0]; ?>"><? echo $row[1]; ?></option>
			<?   }
				else
				 { ?>
					<option value="<? echo $row[0]; ?>"><? echo $row[1]; ?></option>
			<?   }
			  } ?>
			</select> 
		</td>
  	</tr>				
	<tr class="Estilo1" >
		<td class="Estilo22" align="right">No. Serie Memoria RAM<font color="#FF0000"><strong>**</strong></font></td>
		<td class="Estilo7"><input name="serie_memoria" type="text" class="Estilo7" maxlength="100"  size="50" value="<? echo $no_serie_memoria; ?>" onKeyUp="javascript:this.value=this.value.toUpperCase();">
		</td>
  	</tr>					

	<tr class="Estilo1" >
		<td class="Estilo22" align="right">Capacidad Disco Duro<font color="#FF0000"><strong>**</strong></font></td>
		<td class="Estilo7"> <select name="id_disco"><? 
			$sql= "select id_capacidad, capacidad from cat_capacidad where id_producto = 5 order by 1";
			$result = mssql_query($sql);
			while ($row = mssql_fetch_array($result))
			  {   
			    if ($row[0] == $id_disco_duro ) 
				 { ?>
					<option selected value="<? echo $row[0]; ?>"><? echo $row[1]; ?></option>
			<?   }
				else
				 { ?>
					<option value="<? echo $row[0]; ?>"><? echo $row[1]; ?></option>
			<?   }
			  } ?>
			</select> 
		</td>
  	</tr>				
	<tr class="Estilo1" >
		<td class="Estilo22" align="right">Tipo Disco Duro<font color="#FF0000"><strong>**</strong></font></td>
		<td class="Estilo7"> <select name="id_tipo_disco"> <option></option><? 
			$sql= "select id_tipos, tipo from cat_tipos_varios where id_producto = 5 order by 2";
			$result = mssql_query($sql);
			while ($row = mssql_fetch_array($result))
			   {   
			    if ($row[0] == $id_tipo_disco_duro ) 
				 { ?>
					<option selected value="<? echo $row[0]; ?>"><? echo $row[1]; ?></option>
			<?   }
				else
				 { ?>
					<option value="<? echo $row[0]; ?>"><? echo $row[1]; ?></option>
			<?   }
			  } ?>
			</select> 
		</td>
  	</tr>				
	<tr class="Estilo1" >
		<td class="Estilo22" align="right">Marca Disco Duro<font color="#FF0000"><strong>**</strong></font></td>
		<td class="Estilo7"> <select name="id_marca_disco"><? 
			$sql= "select id_marca, marca from cat_marca order by 2";
			$result = mssql_query($sql);
			while ($row = mssql_fetch_array($result))
			  {   
			    if ($row[0] == $id_marca_disco ) 
				 { ?>
					<option selected value="<? echo $row[0]; ?>"><? echo $row[1]; ?></option>
			<?   }
				else
				 { ?>
					<option value="<? echo $row[0]; ?>"><? echo $row[1]; ?></option>
			<?   }
			  } ?>
			</select> 
		</td>
  	</tr>				
	<tr class="Estilo1" >
		<td class="Estilo22" align="right">No. Serie Disco Duro<font color="#FF0000"><strong>**</strong></font></td>
		<td class="Estilo7"><input name="serie_disco" type="text" class="Estilo7" maxlength="100"  size="50" value="<? echo $no_serie_disco; ?>" onKeyUp="javascript:this.value=this.value.toUpperCase();">
		</td>
  	</tr>					
	<tr class="Estilo1" >
		<td class="Estilo22" align="right">Descripción Adicionales<font color="#FF0000">&nbsp;</font></td>
		<td class="Estilo7"><textarea name="descripcion" class="Estilo7" rows="4" cols="60" onKeyUp="javascript:this.value=this.value.toUpperCase();"><? echo $descripcion; ?></textarea>
		</td>
  	</tr>					
  <input type="hidden" name="inserta" value="1">

</table>
 <? } // finaliza while inicial
 ?>
<table width="50%"  border="0" align="center">
  <tr>
    <th width="43%" scope="row">&nbsp;</th>
    <td width="31%"><div align="right"><span class="Estilo1 Estilo6"><font color="#FF0000">** Campos Requeridos</font>
        <input type="submit" name="Submit" value="Registrar">
      <!--img src="images/flecha4.JPG" width="43" height="39"--> </span></div></td>
  </tr>
</table>
</form>

<script type="text/javascript"> 
var peticion = false; 
var  testPasado = false; 
try { 
  peticion = new XMLHttpRequest(); 
  } catch (trymicrosoft) { 
  try { 
  peticion = new ActiveXObject("Msxml2.XMLHTTP"); 
  } catch (othermicrosoft) { 
  try { 
  peticion = new ActiveXObject("Microsoft.XMLHTTP"); 
  } catch (failed) { 
  peticion = false; 
  } 
  } 
} 
if (!peticion) 
alert("ERROR AL INICIALIZAR!"); 
  
function cargarCombo (url, comboAnterior, element_id) { 
    //Obtenemos el contenido del div 
    //donde se cargaran los resultados 
    var element =  document.getElementById(element_id); 
    //Obtenemos el valor seleccionado del combo anterior 
    var valordepende = document.getElementById(comboAnterior) 
    var x = valordepende.value 
    //construimos la url definitiva 
    //pasando como parametro el valor seleccionado 
    var fragment_url = url+'?Id='+x; 
    element.innerHTML = '<img src="Imagenes/loading.gif" />'; 
    //abrimos la url 
    peticion.open("GET", fragment_url); 
    peticion.onreadystatechange = function() { 
        if (peticion.readyState == 4) { 
//escribimos la respuesta 
element.innerHTML = peticion.responseText; 
        } 
    } 
   peticion.send(null); 
} 
</script>


</body>
</html>
