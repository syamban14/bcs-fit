<?php
namespace App\Models;

use CodeIgniter\Model;
	
class HrisModel extends Model {
 
	protected $DBGroup = 'hris';
    protected $table = 'v_driver_alindo';

    protected $primaryKey = 'payroll_id';
    
	// get all fields of user roles table
    protected $allowedFields = ['payroll_id','nama_karyawan','no_sim_b2_umum','no_sim_b2_umum_expiredate','file'];
	
	protected $validationRules = [];
	protected $validationMessages = [];
	protected $skipValidation = false;
	
 
}
?>