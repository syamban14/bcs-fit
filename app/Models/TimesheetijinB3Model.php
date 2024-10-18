<?php
namespace App\Models;

use CodeIgniter\Model;
	
class TimesheetijinB3Model extends Model {
 
    protected $table = 'v_driver_unit_ijin_b3';

    protected $primaryKey = 'kode_supir';
    
	// get all fields of table
    protected $allowedFields = ['kode_supir','tgl_transaksi','nomor_unit','expired_date','attach_file','attachment_3','tgl_expired'];
	
	protected $validationRules = [];
	protected $validationMessages = [];
	protected $skipValidation = false;
	 
}
?>