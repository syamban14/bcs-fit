<?php
use App\Models\SystemModel;
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\LanguageModel;

$SystemModel = new SystemModel();
$UserRolesModel = new RolesModel();
$UsersModel = new UsersModel();
$LanguageModel = new LanguageModel();

$session = \Config\Services::session();
$usession = $session->get('sup_username');
$request = \Config\Services::request();
$router = service('router');
$user = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
$locale = service('request')->getLocale();
$language = $LanguageModel->where('is_active', 1)->orderBy('language_id', 'ASC')->findAll();
if($user['user_type'] == 'super_user'){
	$xin_system = $SystemModel->where('setting_id', 1)->first();
} else {
	$xin_system = erp_company_settings();
}
$ci_erp_settings = $SystemModel->where('setting_id', 1)->first();
?>
<?php
$session_lang = $session->lang;
if(!empty($session_lang)):
	$lang_code = $LanguageModel->where('language_code', $session_lang)->first();
	$flg_icn = '<img src="'.base_url().'/public/uploads/languages_flag/'.$lang_code['language_flag'].'">';
	$lg_code = $session_lang;
elseif($xin_system['default_language']!=''):
	$lg_code = $xin_system['default_language'];
	$lang_code = $LanguageModel->where('language_code', $xin_system['default_language'])->first();
	$flg_icn = '<img src="'.base_url().'/public/uploads/languages_flag/'.$lang_code['language_flag'].'">';
else:
	$flg_icn = '<img src="'.base_url().'/public/uploads/languages_flag/gb.gif">';	
endif;
if($user['user_type'] == 'super_user'){
	$bg_option = 'bg-dark';
} else if($user['user_type'] == 'company'){
	$bg_option = 'bg-dark';
} else if($user['user_type'] == 'customer'){
	$bg_option = 'bg-dark';
} else {
	$bg_option = 'bg-success';
}
?>
<header class="pc-header <?= $bg_option;?>">
    <div class="header-wrapper">
       <?php if($user['user_type'] == 'super_user' || $user['user_type'] == 'company' || $user['user_type'] == 'customer' || $user['user_type'] == 'staff'){ ?>
        <div class="m-header d-flex align-items-center">
            <a href="<?= site_url('erp/desk');?>" class="b-brand">
                <img src="<?= base_url();?>/public/uploads/logo/<?= $ci_erp_settings['logo'];?>" alt="" class="logo logo-lg" height="40" width="138">
            </a>
        </div>
        <?php } ?>
        <div class="mr-auto pc-mob-drp">
            <ul class="list-unstyled">
                <?php if($user['user_type']!= 'customer' && $user['user_type']!= 'super_user'){ ?>
                <li class="pc-h-item">
                    <a class="pc-head-link active arrow-none mr-0" data-toggle="tooltip" data-placement="top" title="<?= lang('Main.xin_account_settings');?>" href="<?= site_url('erp/my-profile');?>">
                        <i data-feather="user-check"></i>
                    </a>
                </li> 
               
                <?php if(in_array('system_calendar',staff_role_resource()) || $user['user_type']== 'company') {?>
                
                <?php } ?>
				<?php if(in_array('system_reports',staff_role_resource()) || $user['user_type']== 'company') {?>
               
                <?php } ?>
                <?php if(in_array('settings1',staff_role_resource()) || $user['user_type']== 'company') {?>
               
                <?php } ?>
				<?php } if($user['user_type']== 'customer') {?>
                <li class="pc-h-item">
                    <a class="pc-head-link active arrow-none mr-0" data-toggle="tooltip" data-placement="top" title="<?= lang('Dashboard.xin_acc_calendar');?>" href="<?= site_url('erp/my-invoices-calendar');?>">
                        <i data-feather="calendar"></i>
                    </a>
                </li>    
                <?php } if($user['user_type']== 'super_user') {?>
                <li class="pc-h-item">
                    <a class="pc-head-link active arrow-none mr-0" data-toggle="tooltip" data-placement="top" title="<?= lang('Dashboard.xin_my_account');?>" href="<?= site_url('erp/my-profile');?>">
                        <i data-feather="user"></i>
                    </a>
                </li>    
                <li class="pc-h-item">
                    <a class="pc-head-link active arrow-none mr-0" data-toggle="tooltip" data-placement="top" title="<?= lang('Main.xin_frontend_landing');?>" href="<?= site_url('');?>" target="_blank">
                        <i data-feather="layout"></i>
                    </a>
                </li>
                <?php } ?>
            </ul>
        </div>
        <div class="ml-auto">
            <ul class="list-unstyled">
                <li class="dropdown pc-h-item">
                    <a class="pc-head-link dropdown-toggle arrow-none mr-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <?= $flg_icn;?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right pc-h-dropdown">
                        <?php foreach($language as $lang):?>
                        <a href="<?= site_url('erp/set-language/');?><?= $lang['language_code'];?>" class="dropdown-item">
                            <img src="<?= base_url();?>/public/uploads/languages_flag/<?= $lang['language_flag'];?>" width="16" height="11" />
                            <span><?= $lang['language_name'];?></span>
                        </a>
                        <?php endforeach;?>
                    </div>
                </li>
                <?php if(in_array('todo_ist',staff_role_resource()) || $user['user_type']== 'company' || $user['user_type']== 'customer' || $user['user_type']== 'super_user') {?>
                <li class="pc-h-item">
                    <a class="pc-head-link mr-0" data-toggle="tooltip" data-placement="top" title="<?= lang('Main.xin_todo_ist');?>" href="<?= site_url('erp/todo-list');?>">
                        <i data-feather="check-circle"></i>
                        <span class="sr-only"></span>
                    </a>
                </li>
                <?php }?>
                <li class="dropdown pc-h-item">
                    <a class="pc-head-link dropdown-toggle arrow-none mr-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="<?= staff_profile_photo($user['user_id']);?>" alt="" class="user-avtar">
                        <span>
                            <span class="user-name"><?= $user['first_name'].' '.$user['last_name'];?></span>
                            <span class="user-desc"><?= $user['username']?></span>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right pc-h-dropdown">
                        <div class=" dropdown-header">
                            <h6 class="text-overflow m-0"><?= lang('Dashboard.xin_welcome');?></h6>
                        </div>
                        <a href="<?= site_url('erp/my-profile');?>" class="dropdown-item">
                            <i data-feather="user"></i>
                            <span><?= lang('Dashboard.xin_my_account');?></span>
                        </a>
                        <a href="<?= site_url('erp/system-logout')?>" class="dropdown-item">
                            <i data-feather="power"></i>
                            <span><?= lang('Main.xin_logout');?></span>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</header>