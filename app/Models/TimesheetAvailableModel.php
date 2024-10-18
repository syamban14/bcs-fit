<?php
namespace App\Models;

use CodeIgniter\Model;
	
class TimesheetAvailableModel extends Model {
 
    protected $table = 'v_available_driver';

    protected $primaryKey = 'time_attendance_id';
    
	// get all fields of table
    protected $allowedFields = ['time_attendance_id','payroll_id','nama_karyawan','attendance_date','clock_in','clock_in_ip_address','clock_out','clock_out_ip_address','clock_in_out','clock_in_latitude','clock_in_longitude','clock_out_latitude','clock_out_longitude','time_late','early_leaving','overtime','total_work','istirahat','jamnya','attendance_status'];
	
	protected $validationRules = [];
	protected $validationMessages = [];
	protected $skipValidation = false;
	
 
}
?>