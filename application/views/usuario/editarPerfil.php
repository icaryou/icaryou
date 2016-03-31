

	<div class="container">
		<!--PAGE TITLE-->

		<div class="row">
			<div class="span12">
				<div class="page-header">
					<h1>Editar Perfil</h1>
				</div>
			</div>
		</div>

		<!-- /. PAGE TITLE-->





		<!--  =========================================  FORMULARIO  ======================================================== -->
		<div class="container"></div>
		<div class="row">
			<form id="formularioRegistro"
				action="<?=base_url('usuario/editarPerfilPost')?>" method="post"
				class="form-horizontal formularioGenerico">

				<div class="span4">
					<div class="form-group ">
						<label>Nombre</label> <input type="text" name="nombre"
							class="form-control" id="nombre" value="<?php echo $this->session->userdata('nombre')?>">
					</div>
					<div class="form-group top-buffer">
						<label>Apellido</label> <input type="text" name="apellidos"
							class="form-control" id="apellidos" value="<?php echo $this->session->userdata('apellidos')?>">
					</div>
					<div class="form-group top-buffer">
						<label>Fecha nacimiento</label> <input type="text"
							placeholder="dd/mm/aaaa" name="fechaNac" class="form-control"
							id="fechaNac" value="<?php echo $this->session->userdata('fechanac')?>">
					</div>					
				</div>
				
				
				<div class="span3">
					<div class="form-group">
						<label>C&oacute;digo Postal</label> <input type="text" name="cp"
							class="form-control" id="cp" value="<?php echo $this->session->userdata('cp')?>"> <span
							class="field-validation-valid help-block"></span>
					</div>

					<!-- RADIOS -->
					<div class="form-group top-buffer">
						<label class="" id="sexo" for="sexo">Sexo</label>
						<div class="col-lg-12">
							<label class="radio-inline"> <input type="radio" name="sexo"
								value="hombre" <?php echo ($this->session->userdata('sexo')=="hombre")?'checked="checked"':''?>> Hombre
							</label> <label class="radio-inline"> <input type="radio"
								name="sexo" value="mujer" <?php echo ($this->session->userdata('sexo')=="mujer")?'checked="checked"':''?>> Mujer
							</label> <span class="field-validation-valid help-block"></span>
						</div>
					</div>

					<div class="form-group top-buffer">
						<label class="" id="cochePropio"
							for="cochePropio">Coche propio</label>
						<div class="col-lg-12">
							<label class="radio-inline"> <input type="radio"
								name="cochePropio" value="si" <?php echo ($this->session->userdata('cochepropio')==true)?'checked="checked"':''?>> Si
							</label> <label class="radio-inline"> <input type="radio"
								name="cochePropio" value="no" <?php echo ($this->session->userdata('cochepropio')==false)?'checked="checked"':''?>> No
							</label> <span class="field-validation-valid help-block"></span>
						</div>
					</div>

					<div class="col-xs-12 col-lg-3 top-buffer">
						<input type="submit" value="Guardar cambios"
							class="btn btn-primary btn-lg btn-block" tabindex="7">
					</div>

				</div>

			</form>
		</div>
	</div>
