
<div class="container">
	<!--PAGE TITLE-->

	<div class="row">
		<div class="span12">
			<div class="page-header">
				<h1>Buscar trayecto</h1>
			</div>
		</div>
	</div>

	<!-- /. PAGE TITLE-->





	<!--  =========================================  FORMULARIO  ======================================================== -->

	<div class="container">
		<div class="row">
			<form id="formularioTrayecto"
				action="<?=base_url('trayecto/buscarTrayectosPost')?>" method="post"
				class="form-horizontal formularioGenerico">

				<div class="span4">

					<div class="form-group">
						<label>Código Postal origen</label> <input type="text"
							name="cpOrigen" class="form-control" id="cpOrigen" value="">
					</div>

					<div class="form-group top-buffer">
						<label>Población origen</label> <input type="text"
							name="poblacionOrigen" class="form-control" id="poblacionOrigen"
							value="">
					</div>

					<div class="form-group top-buffer">
						<label>Código Postal destino</label> <input type="text"
							name="cpDestino" class="form-control" id="cpDestino" value="">
					</div>

					<div class="form-group top-buffer">
						<label>Población destino</label> <input type="text"
							name="poblacionDestino" class="form-control"
							id="poblacionDestino" value="">
					</div>
					<h4 class="top-buffer">Hora de llegada al trabajo</h4>
					<div class="form-group">
						<label>Desde</label> <input type="text" placeholder="HH:MM"
							name="horaLlegadaDesde" class="form-control"
							id="horaLlegadaDesde" value="">
					</div>
					<div class="form-group top-buffer">
						<label>Hasta</label> <input type="text" placeholder="HH:MM"
							name="horaLlegadaHasta" class="form-control"
							id="horaLlegadaHasta" value="">
					</div>
				</div>
				<div class="span3">
					<h4>Hora de vuelta del trabajo</h4>
					<div class="form-group">
						<label>Desde</label> <input type="text" placeholder="HH:MM"
							name="horaRetornoDesde" class="form-control"
							id="horaRetornoDesde" value="">
					</div>

					<div class="form-group top-buffer">
						<label>Hasta</label> <input type="text" placeholder="HH:MM"
							name="horaRetornoHasta" class="form-control"
							id="horaRetornoHasta" value="">
					</div>


					<!-- CHECKBOX -->
					<div class="form-group top-buffer">
						<label class="" for="dias" id="dias">Días</label>
						<div class="col-lg-11">
							<label class="checkbox-inline col-lg-2"> <input type="checkbox"
								name="dias[]" value="L"> Lunes
							</label> <label class="checkbox-inline col-lg-2"> <input
								type="checkbox" name="dias[]" value="M"> Martes
							</label> <label class="checkbox-inline col-lg-2"> <input
								type="checkbox" name="dias[]" value="X"> Miércoles
							</label> <label class="checkbox-inline col-lg-2"> <input
								type="checkbox" name="dias[]" value="J"> Jueves
							</label> <label class="checkbox-inline col-lg-2"> <input
								type="checkbox" name="dias[]" value="V"> Viernes
							</label> <label class="checkbox-inline col-lg-2"> <input
								type="checkbox" name="dias[]" value="S"> Sábado
							</label> <label class="checkbox-inline col-lg-2"> <input
								type="checkbox" name="dias[]" value="D"> Domingo
							</label> <span class="field-validation-valid help-block"></span>
						</div>
					</div>

					<div class="form-group col-lg-12">
						<input type="hidden" class="form-control" id="none" value="">
					</div>


					<div class="col-xs-12 col-lg-3 top-buffer">
						<input type="submit" name="submitOk" value="Buscar"
							class="btn btn-primary btn-block btn-lg" tabindex="7">
					</div>
				</div>

			</form>
		</div>
	</div>
</div>
