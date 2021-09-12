<?php


/**
 * Adds visibility for owner or admin only.
 */
class OwnerOrAdminVisibility extends OwnerVisibility
{
    /**
     * Allow admins to view all records, even if they are not the owner.
     * (non-PHPdoc)
     * @see DotbVisibility::addVisibilityWhere()
     */
    public function addVisibilityWhere(&$query)
    {
        global $current_user;
        $module =  $this->bean->module_name;
        if($current_user->isAdminForModule($module)) {
            return $query;
        }

        return parent::addVisibilityWhere($query);
    }
}
