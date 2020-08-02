/*LOGIN PREVENIR RECARGAR */
$(".verificarCorreo").on("click", function (event) {
	event.preventDefault();
});

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
            console.log(respuesta);
            
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
                            
                            $("#preguntaSeguridad").append("<label>" + respuesta[i][1] + "</label>");
                            $("#preguntaSeguridad").append("<input type='text' class='form-control respuestaPregunta' placeholder='Agrega la respuesta' required>")
                        
                            var respuestaPregunta = respuesta[i][2];
                            console.log(respuestaPregunta);
    
                            $("#verificarPreguntas").on("click", function (event) {
                                event.preventDefault();
                            
                                var respuestaPreguntaAgregada = $(".respuestaPregunta").val();
                            
                                if(respuestaPregunta === respuestaPreguntaAgregada){
                                    console.log("CORRECTO");
                                } else {
                                    console.log("mal");
                                }
                            });
                        }
                        
                      
                        

                    }
                })

            }
        }
        
    })
    
});

// juan@correo.com


