<?php 
namespace App\Controllers;


use Config\Services;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use Exception;
use \Firebase\JWT\JWT;
use App\Models\EstandarModel;


// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control");

//grupo de la unidad de servicios de salud
class Estandar extends ResourceController{
    
    use ResponseTrait;

    public function index(){

        echo view('template/header');
		echo view('template/main_header');
		echo view('template/sidebar');
		echo view('estandar_view');
		echo view('template/footer');
    }

    public function getallEst(){
        
        try {
            $estandModel = new EstandarModel();
            
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

    public function detailsEst(){
        
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

    public function insertEst(){
        
        try {
            $estandModel = new EstandarModel();
             //vedrifico si llega información obligatoria
             if (!empty($_POST['pkgus']) && !empty($_POST['pksvo']) && !empty($_POST['pkprog']) ) {

                $data = [
                    "fk_tbl_programa" => $this->request->getVar("pkprog"),
                    "num_estudiantes" => $this->request->getVar("numest"),
                    "num_pacientes" => $this->request->getVar("numpaci"),
                    "num_estudiante_x_docente" => $this->request->getVar("numestydoc"),
                    "observacion" => $this->request->getVar("observa"),
                ];

                   //consulto el numero de filas para armar el consecutivo
                   $count_estd = $estandModel->count_estandar();
                   $data['consec'] = ($count_estd+1);
                   //Envio datos al modelo para insertar
                   $insert_estd = $estandModel->insert_estandar($data);

                   if ($insert_estd) {
                       $response = [
                           'status' => 201,
                           "error" => FALSE,
                           'messages' => 'Estandar creado',
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

    public function graph_Estudi(){

        try {
            $estandModel = new EstandarModel();
            
            //vedrifico si llega información del correo
            $exis_estd = $estandModel->cont_estandar_x_prog();
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


}