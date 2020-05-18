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
            "defaultContent":'<div class="btn-group"><button class="btn btn-primary agregarProducto" idProducto">Agregar</button></div>'

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
