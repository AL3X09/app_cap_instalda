<?php 
namespace App\Controllers;


use Config\Services;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use Exception;
use \Firebase\JWT\JWT;
use App\Models\SvoModel;


// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control");

//grupo de la unidad de servicios de salud
class Svo extends ResourceController{
    
    use ResponseTrait;

    public function index(){

        echo view('template/header');
		echo view('template/main_header');
		echo view('template/sidebar');
		echo view('svo_view');
		echo view('template/footer');
    }

    public function getallSvo(){
        
        try {
            $svoModel = new SvoModel();
            
            //vedrifico si llega información del correo
            $exis_svo = $svoModel->get_all_svo();
                if (!empty($exis_svo)) {

                    $response = [
                        'status' => 200,
                        "error" => FALSE,
                        'data' => $exis_svo,
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

    public function detailsSvo(){
        
        try {
            $svoModel = new SvoModel();
            //vedrifico si llega información del correo
            if (!empty($_POST['pksvo'])) {
                //Valido si el correo ya existe en la BD
                $data_svo = $svoModel->get_data_svo($_POST['pksvo']);
                //envio respuesta a vista
                if (!empty($data_svo)) {
                    $response = [
                        'status' => 200,
                        "error" => FALSE,
                        'data' => $data_svo,
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
                    'data' => 'Se esperaba la variable de consulta, Bad rquest',
                ];
            }
            return $this->respond(json_encode($response));
        } catch (\Exception $e) {
            return $this->failServerError('se ha presntado una exepción ' . $e->getMessage());
        }

    }

    public function detail_fk(){
        
        try {
            $svoModel = new SvoModel();
            //vedrifico si llega información del correo
            if (!empty($_POST['pkgus'])) {
                //Valido si el correo ya existe en la BD
                $data_svo = $svoModel->get_data_fkgus($_POST['pkgus']);
                //envio respuesta a vista
                if (!empty($data_svo)) {
                    $response = [
                        'status' => 200,
                        "error" => FALSE,
                        'data' => $data_svo,
                    ];
                } else {
                    $response = [
                        'status' => 400,
                        "error" => TRUE,
                        'data' => 'Error, no existe el valor consultado por la relación',
                    ];
                }

            }else{
                $response = [
                    'status' => 404,
                    "error" => TRUE,
                    'data' => 'Se esperaba la variable de consulta, Bad rquest',
                ];
            }
            return $this->respond(json_encode($response));
        } catch (\Exception $e) {
            return $this->failServerError('se ha presntado una exepción ' . $e->getMessage());
        }

    }

    public function insertSvo(){
        
        try {
            $svoModel = new SvoModel();
             //vedrifico si llega información obligatoria
             if (!empty($_POST['nombre']) ) {

                $data = [
                    "codigo" => $this->request->getVar("codigo"),
                    "nombre_serv" => $this->request->getVar("nombre"),
                ];
               //valido si ya esta registrado el correo y envio exeption
               $exist_svo = $svoModel->exist_svo($data['nombre_serv']);

               if ($exist_svo) {

                   $response = [
                       'status' => 400,
                       "error" => TRUE,
                       'messages' => 'El valor del Servicio ofertado ya existe',
                   ];
               } else {
                   //consulto el numero de filas para armar el consecutivo
                   $count_svo = $svoModel->count_svo();
                   $data['consec'] = ($count_svo+1);
                   //Envio datos al modelo para insertar
                   $insert_svo = $svoModel->insert_svo($data);
                   //$insert_svo = false;

                   if ($insert_svo) {
                       $response = [
                           'status' => 201,
                           "error" => FALSE,
                           'messages' => 'Servico de oferta creado',
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
                   'messages' => 'No se encontraron variables de envio obligatorias',
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

    public function updateSvo(){
        
        try {
            $svoModel = new SvoModel();
             //vedrifico si llega información del correo
             if (!empty($_POST['nombre'])) {

                $data = [
                    "id" => $this->request->getVar("idsvo"),
                    "nombre" => $this->request->getVar("nombre"),
                    "codigo" => $this->request->getVar("codigo"),
                ];
                   //Envio datos al modelo para actualizar
                   $update_svo = $svoModel->update_svo($data);

                   if ($update_svo) {
                       $response = [
                           'status' => 201,
                           "error" => FALSE,
                           'messages' => 'Servicio ofertado Actualizado',
                       ];
                   } else {

                       $response = [
                           'status' => 500,
                           "error" => TRUE,
                           'messages' => 'Fallo al actualizar el Servicio ofertado',
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

    public function deleteSvo(){
        
        try {
            $svoModel = new SvoModel();
             //vedrifico si llega información del correo
             if (!empty($_POST['idsvo'])) {

                $data = [
                    "id" => $this->request->getVar("idsvo"),
                ];
                   //Envio datos al modelo para actualizar
                   $delete_svo = $svoModel->delete_svo($data);

                   if ($delete_svo) {
                       $response = [
                           'status' => 201,
                           "error" => FALSE,
                           'messages' => 'Servicio ofertado Borrado en lógico',
                       ];
                   } else {

                       $response = [
                           'status' => 500,
                           "error" => TRUE,
                           'messages' => 'Fallo al borrar el Servicio ofertado',
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

    public function countallSvo(){
        
        try {
            $svoModel = new SvoModel();
            
            //vedrifico si llega información del correo
            $exis_svo = $svoModel->count_all_svo();
                if (!empty($exis_svo)) {

                    $response = [
                        'status' => 200,
                        "error" => FALSE,
                        'data' => $exis_svo,
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


}