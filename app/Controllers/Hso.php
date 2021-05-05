<?php 
namespace App\Controllers;

use App\Models\HsoModel;
use Config\Services;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use Exception;
use \Firebase\JWT\JWT;



// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control");

//unidad de servicios de salud
class Hso extends ResourceController{
    
    use ResponseTrait;

    public function index(){

        echo view('template/header');
		echo view('template/main_header');
		echo view('template/sidebar');
		echo view('hso_view');
		echo view('template/footer');
    }

    public function getallHso(){
        
        try {
            $hsomodel = new HsoModel();
            
            //vedrifico si llega información del correo
                $exis_hso = $hsomodel->get_all_hso();
                if (!empty($exis_hso)) {

                    $response = [
                        'status' => 200,
                        "error" => FALSE,
                        'data' => $exis_hso,
                    ];

                } else {

                    $response = [
                        'status' => 400,
                        "error" => TRUE,
                        'data' => 'Error, tabla sin datos',
                    ];
                }

            return $this->respond($response);
        } catch (\Exception $e) {
            return $this->failServerError('se ha presntado una exepción ' . $e->getMessage());
        }

    }

    public function detailsHso(){
        
        try {
            $hsomodel = new HsoModel();
            //vedrifico si llega información del correo
            if (!empty($_POST['pkhso'])) {
                //Valido si el correo ya existe en la BD
                $data_hso = $hsomodel->get_data_hso($_POST['pkhso']);
                //envio respuesta a vista
                if (!empty($data_hso)) {
                    $response = [
                        'status' => 200,
                        "error" => FALSE,
                        'data' => $data_hso,
                    ];
                } else {
                    $response = [
                        'status' => 400,
                        "error" => TRUE,
                        'data' => 'Error, no existe el valor consultado',
                    ];
                }

            }else{
                $response = [
                    'status' => 404,
                    "error" => TRUE,
                    'data' => 'Bad, rquest',
                ];
            }
            return $this->respond(json_encode($response));
        } catch (\Exception $e) {
            return $this->failServerError('se ha presntado una exepción ' . $e->getMessage());
        }

    }

    public function insertHso(){
        
        try {
            $hsomodel = new HsoModel();
             //vedrifico si llega información del correo
             if (!empty($_POST['nombre'])) {

                $data = [
                    "nombre" => $this->request->getVar("nombre"),
                    "sigla" => $this->request->getVar("sigla"),
                ];
               //valido si ya esta registrado el correo y envio exeption
               $exis_hso = $hsomodel->exist_hso($data['nombre']);

               if ($exis_hso) {

                   $response = [
                       'status' => 400,
                       "error" => TRUE,
                       'messages' => 'El valor de HSO ya existe',
                   ];
               } else {
                   //Envio datos al modelo para insertar
                   $insert_hso = $hsomodel->insert_hso($data);

                   if ($insert_hso) {
                       $response = [
                           'status' => 201,
                           "error" => FALSE,
                           'messages' => 'HSO creada',
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

    public function updateHso(){
        
        try {
            $hsomodel = new HsoModel();
             //vedrifico si llega información del correo
             if (!empty($_POST['nombre']) && !empty($_POST['idhso'])) {

                $data = [
                    "id" => $this->request->getVar("idhso"),
                    "nombre" => $this->request->getVar("nombre"),
                    "sigla" => $this->request->getVar("sigla"),
                ];
                   //Envio datos al modelo para actualizar
                   $update_hso = $hsomodel->update_hso($data);

                   if ($update_hso) {
                       $response = [
                           'status' => 201,
                           "error" => FALSE,
                           'messages' => 'HSO Actualuzado',
                       ];
                   } else {

                       $response = [
                           'status' => 500,
                           "error" => TRUE,
                           'messages' => 'Fallo al actualizar',
                       ];
                   }
               //}
           } else {

               $response = [
                   'status' => 409,
                   "error" => TRUE,
                   'messages' => 'No se encontraron variables de envio obligatorios',
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

    public function deleteHso(){
        
        try {
            $hsomodel = new HsoModel();
             //vedrifico si llega información del correo
             if (!empty($_POST['pkhso'])) {

                $data = [
                    "id" => $this->request->getVar("pkhso"),
                ];
                   //Envio datos al modelo para actualizar
                   $delete_hso = $hsomodel->delete_hso($data);

                   if ($delete_hso) {
                       $response = [
                           'status' => 201,
                           "error" => FALSE,
                           'messages' => 'HSO Borrado logico',
                       ];
                   } else {

                       $response = [
                           'status' => 500,
                           "error" => TRUE,
                           'messages' => 'Fallo al borrar',
                       ];
                   }
               //}
           } else {

               $response = [
                   'status' => 409,
                   "error" => TRUE,
                   'messages' => 'No se encontraron variables de envio, para eliminar',
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


}