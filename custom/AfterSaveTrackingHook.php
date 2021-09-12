<?php

/**
 * Your installation or use of this DotBCRM file is subject to the applicable
 * terms available at
 * http://support.dotbcrm.com/06_Customer_Center/10_Master_Subscription_Agreements/.
 * If you do not agree to all of the applicable terms or do not have the
 * authority to bind the entity as an authorized representative, then do not
 * install or use this DotBCRM file.
 *
 * Copyright (C) DotBCRM Inc. All rights reserved.
 *
 * @package FTE_Tracking
 */

require_once "custom/FTETracking.php";

class AfterSaveTrackingHook
{
    private $blackList = ['fte_UsageTracking', 'OutboundEmail']; //used to restrict tracking

    private $extraModules = ["Dashboards"]; //used to add extra modules to the tracking

    public function logAction($bean, $event, $arguments)
    {
        if (!$this->isSafeToContinue($event, $bean)) {
            return false;
        }
        global $service;

        $platform = "Desktop";

        if (isset($service->platform) && $service->platform != "base") {
            $platform = $service->platform;
        } else if (isset($_REQUEST["platform"]) && $_REQUEST["platform"] != "base") {
            $platform = $_REQUEST["platform"];
        }

        $args = [
            "action" => $this->getAction($bean->module_name, $event, $arguments),
            "action_identifier" => $this->getActionIdentifier($this->getAction($bean->module_name, $event, $arguments), $bean->module_name),
            "parent_id" => $bean->id,
            "parent_type" => $bean->module_name,
            "parent_name" => $bean->name,
            "platform" => ucfirst($platform)
        ];

        FTETracking::logAction($args);
    }

    private function isSafeToContinue($event, $bean)
    {

        $modules = array_merge($this->extraModules, $GLOBALS['moduleList']);

        if ($event == "after_login" && $bean->module_name == "Users") {
            return true;
        }

        if ($event == "after_logout" && $bean->module_name == "Users") {
            return true;
        }

        if ((!in_array($bean->module_name, $modules) || in_array($bean->module_name, $this->blackList))) {
            return false;
        }

        return true;
    }

    private function getAction($module, $event, $arguments)
    {
        $action = "Create";

        if (isset($arguments["isUpdate"]) && $arguments["isUpdate"] == true) {
            $action = "Update";

            if ($module === "Leads") {
                if ((array_key_exists("converted", $arguments['dataChanges']) && $arguments["dataChanges"]['converted']['after'] == true)) {
                    $action = "Convert";
                }
            }
        }

        if ($event == "after_delete") {
            $action = "Delete";
        }

        if ($event == "after_login") {
            $action = "Login";
        }

        if ($event == "after_logout") {
            $action = "Logout";
        }

        return $action;
    }

    private function getActionIdentifier($action, $module)
    {
        return strtolower($action . "_" . $GLOBALS['app_list_strings']['moduleListSingular'][$module]);
    }
}