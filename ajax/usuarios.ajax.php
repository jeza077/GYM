<?php
 
require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

class AjaxUsuarios{
    /*=============================================
                EDITAR USUARIO
    =============================================*/

    public $idUsuario;

    public function ajaxEditarUsuarios(){
        $item = "id";
        $valor = $this->idUsuario;
        $respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

        echo json_encode($respuesta);

    }

    /*=============================================
                ACTIVAR USUARIO
    =============================================*/

    public $activarUsuario;
    public $activarId; 

    public function ajaxActivarUsuario(){

        $tabla = "usuarios";

        $item1 = "estado";
        $valor1 = $this->activarUsuario;

        $item2 = "id";
        $valor2 = $this->activarId;
      
        $respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);

    }

    /*=============================================
    REVISAR QUE EL USUARIO NO SE REPITA
    =============================================*/
    
    public $validarUsuario;

    public function ajaxValidarUsuario(){

        $item = "usuario";
        $valor = $this->validarUsuario;
        
        $respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

        echo json_encode($respuesta);
    }
    /*=============================================
            REVISAR CORREO
    =============================================*/
    
    public $verificarEmail;

    public function ajaxVerificarEmail(){

        $item = "correo";
        $valor = $this->verificarEmail;
        
        $respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

        echo json_encode($respuesta);
    }

    /*=============================================
    MOSTRAR PREGUNTAS DE SEGURIDAD DEL USUARIO
    =============================================*/
    
    public $email;

    public function ajaxMostrarPreguntas(){

        $item = "correo";
        $valor = $this->email;
        
        $respuesta = ControladorUsuarios::ctrMostrarPreguntas($item, $valor);

        echo json_encode($respuesta);
    }

    /*=============================================
            CAMBIAR CONTRASEÑA
    =============================================*/
    public $usuarioId;
    public $cambiarPass;

    public function ajaxCambiarContraseña(){

        // $tabla = "usuarios";

        $post = $this->cambiarPass;

        $item = "id";
        $valor = $this->usuarioId;
      
        $respuesta = ControladorUsuarios::ctrCambiarContraseña($item, $valor, $post);

        echo json_encode($respuesta);

    }
    

}

/*=============================================
            EDITAR USUARIO
=============================================*/
if(isset($_POST["idUsuario"])){
    $editar = new AjaxUsuarios();
    $editar->idUsuario = $_POST["idUsuario"];
    $editar->ajaxEditarUsuarios();
}

/*=============================================
            ACTIVAR USUARIO
=============================================*/
if(isset($_POST["activarUsuario"])){
    $activarUsuario = new AjaxUsuarios();
    $activarUsuario->activarUsuario = $_POST["activarUsuario"];
    $activarUsuario->activarId = $_POST["activarId"];
    $activarUsuario->ajaxActivarUsuario();
}

/*=============================================
    REVISAR QUE EL USUARIO NO SE REPITA
=============================================*/
if(isset($_POST["validarUsuario"])){
    $valUsuario = new AjaxUsuarios();
    $valUsuario->validarUsuario = $_POST["validarUsuario"];
    $valUsuario->ajaxValidarUsuario();
}

/*=============================================
    REVISAR CORREO
=============================================*/
if(isset($_POST["verificarEmail"])){
    $valUsuario = new AjaxUsuarios();
    $valUsuario->verificarEmail = $_POST["verificarEmail"];
    $valUsuario->ajaxVerificarEmail();
}

/*=============================================
 MOSTRAR PREGUNTAS DE SEGURIDAD DEL USUARIO
=============================================*/
if(isset($_POST["email"])){
    $valUsuario = new AjaxUsuarios();
    $valUsuario->email = $_POST["email"];
    $valUsuario->ajaxMostrarPreguntas();
}
/*=============================================
           CAMBIAR CONTRASEÑA
=============================================*/
if(isset($_POST["usuarioId"])){
    $cambiarContraseña = new AjaxUsuarios();
    $cambiarContraseña->usuarioId = $_POST["usuarioId"];
    $cambiarContraseña->cambiarPass = $_POST["cambiarPass"];
    $cambiarContraseña->ajaxCambiarContraseña();
}