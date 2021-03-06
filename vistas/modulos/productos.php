<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar productos
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar productos</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-naranja" data-toggle="modal" data-target="#modalAgregarProducto">
          
          Agregar producto

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-striped dt-responsive tablaProductos" style="width:100%;">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Imagen</th>
           <th>Codigo</th>
           <th>Descripcion</th>
           <th>Categoria</th>
           <th>Stock</th>
           <th>Precio de compra</th>
           <th>Precio de venta</th>
           <th>Agregado</th>
           <th>Acciones</th>

         </tr> 

        </thead>        



       </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR PRODUCTO
======================================-->

<div id="modalAgregarProducto" class="modal fade" role="dialog">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#000; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar producto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

          <div class="row">
          <!-- ENTRADA PARA SELECCIONAR SU CATEGORIA -->

            <div class="form-group col-lg-6 col-xs-12">
                
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                  <select class="form-control input-lg" id="nuevaCategoria" name="nuevaCategoria" required>
                    
                      <option value="">Selecionar categoria</option>
                      <!-- Hacemos dinamico el selector de categorias  -->
                      <?php 
                        $item = null;
                        $valor = null;

                        $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                        foreach ($categorias as $key => $value) {
                           echo '<option value="'.$value["id"].'">'.$value["categoria"].'</option>';
                        }
                      ?>

                  </select>

                </div>

            </div>

            <!-- ENTRADA PARA EL CODIGO -->
            
            <div class="form-group col-lg-6 col-xs-12">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-code"></i></span> 

                <input type="text" class="form-control input-lg" id="nuevoCodigo" name="nuevoCodigo" placeholder="Codigo" readonly required>

              </div>

            </div>

          </div>

          
        
          <div class="row">
              <div class="form-group col-xs-12 col-lg-6">
              <!-- ENTRADA PARA EL DESCRIPCION -->
                
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 

                  <input type="text" class="form-control input-lg" name="nuevaDescripcion" placeholder="Ingresar descripcion" required>

                </div>

              </div>

            <!-- ENTRADA PARA EL STOCK -->
              <div class="form-group col-xs-12 col-lg-6">
                
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-check"></i></span> 

                  <input type="number" class="form-control input-lg" name="nuevoStock" min="0" placeholder="Stock" required>

                </div>

              </div>

          </div>


            <div class="form-group row" style="margin-bottom:0px;">
              <!-- ENTRADA PARA EL PRECIO DE COMPRA -->
              <div class="col-xs-6">
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 

                  <input type="number" class="form-control input-lg" id="nuevoPrecioCompra" name="nuevoPrecioCompra" min="0" required>

                </div>
              </div>

              <!-- ENTRADA PARA EL PRECIO DE VENTA -->
              <div class="col-xs-6">
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span> 

                    <input type="number" class="form-control input-lg" id="nuevoPrecioVenta" name="nuevoPrecioVenta" min="0" required>

                  </div>

                  <br>
                  <!-- CHECKBOX PARA PORCENTAJE  -->
                  <div class="col-xs-6">
                    <div class="form-group">
                      <label>
                        <input type="checkbox" class="minimal porcentaje" checked>
                        Utilizar porcentaje
                      </label>
                    </div>
                  </div>

                  <!-- ENTRADA PARA PORCENTAJE  -->
                  <div class="col-xs-6" style="padding:0">
                    <div class="input-group">
                        <input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="40" required>
                        <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                    </div>
                  </div>

              </div>
            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">
              
              <div class="panel">SUBIR IMAGEN</div>

              <input type="file" class="nuevaImagen" name="nuevaImagen">

              <p class="help-block">Peso máximo de la imagen 2MB</p>

              <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

            
            </div>

          </div>

        </div>  

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-naranja">Guardar producto</button>

        </div>
        <?php 
      
          $crearProducto = new ControladorProductos();
          $crearProducto->ctrCrearProducto();

        ?>
      </form>


    </div>

  </div>

</div>


<!--=====================================
MODAL EDITAR PRODUCTO
======================================-->

<div id="modalEditarProducto" class="modal fade" role="dialog">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#000; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar producto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

          <div class="row">
          <!-- ENTRADA PARA SELECCIONAR SU CATEGORIA -->

            <div class="form-group col-lg-6 col-xs-12">
                
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                  <select class="form-control input-lg" name="editarCategoria" readonly required>
                    
                      <option id="editarCategoria"></option>

                  </select>

                </div>

            </div>

            <!-- ENTRADA PARA EL CODIGO -->
            
            <div class="form-group col-lg-6 col-xs-12">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-code"></i></span> 

                <input type="text" class="form-control input-lg" id="editarCodigo" name="editarCodigo" readonly required>

              </div>

            </div>
            
          </div>


          <div class="row">
            <!-- ENTRADA PARA EL DESCRIPCION -->

            <div class="form-group col-xs-12 col-lg-6">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 

                <input type="text" class="form-control input-lg" id="editarDescripcion" name="editarDescripcion" required>

              </div>

            </div>


            <!-- ENTRADA PARA EL STOCK -->

            <div class="form-group col-xs-12 col-lg-6">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-check"></i></span> 

                <input type="number" class="form-control input-lg" id="editarStock" name="editarStock" min="0" required>

              </div>

            </div>
            
          </div>

            <div class="form-group row" style="margin-bottom:0px;">
              <!-- ENTRADA PARA EL PRECIO DE COMPRA -->
              <div class="col-xs-6">
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 

                  <input type="number" class="form-control input-lg" id="editarPrecioCompra" name="editarPrecioCompra" min="0" required>

                </div>
              </div>

              <!-- ENTRADA PARA EL PRECIO DE VENTA -->
              <div class="col-xs-6">
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span> 

                    <input type="number" class="form-control input-lg" id="editarPrecioVenta" name="editarPrecioVenta" min="0" placeholder="Precio de venta" readonly required>

                  </div>

                  <br>
                  <!-- CHECKBOX PARA PORCENTAJE  -->
                  <div class="col-xs-6">
                    <div class="form-group">
                      <label>
                        <input type="checkbox" class="minimal porcentaje" checked>
                        Utilizar porcentaje
                      </label>
                    </div>
                  </div>

                  <!-- ENTRADA PARA PORCENTAJE  -->
                  <div class="col-xs-6" style="padding:0">
                    <div class="input-group">
                        <input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="40" required>
                        <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                    </div>
                  </div>

              </div>
            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">
              
              <div class="panel">SUBIR IMAGEN</div>

              <input type="file" class="nuevaImagen" name="editarImagen">

              <p class="help-block">Peso máximo de la imagen 2MB</p>

              <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

              <input type="hidden" name="imagenActual" id="imagenActual">

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-naranja">Guardar cambios</button>

        </div>
     
      </form>

      <?php 
      
          $editarProducto = new ControladorProductos();
          $editarProducto->ctrEditarProducto();

      ?>
    </div>

  </div>

</div>
<?php

  $eliminarProducto = new ControladorProductos();
  $eliminarProducto -> ctrEliminarProducto();

?>