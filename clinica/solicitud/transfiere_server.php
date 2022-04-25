<?
include('../includes/inc_header.inc');

function alinea_array($vec)
{
	$ret = "";
	$cnt = 0;
	while ($cnt < sizeof($vec))
	{
		if ($cnt >0) $ret= $ret .",";
		$ret = $ret.$vec[$cnt];
		$cnt++;
	}
	return $ret;
}

function get_query1($dbms,$tabla,$campos,$condicion)
{
	$ret = "insert into $tabla (".alinea_array($campos).") values ";
	$dbms->sql="select ".alinea_array($campos)." from $tabla $condicion";
	$dbms->Query();
	$ban = 0;
	$cnt = 0;
	while($Fields=$dbms->MoveNext())
	{
		if ($ban > 0) $ret = $ret.",";
		$ret = $ret."(";
		$cnt = 0;
		while ($cnt < sizeof($campos))
		{
			if ($cnt > 0) $ret = $ret.",";
			$ret = $ret."'".$Fields[$campos[$cnt]]."'";
			$cnt ++;
		}
		$ret = $ret.")";
		$ban ++;
	}
	return $ret;
}

function get_query($dbms,$tabla,$campos,$llavef,$vllavef,$condicion)
{
	$ret = "insert into $tabla ($llavef,".alinea_array($campos).") values ";
	$dbms->sql="select $vllavef,".alinea_array($campos)." from $tabla $condicion";
	$dbms->Query();
	$ban = 0;
	$cnt = 0;
	while($Fields=$dbms->MoveNext())
	{
		if ($ban > 0) $ret = $ret.",";
		$ret = $ret."('$vllavef',";
		$cnt = 0;
		while ($cnt < sizeof($campos))
		{
			if ($cnt > 0) $ret = $ret.",";
			$ret = $ret."'".$Fields[$campos[$cnt]]."'";
			$cnt ++;
		}
		$ret = $ret.")";
		$ban ++;
	}
	return $ret;
}

function get_query_involucrado($dbms,$tabla,$campos,$llavef,$vllavef,$condicion)
{
	$ret = "insert into $tabla ($llavef,".alinea_array($campos).") values ";
	$dbms->sql="select $vllavef,".alinea_array(get_tb_contrato_involucrado())." 
				from tb_contrato_involucrado i, tb_persona p
				where i.codigo_persona_individual = p.codigo_persona_individual
				$condicion";
	$dbms->Query();
	$ban = 0;
	$cnt = 0;
	while($Fields=$dbms->MoveNext())
	{
		if ($ban > 0) $ret = $ret.",";
		$ret = $ret."('$vllavef',";
		$cnt = 0;
		while ($cnt < sizeof($campos))
		{
			if ($cnt > 0) $ret = $ret.",";
			$ret = $ret."'".$Fields[$campos[$cnt]]."'";
			$cnt ++;
		}
		$ret = $ret.")";
		$ban ++;
	}
	return $ret;
}

function get_valor($dbms,$campo,$tabla,$condicion)
{
	$ret = 0;
	$dbms->sql="select $campo as cmp from $tabla $condicion";
	$dbms->Query();
	$Fields=$dbms->MoveNext();
	$ret = $Fields["cmp"];
	return $ret;
}

function get_tb_contrato()
{
	$campos[0]  = "fecha_celebracion";
	$campos[1]  = "numero_registro";
	$campos[2]  = "edificio";
	$campos[3]  = "colonia";
	$campos[4]  = "aldea";
	$campos[5]  = "caserio";
	$campos[6]  = "calle";
	$campos[7]  = "barrio";
	$campos[8]  = "avenida";
	$campos[9]  = "casa";
	$campos[10] = "codigo_status";
	$campos[11] = "codigo_zona";
	$campos[12] = "monto";
	$campos[13] = "plazo_o_condicion";
	$campos[14] = "interes";
	$campos[15] = "tipo_interes";
	$campos[16] = "ejecucion_voluntaria";
	$campos[17] = "fecha_creado";
	$campos[18] = "usuario_creo";
	$campos[19] = "fecha_modificado";
	$campos[20] = "usuario_modifico";
	$campos[21] = "fecha_desactivado";
	$campos[22] = "usuario_desactivo";
	$campos[23] = "codigo_municipio";
	$campos[24] = "escritura";
	$campos[25] = "numero";
	return $campos;
}

function get_tb_contrato_garantia_detalle()
{
	$campos[0]  = "activo";
	$campos[1]  = "descripcion_del_bien";
	$campos[2]  = "fecha_inicio";
	$campos[3]  = "fecha_final";
	$campos[4]  = "codiciones_generales";
	$campos[5]  = "codigo_motivo_inscripcion";
	$campos[6]  = "codigo_tipo_garantia";
	$campos[7]  = "codigo_abogado";
	$campos[8]  = "fecha_creado";
	$campos[9]  = "usuario_creo";
	$campos[10] = "fecha_modificado";
	$campos[11] = "usuario_modifico";
	$campos[12] = "fecha_desactivado";
	$campos[13] = "usuario_desactivo";
	$campos[14] = "path";
	$campos[15] = "codigo_estado";
	$campos[16] = "no_expediente";
	$campos[17] = "usuario";
	$campos[18] = "interes";
	$campos[19] = "plazo_o_condicion";
	$campos[20] = "contrato_a_modificar";
	$campos[21] = "motivo_cancelacion";
	$campos[22] = "descripcion_cancelacion";
	$campos[23] = "accion_modificacion";
	$campos[24] = "codigo_motivo_ejecucion";
	$campos[25] = "descripcion_ejecucion";
	$campos[26] = "codigo_persona_consultar";
	$campos[27] = "descripcion_ejecucion1";
	$campos[28] = "descripcion_ejecucion2";
	$campos[29] = "descripcion_ejecucion3";
	$campos[30] = "certificacion";
	$campos[31] = "monto";
	$campos[32] = "documento_adjunto";
	$campos[33] = "razon_modificacion";
	$campos[34] = "oficio_ejecucion";
	$campos[35] = "letra_modificacion";
	return $campos;
}

function get_tb_persona()
{
	$campos[0] = "primer_nombre";
	$campos[1] = "segundo_nombre";
	$campos[2] = "tercer_nombre";
	$campos[3] = "primer_apellido";
	$campos[4] = "segundo_apellido";
	$campos[5] = "apellido_casada";
	$campos[6] = "sexo";
	$campos[7] = "numero_pasaporte";
	$campos[8] = "cedula";
	$campos[9] = "fecha_nacimiento";
	$campos[10] = "nombre_padre";
	$campos[11] = "nombre_madre";
	$campos[12] = "nit";
	$campos[13] = "nombre_estado_provincia";
	$campos[14] = "edificio";
	$campos[15] = "colonia";
	$campos[16] = "aldea";
	$campos[17] = "caserio";
	$campos[18] = "barrio";
	$campos[19] = "calle";
	$campos[20] = "avenida";
	$campos[21] = "casa";
	$campos[22] = "razon_social";
	$campos[23] = "nombre_comercial";
	$campos[24] = "codigo_postal";
	$campos[25] = "codigo_municipio";
	$campos[26] = "codigo_registro";
	$campos[27] = "codigo_estado_civil";
	$campos[28] = "nacionalidad";
	$campos[29] = "no_patente";
	$campos[30] = "codigo_profesion";
	$campos[31] = "codigo_municipio_reside";
	$campos[32] = "fecha_creado";
	$campos[33] = "usuario_creo";
	$campos[34] = "fecha_modificado";
	$campos[35] = "usuario_modifico";
	$campos[36] = "fecha_desactivado";
	$campos[37] = "usuario_desactivo";
	$campos[38] = "inscrito_numero";
	$campos[39] = "folio";
	$campos[40] = "libro";
	$campos[41] = "razon_de";
	$campos[42] = "codigo_zona";
	$campos[43] = "representante";
	$campos[44] = "codigo_tipo_persona";
	return $campos;
}

function get_tb_detalle_pago()
{
	$campos[0] = "fecha_pago";
	$campos[1] = "boleta";
	$campos[2] = "fecha_creado";
	$campos[3] = "usuario_creo";
	$campos[4] = "fecha_modificado";
	$campos[5] = "usuario_modifico";
	$campos[6] = "fecha_desactivado";
	$campos[7] = "usuario_desactivo";
	$campos[8] = "valor";
	$campos[9] = "codigo_banco";
	return $campos;
}

function get_tb_detalle_contrato_bien()
{
	$campos[0]  = "descripcion";
	$campos[1]  = "cantidad";
	$campos[2]  = "numero_unico_identificacion";
	$campos[3]  = "codigo_bien";
	$campos[4]  = "codigo_tipo_bien";
	$campos[5]  = "id_dominio_registral";
	$campos[6]  = "codigo_medida";
	$campos[7]  = "codigo_presentacion";
	$campos[8]  = "expedienteregistro";
	$campos[9]  = "vigente";
	return $campos;
}

function get_tb_formulario()
{
	$campos[0]  = "no_identificacion";
	$campos[1]  = "usuario_creo";
	$campos[2]  = "fecha_creado";
	$campos[3]  = "usuario_opero";
	$campos[4]  = "fecha_opero";
	$campos[5]  = "codigo_motivo_inscripcion";
	$campos[6]  = "status";
	$campos[7]  = "observaciones";
	return $campos;
}

function get_tb_contrato_involucrado()
{
	$campos[0]  = "p.codigo_srgm as codigo_persona_individual";
	$campos[1]  = "i.codigo_actuacion";
	$campos[2]  = "i.nombramiento";
	$campos[3]  = "i.folio";
	$campos[4]  = "i.libro";
	$campos[5]  = "i.mandato";
	$campos[6]  = "i.fecha_creado";
	$campos[7]  = "i.usuario_creo";
	$campos[8]  = "i.fecha_modificado";
	$campos[9] = "i.usuario_modifico";
	$campos[10] = "i.fecha_desactivado";
	$campos[11] = "i.usuario_desactivo";
	$campos[12] = "i.solicitante";
	$campos[13] = "i.numero_inscripcion";
	$campos[14] = "i.vigente";
	return $campos;
}

function get_tb_campos_involucrado()
{
	$campos[0]  = "codigo_persona_individual";
	$campos[1]  = "codigo_actuacion";
	$campos[2]  = "nombramiento";
	$campos[3]  = "folio";
	$campos[4]  = "libro";
	$campos[5]  = "mandato";
	$campos[6]  = "fecha_creado";
	$campos[7]  = "usuario_creo";
	$campos[8]  = "fecha_modificado";
	$campos[9]  = "usuario_modifico";
	$campos[10] = "fecha_desactivado";
	$campos[11] = "usuario_desactivo";
	$campos[12] = "solicitante";
	$campos[13] = "numero_inscripcion";
	$campos[14] = "vigente";
	return $campos;
}

function transfiere_persona($contrato_detalle)
{
	include('../includes/inc_conexion_mysql.inc');
	$dbmsp=new DBMS($conexion);
	$dbmsp->bdd=$database_cnn;
	$dbmsp2=new DBMS($conexion);
	$dbmsp2->bdd=$database_cnn;
	
	include('../includes/inc_conexion_mysql_srgm.inc');
	$dbmsp22=new DBMS($conexion);
	$dbmsp22->bdd=$database_cnn;

	$dbmsp->sql="select p.codigo_persona_individual 
				from tb_contrato_involucrado ci, tb_persona p
				where p.codigo_persona_individual = ci.codigo_persona_individual and
					ci.codigo_detalle_contrato = $contrato_detalle and 
					codigo_srgm = 0";
	$dbmsp->Query();
	$ban = 0;
	$cnt = 0;
	while($Fields=$dbmsp->MoveNext())
	{
		$codigo_persona = $Fields["codigo_persona_individual"];
		$dbmsp22->sql=get_query1($dbmsp2,"tb_persona",get_tb_persona(),"where codigo_persona_individual=$codigo_persona");
		$dbmsp22->QueryI();
		$new_persona = get_valor($dbmsp22,"max(codigo_persona_individual)","tb_persona","");
		$dbmsp2->sql="update tb_persona set codigo_srgm=$new_persona where codigo_persona_individual= $codigo_persona";
		$dbmsp2->QueryI();
	}
}

function transfiere_constitucion($no_identificacion)
{
	include('../includes/inc_conexion_mysql.inc');
	$dbms=new DBMS($conexion);
	$dbms->bdd=$database_cnn;
	
	include('../includes/inc_conexion_mysql_srgm.inc');
	$dbms22=new DBMS($conexion);
	$dbms22->bdd=$database_cnn;

	$id_formulario = get_valor($dbms,"codigo_formulario","tb_formulario","where no_identificacion='$no_identificacion'");
	$id_detalle_contrato = get_valor($dbms,"codigo_detalle_contrato","tb_formulario","where no_identificacion='$no_identificacion'");
	$id_contrato = get_valor($dbms,"codigo_contrato","tb_contrato_garantia_detalle","where codigo_detalle_contrato = $id_detalle_contrato");
	
	// inserta el codigo real de la persona en el servidor privado
	transfiere_persona($id_detalle_contrato);
	//	inserta contrato
	$dbms22->sql= get_query1($dbms,"tb_contrato_garantia",get_tb_contrato(),"where codigo_contrato=$id_contrato");
	$dbms22->QueryI();
	$max_contrato = get_valor($dbms22,"max(codigo_contrato)","tb_contrato_garantia","");
	//  inserta contrato_garantia_detalle
	$dbms22->sql= get_query($dbms,"tb_contrato_garantia_detalle",get_tb_contrato_garantia_detalle(),"codigo_contrato","$max_contrato","where
	                                codigo_detalle_contrato=$id_detalle_contrato");
	$dbms22->QueryI();
	$max_detalle_contrato = get_valor($dbms22,"max(codigo_detalle_contrato)","tb_contrato_garantia_detalle","");
	//  inserta pagos
	$dbms22->sql= get_query($dbms,"tb_detalle_pago",get_tb_detalle_pago(),"codigo_detalle_contrato","$max_detalle_contrato","where
	 								codigo_detalle_contrato=$id_detalle_contrato");
	$dbms22->QueryI();
	//  inserta bienes
	$dbms22->sql= get_query($dbms,"tb_detalle_contrato_bien",get_tb_detalle_contrato_bien(),"codigo_detalle_contrato","$max_detalle_contrato","where
									codigo_detalle_contrato=$id_detalle_contrato");
	$dbms22->QueryI();
	//  inserta formulario
	$dbms22->sql= get_query($dbms,"tb_formulario",get_tb_formulario(),"codigo_detalle_contrato","$max_detalle_contrato","where
									codigo_detalle_contrato=$id_detalle_contrato");
	$dbms22->QueryI();
	//  inserta involucrado
	$dbms22->sql= get_query_involucrado($dbms,"tb_contrato_involucrado",get_tb_campos_involucrado(),"codigo_detalle_contrato","$max_detalle_contrato","and 
									codigo_detalle_contrato=$id_detalle_contrato");
	$dbms22->QueryI();
}


function transfiere_modificacion($no_identificacion)
{
	include('../includes/inc_conexion_mysql.inc');
	$dbms=new DBMS($conexion);
	$dbms->bdd=$database_cnn;
	
	include('../includes/inc_conexion_mysql_srgm.inc');
	$dbms22=new DBMS($conexion);
	$dbms22->bdd=$database_cnn;

	$id_formulario = get_valor($dbms,"codigo_formulario","tb_formulario","where no_identificacion='$no_identificacion'");
	$id_detalle_contrato = get_valor($dbms,"codigo_detalle_contrato","tb_formulario","where no_identificacion='$no_identificacion'");
	$id_contrato = get_valor($dbms,"codigo_contrato","tb_contrato_garantia_detalle","where codigo_detalle_contrato = $id_detalle_contrato");
	
	// inserta el codigo real de la persona en el servidor privado
	transfiere_persona($id_detalle_contrato);
	//	inserta contrato
	$dbms22->sql= get_query1($dbms,"tb_contrato_garantia",get_tb_contrato(),"where codigo_contrato=$id_contrato");
	$dbms22->QueryI();
	$max_contrato = get_valor($dbms22,"max(codigo_contrato)","tb_contrato_garantia","");
	//  inserta contrato_garantia_detalle
	$dbms22->sql= get_query($dbms,"tb_contrato_garantia_detalle",get_tb_contrato_garantia_detalle(),"codigo_contrato","$max_contrato","where
	                                codigo_detalle_contrato=$id_detalle_contrato");
	$dbms22->QueryI();
	$max_detalle_contrato = get_valor($dbms22,"max(codigo_detalle_contrato)","tb_contrato_garantia_detalle","");
	//  inserta pagos
	$dbms22->sql= get_query($dbms,"tb_detalle_pago",get_tb_detalle_pago(),"codigo_detalle_contrato","$max_detalle_contrato","where
	 								codigo_detalle_contrato=$id_detalle_contrato");
	$dbms22->QueryI();
	//  inserta bienes
	$dbms22->sql= get_query($dbms,"tb_detalle_contrato_bien",get_tb_detalle_contrato_bien(),"codigo_detalle_contrato","$max_detalle_contrato","where
									codigo_detalle_contrato=$id_detalle_contrato");
	$dbms22->QueryI();
	//  inserta formulario
	$dbms22->sql= get_query($dbms,"tb_formulario",get_tb_formulario(),"codigo_detalle_contrato","$max_detalle_contrato","where
									codigo_detalle_contrato=$id_detalle_contrato");
	$dbms22->QueryI();
	//  inserta involucrado
	$dbms22->sql= get_query_involucrado($dbms,"tb_contrato_involucrado",get_tb_campos_involucrado(),"codigo_detalle_contrato","$max_detalle_contrato","and 
									codigo_detalle_contrato=$id_detalle_contrato");
	$dbms22->QueryI();
	
}

function transfiere_ejecucion($no_identificacion)
{
	include('../includes/inc_conexion_mysql.inc');
	$dbms=new DBMS($conexion);
	$dbms->bdd=$database_cnn;
	
	include('../includes/inc_conexion_mysql_srgm.inc');
	$dbms22=new DBMS($conexion);
	$dbms22->bdd=$database_cnn;

	$id_formulario = get_valor($dbms,"codigo_formulario","tb_formulario","where no_identificacion='$no_identificacion'");
	$id_detalle_contrato = get_valor($dbms,"codigo_detalle_contrato","tb_formulario","where no_identificacion='$no_identificacion'");
	$id_contrato = get_valor($dbms,"codigo_contrato","tb_contrato_garantia_detalle","where codigo_detalle_contrato = $id_detalle_contrato");
	
	// inserta el codigo real de la persona en el servidor privado
	transfiere_persona($id_detalle_contrato);
	//	inserta contrato
	$dbms22->sql= get_query1($dbms,"tb_contrato_garantia",get_tb_contrato(),"where codigo_contrato=$id_contrato");
	$dbms22->QueryI();
	$max_contrato = get_valor($dbms22,"max(codigo_contrato)","tb_contrato_garantia","");
	//  inserta contrato_garantia_detalle
	$dbms22->sql= get_query($dbms,"tb_contrato_garantia_detalle",get_tb_contrato_garantia_detalle(),"codigo_contrato","$max_contrato","where
	                                codigo_detalle_contrato=$id_detalle_contrato");
	$dbms22->QueryI();
	$max_detalle_contrato = get_valor($dbms22,"max(codigo_detalle_contrato)","tb_contrato_garantia_detalle","");
	//  inserta pagos
	$dbms22->sql= get_query($dbms,"tb_detalle_pago",get_tb_detalle_pago(),"codigo_detalle_contrato","$max_detalle_contrato","where
	 								codigo_detalle_contrato=$id_detalle_contrato");
	$dbms22->QueryI();
	//  inserta formulario
	$dbms22->sql= get_query($dbms,"tb_formulario",get_tb_formulario(),"codigo_detalle_contrato","$max_detalle_contrato","where
									codigo_detalle_contrato=$id_detalle_contrato");
	$dbms22->QueryI();
	//  inserta involucrado
	$dbms22->sql= get_query_involucrado($dbms,"tb_contrato_involucrado",get_tb_campos_involucrado(),"codigo_detalle_contrato","$max_detalle_contrato","and 
									codigo_detalle_contrato=$id_detalle_contrato");
	$dbms22->QueryI();
}

function transfiere_cancelacion($no_identificacion)
{
	include('../includes/inc_conexion_mysql.inc');
	$dbms=new DBMS($conexion);
	$dbms->bdd=$database_cnn;
	
	include('../includes/inc_conexion_mysql_srgm.inc');
	$dbms22=new DBMS($conexion);
	$dbms22->bdd=$database_cnn;

	$id_formulario = get_valor($dbms,"codigo_formulario","tb_formulario","where no_identificacion='$no_identificacion'");
	$id_detalle_contrato = get_valor($dbms,"codigo_detalle_contrato","tb_formulario","where no_identificacion='$no_identificacion'");
	$id_contrato = get_valor($dbms,"codigo_contrato","tb_contrato_garantia_detalle","where codigo_detalle_contrato = $id_detalle_contrato");
	
	// inserta el codigo real de la persona en el servidor privado
	transfiere_persona($id_detalle_contrato);
	//	inserta contrato
	$dbms22->sql= get_query1($dbms,"tb_contrato_garantia",get_tb_contrato(),"where codigo_contrato=$id_contrato");
	$dbms22->QueryI();
	$max_contrato = get_valor($dbms22,"max(codigo_contrato)","tb_contrato_garantia","");
	//  inserta contrato_garantia_detalle
	$dbms22->sql= get_query($dbms,"tb_contrato_garantia_detalle",get_tb_contrato_garantia_detalle(),"codigo_contrato","$max_contrato","where
	                                codigo_detalle_contrato=$id_detalle_contrato");
	$dbms22->QueryI();
	$max_detalle_contrato = get_valor($dbms22,"max(codigo_detalle_contrato)","tb_contrato_garantia_detalle","");
	//  inserta pagos
	$dbms22->sql= get_query($dbms,"tb_detalle_pago",get_tb_detalle_pago(),"codigo_detalle_contrato","$max_detalle_contrato","where
	 								codigo_detalle_contrato=$id_detalle_contrato");
	$dbms22->QueryI();
	//  inserta formulario
	$dbms22->sql= get_query($dbms,"tb_formulario",get_tb_formulario(),"codigo_detalle_contrato","$max_detalle_contrato","where
									codigo_detalle_contrato=$id_detalle_contrato");
	$dbms22->QueryI();
	//  inserta involucrado
	$dbms22->sql= get_query_involucrado($dbms,"tb_contrato_involucrado",get_tb_campos_involucrado(),"codigo_detalle_contrato","$max_detalle_contrato","and 
									codigo_detalle_contrato=$id_detalle_contrato");
	$dbms22->QueryI();
}

function transfiere_consulta($no_identificacion)
{
	include('../includes/inc_conexion_mysql.inc');
	$dbms=new DBMS($conexion);
	$dbms->bdd=$database_cnn;
	
	include('../includes/inc_conexion_mysql_srgm.inc');
	$dbms22=new DBMS($conexion);
	$dbms22->bdd=$database_cnn;

	$id_formulario = get_valor($dbms,"codigo_formulario","tb_formulario","where no_identificacion='$no_identificacion'");
	$id_detalle_contrato = get_valor($dbms,"codigo_detalle_contrato","tb_formulario","where no_identificacion='$no_identificacion'");
	$id_contrato = get_valor($dbms,"codigo_contrato","tb_contrato_garantia_detalle","where codigo_detalle_contrato = $id_detalle_contrato");
	
	// inserta el codigo real de la persona en el servidor privado
	transfiere_persona($id_detalle_contrato);
	//	inserta contrato
	$dbms22->sql= get_query1($dbms,"tb_contrato_garantia",get_tb_contrato(),"where codigo_contrato=$id_contrato");
	$dbms22->QueryI();
	$max_contrato = get_valor($dbms22,"max(codigo_contrato)","tb_contrato_garantia","");
	//  inserta contrato_garantia_detalle
	$dbms22->sql= get_query($dbms,"tb_contrato_garantia_detalle",get_tb_contrato_garantia_detalle(),"codigo_contrato","$max_contrato","where
	                                codigo_detalle_contrato=$id_detalle_contrato");
	$dbms22->QueryI();
	$max_detalle_contrato = get_valor($dbms22,"max(codigo_detalle_contrato)","tb_contrato_garantia_detalle","");
	//  inserta pagos
	$dbms22->sql= get_query($dbms,"tb_detalle_pago",get_tb_detalle_pago(),"codigo_detalle_contrato","$max_detalle_contrato","where
	 								codigo_detalle_contrato=$id_detalle_contrato");
	$dbms22->QueryI();
	//  inserta formulario
	$dbms22->sql= get_query($dbms,"tb_formulario",get_tb_formulario(),"codigo_detalle_contrato","$max_detalle_contrato","where
									codigo_detalle_contrato=$id_detalle_contrato");
	$dbms22->QueryI();
	//  inserta involucrado
	$dbms22->sql= get_query_involucrado($dbms,"tb_contrato_involucrado",get_tb_campos_involucrado(),"codigo_detalle_contrato","$max_detalle_contrato","and 
									codigo_detalle_contrato=$id_detalle_contrato");
	$dbms22->QueryI();
}

transfiere_constitucion("65-CON");
?>

