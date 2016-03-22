<html>

<head>
<meta charset="utf-8">

<link rel="stylesheet" href="<?= base_url();?>assets/css/bootstrap.min.css">
<link rel="stylesheet" href="<?= base_url();?>assets/css/bootstrap-theme.min.css">

<script src="<?= base_url();?>assets/js/jquery-2.1.3.js"></script>
<script src="<?= base_url();?>assets/js/jquery.validate.min.js"></script>
<script src="<?= base_url();?>assets/js/bootstrap.min.js"></script>

<style>

	.error
	{
		color: red;
	}

	input.error 
	{
    	color: red;
    	border:solid 1px red;
	}
	
	input.valid 
	{
    	border:solid 1px green;
	}
	#formularioRegistro .error
	{
		color:red;
	}
	
</style>
<script>
	
	
	$( document ).ready(function() 
	{

		
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
            debug: false,
            rules: {
                
                "email": {
                    required: true
                },
                "password": {
                    required: true                  
                },            
             
            },
            messages: {
                "email": {
                    required: "Introduce tu email.",
                },
                "password": {
                    required: "Introduce tu contraseña"                    
                },           
            }, 
        });
});
	
</script>
</head>
<body>
<form id="formularioLogin" action="<?=base_url('usuario/loginUsuarioPost')?>" method="post">

<div class="container-fluid">
    <section class="container">
		<div class="container-page">				
			<div class="col-md-6">
				<h3 class="dark-grey">Login</h3>
												
				<div class="form-group col-lg-8">
					<label>Email</label>
					<input type="text" name="email" class="form-control" id="email" value="<?php echo isset($email)?$email:''?>">
				</div>				
				<div class="form-group col-lg-8">
					<label>Contraseña</label>
					<input type="password" name="password" class="form-control" id="password" value="">
				</div>										
				
				<?php if(isset($error)):?>
					<p class="error col-lg-8"><?=$error?></p>
				<?php endif;?>
				
				<?php if(isset($redireccion)):?>
					<input type="hidden" name="redireccion" value="<?php echo $redireccion?>"/>
				<?php endif;?>					
				
				<div class="col-xs-12 col-lg-6"><input type="submit" value="Login" class="btn btn-primary btn-block btn-lg" tabindex="7"></div>			
			<p class="col-lg-8"><a href="<?=base_url('usuario/registrarUsuario')?>">Crear una cuenta</a></p>	
			</div>	
				
		</div>	
		
	</section>	
</div>

</form>
	
</body>
</html>
