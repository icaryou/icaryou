<?php $contadorTrayectos=0;?>
<?php foreach ($trayectosPropiosEncontrados as $trayectoAgrupado):?>
<!-- EN CADA $TRAYECTO AGRUPADO TENEMOS UN SOLO TRAYECTO PERO TANTAS FILAS COMO USUARIOS TENGA ESE TRAYECTO -->

	
	<?php $contadorTrayectos++;?>
		<?php if($trayectoAgrupado[0]['creador']==$this->session->userdata('id')):?>
				<table class="elementoBusqueda span10 bottom-bufferElements">
		<?php endif;?>
		<?php if($trayectoAgrupado[0]['creador']!=$this->session->userdata('id')):?>
				<table class="elementoBusquedaAjenos span10 bottom-bufferElements">
		<?php endif;?>
				<tr>
					<td class="paddignCeldaTrayec">
						<span class="diasBusqueda"><?php echo $trayectoAgrupado[0]['dias']?></span>
						<span class="horasBusqueda"><?php echo $trayectoAgrupado[0]['horallegadadestino']?> - 
						<?php echo $trayectoAgrupado[0]['horaretornodestino']?></span>
						<div class="lugaresBusqueda"><img class="casitas" src="<?php echo base_url();?>/assets/img/casitaVerde.png"/><?php echo $trayectoAgrupado[0]['poblacionOrigen']?></div>
						<div class="lugaresBusqueda"><img class="casitas" src="<?php echo base_url();?>/assets/img/casitaRosa.png"/><?php echo $trayectoAgrupado[0]['poblacionDestino']?></div>
						<div class="comentariosBusqueda"><?php echo $trayectoAgrupado[0]['comentarios']?></div>
						
						<!-- PINTAMOS UNIRSE SI NO ESTA EN EL TRAYECTO Y HAY PLAZAS DISPONIBLES -->
								<?php $pintarAbandonar=false;
								$pintarYaHasSolicitado=false;
								$aceptados=0;?>	
								<?php foreach ($trayectoAgrupado as $usu){
									if($usu["aceptado"]==1){
										$aceptados++;
										if($usu["usuarioId"]==$this->session->userdata('id')){
											$pintarAbandonar=true;
										}
									}else if($usu["aceptado"]==0){
										if($usu["usuarioId"]==$this->session->userdata('id')){
											$pintarYaHasSolicitado=true;
										}	
									}
								}?>
								<!-- PINTAMOS YA LO HAS SOLICITADO SI ESTA A LA ESPERA DE SER ACEPTADO -->
							<?php if($this->session->userdata('id')!=null):?>
								<?php if(!$pintarAbandonar&&$pintarYaHasSolicitado):?>				
									<p class="top-buffer10"><strong>Estás a la espera de ser aceptado.</strong></p>				 
								<?php endif;?>
								
								<!-- PINTAMOS COMPLETO SI NO ESTA EN EL TRAYECTO Y NO HAY PLAZAS DISPONIBLES -->
								<?php if(!$pintarAbandonar&&($trayectoAgrupado[0]['plazas']==$aceptados)):?>				
								<p class="top-buffer10"><strong>Trayecto completo</strong></p>				 
								<?php endif;?>
								
								<!-- PINTAMOS ABANDONAR SI NO ESTA EN EL TRAYECTO Y HAY PLAZAS DISPONIBLES -->
								<?php if(isset($pintarAbandonar)&&$pintarAbandonar):?>				
								<button class="btn btn-primary btn-lg botonBusqueda" onclick="llamarAjaxAbandonar(this)" data-button="<?php echo $trayectoAgrupado[0]['trayecto_id']?>"
									class="btn btn-primary btn-lg btn-block" tabindex="7" data-toggle="modal" href="#hasAbandonado">Abandonar</button>				 
								<?php endif;?>
					
				
					</td>
					<td class="paddignCelda2">
					<div class="usuArriba">
						<p class="usuTitulo">Usuarios</p>
					</div>
					<div id="<?php echo "trayecto".$contadorTrayectos;?>" class="usuAbajo">
						<?php $contadorUsuarios=0;?>	
						<?php if($trayectoAgrupado[0]['creador']==$this->session->userdata('id')):?>	
							<?php foreach ($trayectoAgrupado as $usu):?>	
						
							<?php $contadorUsuarios++;?>
							<div class="UsuTrayecto">
								<img class="imgUsuTrayecto" src="<?php echo base_url().$usu["foto"]?>"/>
								<a class="nombreUsuTrayecto" href="<?php echo base_url('usuario/mostrarPerfilUsuario/'.$usu["usuarioId"])?>"><strong><?php echo $usu["nombre"]?></strong></a>
								
								<?php if($usu['aceptado']==0):?>								
    								<button data-toggle="modal" href="#hasAceptado" id="<?php echo $usu['usuarioId']."*".$usu['trayecto_id']?>" class="aceptar_usuario_trayecto btn btn-primary ">Aceptar</button>
    								<button data-toggle="modal" href="#hasRechazado" id="<?php echo $usu['usuarioId']."*".$usu['trayecto_id']?>" class="rechazar_usuario_trayecto btn btn-primary ">Rechazar</button>
								<?php endif;?>
								
								<?php if($usu['usuarioId']!=$this->session->userdata('id') && $usu['aceptado']==1):?>								
    								<button data-toggle="modal" href="#hasEliminado" id="<?php echo $usu['usuarioId']."*".$usu['trayecto_id']?>" class="eliminar_usuario_trayecto btn btn-primary ">Eliminar</button>
								<?php endif;?>
								
							</div>
			 				<?php endforeach;?>
						<?php endif;?>	
						<?php if($trayectoAgrupado[0]['creador']!=$this->session->userdata('id')):?>			
							<?php foreach ($trayectoAgrupado as $usu):?>	
						
							<?php $contadorUsuarios++;?>
							<div class="UsuTrayecto">
								<img class="imgUsuTrayecto" src="<?php echo base_url().$usu["foto"]?>"/>
								<a class="nombreUsuTrayecto" href="<?php echo base_url('usuario/mostrarPerfilUsuario/'.$usu["usuarioId"])?>"><strong><?php echo $usu["nombre"]?></strong></a>
								
							</div>
			 				<?php endforeach;?>
						<?php endif;?>	
			 			<?php for($i=0;$i<($usu["plazas"]-$contadorUsuarios);$i++):?>
			 				<div class="UsuTrayecto">
								<img class="imgUsuTrayecto" src="<?php echo base_url()."assets/img/profile/avatar.png"?>"/>
								<p class="nombreViajero">Libre</p>
							</div>
			 			<?php endfor;?>
					</div>

					</td>
				</tr>
				</table>
	<?php endif;?>
<?php endforeach;?>