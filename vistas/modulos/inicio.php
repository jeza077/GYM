<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Tablero
      
      <small>Panel de Control</small>
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Tablero</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="row">
    
      <?php 
      
        include "inicio/cajas-superiores.php";
      
      ?>
    
    </div>

    <div class="row">
    
      <div class="col-lg-12">
      
        <?php 
              
          include "reportes/grafico-ventas.php";
        
        ?>

      </div>

      <div class="col-lg-6">
          
        <?php 
          
          include "reportes/productos-mas-vendidos.php";
          
        ?>

      </div>

      <div class="col-lg-6">
          
        <?php 
          
          include "inicio/productos-recientes.php";
          
        ?>

      </div>
    
    </div>

  </section>

</div>
