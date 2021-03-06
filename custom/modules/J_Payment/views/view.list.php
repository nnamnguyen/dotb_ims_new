<?php
if(!defined('dotbEntry') || !dotbEntry) die('Not A Valid Entry Point');

/*********************************************************************************
* By installing or using this file, you are confirming on behalf of the entity
* subscribed to the DotbCRM Inc. product ("Company") that Company is bound by
* the DotbCRM Inc. Master Subscription Agreement (“MSA”), which is viewable at:
* http://www.dotbcrm.com/master-subscription-agreement
*
* If Company is not bound by the MSA, then by installing or using this file
* you are agreeing unconditionally that Company will be bound by the MSA and
* certifying that you have authority to bind Company accordingly.
*
* Copyright (C) 2004-2013 DotbCRM Inc.  All rights reserved.
********************************************************************************/

require_once('include/MVC/View/views/view.list.php');
class J_PaymentViewList extends ViewList
{
    function nm_introductionViewList()
    {
        parent::ViewList();
    }
    function listViewPrepare() {
        $_REQUEST['orderBy'] = 'date_entered';
        $_REQUEST['sortOrder'] = 'DESC';
        parent::listViewPrepare();
    }
    public function preDisplay(){
        parent::preDisplay();
        # Hide Quick Edit Pencil
        $this->lv->quickViewLinks = false;
        $this->lv->showMassupdateFields = false;
        $this->lv->mergeduplicates = false;
        $this->lv->export = false;
        if (!is_admin($current_user))
            $this->lv->delete = false;
    }

}
?>
