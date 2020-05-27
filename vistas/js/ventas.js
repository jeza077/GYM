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

                        '<input type="text" class="form-control" id="agregarProducto" name="agregarProducto" value="'+descripcion+'" readonly required>' +

                    '</div>' +

                '</div>' +

                '<!-- Cantidad del producto -->' +

                '<div class="col-xs-3">' +
                
                    '<input type="number" class="form-control" id="nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock="'+stock+'" required>' +

                '</div>' + 

                '<!-- Precio del producto -->' +

                '<div class="col-xs-3" style="padding-left:0px">' +

                    '<div class="input-group">' +

                        '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>' +
                        
                        '<input type="number" min="1" class="form-control" id="nuevoPrecioProducto" name="nuevoPrecioProducto" value="'+precio+'" readonly required>' +
        
                    '</div>' +
                
                '</div>' +
            
            '</div>'
            
            );

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

});



