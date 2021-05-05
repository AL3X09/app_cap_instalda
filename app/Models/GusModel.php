<?php

namespace App\Models;

use CodeIgniter\Model;

class GusModel extends Model
{

	function __construct()
	{
		parent::__construct();
	}

	protected $DBGroup              = 'default';
	protected $table                = 'tbl_grup_servicio';
	protected $primaryKey           = 'id_tbl_grup_servicio';
	
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = [
		"numero",
		"grupo",
		"codigo",
	];

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';
	protected $activeField          = 'is_active';
	protected $foreingkey           = 'fk_tbl_uni_serv_salud';

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
	public function exist_gus($grupo)
	{
		$querye = $this->table($this->table)
			->where('grupo', $grupo)
			->countAllResults();

		if ($querye >  0) {
			$querye = true;
		} else {
			$querye = false;
		}
		return $querye;
	}

	public function get_all_gus()
	{
		$querye = $this->table($this->table)
			->select($this->table . '.*,U.id_tbl_uni_serv_salud, U.nombre AS nombres')
			->join('tbl_uni_serv_salud AS U', 'U.id_tbl_uni_serv_salud = fk_tbl_uni_serv_salud')
			->get()
			->getResult();

		return $querye;
	}

	public function get_data_gus($pk)
	{
		$querye = $this->table($this->table)
			->select($this->table . '.*,U.id_tbl_uni_serv_salud, U.nombre AS nombres')
			->join('tbl_uni_serv_salud AS U', 'U.id_tbl_uni_serv_salud = fk_tbl_uni_serv_salud')
			->where($this->primaryKey, $pk)
			->get()
			->getRowArray();
		return $querye;
	}

	public function get_data_x_fk($fkuss)
	{
		$query = $this->table($this->table)
			->where($this->foreingkey, $fkuss)
			->get()
			->getResult();
		return $query;
	}

	public function insert_gus($data)
	{
		$query = $this->db->table($this->table)->insert($data);
		return $query ? true : false;
	}

	public function update_gus($data)
	{
		
		$query = $this->db->table($this->table)
			->set('numero', $data["numero"])
			->set('grupo', $data["grupo"])
			->set('codigo', $data["codigo"])
			->set($this->foreingkey, $data["pkuss"])
			->where($this->primaryKey, $data["id"])
			->update();
		return $query ? true : false;
	}

	//Eliminación logica
	public function delete_gus($data)
	{
		$query = $this->db->table($this->table)
			->set('is_active', 0)
			->where($this->primaryKey, $data["id"])
			->update();
		return $query ? true : false;
	}

	//
	public function count_all_gus()
	{
		$query = $this->table($this->table)
					->countAllResults();
		return $query;
	}
	
}
