<?php 
namespace App\Controllers;


use Config\Services;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use Exception;
use \Firebase\JWT\JWT;
use App\Models\ProgramaModel;


// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control");

//grupo de la unidad de servicios de salud
class Programa extends ResourceController{
    
    use ResponseTrait;

    public function index(){

        echo view('template/header');
		echo view('template/main_header');
		echo view('template/sidebar');
		echo view('programa_view');
		echo view('template/footer');
    }

    public function getallProg(){
        
        try {
            $progModel = new ProgramaModel();
            
            //vedrifico si llega información del correo
            $exis_prog = $progModel->get_all_programa();
                if (!empty($exis_prog)) {

                    $response = [
                        'status' => 200,
                        "error" => FALSE,
                        'data' => $exis_prog,
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

    public function detailsProg(){
        
        try {
            $progModel = new ProgramaModel();
            //vedrifico si llega información del correo
            if (!empty($_POST['idprog'])) {
                //Valido si el correo ya existe en la BD
                $data_prog = $progModel->get_data_programa($_POST['idprog']);
                //envio respuesta a vista
                if (!empty($data_prog)) {
                    $response = [
                        'status' => 200,
                        "error" => FALSE,
                        'data' => $data_prog,
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
            $progModel = new ProgramaModel();
            //vedrifico si llega información del correo
            if (!empty($_POST['pksov'])) {
                //Valido si el correo ya existe en la BD
                $data_x_fk = $progModel->get_data_x_fk($_POST['pksov']);
                //envio respuesta a vista
                if (!empty($data_x_fk)) {
                    $response = [
                        'status' => 200,
                        "error" => FALSE,
                        'data' => $data_x_fk,
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

    public function insertProg(){
        
        try {
            $progModel = new ProgramaModel();
             //vedrifico si llega información obligatoria
             if (!empty($_POST['pksvo']) && !empty($_POST['programa']) && !empty($_POST['perfil']) ) {

                $data = [
                    "fk_tbl_serv_ofertado" => $this->request->getVar("pksvo"),
                    "nombre_prog" => $this->request->getVar("programa"),
                    "perfil_est" => $this->request->getVar("perfil"),
                ];
               //valido si ya esta registrado el correo y envio exeption
               $exist_prog = $progModel->exist_programa($data['nombre_prog']);

               if ($exist_prog) {

                   $response = [
                       'status' => 400,
                       "error" => TRUE,
                       'messages' => 'El valor del Servicio ofertado ya existe',
                   ];
               } else {
                   //consulto el numero de filas para armar el consecutivo
                   $count_prog = $progModel->count_programa();
                   $data['consec'] = ($count_prog+1);
                   //Envio datos al modelo para insertar
                   $insert_prog = $progModel->insert_programa($data);

                   if ($insert_prog) {
                       $response = [
                           'status' => 201,
                           "error" => FALSE,
                           'messages' => 'Programa creado',
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

    public function updateProg(){
        
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

    public function deleteProg(){
        
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