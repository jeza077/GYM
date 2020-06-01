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

            date_default_timezone_set('America/Tegucigalpa');

            $fecha = date('Y-m-d');
            $hora = date('H:i:s');
            $valor1b = $fecha.' '.$hora;

            $fechaCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1b, $valor1b, $valor);

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

				localStorage.removeItem("rango");

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

            //--REVISAR SI VIENE PRODUCTOS EDITADOS--//

                //-> $cambioProducto = false; -->>Para determinar si se cambio algo en los productos.

            if($_POST["listaProductos"] == ""){

                $listaProductos = $traerVenta["productos"];
                $cambioProducto = false;

            } else {

                $listaProductos = $_POST["listaProductos"];
                $cambioProducto = true;

            }

            if($cambioProducto){

                $productos = json_decode($traerVenta["productos"], true);

                $totalProductosComprados = array();

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

                $comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valorCliente);


                //----Actualizar compras del cliente y Reducir el Stock y Aumentar las Ventas de los Productos---//
                $listaProductos_2 = json_decode($listaProductos, true);

                $totalProductosComprados_2 = array();

                foreach ($listaProductos_2 as $key => $value) {

                    array_push($totalProductosComprados_2, $value["cantidad"]);
                    
                    $tablaProductos_2 = "productos";
                    $item_2 = "id";
                    $valor_2 = $value["id"];

                    $traerProducto_2 = ModeloProductos::mdlMostrarProductos($tablaProductos_2, $item_2, $valor_2);
                    
                    $item1a_2 = "ventas";
                    $valor1a_2 = $value["cantidad"] + $traerProducto_2["ventas"];

                    $nuevasVentas_2 = ModeloProductos::mdlActualizarProducto($tablaProductos_2, $item1a_2, $valor1a_2, $valor_2);

                    $item1b_2 = "stock";
                    $valor1b_2 = $traerProducto_2["stock"] - $value["cantidad"];

                    $nuevoStock_2 = ModeloProductos::mdlActualizarProducto($tablaProductos_2, $item1b_2, $valor1b_2, $valor_2);
                }

                $tablaClientes_2 = "clientes";

                $item_2 = "id";
                $valor_2 = $_POST["seleccionarCliente"];

                $traerCliente_2 = ModeloClientes::mdlMostrarClientes($tablaClientes_2, $item_2, $valor_2);


                $item1a_2 = "compras";
                $valor1a_2 = array_sum($totalProductosComprados_2) + $traerCliente_2["compras"];

                $comprasCliente_2 = ModeloClientes::mdlActualizarCliente($tablaClientes_2, $item1a_2, $valor1a_2, $valor_2);

                $item1b_2 = "ultima_compra";

                date_default_timezone_set('America/Tegucigalpa');

                $fecha = date('Y-m-d');
                $hora = date('H:i:s');
                $valor1b_2 = $fecha.' '.$hora;

                $fechaCliente_2 = ModeloClientes::mdlActualizarCliente($tablaClientes_2, $item1b_2, $valor1b_2, $valor_2);
            }

            //----GUARDAR CAMBIOS DE LA COMPRA ---//

            $datos = array("id_vendedor"=>$_POST["idVendedor"],
                           "id_cliente"=>$_POST["seleccionarCliente"],
                           "codigo"=>$_POST["editarVenta"],
                           "productos"=>$listaProductos,
                           "impuesto"=>$_POST["nuevoPrecioImpuesto"],
                           "neto"=>$_POST["nuevoPrecioNeto"],
                           "total"=>$_POST["totalVenta"],
                           "metodo_pago"=>$_POST["listaMetodoPago"]);


            $respuesta = ModeloVentas::mdlEditarVentas($tabla, $datos);
            if($respuesta == "ok"){
                echo '<script>

                localStorage.removeItem("rango");

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

    /*=============================================
	            ELIMINAR VENTA
	=============================================*/

	static public function ctrEliminarVenta(){

		if(isset($_GET["idVenta"])){

			$tabla = "ventas";

			$item = "id";
			$valor = $_GET["idVenta"];

			$traerVenta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

			/*=============================================
			ACTUALIZAR FECHA ÚLTIMA COMPRA
			=============================================*/

			$tablaClientes = "clientes";

			$itemVentas = null;
			$valorVentas = null;

			$traerVentas = ModeloVentas::mdlMostrarVentas($tabla, $itemVentas, $valorVentas);

			$guardarFechas = array();

			foreach ($traerVentas as $key => $value) {
				
				if($value["id_cliente"] == $traerVenta["id_cliente"]){

					array_push($guardarFechas, $value["fecha"]);

				}

            }
            // var_dump($guardarFechas);

			if(count($guardarFechas) > 1){

				if($traerVenta["fecha"] > $guardarFechas[count($guardarFechas)-2]){

					$item = "ultima_compra";
					$valor = $guardarFechas[count($guardarFechas)-2];
					$valorIdCliente = $traerVenta["id_cliente"];

					$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);

				}else{

					$item = "ultima_compra";
					$valor = $guardarFechas[count($guardarFechas)-1];
					$valorIdCliente = $traerVenta["id_cliente"];

					$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);

				}


			}else{

				$item = "ultima_compra";
				$valor = "0000-00-00 00:00:00";
				$valorIdCliente = $traerVenta["id_cliente"];

				$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);

			}

			/*=============================================
			FORMATEAR TABLA DE PRODUCTOS Y LA DE CLIENTES
			=============================================*/

			$productos =  json_decode($traerVenta["productos"], true);

			$totalProductosComprados = array();

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
			$valorCliente = $traerVenta["id_cliente"];

			$traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $itemCliente, $valorCliente);

			$item1a = "compras";
			$valor1a = $traerCliente["compras"] - array_sum($totalProductosComprados);

			$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valorCliente);

			/*=============================================
			        ELIMINAR VENTA
			=============================================*/

			$respuesta = ModeloVentas::mdlEliminarVenta($tabla, $_GET["idVenta"]);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "La venta ha sido borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then((result) => {
								if (result.value) {

								window.location = "ventas";

								}
							})

				</script>';

			}		
		}

	}

 
}
