<?php

namespace App\Models;

use CodeIgniter\Model;

class StaffModel extends Model
{
    protected $table      = 'staffs';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
   
     
    protected $returnType     = 'array';
    //protected $useSoftDeletes = true;

    protected $allowedFields = ['name', 'email','age','address','gender','state'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    //protected $dateFormat    = 'timestamp';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    //protected $deletedField  = 'deleted_at';
    
    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];


    public function getAllStaff()
    {
        // Check if staff records are cached
        if (!$cachedStaff = cache('staff_records')) {
            // If not cached, fetch staff records from the database
           // $staffRecords = $this->findAll();
            $staffRecords = $this->UserModel->findAll();

            // Store the staff records in the cache for a specified duration (e.g., 1 hour)
            cache()->save('staff_records', $staffRecords, 3600);
        }

        return $cachedStaff ?? [];
    }
    
     
}