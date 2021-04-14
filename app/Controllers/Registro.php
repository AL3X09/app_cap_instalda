<?php 
namespace App\Controllers;

use CodeIgniter\Controller;

class Registro extends Controller{

    public function index()
	{
		echo view('login_template/header');
		echo view('login_template/main_header');
		echo view('registro');
		echo view('login_template/footer');
		
	}

}