<?php 
namespace App\Controllers;


use Config\Services;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use Exception;
use \Firebase\JWT\JWT;
use App\Models\EstandarModel;
use App\Models\UssGusProgPerfModel;


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
                        'messages' => 'Error, tabla sin datos',
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
                        'messages' => 'Error, no existe el valor consultado',
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
             if (!empty($_POST['pkgus']) && !empty($_POST['pksvo']) && !empty($_POST['pkprog']) && !empty($_POST['pkperf'])) {

                $data = [
                    "fk_tbl_programa" => $this->request->getVar("pkgus"),
                    "fk_tbl_programa" => $this->request->getVar("pksvo"),
                    "fk_tbl_programa" => $this->request->getVar("pkprog"),
                    "fk_tbl_programa" => $this->request->getVar("pkperf"),
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

    public function updateEst(){
        
        try {
            $estandModel = new EstandarModel();
             //vedrifico si llega información del correo
             if (!empty($_POST['idestand']) && !empty($_POST['idrelaci'])) {

                $data = [
                    "id" => $this->request->getVar("idestand"),
                    "numest" => $this->request->getVar("numest"),
                    "numpaci" => $this->request->getVar("numpaci"),
                    "numestydoc" => $this->request->getVar("numestydoc"),
                    "observa" => $this->request->getVar("observa"),
                    "fkrelaci" => $this->request->getVar("idrelaci"),
                ];
                   //Envio datos al modelo para actualizar
                   $update_svo = $estandModel->update_estandar($data);

                   if ($update_svo) {
                       $response = [
                           'status' => 201,
                           "error" => FALSE,
                           'messages' => 'Estandar Actualizado',
                       ];
                   } else {

                       $response = [
                           'status' => 500,
                           "error" => TRUE,
                           'messages' => 'Fallo al actualizar el Estandar',
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

    public function detail_fk(){
        
        try {
            $estandModel = new EstandarModel();
            //vedrifico si llega información del correo
            if (!empty($_POST['fkuss']) && !empty($_POST['fkgus']) && !empty($_POST['fksov']) && !empty($_POST['fkprog']) && !empty($_POST['fkperf']) ) {
                //Valido si el correo ya existe en la BD
                $data_gus = $estandModel->get_data_x_fk($_POST['fkuss'], $_POST['fkgus'], $_POST['fksov'], $_POST['fkprog'], $_POST['fkperf']);
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
                        'messages' => 'Error, tabla sin datos',
                    ];
                }

            return $this->respond($response);
        } catch (\Exception $e) {
            return $this->failServerError('se ha presntado una exepción ' . $e->getMessage());
        }
        
    }


}