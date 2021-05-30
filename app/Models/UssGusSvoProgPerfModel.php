<?php

namespace App\Models;

use CodeIgniter\Model;

class UssGusSvoProgPerfModel extends Model
{

	function __construct()
	{
		parent::__construct();
	}

	protected $DBGroup              = 'default';
	protected $table                = 'tbl_uss_u_gus_u_svo_u_prog';
	protected $primaryKey           = 'id_tbl_uss_gus_svo_pro';

	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = [
		"consec",
	];

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';
	protected $activeField          = 'is_active';
	protected $foreingkeyU          = 'fk_tbl_uni_serv_salud';
	protected $foreingkeyG          = 'fk_tbl_grup_servicio';
	protected $foreingkeyS          = 'fk_tbl_serv_ofertado';
	protected $foreingkeyP          = 'fk_tbl_programa';
	protected $foreingkeyPE         = 'fk_tbl_perfil_est';

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
	//no se usa porque es una relación muchos a muchos
	/*public function exist_programa($nombre)
	{
		$querye = $this->table($this->table)
			->where('nombre_prog', $nombre)
			->countAllResults();

		if ($querye >  0) {
			$querye = true;
		} else {
			$querye = false;
		}
		return $querye;
	}*/

	public function count_relaciones()
	{
		$querye = $this->table($this->table)
			->countAll();
		return $querye;
	}

	public function get_all_relaciones()
	{
		$querye = $this->table($this->table)
			->select($this->table . '.*, UUS.id_tbl_uni_serv_salud, UUS.nombre AS nombreuss, GUS.id_tbl_grup_servicio, GUS.numero, GUS.grupo, SOV.id_tbl_serv_ofertado, SOV.nombre_serv AS nombreserv, PR.id_tbl_programa, PR.nombre_prog AS programa, PE.id_tbl_perfil_est, PE.nombre AS perfil_est, HSO.nombre, HSO.id_tbl_uni_serv_hospital')
			->join('tbl_uni_serv_salud AS UUS', 'UUS.id_tbl_uni_serv_salud = ' . $this->foreingkeyU)
			->join('tbl_grup_servicio AS GUS', 'GUS.id_tbl_grup_servicio = ' . $this->foreingkeyG)
			->join('tbl_serv_ofertado AS SOV', 'SOV.id_tbl_serv_ofertado = ' . $this->foreingkeyS)
			->join('id_tbl_programa AS PR', 'PR.id_tbl_programa =' . $this->foreingkeyP)
			->join('tbl_perfil_est AS PE', 'PE.id_tbl_perfil_est =' . $this->foreingkeyPE)
			->join('tbl_uni_serv_hospital AS HSO', 'HSO.id_tbl_uni_serv_salud = UUS.fk_tbl_serv_hospital')
			->get()
			->getResult();

		return $querye;
	}

	public function get_data_relaciones($pk)
	{
		$querye = $this->table($this->table)
			->select($this->table . '.*, UUS.id_tbl_uni_serv_salud, UUS.nombre AS nombreuss, GUS.id_tbl_grup_servicio, GUS.numero, GUS.grupo, SOV.id_tbl_serv_ofertado, SOV.nombre_serv AS nombreserv, PR.id_tbl_programa, PR.nombre_prog AS programa, PE.id_tbl_perfil_est, PE.nombre AS perfil_est, HSO.nombre, HSO.id_tbl_uni_serv_hospital')
			->join('tbl_uni_serv_salud AS UUS', 'UUS.id_tbl_uni_serv_salud = ' . $this->foreingkeyU)
			->join('tbl_grup_servicio AS GUS', 'GUS.id_tbl_grup_servicio = ' . $this->foreingkeyG)
			->join('tbl_serv_ofertado AS SOV', 'SOV.id_tbl_serv_ofertado = ' . $this->foreingkeyS)
			->join('id_tbl_programa AS PR', 'PR.id_tbl_programa =' . $this->foreingkeyP)
			->join('tbl_perfil_est AS PE', 'PE.id_tbl_perfil_est =' . $this->foreingkeyPE)
			->join('tbl_uni_serv_hospital AS HSO', 'HSO.id_tbl_uni_serv_salud = UUS.fk_tbl_serv_hospital')
			->where($this->primaryKey, $pk)
			->get()
			->getRowArray();
		return $querye;
	}

	public function insert_relaciones($data)
	{
		$query = $this->db->table($this->table)->insert($data);
		return $query ? true : false;
	}

	public function update_relaciones($data)
	{

		$query = $this->db->table($this->table)
			->set($this->foreingkeyU, $data["fk_tbl_uni_serv_salud"])
			->set($this->foreingkeyG, $data["fk_tbl_grup_servicio"])
			->set($this->foreingkeyS, $data["fk_tbl_serv_ofertado"])
			->set($this->foreingkeyP, $data["fk_tbl_programa"])
			->set($this->foreingkeyPE, $data["fk_tbl_perfil_est"])
			->where($this->primaryKey, $data["id"])
			->update();
		return $query ? true : false;
	}

	//Eliminación logica
	public function delete_relaciones($data)
	{
		$query = $this->db->table($this->table)
			->where($this->primaryKey, $data["id"])
			->delete();
		return $query ? true : false;
	}

	//Eliminación logica
	public function delete_relaciones_logic($data)
	{
		$query = $this->db->table($this->table)
			->set('is_active', 0)
			->where($this->primaryKey, $data["id"])
			->update();
		return $query ? true : false;
	}
}
