<?php
namespace App\Models;

use CodeIgniter\Model;
	
class ImsModel extends Model {
 
	protected $DBGroup = 'ims';
    protected $table = 'm_kualifikasi_driver';

    protected $primaryKey = 'payroll_id';
    
	// get all fields of user roles table
    protected $allowedFields = ['payroll_id','lox','lin','lar','h2','csc'];
	
	protected $validationRules = [];
	protected $validationMessages = [];
	protected $skipValidation = false;
	
 
}
?>