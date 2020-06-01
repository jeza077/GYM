/*=============================================
                EDITAR CLIENTES
=============================================*/
$(".tablas").on("click", ".btnEditarCliente", function(){ 
 
    var idCliente = $(this).attr("idCliente");
    // console.log("idCliente", idCliente); 

    var datos = new FormData();
    datos.append("idCliente", idCliente);

    $.ajax({

        url:"ajax/clientes.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,  
        dataType: "json",
        success: function(respuesta) {
            // console.log("respuesta", respuesta);

            //Mostramos el nombre de la Cliente seleccionada, en el input.
            $("#idCliente").val(respuesta["id"]);
            $("#editarCliente").val(respuesta["nombre"]);
            $("#editarIdentidad").val(respuesta["identidad"]);
            $("#editarEmail").val(respuesta["email"]);
            $("#editarTelefono").val(respuesta["telefono"]);
            $("#editarDireccion").val(respuesta["direccion"]);
            $("#editarFechaNacimiento").val(respuesta["fecha_nacimiento"]);



            
        }
    });
    
});
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
/*=============================================
             ELIMINAR CLIENTE
=============================================*/
$(".tablas").on("click", ".btnEliminarCliente", function() {  

    var idCliente = $(this).attr("idCliente");
    // console.log("idCliente", idCliente); 

    swal({
        type: "warning",
        title: "¿Esta seguro de borrar el cliente?",
        text: "¡Si no lo esta puede cancelar la accion!",
        showCancelButton: true,
        showConfirmButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Si, borrar cliente!",

    }).then((result)=>{

        if(result.value){

            window.location = "index.php?ruta=clientes&idCliente="+idCliente;

        }

    });

}); 