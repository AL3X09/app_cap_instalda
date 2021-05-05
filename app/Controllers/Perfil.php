<?php 
namespace App\Controllers;


use Config\Services;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use Exception;
use \Firebase\JWT\JWT;
use App\Models\PerfilModel;


// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control");

//grupo de la unidad de servicios de salud
class Perfil extends ResourceController{
    
    use ResponseTrait;

    public function index(){

        echo view('template/header');
		echo view('template/main_header');
		echo view('template/sidebar');
		echo view('perfil_view');
		echo view('template/footer');
    }

    public function getallPerf(){
        
        try {
            $perfilModel = new PerfilModel();
            
            //vedrifico si llega información del correo
            $exis_perf = $perfilModel->get_all_perfil();
                if (!empty($exis_perf)) {

                    $response = [
                        'status' => 200,
                        "error" => FALSE,
                        'data' => $exis_perf,
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

    public function detailsPerf(){
        
        try {
            $perfilModel = new PerfilModel();
            //vedrifico si llega información del correo
            if (!empty($_POST['idprog'])) {
                //Valido si el correo ya existe en la BD
                $data_perf = $perfilModel->get_data_perfil($_POST['idprog']);
                //envio respuesta a vista
                if (!empty($data_perf)) {
                    $response = [
                        'status' => 200,
                        "error" => FALSE,
                        'data' => $data_perf,
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

    public function detail_fk_Perf(){
        
        try {
            $perfilModel = new PerfilModel();
            //vedrifico si llega información del correo
            if (!empty($_POST['pksov'])) {
                //Valido si el correo ya existe en la BD
                $data_x_fk = $perfilModel->get_data_x_($_POST['pksov']);
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

    public function insertPerf(){
        
        try {
            $perfilModel = new PerfilModel();
             //vedrifico si llega información obligatoria
             if (!empty($_POST['perfil']) ) {

                $data = [
                    "nombre" => $this->request->getVar("perfil"),
                ];
               //valido si ya esta registrado el correo y envio exeption
               $exist_perf = $perfilModel->exist_perfil($data['nombre']);

               if ($exist_perf) {

                   $response = [
                       'status' => 400,
                       "error" => TRUE,
                       'messages' => 'El valor Perfil ya existe',
                   ];
               } else {
                   //consulto el numero de filas para armar el consecutivo
                   $count_perf = $perfilModel->count_perfil();
                   $data['consec'] = ($count_perf+1);
                   //Envio datos al modelo para insertar
                   $insert_perf = $perfilModel->insert_perfil($data);

                   if ($insert_perf) {
                       $response = [
                           'status' => 201,
                           "error" => FALSE,
                           'messages' => 'Perfil creado',
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

    public function updatePerf(){
        
        try {
            $perfilModel = new PerfilModel();
             //vedrifico si llega información del correo
             if (!empty($_POST['idperf']) && !empty($_POST['perfil'])  ) {

                $data = [
                    "id" => $this->request->getVar("idperf"),
                    "perfil" => $this->request->getVar("perfil"),
                ];
                   //Envio datos al modelo para actualizar
                   $update_svo = $perfilModel->update_perfil($data);

                   if ($update_svo) {
                       $response = [
                           'status' => 201,
                           "error" => FALSE,
                           'messages' => 'Perfil Actualizado',
                       ];
                   } else {

                       $response = [
                           'status' => 500,
                           "error" => TRUE,
                           'messages' => 'Fallo al actualizar el Perfil',
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

    public function deletePerf(){
        
        try {
            $perfilModel = new PerfilModel();
             //vedrifico si llega información del correo
             if (!empty($_POST['idperf'])) {

                $data = [
                    "id" => $this->request->getVar("idprog"),
                ];
                   //Envio datos al modelo para actualizar
                   $delete_perf = $perfilModel->delete_perfil($data);

                   if ($delete_perf) {
                       $response = [
                           'status' => 201,
                           "error" => FALSE,
                           'messages' => 'Perfil Borrado en lógico',
                       ];
                   } else {

                       $response = [
                           'status' => 500,
                           "error" => TRUE,
                           'messages' => 'Fallo al borrar el Perfil',
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