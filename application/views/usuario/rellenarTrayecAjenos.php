<?php $contadorTrayectos=0;?>
<?php foreach ($trayectosPropiosEncontrados as $trayectoAgrupado):?>
<!-- EN CADA $TRAYECTO AGRUPADO TENEMOS UN SOLO TRAYECTO PERO TANTAS FILAS COMO USUARIOS TENGA ESE TRAYECTO -->

<?php if($trayectoAgrupado[0]['creador']!=$this->session->userdata('id')):?>
<?php $contadorTrayectos++;?>
				<table id="tablaAjenos" class="elementoBusquedaAjenos span10 bottom-bufferElements">
				<tr>
					<td class="paddignCeldaTrayec">
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
								
								<!-- PINTAMOS ABANDONAR SI NO ESTA EN EL TRAYECTO Y HAY PLAZAS DISPONIBLES -->
								<?php if(isset($pintarAbandonar)&&$pintarAbandonar):?>				
								<button class="btn btn-primary btn-lg botonBusqueda" onclick="llamarAjaxAbandonar(this,1)" data-button="<?php echo $trayectoAgrupado[0]['trayecto_id']?>"
									class="btn btn-primary btn-lg btn-block" tabindex="7" data-toggle="modal" href="#hasAbandonado">Abandonar</button>					 
								<?php endif;?>
					</td>
					<td class="paddignCelda2">
					<div class="usuArriba">
						<p class="usuTitulo">Usuarios</p>
					</div>
					<div id="<?php echo "trayecto".$contadorTrayectos;?>" class="usuAbajo">
						<?php $contadorUsuarios=0;?>
						<?php foreach ($trayectoAgrupado as $usu):?>
							<?php $contadorUsuarios++;?>
							<div class="UsuTrayecto">
								<img class="imgUsuTrayecto" src="<?php echo base_url().$usu["foto"]?>"/>
								<p class="nombreViajero"><a href="<?php echo base_url('usuario/mostrarPerfilUsuario/'.$usu["usuarioId"])?>"><?php echo $usu["nombre"]." ".$usu["apellidos"]?></a></p>
							</div>
			 			<?php endforeach;?>
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