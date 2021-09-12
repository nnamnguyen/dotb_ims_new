<?php


class EmployeesStudioModule extends StudioModule {
    function getProvidedSubpanels ()
    {
        // Much like pointy haired bosses, other modules should not be able to relate to Employees.
        return false;
    }

    function getModule ()
    {
        $normalModules = parent::getModule();
        
        if(isset($normalModules[translate('LBL_RELATIONSHIPS')])) {
            unset($normalModules[translate('LBL_RELATIONSHIPS')]);
        }

        return $normalModules;
    }

}