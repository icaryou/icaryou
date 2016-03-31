

	<div class="container">
		<!--PAGE TITLE-->

		<div class="row">
			<div class="span12">
				<div class="page-header">
					<h1>Mi perfil</h1>
				</div>
			</div>
		</div>

		<!-- /. PAGE TITLE-->

		<!--  =========================================  FORMULARIO  ======================================================== -->
		<div class="container"></div>
		<div class="row">
				<div class="span6">
					<div class=" ">
						<table>
							<tr>
								<td>Nombre</td><td><?php echo $this->session->userdata('nombre')?></td>
							</tr>
							<tr>
								<td>Apellidos</td><td><?php echo $this->session->userdata('apellidos')?></td>
							</tr>
							<tr>
								<td>Email</td><td><?php echo $this->session->userdata('email')?></td>
							</tr>
							<tr>
								<td>Fecha de nacimiento</td><td><?php echo $this->session->userdata('fechanac')?></td>
							</tr>
							<tr>
								<td>Código postal</td><td><?php echo $this->session->userdata('cp')?></td>
							</tr>
							<tr>
								<td>Sexo</td><td><?php echo $this->session->userdata('sexo')?></td>
							</tr>							
							<tr>
								<td>Coche propio</td><td><?php echo ($this->session->userdata('cochepropio')==true)?'SI':'NO'?></td>
							</tr>								
						</table>
					</div>					
					<div class="col-xs-12 col-lg-3 top-buffer">								
						<button id="editarPerfil"  onclick='location.href="<?php echo base_url()?>usuario/editarPerfil"' class="btn btn-primary btn-lg btn-block" tabindex="7">Editar Perfil</button>
						<button id="cambiarPassword"  onclick='location.href="<?php echo base_url()?>usuario/cambiarPassword"' class="btn btn-primary btn-lg btn-block" tabindex="7">Cambiar contraseña</button>  
					</div>						
				</div>
				
				
				

					

				

			
		</div>
	</div>
