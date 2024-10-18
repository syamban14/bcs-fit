<?php
namespace App\Models;

use CodeIgniter\Model;
	
class TimesheetrestModel extends Model {
 
    protected $table = 'v_driver_timesheet';

    protected $primaryKey = 'time_attendance_id';
    
	// get all fields of table
    protected $allowedFields = ['employee_id','attendance_date','clock_in','clock_out','clock_in_out','total_work','istirahat','attendance_status'];
	
	protected $validationRules = [];
	protected $validationMessages = [];
	protected $skipValidation = false;
	 
}
?>