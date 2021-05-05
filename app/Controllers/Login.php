<?php
//defined('BASEPATH') OR exit('No direct script access allowed');

namespace App\Controllers;


class Login extends BaseController {

	//public function costruct
    public function __construct() {
		
	}

	public function index()
	{
		echo view('login_template/header');
		echo view('login_template/main_header');
		echo view('login');
		echo view('login_template/footer');
		
	}
	
}
