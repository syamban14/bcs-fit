<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php 
use App\Models\SystemModel;
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\WarningModel;
use App\Models\ConstantsModel;

$session = \Config\Services::session();
$usession = $session->get('sup_username');

$UsersModel = new UsersModel();
$RolesModel = new RolesModel();		
$ConstantsModel = new ConstantsModel();

$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
if($user_info['user_type'] == 'staff'){
	$category_info = $ConstantsModel->where('company_id', $user_info['company_id'])->where('type','warning_type')->findAll();
	$staff_info = $UsersModel->where('company_id', $user_info['company_id'])->where('user_id!=', $usession['sup_user_id'])->where('user_type','staff')->findAll();
} else {
	$category_info = $ConstantsModel->where('company_id', $usession['sup_user_id'])->where('type','warning_type')->findAll();
	$staff_info = $UsersModel->where('company_id', $usession['sup_user_id'])->where('user_type','staff')->findAll();
}
/* Warning view
*/
$get_animate = '';
?>
<?php if(in_array('disciplinary1',staff_role_resource()) || in_array('case_type1',staff_role_resource()) || $user_info['user_type'] == 'company') { ?>
 
<hr class="border-light m-0 mb-3">
<?php } ?>
<?php if(in_array('disciplinary2',staff_role_resource()) || $user_info['user_type'] == 'company') { ?>
 
<?php } ?>
<div class="card user-profile-list">
  <div class="card-header">
    <h5>
      <?= lang('Main.xin_list_all');?>
      <?= lang('Dashboard.left_cases');?>
    </h5>
    <?php if(in_array('disciplinary2',staff_role_resource()) || $user_info['user_type'] == 'company') { ?>
  
    <?php } ?>
  </div>
  <div class="card-body">
    <div class="box-datatable table-responsive">
      <table class="datatables-demo table table-striped table-bordered" id="xin_table">
        <thead>
          <tr>
            <th><i class="fa fa-user"></i>
              <?= lang('Dashboard.dashboard_employee');?></th>
            <th><?= lang('Employees.xin_case_type');?></th>
            <th><i class="fa fa-calendar"></i>
              <?= lang('Employees.xin_case_date');?></th>
            <th><i class="fa fa-calendar"></i>
              <?= lang('Employees.xin_case_date_to');?></th>
            <th><?= lang('Main.xin_subject');?></th>
            <th><i class="fa fa-user"></i>
              <?= lang('Employees.xin_case_by');?></th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>
<script type="text/javascript">
  $( document ).ready(function() { 
      $('#cobaan').change(function(){
        var tgl=$('#cobaan').val();
        var date = new Date(tgl);
        date.setDate(date.getDate() + 7); 
        var bulan= (date.getMonth()+1); 
        var tgl=date.getFullYear()+'-'+bulan+'-'+date.getDate(); 
        $('#warning_date_to').val(tgl);
      });
  });
</script>