<?php 
namespace App\Controllers;


use Config\Services;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use Exception;
use \Firebase\JWT\JWT;
use App\Models\CapacidaduusModel;


// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control");

//grupo de la unidad de servicios de salud
class Capacidaduus extends ResourceController{
    
    use ResponseTrait;

    public function index(){
        echo view('template/header');
		echo view('template/main_header');
		echo view('template/sidebar');
		echo view('datosuss_view');
		echo view('template/footer');
    }

    public function getallCapuss(){
        
        try {
            $capacidaduusModel = new CapacidaduusModel();
            
            //vedrifico si llega información del correo
            $exis_capuss = $capacidaduusModel->get_all_capacidaduus();
                if (!empty($exis_capuss)) {

                    $response = [
                        'status' => 200,
                        "error" => FALSE,
                        'data' => $exis_capuss,
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

    public function detailsCapuss(){
        
        try {
            $capacidaduusModel = new CapacidaduusModel();
            //vedrifico si llega información del correo
            if (!empty($_POST['pkcapauss'])) {
                //Valido si el correo ya existe en la BD
                $data_capauss = $capacidaduusModel->get_data_capacidaduus($_POST['pkcapauss']);
                //envio respuesta a vista
                if (!empty($data_capauss)) {
                    $response = [
                        'status' => 200,
                        "error" => FALSE,
                        'data' => $data_capauss,
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

    public function insertCapuss(){
        
        try {
            $capacidaduusModel = new CapacidaduusModel();
             //vedrifico si llega información obligatoria
             if (!empty($_POST['pkrel']) ) {

                $data = [
                    "num_cama_uus" => $this->request->getVar("numcamuus"),
                    "num_consultorio_uus" => $this->request->getVar("numespauus"),
                    "num_paciente_uus" => $this->request->getVar("numpacuus"),
                    "fk_tbl_uss_gus_svo_pro" => $this->request->getVar("pkrel"),
                ];

                   //consulto el numero de filas para armar el consecutivo
                   $count_capauus = $capacidaduusModel->count_capacidaduus();
                   $data['consec'] = ($count_capauus+1);
                   //Envio datos al modelo para insertar
                   $insert_capauss = $capacidaduusModel->insert_capacidaduus($data);
                   //print_r($insert_capauss);
                   //$ultinsert_id = $capacidaduusModel->insertID();
                   
                   if ($insert_capauss) {
                       $response = [
                           'status' => 201,
                           "error" => FALSE,
                           'messages' => 'Capacidad de la unidad de servicios creado',
                           //'ultinsert_id' => $ultinsert_id,
                       ];
                   } else {
                       $response = [
                           'status' => 500,
                           "error" => TRUE,
                           'messages' => 'Fallo al crear',
                       ];
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

    public function updateCapuss(){
        
        try {
            $capacidaduusModel = new CapacidaduusModel();
             //vedrifico si llega información del correo
             if (!empty($_POST['pkrela']) && !empty($_POST['pkcapauss']) ) {

                $data = [
                    "id" => $this->request->getVar("pkcapauss"),
                    "numpacuus" => $this->request->getVar("numpacuus"),
                    "numespauus" => $this->request->getVar("numespauus"),
                    "numcamuus" => $this->request->getVar("numcamuus"),
                ];
                   //Envio datos al modelo para actualizar
                   $update_capauss = $capacidaduusModel->update_capacidaduus($data);

                   if ($update_capauss) {
                       $response = [
                           'status' => 201,
                           "error" => FALSE,
                           'messages' => 'Datos del servicio Actualizado',
                       ];
                   } else {

                       $response = [
                           'status' => 500,
                           "error" => TRUE,
                           'messages' => 'Fallo al actualizar los Datos del servicio',
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

    public function deleteCapuss(){
        
        try {
            $progModel = new ProgramaModel();
             //vedrifico si llega información del correo
             if (!empty($_POST['idprog'])) {

                $data = [
                    "id" => $this->request->getVar("idprog"),
                ];
                   //Envio datos al modelo para actualizar
                   $delete_prog = $progModel->delete_programa($data);

                   if ($delete_prog) {
                       $response = [
                           'status' => 201,
                           "error" => FALSE,
                           'messages' => 'Programa Borrado en lógico',
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


}