<?php 
namespace App\Controllers;


use Config\Services;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use Exception;
use \Firebase\JWT\JWT;
use App\Models\CapacidadinstaladaModel;

// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control");

//grupo de la unidad de servicios de salud
class Formcapinstalada extends ResourceController{
    
    use ResponseTrait;

    public function index(){

        echo view('template/header');
		echo view('template/main_header');
		echo view('template/sidebar');
		echo view('dash_capa_instalada_view');
		echo view('template/footer');
    }

    public function formulario(){

        echo view('template/header');
		echo view('template/main_header');
		echo view('template/sidebar');
		echo view('formcapinstalada_view');
		echo view('template/footer');
    }

    public function getallDatainstalada(){
        
        try {
            $capainstaModel = new CapacidadinstaladaModel();
            
            //vedrifico si llega información del correo
            $exis_capainsta = $capainstaModel->get_all_capainsta();
                if (!empty($exis_capainsta)) {

                    $response = [
                        'status' => 200,
                        "error" => FALSE,
                        'data' => $exis_capainsta,
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

    public function insertDatainstalada(){
        
        try {
            $capainstaModel = new CapacidadinstaladaModel();
            $max_estu_cama = NULL;
            $capa_max_estud_consulta = NULL;
            $capa_max_estud_paciente = NULL;
             //vedrifico si llega información obligatoria
             if (!empty($_POST['pkgus']) && !empty($_POST['pksvo']) && !empty($_POST['pkprog']) ) {

                if ($_POST['numcamuus'] != "") {
                    
                    $max_estu_cama = ( $_POST['numcamuus'] * $_POST['numest'] ) / $_POST['numpaci'];
                    //print_r($max_estu_cama);
                }elseif ($_POST['numespauus'] != "") {
                    $capa_max_estud_consulta = $_POST['numespauus'] * $_POST['numest'];
                    
                }elseif ($_POST['numpacuus'] != "") {
                    $capa_max_estud_paciente = ($_POST['numpacuus'] *$_POST['numest'] ) / $_POST['numpaci'];
                }
                
                //
                //$max_estu_camaV = ($max_estu_cama == null) ? $max_estu_cama : null ;
                $max_estu_camaV = ($max_estu_cama === null) ? null : $max_estu_cama ;
                //
                $capa_max_estud_consultaV = ($capa_max_estud_consulta === null) ? null : $capa_max_estud_consulta;
                //$capa_max_estud_consultaV = ($capa_max_estud_consulta >= 1) ? $capa_max_estud_consulta : null ;
                //
                //$capa_max_estud_pacienteV = ($capa_max_estud_paciente >= 1) ? $capa_max_estud_paciente : null ;
                $capa_max_estud_pacienteV = ($capa_max_estud_paciente === null) ? null : $capa_max_estud_paciente;
                
                //
                if($capa_max_estud_consultaV >= 1){
                    $max_dato_doc = $capa_max_estud_consultaV;
                }else if($capa_max_estud_consultaV >= 1){
                    $max_dato_doc = $capa_max_estud_consultaV;
                }else if($capa_max_estud_pacienteV >= 1){
                    $max_dato_doc = $capa_max_estud_pacienteV;
                }else{
                    $max_dato_doc = 0;
                }
                //
                $num_docen_requiere = ($max_dato_doc >= 1) ? $max_dato_doc / $_POST['numestydoc'] : 0;
                //$num_docen_requiereV = ($num_docen_requiere >= 1) ? $num_docen_requiere : 0 ;

                if($num_docen_requiere > 0){
                    $num_docen_requiereV=1;
                }else if($num_docen_requiere >= 1){
                    $num_docen_requiereV = $num_docen_requiere;
                }else{
                    $num_docen_requiereV = 0;
                }

                $data = [
                    "capa_max_estud_cama" => $max_estu_camaV,
                    "capa_max_estud_consulta" => $capa_max_estud_consultaV,
                    "capa_max_estud_paciente" => $capa_max_estud_pacienteV,
                    "num_docen_requiere" => $num_docen_requiereV,
                    "fk_tbl_uss_u_gus_u_svo_u_prog" => $this->request->getVar("pkrel"),
                ];

                   //consulto el numero de filas para armar el consecutivo
                   $count_capainsta = $capainstaModel->count_capainsta();
                   $data['consec'] = ($count_capainsta+1);
                   //Envio datos al modelo para insertar
                   $insert_capainsta = $capainstaModel->insert_capainsta($data);

                   if ($insert_capainsta) {
                       $response = [
                           'status' => 201,
                           "error" => FALSE,
                           'messages' => 'Capacidad médica creada',
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

    public function graph_Docen(){

        try {
            $capainstaModel = new CapacidadinstaladaModel();
            
            //vedrifico si llega información del correo
            $count_docente = $capainstaModel->cont_capaiest_x_prog();
                if (!empty($count_docente)) {

                    $response = [
                        'status' => 200,
                        "error" => FALSE,
                        'data' => $count_docente,
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

    public function detailsCapMesIns(){
        
        try {
            $capmedinstaModel = new CapacidadinstaladaModel();
            //vedrifico si llega información del correo
            if (!empty($_POST['pkuss']) && !empty($_POST['pkgus'])) {
                //Valido si el correo ya existe en la BD
                if ($_POST['pksvo'] == "" && $_POST['pkprog'] == "" && $_POST['pkperf']=="") {
                    //printf('entra1');
                    $data_estand = $capmedinstaModel->get_data_capmed($_POST['pkuss'],$_POST['pkgus']);
                }elseif ($_POST['pksvo'] != "" && $_POST['pkprog'] =="" && $_POST['pkperf']=="") {
                    $data_estand = $capmedinstaModel->get_data_capmed2($_POST['pkuss'],$_POST['pkgus'],$_POST['pksvo']);
                }elseif ($_POST['pkprog'] !="" && $_POST['pkperf']=="") {
                    $data_estand = $capmedinstaModel->get_data_capmed3($_POST['pkuss'],$_POST['pkgus'],$_POST['pksvo'],$_POST['pkprog']);
                }else{
                    $data_estand = $capmedinstaModel->get_data_capmed4($_POST['pkuss'],$_POST['pkgus'],$_POST['pksvo'],$_POST['pkprog'],$_POST['pkperf']);
                }
                
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
                        'messages' => 'Error, no existe el valores en los filtros seleccionados',
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