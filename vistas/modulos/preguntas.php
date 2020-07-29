
<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Gym "La Roca"</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="icon" href="vistas/img/plantilla/gym.png">

   <!--=====================================
  PLUGINS DE CSS
  ======================================-->

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="vistas/bower_components/bootstrap/dist/css/bootstrap.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="vistas/bower_components/font-awesome/css/font-awesome.min.css">

  <!-- Ionicons -->
  <link rel="stylesheet" href="vistas/bower_components/Ionicons/css/ionicons.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="vistas/dist/css/AdminLTE.css">
  
  <!-- AdminLTE Skins -->
  <link rel="stylesheet" href="vistas/dist/css/skins/_all-skins.css">

  <!-- CSS propio -->
  <link rel="stylesheet" href="vistas/dist/css/main.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

   <!-- DataTables
  <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css"> -->

  <!-- DataTables -->
  <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/responsive.bootstrap4.min.css">


  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="vistas/plugins/iCheck/all.css">

  <!-- Daterange Picker -->
  <link rel="stylesheet" href="vistas/bower_components/bootstrap-daterangepicker/daterangepicker.css">

  <!-- Morris.css Chart -->
  <link rel="stylesheet" href="vistas/bower_components/morris.js/morris.css">




  <!--=====================================
  PLUGINS DE JAVASCRIPT
  ======================================-->

  <!-- jQuery 3 -->
  <script src="vistas/bower_components/jquery/dist/jquery.min.js"></script>
  
  <!-- Bootstrap 3.3.7 -->
  <script src="vistas/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

  <!-- FastClick -->
  <script src="vistas/bower_components/fastclick/lib/fastclick.js"></script>
  
  <!-- AdminLTE App -->
  <script src="vistas/dist/js/adminlte.min.js"></script>

  <!-- DataTables
  <script src="vistas/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script> -->

    <!-- DataTables -->
  <script src="vistas/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/dataTables.bootstrap4.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/responsive.bootstrap4.min.js"></script>
  
  <!-- SweetAlert 2 -->
  <script src="vistas/plugins/sweetalert2/sweetalert2.all.js"></script>

  <!-- iCheck 1.0.1 -->
  <script src="vistas/plugins/iCheck/icheck.min.js"></script>

  <!-- InputMask -->
  <script src="vistas/plugins/input-mask/jquery.inputmask.js"></script>
  <script src="vistas/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="vistas/plugins/input-mask/jquery.inputmask.extensions.js"></script>

  <!-- jQuery Number -->
  <script src="vistas/plugins/jqueryNumber/jqueryNumber.min.js"></script>

  <!-- Daterange Picker -->
  <script src="vistas/bower_components/moment/min/moment.min.js"></script>
  <script src="vistas/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script> 

  <!-- Morris.js Chart -->
  <script src="vistas/bower_components/raphael/raphael.min.js"></script>
  <script src="vistas/bower_components/morris.js//morris.min.js"></script> 

  <!--  ChartJS-->
  <script src="vistas/bower_components/chart.js/Chart.js"></script>


</head>

<!--=====================================
CUERPO DOCUMENTO
======================================-->

<body class="hold-transition sidebar-collapse sidebar-mini login-page">

  <div class="wrapper content-password">

<div class="img-responsive" id="back"></div>


    <div class="login-box">

      <div class="login-logo">

        <img src="vistas/img/plantilla/logo-blanco-bloque.png" class="img-responsive" style="padding:30px 100px 0px 100px">

      </div>

      <div class="login-box-body">

        <p class="login-box-msg">Preguntas de Seguridad</p>

        <form method="post">

        <?php
            $item = null;
            $valor = null;

            $preguntas = ControladorUsuarios::ctrMostrarPreguntasPorUsuarios($item, $valor);

            $grupo_pregunta = array();
            foreach ($preguntas as $value) {
                
                $usuario = $value["usuario"];
                

                $valores = array(
                    'pregunta' => $value['pregunta'],
                    'respuesta' => $value['respuesta']
                );

                foreach ($valores as $key => $value) {
                    
                }
                $grupo_pregunta[$usuario][] = $valores;

            }
            // echo "<pre>";
            // var_dump($grupo_pregunta);
            // echo "</pre>";
          
            foreach ($grupo_pregunta as $usua => $pregunta) : ?>

                <p><?php echo $usua ?></p>

                <?php foreach ($pregunta as $pregun) { ?>
                    <p><?php echo $pregun['pregunta'] ?></p>
                    <input class="col-md-12 preguntas" type="text">
                <?php } ?>

                <?php endforeach; ?>
        <br>
        <hr>

                <div class="row">

                <div class="col-xs-12">
    
                    <button type="submit" class="btn btn-naranja btn-block btn-flat">Enviar</button>
                
                </div>
    
                </div>
    
            </form>

    

      </div>

    </div>

  </div>
  
<script src="vistas/js/plantilla.js"></script>
<script src="vistas/js/usuarios.js"></script>
<script src="vistas/js/validaciones.js"></script>
<script src="vistas/js/categorias.js"></script>
<script src="vistas/js/productos.js"></script>
<script src="vistas/js/clientes.js"></script>
<script src="vistas/js/ventas.js"></script>
<script src="vistas/js/reportes.js"></script>


</body>
</html>