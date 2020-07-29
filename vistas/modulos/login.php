<div class="img-responsive" id="back"></div>

<div class="login-box">
  <div class="login-logo">
    <p>Gym <span>La Roca</span></p>
    <!-- <img src="vistas/img/plantilla/logo-blanco-bloque.png" class="img-responsive" style="padding:30px 100px 0px 100px"> -->
  </div>

  <div class="login-box-body iniciarSesion">
    <p class="login-box-msg">Ingresar al sistema</p>
    <form method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Usuario" name="ingUsuario" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Contraseña" name="ingPassword" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>  
      </div>

      <div class="row">    
        <div class="col-xs-12">
          <button type="submit" class="btn btn-naranja btn-block btn-flat">Ingresar</button>       
        </div>

        <p class="link">¿Ha olvidado la contraseña? <a href="#" onclick="toggelForm();">Recuperar contraseña</a></p>

      </div>


      <?php

        $login = new ControladorUsuarios();
        $login -> ctrIngresoUsuario();
        
      ?>

    </form>

  </div>

  <div class="login-box-body verificarEmail">
    <p class="login-box-msg">Verificar correo</p>
    <form method="post">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" name="" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>

      <div class="row">    
        <div class="col-xs-12">
          <button type="submit" class="btn btn-naranja btn-block btn-flat verificarCorreo" onclick="toggelQuestions();">Verificar</button>       
        </div>
        
        <p class="link">Regresar al <a href="#" onclick="toggelForm();">Login</a></p>
      </div>


    </form>

  </div>

  <div class="login-box-body questionsBx">
    <p class="login-box-msg">Preguntas de Seguridad</p>
    <form method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="..." name="" required>
        <input type="text" class="form-control" placeholder="..." name="" required>
        <input type="text" class="form-control" placeholder="..." name="" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>

      <div class="row">    
        <div class="col-xs-12">
          <button type="submit" class="btn btn-naranja btn-block btn-flat">Verificar</button>       
        </div>
        
        <p class="link">Regresar al <a href="#" onclick="toggelForm(); toggelQuestions();">Login</a></p>
      </div>


    </form>

  </div>

</div>
<script type="text/javascript">
    function toggelForm(){
        var container = document.querySelector('.login-box');
        container.classList.toggle('active')
    }
    function toggelQuestions(){
        var container = document.querySelector('.login-box');
        container.classList.toggle('quest')
    }
</script>