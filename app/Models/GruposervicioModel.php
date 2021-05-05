<?php 
namespace App\Models;

use CodeIgniter\Model;


class GruposervicioModel extends Model{
    
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
		"fk_tbl_serv_salud"
	];

    // Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';
	protected $activeField         = 'is_active';

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
	public function exist_grupo($numero)
    {
        $querye = $this->table($this->table)
					->where('numero', $numero)
					->countAllResults();
		
        if($querye >  0){
            $querye = true;
        } else {
            $querye = false;
        }
        return $querye;
    }

	public function get_all_grupo()
    {
        $querye = $this->table($this->table)
					    ->get()
						->getRowArray();
        
        return $querye;
    }

	public function get_data_grupo($pk)
    {
        $querye = $this->table($this->table)
					->where($this->primaryKey, $pk)
					->countAllResults();
		
        if($querye >  0){
            $querye = true;
        } else {
            $querye = false;
        }
        return $querye;
    }

	public function insert_grupo($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query ? true : false;
    }
}