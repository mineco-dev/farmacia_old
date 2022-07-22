
<?php
   

   conectardb($almacen);


    $query_consulta=" use almacen_farmacia 
                    select  top 400 
                    max (p.codigo_categoria) as categoria, max( p.codigo_subcategoria) as subcategoria, 
                    max (p.codigo_producto) as codigo_producto, max (kd.fecha_creado) as FECHAMOV,  max (p.producto +' - '+ p.marca) as producto, 
                    max ( m.unidad_medida) as unidad_medida, max( i.existencia) as existencia, 
                    max (cast (le.fecha_vence as DATE)) as caducidad, max(le.lote) as lote,
                    max(b.bodega) as bodega, max( e.empresa) as empresa, max( i.rowid) as row, 
                    max( i.costo_inicial) as costo_inical,
                    max( kd.costo_promedio) as promedio, max (kd.costo_total) as costo_total
                    from 
                    tb_inventario i inner join cat_producto p 
                        on i.codigo_producto = p.codigo_producto and i.codigo_categoria = p.codigo_categoria and i.codigo_subcategoria = p.codigo_subcategoria
                    inner join lotes_existencia le
                        on i.codigo_producto=le.codigo_producto and i.codigo_categoria=le.codigo_categoria and i.codigo_subcategoria=le.codigo_subcategoria
                    inner join cat_medida m
                        on m.codigo_medida = p.codigo_medida
                    inner join cat_empresa e
                        on e.codigo_empresa = i.codigo_empresa
                    inner join cat_bodega b
                        on b.codigo_bodega = i.codigo_bodega 
                    inner join dbo.tb_kardex as kd 
                        on i.codigo_producto = kd.codigo_producto and i.codigo_categoria = kd.codigo_categoria and i.codigo_subcategoria = kd.codigo_subcategoria
                    where p.activo=1 and convert(date,le.fecha_vence) <= EOMONTH( dateadd(month, 6,  getdate()) ) and le.existencia>0
                    group by p.codigo_categoria,p.codigo_subcategoria,p.codigo_producto 
                    order by caducidad";
    $results = $query($query_consulta);


$mensaje="<html>
<head>
  <title>Atención con los medicamentos a </title>
</head>
<body>
  <p>¡Todos los medicamentos descritos esta prontos a caducar y bajos en existencia!</p>
  <table>
    <tr>
      <th>Código</th><th>Medicina</th><th>Existencia</th><th>Fecha Vencimiento</th><th>Lote</th><th>Bodega</th>
    </tr>";
    
    while($row=$fetch_array($results)) { 
    $mensaje .="
    <tr>
    <td>{$row['codigo_producto']}</td>
    <td>{$row['producto']}</td>
    <td>{$row['existencia']}</td>
    <td>{$row['caducidad']}</td>
    <td>{$row['lote']}</td>
    <td>{$row['bodega']}</td>
    </tr>";
    }

$mensaje .= "</table>
</body>
</html>";
echo $mensaje;

$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// enviamos el correo!
//mail($para, $titulo, $mensaje, $cabeceras); */
?>