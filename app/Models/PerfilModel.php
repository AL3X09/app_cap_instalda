<?php

namespace App\Models;

use CodeIgniter\Model;

class PerfilModel extends Model
{

	function __construct()
	{
		parent::__construct();
	}

	protected $DBGroup              = 'default';
	protected $table                = 'tbl_perfil_est';
	protected $primaryKey           = 'id_tbl_perfil_est';

	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = [
		"consec",
		"nombre",
	];

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';
	protected $activeField          = 'is_active';

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
	public function exist_perfil($nombre)
	{
		$querye = $this->table($this->table)
			->where('nombre', $nombre)
			->countAllResults();

		if ($querye >  0) {
			$querye = true;
		} else {
			$querye = false;
		}
		return $querye;
	}

	public function count_perfil()
	{
		$querye = $this->table($this->table)
			->countAll();
		return $querye;
	}

	public function get_all_perfil()
	{
		$querye = $this->table($this->table)
			->get()
			->getResult();

		return $querye;
	}

	public function get_data_perfil($pk)
	{
		$querye = $this->table($this->table)
			->where($this->primaryKey, $pk)
			->get()
			->getRowArray();
		return $querye;
	}

	public function insert_perfil($data)
	{
		$query = $this->db->table($this->table)->insert($data);
		return $query ? true : false;
	}

	public function update_perfil($data)
	{
		$query = $this->db->table($this->table)
			->set('nombre', $data["perfil"])
			->where($this->primaryKey, $data["id"])
			->update();
		return $query ? true : false;
	}

	//Eliminación
	public function delete_perfil($data)
	{
		$query = $this->db->table($this->table)
			->where($this->primaryKey, $data["id"])
			->delete();
		return $query ? true : false;
	}

	//Eliminación logica
	public function delete_perfil_logic($data)
	{
		$query = $this->db->table($this->table)
			->set('is_active', 0)
			->where($this->primaryKey, $data["id"])
			->update();
		return $query ? true : false;
	}

}
