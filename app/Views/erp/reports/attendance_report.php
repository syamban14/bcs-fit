<?php
use App\Controllers\BaseController;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\SystemModel;
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\MainModel;
use App\Models\ShiftModel;
use App\Models\TimesheetModel;
use App\Models\ConstantsModel;
use App\Models\DepartmentModel;
use App\Models\DesignationModel;
use App\Models\StaffdetailsModel;
use App\Models\OvertimerequestModel;
use App\Models\HrisModel;

$SystemModel = new SystemModel();
$RolesModel = new RolesModel();
$UsersModel = new UsersModel();
$MainModel = new MainModel();
$ShiftModel = new ShiftModel();
$ConstantsModel = new ConstantsModel();
$TimesheetModel = new TimesheetModel();
$DepartmentModel = new DepartmentModel();
$DesignationModel = new DesignationModel();
$StaffdetailsModel = new StaffdetailsModel();
$OvertimerequestModel = new OvertimerequestModel();
$HrisModel = new HrisModel();

$session = \Config\Services::session();
$usession = $session->get('sup_username');
$request = \Config\Services::request();

$staff_info = udecode($_REQUEST['S']);
$seg_user_id = $staff_info;
$req_month_year = $_REQUEST['M'];

$attendance_date = $date_info;

$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
// if($user_info['user_type'] == 'staff'){
// 	$timesheet_data = $TimesheetModel->where('company_id', $user_info['company_id'])->where('employee_id', $seg_user_id)->first();
// 	$user_data = $UsersModel->where('company_id', $user_info['company_id'])->where('user_id', $seg_user_id)->first();
// 	// userdata
// 	$employee_detail = $StaffdetailsModel->where('user_id', $seg_user_id)->first();
// 	$idesignations = $DesignationModel->where('company_id', $user_info['company_id'])->where('designation_id',$employee_detail['designation_id'])->first();
// 	$get_data = $TimesheetModel->where('company_id', $user_info['company_id'])->where('employee_id',$seg_user_id)->where('attendance_date',$attendance_date)->findAll();
// 	// total hours worked
// 	$first_data = $TimesheetModel->where('company_id', $user_info['company_id'])->where('employee_id', $seg_user_id)->where('attendance_date', $attendance_date)->first();
// } else {
// 	$timesheet_data = $TimesheetModel->where('company_id', $usession['sup_user_id'])->where('employee_id', $seg_user_id)->first();
	$timesheet_data = $TimesheetModel->where('employee_id', $seg_user_id)->first();
	$user_data = $UsersModel->where('company_id', $usession['sup_user_id'])->where('user_id', $seg_user_id)->first();
	// userdata
	$employee_detail = $StaffdetailsModel->where('user_id', $seg_user_id)->first();
	$idesignations = $DesignationModel->where('company_id', $usession['sup_user_id'])->where('designation_id',$employee_detail['designation_id'])->first();
// 	$get_data = $TimesheetModel->where('company_id', $usession['sup_user_id'])->where('employee_id',$seg_user_id)->where('attendance_date',$attendance_date)->findAll();
	$get_data = $TimesheetModel->where('employee_id',$seg_user_id)->where('attendance_date',$attendance_date)->findAll();
	// total hours worked
// 	$first_data = $TimesheetModel->where('company_id', $usession['sup_user_id'])->where('employee_id', $seg_user_id)->where('attendance_date', $attendance_date)->first();
	$first_data = $TimesheetModel->where('employee_id', $seg_user_id)->where('attendance_date', $attendance_date)->first();
// }

?>
<?php
?>
<?php
$date_info = strtotime($req_month_year.'-01');
$imonth_year = explode('-',$req_month_year);
$day = date('d', $date_info);
$month = date($imonth_year[1], $date_info);
$year = date($imonth_year[0], $date_info);

/* Set the date */
$date = date("F, Y", strtotime($req_month_year.'-01'));//strtotime(date("Y-m-d"),$date_info);
// total days in month
$daysInMonth =  date('t');
//$date = strtotime(date("Y-m-d"));
$day = date('d', $date_info);
$month = date('m', $date_info);
$year = date('Y', $date_info);
$month_year = date('Y-m');
$ci_erp_settings = $SystemModel->where('setting_id', 1)->first();
$namanya = $HrisModel->where('payroll_id', $user_data['payroll_id'])->first();
?>

<div class="row justify-content-md-center"> 
  <!-- [ Attendance view ] start -->
  <div class="col-md-8"> 
    <!-- [ Attendance view ] start -->
    <div class="container">
      <div>
        <div class="card" id="printTable">
          <div class="card-header">
            <h5><img class="img-fluid" width="171" height="30" src="<?= base_url();?>/public/uploads/logo/other/<?= $ci_erp_settings['other_logo'];?>" alt=""></h5>
          </div>
          <div class="card-body pb-0">
            <div class="row invoive-info d-pdrint-inline-flex justify-content-md-center">
              <div class="col-md-6">
                <div class="media user-about-block align-items-center mt-0">
                  <div class="position-relative d-inline-block"> <img class="img-radius img-fluid wid-80" src="<?= staff_profile_photo($seg_user_id);?>" alt="<?= $user_data['first_name'].' '.$user_data['last_name'];?>"> </div>
                  <div class="media-body ml-3">
                    <h6 class="mb-1">
                      <?= $user_data['payroll_id'].' - '.$namanya['nama_karyawan'];?>
                    </h6>
                    <p class="mb-0 text-muted">
                      <?= $idesignations['designation_name'];?>
                    </p>
                    <p class="mb-0 text-muted">
                      <?= $user_data['email'];?>
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <h5 class="m-b-10 text-primary text-uppercase"><?php echo lang('Attendance.xin_attendance_month');?></h5>
                <h4 class="text-uppercase text-primary m-l-30"> <strong>
                  <?= $date;?>
                  </strong> </h4>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-md-12">
                <div class="table-responsive">
                  <table class="table invoice-detail-table">
                    <thead>
                      <tr class="thead-default">
                        <th>Day</th>
                        <th>Date</th>
                        <th>Clock In</th>
                        <th>Clock Out</th>
                        <th>Status</th>
                        <th>&nbsp;</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php for($i = 1; $i <= $daysInMonth; $i++):  
					$i = str_pad($i, 2, 0, STR_PAD_LEFT);
					// get date <
					$attendance_date = $i.'-'.$month.'-'.$year;
					$tdate = $year.'-'.$month.'-'.$i;
					$get_day = strtotime($attendance_date);
					$day = date('l', $get_day);
			
				  // Ambil data kehadiran untuk mendapatkan clock in dan clock out
					$attendance_record = $TimesheetModel->where('employee_id', $seg_user_id)
					->where('attendance_date', $tdate)
					->first();

					// Set nilai default jika tidak ada data
					$clock_in = $attendance_record['clock_in'] ?? '-';
					$clock_out = $attendance_record['clock_out'] ?? '-';
                        // echo $attendance_record;
				// 	$check_attendance = user_attendance_monthly_value($attendance_date,$seg_user_id);
			    	$check_attendance =  $attendance_record;
					if($check_attendance > 0) {
						$status = '<span class="text-success">'.lang('Attendance.attendance_present').'</span>';
					} else {
						$event_name = '';
						$status = '<span class="text-danger">'.lang('Attendance.attendance_absent').'</span>';
						// set to present date
						$iattendance_date = strtotime($attendance_date);
						$icurrent_date = strtotime(date('Y-m-d'));
						$status = $status;
						if($iattendance_date <= $icurrent_date){
							$status = $status;
						} else {
							$status = '';
						}
						$idate_of_joining = strtotime($user_data['date_of_joining']);
						if($idate_of_joining < $iattendance_date){
							$status = $status;
						} else {
							$status = '';
						}
					}
					?>
                      <tr>
                        <td width="150"><?= $day;?></td>
                        <td width="200"><?= $attendance_date;?></td>
                        <td><?= (!empty($clock_in) && strtotime($clock_in) !== false) ? date('d-m-Y H:i:s', strtotime($clock_in)) : '-'; ?></td>
                        <td><?= (!empty($clock_out) && strtotime($clock_out) !== false) ? date('d-m-Y H:i:s', strtotime($clock_out)) : '-'; ?></td>
                        <td><?= $status;?></td>
                        <td><?= $event_name; ?></td>
                      </tr>
                      <?php endfor;?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row text-center d-print-none">
          <div class="col-sm-12 invoice-btn-group text-center">
            <button type="button" class="btn btn-print-invoice waves-effect waves-light btn-success m-b-10">
            <?= lang('Main.xin_print');?>
            </button>
           </div>
        </div>
      </div>
    </div>
    <!-- [ Attendance view ] end --> 
  </div>
</div>