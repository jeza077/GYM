<div class="img-responsive" id="back"></div>

<div class="login-box">
  <div class="login-logo">
    <p>Gym <span>La Roca</span></p>
    <!-- <img src="vistas/img/plantilla/logo-blanco-bloque.png" class="img-responsive" style="padding:30px 100px 0px 100px"> -->
  </div>

  <div class="login-box-body iniciarSesion">
    <p class="login-box-msg">Ingresa al sistema</p>
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
    <p class="login-box-msg">Verifica tu correo</p>
    <form method="post">
      <div class="form-group has-feedback">
        <input type="email" class="form-control"  id="verificarEmail" placeholder="Email" name="" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>

      <div class="row">    
        <div class="col-xs-12">
          <button type="submit" class="btn btn-naranja btn-block btn-flat verificarCorreo">Verificar</button>       
        </div>
        <p class="link">Regresar al <a href="#" onclick="toggelForm();">Login</a></p>
      </div>

    </form>

  </div>

  <div class="login-box-body questionsBx">

    <p class="login-box-msg">Preguntas de Seguridad</p>
    <form method="post">
      <div class="form-group has-feedback" id="preguntaSeguridad">

      </div>

      <div class="row">    
        <div class="col-xs-12">
          <button type="submit" class="btn btn-naranja btn-block btn-flat verificarPreguntas" id="verificarPreguntas">Verificar</button>       
        </div>
        <p class="link">Regresar al <a href="#" onclick="toggelForm(); toggelQuestions();">Login</a></p>
      </div>
    </form>

  </div>

  <div class="login-box-body cambiarPassword" >
  
    <p class="login-box-msg">Cambia tu contraseña</p>
    <form method="post" id="cambiarPassword">

    <!-- <div class='form-group has-feedback'>
      <input type='password' class='form-control' id='pass' placeholder='Nueva contraseña' name='editarPassword'>
    </div> -->
    <div class="row">    
        <div class="col-xs-12">
        <button type="submit" class="btn btn-naranja btn-block btn-flat" id="cambiarContraseña">Cambiar Contraseña</button>
        </div>
        
        <p class="link">Regresar al <a href="#" onclick="toggelForm(); toggelQuestions(); toggelPassword();">Login</a></p>
    </div>
    <?php


      $cambiarContraseña = new ControladorUsuarios();
      $cambiarContraseña -> ctrCambiarContraseña($item, $valor, $post);

    ?>
    </form>


  </div>

</div>
