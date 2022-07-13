
<script language="javascript">
    
    
    function suma() {
        var valores = 1;
        var total = 0;
        while (valores < contLin4) {
            var num1 = String(document.getElementById(['bienx[' + valores + '][3]']).value);
            if (num1 == undefined) num1 = 0;
            var num2 = String(document.getElementById(['costo_unitario[' + valores + ']']).value);
            if (num2 == undefined) num2 = 0;
            document.getElementById(['precio_total[' + valores + ']']).value = num1 * num2;
            document.getElementById(['precio_total1[' + valores + ']']).value = num1 * num2;
            total = total + document.getElementById(['precio_total1[' + valores + ']']).value();
            document.getElementById('#PTotal').value = num1 * num2;
            document.getElementById('PTotal').value = total;
            valores++;
        }
    }
</script>
<?php
session_start();
//require("../includes/funciones.php");
require("../includes/sqlcommand.inc");
conectardb($almacen);
$_SESSION["ingreso"] = true;
?>
<head>
    <style type="text/css">
        body {
            background-color: #CCCCCC !important;
        }
        .negrox{
            background: black;
            color: white;
        }
        .table-producto-ingreso{
              width: 90%;
        }
        
    </style>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8_spanish_ci"/>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <script type="text/javascript" src="bootstrap/css/formatoMiles.js"></script>
    <link rel="stylesheet" href="css/table_producto.css">
</head>
<body>


<div class=" mt-5">

    <table class="table table-producto-ingreso" id="tabla4">
        <thead>
        <tr>
            <th >No.</th>
            <th class="title_input ">Buscar</th>
            <th class="title_input">Categoria</th>
            <th class="title_input">Sub-Categoria</th>
            <th class="title_input">Codigo</th>
            <th class="title_input">Renglon</th>
            <th class="title_input_product">Producto</th>
            <th class="">Buscar</th>
            <th class="title_input">Lote</th>
            <th class="title_input">Fecha Vencimiento</th>
            <th class="title_input">Cantidad Ingresada</th>
            <th class="title_input">Precio Unitario</th>
            <th class="title_input">Precio Total</th>
           
            <th class="title_input">Eliminar</th>
            <th class="title_input negrox">&Sigma;</th>
            <th class="title_input negrox" id="sumatoria"></th>
        </tr>
        </thead>
        <tbody>

        </tbody>

    </table>

</div>

<br>

<input name="Bot&oacute;n" type="button" class="btn boton grey" onClick="addRow()" value="Agregar l&iacute;nea">
<input id="bt_del" class="btn boton grey" type="button" value="Eliminar">
<input type="hidden" id="cantidad_filas" name="cantidad_filas" >


</body>

<script type="text/javascript">
    $(document).on('click','.buscaprod',function(){       
            var texto = $(this).attr("id");
            var no = texto.substring(6,7);
            var nolinea= parseInt(no,10);
            console.log(nolinea);
            var catx = document.getElementById("bien["+nolinea+"][2]").value;
            var subcatx = document.getElementById("bien["+nolinea+"][3]").value;
            var codprodx = document.getElementById("bien["+nolinea+"][1]").value;
            //onClick=\"buscar=window.open(\'LoteIngreso.php?bd=&cat=&codp=&tipo=bien&posi=" + cont + "\',\'Buscar4\',\'width=700,height=500,menubar=no, scrollbars=yes,toolbar=no,location=no,directories=no,resizable=no,top=150,left=1100\'); return false;\" >...</a></span></td><input name=\"bienx[" + cont + "][11]\" type=\"hidden\" id=\"bienx[" + cont + "][11]\"  size=\"7\" class=\"monto form-control input_center\" 
            window.open('LoteIngreso.php?cat='+catx+'&subcat='+subcatx+'&codp='+codprodx+'&tipo=bien&posi='+nolinea+'&tipox=bienx','Buscar4','width=700,height=500,menubar=no, scrollbars=yes,toolbar=no,location=no,directories=no,resizable=no,top=150,left=1100');
            
            //var id = $(this).attr("id");
           
    });
    
    $(document).ready(function () {

        $('#bt_del').click(function () {
            
            eliminar(id_fila_selected);
        });

    });


    var cont = 0;
    var id_fila_selected = [];
    var contLin4 = 1;
    var PTotal = 0;
    var total = 0;
    var valor = 0;
    var resta = 0;
    var id_f = "";

    function addRow() {
        cont++;

        var fila = "<tr class=\"selected\" id=\"fila" + cont + "\" >";
        fila += "<td id=\"cantidad\">" + cont + "</td>"
        fila += "<td class=\"input_center\" ><a  href=\"javascript:void(0)\" onClick=\"buscar=window.open(\'productoIngreso.php?tipo=bien&posi=" + cont + "\',\'Buscar4\',\'width=700,height=500,menubar=no, scrollbars=yes,toolbar=no,location=no,directories=no,resizable=no,top=100,left=250\'); return false;\" ><i class=\"fa fa-search\" aria-hidden=\"true\"></i></a></td>"
        fila += "<td><input name=\"bien[" + cont + "][2]\" type=\"text\" id=\"bien[" + cont + "][2]\" size=\"5%\" class=\"form-control input_center\"  ></td>"
        fila += "<td><input name=\"bien[" + cont + "][3]\" type=\"text\" id=\"bien[" + cont + "][3]\" size=\"5%\" class=\"form-control input_center\" ></td>"
        fila += "<td><input name=\"bien[" + cont + "][1]\" type=\"text\" id=\"bien[" + cont + "][1]\" size=\"5%\" class=\"form-control input_center\"></td>"
        fila += "<td><input name=\"bien[" + cont + "][5]\" type=\"text\" id=\"bien[" + cont + "][5]\" size=\"5%\" class=\"form-control input_center\"></td>"
        fila += "<td><input name=\"bien[" + cont + "][7]\" type=\"text\" id=\"bien[" + cont + "][7]\" size=\"4%\" class=\"form-control\" > </td>"


        fila += "<td><span class=\"buscaprod\" id=\"blote="+ cont + "\" name=\"blote="+ cont +" \"> <i class=\"fa fa-search\" aria-hidden=\"true\"></i> </span></td>"
        //lote de la medicina
        fila += "<td><input name=\"bienx[" + cont + "][1]\" type=\"text\" id=\"bienx[" + cont + "][1]\"  size=\"7\" class=\"monto form-control input_center\" disabled></td>"
        //fecha caducindad medicina
        fila += "<td><input name=\"bienx[" + cont + "][2]\" type=\"date\" id=\"bienx[" + cont + "][2]\"  size=\"7\" class=\"monto form-control input_center\" disabled></td>"     
        //cantidad de medicina ingresada
        fila += "<td><input name=\"bienx[" + cont + "][3]\" type=\"text\" id=\"bienx[" + cont + "][3]\"  size=\"7\" class=\"monto form-control input_center\" disabled></td>"
        //fin fecha caducindad medicina
        fila += "<td><input class=\"monto form-control input_center\"  name=\"costo_unitario[" + cont + "]\" type=\"text\" id=\"costo_unitario[" + cont + "]\"   size=\"7\"></td>"
        fila += "<td><input name=\"precio_total[" + cont + "]\" type=\"text\" id=\"precio_total[" + cont + "]\"  size=\"20\"  class=\"totalizar form-control input_center\" ></td>"
        fila += "<td id=\"fila" + cont + "\" onclick=\"seleccionarFila(id, 'check" + cont + "');\" ><input id=\"check" + cont + "\" type=\"checkbox\" name=\"transporte\" class=\"form-check\" >Eliminar</td>"
        fila += "<td><input name=\"precio_total1[" + cont + "]\" type=\"hidden\" id=\"precio_total1[" + cont + "]\" size=\"7\" style=\"display:block\" ></td>"
        fila += "<td><input name=\"bien[" + cont + "][4]\" type=\"hidden\" id=\"bien[" + cont + "][4]\"  size=\"7\" style=\"display:block\"></td>"
        //nueva celda lote oculto
        fila += "<td><input name=\"bienx["+ cont +"][11]\" type=\"hidden\" id=\"bienx["+ cont +"][11]\" size=\"10\" class=\"monto form-control input_center\"></td>"
        //nueva celda fecha caducidad oculta
        fila += "<td><input name=\"bienx["+ cont +"][21]\" type=\"hidden\" id=\"bienx["+ cont +"][21]\" size=\"10\" class=\"monto form-control input_center\"></td>"
        //nueva celda cantidad ingresada oculta
        fila += "<td><input name=\"bienx["+ cont +"][31]\" type=\"hidden\" id=\"bienx["+ cont +"][31]\" size=\"10\" class=\"monto form-control input_center\"></td>"


        fila += "</tr>";
        $('#tabla4').append(fila);
        setCantidad(cont);
        reordenar();
    };

    function setCantidad(cont){
        document.getElementById("cantidad_filas").value = cont;
    }

    function SumaTotal(fila) {

        console.log("suma");
        //valor = $(this).find('td').eq(1).find('input').attr("id","bien["+num+"][1]")
        valor = String(document.getElementById(['precio_total1[' + fila + ']']).value);
        //valor = String($(this).value);
        total += parseInt(valor);
    };

    function RestaTotal(fila) {
        valor = String(document.getElementById(['precio_total1[' + fila + ']']).value);
        total -= parseInt(valor);
    }


    function removeItemFromArr(arr, item) {
        var i = arr.indexOf(item);
        if (i != -1) {
            arr.splice(i, 1)
        }
    };

    function seleccionarFila(fila, chk) {
        id_f = fila.substr(4, 1);
        if (document.getElementById(fila).className == "seleccionada") {
            document.getElementById(fila).className = "original";
            document.getElementById(chk).checked = false;
            removeItemFromArr(id_fila_selected, fila);
            var u = String(document.getElementById(['precio_total1[' + id_f + ']']).value);
            console.log(u);
            resta = resta - parseInt(u);


        } else {
            document.getElementById(fila).className = "seleccionada";
            document.getElementById(chk).checked = true;
            id_fila_selected.push(fila);
            var u = String(document.getElementById(['precio_total1[' + id_f + ']']).value);
            resta = resta + parseInt(u);

            //$(this).find('td').eq(8)//codigo
            //}

            //valor = String(document.getElementById(fila).find('td').eq(8).value);
            //TotalMenos.push(valor);
            //alert(TotalMenos);


        }
    };

    function suma(fila) {



        var num1 = String(document.getElementById(['bienx[' + fila + '][3]']).value);
        var num2 = String(document.getElementById(['costo_unitario[' + fila + ']']).value);
        document.getElementById(['precio_total[' + fila + ']']).value = num1 * num2;
        document.getElementById(['precio_total1[' + fila + ']']).value = num1 * num2;
        // PTotal = PTotal + (num1 * num2);
        // document.getElementById('PTotal').value = "Q " + new Intl.NumberFormat("en-IN").format(PTotal - resta);
        $total= 0
        $elementos= $(".totalizar");
        $elementos.each( function(){
        $total += parseFloat( $( this ).val() ) || 0;
            //console.log($total);
        });
        $("#sumatoria").text(  $total.toString());


    }

    function seleccionar(id_fila) {

        if ($('#' + id_fila).hasClass('seleccionada')) {
            $('#' + id_fila).removeClass('seleccionada');
            alert($(this).find('td').eq(8).find('input').value());
        } else {
            $('#' + id_fila).addClass('seleccionada');
            alert($(this).find('td').eq(8).find('input').value());
        }
        //2702id_fila_selected=id_fila;
        id_fila_selected.push(id_fila);
    };


    function reordenar() {
        var num = 1;
        $('#tabla4 tbody tr').each(function () {
        
            $(this).find('td').eq(1).find('a').attr("onClick", "buscar=window.open('productoIngreso.php?tipo=bien&posi=" + num + "','Buscar4','width=700,height=500,menubar=no, scrollbars=yes,toolbar=no,location=no,directories=no,resizable=no,top=100,left=250'); return false;");
          
            $(this).find('td').eq(2).find('input').attr("id", "bien[" + num + "][2]");//categoria
            $(this).find('td').eq(2).find('input').attr("name", "bien[" + num + "][2]");//categoria

            $(this).find('td').eq(3).find('input').attr("id", "bien[" + num + "][3]");//subcategoria
            $(this).find('td').eq(3).find('input').attr("name", "bien[" + num + "][3]");//subcategoria

            $(this).find('td').eq(4).find('input').attr("id", "bien[" + num + "][1]");//codigo producto
            $(this).find('td').eq(4).find('input').attr("name", "bien[" + num + "][1]");//codigo producto

            $(this).find('td').eq(5).find('input').attr("id", "bien[" + num + "][5]");//renglon
            $(this).find('td').eq(5).find('input').attr("name", "bien[" + num + "][5]");//renglon
           
            $(this).find('td').eq(6).find('input').attr("id", "bien[" + num + "][7]");//producto
            $(this).find('td').eq(6).find('input').attr("name", "bien[" + num + "][7]");//producto

            $(this).find('td').eq(7).find('span').attr("id","blote=" + num + "")//buscar lote
            $(this).find('td').eq(7).find('span').attr("name","blote=" + num + "")//buscar lote

            $(this).find('td').eq(8).find('input').attr("id", "bienx[" + num + "][1]");//lote del producto
            $(this).find('td').eq(8).find('input').attr("name", "bienx[" + num + "][1]");//lote del producto

            $(this).find('td').eq(9).find('input').attr("id", "bienx[" + num + "][2]");//fecha de vencimiento
            $(this).find('td').eq(9).find('input').attr("name", "bienx[" + num + "][2]");//fecha de vencimiento            
           

            $(this).find('td').eq(10).find('input').attr("id", "bienx[" + num + "][3]");//cantidad ingresada
            $(this).find('td').eq(10).find('input').attr("name", "bienx[" + num + "][3]");//cantidad ingresada
            $(this).find('td').eq(10).find('input').attr("onblur", "suma(" + num + ");");


            $(this).find('td').eq(11).find('input').attr("id", "costo_unitario[" + num + "]");//precio unitario
            $(this).find('td').eq(11).find('input').attr("name", "costo_unitario[" + num + "]");//precio unitario
            $(this).find('td').eq(11).find('input').attr("onblur", "suma(" + num + ");");


            $(this).find('td').eq(12).find('input').attr("id", "precio_total[" + num + "]");//precio total
            $(this).find('td').eq(12).find('input').attr("name", "precio_total[" + num + "]");//precio total


            $(this).find('td').eq(13).attr("onclick", "seleccionarFila(id, 'check" + num + "');");//check eliminar
            $(this).find('td').eq(13).attr("id", "fila" + num + "");//check eliminar
            $(this).find('td').eq(13).find('input').attr("id", "check" + num + "");//check eliminar


            $(this).find('td').eq(14).find('input').attr("id", "precio_total1[" + num + "]");//precio total oculto
            $(this).find('td').eq(14).find('input').attr("name", "precio_total1[" + num + "]");//precio total oculto

            $(this).find('td').eq(15).find('input').attr("id", "bien[" + num + "][4]");//cod producto oculto
            $(this).find('td').eq(15).find('input').attr("name", "bien[" + num + "][4]");//cod producto oculto

            $(this).find('td').eq(16).find('input').attr("id", "bienx["+ num +"][11]");//lote oculto
            $(this).find('td').eq(16).find('input').attr("name", "bienx["+ num +"][11]");//lote oculto

            $(this).find('td').eq(17).find('input').attr("id", "bienx["+ num +"][21]");//fecha oculta
            $(this).find('td').eq(17).find('input').attr("name", "bienx["+ num +"][21]");//fecha oculta
           
            $(this).find('td').eq(18).find('input').attr("id", "bienx["+ num +"][31]");//cantidad oculta
            $(this).find('td').eq(18).find('input').attr("name", "bienx["+ num +"][31]");//cantidad oculta


            $(this).find('td').eq(19).find('span').attr("id","nolinea"+ num +"")//cambio de linea del span
            $(this).find('td').eq(19).find('span').attr("name","nolinea"+ num +"")//cambio de linea del span
            


            $(this).attr("id", "fila" + num + "");
            $(this).find('td').eq(0).text(num);


            
            num++;
            document.getElementById("cantidad_filas").value = num -1 ;
            
        });

    
    };


    function getNumero(){

        $valor_actual = document.getElementById("cantidad_filas").value;

        $valor_nuevo = $valor_actual - 1;

        document.getElementById("cantidad_filas").value = $valor_nuevo

    }


    function eliminar(id_fila) {
        // $('#fila'+id_fila).remove();
        for (var i = 0; i <= id_fila.length; i++) {
            $('#' + id_fila[i]).remove();
        }
        PTotal = PTotal - resta;
        // document.getElementById('PTotal').value = "Q " + new Intl.NumberFormat("en-IN").format(PTotal);
        getNumero();
        reordenar();

        resta = 0;
        id_fila_selected = [];


        // document.getElementById("cantidad_filas").value = id_fila;
        
    };


</script>
</html>