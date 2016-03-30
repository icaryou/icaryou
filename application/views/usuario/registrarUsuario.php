

	<div class="container">
		<!--PAGE TITLE-->

		<div class="row">
			<div class="span12">
				<div class="page-header">
					<h1>Registrar Usuario</h1>
				</div>
			</div>
		</div>

		<!-- /. PAGE TITLE-->





		<!--  =========================================  FORMULARIO  ======================================================== -->
		<div class="container"></div>
		<div class="row">
			<form id="formularioRegistro"
				action="<?=base_url('usuario/registrarUsuarioPost')?>" method="post"
				class="form-horizontal formularioGenerico">

				<div class="span4">

					<div class="form-group ">
						<label>Nombre</label> <input type="text" name="nombre"
							class="form-control" id="nombre" value="">
					</div>
					<div class="form-group top-buffer">
						<label>Apellido</label> <input type="text" name="apellidos"
							class="form-control" id="apellidos" value="">
					</div>

					<div class="form-group top-buffer">
						<label>Email</label> <input type="text" name="email"
							class="form-control" id="email" value="">
					</div>

					<div class="form-group top-buffer">
						<label>Contrase&ntilde;a</label> <input type="password"
							name="password" class="form-control" id="password" value="">
					</div>

					<div class="form-group top-buffer">
						<label>Repetir contrase&ntilde;a</label> <input type="password"
							name="passwordRepetido" class="form-control"
							id="passwordRepetido" value="">
					</div>
				</div>
				
				
				<div class="span3">
					<div class="form-group">
						<label>Fecha nacimiento</label> <input type="text"
							placeholder="dd/mm/aaaa" name="fechaNac" class="form-control"
							id="fechaNac" value="">
					</div>

					<div class="form-group top-buffer">
						<label>C&oacute;digo Postal</label> <input type="text" name="cp"
							class="form-control" id="cp" value=""> <span
							class="field-validation-valid help-block"></span>
					</div>

					<!-- RADIOS -->
					<div class="form-group top-buffer">
						<label class="" id="sexo" for="sexo">Sexo</label>
						<div class="col-lg-12">
							<label class="radio-inline"> <input type="radio" name="sexo"
								value="hombre"> Hombre
							</label> <label class="radio-inline"> <input type="radio"
								name="sexo" value="mujer"> Mujer
							</label> <span class="field-validation-valid help-block"></span>
						</div>
					</div>

					<div class="form-group top-buffer">
						<label class="" id="cochePropio"
							for="cochePropio">Coche propio</label>
						<div class="col-lg-12">
							<label class="radio-inline"> <input type="radio"
								name="cochePropio" value="si"> Si
							</label> <label class="radio-inline"> <input type="radio"
								name="cochePropio" value="no"> No
							</label> <span class="field-validation-valid help-block"></span>
						</div>
					</div>

					<div class="col-xs-12 col-lg-3 top-buffer">
						<input type="submit" value="Registrarse"
							class="btn btn-primary btn-lg btn-block" tabindex="7">
					</div>

				</div>

			</form>
		</div>
	</div>
