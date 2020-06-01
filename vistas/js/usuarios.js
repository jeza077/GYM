/*=============================================
        SUBIENDO LA FOTO DEL USUARIO
=============================================*/
$(".nuevaFoto").change(function(){

    var imagen = this.files[0];
    // console.log("imagen", imagen);

    /*=============================================
    VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
    =============================================*/

    if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){
        $(".nuevaFoto").val("");
            swal({
                title: "Error al subir imagen",
                text: "¡La imagen debe estar en formato JPG o PNG!",
                type: "error",
                confirmButtonText: "Cerrar",
            });

    } else if(imagen["size"] > 2000000) {
         $(".nuevaFoto").val("");
            swal({
                title: "Error al subir imagen",
                text: "¡La imagen no debe pesar mas de 2MB!",
                type: "error",
                confirmButtonText: "Cerrar",
            });
            
    } else {
        var datosImagen = new FileReader;
        datosImagen.readAsDataURL(imagen);
        $(datosImagen).on("load", function (event) {
            var rutaImagen = event.target.result;

            $(".previsualizar").attr("src", rutaImagen);
        });
    }
})

/*=============================================
                EDITAR USUARIO
=============================================*/
$(".tablas").on("click",".btnEditarUsuario", function() {  
    var idUsuario = $(this).attr("idUsuario");
    // console.log("idUsuario", idUsuario); 

    var datos = new FormData();
    datos.append("idUsuario", idUsuario);

    $.ajax({

        url:"ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,  
        dataType: "json",
        success: function(respuesta) {
            // console.log("respuesta", respuesta);

            $("#editarNombre").val(respuesta["nombre"]);
            $("#editarUsuario").val(respuesta["usuario"]);
            $("#editarPerfil").html(respuesta["perfil"]);
            $("#editarPerfil").val(respuesta["perfil"]);//Si no cambio el perfil que se mantenga el que ya esta en la base de datos.
            $("#fotoActual").val(respuesta["foto"]);//Si no cambio la foto que se mantenga la que ya esta en la base de datos.

            $("#passwordActual").val(respuesta["password"]);//Si no cambio la contraseña que se mantenga la que ya esta en la base de datos.

            if(respuesta["foto"] != ""){
                $(".previsualizar").attr("src", respuesta["foto"]);
            }

        }
    });
    
})

/*=============================================
                ACTIVAR USUARIO
=============================================*/
$(".tablas").on("click", ".btnActivar", function() { 

    var idUsuario = $(this).attr("idUsuario");
    var estadoUsuario = $(this).attr("estadoUsuario");

    var datos = new FormData();
    datos.append("activarId", idUsuario);
    datos.append("activarUsuario", estadoUsuario);

    $.ajax({

        url:"ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,  
        dataType: "json",
        success: function(respuesta) {
            
        }
  
    })

    if(estadoUsuario == 0){
 
        $(this).removeClass('btn-success');
        $(this).addClass('btn-danger');
        $(this).html('Desactivado');
        $(this).attr('estadoUsuario', 1);

    } else {

        $(this).addClass('btn-success');
        $(this).removeClass('btn-danger');
        $(this).html('Activado');
        $(this).attr('estadoUsuario', 0);

    }
 
});

/*=============================================
    REVISAR QUE EL USUARIO NO SE REPITA
=============================================*/
$("#nuevoUsuario").change(function() { 

    $(".alert").remove();

    var usuario = $(this).val();

    var datos = new FormData();
    datos.append("validarUsuario", usuario);

    $.ajax({

        url:"ajax/usuarios.ajax.php",
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
                $("#nuevoUsuario").parent().after('<div class="alert alert-warning">Este usuario ya existe</div>');
               
                //E inmeditamente Limpiamos el input
                $("#nuevoUsuario").val("");
            } 
        }
  
    })
    
});

/*=============================================
                ELIMINAR USUARIO
=============================================*/
$(".tablas").on("click", ".btnEliminarUsuario", function() { 

    var idUsuario = $(this).attr("idUsuario");
    var fotoUsuario = $(this).attr("fotoUsuario");
    var usuario = $(this).attr("usuario");


    
    swal({
        type: "warning",
        title: "¿Esta seguro de borrar el usuario?",
        text: "¡Si no lo esta puede cancelar la accion!",
        showCancelButton: true,
        showConfirmButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Si, borrar usuario!",

    }).then((result)=>{

        if(result.value){

            window.location = "index.php?ruta=usuarios&idUsuario="+idUsuario+"&usuario="+usuario+"&fotoUsuario="+fotoUsuario;

        }

    });
});