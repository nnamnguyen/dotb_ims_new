<?php
require_once("custom/clients/mobile/api/MobileApi.php");

$mb = new MobileApi();
$api = new RestService();

//    $param = array('user_name' => 'admin', 'password' => 'ad@dotb###');


echo 1;

//$param = array('user_name' => 'org1_admin', 'password' => 'crm@123');
//$param = array('user_name' => 'test', 'password' => 'ad@dotb###');
//$mb->user_login($api, $param);

//$param = array('value' => 'fix loi',' feedback_id' => '9d79902e-17d6-11ea-a2dc-d07e35de7ff1');
//$mb->save_comment($api, $param);

//$param = array(
//    'module_name' => 'Meetings',
//    'name' => 'create_record nhat new test',
////    'date_start' => '2019-11-30T16:00:00+07:00',
////    'date_end' => '2019-11-30T16:00:00+07:00',
//    'date_start' => '2019-07-04 16:00:00',
//    'date_end' => '2019-07-30 16:00:00',
//    'repeat_type' => 'Weekly',
//    'repeat_interval' => '1',
//    'repeat_dow' => '16',
//    'repeat_end_type' => 'Until',
//    'repeat_until' => '2019-07-12',
//    'reminder_time' => '1800',
//    'email_reminder_time' => '300',
//    'location' => 'cafe',
//    'description' => 'abc',
//    'type' => 'Dotb',
//    'parent_type' => 'Contacts',
//    'parent_id' => '9c58171c-bd9c-11ea-a981-d07e35de7ff1',
//    'app_reminder_sent' => '1',
//    'assigned_user_id' => '4764ea14-36b6-11e9-9343-00e04c360044',
//);
//$mb->create_record($api, $param);

//$param = array(
//    'id' => 'f77095c0-bdce-11ea-a707-d07e35de7ff1',
//    'module_name' => 'Meetings',
//    'name' => 'create_record nhat edit test',
//    'date_start' => '2019-12-11 04:24:16',
//    'date_end' => '2019-12-12 04:24:16',
//    'reminder_time' => '1800',
//    'email_reminder_time' => '300',
//    'location' => 'cafe edit',
//    'description' => 'abc edit',
//    'type' => 'Dotb',
//    'parent_type' => 'Contacts',
//    'parent_id' => '9c58171c-bd9c-11ea-a981-d07e35de7ff1',
//    'mark_favorite' => true,
//    'assigned_user_id' => '4764ea14-36b6-11e9-9343-00e04c360044',
//);
//$mb->create_record($api, $param);


//$picture =  readfile("base64.txt", "custom/modules/Accounts/base64.txt");

//$param = array(
//    'id' => 'bce64c22-bdd0-11ea-ab4c-d07e35de7ff1',
//    'module_name' => 'Contacts',
//    'first_name' => 'Lap',
//    'last_name' => 'Nguyen',
//    'title' => 'giam doc',
//    'phone_mobile' => '012345',
//    'department' => 'phong kinh doanh',
//    'birthdate' => '1998-10-09',
//    'email1' => 'vanvo@gmail.com',
//    'primary_address_street' => '120/98/8 Thích Quảng Đức, Phường 5, Phú Nhuận, Hồ Chí Minh, Vietnam',
//    'primary_address_city' => 'Hồ Chí Minh',
//    'primary_address_state' => 'Phú Nhuận',
//    'primary_address_postalcode' => 'Phường 5',
//    'primary_address_country' => 'Vietnam',
//    'alt_latitude' => 10.809373900000,
//    'alt_longitude' => 106.681569500000,
//    'account_id' => '16e92f80-36b6-11e9-b08f-00e04c360044',
//    'assigned_user_id' => '4764ea14-36b6-11e9-9343-00e04c360044',
//    'picture' => 'data:image/png;base64,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',
//    'mark_favorite' => true,
//);
//$mb->create_record($api, $param);


//$param = array(
//    'id' => '4912b270-bdd2-11ea-a44f-d07e35de7ff1',
//    'module_name' => 'Accounts',
//    'name' => 'Công ty Dotb',
//    'website' => 'http://dotb.vn',
//    'industry' => 'Construction',
//    'phone_office' => '012345',
//    'email1' => 'dotb@gmail.com',
//    'billing_address_street' => '120/98/8 Thích Quảng Đức, Phường 5, Phú Nhuận, Hồ Chí Minh, Vietnam',
//    'billing_address_city' => 'Hồ Chí Minh',
//    'billing_address_state' => 'Phú Nhuận',
//    'billing_address_postalcode' => 'Phường 5',
//    'billing_address_country' => 'Vietnam',
//    'billing_latitude' => 10.809373900000,
//    'billing_longitude' => 106.681569500000,
//    'description' => 'công ty phần mềm',
//    'assigned_user_id' => '1',
//    'picture' => 'data:image/png;base64,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',
//    'mark_favorite' => 'false',
//);
//$mb->create_record($api, $param);

//$param = array(
//    'id' => '38369a88-bdd3-11ea-8f22-d07e35de7ff1',
//    'module_name' => 'Calls',
//    'name' => 'nhat abc',
//    'parent_type' => 'Contacts',
//    'parent_id' => 'bce64c22-bdd0-11ea-ab4c-d07e35de7ff1',
//    'date_start' => '2019-11-22 09:10:00',
//    'mark_favorite' => 'true',
//    'call_result' => 'Interested',
//    'recall' => '900',
//    'move_trash' => 'true',
//    'description' => 'nhật test',
//    'direction' => 'Outbound',
//    'status' => 'Planned',
//    'call_source' => '0123456',
//    'call_destination' => '012346786',
//    'call_entrysource' => 'mobile',
//    'call_duration' => '60',
//    'call_purpose' => 'Prospecting',
//    'reminder_time' => '60',
//    'email_reminder_time' => '60',
//    'call_recording' => '',
//    'app_reminder_sent' => '1',
//    'assigned_user_id' => '1',
//);
//$mb->create_record($api, $param);





//$param = array(
//    'reportId'=>'bca64b96-3699-11e9-954e-00e04c360044',
//);
//$mb->create_report($api, $param);

//    'record'=>'9e751950-1716-11ea-8d29-02170a961336',
//    'module'=>'Reports',



//$param = array(
//    'id' => 'af19a36a-bdd4-11ea-b00d-d07e35de7ff1',
//    'module_name' => 'Tasks',
//    'name' => 'tasks abc',
//    'parent_type' => 'Contacts',
//    'parent_id' => 'bce64c22-bdd0-11ea-ab4c-d07e35de7ff1',
//    'date_start' => '2019-11-22 09:10:00',
//    'date_due' => '2019-11-23 09:10:00',
//    'task_duration' => '300',
//    'remind_popup' => '60',
//    'remind_email' => '60',
//    'priority' => 'High',
//    'description' => 'abc',
//    'mark_favorite' => 'true',
//    'app_reminder_sent'=> '0',
//    'assigned_user_id' => '1',
//);
//$mb->create_record($api, $param);

//$param = array(
//    'module_name' => 'Cases',
//    'id' => '05757fc0-bdd7-11ea-a499-d07e35de7ff1',
//    'name' => 'Cases nhat test',
//    'account_id' => '16e92f80-36b6-11e9-b08f-00e04c360044',
//    'type' => 'User',
//    'source' => 'Internal',
//    'status' => 'Openning',
//    'assigned_user_id' => '1',
//    'description' => 'abc', // bị dính mặc định Invalid date
//    'mark_favorite' => 'true',
//);
//$mb->create_record($api, $param);

//$param = array(
//    'module_name' => 'Notes',
//    'id' => 'c2ce0064-bdd8-11ea-9cf3-d07e35de7ff1',
//    'name' => 'note test nhat',
//    'parent_type' => 'Accounts',
//    'parent_id' => '16e92f80-36b6-11e9-b08f-00e04c360044',
//    'contact_id' => 'bce64c22-bdd0-11ea-ab4c-d07e35de7ff1',
//    'description' => 'abc',
//    'assigned_user_id' => '1',
//    'mark_favorite' => 'true',
//);
//$mb->create_record($api, $param);

//$param = array(
//    'module_name' => 'Opportunities',
//    'id' => 'c200c94a-bdd9-11ea-8c5b-d07e35de7ff1',
//    'name' => '1 ti',
//    'account_id' => '16e92f80-36b6-11e9-b08f-00e04c360044',
//    'date_closed' => '2020-07-04',
//    'amount' => '1000000000',
//    'best_case' => '1000000000',
//    'worst_case' => '1000000000',
//    'sales_stage' => 'Prospecting',
////    'probability' => '10',
//    'opportunity_type' => 'Existing Business',
//    'lead_source' => 'Web Site',
//    'description' => 'ABCD',
//    'assigned_user_id' => '1',
//    'mark_favorite' => 'true',
//);
//$mb->create_record($api, $param);

//$param = array(
//    'user_id' => '4764ea14-36b6-11e9-9343-00e04c360044',
//    'token' => 'c6d495c9-bb25-81d2-5f81-533ef6479f9b',
//    'method' => 'add',
//);
//$mb->post_token($api, $param);

//$param = array(
//    'module_name' => 'Users',
//    'id' => '4764ea14-36b6-11e9-9343-00e04c360044',
//    'user_name' => 'test',
//    'last_name' => 'test',
//    'reminder_time_default' => '1 minutes',
//    'dateformat' => 'd/m/Y',
//    'timeformat' => 'H:i',
//    'nameformat' => 's f l',//s f l
//    'preferred_language'   => 'vn_vn',
//    'picture' => 'data:image/png;base64,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',
//);
//$mb->create_record($api, $param);

//$param = array(
//    'user_name' => 'nhat_test1',
//    'first_name' => 'Test2',
//    'last_name' => 'Nhat2',
//    'phone_mobile' => '01234456',
//    'password' => 'nhat',
//    'name' => 'team_test',
//    'code_prefix' => 'test',
//);
//$mb->user_regis($api, $param);

//hiện tại chưa cần
//$param = array(
//    'module_name' => 'Teams',
//    'id' => '7f26d604-459a-11e9-9536-1c4d7023ffd7',
//    'balance' => '1000000',
//);
//$mb->create_record($api, $param);

//hiện tại chưa cần
//$param = array(
//    'module_name' => 'M_Payments',
//    'id' => 'e267cd48-4a4b-11ea-91cf-d07e35de7ff1',
//    'name' => 'thu cho 1 tháng 2/2020',
//    'amount' => '1000000',
//    'description' => 'thu tháng 2/2020 bởi xyz',
//    'assigned_user_id' => '8e22a248-06b8-11ea-8bcc-02170a961336',
//);
//$mb->create_record($api, $param);