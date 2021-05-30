<?php 
namespace App\Controllers;


use Config\Services;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use Exception;
use \Firebase\JWT\JWT;
use App\Models\UssGusSvoProgPerfModel;


// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control");

//grupo de la unidad de servicios de salud
class UssGusSvoProgPerf extends ResourceController{

    public function insertUGSPP(){
        
        try {
            $UGSPPModel = new UssGusSvoProgPerfModel();
             //vedrifico si llega información obligatoria
             if (!empty($_POST['pkuus']) && !empty($_POST['pkgus']) && !empty($_POST['pksvo']) && !empty($_POST['pkprog']) && !empty($_POST['pkperf']) ) {

                $data = [
                    "fk_tbl_uni_serv_salud" => $this->request->getVar("pkuus"),
                    "fk_tbl_grup_servicio" => $this->request->getVar("pkgus"),
                    "fk_tbl_serv_ofertado" => $this->request->getVar("pksvo"),
                    "fk_tbl_programa" => $this->request->getVar("pkprog"),
                    "fk_tbl_perfil_est" => $this->request->getVar("pkperf"),
                ];
               //valido si ya esta registrado el correo y envio exeption
               //$exis_UGSPP = $UGSPPModel->exist_gus($data['grupo']);
               //consulto el numero de filas para armar el consecutivo
               $count_UGSPP = $UGSPPModel->count_relaciones();
               $data['consec'] = ($count_UGSPP+1);
                   //Envio datos al modelo para insertar
                   $insert_UGSPP = $UGSPPModel->insert_relaciones($data);

                   if ($insert_UGSPP) {
                       $response = [
                           'status' => 201,
                           "error" => FALSE,
                           'messages' => 'Asociaciones creado',
                       ];
                   } else {

                       $response = [
                           'status' => 500,
                           "error" => TRUE,
                           'messages' => 'Fallo al crear Asociaciones',
                       ];
                   }
           } else {

               $response = [
                   'status' => 409,
                   "error" => TRUE,
                   'messages' => 'No se encontraron variables de envio obligatorias en Asociaciones',
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

    public function updateUGSPP(){
        
        try {
            $UGSPPModel = new UssGusSvoProgPerfModel();
             //vedrifico si llega información del correo
             if (!empty($_POST['pkuus']) && !empty($_POST['pkgus']) && !empty($_POST['pksvo']) && !empty($_POST['pkprog']) && !empty($_POST['pkperf']) ) {

                $data = [
                    "fk_tbl_uni_serv_salud" => $this->request->getVar("pkuus"),
                    "fk_tbl_grup_servicio" => $this->request->getVar("pkgus"),
                    "fk_tbl_serv_ofertado" => $this->request->getVar("pksvo"),
                    "fk_tbl_programa" => $this->request->getVar("pkprog"),
                    "fk_tbl_perfil_est" => $this->request->getVar("pkperf"),
                    "id" => $this->request->getVar("idrelaci"),
                ];
                   //Envio datos al modelo para actualizar
                   $update_rel = $UGSPPModel->update_relaciones($data);

                   if ($update_rel) {
                       $response = [
                           'status' => 201,
                           "error" => FALSE,
                           'messages' => 'relacion Actualizada',
                       ];
                   } else {

                       $response = [
                           'status' => 500,
                           "error" => TRUE,
                           'messages' => 'Fallo al actualizar la relacion',
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
    
}