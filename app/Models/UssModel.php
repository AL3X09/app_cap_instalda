<?php

namespace App\Models;

use CodeIgniter\Model;

class UssModel extends Model
{

	function __construct()
	{
		parent::__construct();
	}

	protected $DBGroup              = 'default';
	protected $table                = 'tbl_uni_serv_salud';
	protected $primaryKey           = 'id_tbl_uni_serv_salud';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = [
		"nombre",
		"direccion",
		"telefono",
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
	public function exist_uss($nombre)
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

	public function get_all_uss()
	{
		$querye = $this->table($this->table)
			->select($this->table . '.*,H.id_tbl_uni_serv_hospital, H.nombre AS nombreh')
			->join('tbl_uni_serv_hospital AS H', 'H.id_tbl_uni_serv_hospital = fk_tbl_serv_hospital')
			->get()
			->getResult();

		return $querye;
	}

	public function get_data_uss($pk)
	{
		$querye = $this->table($this->table)
			->select($this->table . '.*,H.id_tbl_uni_serv_hospital, H.nombre AS nombreh')
			->join('tbl_uni_serv_hospital AS H', 'H.id_tbl_uni_serv_hospital = fk_tbl_serv_hospital')
			->where($this->primaryKey, $pk)
			->get()
			->getRowArray();
		return $querye;
	}

	public function insert_uss($data)
	{
		$query = $this->db->table($this->table)->insert($data);
		return $query ? true : false;
	}

	public function update_uss($data)
	{
		//var_dump($data);
		//var_dump($data["idhso"]);
		$query = $this->db->table($this->table)
			->set('nombre', $data["nombre"])
			->set('direccion', $data["direccion"])
			->set('telefono', $data["telefono"])
			->set('fk_tbl_serv_hospital', $data["idhso"])
			->where($this->primaryKey, $data["id"])
			->update();
		return $query ? true : false;
	}

	//Eliminación logica
	public function delete_uss($data)
	{
		$query = $this->db->table($this->table)
			->set('is_active', 0)
			->where($this->primaryKey, $data["id"])
			->update();
		return $query ? true : false;
	}

	//
	public function count_all_uss()
	{
		$query = $this->table($this->table)
					->countAllResults();
		return $query;
	}

	/*
	public function count_perfil()
    {

		$query = $this->db->table($this->table)
			->select('COUNT(id_tbl_uni_serv_salud) AS total, nombre')
			->groupBy('nombre')
			->get()
			->getResultArray();

		return $query;
        
    }


	
	public function get_data_uss($pk)
    {
        $querye = $this->table($this->table)
					->where($this->primaryKey, $pk)
					->get()
					->getRowArray();

        return $querye;

    }

	public function exist_uss($nombre)
    {
        $querye = $this->table($this->table)
					->where('nombre', $nombre)
					->countAllResults();
		
        if($querye >  0){
            $querye = true;
        } else {
            $querye = false;
        }
        return $querye;
    }
	*/
}
