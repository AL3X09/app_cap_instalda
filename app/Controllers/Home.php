<?php

namespace App\Controllers;
// JWT
use \Firebase\JWT\JWT;
// panggil class User
use App\Controllers\User;
// panggil restful api codeigniter 4
use CodeIgniter\RESTful\ResourceController;
use Config\Services;

header("Access-Control-Allow-Origin: * ");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
//protected $session = session();

class Home extends ResourceController{
    
    //public $session = null;
	
	public function __construct()
    {
        // Inicializo la clase usario
        $this->protect = new User();
    }

    public function index(){

        echo view('template/header');
		echo view('template/main_header');
		echo view('template/sidebar');
		echo view('home');
		echo view('template/footer');
    }

	public function index2()
	{
        
		$secret_key = Services::getSecretKey();
        // ambil dari controller auth function public private key
        //$secret_key = $this->protect->privateKey();
 
        
        $token = null;
        
        
        
        $authHeader = $this->request->getServer('HTTP_AUTHORIZATION');
        var_dump($authHeader);
        /*
        $arr = explode(" ", $authHeader);
 
        $token = $arr[1];
        
        /*
        if($token){
 
            try {
         
                $decoded = JWT::decode($token, $secret_key, array('HS256'));
         
                // Access is granted. Add code of the operation here 
                if($decoded){
					//

					echo view('template/header');
					echo view('template/main_header');
					echo view('template/sidebar');
					echo view('home');
					echo view('template/footer');
                    // response true
                    $output = [
                        'message' => 'Access granted'
                    ];
                    return $this->respond($output, 200);
                }
                 
         
            } catch (\Exception $e){
 
                $output = [
                    'message' => 'Access denied',
                    "error" => $e->getMessage()
                ];
         
                return $this->respond($output, 401);
            }
		}*/


		
	}
}
