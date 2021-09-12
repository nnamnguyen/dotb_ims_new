<?php

if (!defined('dotbEntry') || !dotbEntry) die('Not A Valid Entry Point');

class logicVoucher {
    function handleSaveVoucher(&$bean, $event, $arguments){
        $bean->team_id = '1';
        $bean->team_set_id = $bean->team_id;
        if($_POST['module'] == 'Import' && empty($bean->name)){
            for($i = 0; $i <= 10; $i++){
                $vouName    = strtoupper(create_guid_section(6));
                $countDup   = $GLOBALS['db']->getOne("SELECT count(id) FROM j_voucher WHERE name = '$vouName' AND deleted = 0");
                if($countDup == 0) break;
            }
            $bean->name  = strtoupper($vouName);
        }
    }
}

