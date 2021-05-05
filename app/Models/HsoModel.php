<?php 
namespace App\Models;

use CodeIgniter\Model;

class HsoModel extends Model{
    
    function __construct()
    {
        parent::__construct();
    }

    protected $DBGroup              = 'default';
	protected $table                = 'tbl_uni_serv_hospital';
	protected $primaryKey           = 'id_tbl_uni_serv_hospital';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = [
		"nombre", 
		"sigla", 
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
	public function exist_hso($nombre)
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

	public function get_all_hso()
    {
        $querye = $this->table($this->table)
					    ->get()
						->getResult();
        
        return $querye;
    }

	public function get_data_hso($pk)
    {
        $querye = $this->table($this->table)
					->where($this->primaryKey, $pk)
					->get()
					->getRowArray();
        return $querye;
    }

	public function insert_hso($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query ? true : false;
    }

	public function update_hso($data)
    {
		//var_dump($data);
		//var_dump($data["id"]);
        $query = $this->db->table($this->table)
				->set('nombre', $data["nombre"])
				->set('sigla', $data["sigla"])
				->where($this->primaryKey, $data["id"])
				->update();
        return $query ? true : false;
    }

	//Eliminación logica
	public function delete_hso($data)
    {
        $query = $this->db->table($this->table)
				->set('is_active', 0)
				->where($this->primaryKey, $data["id"])
				->update();
        return $query ? true : false;
    }


}