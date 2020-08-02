/*LOGIN PREVENIR RECARGAR */
$(".verificarCorreo").on("click", function (event) {
	event.preventDefault();
});
$(".verificarPreguntas").on("click", function (event) {
	event.preventDefault();
});

function toggelQuestions(){
    var container = document.querySelector('.login-box');
    container.classList.toggle('quest')
}


//VERIFICAR SI EL CORREO ESTA ASOCIADO A UN USUARIO
$("#verificarEmail").change(function() { 

    $(".alert").remove();

    var verificarEmail = $(this).val();

    // console.log(verificarEmail);

    var datos = new FormData();
    datos.append("verificarEmail", verificarEmail);

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

            if(!respuesta) {//Si la Respuesta = TRUE entonces...
                //Mandamos una alerta diciendo que ya existe el usuario.
                $("#verificarEmail").after('<div class="alert alert-danger">Correo inexistente</div>');
               
                //E inmeditamente Limpiamos el input
                $("#verificarEmail").val("");
            } else {
                $("#verificarEmail").val("");
                toggelQuestions();
            }
        }
  
    })
    
});