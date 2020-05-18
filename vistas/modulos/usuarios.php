<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar usuarios
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar usuarios</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">
          
          Agregar usuario

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-striped dt-responsive tablas">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Nombre</th>
           <th>Usuario</th>
           <th>Foto</th>
           <th>Perfil</th>
           <th>Estado</th>
           <th>Último login</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>
           
          <?php 
            $item = null;
            $valor = null;

            $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
            // var_dump($usuarios); PARA VER SI ESTA TRAYENDO EL RESULTADO DE LA BD.

            foreach ($usuarios as $key => $value) {
              // var_dump($value["nombre"]);

                echo ' <tr>
                          <td>'.($key+1).'</td>
                          <td>'.$value["nombre"].'</td>
                          <td>'.$value["usuario"].'</td>';

                          if($value["foto"] != ""){
                            echo '<td><img src="'.$value["foto"].'" class="img-thumbnail" width="40px"></td>';                     
                          } else {
                            echo '<td><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="40px"></td>';          
                          }
                         
                    echo '<td>'.$value["perfil"].'</td>';

                          if($value["estado"] != 0){
                            
                            echo '<td><button class="btn btn-success btn-xs btnActivar" idUsuario="'.$value["id"].'" estadoUsuario="0">Activado</button></td>';

                          } else {

                            echo '<td><button class="btn btn-danger btn-xs btnActivar" idUsuario="'.$value["id"].'" estadoUsuario="1">Desactivado</button></td>';
                          }
                          
                    
                    echo  '<td>'.$value["ultimo_login"].'</td>
                          <td>
              
                            
                                
                              <button class="btn btn-warning btnEditarUsuario" idUsuario="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarUsuario"><i class="fa fa-pencil"></i></button>
              
                              <button class="btn btn-danger btnEliminarUsuario" idUsuario="'.$value["id"].'" fotoUsuario="'.$value["foto"].'" usuario="'.$value["usuario"].'"><i class="fa fa-times"></i></button>
              
                            
              
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
<!-- ============================================================================================================================================================================== -->
  <!--=====================================
          MODAL AGREGAR USUARIO
  ======================================-->

<div id="modalAgregarUsuario" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#000; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar usuario</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar nombre" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL USUARIO -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoUsuario" id="nuevoUsuario" placeholder="Ingresar usuario" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA CONTRASEÑA -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-lock"></i></span> 

                <input type="password" class="form-control input-lg" id="nuevoPassword" name="nuevoPassword" placeholder="Ingresar contraseña" required>

              </div>

             </div>

              <!-- validar contraseña  -->
              <div id="con_info">
                <h4>La contraseña debe cumplir con los siguientes requerimientos:</h4>
                <ul>
                  <li id="letter">Al menos debe tener <strong>una letra</strong></li>
                  <li id="capital">Al menos debe tener <strong>una letra en mayuscula</strong></li>
                  <li id="number">Al menos debe tener <strong>un numero</strong></li>
                  <li id="special">Al menos debe tener <strong>un caracter especial</strong></li>
                  <li id="length">Al menos debe tener <strong>8 caracteres como minimo y 16 maximo</strong></li>
                </ul>
              </div>

            <!-- ENTRADA PARA SELECCIONAR SU PERFIL -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <select class="form-control input-lg" name="nuevoPerfil">
                  
                  <option value="">Selecionar perfil</option>

                  <option value="Administrador">Administrador</option>

                  <option value="Especial">Especial</option>

                  <option value="Vendedor">Vendedor</option>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">
              
              <div class="panel">SUBIR FOTO</div>

              <input type="file" class="nuevaFoto" name="nuevaFoto">

              <p class="help-block">Peso máximo de la foto 2MB</p>

              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar usuario</button>

        </div>

        <?php 

          $crearUsuario = new ControladorUsuarios();
          $crearUsuario->ctrCrearUsuario();

        ?>

      </form>

    </div>

  </div>

</div>

<!-- ============================================================================================================================================================================== -->
<!--=====================================
MODAL EDITAR USUARIO
======================================-->

<div id="modalEditarUsuario" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#000; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar usuario</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" value="" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL USUARIO -->

             <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                <input type="text" class="form-control input-lg" id="editarUsuario" name="editarUsuario" value="" readonly>

              </div>

            </div>

            <!-- ENTRADA PARA LA CONTRASEÑA -->

             <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-lock"></i></span>

                <input type="password" class="form-control input-lg" id="editPassword" name="editarPassword" placeholder="Escriba la nueva contraseña">

                <input type="hidden" id="passwordActual" name="passwordActual">

              </div>

            </div>

             <!-- validar contraseña  -->
              <div id="con_info_2">
                <h4>La contraseña debe cumplir con los siguientes requerimientos:</h4>
                <ul>
                  <li id="letter">Al menos debe tener <strong>una letra</strong></li>
                  <li id="capital">Al menos debe tener <strong>una letra en mayuscula</strong></li>
                  <li id="number">Al menos debe tener <strong>un numero</strong></li>
                  <li id="special">Al menos debe tener <strong>un caracter especial</strong></li>
                  <li id="length">Al menos debe tener <strong>8 caracteres como minimo y 16 maximo</strong></li>
                </ul>
              </div>

            <!-- ENTRADA PARA SELECCIONAR SU PERFIL -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-users"></i></span>

                <select class="form-control input-lg" name="editarPerfil">

                  <option value="" id="editarPerfil"></option>

                  <option value="Administrador">Administrador</option>

                  <option value="Especial">Especial</option>

                  <option value="Vendedor">Vendedor</option>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">

              <div class="panel">SUBIR FOTO</div>

              <input type="file" class="nuevaFoto" name="editarFoto">

              <p class="help-block">Peso máximo de la foto 2MB</p>

              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

              <input type="hidden" name="fotoActual" id="fotoActual">

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Modificar usuario</button>

        </div>

        <?php

          $editarUsuario = new ControladorUsuarios();
          $editarUsuario -> ctrEditarUsuario();

        ?>

      </form>

    </div>

  </div>

</div>

<?php

    $borrarUsuario = new ControladorUsuarios();
    $borrarUsuario -> ctrBorrarUsuario();

?>

