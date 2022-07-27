<!DOCTYPE html>


<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
</head>

<body>

	<table width="372"  align="center" >
		<tr>
			<form action="" enctype="multipart/form-data" >
				<td><span class="Estilo2 form-control-static ">Tipo de Compra:  </span></td>
				<td>
				<select class="form-control" style="width:170px;" name="a" required >
				
				<option value="0">:: Seleccione ::</option>
				<!--<option value="15">Compra Directa</option>-->
				<option value="8">Compra General</option> 
				</select>
				</td>
			
			
				<td><span class="Estilo2 form-control-static">Busqueda Categoria:  </span></td>	
				<td><input type="text" name="b" size="10"  value=""  class="form-control" style="width:70px;"/></td>

				 <td><span class="Estilo2 form-control-static">Busqueda subcategoria:  </span></td>
				 <td><input type="text" name="c" size="10"  value="" class="form-control" style="width:70px;" /></td>
				
				 <td><span class="Estilo2 form-control-static">Busqueda Producto:  </span></td>
				 <td><input type="text" name="d" size="10"  value=""  class="form-control" style="width:70px;"/></td>
				
				
				 <td><span class="Estilo2 form-control-static ">otro:  </span></td>
				<td>
				<select class="form-control" style="width:170px;" name="otro" required >
				
				<option value="0">:: Seleccione ::</option>
				<option value="30">Próximos a vencer</option>
				<option value="40">Baja existencia</option> 
				<option value="50">Medicina expirada</option> 
				</select>
				</td>

				<td> <input  class="btn btn-primary"  type="submit" value="MOSTRAR" >
				
			</form>
			</td> </td>
        </tr>
    </table>

  

	<?PHP


		if (isset($_POST["a"]))
		{
			$a = $_POST["a"];

		}
		if (isset($_POST["b"]))
		{
			$b = $_POST["b"];

		}

		if (isset($_POST["c"]))
		{
			$c = $_POST["c"];

		}

		if (isset($_POST["d"]))
		{
			$d = $_POST["d"];

		}

		if (isset($_POST["otro"]))
		{
			$otro = $_POST["otro"];
		

		}

		$vec[0] = "categoria";
		$vec[1] = "subcategoria";
		$vec[2] = "codigo_producto";
		$vec[3] = "Producto";
		$vec[4] = "Unidad Medida";
		$vec[5] = "Existencia";
		$vec[6] = "Caducidad";
		$vec[7] = "Lote";
		$vec[8] = "Bodega";
		$vec[9] = "Empresa";
		$vec[10] = "Costo Promedio";
		$vec[11] = "Costo Total";

		$vec2[0] = "categoria";
		$vec2[1] = "subcategoria";
		$vec2[2] = "codigo_producto";
		$vec2[3] = "producto";
		$vec2[4] = "unidad_medida";
		$vec2[5] = "existencia";
		$vec2[6] = "caducidad";
		$vec2[7] = "lote";
		$vec2[8] = "bodega";
		$vec2[9] = "empresa";
		$vec2[10] = "promedio";
		$vec2[11] = "costo_total";

		$vec3[0] = "width=\"5%\"";
		$vec3[1] = "width=\"5%\"";
		$vec3[2] = "width=\"5%\"";
		$vec3[3] = "width=\"40%\"";
		$vec3[4] = "width=\"12%\"";
		$vec3[5] = "width=\"10%\"";
		$vec3[6] = "width=\"10%\"";
		$vec3[7] = "width=\"10%\"";
		$vec3[8] = "width=\"10%\"";
		$vec3[9] = "width=\"10%\"";
		$vec3[10] = "width=\"15%\"";
		$vec3[11] = "width=\"15%\"";
		/* condiciones dinamicas	*/
		$condicionesx= '';
		//declare $co
		if ($a>0) 
			{$condicionesx= $condicionesx . ' and i.codigo_bodega = '.$a;}	
		if ($b>0) //-- agregar la condicion de bodega
			{$condicionesx= $condicionesx . ' and p.codigo_categoria = '.$b ;}
		if ($c>0) //-- agregar la condicion de bodega
			{$condicionesx= $condicionesx . ' and p.codigo_subcategoria = '.$c ;}
		if ($d>0) //-- agregar la condicion de bodega
			{$condicionesx= $condicionesx. ' and p.codigo_producto = '.$d ;}
		if ($otro==30) //-- cuando se elija los de proximos a vencer
			{$condicionesx= $condicionesx . 'and convert(date,id.fecha_vence) >= getdate() and convert(date,id.fecha_vence) <= EOMONTH( dateadd(month, 6,  getdate()) ) and id.existencia>0';}
		if ($otro==40) //-- cuando se baja existencia
			{$condicionesx= $condicionesx . ' and i.existencia<= p.existencia_minima ';}
		if ($otro==50) //-- cuando las medicinas ya expiraron
			{$condicionesx= $condicionesx . ' and  DATEDIFF(DAY,GETDATE(),id.fecha_vence) <= 0 and id.existencia > 0';}
		/* fin condiciones indamicas */
		if ($a >0)
		{
			$query = "select  top 400 
			max (p.codigo_categoria) as categoria, max( p.codigo_subcategoria) as subcategoria, 
			max (p.codigo_producto) as codigo_producto, max (kd.fecha_creado) as FECHAMOV,  max (p.producto +' - '+ p.marca) as producto, 
			max ( m.unidad_medida) as unidad_medida, max( i.existencia) as existencia, 
			max (cast (id.fecha_vence as DATE)) as caducidad, max(id.lote) as lote,
			max(b.bodega) as bodega, max( e.empresa) as empresa, max( i.rowid) as row, 
			max( i.costo_inicial) as costo_inical,
			max( kd.costo_promedio) as promedio, max (kd.costo_total) as costo_total
			from 
			tb_inventario i inner join cat_producto p 
					on i.codigo_producto = p.codigo_producto and i.codigo_categoria = p.codigo_categoria and i.codigo_subcategoria = p.codigo_subcategoria
			inner join lotes_existencia id
					on i.codigo_producto=id.codigo_producto and i.codigo_categoria=id.codigo_categoria and i.codigo_subcategoria=id.codigo_subcategoria
			inner join cat_medida m
					on m.codigo_medida = p.codigo_medida
			inner join cat_empresa e
					on e.codigo_empresa = i.codigo_empresa
			inner join cat_bodega b
					on b.codigo_bodega = i.codigo_bodega 
			inner join dbo.tb_kardex as kd on i.codigo_producto = kd.codigo_producto and i.codigo_categoria = kd.codigo_categoria and i.codigo_subcategoria = kd.codigo_subcategoria
			where p.activo=1 ". $condicionesx . "
			group by p.codigo_categoria,p.codigo_subcategoria,p.codigo_producto 
			order by producto";

		}
		 /* echo "<hr>";
		echo $query;
		echo "<hr>"; */
	
		getTabla2($query, 10, $vec, $vec2, $vec3, $dbms, 95,"","","");
	?>
</body>
</html>
