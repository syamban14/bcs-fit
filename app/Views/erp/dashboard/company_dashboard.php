<?php
use CodeIgniter\I18n\Time;

use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\SystemModel;
use App\Models\ConstantsModel;
use App\Models\LeaveModel;
use App\Models\TicketsModel;
use App\Models\ProjectsModel;
use App\Models\MembershipModel;
use App\Models\TransactionsModel;
use App\Models\CompanymembershipModel;
//$encrypter = \Config\Services::encrypter();
$SystemModel = new SystemModel();
$RolesModel = new RolesModel();
$UsersModel = new UsersModel();
$LeaveModel = new LeaveModel();
$TicketsModel = new TicketsModel();
$ProjectsModel = new ProjectsModel();
$MembershipModel = new MembershipModel();
$TransactionsModel = new TransactionsModel();
$ConstantsModel = new ConstantsModel();
$CompanymembershipModel = new CompanymembershipModel();

$session = \Config\Services::session();
$usession = $session->get('sup_username');
$request = \Config\Services::request();
$xin_system = erp_company_settings();
$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
$company_id = user_company_info();
$total_staff = $UsersModel->where('company_id', $company_id)->where('user_type','staff')->countAllResults();
$total_projects = $ProjectsModel->where('company_id',$company_id)->countAllResults();
$total_tickets = $TicketsModel->where('company_id',$company_id)->countAllResults();
$open = $TicketsModel->where('company_id',$company_id)->where('ticket_status', 1)->countAllResults();
$closed = $TicketsModel->where('company_id',$company_id)->where('ticket_status', 2)->countAllResults();
	
// membership
$company_membership = $CompanymembershipModel->where('company_id', $usession['sup_user_id'])->first();
$subs_plan = $MembershipModel->where('membership_id', $company_membership['membership_id'])->first();
$current_time = Time::now('Asia/Karachi');
$company_membership_details = company_membership_details();
if($company_membership_details['diff_days'] < 8){
	$alert_bg = 'alert-danger';
} else {
	$alert_bg = 'alert-warning';
}	
?>

<div class="row">
  <div class="col-xl-6 col-md-12">
    
    <div class="row">
      <div class="col-xl-12 col-md-12"> 
        <div class="row">
          <div class="col-xl-12 col-md-12">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-auto">
                    <h6>
                      <?= lang('Dashboard.xin_staff_attendance');?>
                    </h6>
                  </div>
                  <div class="col">
                    <div class="dropdown float-right">
                      <?= date('d F, Y');?>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6 pr-0">
                    <a href="attendance-list"><h6 class="my-3"><i class="feather icon-users f-20 mr-2 text-primary"></i>
                      <?= lang('Dashboard.xin_total_staff');?>
                    </h6></a>

                    <a href="attendance-list-work"><h6 class="my-3"><i class="feather icon-user f-20 mr-2 text-success"></i>
                      <?= lang('Attendance.attendance_present');?>
                      <span class="text-success ml-2 f-14"><i class="feather icon-arrow-up"></i></span></h6></a>

                    <a href="attendance-list-not_work"><h6 class="my-3"><i class="feather icon-user f-20 mr-2 text-danger"></i>
                      <?= lang('Attendance.attendance_absent');?>
                      <span class="text-danger ml-2 f-14"><i class="feather icon-arrow-down"></i></span></h6></a>

                    <a href="leave-list_dash"><h6 class="my-3"><i class="feather icon-user f-20 mr-2 text-info"></i>
                      <?= lang('Attendance.permission_request');?>
                      <span class="text-info ml-2 f-14"> </span></h6></a>

                    <a href="disciplinary-cases_dash"><h6 class="my-3"><i class="feather icon-user f-20 mr-2 text-warning"></i>
                      <?= lang('Attendance.grounded');?>
                      <span class="text-warning ml-2 f-14"> </span></h6></a> 
                  </div>
                  <div class="col-6">
                    <div id="staff-attendance-chart" class="chart-percent text-center"></div>
                  </div>
                </div>
                
              </div>
            </div>
          </div>
        </div>
        <div class="card flat-card">
      <div class="row-table"> 
      </div>
    </div>
      </div>
    </div>
  </div>
  <div class="col-xl-6 col-md-12"> 
  </div>
</div>