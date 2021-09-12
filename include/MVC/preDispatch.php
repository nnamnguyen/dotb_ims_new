<?php
if(!defined('dotbEntry'))define('dotbEntry', true);


if (!defined('DOTB_BASE_DIR')) {
    define('DOTB_BASE_DIR', str_replace('\\', '/', realpath(dirname(__FILE__) . '/../..')));
}

/*
 * First step in removing getimage and getYUIComboFile -- at least this bypasses most of the app,
 * making assets load faster.
 */
if( isset($_GET["entryPoint"]) )
{
    require_once 'include/utils.php';
    require_once 'include/utils/autoloader.php';
    DotbAutoLoader::init();

    $GLOBALS['log'] = new DotbNullLogger();

    if ($_GET["entryPoint"] == "getImage") {
        DotbAutoLoader::requireWithCustom('include/DotbMetric/Helper.php');
        DotbMetric_Helper::run('image');

		include("include/DotbTheme/getImage.php");
		die();
	}
	else if($_GET["entryPoint"] == "getYUIComboFile")
    {
        DotbMetric_Helper::run('YUIComboFile');

		include("include/javascript/getYUIComboFile.php");
		die();
	}
}
