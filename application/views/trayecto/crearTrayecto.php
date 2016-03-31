
<div class="container">
	<!--PAGE TITLE-->

	<div class="row">
		<div class="span12">
			<div class="page-header">
				<h1>Crear trayecto</h1>
			</div>
		</div>
	</div>

	<!-- /. PAGE TITLE-->





	<!--  =========================================  FORMULARIO  ======================================================== -->

	<div class="container">
		<div class="row">
			<form id="formularioTrayecto"
				action="<?=base_url('trayecto/crearTrayectoPost')?>" method="post"
				class="form-horizontal formularioGenerico">

				<div class="span4">

					<div class="form-group">
						<label>C&oacute;digo Postal origen</label> <input type="text"
							name="cpOrigen" class="form-control" id="cpOrigen" value="">
					</div>

					<div class="form-group top-buffer">
						<label for="poblacionOrigen">Poblaci&oacute;n origen</label> <input type="text"
							name="poblacionOrigen" class="form-control isstate" id="poblacionOrigen"
							value="">
					</div>

					<div class="form-group top-buffer">
						<label>C&oacute;digo Postal destino</label> <input type="text"
							name="cpDestino" class="form-control" id="cpDestino" value="">
					</div>

					<div class="form-group top-buffer">
						<label>Poblaci&oacute;n destino</label> <input type="text"
							name="poblacionDestino" class="form-control"
							id="poblacionDestino" value="">
					</div>

					<div class="form-group top-buffer">
						<label>Hora de llegada al trabajo</label> <input type="text"
							placeholder="HH:MM" name="horaLlegada" class="form-control"
							id="horaLlegada" value="">
					</div>

					<div class="form-group top-buffer">
						<label>Hora de vuelta del trabajo</label> <input type="text"
							placeholder="HH:MM" name="horaRetorno" class="form-control"
							id="horaRetorno" value="">
					</div>
				</div>
				<div class="span3">
					<div class="form-group">
						<label>Comentarios</label>
						<textarea maxlength="140" name="comentarios" class="form-control"
							id="cp"></textarea>
					</div>

					<!-- CHECKBOX -->
					<div class="form-group top-buffer">
						<label class="" for="dias" id="dias">D&iacute;as</label>
						<div class="col-lg-11">
							<label class="checkbox-inline col-lg-2"> <input type="checkbox"
								name="dias[]" value="L"> Lunes
							</label> <label class="checkbox-inline col-lg-2"> <input
								type="checkbox" name="dias[]" value="M"> Martes
							</label> <label class="checkbox-inline col-lg-2"> <input
								type="checkbox" name="dias[]" value="X"> Mi&eacute;rcoles
							</label> <label class="checkbox-inline col-lg-2"> <input
								type="checkbox" name="dias[]" value="J"> Jueves
							</label> <label class="checkbox-inline col-lg-2"> <input
								type="checkbox" name="dias[]" value="V"> Viernes
							</label> <label class="checkbox-inline col-lg-2"> <input
								type="checkbox" name="dias[]" value="S"> S&aacute;bado
							</label> <label class="checkbox-inline col-lg-2"> <input
								type="checkbox" name="dias[]" value="D"> Domingo
							</label> <span class="field-validation-valid help-block"></span>
						</div>
					</div>

					<div class="form-group">
						<input type="hidden" class="form-control" id="none" value="">
					</div>

					<div class="form-group top-buffer">
						<label>Plazas m&aacute;ximas(incluido t&uacute;).</label> <input
							type="text" name="plazas" class="form-control" id="plazas"
							value="">
					</div>

					<div class="form-group top-buffer">
						<input type="hidden" class="form-control" id="none" value="">
					</div>



					<div class="col-xs-12 col-lg-3 top-buffer">
						<input type="submit" name="submitOk" value="Registrarse"
							class="btn btn-primary btn-block btn-lg" tabindex="7">
					</div>
				</div>

			</form>
		</div>
	</div>
</div>