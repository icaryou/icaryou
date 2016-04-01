	<div class="container">
		<!--PAGE TITLE-->

		<div class="row">
			<div class="span12">
				<div class="page-header">
					<h1>Login Usuario</h1>
				</div>
			</div>
		</div>

		<!-- /. PAGE TITLE-->





		<!--  =========================================  FORMULARIO  ======================================================== -->

		<div class="container">
			<div class="row">
			

				<form id="formularioLogin"
					action="<?=base_url('usuario/loginUsuarioPost')?>" method="post"
					class="form-horizontal formularioGenerico">


					<div class="span4">

						<div class="form-group">
							<label>Email</label> <input type="text" name="email"
								class="form-control" id="email"
								value="<?php echo isset($email)?$email:''?>">
						</div>
						<div class="form-group top-buffer">
							<label>Contrase&ntilde;a</label> <input type="password" name="passwd"
								class="form-control" id="passwd" value="">
						</div>										
				
				<?php if(isset($error)):?>
					<p class="error col-lg-8"><?=$error?></p>
				<?php endif;?>
				
				<?php if(isset($redireccion)):?>
					<input type="hidden" name="redireccion"
							value="<?php echo $redireccion?>" />
				<?php endif;?>					
				
				<div class="col-xs-12 col-lg-3 top-buffer">
							<input type="submit" value="Login"
								class="btn btn-primary btn-lg span2" tabindex="7">
						</div>
						<p class="col-lg-3 top-buffer">
							<a href="<?=base_url('usuario/registrarUsuario')?>">Crear una
								cuenta</a>
						</p>


					</div>

				</form>
			</div>
		</div>
</div>
