

	<div class="container">
		<!--PAGE TITLE-->

		<div class="row">
			<div class="span12">
				<div class="page-header">
					<h1>Crea tu perfil</h1>
				</div>
			</div>
		</div>

		<!-- /. PAGE TITLE-->





		<!--  =========================================  FORMULARIO  ======================================================== -->
		<div class="container"></div>
		<div class="row">
			<form id="formularioRegistro"
				action="<?=base_url('usuario/registrarUsuarioPost')?>" method="post"
				class="form-horizontal formularioGenerico" enctype="multipart/form-data">

				<div class="span4">

					<div class="form-group ">
						<label>Nombre</label> <input type="text" name="nombre"
							class="form-control" id="nombre" value=""/>
					</div>
					<div class="form-group top-buffer">
						<label>Apellido</label> <input type="text" name="apellidos"
							class="form-control" id="apellidos" value=""/>
					</div>

					<div class="form-group top-buffer">
						<label>Email</label> <input type="text" name="email"
							class="form-control" id="email" value=""/>
					</div>

					<div class="form-group top-buffer">
					<label>Contraseña</label>
					<input type="password" name="passwdNormal" class="form-control" id="passwdNormal" value=""/>
				</div>
				
				<div class="form-group top-buffer">
					<label>Repetir contraseña</label>
					<input type="password" name="passwordRepetido" class="form-control" id="passwordRepetido" value=""/>
				</div>
					<div class="form-group top-buffer">
								<div class="input-append">
					<!-- This input is here purely for cosmetic reasons. The actual file is uploaded from the hidden input box !-->
									<label>Foto</label>	
									<input type="text" id="subfile" />
									<a class="btn" onclick="$('#userFoto').click();">Buscar</a>
								</div>		
								<input type="file" name="userFoto" id="userFoto" accept="image/*" style="display:none;"/>
					</div>
				</div>
				
				
				<div class="span2">
					
					<div class="form-group">
						<label>Fecha nacimiento</label> <input type="text"
							placeholder="dd/mm/aaaa" name="fechaNac" class="form-control"
							id="fechaNac" value=""/>
					</div>

					<div class="form-group top-buffer">
						<label>C&oacute;digo Postal</label> <input type="text" name="cp"
							class="form-control" id="cp" value=""/> <span
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
						<input type="submit" id="botonSubmit" value="Registrarse"
							class="btn btn-primary btn-lg bottomaligned btn-block" tabindex="7">
					</div>
				</div>
				<div class="span2"></div>
				<div class="span3">
				<div id="avatarDiv" class="fotoRegistro"><img id="avatar" name="avatar" src="<?php echo base_url()."assets/img/profile/avatar.png"?>"/></div>
				    
					
			   </div>
			</form>
		</div>
	</div>
	
	<!--  VENTANA MODAL USUARIO CREADO -->

<div class="modal hide fade in" id="usuarioCreado" aria-hidden="false">
	<div class="modal-header">
		<i class="icon-remove" data-dismiss="modal" aria-hidden="true"></i>
		
		<h4 class="modalTitle"><img class="tick" src="<?php echo base_url()."assets/img/tick.png";?>"/>¡Usuario creado!</h4>
		
		
	</div>
	<!--Modal Body-->
	<div class="modal-body">
		<p class="modalTexto">Revisa tu correo, recibirás un mail de confirmación.</p>
	</div>
	<!--/Modal Body-->
</div>
	<script>
 	$(document).ready(function(){
 		// This is the simple bit of jquery to duplicate the hidden field to subfile
 		$('#userFoto').change(function(){
			$('#subfile').val($(this).val());
			//AJAX

				var fd = new FormData();

	            fd.append( "userFoto", $("#userFoto")[0].files[0]);
	            $.ajax({
	            	url: "<?php echo base_url()."usuario/mostrarFotoRegistro"?>",
	                type: 'POST',
	                cache: false,
	                data: fd,
	                enctype: 'multipart/form-data',
	                processData: false,
	                contentType: false,
	                success: function (msg) { 
		                var respuesta =JSON.parse(msg);
		                
						if(!respuesta['valida'])
						{
							$('#userFoto-error').remove();
			                var linea=$('<label id="userFoto-error" class="error" for="userFoto">'+respuesta['error']+'</label>');
			                linea.insertAfter($('#userFoto'));
			                $('#userFoto').val("");
			                $('#subfile').val("");
						}
		                
	                	$( "#avatar" ).attr("src", "<?php echo base_url();?>"+ respuesta['ruta']);
	                },
	                error: function () {
	                	alert("error");
	                }
	            });
		});


 	});

 	</script>
