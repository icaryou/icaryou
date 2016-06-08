

<div class="container">
	<!--PAGE TITLE-->

	<div class="row">
		<div class="span12">
			<div class="page-header">
				<h1>Perfil de <?php echo $usuario['nombre']." ".$usuario['apellidos']?></h1>
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
						<td><?php echo $usuario['nombre']?></td>
					</tr>
					<tr>
						<td class="span3"><strong>Apellidos</strong></td>
						<td><?php echo $usuario['apellidos']?></td>
					</tr>
					<!--  
					<tr>
						<td class="span3"><strong>Email</strong></td>
						<td><?php echo $usuario['email']?></td>
					</tr>
					<tr>
						<td class="span3"><strong>Fecha de nacimiento</strong></td>
						<td><?php echo $usuario['fechanac']?></td>
					</tr>
					-->
					<tr>
						<td class="span3"><strong>Código postal</strong></td>
						<td><?php echo $usuario['cp']?></td>
					</tr>
					<tr>
						<td class="span3"><strong>Sexo</strong></td>
						<td><?php echo $usuario['sexo']?></td>
					</tr>
					<tr>
						<td class="span3"><strong>Coche propio</strong></td>
						<td><?php echo ($usuario['cochepropio']==true)?'SI':'NO'?></td>
					</tr>
				</table>
				<div class="col-xs-12 col-lg-3 top-buffer span2">
					<button id="editarPerfil"
						onclick='location.href="<?php echo base_url('mensaje/comprobar_conversacion_mensaje_inicial/'.$usuario['id'])?>"'
						class="btn btn-primary btn-lg btn-block" tabindex="7">Enviar
						mensaje</button>
				</div>
				<div class="col-xs-12 col-lg-3 top-buffer span2">
					<button id="cambiarPassword"
						onclick='location.href="<?php echo base_url('usuario/ver_trayectos_usuario/'.$usuario['id'])?>"'
						class="btn btn-primary btn-lg btn-block" tabindex="7">Ver trayectos</button>
				</div>
			</div>

		</div>









	</div>
</div>
