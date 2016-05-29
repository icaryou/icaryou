

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
									<li class="active"><a href="<?= base_url();?>">Inicio</a></li>
									
									
									<!-- NO LOGUEADO -->
									<?php if(!$this->session->userdata('logueado')):?>
										<li class="active"><a href="<?= base_url();?>usuario/registrarUsuario">Regístrate</a></li>
										<li class="login"><a id="botonLogin" data-toggle="modal" href="#loginForm">Inicia sesi&oacute;n</a></li>
									<?php endif;?>
									<!--LOGUEADO -->
									<?php if($this->session->userdata('logueado')):?>
									<li class="dropdown"><a href=""
										class="dropdown-toggle letraNegra" data-toggle="dropdown">Trayectos<b
											class="caret"></b></a>
										<ul class="dropdown-menu">
											<li><a href="<?php echo base_url()?>trayecto/crearTrayecto">Crear trayecto</a></li>
											<li><a href="<?php echo base_url()?>trayecto/buscarTrayectos">Buscar trayecto</a></li>
										</ul>
										</li>
									
										<li class="dropdown"><a href=""
										class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->session->userdata('nombre')." ".$this->session->userdata('apellidos') ?> 
										<img id="sobre_login" width="15px" src="<?php echo base_url()?>/assets/img/sobre.png"/>
										<b class="caret"></b></a>
										<ul class="dropdown-menu">
											<li><a href="<?php echo base_url()?>usuario/mostrarPerfilPropio">Mi Perfil</a></li>
											<li><a href="<?php echo base_url()?>usuario/listarTrayectosPropios">Mis trayectos</a></li>
											<li><a href="<?php echo base_url()?>mensaje/mostrar_mensajes">Mis mensajes</a></li>
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