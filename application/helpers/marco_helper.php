<?php
function enmarcar($controlador,$vista,$datos=[]) {
	//ESTO ES EL CODIGO ORIGINAL, LO DEJO SIN TOCAR
	/*
	$controlador->load->view('templates/head');
	$controlador->load->view('templates/header');

	$controlador->load->model('menu_model','',true);
	$datos['menu']=$controlador->menu_model->leerTodos();
	$controlador->load->view('templates/nav',$datos);
	
	$controlador->load->view($vista,$datos);
	$controlador->load->view('templates/footer');
	$controlador->load->view('templates/end');
	*/
	$controlador->load->view('templates/head');
	
	//SI HACE LA PETICION CON CONTROLADOR EN LA URL
	
	if(strrpos($vista, "/")){
		$datos['js']=substr(explode("/",$vista)[1], 0, -4);
	}else{
		$datos['js']=substr($vista, 0, -4);
	}
	
	
	$controlador->load->view('templates/masScripts',$datos);
	$controlador->load->view('templates/header');
	$controlador->load->view($vista,$datos);
	$controlador->load->view('templates/footer');
}
?>