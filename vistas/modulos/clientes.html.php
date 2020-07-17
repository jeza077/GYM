<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar clientes
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar clientes</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCliente">
          Agregar Cliente 
        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Nombre</th>
           <th>ID</th>
           <th>Email</th>
           <th>Teléfono</th>
           <th>Dirección</th>
           <th>Fecha Nacimiento</th>
           <th>Total compras</th>
           <th>Última compra</th>
           <th>Ingreso al sistema</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>
          
          <tr>
            <td>1</td>
            <td>Juan Zuniga</td>
            <td>0801195509358</td>
            <td>juan@gmail.com</td>
            <td>8899 4511</td>
            <td>Valle de angeles calle 8 casa#7</td>
            <td>1955-15-12</td>  
            <td>35</td>
            <td>2020-01-05 14:08:36</td>
            <td>2020-01-02 12:05:32</td>

            <td>
                <div class="btn-group">
                    
                  <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>

                  <button class="btn btn-danger"><i class="fa fa-times"></i></button>

                </div>  
            </td>
          </tr>

        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR CLIENTE
======================================-->

<div id="modalAgregarCliente" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#000; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar cliente</h4>

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
                        <input type="text" class="form-control input-lg" name="nuevoCliente" placeholder="Ingresar nombre" required>

                    </div>

              </div>

              <!-- ENTRADA PARA LA IDENTIDAD -->
              
              <div class="form-group">
                  
                  <div class="input-group">
                    
                      <span class="input-group-addon"><i class="fa fa-key"></i></span> 
                      <input type="number" min="0" class="form-control input-lg" name="nuevoIdentidad" placeholder="Ingresar identidad" required>

                  </div>

            </div>

            <!-- ENTRADA PARA EL EMAIL -->
              
            <div class="form-group">
                  
                  <div class="input-group">
                    
                      <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 
                      <input type="email" class="form-control input-lg" name="nuevoEmail" placeholder="Ingresar email" required>

                  </div>

            </div>

            <!-- ENTRADA PARA EL TELEFONO -->
              
            <div class="form-group">
                  
                  <div class="input-group">
                    
                      <span class="input-group-addon"><i class="fa fa-phone"></i></span> 
                      <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar teléfono" data-inputmask="'mask': '(999) 9999-9999'" data-mask required>

                  </div>

            </div>

             <!-- ENTRADA PARA LA DIRECCION -->
              
             <div class="form-group">
                  
                  <div class="input-group">
                    
                      <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 
                      <input type="text" class="form-control input-lg" name="nuevaDireccion" placeholder="Ingresar dirección" required>

                  </div>

            </div>

            <!-- ENTRADA PARA LA FECHA DE NACIMIENTO -->
              
            <div class="form-group">
                  
                  <div class="input-group">
                    
                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 
                      <input type="text" class="form-control input-lg" name="nuevaFechaNacimiento" placeholder="Ingresar fecha nacimiento" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask required>

                  </div>

            </div>

            </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cliente</button>

        </div>

      </form>

    </div>

  </div>

</div>


