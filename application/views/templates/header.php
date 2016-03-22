<header>
	<span class="titulo">CRUD de EMPLEADOS</span>
	<div id="usuario"><?=$this->session->userdata('logueado')?$this->session->userdata('nombre').$this->session->userdata('apellidos'):'No has hecho login' ?></div>
</header>
