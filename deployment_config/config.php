<?php
// created: 2020-10-14 12:00:11
$dotb_config = array (
  'FCM_SERVER_KEY' => 'AAAAqS913F8:APA91bFyo0Iggm9zexufQEflyzhmXnlLCQyPM0SLO801PjfYPktbG_hcztWz9qqb5vAthGRZIiQivljqfmxYVFsRqzOf4KjgOvqztdnv_zIPvUSkHV5xw4f1RLX7CjGjXSv3Yh2HkgxO',
  'SAML_SLO' => '',
  'SAML_X509Cert' => '',
  'SAML_idp_entityId' => '',
  'SAML_issuer' => '',
  'SAML_loginurl' => '',
  'SAML_provisionUser' => 'on',
  'SAML_request_signing_method' => 'http://www.w3.org/2001/04/xmldsig-more#rsa-sha256',
  'activity_streams' =>
  array (
    'erasure_job_limit' => 5,
    'erasure_job_delay' => 0,
  ),
  'activity_streams_enabled' => false,
	'additional_js_config' => 
		array (
			'disableOmnibarTypeahead' => true,
			'quickedit_listview' => false,
			'customer_journey' => 
		array (
			'enabled_modules' => 'Home',
		),
	),
  'admin_access_control' => false,
  'admin_export_only' => false,
  'brand_name' => 'DotB',
  'cache_dir' => 'cache/',
  'cache_expire_timeout' => 600,
  'calculate_response_time' => true,
  'calendar' =>
  array (
    'default_view' => 'week',
    'show_calls_by_default' => true,
    'show_tasks_by_default' => true,
    'editview_width' => 990,
    'editview_height' => 465,
    'day_timestep' => 15,
    'week_timestep' => 30,
    'items_draggable' => true,
    'items_resizable' => true,
    'enable_repeat' => true,
    'max_repeat_count' => 1000,
  ),
  'chartEngine' => 'sucrose',
  'collapse_subpanels' => true,
  'common_ml_dir' => '',
  'create_default_user' => false,
  'cron' =>
  array (
    'max_cron_jobs' => 25,
    'max_cron_runtime' => 1800,
    'min_cron_interval' => 30,
  ),
  'currency' => '',
  'currency_create_in_preferred' => false,
  'dashlet_display_row_options' =>
  array (
    0 => '1',
    1 => '3',
    2 => '5',
    3 => '10',
  ),
  'date_formats' =>
  array (
    'Y-m-d' => '2010-12-23',
    'm-d-Y' => '12-23-2010',
    'd-m-Y' => '23-12-2010',
    'Y/m/d' => '2010/12/23',
    'm/d/Y' => '12/23/2010',
    'd/m/Y' => '23/12/2010',
    'Y.m.d' => '2010.12.23',
    'd.m.Y' => '23.12.2010',
    'm.d.Y' => '12.23.2010',
  ),
  'datef' => 'd/m/Y',
  'dbconfig' =>
  array (
    'db_host_name' => 'localhost',
    'db_host_instance' => 'SQLEXPRESS',
    'db_user_name' => 'root',
    'db_password' => '',
    'db_name' => 'new_ims_data',
    'db_type' => 'mysqli',
    'db_port' => '',
    'db_manager' => 'MysqliManager',
  ),
  'dbconfigoption' =>
  array (
    'persistent' => false,
    'autofree' => false,
    'debug' => 0,
    'ssl' => false,
    'collation' => 'utf8mb4_general_ci',
  ),
  'default_action' => 'index',
  'default_charset' => 'UTF-8',
  'default_currencies' =>
  array (
    'USD' =>
    array (
      'name' => 'US Dollars',
      'iso4217' => 'USD',
      'symbol' => '$',
    ),
    'VND' =>
    array (
      'name' => 'Vietnam Dong',
      'iso4217' => 'VND',
      'symbol' => '???',
    ),
    'AUD' =>
    array (
      'name' => 'Australian Dollars',
      'iso4217' => 'AUD',
      'symbol' => '$',
    ),
    'BRL' =>
    array (
      'name' => 'Brazilian Reais',
      'iso4217' => 'BRL',
      'symbol' => 'R$',
    ),
    'GBP' =>
    array (
      'name' => 'British Pounds',
      'iso4217' => 'GBP',
      'symbol' => '??',
    ),
    'CAD' =>
    array (
      'name' => 'Canadian Dollars',
      'iso4217' => 'CAD',
      'symbol' => '$',
    ),
    'CNY' =>
    array (
      'name' => 'Chinese Yuan',
      'iso4217' => 'CNY',
      'symbol' => '???',
    ),
    'EUR' =>
    array (
      'name' => 'Euro',
      'iso4217' => 'EUR',
      'symbol' => '???',
    ),
    'HKD' =>
    array (
      'name' => 'Hong Kong Dollars',
      'iso4217' => 'HKD',
      'symbol' => '$',
    ),
    'INR' =>
    array (
      'name' => 'Indian Rupees',
      'iso4217' => 'INR',
      'symbol' => '???',
    ),
    'KRW' =>
    array (
      'name' => 'Korean Won',
      'iso4217' => 'KRW',
      'symbol' => '???',
    ),
    'YEN' =>
    array (
      'name' => 'Japanese Yen',
      'iso4217' => 'JPY',
      'symbol' => '??',
    ),
    'MXM' =>
    array (
      'name' => 'Mexican Pesos',
      'iso4217' => 'MXM',
      'symbol' => '$',
    ),
    'SGD' =>
    array (
      'name' => 'Singaporean Dollars',
      'iso4217' => 'SGD',
      'symbol' => '$',
    ),
    'CHF' =>
    array (
      'name' => 'Swiss Franc',
      'iso4217' => 'CHF',
      'symbol' => 'SFr.',
    ),
    'THB' =>
    array (
      'name' => 'Thai Baht',
      'iso4217' => 'THB',
      'symbol' => '???',
    ),
  ),
  'default_currency_iso4217' => 'VND',
  'default_currency_name' => '?????ng',
  'default_currency_show_preferred' => false,
  'default_currency_significant_digits' => 0,
  'default_currency_symbol' => '',
  'default_date_format' => 'd/m/Y',
  'default_decimal_seperator' => '.',
  'default_email_charset' => 'UTF-8',
  'default_email_client' => 'dotb',
  'default_email_editor' => 'html',
  'default_export_charset' => 'UTF-8',
  'default_language' => 'en_us',
  'default_locale_name_format' => 'l f',
  'default_max_tabs' => '7',
  'default_module' => 'Home',
  'default_module_favicon' => false,
  'default_navigation_paradigm' => 'gm',
  'default_number_grouping_seperator' => ',',
  'default_password' => '',
  'default_permissions' =>
  array (
    'dir_mode' => 1528,
    'file_mode' => 432,
    'user' => 'cloud',
    'group' => 'cloud',
  ),
  'default_subpanel_links' => false,
  'default_subpanel_tabs' => true,
  'default_swap_last_viewed' => false,
  'default_swap_shortcuts' => false,
  'default_theme' => 'RacerX',
  'default_time_format' => 'h:i A',
  'default_user_is_admin' => false,
  'default_user_name' => '',
  'demoData' => 'no',
  'developerMode' => false,
  'diagnostic_file_max_lifetime' => 604800,
  'disable_convert_lead' => false,
  'disable_count_query' => true,
  'disable_export' => false,
  'disable_persistent_connections' => 'false',
  'disable_user_email_config' => false,
  'disable_vcr' => true,
  'display_email_template_variable_chooser' => false,
  'display_inbound_email_buttons' => false,
  'dotb_max_int' => 2147483647,
  'dotb_min_int' => -2147483648,
  'dotb_version' => '6.5.22',
  'dump_slow_queries' => false,
  'email_address_separator' => ',',
  'email_default_client' => 'dotb',
  'email_default_editor' => 'html',
  'email_mailer_timeout' => 10,
  'email_xss' => 'YToxMzp7czo2OiJhcHBsZXQiO3M6NjoiYXBwbGV0IjtzOjQ6ImJhc2UiO3M6NDoiYmFzZSI7czo1OiJlbWJlZCI7czo1OiJlbWJlZCI7czo0OiJmb3JtIjtzOjQ6ImZvcm0iO3M6NToiZnJhbWUiO3M6NToiZnJhbWUiO3M6ODoiZnJhbWVzZXQiO3M6ODoiZnJhbWVzZXQiO3M6NjoiaWZyYW1lIjtzOjY6ImlmcmFtZSI7czo2OiJpbXBvcnQiO3M6ODoiXD9pbXBvcnQiO3M6NToibGF5ZXIiO3M6NToibGF5ZXIiO3M6NDoibGluayI7czo0OiJsaW5rIjtzOjY6Im9iamVjdCI7czo2OiJvYmplY3QiO3M6MzoieG1wIjtzOjM6InhtcCI7czo2OiJzY3JpcHQiO3M6Njoic2NyaXB0Ijt9',
  'enable_action_menu' => false,
  'enable_mobile_redirect' => false,
  'export_delimiter' => ',',
  'export_excel_compatible' => false,
  'external_cache' =>
  array (
    'redis' =>
    array (
      'host' => 'dotb-redis',
    ),
  ),
  'external_cache_disabled' => true,
  'external_cache_disabled_apc' => true,
  'external_cache_disabled_db' => true,
  'external_cache_disabled_memcache' => true,
  'external_cache_disabled_memcached' => true,
  'external_cache_disabled_redis' => true,
  'external_cache_disabled_smash' => true,
  'external_cache_disabled_wincache' => true,
  'external_cache_disabled_zend' => true,
  'external_cache_force_backend' => 'redis',
  'full_text_engine' =>
  array (
    'Elastic' =>
    array (
      'host' => 'localhost',
      'port' => '9200',
    ),
  ),
  'hide_history_contacts_emails' =>
  array (
    'Cases' => false,
    'Accounts' => false,
    'Opportunities' => true,
  ),
  'hide_subpanels' => false,
  'hide_subpanels_on_login' => false,
  'history_max_viewed' => 50,
  'host_name' => 'localhost',
  'idm_mode' =>
  array (
    'enabled' => false,
  ),
  'import_max_execution_time' => 7200,
  'import_max_records_per_file' => 100,
  'import_max_records_total_limit' => '',
  'installer_locked' => true,
  'jobs' =>
  array (
    'min_retry_interval' => 30,
    'max_retries' => 5,
    'timeout' => 3600,
  ),
  'js_custom_version' => 1,
  'js_lang_version' => 151,
  'languages' =>
  array (
    'en_us' => 'English (US)',
    'vn_vn' => 'Ti???ng Vi???t',
  ),
  'large_scale_test' => false,
  'lead_conv_activity_opt' => 'donothing',
  'list_max_entries_per_page' => 20,
  'list_max_entries_per_subpanel' => '20',
  'lock_default_user_name' => false,
  'lock_homepage' => false,
  'lock_info' =>
  array (
    'enable' => true,
    'lock_date' => '01-00',
    'lock_back' => '',
    'except_lock_for_user_name' => '',
  ),
  'lock_subpanels' => true,
  'log_dir' => '.',
  'log_file' => 'dotbcrm.log',
  'log_memory_usage' => false,
  'logger' =>
  array (
    'level' => 'fatal',
    'file' =>
    array (
      'ext' => '.log',
      'name' => 'dotbcrm',
      'dateFormat' => '%c',
      'maxSize' => '10MB',
      'maxLogs' => 10,
      'suffix' => '',
    ),
  ),
  'marketing_extras_enabled' => true,
  'marketing_extras_url' => 'https://marketing.dotbcrm.com/content',
  'mass_actions' =>
  array (
  ),
  'max_aggregate_email_attachments_bytes' => 10000000,
  'max_dashlets_homepage' => '15',
  'max_record_fetch_size' => 100000,
  'max_record_link_fetch_size' => 100000,
  'merge_duplicates' =>
  array (
    'merge_relate_fetch_concurrency' => 2,
    'merge_relate_fetch_timeout' => 90000,
    'merge_relate_fetch_limit' => 20,
    'merge_relate_update_concurrency' => 4,
    'merge_relate_update_timeout' => 8000,
    'merge_relate_max_attempt' => 3,
  ),
  'name_formats' =>
  array (
    's f l' => 's f l',
    'f l' => 'f l',
    's l f' => 's l f',
    'l f' => 'l f',
    'l, f' => 'l, f',
    's l' => 's l',
    'l, s f' => 'l, s f',
    's l, f' => 's l, f',
    'l s f' => 'l s f',
    'l f s' => 'l f s',
  ),
  'new_email_addresses_opted_out' => false,
  'noPrivateTeamUpdate' => false,
  'oauth_token_expiry' => 0,
  'oauth_token_life' => 86400,
  'passwordsetting' =>
  array (
    'minpwdlength' => 6,
    'maxpwdlength' => '',
    'oneupper' => '0',
    'onelower' => '0',
    'onenumber' => '0',
    'onespecial' => '0',
    'SystemGeneratedPasswordON' => '0',
    'generatepasswordtmpl' => 'ecc01028-3699-11e9-b9b2-00e04c360044',
    'lostpasswordtmpl' => 'ecc64114-3699-11e9-a5b6-00e04c360044',
    'customregex' => '',
    'regexcomment' => '',
    'forgotpasswordON' => true,
    'linkexpiration' => true,
    'linkexpirationtime' => 24,
    'linkexpirationtype' => 60,
    'userexpiration' => '0',
    'userexpirationtime' => '',
    'userexpirationtype' => '1',
    'userexpirationlogin' => '',
    'systexpiration' => 1,
    'systexpirationtime' => 7,
    'systexpirationtype' => '1',
    'systexpirationlogin' => '',
    'lockoutexpiration' => '0',
    'lockoutexpirationtime' => '',
    'lockoutexpirationtype' => '1',
    'lockoutexpirationlogin' => '',
  ),
  'pdf_file_max_lifetime' => 86400,
  'pmse_settings_default' =>
  array (
    'logger_level' => 'critical',
    'error_number_of_cycles' => '10',
    'error_timeout' => '40',
  ),
  'portal_view' => 'single_user',
  'preview_edit' => false,
  'require_accounts' => true,
  'resource_management' =>
  array (
    'special_query_limit' => 0,
    'special_query_modules' =>
    array (
      0 => 'Reports',
      1 => 'Export',
      2 => 'Import',
      3 => 'Administration',
      4 => 'Sync',
    ),
    'default_limit' => 0,
  ),
  'roleBasedViews' => true,
  'rss_cache_time' => '10800',
  'save_query' => 'all',
  'search_wildcard_char' => '%',
  'search_wildcard_infront' => false,
  'session_dir' => '',
  'showDetailData' => true,
  'showThemePicker' => true,
  'show_download_tab' => false,
  'site_url' => 'http://localhost/dotb_ims_new',
  'slow_query_time_msec' => '100',
  'smtp_mailer_debug' => 0,
  'snip_url' => 'https://ease.dotbcrm.com/',
  'stack_trace_errors' => false,
  'team_based_acl' =>
  array (
    'enabled' => false,
    'enabled_modules' =>
    array (
    ),
  ),
  'time_formats' =>
  array (
    'H:i' => '23:00',
    'h:ia' => '11:00pm',
    'h:iA' => '11:00PM',
    'h:i a' => '11:00 pm',
    'h:i A' => '11:00 PM',
    'H.i' => '23.00',
    'h.ia' => '11.00pm',
    'h.iA' => '11.00PM',
    'h.i a' => '11.00 pm',
    'h.i A' => '11.00 PM',
  ),
  'timef' => 'H:i',
  'tmp_dir' => 'cache/xml/',
  'tmp_file_max_lifetime' => 86400,
  'tracker_max_display_length' => 30,
  'translation_string_prefix' => false,
  'unique_key' => 'uniquekeydotbdotbdotb',
  'upload_badext' =>
  array (
    0 => 'php',
    1 => 'php3',
    2 => 'php4',
    3 => 'php5',
    4 => 'pl',
    5 => 'cgi',
    6 => 'py',
    7 => 'asp',
    8 => 'cfm',
    9 => 'js',
    10 => 'vbs',
    11 => 'html',
    12 => 'htm',
  ),
  'upload_dir' => 'upload/',
  'upload_maxsize' => 30000000,
  'use_common_ml_dir' => false,
  'use_real_names' => true,
  'use_sprites' => true,
  'vcal_time' => '2',
  'verify_client_ip' => false,
  'wl_list_max_entries_per_page' => 10,
  'wl_list_max_entries_per_subpanel' => 3,
);