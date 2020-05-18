<?php

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

class AjaxCategorias{

    /*=============================================
        REVISAR QUE LA CATEGORIA NO SE REPITA
    =============================================*/
    public $validarCategoria;

    public function ajaxValidarCategoria(){

        $item = "categoria";
        $valor = $this->validarCategoria;
        
        $respuesta = ControladorCategorias::ctrMostrarCategorias($item, $valor);

        echo json_encode($respuesta);
    }

    /*=============================================
                EDITAR CATEGORIA
    =============================================*/

    public $idCategoria;

    public function ajaxEditarCategoria(){
        $item = "id";
        $valor = $this->idCategoria;
        $respuesta = ControladorCategorias::ctrMostrarCategorias($item, $valor);

        echo json_encode($respuesta);

    }
}

/*=============================================
    REVISAR QUE LA CATEGORIA NO SE REPITA
=============================================*/
if(isset($_POST["validarCategoria"])){
    $valCategoria = new AjaxCategorias();
    $valCategoria->validarCategoria = $_POST["validarCategoria"];
    $valCategoria->ajaxValidarCategoria();
}

/*=============================================
            EDITAR USUARIO
=============================================*/
if(isset($_POST["idCategoria"])){
    $editar = new AjaxCategorias();
    $editar->idCategoria = $_POST["idCategoria"];
    $editar->ajaxEditarCategoria();
}