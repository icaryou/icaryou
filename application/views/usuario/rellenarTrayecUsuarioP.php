<?php $contadorTrayectos=0;?>
<?php foreach ($trayectosEncontrados as $trayectoAgrupado):?>
<!-- EN CADA $TRAYECTO AGRUPADO TENEMOS UN SOLO TRAYECTO PERO TANTAS FILAS COMO USUARIOS TENGA ESE TRAYECTO -->

	<?php if($trayectoAgrupado[0]['creador']==$usuario_buscado->id):?>
	<?php $contadorTrayectos++;?>

			<table id="tablaPropios" class="elementoBusqueda span10 bottom-bufferElements">
				<tr>
					<td class="paddignCelda">
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

								<?php if(!$pintarAbandonar&&($trayectoAgrupado[0]['plazas']>$aceptados)&&!$pintarYaHasSolicitado):?>				
								<button class="btn btn-primary btn-lg botonBusqueda" onclick="llamarAjaxSubmit(this,1)" data-button="<?php echo $trayectoAgrupado[0]['trayecto_id']?>"
									data-user="<?php echo $usuario_buscado->id;?>" class="btn btn-primary btn-lg btn-block" tabindex="7" data-toggle="modal" href="#teHasUnido">Unirse</button>				 
								<?php endif;?>
								
								<!-- PINTAMOS COMPLETO SI NO ESTA EN EL TRAYECTO Y NO HAY PLAZAS DISPONIBLES -->
								<?php if(!$pintarAbandonar&&$trayectoAgrupado[0]['plazas']==$aceptados):?>				
								<p class="top-buffer10"><strong>Trayecto completo</strong></p>				 
								<?php endif;?>
								
								<!-- PINTAMOS ABANDONAR SI NO ESTA EN EL TRAYECTO Y HAY PLAZAS DISPONIBLES -->
								<?php if(isset($pintarAbandonar)&&$pintarAbandonar):?>				
								<button class="btn btn-primary btn-lg botonBusqueda" onclick="llamarAjaxAbandonar(this,1)" data-button="<?php echo $trayectoAgrupado[0]['trayecto_id']?>"
									data-user="<?php echo $usuario_buscado->id;?>" class="btn btn-primary btn-lg btn-block" tabindex="7" data-toggle="modal" href="#hasAbandonado">Abandonar</button>				 
								<?php endif;?>
							<?php endif;?>	
					</td>	
					<td class="paddignCelda2">
						<div class="usuArriba">
							<p class="usuTitulo">Usuarios</p>
						</div>
						<div id="<?php echo "trayecto".$contadorTrayectos;?>" class="usuAbajo">
							<?php $contadorUsuarios=0;?>
							<?php foreach ($trayectoAgrupado as $usu):?>
								<?php if($usu["aceptado"]==1):?>
								<?php $contadorUsuarios++;?>
								<div class="UsuBusqueda">
									<img class="imgBusqueda" src="<?php echo base_url().$usu["foto"]?>"/>
									<p class="nombreViajero"><a href="<?php echo base_url('usuario/mostrarPerfilUsuario/'.$usu["usuarioId"])?>"><?php echo $usu["nombre"]?></a></p>
								</div>
								<?php endif;?>
				 			<?php endforeach;?>
				 			<?php for($i=0;$i<($usu["plazas"]-$contadorUsuarios);$i++):?>
				 				<div class="UsuBusqueda">
									<img src="<?php echo base_url()."assets/img/profile/avatar.png"?>"/>
									<p class="nombreViajero">Libre</p>
								</div>
				 			<?php endfor;?>
						</div>

					</td>
			</tr>					
		</table>		
	<?php endif;?>
<?php endforeach;?>