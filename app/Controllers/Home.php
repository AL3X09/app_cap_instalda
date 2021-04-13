<?php

namespace App\Controllers;

class Home extends BaseController
{
	
	//public function costruct
    public function __construct() {
        //parent::__construct(); // BaseController has no Constructor
		//$this->config =& get_config();
		//$this->load->helper(array('url', 'form', 'array', 'html'));
    }

	public function index()
	{
		echo view('template/header');
		echo view('template/main_header');
		echo view('template/sidebar');
		echo view('home');
		echo view('template/footer');
	}
}
