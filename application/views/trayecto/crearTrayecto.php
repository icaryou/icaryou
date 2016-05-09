<?php if(isset($redireccion)):?>
					<script type='text/javascript'>
						$(document).ready(function(){
							$('#loginForm').show();
							$('#submitOk').click(false);
							$('#loginForm').modal({backdrop: 'static', keyboard: false});
						});
						
					</script>
					
<?php endif;?>	

<div class="container">
	<!--PAGE TITLE-->

	<div class="row">
		<div class="span12">
			<div class="page-header">
				<h1>Crea un trayecto</h1>
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
						<label for="poblacionOrigen" class="labelFilter">Poblaci&oacute;n origen</label> <input type="text"
							name="poblacionOrigen" class="form-control isstate" id="poblacionOrigen"
							value="">
					</div>
					<div class="form-group top-buffer">
						<label for="cpOrigen" class="labelFilter">C&oacute;digo Postal origen</label> <input type="text"
							name="cpOrigen" class="form-control" id="cpOrigen" value="">
					</div>
					<div class="form-group top-buffer">
						<label for="poblacionDestino" class="labelFilter">Poblaci&oacute;n destino</label> <input type="text"
							name="poblacionDestino" class="form-control isstate"
							id="poblacionDestino" value="">
					</div>
					<div class="form-group top-buffer">
						<label for="cpDestino" class="labelFilter">C&oacute;digo Postal destino</label> <input type="text"
							name="cpDestino" class="form-control" id="cpDestino" value="">
					</div>
			<!-- CHECKBOX -->
					<div class="form-group top-buffer">
						<label class="labelFilter top-buffer" for="dias" id="dias">Días</label>

						<div class="diasFilter" >
							<input type="checkbox" name="dias[]" value="L" /> 
							<label for="L">L</label>
						</div>
						<div class="diasFilter">
							<input type="checkbox" name="dias[]" value="M"> 
							<label for="M">M</label>
						</div>
						<div class="diasFilter" >
							<input type="checkbox" name="dias[]" value="X">  
							<label for="X">X</label>
						</div>
						<div class="diasFilter" >
							<input type="checkbox" name="dias[]" value="J">   
							<label for="J">J</label>
						</div>
						<div class="diasFilter" >
							<input type="checkbox" name="dias[]" value="V">   
							<label for="V">V</label>
						</div>
						<div class="diasFilter" >
							<input type="checkbox" name="dias[]" value="S"> 
							<label for="S">S</label>
						</div>
						<div class="diasFilter" >
							<input type="checkbox" name="dias[]" value="D">   
							<label for="D">D</label>
						</div>
					</div>
					
				</div>
				<div class="span3">
				
				<div class="form-group">
						<label for="horaLlegada" class="labelFilter">Hora de llegada a destino</label> <input type="text"
							placeholder="HH:MM" name="horaLlegada" class="form-control"
							id="horaLlegada" value="">
					</div>

					<div class="form-group top-buffer">
						<label for="horaRetorno" class="labelFilter">Hora de regreso</label> <input type="text"
							placeholder="HH:MM" name="horaRetorno" class="form-control"
							id="horaRetorno" value="">
					</div>
					<div class="form-group top-buffer">
						<label class="labelFilter">Comentarios</label>
						<textarea maxlength="140" name="comentarios" class="form-control" id="cp"></textarea>
					</div>

					<div class="form-group top-buffer">
						<label for="plazas" class="labelFilter">Plazas m&aacute;ximas(incluido t&uacute;).</label>
						<input type="text" name="plazas" class="form-control" id="plazas" value="">
					</div>
					
					

					<div class="form-group">
						<input type="hidden" class="form-control" id="none" value="">
					</div>


					<div class="form-group top-buffer">
						<input type="hidden" class="form-control" id="none" value="">
					</div>



					<div class="col-xs-12 col-lg-3 top-buffer">
						<input type="submit" id="submitOk" name="submitOk" value="Registrarse"
							class="btn btn-primary span2 btn-lg top-buffer" tabindex="7">
					</div>
				</div>

			</form>
			<div class="span1"></div>
			<div class="span3"><img src="<?= base_url();?>assets/img/crearTrayecto.png" class="imgBuscarTrayecto"/></div>
		</div>
	</div>
</div>