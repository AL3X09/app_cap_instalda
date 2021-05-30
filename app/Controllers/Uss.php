<?php 
namespace App\Controllers;


use Config\Services;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use Exception;
use \Firebase\JWT\JWT;
use App\Models\UssModel;


// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control");

//unidad de servicios de salud
class Uss extends ResourceController{
    
    use ResponseTrait;

    public function index(){

        echo view('template/header');
		echo view('template/main_header');
		echo view('template/sidebar');
		echo view('uss_view');
		echo view('template/footer');
    }

    public function getallUss(){
        
        try {
            $ussModel = new UssModel();
            
            //vedrifico si llega información del correo
            $exis_uss = $ussModel->get_all_uss();
                if (!empty($exis_uss)) {

                    $response = [
                        'status' => 200,
                        "error" => FALSE,
                        'data' => $exis_uss,
                    ];

                } else {

                    $response = [
                        'status' => 400,
                        "error" => TRUE,
                        'messages' => 'Error, tabla sin datos',
                    ];
                }

            return $this->respond($response);
        } catch (\Exception $e) {
            return $this->failServerError('se ha presntado una exepción ' . $e->getMessage());
        }

    }

    public function detailsUss(){
        
        try {
            $ussModel = new UssModel();
            //vedrifico si llega información del correo
            if (!empty($_POST['pkuss'])) {
                //Valido si el correo ya existe en la BD
                $data_uss = $ussModel->get_data_uss($_POST['pkuss']);
                //envio respuesta a vista
                if (!empty($data_uss)) {
                    $response = [
                        'status' => 200,
                        "error" => FALSE,
                        'data' => $data_uss,
                    ];
                } else {
                    $response = [
                        'status' => 400,
                        "error" => TRUE,
                        'messages' => 'Error, no existe el valor consultado',
                    ];
                }

            }else{
                $response = [
                    'status' => 404,
                    "error" => TRUE,
                    'messages' => 'Se esperaba la variable de consulta, Bad rquest',
                ];
            }
            return $this->respond(json_encode($response));
        } catch (\Exception $e) {
            return $this->failServerError('se ha presntado una exepción ' . $e->getMessage());
        }

    }

    public function insertUss(){
        
        try {
            $ussModel = new UssModel();
             //vedrifico si llega información obligatoria
             if (!empty($_POST['hso']) && !empty($_POST['nombre']) ) {

                $data = [
                    "fk_tbl_serv_hospital" => $this->request->getVar("hso"),
                    "nombre" => $this->request->getVar("nombre"),
                    "direccion" => $this->request->getVar("direccion"),
                    "telefono" => $this->request->getVar("telefono"),
                ];
               //valido si ya esta registrado el correo y envio exeption
               $exis_uss = $ussModel->exist_uss($data['nombre']);

               if ($exis_uss) {

                   $response = [
                       'status' => 400,
                       "error" => TRUE,
                       'messages' => 'El valor de USS ya existe',
                   ];
               } else {
                   //Envio datos al modelo para insertar
                   $insert_uss = $ussModel->insert_uss($data);

                   if ($insert_uss) {
                       $response = [
                           'status' => 201,
                           "error" => FALSE,
                           'messages' => 'USS creada',
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

    public function updateUss(){
        
        try {
            $ussmodel = new UssModel();
             //vedrifico si llega información del correo
             if (!empty($_POST['nombre']) && !empty($_POST['idhso']) && !empty($_POST['iduss'])) {

                $data = [
                    "id" => $this->request->getVar("iduss"),
                    "nombre" => $this->request->getVar("nombre"),
                    "direccion" => $this->request->getVar("direccion"),
                    "telefono" => $this->request->getVar("telefono"),
                    "idhso" => $this->request->getVar("idhso"),
                ];
                   //Envio datos al modelo para actualizar
                   $update_hso = $ussmodel->update_uss($data);

                   if ($update_hso) {
                       $response = [
                           'status' => 201,
                           "error" => FALSE,
                           'messages' => 'Unidad de Servicios Actualizada',
                       ];
                   } else {

                       $response = [
                           'status' => 500,
                           "error" => TRUE,
                           'messages' => 'Fallo al actualizar Unidad de Servicios',
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

    public function deleteUss(){
        
        try {
            $ussmodel = new UssModel();
             //vedrifico si llega información del correo
             if (!empty($_POST['iduss'])) {

                $data = [
                    "id" => $this->request->getVar("iduss"),
                ];
                   //Envio datos al modelo para actualizar
                   $delete_uss = $ussmodel->delete_uss($data);

                   if ($delete_uss) {
                       $response = [
                           'status' => 201,
                           "error" => FALSE,
                           'messages' => 'Unidad de Servicios Borrada en logico',
                       ];
                   } else {

                       $response = [
                           'status' => 500,
                           "error" => TRUE,
                           'messages' => 'Fallo al borrar Unidad de Servicios',
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

    public function countallUss(){
        
        try {
            $ussModel = new UssModel();
            
            //vedrifico si llega información del correo
            $count_uss = $ussModel->count_all_uss();
                if (!empty($count_uss)) {

                    $response = [
                        'status' => 200,
                        "error" => FALSE,
                        'data' => $count_uss,
                    ];

                } else {

                    $response = [
                        'status' => 400,
                        "error" => TRUE,
                        'messages' => 'Error, tabla sin datos',
                    ];
                }

            return $this->respond($response);
        } catch (\Exception $e) {
            return $this->failServerError('se ha presntado una exepción ' . $e->getMessage());
        }

    }
    
    public function detail_x_fk(){
        
        try {
            $ussModel = new UssModel();
            //vedrifico si llega información del correo
            if (!empty($_POST['pkhso'])) {
                //Valido si el correo ya existe en la BD
                $data_gus = $ussModel->get_data_x_fk($_POST['pkhso']);
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
                        'messages' => 'Error, no existe datos para el valor consultado',
                    ];
                }

            }else{
                $response = [
                    'status' => 404,
                    "error" => TRUE,
                    'messages' => 'Se esperaba la variable de consulta, Bad rquest',
                ];
            }
            return $this->respond(json_encode($response));
        } catch (\Exception $e) {
            return $this->failServerError('se ha presntado una exepción ' . $e->getMessage());
        }

    }


}