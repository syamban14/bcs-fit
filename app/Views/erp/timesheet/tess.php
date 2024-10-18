<?php
use App\Models\MainModel;
use App\Models\UsersModel;
use App\Models\TimesheetAvailableModel;

$MainModel = new MainModel();
$UsersModel = new UsersModel();
$TimesheetAvailableModel = new TimesheetAvailableModel();

$session = \Config\Services::session();
$usession = $session->get('sup_username');
$router = service('router'); 
 
?> 
<div class="card user-profile-list">
  <div id="accordion">
    <div class="card-header">
      <h5>DATA AVAILABLE DRIVER
      </h5>
    </div>
  </div>
  <div class="card-body">
    <div class="box-datatable table-responsive">
      <table class="datatables-demo table table-striped table-bordered" id="xin_table">
        <thead>
            <tr>
                <th style="width:100px;"><?= lang('Main.xin_e_details_date');?></th>
                <th style="width:120px;"><?= lang('Dashboard.dashboard_employee');?></th>
                <th style="width:100px;"><?= lang('Main.dashboard_xin_status');?></th> 
                <th style="width:100px;"><?= lang('Attendance.dashboard_clock_out');?></th>   
                <th style="width:100px;"><?= lang('Attendance.dashboard_total_rest');?></th> 
                <th style="width:100px;">Kompetensi Driver</th> 
            </tr> 
        </thead>
      </table>
    </div>
  </div>
</div>