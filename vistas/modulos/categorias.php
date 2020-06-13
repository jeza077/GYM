<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar categorias
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar categorias</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-naranja" data-toggle="modal" data-target="#modalAgregarCategoria">
          Agregar categoria 
        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" style="width:100%;">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Categoria</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>
          
          <?php 

              $item = null;
              $valor = null;

              $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);
              // var_dump($categorias);

              //Recorremos todas las categorias existentes para mostrarlas en la tabla.
              foreach ($categorias as $key => $value) {

                echo '<tr>
                        <td>'.($key+1).'</td>
                        <td class="text-uppercase">'.$value["categoria"].'</td>
                        <td>
                            <div class="btn-group">
                                
                              <button class="btn btn-warning btnEditarCategoria" idCategoria="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarCategoria"><i class="fa fa-pencil"></i></button>
            
                              <button class="btn btn-danger btnEliminarCategoria" idCategoria="'.$value["id"].'"><i class="fa fa-times"></i></button>
            
                            </div>  
                        </td>
                      </tr>';
              }

          ?>
          


        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
      MODAL AGREGAR CATEGORIA
======================================-->

<div id="modalAgregarCategoria" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#000; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar categoria</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

            <div class="box-body">

                <!-- ENTRADA PARA EL NOMBRE -->
              
                <div class="form-group">
                  
                    <div class="input-group">
                      
                        <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                        <input type="text" class="form-control input-lg" id="nuevaCategoria" name="nuevaCategoria" placeholder="Ingresar categoria" required>

                    </div>

              </div>

            </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-naranja">Guardar categoria</button>

        </div>

        <!-- Llamado del metodo para crear una nueva categoria -->
        <?php

           $crearCategoria = new ControladorCategorias();
           $crearCategoria->ctrCrearCategoria();

        ?>

      </form>

    </div>

  </div>

</div>
 <!-- ================================================================================================================================================================================================ -->
<!--=====================================
      MODAL EDITAR CATEGORIA
======================================-->

<div id="modalEditarCategoria" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#000; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar categoria</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

            <div class="box-body">

                <!-- ENTRADA PARA EL NOMBRE -->
              
                <div class="form-group">
                  
                    <div class="input-group">
                      
                        <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                        <input type="text" class="form-control input-lg" id="editarCategoria" name="editarCategoria" required>
                        <input type="hidden" name="idCategoria" id="idCategoria">

                    </div>

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

       <!-- Llamado del metodo para editar una categoria -->
        <?php

           $editarCategoria = new ControladorCategorias();
           $editarCategoria->ctrEditarCategoria();

        ?>

      </form>

    </div>

  </div>

</div>

  <!-- Llamado del metodo para borrar una categoria -->
        <?php

           $borrarCategoria = new ControladorCategorias();
           $borrarCategoria->ctrBorrarCategoria();

        ?>