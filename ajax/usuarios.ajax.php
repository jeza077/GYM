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
        REVISAR PREGUNTAS DE SEGURIDAD
    =============================================*/
    public $validarPreguntas;

    public function ajaxValidarPreguntas(){

        $item = "respuesta";
        $valor = $this->validarPreguntas;
        
        $respuesta = ControladorUsuarios::ctrMostrarPreguntasPorUsuarios($item, $valor);

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
    REVISAR PREGUNTAS DE SEGURIDAD
=============================================*/
if(isset($_POST["validarPreguntas"])){
    $valPreguntas = new AjaxUsuarios();
    $valPreguntas->validarPreguntas = $_POST["validarPreguntas"];
    $valPreguntas->ajaxValidarPreguntas();
}