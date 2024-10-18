<?php
use App\Models\SystemModel;
use App\Models\UsersModel;
use App\Models\LanguageModel;
use App\Models\DepartmentModel;
use App\Models\HrisModel;

$SystemModel = new SystemModel();
$UsersModel = new UsersModel();
$LanguageModel = new LanguageModel();
$DepartmentModel = new DepartmentModel();
$HrisModel = new HrisModel();

$session = \Config\Services::session();
$usession = $session->get('sup_username');
$router = service('router');
$xin_system = $SystemModel->where('setting_id', 1)->first();
$user = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
if($user['user_type'] == 'staff'){
   $staff_info = $UsersModel->where('company_id', $user['company_id'])->where('user_type','staff')->findAll();
} else {
// 	$staff_info = $UsersModel->where('company_id', $usession['sup_user_id'])->where('user_type','staff')->findAll();
	$staff_info = $UsersModel->where('user_type','staff')->findAll();
}
// echo count($staff_info) > 0 ? '1' : '0';
$locale = service('request')->getLocale();
?>
<?php if(in_array('attendance',staff_role_resource()) || in_array('upattendance1',staff_role_resource()) || in_array('monthly_time',staff_role_resource()) || in_array('overtime_req1',staff_role_resource())|| $user['user_type'] == 'company') {?>

<div id="smartwizard-2" class="border-bottom smartwizard-example sw-main sw-theme-default mt-2">
  <ul class="nav nav-tabs step-anchor">
    <?php if(in_array('attendance',staff_role_resource()) || $user['user_type'] == 'company') {?>
    <li class="nav-item clickable"> <a href="<?= site_url('erp/attendance-list');?>" class="mb-3 nav-link"> <span class="sw-done-icon feather icon-check-circle"></span> <span class="sw-icon feather icon-clock"></span>
      <?= lang('Dashboard.left_attendance');?>
      <div class="text-muted small">
        <?= lang('Main.xin_view');?>
        <?= lang('Dashboard.left_attendance');?>
      </div>
      </a> </li>
    <?php } ?>
    <?php if(in_array('upattendance1',staff_role_resource()) || $user['user_type'] == 'company') {?>
    <li class="nav-item clickable"> <a href="<?= site_url('erp/manual-attendance');?>" class="mb-3 nav-link"> <span class="sw-done-icon feather icon-check-circle"></span> <span class="sw-icon feather icon-edit"></span>
      <?= lang('Dashboard.left_update_attendance');?>
      <div class="text-muted small">
        <!-- <?= lang('Main.xin_add_edit');?> -->
        <?= lang('Dashboard.left_attendance');?>
      </div>
      </a> </li>
    <?php } ?>
    <?php if(in_array('monthly_time',staff_role_resource()) || $user['user_type'] == 'company') {?>
    <li class="nav-item active"> <a href="<?= site_url('erp/monthly-attendance');?>" class="mb-3 nav-link"> <span class="sw-done-icon feather icon-check-circle"></span> <span class="sw-icon feather icon-calendar"></span>
      <?= lang('Dashboard.xin_month_timesheet_title');?>
      <div class="text-muted small">
        <?= lang('Main.xin_view');?>
        <?= lang('Dashboard.xin_month_timesheet_title');?>
      </div>
      </a> </li>
    <?php } ?>
    <?php if(in_array('overtime_req1',staff_role_resource()) || $user['user_type'] == 'company') {?>
    
      </div>
      </a> </li>
    <?php } ?>
  </ul>
</div>
<hr class="border-light m-0 mb-3">
<?php } ?>
<div class="row">
  <div class="col-sm-12">
    <div class="card mb-2">
      <div class="card-body">
        <?php $attributes = array('name' => 'monthly_attendance_report', 'id' => 'monthly_attendance', 'method' => 'GET', 'target' => '_blank');?>
        <?php $hidden = array('token' => uencode(date('Y-m')));?>
        <?php echo form_open('erp/monthly-attendance-view', $attributes, $hidden);?>
        <div class="row justify-content-center">
          <div class="col-sm-12">
            <div class="row align-items-center">
              <div class="col">
                <label for="department">
                  <?= lang('Dashboard.dashboard_employee');?>
                </label>
                <select id="S" class="form-control" data-plugin="select_hrm" data-placeholder="<?= lang('Dashboard.dashboard_employee');?>" name="S">
                  <?php foreach($staff_info as $_user) { 
                          $nama=$HrisModel->where('payroll_id',$_user['payroll_id'])->first();
                          $name=$nama['nama_karyawan'];
                    ?>
                  <option value="<?= uencode($_user['user_id'])?>">
                  <?= $_user['payroll_id'].' - '.$name;?>
                  </option>
                  <?php } ?>
                </select>
              </div>
              <div class="col">
                <label class="form-label">
                  <?= lang('Payroll.xin_select_month');?>
                </label>
                <input class="form-control hr_month_year" placeholder="<?= lang('Payroll.xin_select_month');?>" name="M" type="text" value="<?= date('Y-m');?>">
              </div>
              <div class="col">
                <label class="form-label">&nbsp;</label>
                <br />
                <button type="submit" class="btn btn-primary"><i data-feather="search"></i></button>
              </div>
            </div>
          </div>
        </div>
        <?= form_close(); ?>
      </div>
    </div>
  </div>
</div>
<style type="text/css">
.hide-calendar .ui-datepicker-calendar { display:none !important; }
.hide-calendar .ui-priority-secondary { display:none !important; }
</style>
