<?php 
namespace App\Controllers;


use Config\Services;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use Exception;
use \Firebase\JWT\JWT;
use App\Models\GusModel;


// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control");

//grupo de la unidad de servicios de salud
class Gus extends ResourceController{
    
    use ResponseTrait;

    public function index(){

        echo view('template/header');
		echo view('template/main_header');
		echo view('template/sidebar');
		echo view('gus_view');
		echo view('template/footer');
    }

    public function getallGus(){
        
        try {
            $gusModel = new GusModel();
            
            //vedrifico si llega información del correo
            $exis_gus = $gusModel->get_all_gus();
                if (!empty($exis_gus)) {

                    $response = [
                        'status' => 200,
                        "error" => FALSE,
                        'data' => $exis_gus,
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

    public function detailsGus(){
        
        try {
            $gusModel = new GusModel();
            //vedrifico si llega información del correo
            if (!empty($_POST['pkgus'])) {
                //Valido si el correo ya existe en la BD
                $data_gus = $gusModel->get_data_gus($_POST['pkgus']);
                //envio respuesta a vista
                if (!empty($data_gus)) {
                    $response = [
                        'status' => 200,
                        "error" => FALSE,
                        'data' => $data_gus,
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
            $gusModel = new GusModel();
            //vedrifico si llega información del correo
            if (!empty($_POST['pkuus'])) {
                //Valido si el correo ya existe en la BD
                $data_gus = $gusModel->get_data_x_fk($_POST['pkuus']);
                //envio respuesta a vista
                if (!empty($data_gus)) {
                    $response = [
                        'status' => 200,
                        "error" => FALSE,
                        'data' => $data_gus,
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

    public function insertGus(){
        
        try {
            $gusModel = new GusModel();
             //vedrifico si llega información obligatoria
             if (!empty($_POST['uss']) && !empty($_POST['grupo']) ) {

                $data = [
                    "fk_tbl_serv_salud" => $this->request->getVar("uss"),
                    "numero" => $this->request->getVar("numero"),
                    "grupo" => $this->request->getVar("grupo"),
                    "codigo" => $this->request->getVar("codigo"),
                ];
               //valido si ya esta registrado el correo y envio exeption
               $exis_gus = $gusModel->exist_gus($data['grupo']);

               if ($exis_gus) {

                   $response = [
                       'status' => 400,
                       "error" => TRUE,
                       'messages' => 'El valor del Grupo ya existe',
                   ];
               } else {
                   //Envio datos al modelo para insertar
                   $insert_gus = $gusModel->insert_gus($data);

                   if ($insert_gus) {
                       $response = [
                           'status' => 201,
                           "error" => FALSE,
                           'messages' => 'Grupo creado',
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

    public function updateGus(){
        
        try {
            $gusModel = new GusModel();
             //vedrifico si llega información del correo
             if (!empty($_POST['grupo']) && !empty($_POST['pkuss']) && !empty($_POST['idgus'])) {

                $data = [
                    "id" => $this->request->getVar("idgus"),
                    "numero" => $this->request->getVar("numero"),
                    "grupo" => $this->request->getVar("grupo"),
                    "codigo" => $this->request->getVar("codigo"),
                    "pkuss" => $this->request->getVar("pkuss"),
                ];
                   //Envio datos al modelo para actualizar
                   $update_gus = $gusModel->update_gus($data);

                   if ($update_gus) {
                       $response = [
                           'status' => 201,
                           "error" => FALSE,
                           'messages' => 'Servicio Actualizado',
                       ];
                   } else {

                       $response = [
                           'status' => 500,
                           "error" => TRUE,
                           'messages' => 'Fallo al actualizar el Servicios',
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

    public function deleteGus(){
        
        try {
            $gusModel = new GusModel();
             //vedrifico si llega información del correo
             if (!empty($_POST['idgus'])) {

                $data = [
                    "id" => $this->request->getVar("idgus"),
                ];
                   //Envio datos al modelo para actualizar
                   $delete_gus = $gusModel->delete_gus($data);

                   if ($delete_gus) {
                       $response = [
                           'status' => 201,
                           "error" => FALSE,
                           'messages' => 'Grupo Borrado en logico',
                       ];
                   } else {

                       $response = [
                           'status' => 500,
                           "error" => TRUE,
                           'messages' => 'Fallo al borrar el Grupo',
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

    public function countallGus(){
        
        try {
            $gusModel = new GusModel();
            
            //vedrifico si llega información del correo
            $count_gus = $gusModel->count_all_gus();
                if (!empty($count_gus)) {

                    $response = [
                        'status' => 200,
                        "error" => FALSE,
                        'data' => $count_gus,
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