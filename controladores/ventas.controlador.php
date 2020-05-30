<?php

class ControladorVentas{

    /*=============================================
				MOSTRAR VENTAS	
	=============================================*/

    static public function ctrMostrarVentas($item, $valor){

        $tabla = "ventas";

        $respuesta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);
        return $respuesta;
    }

    /*=============================================
				CREAR VENTA	
	=============================================*/

    static public function ctrCrearVenta(){

        if(isset($_POST["nuevaVenta"])){

            //----Actualizar compras del cliente y Reducir el Stock y Aumentar las Ventas de los Productos---//
            $listaProductos = json_decode($_POST["listaProductos"], true);

            $totalProductosComprados = array();

            foreach ($listaProductos as $key => $value) {

                array_push($totalProductosComprados, $value["cantidad"]);
                
                $tablaProductos = "productos";
                $item = "id";
                $valor = $value["id"];

                $traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor);
                
                $item1a = "ventas";
                $valor1a = $value["cantidad"] + $traerProducto["ventas"];

                $nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

                $item1b = "stock";
                $valor1b = $value["stock"];

                $nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);
            }

            $tablaClientes = "clientes";

            $item = "id";
            $valor = $_POST["seleccionarCliente"];

            $traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $item, $valor);


            $item1a = "compras";
            $valor1a = array_sum($totalProductosComprados) + $traerCliente["compras"];

            $comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valor);

            $item1b = "ultima_compra";
            $fecha = date('Y-m-d');
            $hora = date('H:i:s');
            $valor1b = $fecha.' '.$hora;

            $comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1b, $valor1b, $valor);

            //----GUARDAR LA COMPRA ---//

            $tabla = "ventas";
            $datos = array("id_vendedor"=>$_POST["idVendedor"],
                           "id_cliente"=>$_POST["seleccionarCliente"],
                           "codigo"=>$_POST["nuevaVenta"],
                           "productos"=>$_POST["listaProductos"],
                           "impuesto"=>$_POST["nuevoPrecioImpuesto"],
                           "neto"=>$_POST["nuevoPrecioNeto"],
                           "total"=>$_POST["totalVenta"],
                           "metodo_pago"=>$_POST["listaMetodoPago"]);


            $respuesta = ModeloVentas::mdlIngresarVentas($tabla, $datos);
            if($respuesta == "ok"){
                echo '<script>

                swal({
                    
                    type: "success",
                    title: "¡La venta ha sido guardada correctamente!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                    }).then((result)=>{

                        if(result.value){

                            window.location = "ventas";

                        }

                    });


                    </script>';
            }

       
        }

    }

    /*=============================================
				EDITAR VENTA	
	=============================================*/

    static public function ctrEditarVenta(){

        if(isset($_POST["editarVenta"])){

            //-- FORMATEAR TABLA DE PRODUCTOS Y CLIENTES --//
            $tabla = "ventas";
            $item = "codigo";
            $valor = $_POST["editarVenta"];

            $traerVenta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

            $productos = json_decode($traerVenta["productos"], true);

            $totalProductosComprados = array();

            var_dump($productos);

            foreach ($productos as $key => $value) {
                
                array_push($totalProductosComprados, $value["cantidad"]);

                $tablaProductos = "productos";
                $item = "id";
                $valor = $value["id"];

                $traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor);

                $item1a = "ventas";
                $valor1a = $traerProducto["ventas"] - $value["cantidad"];

                $nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

                $item1b = "stock";
                $valor1b = $value["cantidad"] + $traerProducto["stock"];

                $nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);
            }

            $tablaClientes = "clientes";

            $itemCliente = "id";
            $valorCliente = $_POST["seleccionarCliente"];

            $traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $itemCliente, $valorCliente);

            $item1a = "compras";
            $valor1a = $traerCliente["compras"] - array_sum($totalProductosComprados);

            $comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valor);


            //----Actualizar compras del cliente y Reducir el Stock y Aumentar las Ventas de los Productos---//
            $listaProductos_2 = json_decode($_POST["listaProductos"], true);

            $totalProductosComprados_2 = array();

            foreach ($listaProductos_2 as $key => $value) {

                array_push($totalProductosComprados_2, $value["cantidad"]);
                
                $tablaProductos_2 = "productos";
                $item_2 = "id";
                $valor_2 = $value["id"];

                $traerProducto_2 = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor);
                
                $item1a_2 = "ventas";
                $valor1a_2 = $value["cantidad"] + $traerProducto["ventas"];

                $nuevasVentas_2 = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

                $item1b_2 = "stock";
                $valor1b_2 = $value["stock"];

                $nuevoStock_2 = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);
            }

            $tablaClientes_2 = "clientes";

            $item_2 = "id";
            $valor_2 = $_POST["seleccionarCliente"];

            $traerCliente_2 = ModeloClientes::mdlMostrarClientes($tablaClientes, $item, $valor);


            $item1a_2 = "compras";
            $valor1a_2 = array_sum($totalProductosComprados) + $traerCliente["compras"];

            $comprasCliente_2 = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valor);

            $item1b_2 = "ultima_compra";
            $fecha_2 = date('Y-m-d');
            $hora_2 = date('H:i:s');
            $valor1b_2 = $fecha.' '.$hora;

            $comprasCliente_2 = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1b, $valor1b, $valor);

            //----GUARDAR CAMBIOS DE LA COMPRA ---//

            $datos = array("id_vendedor"=>$_POST["idVendedor"],
                           "id_cliente"=>$_POST["seleccionarCliente"],
                           "codigo"=>$_POST["editarVenta"],
                           "productos"=>$_POST["listaProductos"],
                           "impuesto"=>$_POST["nuevoPrecioImpuesto"],
                           "neto"=>$_POST["nuevoPrecioNeto"],
                           "total"=>$_POST["totalVenta"],
                           "metodo_pago"=>$_POST["listaMetodoPago"]);


            $respuesta = ModeloVentas::mdlEditarVentas($tabla, $datos);
            if($respuesta == "ok"){
                echo '<script>

                swal({
                    
                    type: "success",
                    title: "¡La venta ha sido editada correctamente!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                    }).then((result)=>{

                        if(result.value){

                            window.location = "ventas";

                        }

                    });


                    </script>';
            }

       
        }

    }
}