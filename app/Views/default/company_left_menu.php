<?php
use App\Models\SystemModel;
use App\Models\SuperroleModel;
use App\Models\UsersModel;
use App\Models\MembershipModel;
use App\Models\CompanymembershipModel;

$SystemModel = new SystemModel();
$UsersModel = new UsersModel();
$SuperroleModel = new SuperroleModel();
$MembershipModel = new MembershipModel();
$CompanymembershipModel = new CompanymembershipModel();
$session = \Config\Services::session();
$router = service('router');
$usession = $session->get('sup_username');
$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
$xin_system = $SystemModel->where('setting_id', 1)->first();
?>
<?php $arr_mod = select_module_class($router->controllerName(),$router->methodName()); ?>
<?php 
if($user_info['user_type'] == 'staff'){
	$cmembership = $CompanymembershipModel->where('company_id', $user_info['company_id'])->first();
} else {
	$cmembership = $CompanymembershipModel->where('company_id', $usession['sup_user_id'])->first();
}

$mem_info = $MembershipModel->where('membership_id', $cmembership['membership_id'])->first();
$modules_permission = unserialize($mem_info['modules_permission']);
?>

<ul class="pc-navbar">
  <li class="pc-item pc-caption">
    <label>
      <?= lang('Dashboard.dashboard_your_company');?>
    </label>
  </li>
  <!-- Dashboard|Home -->
  <li class="pc-item"><a href="<?= site_url('erp/desk');?>" class="pc-link "><span class="pc-micon"><i data-feather="home"></i></span><span class="pc-mtext">
    <?= lang('Dashboard.dashboard_title');?>
    </span></a></li>
  <!-- Employees -->
  <li class="pc-item"><a href="<?= site_url('erp/staff-list');?>" class="pc-link "><span class="pc-micon"><i data-feather="users"></i></span><span class="pc-mtext">
    <?= lang('Dashboard.dashboard_employees');?>
    </span></a></li>
  <!-- CoreHR -->
  <!-- <li class="pc-item <?php if(!empty($arr_mod['corehr_open']))echo $arr_mod['corehr_open'];?>"> <a href="#" class="pc-link sidenav-toggle"> <span class="pc-micon"><i data-feather="crosshair"></i></span>
    <?= lang('Dashboard.dashboard_core_hr');?>
    </span><span class="pc-arrow"><i data-feather="chevron-right"></i></span> </a>
    <ul class="pc-submenu" <?php if(!empty($arr_mod['core_style_ul']))echo $arr_mod['core_style_ul'];?>>
      <li class="pc-item <?php if(!empty($arr_mod['department_active']))echo $arr_mod['department_active'];?>"> <a class="pc-link" href="<?= site_url('erp/departments-list');?>" >
        <?= lang('Dashboard.left_department');?>
        </a> </li>
      <li class="pc-item <?php if(!empty($arr_mod['designation_active']))echo $arr_mod['designation_active'];?>"> <a class="pc-link" href="<?= site_url('erp/designation-list');?>" >
        <?= lang('Dashboard.left_designation');?>
        </a> </li>
    
   
     
    </ul>
  </li> -->
  <!-- Attendance -->
  <li class="pc-item pc-hasmenu <?php if(!empty($arr_mod['attendance_open']))echo $arr_mod['attendance_open'];?>"> <a href="#" class="pc-link sidenav-toggle"><span class="pc-micon"><i data-feather="clock"></i></span><span class="pc-mtext">
    <?= lang('Dashboard.left_attendance');?>
    </span><span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
    <ul class="pc-submenu" <?php if(!empty($arr_mod['attendance_style_ul']))echo $arr_mod['attendance_style_ul'];?>>
      <li class="pc-item <?php if(!empty($arr_mod['attnd_active']))echo $arr_mod['attnd_active'];?>"> <a class="pc-link" href="<?= site_url('erp/attendance-list');?>" >
        <?= lang('Dashboard.left_attendance');?>
        </a> </li>
      <li class="pc-item <?php if(!empty($arr_mod['upd_attnd_active']))echo $arr_mod['upd_attnd_active'];?>"> <a class="pc-link" href="<?= site_url('erp/manual-attendance');?>" >
        <?= lang('Dashboard.left_update_attendance');?>
        </a> </li>
      <li class="pc-item <?php if(!empty($arr_mod['timesheet_active']))echo $arr_mod['timesheet_active'];?>"> <a class="pc-link" href="<?= site_url('erp/monthly-attendance');?>" >
        <?= lang('Dashboard.xin_month_timesheet_title');?>
        </a> </li>
      
    </ul>
  </li>
 
  <!-- Leave -->
  <li class="pc-item"> <a href="<?= site_url('erp/leave-list');?>" class="pc-link"> <span class="pc-micon"><i data-feather="plus-square"></i></span><span class="pc-mtext">
    <?= lang('Leave.left_leave_request');?>
    </span> </a> </li> 
 
  <!-- Disciplinary -->
  <li class="pc-item"> <a href="<?= site_url('erp/disciplinary-cases');?>" class="pc-link"> <span class="pc-micon"><i data-feather="alert-circle"></i></span><span class="pc-mtext">
    <?= lang('Dashboard.left_warnings');?>
    </span> </a> </li>
</ul>
