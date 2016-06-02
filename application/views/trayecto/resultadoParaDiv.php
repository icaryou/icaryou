<?php $pintarAbandonar=FALSE?>	
				
			<?php if(sizeof($trayectosEncontrados)==0):?><!-- NO ENCUENTRA TRAYECTOS -->
				<h4>Lo lamentamos, no hemos encontrado trayectos con esas opciones.</h4>
			<?php endif;?>
			
			<?php if(sizeof($trayectosEncontrados)!=0):?><!--ENCUENTRA TRAYECTOS -->
				<h2>Mostrando trayectos desde <span class="origenBusqueda"><?php echo "{$camposBusqueda['poblacionOrigen']}"?></span> a 
				<span class="destinoBusqueda"><?php echo "{$camposBusqueda['poblacionDestino']}"?></span>
				</h2>
				<div class="separadorHori"></div>
				<!--  MEJORANDO MAQUETACION -->
				<?php $contadorTrayectos=0;?>
				<?php foreach ($trayectosEncontrados as $trayectoAgrupado):?>
					<?php $contadorTrayectos++;?>
				<table class="elementoBusqueda span8 bottom-bufferElements">
				<tr>
					<td class="paddignCelda">
						<span class="diasBusqueda"><?php echo $trayectoAgrupado[0]['dias']?></span>
						<span class="horasBusqueda"><?php echo $trayectoAgrupado[0]['horallegadadestino']?> - 
						<?php echo $trayectoAgrupado[0]['horaretornodestino']?></span>
						<div class="lugaresBusqueda"><img class="casitas" src="<?php echo base_url();?>/assets/img/casitaVerde.png"/><?php echo $trayectoAgrupado[0]['poblacionOrigen']?></div>
						<div class="lugaresBusqueda"><img class="casitas" src="<?php echo base_url();?>/assets/img/casitaRosa.png"/><?php echo $trayectoAgrupado[0]['poblacionDestino']?></div>
						<div class="comentariosBusqueda"><?php echo $trayectoAgrupado[0]['comentarios']?></div>
						
						<!-- PINTAMOS UNIRSE SI NO ESTA EN EL TRAYECTO Y HAY PLAZAS DISPONIBLES -->
								<?php foreach ($trayectoAgrupado as $usu):?>
									<?php if($usu["usuarioId"]==$this->session->userdata('id')):?>
										<?php $pintarAbandonar=TRUE?>
									<?php endif;?>
								<?php endforeach;?>
						
						
								<?php if(!$pintarAbandonar&&$trayectoAgrupado[0]['plazas']>sizeof($trayectoAgrupado)):?>				
								<button class="btn btn-primary btn-lg botonBusqueda" onclick='location.href="<?php echo base_url('usuario/unirse_trayecto/'.$trayectoAgrupado[0]['trayecto_id'])?>"'
									class="btn btn-primary btn-lg btn-block" tabindex="7">Unirse</button>				 
								<?php endif;?>
								
								<!-- PINTAMOS COMPLETO SI NO ESTA EN EL TRAYECTO Y NO HAY PLAZAS DISPONIBLES -->
								<?php if(!$pintarAbandonar&&$trayectoAgrupado[0]['plazas']==sizeof($trayectoAgrupado)):?>				
								<p>Trayecto completo</p>				 
								<?php endif;?>
								
								<!-- PINTAMOS ABANDONAR SI NO ESTA EN EL TRAYECTO Y HAY PLAZAS DISPONIBLES -->
								<?php if(isset($pintarAbandonar)&&$pintarAbandonar):?>				
								<button class="btn btn-primary btn-lg botonBusqueda" onclick='location.href="<?php echo base_url('usuario/abandonar_trayecto/'.$trayectoAgrupado[0]['trayecto_id'])?>"'
									class="btn btn-primary btn-lg btn-block" tabindex="7">Abandonar</button>				 
								<?php endif;?>
					</td>
					<td>
					<div class="usuArriba">
						<p class="usuTitulo">Usuarios</hp>
					</div>
					<div id="<?php echo "trayecto".$contadorTrayectos;?>" class="usuAbajo">
						<?php $contadorUsuarios=0;?>
						<?php foreach ($trayectoAgrupado as $usu):?>
							<?php $contadorUsuarios++;?>
							<div class="UsuBusqueda">
								<img class="imgBusqueda" src="<?php echo base_url().$usu["foto"]?>"/>
								<p class="nombreViajero"><a href="<?php echo base_url('usuario/mostrarPerfilUsuario/'.$usu["usuarioId"])?>"><?php echo $usu["nombre"]." ".$usu["apellidos"]?></a></p>
							</div>
			 			<?php endforeach;?>
			 			<?php for($i=0;$i<(5-$contadorUsuarios);$i++):?>
			 				<div class="UsuBusqueda">
								<img src="<?php echo base_url()."assets/img/profile/avatar.png"?>"/>
								<p class="nombreViajero">Libre</p>
							</div>
			 			<?php endfor;?>
					</div>

					</td>
				</tr>
				</table>
				<?php endforeach;?>
				<!--  AQUI ACABA LA MEJORA -->
				<br/>
				<div class="pagination-page span3 bottom-bufferElements "></div>	
				
			<?php endif;?>
			<p><?=validation_errors();?></p>