 <header class="main-header">
 	
	<!--=====================================
	LOGOTIPO
	======================================-->
	<a href="inicio" class="logo">
		
		<!-- logo mini -->
		<span class="logo-mini">
			
			<img src="vistas/img/plantilla/gym.png" class="img-responsive" style="padding:10px">

		</span>

		<!-- logo normal -->

		<span class="logo-lg">
			
			<img src="vistas/img/plantilla/logo-blanco-lineal.png" class="img-responsive" style="padding:10px 0px">

		</span>

	</a>

	<!--=====================================
	BARRA DE NAVEGACIÓN
	======================================-->
	<nav class="navbar navbar-static-top" role="navigation">
		
		<!-- Botón de navegación -->

	 	<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        	
        	<span class="sr-only">Toggle navigation</span>
      	
      	</a>

		<!-- perfil de usuario -->

		<div class="navbar-custom-menu">
				
			<ul class="nav navbar-nav">
				
				<li class="dropdown user user-menu">
					
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<?php
							// Si la imagen no viene vacia, la trae de la BD.
							if($_SESSION["foto"] != ""){
							
								echo '<img src="'.$_SESSION["foto"].'" class="user-image">';
					
							} else {
							// Si la imagen viene vacia, que muestre la que esta por defecto.
								echo' <img src="vistas/img/usuarios/default/anonymous.png" class="user-image">';
						
							}
						?> 

							<!-- MOSTRAR EN LA BARRA, EL NOMBRE DEL USUARIO QUE SE LOGUEO. -->
							<span class="hidden-xs"><?php echo $_SESSION["nombre"]; ?></span>
					</a>

					<!-- Dropdown-toggle -->

					<ul class="dropdown-menu">
						 <!-- User Account: style can be found in dropdown.less -->
							<!-- User image -->
							<li class="user-header">
								<?php
									// Si la imagen no viene vacia, la trae de la BD.
									if($_SESSION["foto"] != ""){
									
										echo '<img src="'.$_SESSION["foto"].'" class="img-circle" alt="User Image">';
							
									} else {
									// Si la imagen viene vacia, que muestre la que esta por defecto.
										echo' <img src="vistas/img/usuarios/default/anonymous.png" class="img-circle" alt="User Image">';
								
									}

								?> 
								<p>	<?php echo $_SESSION["nombre"]; ?> | <?php echo $_SESSION["perfil"]; ?></p>
							</li>

							<!-- <li class="user-body">
								
								<div class="pull-right">
									
									<a href="salir" class="btn btn-default">Salir</a>

								</div>

							</li> -->

							<li class="user-footer">

								<div class="pull-left">
									<a href="#" class="btn btn-default btn-flat">Perfil</a>
								</div>

								<div class="pull-right">
									<a href="salir" class="btn btn-default">Salir</a>
								</div>
							</li>
						

					</ul>

				</li>

			</ul>

		</div>

	</nav>

 </header>