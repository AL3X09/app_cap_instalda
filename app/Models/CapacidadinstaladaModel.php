<?php

namespace App\Models;

use CodeIgniter\Model;

class CapacidadinstaladaModel extends Model
{

	function __construct()
	{
		parent::__construct();
	}

	protected $DBGroup              = 'default';
	protected $table                = 'tbl_capa_med_instalada';
	protected $primaryKey           = 'id_tbl_capa_med_instalada';

	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = [
		"consec",
		"capa_max_estud_cama",
		"capa_max_estud_consulta",
		"capa_max_estud_paciente",
		"num_docen_requiere",
	];

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';
	protected $activeField          = 'is_active';
	protected $foreingkey           = 'fk_tbl_uss_u_gus_u_svo_u_prog';

	// Validation
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	// Callbacks
	protected $allowCallbacks       = true;
	protected $beforeInsert         = [];
	protected $afterInsert          = [];
	protected $beforeUpdate         = [];
	protected $afterUpdate          = [];
	protected $beforeFind           = [];
	protected $afterFind            = [];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];

	//funciones
	public function count_capainsta()
	{
		$query = $this->table($this->table)
			->countAll();
		return $query;
	}

	public function get_all_capainsta()
	{
		$query = $this->table($this->table)
			->select($this->table . '.*,
			UUS.id_tbl_uni_serv_salud, UUS.nombre AS nombreuss,
			GUS.id_tbl_grup_servicio, GUS.numero, GUS.grupo, 
			SOV.id_tbl_serv_ofertado, SOV.nombre_serv AS nombreserv, 
			PR.id_tbl_programa, PR.nombre_prog AS programa, PER.nombre AS perfil_est,
			EST.id_tbl_estandar, EST.num_estudiantes, EST.num_pacientes, EST.num_estudiante_x_docente,
			CAPUUS.id_tbl_capacidad_uus, CAPUUS.num_cama_uus, CAPUUS.num_consultorio_uus, CAPUUS.num_paciente_uus')
			->join('tbl_programa AS PR', 'PR.id_tbl_programa =' . $this->foreingkey)
			->join('tbl_perfil_est AS PER', 'PER.id_tbl_perfil_est = PR.fk_tbl_perfil_est')
			->join('tbl_serv_ofertado AS SOV', 'SOV.id_tbl_serv_ofertado = PR.fk_tbl_serv_ofertado')
			->join('tbl_grup_servicio AS GUS', 'GUS.id_tbl_grup_servicio = SOV.fk_tbl_grupo_serv')
			->join('tbl_uni_serv_salud AS UUS', 'UUS.id_tbl_uni_serv_salud = GUS.fk_tbl_uni_serv_salud')
			->join('tbl_estandar AS EST', 'PR.id_tbl_programa = EST.fk_tbl_programa')
			->join('tbl_capacidad_uus AS CAPUUS', 'PR.id_tbl_programa = CAPUUS.fk_tbl_programa')
			->get()
			->getResult();
			//->getCompiledSelect();
		
		return $query;
	}

	public function get_data_capainsta($pk)
	{
		$querye = $this->table($this->table)
			->select($this->table . '.*, UUS.id_tbl_uni_serv_salud, UUS.nombre AS nombreuss, GUS.id_tbl_grup_servicio, GUS.numero, GUS.grupo, SOV.id_tbl_serv_ofertado, SOV.nombre_serv AS nombreserv, PR.id_tbl_programa, PR.nombre_prog AS programa, PR.perfil_est')
			->join('tbl_programa AS PR', 'PR.id_tbl_programa =' . $this->foreingkey)
			->join('tbl_serv_ofertado AS SOV', 'SOV.id_tbl_serv_ofertado = PR.fk_tbl_serv_ofertado')
			->join('tbl_grup_servicio AS GUS', 'GUS.id_tbl_grup_servicio = SOV.fk_tbl_grupo_serv')
			->join('tbl_uni_serv_salud AS UUS', 'UUS.id_tbl_uni_serv_salud = GUS.fk_tbl_serv_salud')
			->where($this->primaryKey, $pk)
			->get()
			->getRowArray();
		return $querye;
	}

	public function insert_capainsta($data)
	{
		$query = $this->db->table($this->table)->insert($data);
		return $query ? true : false;
	}

	public function update_capainsta($data)
	{

		$query = $this->db->table($this->table)
			->set('nombre_prog', $data["programa"])
			->set('perfil_est', $data["perfil"])
			->set($this->foreingkey, $data["pksvo"])
			->where($this->primaryKey, $data["id"])
			->update();
		return $query ? true : false;
	}

	//Eliminación logica
	public function delete_capainsta($data)
	{
		$query = $this->db->table($this->table)
			->where($this->primaryKey, $data["id"])
			->delete();
		return $query ? true : false;
	}

	//Eliminación logica
	public function delete_capainsta_logic($data)
	{
		$query = $this->db->table($this->table)
			->set('is_active', 0)
			->where($this->primaryKey, $data["id"])
			->update();
		return $query ? true : false;
	}

	//contar cantidad de estudiantes por programa
	public function cont_capaiest_x_prog()
	{
		$query = $this->db->table($this->table)
			->select('SUM(num_docen_requiere) as total, PR.nombre_prog AS programa, PE.nombre AS perfil_est')
			->join('tbl_programa AS PR', 'PR.id_tbl_programa =' . $this->foreingkey)
			->join('tbl_perfil_est AS PE', 'PE.id_tbl_perfil_est = PR.fk_tbl_perfil_est')
			->groupBy('programa, perfil_est')
			->get()
			->getResultArray();

		return $query;
	}

	public function get_data_capmed($pkuss,$pkgus)
	{
		$querye = $this->table($this->table)
			->select($this->table . '.*, UUS.id_tbl_uni_serv_salud, UUS.nombre AS nombreuss, 
			GUS.id_tbl_grup_servicio, GUS.numero, GUS.grupo, SOV.id_tbl_serv_ofertado, 
			SOV.nombre_serv AS nombreserv, SOV.codigo, PR.id_tbl_programa, PR.nombre_prog AS programa, 
			PE.id_tbl_perfil_est, PE.nombre AS perfil_est, ES.num_estudiantes, ES.num_pacientes, ES.num_estudiante_x_docente,
			ES.observacion, CUS.num_cama_uus, CUS.num_consultorio_uus, CUS.num_paciente_uus')
			->join('tbl_uss_u_gus_u_svo_u_prog AS ASO', 'ASO.id_tbl_uss_gus_svo_pro =' . $this->foreingkey)
			->join('tbl_perfil_est AS PE', 'PE.id_tbl_perfil_est = ASO.fk_tbl_perfil_est')
			->join('tbl_programa AS PR', 'PR.id_tbl_programa = ASO.fk_tbl_programa')
			->join('tbl_serv_ofertado AS SOV', 'SOV.id_tbl_serv_ofertado = ASO.fk_tbl_serv_ofertado')
			->join('tbl_grup_servicio AS GUS', 'GUS.id_tbl_grup_servicio = ASO.fk_tbl_grup_servicio')
			->join('tbl_uni_serv_salud AS UUS', 'UUS.id_tbl_uni_serv_salud = ASO.fk_tbl_uni_serv_salud')
			->join('tbl_uni_serv_hospital AS HSO', 'HSO.id_tbl_uni_serv_hospital = UUS.fk_tbl_serv_hospital')
			->join('tbl_estandar AS ES', 'ES.fk_tbl_uss_gus_svo_pro = ASO.id_tbl_uss_gus_svo_pro')
			->join('tbl_capacidad_uus AS CUS', 'CUS.fk_tbl_uss_gus_svo_pro = ASO.id_tbl_uss_gus_svo_pro')
			->where('ASO.fk_tbl_uni_serv_salud', $pkuss)
			->Where('ASO.fk_tbl_grup_servicio', $pkgus)
			//->orWhere('ASO.fk_tbl_serv_ofertado', '')
			//->orWhere('ASO.fk_tbl_programa', '')
			//->orWhere('ASO.fk_tbl_perfil_est', '')
			->get()
			->getResult();
			//->getCompiledSelect();
		return $querye;
	}

	public function get_data_capmed2($pkuss,$pkgus,$pksvo)
	{
		$querye = $this->table($this->table)
			->select($this->table . '.*, UUS.id_tbl_uni_serv_salud, UUS.nombre AS nombreuss, 
			GUS.id_tbl_grup_servicio, GUS.numero, GUS.grupo, SOV.id_tbl_serv_ofertado, 
			SOV.nombre_serv AS nombreserv, SOV.codigo, PR.id_tbl_programa, PR.nombre_prog AS programa, 
			PE.id_tbl_perfil_est, PE.nombre AS perfil_est, ES.num_estudiantes, ES.num_pacientes, ES.num_estudiante_x_docente,
			ES.observacion, CUS.num_cama_uus, CUS.num_consultorio_uus, CUS.num_paciente_uus')
			->join('tbl_uss_u_gus_u_svo_u_prog AS ASO', 'ASO.id_tbl_uss_gus_svo_pro =' . $this->foreingkey)
			->join('tbl_perfil_est AS PE', 'PE.id_tbl_perfil_est = ASO.fk_tbl_perfil_est')
			->join('tbl_programa AS PR', 'PR.id_tbl_programa = ASO.fk_tbl_programa')
			->join('tbl_serv_ofertado AS SOV', 'SOV.id_tbl_serv_ofertado = ASO.fk_tbl_serv_ofertado')
			->join('tbl_grup_servicio AS GUS', 'GUS.id_tbl_grup_servicio = ASO.fk_tbl_grup_servicio')
			->join('tbl_uni_serv_salud AS UUS', 'UUS.id_tbl_uni_serv_salud = ASO.fk_tbl_uni_serv_salud')
			->join('tbl_uni_serv_hospital AS HSO', 'HSO.id_tbl_uni_serv_hospital = UUS.fk_tbl_serv_hospital')
			->join('tbl_estandar AS ES', 'ES.fk_tbl_uss_gus_svo_pro = ASO.id_tbl_uss_gus_svo_pro')
			->join('tbl_capacidad_uus AS CUS', 'CUS.fk_tbl_uss_gus_svo_pro = ASO.id_tbl_uss_gus_svo_pro')
			->where('ASO.fk_tbl_uni_serv_salud', $pkuss)
			->Where('ASO.fk_tbl_grup_servicio', $pkgus)
			->Where('ASO.fk_tbl_serv_ofertado', $pksvo)
			//->orWhere('ASO.fk_tbl_programa', '')
			//->orWhere('ASO.fk_tbl_perfil_est', '')
			->get()
			->getResult();
			//->getCompiledSelect();
		return $querye;
	}

	public function get_data_capmed3($pkuss,$pkgus,$pksvo,$pkprog)
	{
		$querye = $this->table($this->table)
			->select($this->table . '.*, UUS.id_tbl_uni_serv_salud, UUS.nombre AS nombreuss, 
			GUS.id_tbl_grup_servicio, GUS.numero, GUS.grupo, SOV.id_tbl_serv_ofertado, 
			SOV.nombre_serv AS nombreserv, SOV.codigo, PR.id_tbl_programa, PR.nombre_prog AS programa, 
			PE.id_tbl_perfil_est, PE.nombre AS perfil_est, ES.num_estudiantes, ES.num_pacientes, ES.num_estudiante_x_docente,
			ES.observacion, CUS.num_cama_uus, CUS.num_consultorio_uus, CUS.num_paciente_uus')
			->join('tbl_uss_u_gus_u_svo_u_prog AS ASO', 'ASO.id_tbl_uss_gus_svo_pro =' . $this->foreingkey)
			->join('tbl_perfil_est AS PE', 'PE.id_tbl_perfil_est = ASO.fk_tbl_perfil_est')
			->join('tbl_programa AS PR', 'PR.id_tbl_programa = ASO.fk_tbl_programa')
			->join('tbl_serv_ofertado AS SOV', 'SOV.id_tbl_serv_ofertado = ASO.fk_tbl_serv_ofertado')
			->join('tbl_grup_servicio AS GUS', 'GUS.id_tbl_grup_servicio = ASO.fk_tbl_grup_servicio')
			->join('tbl_uni_serv_salud AS UUS', 'UUS.id_tbl_uni_serv_salud = ASO.fk_tbl_uni_serv_salud')
			->join('tbl_uni_serv_hospital AS HSO', 'HSO.id_tbl_uni_serv_hospital = UUS.fk_tbl_serv_hospital')
			->join('tbl_estandar AS ES', 'ES.fk_tbl_uss_gus_svo_pro = ASO.id_tbl_uss_gus_svo_pro')
			->join('tbl_capacidad_uus AS CUS', 'CUS.fk_tbl_uss_gus_svo_pro = ASO.id_tbl_uss_gus_svo_pro')
			->where('ASO.fk_tbl_uni_serv_salud', $pkuss)
			->Where('ASO.fk_tbl_grup_servicio', $pkgus)
			->Where('ASO.fk_tbl_serv_ofertado', $pksvo)
			->Where('ASO.fk_tbl_programa', $pkprog)
			->get()
			->getResult();
			//->getCompiledSelect();
		return $querye;
	}

	public function get_data_capmed4($pkuss,$pkgus,$pksvo,$pkprog,$pkperf)
	{
		$querye = $this->table($this->table)
			->select($this->table . '.*, UUS.id_tbl_uni_serv_salud, UUS.nombre AS nombreuss, 
			GUS.id_tbl_grup_servicio, GUS.numero, GUS.grupo, SOV.id_tbl_serv_ofertado, 
			SOV.nombre_serv AS nombreserv, SOV.codigo, PR.id_tbl_programa, PR.nombre_prog AS programa, 
			PE.id_tbl_perfil_est, PE.nombre AS perfil_est, ES.num_estudiantes, ES.num_pacientes, ES.num_estudiante_x_docente,
			ES.observacion, CUS.num_cama_uus, CUS.num_consultorio_uus, CUS.num_paciente_uus')
			->join('tbl_uss_u_gus_u_svo_u_prog AS ASO', 'ASO.id_tbl_uss_gus_svo_pro =' . $this->foreingkey)
			->join('tbl_perfil_est AS PE', 'PE.id_tbl_perfil_est = ASO.fk_tbl_perfil_est')
			->join('tbl_programa AS PR', 'PR.id_tbl_programa = ASO.fk_tbl_programa')
			->join('tbl_serv_ofertado AS SOV', 'SOV.id_tbl_serv_ofertado = ASO.fk_tbl_serv_ofertado')
			->join('tbl_grup_servicio AS GUS', 'GUS.id_tbl_grup_servicio = ASO.fk_tbl_grup_servicio')
			->join('tbl_uni_serv_salud AS UUS', 'UUS.id_tbl_uni_serv_salud = ASO.fk_tbl_uni_serv_salud')
			->join('tbl_uni_serv_hospital AS HSO', 'HSO.id_tbl_uni_serv_hospital = UUS.fk_tbl_serv_hospital')
			->join('tbl_estandar AS ES', 'ES.fk_tbl_uss_gus_svo_pro = ASO.id_tbl_uss_gus_svo_pro')
			->join('tbl_capacidad_uus AS CUS', 'CUS.fk_tbl_uss_gus_svo_pro = ASO.id_tbl_uss_gus_svo_pro')
			->where('ASO.fk_tbl_uni_serv_salud', $pkuss)
			->Where('ASO.fk_tbl_grup_servicio', $pkgus)
			->Where('ASO.fk_tbl_serv_ofertado', $pksvo)
			->Where('ASO.fk_tbl_programa', $pkprog)
			->Where('ASO.fk_tbl_perfil_est', $pkperf)
			->get()
			->getResult();
			//->getCompiledSelect();
		return $querye;
	}

}
