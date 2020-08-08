/*LOGIN PREVENIR RECARGAR */
$(".verificarCorreo").on("click", function (event) {
	event.preventDefault();
});

//FUNCION PARA PASAR A VERIFICAR EL EMAIL
function toggelForm(){
    var container = document.querySelector('.login-box');
    container.classList.toggle('active')
}

//FUNCION PARA PASAR A LAS PREGUNTAS DE SEGURIDAD
function toggelQuestions(){
    var container = document.querySelector('.login-box');
    container.classList.toggle('quest')
}

//FUNCION PARA PASAR A CAMBIAR LA CONTRASEÑA
function toggelPassword(){
    var container = document.querySelector('.login-box');
    container.classList.toggle('changePassword')
}


//VERIFICAR SI EL CORREO ESTA ASOCIADO A UN USUARIO
$("#verificarEmail").change(function() { 
    
    $(".alert").remove();
    
    var emailIngresado = $(this).val();

    // console.log(emailIngresado);
    
    var datos = new FormData();
    datos.append("verificarEmail", emailIngresado);

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
            
            idUsuario = respuesta.id; //<----- ID PARA CAMBIAR EL PASSWORD//
            // console.log(idUsuario)

            if(!respuesta) {//Si la Respuesta = FALSE entonces...
                //Mandamos una alerta diciendo que ya existe el usuario.
                $("#verificarEmail").after('<div class="alert alert-danger">Correo inexistente</div>');
                
                //E inmeditamente Limpiamos el input
                $("#verificarEmail").val("");
                
            } else { //SI LA RESPUESTA ES TRUE ENTONCES...
                
                // TRAEMOS LAS RESPUESTAS DE SEGURIDAD

                $("#verificarEmail").val("");
                toggelQuestions();
                
                var datos = new FormData();
                datos.append("email", emailIngresado);
                
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

                        
                        for(var i in respuesta){
                            // console.log(respuesta[i][2]);
                            $("#preguntaSeguridad").append("<label>" + respuesta[i]['pregunta'] + "</label>");
                            $("#preguntaSeguridad").append("<input type='text' class='form-control respuestaPregunta' placeholder='Agrega la respuesta' required>")
                        }

                        //CONVERTIMOS LAS RESPUESTAS DEL USUARIO QUE VIENEN DE LA BASE DE DATOS, EN UN ARRAY
                            var respuestasRegistradas = respuesta.map(function(respuestasRegistrada){
                                return respuestasRegistrada.respuesta; 
                            })
                            
                            // console.log(respuestasRegistradas);
                        

                            // VERIFICAMOS SI LAS RESPUESTAS INGRESADAS CON LAS YA REGISTRADAS COINCIDEN
                                $("#verificarPreguntas").on("click", function (event) {
                                    event.preventDefault();
                                
                                    //CONVERTIMOS LAS RESPUESTAS QUE INGRESO EL USUARIO EN UN ARRAY
                                        var respuestasIngresadas = new Array();
                                        var respuestaPreguntaAgregada = $('.respuestaPregunta'), 
                                        namesValues = [].map.call(respuestaPreguntaAgregada, function(respuestaPregunta){  
                                            respuestasIngresadas.push(respuestaPregunta.value);
                                        });

                                        // console.log(respuestasIngresadas);

                                        var preguntaString = respuestasIngresadas.toString();
                                        var respuestaString = respuestasRegistradas.toString();

                                        if(preguntaString == respuestaString){
                                            console.log("CORRECTO");
                                            toggelPassword();

                                            $("#cambiarPassword").prepend("<div class='form-group has-feedback'>",
                                                    "<input type='password' class='form-control' placeholder='Nueva contraseña' name='editarPassword' required>",
                                                    "<input type='password' class='form-control' id='confirmar_password' placeholder='Confirmar contraseña'>",
                                                    "<span class='help-block' id='resultado_password'></span>",
                                                    "<input type='hidden' id='passwordActual' name='passwordActual'>",
                                                "</div>",

                                                )

                                                //CAMBIAR CONTRASEÑA
                                                
                                                $("input[name='editarPassword']").on('change', function(){
                                                    cambiarPass = $(this).val();
                                                });
                                                $("#confirmar_password").on('input', function(){
                                                    // var password_nuevo = cambiarPass;
                                                    if($(this).val() == cambiarPass){
                                                        $('#resultado_password').text('Correcto');
                                                        $('#resultado_password').parents('.form-group').addClass('has-success').removeClass('has-error');
                                                        $("input[name='editarPassword']").parents('.form-group').addClass('has-success').removeClass('has-error');
                                                        // $('#crear_registro_admin').attr('disabled', false);  
                                                    } else {
                                                        $('#resultado_password').text('No son iguales');
                                                        $('#resultado_password').parents('.form-group').addClass('has-error').removeClass('has-success');
                                                        $("input[name='editarPassword']").parents('.form-group').addClass('has-error').removeClass('has-success');
                                                        // $('#crear_registro_admin').attr('disabled', true);
                                                    }
                                                })
                                                
                                                    $("#cambiarContraseña").on("click", function(event){  
                                                        event.preventDefault();
                                                        // console.log("clickkkk")

                                                        var datos = new FormData();
                                                        datos.append("usuarioId", idUsuario);
                                                        datos.append("cambiarPass", cambiarPass);

                                                        $.ajax({

                                                            url:"ajax/usuarios.ajax.php",
                                                            method: "POST",
                                                            data: datos,
                                                            cache: false,
                                                            contentType: false,
                                                            processData: false,  
                                                            dataType: "json",
                                                            success: function(respuesta) {
                                                                if(respuesta == 'ok'){
                                                                    swal({
                
                                                                        type: "success",
                                                                        title: "¡Contraseña cambiada correctamente!",
                                                                        showConfirmButton: true,
                                                                        confirmButtonText: "Cerrar",
                                                                        closeOnConfirm: false
                                                                    }).then((result)=>{
    
                                                                        if(result.value){
                                                
                                                                            toggelForm(); 
                                                                            toggelQuestions();
                                                                            toggelPassword();
                                                
                                                                        }
                                                
                                                                    });
                                                                }
                                                    
                                                            }
                                                    
                                                        })
                                                    })

                                        } else {
                                            swal({		
                                
                                                type: 'error',
                                                title: 'Respuestas no coinciden. Intente de nuevo.',
                                                showConfirmButton: false,
                                                timer: 2000
                                                })
                                            $("#preguntaSeguridad input[type='text']").val("");
                                            console.log("MAL");
                                        }
                                                                    
                                });
                        
                      
                        

                    }
                })

            }
        }
        
    })
    
});


