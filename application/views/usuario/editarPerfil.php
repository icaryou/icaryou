

	<div class="container">
		<!--PAGE TITLE-->

		<div class="row">
			<div class="span12">
				<div class="page-header">
					<h1>Editar Perfil</h1>
				</div>
			</div>
		</div>

		<!-- /. PAGE TITLE-->





		<!--  =========================================  FORMULARIO  ======================================================== -->
		<div class="container"></div>
		<div class="container"></div>
		<div class="row">
			<form id="formularioRegistro"
				action="<?=base_url('usuario/editarPerfilPost')?>" method="post"
				class="form-horizontal formularioGenerico" enctype="multipart/form-data">

				<div class="span4">

					<div class="form-group ">
						<label>Nombre</label> <input type="text" name="nombre"
							class="form-control" id="nombre" value="<?php echo $this->session->userdata('nombre')?>">
					</div>
					<div class="form-group top-buffer">
						<label>Apellido</label> <input type="text" name="apellidos"
							class="form-control" id="apellidos" value="<?php echo $this->session->userdata('apellidos')?>">
					</div>

					<div class="form-group top-buffer">
						<label>Fecha nacimiento</label> <input type="text"
							placeholder="dd/mm/aaaa" name="fechaNac" class="form-control"
							id="fechaNac" value="<?php echo $this->session->userdata('fechanac')?>">
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
						<label>C&oacute;digo Postal</label> <input type="text" name="cp"
							class="form-control" id="cp" value="<?php echo $this->session->userdata('cp')?>"> <span
							class="field-validation-valid help-block"></span>
					</div>

					<!-- RADIOS -->
					<div class="form-group top-buffer">
						<label class="" id="sexo" for="sexo">Sexo</label>
						<div class="col-lg-12">
							<label class="radio-inline"> <input type="radio" name="sexo"
								value="hombre" <?php echo ($this->session->userdata('sexo')=="hombre")?'checked="checked"':''?>> Hombre
							</label> <label class="radio-inline"> <input type="radio"
								name="sexo" value="mujer" <?php echo ($this->session->userdata('sexo')=="mujer")?'checked="checked"':''?>> Mujer
							</label> <span class="field-validation-valid help-block"></span>
						</div>
					</div>

					<div class="form-group top-buffer">
						<label class="" id="cochePropio"
							for="cochePropio">Coche propio</label>
						<div class="col-lg-12">
							<label class="radio-inline"> <input type="radio"
								name="cochePropio" value="si" <?php echo ($this->session->userdata('cochepropio')==true)?'checked="checked"':''?>> Si
							</label> <label class="radio-inline"> <input type="radio"
								name="cochePropio" value="no" <?php echo ($this->session->userdata('cochepropio')==false)?'checked="checked"':''?>> No
							</label> <span class="field-validation-valid help-block"></span>
						</div>
					</div>
					<div class="top-buffer">
						<input type="submit" id="botonSubmit" value="Actualizar"
							class="btn btn-primary btn-lg  btn-block" tabindex="7">
					</div>
				</div>
				<div class="span2"></div>
				<div class="span3">
				<div id="avatarDiv" class="fotoRegistro"><img id="avatar" name="avatar" src="<?php echo base_url().$this->session->userdata('foto');?>"/></div>
				    
					
			   </div>
			</form>
		</div>

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
						}else{
							$('#userFoto-error').remove();
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
