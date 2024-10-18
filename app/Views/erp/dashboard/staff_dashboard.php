<?php
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\SystemModel;
use App\Models\ConstantsModel;
use App\Models\LeaveModel;
use App\Models\ShiftModel;
use App\Models\TicketsModel;
use App\Models\ProjectsModel;
use App\Models\DesignationModel;
use App\Models\TransactionsModel;
use App\Models\StaffdetailsModel;
use App\Models\HrisModel;
//$encrypter = \Config\Services::encrypter();
$SystemModel = new SystemModel();
$RolesModel = new RolesModel();
$UsersModel = new UsersModel();
$LeaveModel = new LeaveModel();
$ShiftModel = new ShiftModel();
$TicketsModel = new TicketsModel();
$ProjectsModel = new ProjectsModel();
$ConstantsModel = new ConstantsModel();
$DesignationModel = new DesignationModel();
$TransactionsModel = new TransactionsModel();
$StaffdetailsModel = new StaffdetailsModel();
$HrisModel = new HrisModel();

$session = \Config\Services::session();
$usession = $session->get('sup_username');
$request = \Config\Services::request();
$xin_system = erp_company_settings();
$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
if($user_info['user_type'] == 'staff'){
	$total_staff = $UsersModel->where('company_id', $user_info['company_id'])->where('user_type','staff')->countAllResults();
	$total_projects = $ProjectsModel->where('company_id',$user_info['company_id'])->countAllResults();
	$total_tickets = $TicketsModel->where('company_id',$user_info['company_id'])->countAllResults();
	$open = $TicketsModel->where('company_id',$user_info['company_id'])->where('ticket_status', 1)->countAllResults();
	$closed = $TicketsModel->where('company_id',$user_info['company_id'])->where('ticket_status', 2)->countAllResults();
	$_company_id = $user_info['company_id'];
} else {
	$total_staff = $UsersModel->where('company_id', $usession['sup_user_id'])->where('user_type','staff')->countAllResults();
	$total_projects = $ProjectsModel->where('company_id',$usession['sup_user_id'])->countAllResults();
	$total_tickets = $TicketsModel->where('company_id',$usession['sup_user_id'])->countAllResults();
	$open = $TicketsModel->where('company_id',$usession['sup_user_id'])->where('ticket_status', 1)->countAllResults();
	$closed = $TicketsModel->where('company_id',$usession['sup_user_id'])->where('ticket_status', 2)->countAllResults();
	$_company_id = $usession['sup_user_id'];
}
$employee_detail = $StaffdetailsModel->where('user_id', $usession['sup_user_id'])->first();
$office_shifts = $ShiftModel->where('company_id', $_company_id)->where('office_shift_id', $employee_detail['office_shift_id'])->first();
$idesignations = $DesignationModel->where('company_id', $_company_id)->where('designation_id',$employee_detail['designation_id'])->first(); 
$nama = $HrisModel->where('payroll_id', $user_info['payroll_id'])->first();
$att_date =  date('d-M-Y');
$get_day = strtotime($att_date);
$day = date('l', $get_day);
if($day == 'Monday') {
	if($office_shifts['monday_in_time'] == '') {
		$shift_val = lang('Attendance.attendance_today').': <span class="badge badge-light-success">'.lang('Dashboard.left_holiday').'</span>';
	} else {
		$monday_in_time = strtotime($office_shifts['monday_in_time']);
		$imonday_in_time = date("h:i a", $monday_in_time);
		$monday_out_time = strtotime($office_shifts['monday_out_time']);
		$imonday_out_time = date("h:i a", $monday_out_time);
		$shift_val = lang('Dashboard.dashboard_my_office_shift').': '.$imonday_in_time .' ' .lang('Employees.dashboard_to').' ' .$imonday_out_time;
	}
} else if($day == 'Tuesday') {	
	if($office_shifts['tuesday_in_time'] == '') {
		$shift_val = lang('Attendance.attendance_today').': <span class="badge badge-light-success">'.lang('Dashboard.left_holiday').'</span>';
	} else {
		$tuesday_in_time = strtotime($office_shifts['tuesday_in_time']);
		$ituesday_in_time = date("h:i a", $tuesday_in_time);
		$tuesday_out_time = strtotime($office_shifts['tuesday_out_time']);
		$ituesday_out_time = date("h:i a", $tuesday_out_time);
		$shift_val = lang('Dashboard.dashboard_my_office_shift').': '.$ituesday_in_time .' ' . lang('Employees.dashboard_to').' '.$ituesday_out_time;
	}
} else if($day == 'Wednesday') {
	if($office_shifts['wednesday_in_time'] == '') {
		$shift_val = lang('Attendance.attendance_today').': <span class="badge badge-light-success">'.lang('Dashboard.left_holiday').'</span>';
	} else {
		$wednesday_in_time = strtotime($office_shifts['wednesday_in_time']);
		$iwednesday_in_time = date("h:i a", $wednesday_in_time);
		$wednesday_out_time = strtotime($office_shifts['wednesday_out_time']);
		$iwednesday_out_time = date("h:i a", $wednesday_out_time);
		$shift_val = lang('Dashboard.dashboard_my_office_shift').': '.$iwednesday_in_time .' ' . lang('Employees.dashboard_to').' ' .$iwednesday_out_time;
	}
} else if($day == 'Thursday') {	
	if($office_shifts['thursday_in_time'] == '') {
		$shift_val = lang('Attendance.attendance_today').': <span class="badge badge-light-success">'.lang('Dashboard.left_holiday').'</span>';
	} else {
		$thursday_in_time = strtotime($office_shifts['thursday_in_time']);
		$ithursday_in_time = date("h:i a", $thursday_in_time);
		$thursday_out_time = strtotime($office_shifts['thursday_out_time']);
		$ithursday_out_time = date("h:i a", $thursday_out_time);
		$shift_val = lang('Dashboard.dashboard_my_office_shift').': '.$ithursday_in_time .' ' . lang('Employees.dashboard_to').' ' .$ithursday_out_time;
	}
} else if($day == 'Friday') {	
	if($office_shifts['friday_in_time'] == '') {
		$shift_val = lang('Attendance.attendance_today').': <span class="badge badge-light-success">'.lang('Dashboard.left_holiday').'</span>';
	} else {
		$friday_in_time = strtotime($office_shifts['friday_in_time']);
		$ifriday_in_time = date("h:i a", $friday_in_time);
		$friday_out_time = strtotime($office_shifts['friday_out_time']);
		$ifriday_out_time = date("h:i a", $friday_out_time);
		$shift_val = lang('Dashboard.dashboard_my_office_shift').': '.$ifriday_in_time .' ' . lang('Employees.dashboard_to').' ' .$ifriday_out_time;
	}
} else if($day == 'Saturday') {	
	if($office_shifts['saturday_in_time'] == '') {
		$shift_val = lang('Attendance.attendance_today').': <span class="badge badge-light-success">'.lang('Dashboard.left_holiday').'</span>';
	} else {
		$saturday_in_time = strtotime($office_shifts['saturday_in_time']);
		$isaturday_in_time = date("h:i a", $saturday_in_time);
		$saturday_out_time = strtotime($office_shifts['saturday_out_time']);
		$isaturday_out_time = date("h:i a", $saturday_out_time);
		$shift_val = lang('Dashboard.dashboard_my_office_shift').': '.$isaturday_in_time .' ' . lang('Employees.dashboard_to').' ' .$isaturday_out_time;
	}
} else if($day == 'Sunday') {	
	if($office_shifts['sunday_in_time'] == '') {
		$shift_val = lang('Attendance.attendance_today').': <span class="badge badge-light-success">'.lang('Dashboard.left_holiday').'</span>';
	} else {
		$sunday_in_time = strtotime($office_shifts['sunday_in_time']);
		$isunday_in_time = date("h:i a", $sunday_in_time);
		$sunday_out_time = strtotime($office_shifts['sunday_out_time']);
		$isunday_out_time = date("h:i a", $sunday_out_time);
		$shift_val = lang('Dashboard.dashboard_my_office_shift').': '.$isunday_in_time .' ' . lang('Employees.dashboard_to').' ' .$isunday_out_time;
	}	
}
?>

<!-- <img width="320px" heigth="250px" src="https://d3sjkexdc7x7w0.cloudfront.net/article/5a3a0b62150ba0987b83dacb/5a3a0b62150ba0987b83dacb_1514975732.webp" /> -->

<div class="row">
  <div class="col-xl-6 col-md-12">
    <div class="row">
      <div class="col-xl-12 col-md-12">
        <div class="card proj-t-card">
          <div class="card-body">
            <div class="row align-items-center m-b-30">
              <div class="col-auto"> 
              </div>
              <div class="col p-l-0">
                <h6 class="m-b-5"><?= lang('Dashboard.dashboard_welcome');?> <?= $user_info['payroll_id'].' '.$nama['nama_karyawan'];?></h6>
                <!-- <h6 class="m-b-0 text-primary"><?= $shift_val;?></h6> -->
              </div>
            </div>
            <?php $attributes = array('name' => 'hr_clocking', 'id' => 'hr_clocking', 'autocomplete' => 'off', 'class'=>'m-b-1'); 
				  $hidden = array('token' => uencode($usession['sup_user_id']));?>
            <?= form_open('erp/timesheet/set_clocking', $attributes, $hidden);?>
            <?php
			//  echo attendance_time_checks();
			//  echo date('d-m-Y H:i:s');
			if(attendance_time_checks() < 1) { ?>
            <input type="hidden" value="clock_in" name="clock_state" id="clock_state">
        	<input type="hidden" value="" name="time_id" id="time_id">
            <div class="row align-items-center text-center">
              <div class="col">
                <h6 class="m-b-0">                
                  <button type="submit" class="btn waves-effect waves-light btn-sm btn-success"><?= lang('Attendance.dashboard_clock_in');?> <i class="fas fa-long-arrow-alt-right m-r-10"></i></button>
                </h6>
              </div>
              <div class="col">
                <h6 class="m-b-0">
                  <button class="btn waves-effect waves-light btn-sm btn-secondary" type="button" disabled="disabled"><?= lang('Attendance.dashboard_clock_out');?> <i class="fas fa-long-arrow-alt-down m-r-10"></i></button>
                </h6>
              </div>
            </div>
            <?php } else { 	
					$attendance_value = attendance_time_checks_value();
			?>
			<!-- <textarea class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan" require="required"></textarea><br/> -->
            <input type="hidden" value="clock_out" name="clock_state" id="clock_state">
            <input type="hidden" value="<?= uencode($attendance_value[0]->time_attendance_id);?>" name="time_id" id="time_id">
            <div class="row align-items-center text-center">
              <div class="col">
                <h6 class="m-b-0">                
                  <button type="button" disabled="disabled" class="btn waves-effect waves-light btn-sm btn-success"><?= lang('Attendance.dashboard_clock_in');?> <i class="fas fa-long-arrow-alt-right m-r-10"></i></button>
                </h6>
              </div>
              <div class="col">
                <h6 class="m-b-0">
					<button class="btn waves-effect waves-light btn-sm btn-secondary" type="submit"><?= lang('Attendance.dashboard_clock_out');?> <i class="fas fa-long-arrow-alt-down m-r-10"></i></button>
                  <!-- <button class="btn waves-effect waves-light btn-sm btn-secondary" type="submit"><?= lang('Attendance.dashboard_clock_out');?> <i class="fas fa-long-arrow-alt-down m-r-10"></i></button> -->
                </h6>
              </div>
            </div>
            <?php } ?>
			<?= form_close(); ?>
            <h6 class="pt-badge badge-light-success"><?= $idesignations['designation_name'];?></h6>
          </div>
          <a href="<?= site_url('erp/attendance-list');?>" class="btn btn-primary btn-sm btn-round"><?= lang('Attendance.dashboard_my_attendance');?> <i class="fas fa-long-arrow-alt-right m-r-10"></i></a>
        </div>
      </div>
    </div>

  </div>
  
</div>
