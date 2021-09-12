<?php

require_once 'data/DotbACLStrategy.php';


class DotbACLUsageTracking extends DotbACLStrategy
{

    private $actions = [
        "edit", "delete", "massupdate", "export", "share"
    ];


    /**
     * Only allow access to users with the user admin setting
     *
     * @param string $module
     * @param string $view
     * @param array $context
     * @return bool
     */
    public function checkAccess($module, $view, $context)
    {

        if(in_array($view, $this->actions)){
           return false;
        }

        return true;
    }
}
