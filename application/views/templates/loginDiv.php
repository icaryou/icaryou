<!--  Login form -->
<div class="modal hide fade in" id="loginForm" aria-hidden="false">
	<div class="modal-header">
		<i class="icon-remove" data-dismiss="modal" aria-hidden="true"></i>
		<h4>Login Usuario</h4>
	</div>
	<!--Modal Body-->
	<div class="modal-body">


		<form id="formularioLogin"
			action="<?=base_url('usuario/loginUsuarioPost')?>" method="post"
			class="form-inline loginForm">



			<label>Email</label> <input type="text" name="email" id="email"
				value="<?php echo isset($email)?$email:''?>"
				class="input-login left-buffer"> <label class="left-buffer">Contrase&ntilde;a</label>
			<input type="password" name="passwd" id="passwd" value=""
				class="input-login left-buffer">
			
			<input type="hidden" name="urlOrigen" value="<?php echo $_SERVER['PHP_SELF']?>"/>															
				
			<?php if(isset($error)):?>
					<p class="error col-lg-8"><?=$error?></p>
			<?php endif;?>
				
				<?php if(isset($redireccion)):?>
					<input type="hidden" name="redireccion"
				value="<?php echo $redireccion?>" />
				<?php endif;?>					
				
				
							<input type="submit" value="Login"
				class="btn btn-primary left-buffer" tabindex="7">

			<p class="col-lg-3 top-buffer">
				<a href="<?=base_url('usuario/registrarUsuario')?>">Crear una cuenta</a>
			</p>




		</form>


	</div>
	<!--/Modal Body-->
</div>
