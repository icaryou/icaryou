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
	$controlador->load->view('bootstrap/head');
	$controlador->load->view($vista,$datos);
	$controlador->load->view('bootstrap/footer');
}
?>