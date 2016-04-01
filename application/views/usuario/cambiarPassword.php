

<div class="container">
	<!--PAGE TITLE-->

	<div class="row">
		<div class="span12">
			<div class="page-header">
				<h1>Cambiar contraseña</h1>
			</div>
		</div>
	</div>

	<!-- /. PAGE TITLE-->





	<!--  =========================================  FORMULARIO  ======================================================== -->

	<div class="container">
		<div class="row">

			<form id="formularioCambioPassword"
				action="<?=base_url('usuario/cambiarPasswordPost')?>" method="post" class="form-horizontal formularioGenerico">


				<div class="span4">


					<div class="form-group">
						<label>Nueva contraseña</label> <input type="password"
							name="pass" class="form-control" id="pass" value="">
					</div>

					<div class="form-group">
						<label>Repetir nueva contraseña</label> <input type="password" 
							name="passwordRepetido" class="form-control"
							id="passwordRepetido" value="">
					</div>

					<div class="form-group top-buffer">
						<label>Contraseña antigua</label> <input type="password"
							name="passwordAntiguo" class="form-control" id="passwordAntiguo"
							value="">
					</div>
					
					<?php if(isset($errorPassword)):?>
						<p class="error col-lg-8"><?=$errorPassword?></p>
					<?php endif;?>

					<div class="col-xs-12 col-lg-3 top-buffer">
						<input type="submit" value="Guardar cambios"
							class="btn btn-primary btn-lg span2" tabindex="7">
					</div>
				</div>

			</form>
		</div>
	</div>
	</div>