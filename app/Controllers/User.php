<?php

namespace App\Controllers;

//use CodeIgniter\Controller;
use App\Models\UserModel;
use Config\Services;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use Exception;
use \Firebase\JWT\JWT;



// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control");

class User extends ResourceController
{
    use ResponseTrait;

    public function existe_correo()
    {

        try {
            $userModel = new UserModel();
            //vedrifico si llega información del correo
            if (!empty($_POST['correo'])) {
                //Valido si el correo ya existe en la BD
                $exis_email = $userModel->exist_email($_POST['correo']);
                //envio respuesta a vista
                if ($exis_email) {
                    $response = [
                        'status' => 400,
                        "error" => TRUE,
                        'messages' => 'El correo ya existe',
                    ];
                } else {
                    $response = '';
                }
            }
            return $this->respond($response);
        } catch (\Exception $e) {
            return $this->failServerError('se ha presntado una exepción ' . $e->getMessage());
        }
    }

    public function createUser()
    {
        try {
            $userModel = new UserModel();
            //vedrifico si llega información del correo
            if (!empty($_POST['correo'])) {

                $data = [
                    "nombres" => $this->request->getVar("nombres"),
                    "apellidos" => $this->request->getVar("apellidos"),
                    "correo" => strtolower($this->request->getVar("correo")),
                    "telefono" => $this->request->getVar("telefono"),
                    "contrasenia" => password_hash($this->request->getVar("contrasenia"), PASSWORD_DEFAULT),
                ];
                //valido si ya esta registrado el correo y envio exeption
                $exis_email = $userModel->exist_email($data['correo']);

                if ($exis_email) {

                    $response = [
                        'status' => 400,
                        "error" => TRUE,
                        'messages' => 'El correo ya existe',
                    ];
                } else {
                    //Envio datos al modelo para insertar
                    $register = $userModel->register($data);

                    if ($register) {
                        $response = [
                            'status' => 201,
                            "error" => FALSE,
                            'messages' => 'Userio creado',
                        ];
                    } else {

                        $response = [
                            'status' => 500,
                            "error" => TRUE,
                            'messages' => 'Fallo al crear',
                        ];
                    }
                }
            } else {

                $response = [
                    'status' => 409,
                    "error" => TRUE,
                    'messages' => 'No se encontraron variables de envio',
                ];
            }
        } catch (\Exception $e) {
            $response = [
                'status' => 500,
                "error" => TRUE,
                'messages' => 'se ha presntado una exepción ' . $e->getMessage(),
            ];
            //die($e->getMessage());
        }
        return $this->respond($response);
    }

    public function validateUser()
    {
        try {

            $userModel = new UserModel();

            //$userdata = $userModel->where("correo", strtolower($this->request->getVar("correo")))->first();
            //Busco informacióndel usuario
            $userdata = $userModel->data_user(strtolower($_POST['correo']));

            //valido si existe un usuario
            if (!empty($userdata)) {

                if (password_verify($_POST['contrasenia'], $userdata['contrasenia'])) {

                    $key = Services::getSecretKey();

                    $iat = time();
                    $nbf = $iat + 10;
                    $exp = $iat + 3600;

                    $payload = array(
                        "iss" => base_url(),
                        "aud" => "The_Aud",
                        "iat" => $iat,
                        "nbf" => $nbf,
                        "exp" => $exp,
                        "data" => $userdata,
                    );

                    $token = JWT::encode($payload, $key);

                    $response = [
                        'status' => 201,
                        'error' => FALSE,
                        'messages' => 'Usuario logeado satisfactoriamente',
                        'token' => $token
                    ];
                    session_start();
                    $_SESSION['usuario'] = serialize($token);
                    return $this->respondCreated($response);
                    header('Location: ' . base_url() . 'Home');
                    ob_end_flush();

                    //return Home::index();
                    //$this->session->destroy();

                    //echo $this->session->get('token');
                    //header('Location: ' . base_url() . 'Home');
                    //ob_end_flush();
                    //return $this->respondCreated($response);
                } else {

                    $response = [
                        'status' => 400,
                        'error' => TRUE,
                        'messages' => 'Detos Incorrectos'
                    ];
                    session_destroy();
				    //$this->index();
                    return $this->respond($response);
                }
            } else {
                $response = [
                    'status' => 400,
                    'error' => TRUE,
                    'messages' => 'Usuario no encontrado'
                ];
                session_destroy();
				//$this->index();
                return $this->respond($response);
            }
        } catch (\Exception $e) {
            return $this->failServerError('se ha presntado una exepción ' . $e->getMessage());
        }
    }

    public function userDetails()
    {
        $key = Services::getSecretKey();
        $authHeader = $this->request->getHeader("Authorization");
        $authHeader = $authHeader->getValue();
        $token = $authHeader;

        try {
            $decoded = JWT::decode($token, $key, array("HS256"));

            if ($decoded) {

                $response = [
                    'status' => 200,
                    'error' => FALSE,
                    'messages' => 'Detalle de Userio',
                    'data' => $decoded
                ];
                return $this->respondCreated($response);
            }
        } catch (Exception $ex) {
            $response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Acceso denegado'
            ];
            return $this->respondCreated($response);
        }
    }

    function cerrarSesion() {
		session_start();
		unset($_SESSION['usuario']);
        return redirect()->to('Login');
	  }

}
