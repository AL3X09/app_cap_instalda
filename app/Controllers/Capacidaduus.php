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
       
    }

    public function getallCapuss(){
        
        try {
            $capacidaduusModel = new CapacidaduusModel();
            
            //vedrifico si llega información del correo
            $exis_estd = $estandModel->get_all_estandar();
                if (!empty($exis_estd)) {

                    $response = [
                        'status' => 200,
                        "error" => FALSE,
                        'data' => $exis_estd,
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
            $estandModel = new EstandarModel();
            //vedrifico si llega información del correo
            if (!empty($_POST['idstand'])) {
                //Valido si el correo ya existe en la BD
                $data_estand = $estandModel->get_data_estandar($_POST['idstand']);
                //envio respuesta a vista
                if (!empty($data_estand)) {
                    $response = [
                        'status' => 200,
                        "error" => FALSE,
                        'data' => $data_estand,
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
             if (!empty($_POST['pkgus']) && !empty($_POST['pksvo']) && !empty($_POST['pkprog']) ) {

                $data = [
                    "num_cama_uus" => $this->request->getVar("numcamuus"),
                    "num_consultorio_uus" => $this->request->getVar("numespauus"),
                    "num_paciente_uus" => $this->request->getVar("numpacuus"),
                    "fk_tbl_programa" => $this->request->getVar("pkprog"),
                ];

                   //consulto el numero de filas para armar el consecutivo
                   $count_capauus = $capacidaduusModel->count_capacidaduus();
                   $data['consec'] = ($count_capauus+1);
                   //Envio datos al modelo para insertar
                   $insert_capauss = $capacidaduusModel->insert_capacidaduus($data);

                   if ($insert_capauss) {
                       $response = [
                           'status' => 201,
                           "error" => FALSE,
                           'messages' => 'Capacidad de la unidad de servicios creado',
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
            $progModel = new ProgramaModel();
             //vedrifico si llega información del correo
             if (!empty($_POST['idprog']) && !empty($_POST['pksvo']) && !empty($_POST['programa']) && !empty($_POST['perfil']) ) {

                $data = [
                    "id" => $this->request->getVar("idprog"),
                    "programa" => $this->request->getVar("programa"),
                    "perfil" => $this->request->getVar("perfil"),
                    "pksvo" => $this->request->getVar("pksvo"),
                ];
                   //Envio datos al modelo para actualizar
                   $update_svo = $progModel->update_programa($data);

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