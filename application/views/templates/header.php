

<body>


	<!--HEADER ROW-->
	<div id="header-row">
		<div class="container">
			<div class="row">
				<!--LOGO-->
				<div class="span3">
					<a class="brand" href="<?= base_url();?>"><img
						src="<?= base_url();?>assets/img/logo.png" /></a>
				</div>
				<!-- /LOGO -->

				<!-- MAIN NAVIGATION -->
				<div class="span9">
					<div class="navbar  pull-right">
						<div class="navbar-inner">
							<a data-target=".navbar-responsive-collapse"
								data-toggle="collapse" class="btn btn-navbar"><span
								class="icon-bar"></span><span class="icon-bar"></span><span
								class="icon-bar"></span></a>
							<div class="nav-collapse collapse navbar-responsive-collapse">
								<ul class="nav">
									<li class="active"><a href="<?= base_url();?>">Home</a></li>
									
									
									<!-- NO LOGUEADO -->
									<?php if(!$this->session->userdata('logueado')):?>
										<li class="active"><a href="<?= base_url();?>usuario/registrarUsuario">Registrarse</a></li>
										<li class="login"><a data-toggle="modal" href="#loginForm">Iniciar sesi&oacute;n</a></li>
									<?php endif;?>
									<!--LOGUEADO -->
									<?php if($this->session->userdata('logueado')):?>
										<li class="dropdown"><a href="about.html"
										class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->session->userdata('nombre')." ".$this->session->userdata('apellidos') ?> <b
											class="caret"></b></a>
										<ul class="dropdown-menu">
											<li><a href="<?php echo base_url()?>usuario/mostrarPerfil">Mi Perfil</a></li>
											<li><a href="<?php echo base_url()?>usuario/listarTrayectos">Mis trayectos</a></li>
											<li><a href="<?php echo base_url()?>usuario/listarMensajes">Mis mensajes</a></li>
											<li><a href="<?php echo base_url()?>usuario/logoutUsuario">Logout</a></li>
										</ul>
										</li>
									<?php endif;?>
									
									

								</ul>
							</div>

						</div>
					</div>
				</div>
				<!-- MAIN NAVIGATION -->
			</div>
		</div>
	</div>
	<!-- /HEADER ROW -->