
/* ==========================
     VALIDAR USUARIO 
 ========================= */

$("#nuevoUsuario").focus(function() { 
    $(".alert").remove();

    var nuevoUsuario = $(this).val()

    if(nuevoUsuario == "" ||nuevoUsuario.match(/[a-z]/)) {

        $("#nuevoUsuario").parent().after('<div class="alert alert-warning">Usuario debe ir en Mayuscula</div>');

    } else {
        if(nuevoUsuario.match(/[A-Z]/)){
            
            $(".alert").remove();

        }

    }

})


/* ==========================
     VALIDAR CONTRASEÑA 
 ========================= */
$("#nuevoPassword").keyup(function() { 
    var nuevoPassword = $("#nuevoPassword").val();   

    //validar longitud
    if(nuevoPassword.length < 8){
        $(".length").removeClass('valid').addClass('invalid');
    }else if(nuevoPassword.length > 16) {
        $(".length").removeClass('valid').addClass('invalid');
    } else {
        $(".length").removeClass('invalid').addClass('valid');
    }

    //validar que tenga una letra
    if(nuevoPassword.match(/[A-z]/)){
        $(".letter").removeClass('invalid').addClass('valid');
    } else {
        $(".letter").removeClass('valid').addClass('invalid');
    }

    //validar que tenga una letra Mayuscula
    if(nuevoPassword.match(/[A-Z]/)){
        $(".capital").removeClass('invalid').addClass('valid');
    } else {
        $(".capital").removeClass('valid').addClass('invalid');
    }

    //validar que tenga un numero
    if(nuevoPassword.match(/\d/)){
        $(".number").removeClass('invalid').addClass('valid');
    } else {
        $(".number").removeClass('valid').addClass('invalid');
    }

     //validar que tenga un caracter especial
     if(nuevoPassword.match(/[!@#$&*.,]/)){
        $(".special").removeClass('invalid').addClass('valid');
    } else {
        $(".special").removeClass('valid').addClass('invalid');
    }
}).focus(function() {  
    $(".con_info").show();
}).blur(function() { 
    $(".con_info").hide();
});


// function editarPassword(){  

//     var mayus = new RegExp("^(?=.*[A-Z])"); 
//     var especial = new RegExp("^(?=.*[!@#$&*.,])");
//     var numero = new RegExp("^(?=.*[0-9])");
//     var minus = new RegExp("^(?=.*[a-z])"); 
//     var long = new RegExp("^(?=.{8,})");

//     $("#editPassword").keyup(function() { 
//         var editPassword = $("#editPassword").val();
//         // console.log(editPassword);

//        if(mayus.test(editPassword) && especial.test(editPassword) && numero.test(editPassword) && minus.test(editPassword) && long.text(editPassword)){
//             $(".length.letter.capital.number.special").removeClass('valid').addClass('invalid');
//        } else {
//         $(".length.letter.capital.number.special").removeClass('invalid').addClass('valid');
//        }
// });
// }

$("#editPassword").keyup(function() { 
    var editPassword = $("#editPassword").val();
    // console.log(editPassword);

    //validar longitud
    if(editPassword < 8){
        $(".length").removeClass('valid').addClass('invalid');
    }else if(editPassword.length > 16) {
        $(".length").removeClass('valid').addClass('invalid');
    } else {
        $(".length").removeClass('invalid').addClass('valid');
    }

    //validar que tenga una letra
    if(editPassword.match(/[A-z]/)){
        $(".letter").removeClass('invalid').addClass('valid');
    } else {
        $(".letter").removeClass('valid').addClass('invalid');
    }

    //validar que tenga una letra Mayuscula
    if(editPassword.match(/[A-Z]/)){
        $(".capital").removeClass('invalid').addClass('valid');
    } else {
        $(".capital").removeClass('valid').addClass('invalid');
    }

    //validar que tenga un numero
    if(editPassword.match(/\d/)){
        $(".number").removeClass('invalid').addClass('valid');
    } else {
        $(".number").removeClass('valid').addClass('invalid');
    }

    //validar que tenga un caracter especial
    if(editPassword.match(/[!@#$&*.,]/)){
        $(".special").removeClass('invalid').addClass('valid');
    } else {
        $(".special").removeClass('valid').addClass('invalid');
    }
}).focus(function() {  
    $(".con_info").show();
}).blur(function() { 
    $(".con_info").hide();
});
