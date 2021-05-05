<?php

namespace App\Models;

use CodeIgniter\Model;

class EstandarModel extends Model
{

	function __construct()
	{
		parent::__construct();
	}

	protected $DBGroup              = 'default';
	protected $table                = 'tbl_estandar';
	protected $primaryKey           = 'id_tbl_estandar';

	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = [
		"consec",
		"num_estudiantes",
		"num_pacientes",
		"num_estudiante_x_docente",
		'observacion',
	];

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';
	protected $activeField          = 'is_active';
	protected $foreingkey           = 'fk_tbl_programa';

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

	public function count_estandar()
	{
		$querye = $this->table($this->table)
			->countAll();
		return $querye;
	}

	public function get_all_estandar()
	{
		$querye = $this->table($this->table)
			->select($this->table . '.*, UUS.id_tbl_uni_serv_salud, UUS.nombre AS nombreuss, GUS.id_tbl_grup_servicio, GUS.numero, GUS.grupo, SOV.id_tbl_serv_ofertado, SOV.nombre_serv AS nombreserv, PR.id_tbl_programa, PR.nombre_prog AS programa, PE.nombre AS perfil_est')
			->join('tbl_programa AS PR', 'PR.id_tbl_programa =' . $this->foreingkey)
			->join('tbl_serv_ofertado AS SOV', 'SOV.id_tbl_serv_ofertado = PR.fk_tbl_serv_ofertado')
			->join('tbl_grup_servicio AS GUS', 'GUS.id_tbl_grup_servicio = SOV.fk_tbl_grupo_serv')
			->join('tbl_uni_serv_salud AS UUS', 'UUS.id_tbl_uni_serv_salud = GUS.fk_tbl_serv_salud')
			->join('tbl_perfil_est AS PE', 'PE.id_tbl_perfil_est = PR.fk_tbl_perfil_est')
			->get()
			->getResult();

		return $querye;
	}

	public function get_data_estandar($pk)
	{
		$querye = $this->table($this->table)
			->select($this->table . '.*, UUS.id_tbl_uni_serv_salud, UUS.nombre AS nombreuss, GUS.id_tbl_grup_servicio, GUS.numero, GUS.grupo, SOV.id_tbl_serv_ofertado, SOV.nombre_serv AS nombreserv, PR.id_tbl_programa, PR.nombre_prog AS programa, PE.nombre AS perfil_est')
			->join('tbl_programa AS PR', 'PR.id_tbl_programa =' . $this->foreingkey)
			->join('tbl_serv_ofertado AS SOV', 'SOV.id_tbl_serv_ofertado = PR.fk_tbl_serv_ofertado')
			->join('tbl_grup_servicio AS GUS', 'GUS.id_tbl_grup_servicio = SOV.fk_tbl_grupo_serv')
			->join('tbl_uni_serv_salud AS UUS', 'UUS.id_tbl_uni_serv_salud = GUS.fk_tbl_serv_salud')
			->join('tbl_perfil_est AS PE', 'PE.id_tbl_perfil_est = PR.fk_tbl_perfil_est')
			->where($this->primaryKey, $pk)
			->get()
			->getRowArray();
		return $querye;
	}

	public function insert_estandar($data)
	{
		$query = $this->db->table($this->table)->insert($data);
		return $query ? true : false;
	}

	public function update_estandar($data)
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
	public function delete_estandar($data)
	{
		$query = $this->db->table($this->table)
			->where($this->primaryKey, $data["id"])
			->delete();
		return $query ? true : false;
	}

	//Eliminación logica
	public function delete_estandar_logic($data)
	{
		$query = $this->db->table($this->table)
			->set('is_active', 0)
			->where($this->primaryKey, $data["id"])
			->update();
		return $query ? true : false;
	}
	//contar cantidad de estudiantes por programa
	public function cont_estandar_x_prog()
	{
		$query = $this->db->table($this->table)
			->select('SUM(num_estudiantes) as total, PR.nombre_prog AS programa, PE.nombre AS perfil_est')
			->join('tbl_programa AS PR', 'PR.id_tbl_programa =' . $this->foreingkey)
			->join('tbl_perfil_est AS PE', 'PE.id_tbl_perfil_est = PR.fk_tbl_perfil_est')
			->groupBy('programa, perfil_est')
			->get()
			->getResultArray();

		return $query;
	}
}
