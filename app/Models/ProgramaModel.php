<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgramaModel extends Model
{

	function __construct()
	{
		parent::__construct();
	}

	protected $DBGroup              = 'default';
	protected $table                = 'tbl_programa';
	protected $primaryKey           = 'id_tbl_programa';

	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = [
		"consec",
		"nombre_prog",
	];

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';
	protected $activeField          = 'is_active';
	protected $foreingkey           = 'fk_tbl_serv_ofertado';

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
	public function exist_programa($nombre)
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
	}

	public function count_programa()
	{
		$querye = $this->table($this->table)
			->countAll();
		return $querye;
	}

	public function get_all_programa()
	{
		$querye = $this->table($this->table)
			->select($this->table . '.*, S.id_tbl_serv_ofertado, S.nombre_serv AS nombres, PE.id_tbl_perfil_est, PE.nombre AS nombreper')
			->join('tbl_serv_ofertado AS S', 'S.id_tbl_serv_ofertado =' . $this->foreingkey)
			->join('tbl_perfil_est AS PE', 'PE.id_tbl_perfil_est = fk_tbl_perfil_est')
			->get()
			->getResult();

		return $querye;
	}

	public function get_data_programa($pk)
	{
		$querye = $this->table($this->table)
			->select($this->table . '.*, S.id_tbl_serv_ofertado, S.nombre_serv AS nombres, PE.id_tbl_perfil_est, PE.nombre AS nombreper')
			->join('tbl_serv_ofertado AS S', 'S.id_tbl_serv_ofertado =' . $this->foreingkey)
			->join('tbl_perfil_est AS PE', 'PE.id_tbl_perfil_est = fk_tbl_perfil_est')
			->where($this->primaryKey, $pk)
			->get()
			->getRowArray();
		return $querye;
	}

	public function get_data_x_fk($fksvo)
	{
		$query = $this->table($this->table)
			->select($this->table . '.*, PE.id_tbl_perfil_est, PE.nombre AS perfil_est')
			->join('tbl_perfil_est AS PE', 'PE.id_tbl_perfil_est = fk_tbl_perfil_est')
			->where($this->foreingkey, $fksvo)
			->get()
			->getResult();
		return $query;
	}

	public function insert_programa($data)
	{
		$query = $this->db->table($this->table)->insert($data);
		return $query ? true : false;
	}

	public function update_programa($data)
	{

		$query = $this->db->table($this->table)
			->set('nombre_prog', $data["programa"])
			->set($this->foreingkey, $data["pksvo"])
			->set("fk_tbl_perfil_est", $data["perfil"])
			->where($this->primaryKey, $data["id"])
			->update();
		return $query ? true : false;
	}

	//Eliminación logica
	public function delete_programa($data)
	{
		$query = $this->db->table($this->table)
			->set('is_active', 0)
			->where($this->primaryKey, $data["id"])
			->update();
		return $query ? true : false;
	}
	//contar total de programas
	public function count_perfil()
	{
		$query = $this->table($this->table)
			->countAllResults();
		return $query;
	}
	
}
