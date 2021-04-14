<?php
//defined('BASEPATH') OR exit('No direct script access allowed');

namespace App\Controllers;


class Login extends BaseController {

	//public function costruct
    public function __construct() {
		
	}
	
	/*public function removeCache() {
		$this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
		$this->output->set_header('Pragma: no-cache');
	  }*/

	public function index()
	{
		echo view('login_template/header');
		echo view('login_template/main_header');
		echo view('login');
		echo view('login_template/footer');
		
	}
	
}
