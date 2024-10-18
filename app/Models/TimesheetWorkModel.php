<?php
namespace App\Models;

use CodeIgniter\Model;
	
class TimesheetWorkModel extends Model {
 
    protected $table = 'v_timesheet_payroll';

    protected $primaryKey = 'time_attendance_id';
    
	// get all fields of table
    protected $allowedFields = ['time_attendance_id','employee_id','username','payroll_id','attendance_date','clock_in','clock_out','clock_in_out','total_work2'];
	
	protected $validationRules = [];
	protected $validationMessages = [];
	protected $skipValidation = false;
	
 
}
?>