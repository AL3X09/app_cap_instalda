<?php

namespace App\Models;

use CodeIgniter\Model;

class SvoModel extends Model
{

	function __construct()
	{
		parent::__construct();
	}

	protected $DBGroup              = 'default';
	protected $table                = 'tbl_serv_ofertado';
	protected $primaryKey           = 'id_tbl_serv_ofertado';
	
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = [
		"consec",
		"nombre_serv",
		"codigo",
	];

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';
	protected $activeField          = 'is_active';
	//protected $foreingkey           = 'fk_tbl_grupo_serv';

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
	public function exist_svo($nombre)
	{
		$querye = $this->table($this->table)
			->where('nombre_serv', $nombre)
			->countAllResults();

		if ($querye >  0) {
			$querye = true;
		} else {
			$querye = false;
		}
		return $querye;
	}

	public function count_svo()
	{
		$querye = $this->table($this->table)
				->countAll();
		return $querye;
	}

	public function get_all_svo()
	{
		$querye = $this->table($this->table)
			->get()
			->getResult();

		return $querye;
	}

	public function get_data_svo($pk)
	{
		$querye = $this->table($this->table)
			->where($this->primaryKey, $pk)
			->get()
			->getRowArray();
		return $querye;
	}

	public function get_data_fkgus($fkgus)
	{
		$querye = $this->table($this->table)
			->join('tbl_uss_u_gus_u_svo_u_prog AS REL', 'REL.fk_tbl_serv_ofertado = id_tbl_serv_ofertado')
			->where('REL.fk_tbl_serv_ofertado =', $fkgus)
			->get()
			->getResult();
		return $querye;
	}

	public function insert_svo($data)
	{
		$query = $this->db->table($this->table)->insert($data);
		return $query ? true : false;
	}

	public function update_svo($data)
	{
		
		$query = $this->db->table($this->table)
			->set('nombre_serv', $data["nombre"])
			->set('codigo', $data["codigo"])
			->where($this->primaryKey, $data["id"])
			->update();
		return $query ? true : false;
	}

	//Eliminación logica
	public function delete_svo($data)
	{
		$query = $this->db->table($this->table)
			->set('is_active', 0)
			->where($this->primaryKey, $data["id"])
			->update();
		return $query ? true : false;
	}

	public function count_all_svo()
	{
		$query = $this->table($this->table)
					->countAllResults();
		return $query;
	}
	
}

/**
 * 
 * OLD QUERYS
 * public function get_all_svo()
	{
		$querye = $this->table($this->table)
			->select($this->table . '.*,G.id_tbl_grup_servicio, G.grupo AS nombreg, G.codigo AS codigog')
			->join('tbl_grup_servicio AS G', 'G.id_tbl_grup_servicio ='. $this->foreingkey)
			->get()
			->getResult();

		return $querye;
	}

	public function get_data_svo($pk)
	{
		$querye = $this->table($this->table)
			->select($this->table . '.*,G.id_tbl_grup_servicio, G.grupo AS nombreg, G.codigo AS codigog')
			->join('tbl_grup_servicio AS G', 'G.id_tbl_grup_servicio ='. $this->foreingkey)
			->where($this->primaryKey, $pk)
			->get()
			->getRowArray();
		return $querye;
	}

	public function get_data_fkgus($fkgus)
	{
		$querye = $this->table($this->table)
			->where($this->foreingkey, $fkgus)
			->get()
			->getResult();
		return $querye;
	}
 */
