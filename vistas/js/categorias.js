/*=============================================
    REVISAR QUE LA CATEGORIA NO SE REPITA
=============================================*/
$("#nuevaCategoria").change(function() { 

    $(".alert").remove();

    var categoria = $(this).val();

    var datos = new FormData();
    datos.append("validarCategoria", categoria);

    $.ajax({

        url:"ajax/categorias.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,  
        dataType: "json",
        success: function(respuesta) {
            // console.log(respuesta);

            if(respuesta) {//Si la Respuesta = false entonces...
                //Mandamos una alerta diciendo que ya existe el usuario.
                $("#nuevaCategoria").parent().after('<div class="alert alert-warning">Esta categoria ya existe</div>');
               
                //E inmeditamente Limpiamos el input
                $("#nuevaCategoria").val("");
            } 
        }
  
    })
    
});

/*=============================================
                EDITAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEditarCategoria", function() {  
    var idCategoria = $(this).attr("idCategoria");
    // console.log("idCategoria", idCategoria); 

    var datos = new FormData();
    datos.append("idCategoria", idCategoria);

    $.ajax({

        url:"ajax/categorias.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,  
        dataType: "json",
        success: function(respuesta) {
            // console.log("respuesta", respuesta);

            //Mostramos el nombre de la categoria seleccionada, en el input.
            $("#editarCategoria").val(respuesta["categoria"]);
            $("#idCategoria").val(respuesta["id"]);

            
        }
    });
    
});
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
/*=============================================
                ELIMINAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEliminarCategoria", function() {  

    var idCategoria = $(this).attr("idCategoria");

    swal({
        type: "warning",
        title: "¿Esta seguro de borrar la categoria?",
        text: "¡Si no lo esta puede cancelar la accion!",
        showCancelButton: true,
        showConfirmButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Si, borrar categoria!",

    }).then((result)=>{

        if(result.value){

            window.location = "index.php?ruta=categorias&idCategoria="+idCategoria;

        }

    });

});