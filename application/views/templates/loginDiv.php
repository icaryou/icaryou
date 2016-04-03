<!-- <script type="text/javascript">

$( document ).ready(function() 
		{		

	$('#formularioLogin input[type="text"]').tooltipster({ 
        trigger: 'custom', // default is 'hover' which is no good here
        onlyOne: false,    // allow multiple tips to be open at a time
        position: 'right'  // display the tips to the right of the element
    });

	
			//VALIDACION FORMULARIO
	        $('#formularioLogin').submit(function(e) {
	            e.preventDefault();
	        }).validate({
	        	submitHandler: function(form) {
	        	    // do other things for a valid form
	        	    form.submit();},
	        	error: function(label) {
	        	     $(this).addClass("error");
	        	   },
	        	   valid: function(label) {
	            	     $(this).addClass("valid");          	     
	               },
	            debug: false,
	            errorPlacement: function(error, element) {
	            	 $(element).tooltipster('update', $(error).text());
	                 $(element).tooltipster('show');
	              },
	            rules: {
	                
	                "email": {
	                    required: true,
	                    email: true
	                },
	                "passwd": {
	                    required: true,
	                    minlength: 8,
	                    maxlength: 20 
	                },            
	             
	            },
	            messages: {
	                "email": {
	                    required: "Introduce tu email",
	                    email: "Introduce un email válido.",
	                },
	                "passwd": {
	                    required: "Introduce tu contraseña",
	                    minlength:"Introduce al menos 8 caracteres.",
	                    maxlength: "Introduce como máximo 20 caracteres." 
	                },           
	            } 
	        });
	});

</script>
 -->
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
				class="input-login left-buffer tooltipster"> <label class="left-buffer">Contrase&ntilde;a</label>
			<input type="password" name="passwd" id="passwd" value=""
				class="input-login left-buffer tooltipster">
			
			<input type="hidden" name="urlOrigen" value="<?php echo $_SERVER['PHP_SELF']?>"/>															
				
			<?php if(isset($errorLogin)):?>
					<p id="errorLogin" class="error col-lg-8"><?=$errorLogin?></p>
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

