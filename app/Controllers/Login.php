<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	//public function costruct
    public function __construct() {
        parent:: __construct();
        $this->load->helper(array('url', 'form', 'array', 'html'));
		$this->load->model(array('UsuarioModel', '',''));
		
	}
	
	public function removeCache() {
		$this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
		$this->output->set_header('Pragma: no-cache');
	  }

	public function index()
	{
		$this->removeCache();
		$this->load->view('sesion/headersesion');
		$this->load->view('sesion/navsesion');
		$this->load->view('sesion/login');
		$this->load->view('sesion/footersesion');
		
	}

	function acceder() {
		$this->removeCache();
		$Tbuario = new UsuarioModel();
		$Nombre_usua = mb_strtolower($_POST['usuario'], 'UTF-8');
		$Contrasena_usua = $_POST['password'];
		
			$usuario = $this->UsuarioModel->verificarAspirante($Nombre_usua);
			
			if (($usuario->usuario != '' && $usuario->contrasenia != '') && ($usuario->usuario == $Nombre_usua && $this->encryption->decrypt($usuario->contrasenia) == $Contrasena_usua)) {
			  
			  if ($usuario->estado=='Activo') {
				session_start();
				$_SESSION ['usuario'] = serialize($usuario);
				  header('Location: ' . base_url() . 'Tema');
				  ob_end_flush();
			  } else {
				session_destroy();
				$this->index();
			  }
			} else {
				session_destroy();
				$this->index();
			}
		
	  }

	function cerrarSesion() {
		session_start();
		unset($_SESSION['usuario']);
		header("Location: " . base_url() . "Welcome");
	  }

	
  
	
}
