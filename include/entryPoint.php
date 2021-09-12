<?php


use Dotbcrm\Dotbcrm\Security\InputValidation\InputValidation;

/**
 * Known Entry Points as of 4.5
 * acceptDecline.php
 * campaign_tracker.php
 * campaign_trackerv2.php
 * cron.php
 * dictionary.php
 * download.php
 * emailmandelivery.php
 * export_dataset.php
 * export.php
 * image.php
 * index.php
 * install.php
 * json.php
 * json_server.php
 * leadCapture.php
 * maintenance.php
 * metagen.php
 * pdf.php
 * phprint.php
 * process_queue.php
 * process_workflow.php
 * removeme.php
 * schedulers.php
 * soap.php
 * su.php
 * dotb_version.php
 * TreeData.php
 * tree_level.php
 * tree.php
 * vcal_server.php
 * vCard.php
 * zipatcher.php
 * WebToLeadCapture.php
 * HandleAjaxCall.php */

 /*
  * for 50, added:
  * minify.php
  */

  /*
  * for 510, added:
  * dceActionCleanup.php
  */

$GLOBALS['starttTime'] = microtime(true);

if (!defined('DOTB_BASE_DIR')) {
    define('DOTB_BASE_DIR', str_replace('\\', '/', realpath(dirname(__FILE__) . '/..')));
}

if (!defined('SHADOW_INSTANCE_DIR') && extension_loaded('shadow') && ini_get('shadow.enabled')) {
    $shadowConfig = shadow_get_config();
    if ($shadowConfig['instance']) {
        define('SHADOW_INSTANCE_DIR', $shadowConfig['instance']);
    }
}

set_include_path(
    DOTB_BASE_DIR . PATH_SEPARATOR .
    DOTB_BASE_DIR . '/vendor' . PATH_SEPARATOR .
    get_include_path()
);

if(empty($GLOBALS['installing']) && !file_exists('config.php'))
{
	header('Location: install.php');
	exit ();
}

// config|_override.php
if(is_file('config.php')) {
    require_once('config.php'); // provides $dotb_config
}

// load up the config_override.php file.  This is used to provide default user settings
if(is_file('config_override.php')) {
    require 'config_override.php';
}


if(empty($GLOBALS['installing']) &&empty($dotb_config['dbconfig']['db_name']))
{
	    header('Location: install.php');
	    exit ();
}

require_once('include/utils.php');
require_once 'include/dir_inc.php';

require_once 'include/utils/array_utils.php';
require_once 'include/utils/file_utils.php';
require_once 'include/utils/security_utils.php';
require_once 'include/utils/logic_utils.php';
require_once 'include/utils/dotb_file_utils.php';
require_once 'include/utils/mvc_utils.php';
require_once 'include/utils/db_utils.php';
require_once 'include/utils/encryption_utils.php';

require_once 'include/DotbCache/DotbCache.php';
require_once 'include/utils/autoloader.php';
DotbAutoLoader::init();

if (empty($GLOBALS['installing'])) {
    $GLOBALS['log'] = LoggerManager::getLogger('DotBCRM');
}

if (!empty($dotb_config['xhprof_config'])) {
    DotbXHprof::getInstance()->start();
}

register_shutdown_function('dotb_cleanup');


// cn: set php.ini settings at entry points
setPhpIniSettings();

require_once('dotb_version.php'); // provides $dotb_version, $dotb_db_version, $dotb_flavor

// Initialize InputValdation service as soon as possible. Up to this point
// it is expected that no code has altered any input superglobals.
InputValidation::initService();

// Check to see if custom utils exist and load them too
// not doing it in utils since autoloader is not loaded there yet
foreach (DotbAutoLoader::existing('include/custom_utils.php', 'custom/include/custom_utils.php', DotbAutoLoader::loadExtension('utils')) as $file) {
    require_once $file;
}

require_once('include/modules.php'); // provides $moduleList, $beanList, $beanFiles, $modInvisList, $adminOnlyList, $modInvisListActivities
require_once('modules/Administration/updater_utils.php');
require_once 'modules/Currencies/Currency.php';

UploadStream::register();

///////////////////////////////////////////////////////////////////////////////
////    Handle loading and instantiation of various Dotb* class
if (!defined('DOTB_PATH')) {
    define('DOTB_PATH', realpath(dirname(__FILE__) . '/..'));
}
if(empty($GLOBALS['installing'])){
///////////////////////////////////////////////////////////////////////////////
////	SETTING DEFAULT VAR VALUES
$error_notice = '';
$use_current_user_login = false;

    LogicHook::initialize()->call_custom_logic('', 'entry_point_variables_setting');

if(!empty($dotb_config['session_dir'])) {
	session_save_path($dotb_config['session_dir']);
}

if (class_exists('SessionHandler')) {
    session_set_save_handler(new DotbSessionHandler());
}

$GLOBALS['dotb_version'] = $dotb_version;
$GLOBALS['dotb_flavor'] = $dotb_flavor;
$GLOBALS['js_version_key'] = get_js_version_key();
    // Because this line is *supposed* to be indented...
    $GLOBALS['dotb_mar_version'] = $dotb_mar_version;

DotbApplication::preLoadLanguages();

$timedate = TimeDate::getInstance();
$GLOBALS['timedate'] = $timedate;

$db = DBManagerFactory::getInstance();
$db->resetQueryCount();
$locale = Localization::getObject();

// Emails uses the REQUEST_URI later to construct dynamic URLs.
// IIS does not pass this field to prevent an error, if it is not set, we will assign it to ''.
if (!isset ($_SERVER['REQUEST_URI'])) {
	$_SERVER['REQUEST_URI'] = '';
}

$current_user = BeanFactory::newBean('Users');
$current_entity = null;
$system_config = Administration::getSettings();

    if (!$GLOBALS['dotb_config']['activity_streams_enabled']) {
        Activity::disable();
    }

LogicHook::initialize()->call_custom_logic('', 'after_entry_point');
}


////	END SETTING DEFAULT VAR VALUES
///////////////////////////////////////////////////////////////////////////////
