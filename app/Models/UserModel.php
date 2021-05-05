<?php 
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model{
	
	function __construct()
    {
        parent::__construct();
    }

    protected $DBGroup              = 'default';
	protected $table                = 'tbl_usuario';
	protected $primaryKey           = 'id_tbl_usuario';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = [
		"nombres", 
		"apellidos", 
		"correo", 
		"telefono",
		"contrasenia"
	];

    // Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

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

	

	public function exist_email($email)
    {
        $querye = $this->table($this->table)
					->where('correo', $email)
					->countAllResults();
		
        if($querye >  0){
            $querye = true;
        } else {
            $querye = false;
        }
        return $querye;
    }

	public function register($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query ? true : false;
    }
 
    public function data_user($email)
    {
        $query = $this->table($this->table)
                ->where('correo', $email)
                ->countAllResults(); //->countAll(); OJO ESTE CUENTA TODOS LOS REGISTRO PERO NO APLICA EL WHERE
 
        if($query >  0){
            $hasil = $this->table($this->table)
                    ->where('correo', $email)
                    ->limit(1)
                    ->get()
                    ->getRowArray();
        } else {
            $hasil = array(); 
        }
        return $hasil;
    }

}