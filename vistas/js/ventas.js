   /*--=====================================
            CARGAR LA TABLA DINAMICA
    ======================================--*/
var table2 = $('.tablaVentas').DataTable({

    "ajax":"ajax/datatable-ventas.ajax.php",
    "columnDefs": [
        {

            "targets": -5,
            "data": null,
            "defaultContent":'<img class="img-thumbnail imgTablaVenta" width="40px"</img>'

        },

        {

            "targets": -2,
            "data": null,
            "defaultContent":'<div class="btn-group"><button class="btn btn-success limiteStock"></button></div>'

        },

        {

            "targets": -1,
            "data": null,
            "defaultContent":'<div class="btn-group"><button class="btn btn-primary agregarProducto recuperarBoton" idProducto">Agregar</button></div>'

        }
    ],
    
    "language": {

        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Buscar:",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }

    } 

})

/*--===========================================
ACTIVAR LOS BOTONES CON LOS ID CORRESPONDIENTES
============================================--*/

$('.tablaVentas tbody').on('click', 'button.agregarProducto', function() {  

    var data = table2.row($(this).parents('tr')).data();
    // console.log(data);  

    $(this).attr("idProducto", data[5]);

});

/*--===========================================
        FUNCION PARA CARGAR LAS IMAGENES
============================================--*/
function cargarImagenesProductos(){

    var imgTabla = $('.imgTablaVenta');

    var limiteStock = $('.limiteStock');

    for(var i = 0; i < imgTabla.length; i++){

        var data = table2.row($(imgTabla[i]).parents('tr')).data();
        // console.log(data); 

        $(imgTabla[i]).attr("src", data[1]);

        // stock 
        if(data[4] <= 10){
            $(limiteStock[i]).addClass("btn-danger");
            $(limiteStock[i]).html(data[4]);

        } else if(data[4] > 11 && data[4] <= 15){
            $(limiteStock[i]).addClass("btn-warning");
            $(limiteStock[i]).html(data[4]);

        } else {
            $(limiteStock[i]).addClass("btn-success");
            $(limiteStock[i]).html(data[4]);

        }

    }
}

/*CARGAMOS LAS IMAGENES CUANDO ENTRAMOS A LA PAGINA POR PRIMERA VEZ*/
setTimeout(function() {
    
   cargarImagenesProductos();

}, 300);

/*CARGAMOS LAS IMAGENES CUANDO INTERACTUAMOS CON EL PAGINADOR*/
$(".dataTables_paginate").click(function() { 
    cargarImagenesProductos();
});
 
/*CARGAMOS LAS IMAGENES CUANDO INTERACTUAMOS CON EL BUSCADOR*/
$("input[aria-controls='DataTables_Table_0']").focus(function() {  
    $(document).keyup(function(e){  
        e.preventDefault();
        cargarImagenesProductos();
    })
})

/*CARGAMOS LAS IMAGENES CUANDO INTERACTUAMOS CON EL FILTRO DE CANTIDAD*/
$("select[name='DataTables_Table_0_length']").change(function(){
    cargarImagenesProductos();
})

/*CARGAMOS LAS IMAGENES CUANDO INTERACTUAMOS CON EL FILTRO DE ORDENAR*/
$(".sorting").click(function(){
    cargarImagenesProductos();
})

/*--===========================================
  AGREGAR PRODUCTOS A LA VENTA DESDE LA TABLA
============================================--*/
$(".tablaVentas tbody").on("click", "button.agregarProducto", function(){  
    var idProducto = $(this).attr("idProducto");

    $(this).removeClass("btn-primary agregarProducto");
    $(this).addClass("btn-default");

    var datos = new FormData();
    datos.append("idProducto", idProducto);

    $.ajax({
        url: "ajax/productos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            // console.log("respuesta", respuesta) // Miramos que productos nos trae con todos sus datos

            var descripcion = respuesta["descripcion"];
            var stock = respuesta["stock"];
            var precio = respuesta["precio_venta"];

            $(".nuevoProducto").append(
            
            '<div class="row" style="padding:5px 15px">' +             

                '<!-- Descripción del producto -->' +
                    
                '<div class="col-xs-6" style="padding-right:0px">' +
                
                    '<div class="input-group">' +
                        
                        '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'+idProducto+'"><i class="fa fa-times"></i></button></span>' +

                        '<input type="text" class="form-control agregarProducto" name="agregarProducto" value="'+descripcion+'" readonly required>' +

                    '</div>' +

                '</div>' +

                '<!-- Cantidad del producto -->' +

                '<div class="col-xs-3">' +
                
                    '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock="'+stock+'" required>' +

                '</div>' + 

                '<!-- Precio del producto -->' +

                '<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">' +

                    '<div class="input-group">' +

                        '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>' +
                        
                        '<input type="text" class="form-control nuevoPrecioProducto" precioReal="'+precio+'" name="nuevoPrecioProducto" value="'+precio+'" readonly required>' +
        
                    '</div>' +
                
                '</div>' +
            
            '</div>'
            
            );

            //Sumar Total de Precios
            sumarTotalPrecios();

            //Agregar Impuesto
            agregarImpuesto();

            //Poner Formato al Precio de los Productos
            $(".nuevoPrecioProducto").number(true, 2);
        }
            
    });
});

/*--===========================================
QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTON
============================================--*/
$(".formularioVenta").on("click", "button.quitarProducto", function(){  
     
    $(this).parent().parent().parent().parent().remove();

    var idProducto = $(this).attr("idProducto");
    $("button.recuperarBoton[idProducto='"+idProducto+"']").removeClass("btn-default");
    $("button.recuperarBoton[idProducto='"+idProducto+"']").addClass("btn-primary agregarProducto");

    if($(".nuevoProducto").children().length == 0){

        $("#nuevoTotalVenta").val(0);
        $("#nuevoImpuestoVenta").val(0);
        $("#nuevoTotalVenta").attr("total", 0);


    } else {

        //Sumar Total de Precios
        sumarTotalPrecios();

        //Agregar Impuesto
        agregarImpuesto();
    }

    
});

/*--=================================================
AGREGANDO PRODUCTOS DESDE EL BOTON PARA DISPOSITIVOS
=================================================--*/
$(".btnAgregarProducto").click(function() { 

    var datos = new FormData();
    datos.append("traerProductos", "ok");

    $.ajax({
        url: "ajax/productos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {

            $(".nuevoProducto").append(
            
                '<div class="row" style="padding:5px 15px">' +             
    
                    '<!-- Descripción del producto -->' +
                        
                    '<div class="col-xs-6" style="padding-right:0px">' +
                    
                        '<div class="input-group">' +
                            
                            '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto><i class="fa fa-times"></i></button></span>' +
    
                            '<select class="form-control nuevaDescripcionProducto" idProducto name="nuevaDescripcionProducto" required>' +

                                '<option>Seleccione el producto</option>' +

                            '</select>' +
    
                        '</div>' +
    
                    '</div>' +
    
                    '<!-- Cantidad del producto -->' +
    
                    '<div class="col-xs-3 ingresoCantidad">' +
                    
                        '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock required>' +
    
                    '</div>' + 
    
                    '<!-- Precio del producto -->' +
    
                    '<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">' +
    
                        '<div class="input-group">' +
    
                            '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>' +
                            
                            '<input type="text" class="form-control nuevoPrecioProducto" precioReal="" name="nuevoPrecioProducto" readonly required>' +
            
                        '</div>' +
                    
                    '</div>' +
                
                '</div>'
            );

            //Agregar los productos al Select

            respuesta.forEach(funcionForEach);

            function funcionForEach(item, index){  
                $(".nuevaDescripcionProducto").append(

                    '<option idProducto="'+item.id+'" value="'+item.descripcion+'">'+item.descripcion+'</option>'

                )
            }

            //Sumar Total de Precios
            sumarTotalPrecios();

            //Agregar Impuesto
            agregarImpuesto();

            //Poner Formato al Precio de los Productos
            $(".nuevoPrecioProducto").number(true, 2);
           
        }

    });   

});

/*--=================================================
            SELECCIONAR PRODUCTO    
=================================================--*/
$(".formularioVenta").on("change", "select.nuevaDescripcionProducto", function(){  
    
    var nombreProducto = $(this).val();

    var nuevoPrecioProducto =$(this).parent().parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");
    var nuevaCantidadProducto =$(this).parent().parent().parent().children(".ingresoCantidad").children(".nuevaCantidadProducto");

    var datos = new FormData();
    datos.append("nombreProducto", nombreProducto);

    $.ajax({
        url: "ajax/productos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta){
        
           $(nuevaCantidadProducto).attr("stock", respuesta["stock"]);
           $(nuevoPrecioProducto).val(respuesta["precio_venta"]);
           $(nuevoPrecioProducto).attr("precioReal", respuesta["precio_venta"]);

        }
    })    
});

/*--=================================================
            MODIFICAR CANTIDAD 
=================================================--*/
$(".formularioVenta").on("change", "input.nuevaCantidadProducto", function(){ 

    var precio = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");
    
    var precioFinal = $(this).val() * precio.attr("precioReal");

    precio.val(precioFinal);  

    if(Number($(this).val()) > Number($(this).attr("stock"))){

        $(this).val(1);

        swal({		
            type: "error",
            title: "¡La cantidad supera al Stock!",
            text: "¡Solo hay "+$(this).attr("stock")+" unidades!",
            confirmButtonText: "Cerrar"
        });
    }

        //Sumar Total de Precios
        sumarTotalPrecios();

        //Agregar Impuesto
        agregarImpuesto();

});

/*--=================================================
            SUMAR TODOS LOS PRECIOS
=================================================--*/
function sumarTotalPrecios(){  

    var precioItem = $(".nuevoPrecioProducto");
    var arraySumaPrecio = [];

    for (let i = 0; i < precioItem.length; i++) {
        
        arraySumaPrecio.push(Number($(precioItem[i]).val()));
    }
 
    function sumaArrayPrecios(total, numero){
        return total + numero;
    }
    
    var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);

    $("#nuevoTotalVenta").val(sumaTotalPrecio);
    $("#nuevoTotalVenta").attr("total", sumaTotalPrecio);

}

/*--=================================================
        FUNCION AGREGAR IMPUESTO
=================================================--*/
function agregarImpuesto(){
    
    var impuesto = $("#nuevoImpuestoVenta").val();
    var precioTotal = $("#nuevoTotalVenta").attr("total");

    var precioImpuesto = Number(precioTotal * impuesto/100);

    var totalConImpuesto = Number(precioImpuesto) + Number(precioTotal);

    $("#nuevoTotalVenta").val(totalConImpuesto);

    $("#nuevoPrecioImpuesto").val(precioImpuesto);

    $("#nuevoPrecioNeto").val(precioTotal);

}

/*--=================================================
        CUANDO CAMBIA EL IMPUESTO
=================================================--*/
$("#nuevoImpuestoVenta").change(function() { 
    
    agregarImpuesto(); 
    
});

/*--=================================================
        PONER FORMATO AL PRECIO FINAL
=================================================--*/
$("#nuevoTotalVenta").number(true, 2);

//------------------------------------------------------------------------------------------------------------------------------------------------------------------------
/*--=================================================
        SELLECIONAR METODO DE PAGO
=================================================--*/
$("#nuevoMetodoPago").change(function(){

    var metodo = $(this).val();

    if(metodo == "Efectivo"){

        $(this).parent().parent().removeClass("col-xs-6");
        $(this).parent().parent().addClass("col-xs-4");

        $(this).parent().parent().parent().children(".cajasMetodoPago").html(
            
            '<div class="col-xs-4">' +
                
                '<div class="input-group">' +
                            
                    '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>' +

                    '<input type="text" class="form-control nuevoValorEfectivo" placeholder="00000000"  required>' +

                '</div>' +

            '</div>' +

            '<div class="col-xs-4 capturarCambioEfectivo" style="padding-left:0px">' +
                
                '<div class="input-group">' +
                            
                    '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>' +

                    '<input type="text" class="form-control nuevoCambioEfectivo" name="nuevoCambioEfectivo" placeholder="00000000" readonly required>' +

                '</div>' +

            '</div>' 
        
        );

        //Poner Formato al Precio 
        $(".nuevoValorEfectivo").number(true, 2);
        $(".nuevoCambioEfectivo").number(true, 2);
           
    } else {

        $(this).parent().parent().removeClass("col-xs-4");
        $(this).parent().parent().addClass("col-xs-6");

        $(this).parent().parent().parent().children(".cajasMetodoPago").html(
            
            '<div class="col-xs-6" style="padding-left:0px">' +
                        
                '<div class="input-group">' +
                        
                    '<input type="text" class="form-control" id="nuevoCodigoTransaccion" name="nuevoCodigoTransaccion" placeholder="Código transacción"  required>' +
                        
                    '<span class="input-group-addon"><i class="fa fa-lock"></i></span>' +
                    
                '</div>' +

            '</div>'
        
        )
        

    }

});

/*--=================================================
            CAMBIO EN EFECTIVO
=================================================--*/
$(".formularioVenta").on("change", "input.nuevoValorEfectivo", function(){

    var efectivo = $(this).val();

    var cambio = Number(efectivo) - Number($('#nuevoTotalVenta').val());

    var nuevoCambioEfectivo = $(this).parent().parent().parent().children('.capturarCambioEfectivo').children().children('.nuevoCambioEfectivo');

    nuevoCambioEfectivo.val(cambio);
})
