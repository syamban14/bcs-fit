<?php
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\SystemModel;
use App\Models\LeaveModel;
use App\Models\ConstantsModel;
//$encrypter = \Config\Services::encrypter();
$SystemModel = new SystemModel();
$RolesModel = new RolesModel();
$UsersModel = new UsersModel();
$LeaveModel = new LeaveModel();
$ConstantsModel = new ConstantsModel();

$session = \Config\Services::session();
$usession = $session->get('sup_username');
$request = \Config\Services::request();

$date = date('Y-m-d');
$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
if($user_info['user_type'] == 'staff'){
	$leave_types = $ConstantsModel->where('company_id',$user_info['company_id'])->where('type','leave_type')->orderBy('constants_id', 'ASC')->findAll();
} else {
	$leave_types = $ConstantsModel->where('company_id',$usession['sup_user_id'])->where('type','leave_type')->orderBy('constants_id', 'ASC')->findAll();
}
if($user_info['user_type'] == 'staff'){
	$leave_types = $ConstantsModel->where('company_id',$user_info['company_id'])->where('type','leave_type')->orderBy('constants_id', 'ASC')->findAll();
	$total_leave = $LeaveModel->where('employee_id',$usession['sup_user_id'])->where('from_date >=',$date)->where('to_date <=',$date)->countAllResults();
	$leave_pending = $LeaveModel->where('employee_id',$usession['sup_user_id'])->where('status', 1)->where('from_date >=',$date)->where('to_date <=',$date)->countAllResults();
	$total_accepted = $LeaveModel->where('employee_id',$usession['sup_user_id'])->where('status', 2)->where('from_date >=',$date)->where('to_date <=',$date)->countAllResults();
	$total_rejected = $LeaveModel->where('employee_id',$usession['sup_user_id'])->where('status', 3)->where('from_date >=',$date)->where('to_date <=',$date)->countAllResults();
} else {
	$leave_types = $ConstantsModel->where('company_id',$usession['sup_user_id'])->where('type','leave_type')->orderBy('constants_id', 'ASC')->findAll();
	$total_leave = $LeaveModel->where('company_id',$usession['sup_user_id'])->where('from_date >=',$date)->where('to_date <=',$date)->orderBy('leave_id', 'ASC')->countAllResults();
	$leave_pending = $LeaveModel->where('company_id',$usession['sup_user_id'])->where('status', 1)->where('from_date >=',$date)->where('to_date <=',$date)->countAllResults();
	$total_accepted = $LeaveModel->where('company_id',$usession['sup_user_id'])->where('status', 2)->where('from_date >=',$date)->where('to_date <=',$date)->countAllResults();
	$total_rejected = $LeaveModel->where('company_id',$usession['sup_user_id'])->where('status', 3)->where('from_date >=',$date)->where('to_date <=',$date)->countAllResults();
}
?>
<?php if(in_array('leave2',staff_role_resource()) || in_array('leave_calendar',staff_role_resource()) || in_array('leave_type1',staff_role_resource()) || $user_info['user_type'] == 'company') { ?>

 
<hr class="border-light m-0 mb-3">
<?php } ?>
<div class="row">
  <div class="col-sm-3">
    <div class="card prod-p-card background-pattern">
      <div class="card-body">
        <div class="row align-items-center m-b-0">
          <div class="col">
            <h6 class="m-b-5">
              <?= lang('Dashboard.xin_total_leaves');?>
            </h6>
            <h3 class="m-b-0">
              <?= $total_leave;?>
            </h3>
          </div>
          <div class="col-auto"> <i class="fas fa-money-bill-alt text-primary"></i> </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="card prod-p-card bg-primary background-pattern-white">
      <div class="card-body">
        <div class="row align-items-center m-b-0">
          <div class="col">
            <h6 class="m-b-5 text-white">
              <?= lang('Main.xin_approved');?>
            </h6>
            <h3 class="m-b-0 text-white">
              <?= $total_accepted;?>
            </h3>
          </div>
          <div class="col-auto"> <i class="fas fa-database text-white"></i> </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="card prod-p-card bg-primary background-pattern-white">
      <div class="card-body">
        <div class="row align-items-center m-b-0">
          <div class="col">
            <h6 class="m-b-5 text-white">
              <?= lang('Main.xin_rejected');?>
            </h6>
            <h3 class="m-b-0 text-white">
              <?= $total_rejected;?>
            </h3>
          </div>
          <div class="col-auto"> <i class="fas fa-dollar-sign text-white"></i> </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="card prod-p-card background-pattern">
      <div class="card-body">
        <div class="row align-items-center m-b-0">
          <div class="col">
            <h6 class="m-b-5">
              <?= lang('Main.xin_pending');?>
            </h6>
            <h3 class="m-b-0">
              <?= $leave_pending;?>
            </h3>
          </div>
          <div class="col-auto"> <i class="fas fa-tags text-primary"></i> </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row m-b-1 animated fadeInRight">
<div class="col-md-12">
 
<div class="card user-profile-list <?php echo $get_animate;?>">
  
  <div class="card-body">
    <div class="box-datatable table-responsive">
      <table class="datatables-demo table table-striped table-bordered" id="xin_table">
        <thead>
          <tr>
            <th><?= lang('Dashboard.dashboard_employee');?></th>
            <th><?= lang('Leave.xin_leave_type');?></th>
            <th><i class="fa fa-calendar"></i>
              <?= lang('Leave.xin_leave_duration');?></th>
            <th><?= lang('Leave.xin_leave_days');?></th>
            <th><i class="fa fa-calendar"></i>
              <?= lang('Leave.xin_applied_on');?></th>
            <th><?= lang('Main.dashboard_xin_status');?></th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>
<div class="row">
  
  
</div>
