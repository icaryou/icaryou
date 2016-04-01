

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

				<table class="table table-bordered fondoTabla">
					<tr>
						<td class="span3"><strong>Nombre</strong></td>
						<td><?php echo $this->session->userdata('nombre')?></td>
					</tr>
					<tr>
						<td class="span3"><strong>Apellidos</strong></td>
						<td><?php echo $this->session->userdata('apellidos')?></td>
					</tr>
					<tr>
						<td class="span3"><strong>Email</strong></td>
						<td><?php echo $this->session->userdata('email')?></td>
					</tr>
					<tr>
						<td class="span3"><strong>Fecha de nacimiento</strong></td>
						<td><?php echo $this->session->userdata('fechanac')?></td>
					</tr>
					<tr>
						<td class="span3"><strong>Código postal</strong></td>
						<td><?php echo $this->session->userdata('cp')?></td>
					</tr>
					<tr>
						<td class="span3"><strong>Sexo</strong></td>
						<td><?php echo $this->session->userdata('sexo')?></td>
					</tr>
					<tr>
						<td class="span3"><strong>Coche propio</strong></td>
						<td><?php echo ($this->session->userdata('cochepropio')==true)?'SI':'NO'?></td>
					</tr>
				</table>
				<div class="col-xs-12 col-lg-3 top-buffer span2">
					<button id="editarPerfil"
						onclick='location.href="<?php echo base_url()?>usuario/editarPerfil"'
						class="btn btn-primary btn-lg btn-block" tabindex="7">Editar
						Perfil</button>
				</div>
				<div class="col-xs-12 col-lg-3 top-buffer span2">
					<button id="cambiarPassword"
						onclick='location.href="<?php echo base_url()?>usuario/cambiarPassword"'
						class="btn btn-primary btn-lg btn-block" tabindex="7">Cambiar
						contraseña</button>
				</div>
			</div>

		</div>









	</div>
</div>
