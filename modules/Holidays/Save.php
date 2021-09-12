<?php



    require_once('include/formbase.php');

    $focus = BeanFactory::newBean('Holidays');
    global $current_user;

    $focus->disable_row_level_security = true;
    if(!empty($_POST['record']))
        $focus->retrieve($_POST['record']);

    $focus = populateFromPost('', $focus);

    if ($focus->id != $_REQUEST['relate_id']) {
        if ($_REQUEST['return_module'] != 'Project') {
            $focus->person_id = $_REQUEST['relate_id'];
            $focus->person_type = "Users";
        } elseif ($_REQUEST['return_module'] == 'Project') {
            $focus->related_module = 'Project';
            $focus->related_module_id = $_REQUEST['relate_id'];
        }
    }

    if (!$focus->id && !empty($_REQUEST['duplicateId'])) {
        $original_focus = BeanFactory::newBean('Holidays');
        $original_focus->retrieve($_REQUEST['duplicateId']);

        $focus->person_id = $original_focus->person_id;
        $focus->person_type = $original_focus->person_type;
        $focus->related_module = $original_focus->related_module;
        $focus->related_module_id = $original_focus->related_module_id;
    }

    $check_notify = FALSE;

    //custom save range of Holiday - Lap Nguyen
    if($focus->type != 'Public Holiday'){
        $pos = stripos($focus->holidays_range, 'to');
        if ($pos !== false){
            global $timedate;
            $arr = explode(' to ',$focus->holidays_range);
            $start = strtotime($timedate->to_db_date($arr[0],false));
            $end = strtotime($timedate->to_db_date($arr[1],false));

            $days = array();
            $i = 0;
            while($start <= $end){
                $hl = new Holiday();
                $hl->holiday_date = date('Y-m-d',$start);
                $hl->description = $focus->description;
                $hl->type = $focus->type;
                $hl->apply_for = '';
                $hl->person_type = $_POST['return_module'];
                $hl->person_id = $_POST['relate_id'];
                $existing = $GLOBALS['db']->getOne("SELECT id FROM holidays WHERE person_type = '{$_POST['return_module']}' AND person_id = '{$_POST['relate_id']}' AND holiday_date = '{$hl->holiday_date}'");
                if(!$existing)
                    $hl->save();
                $start = strtotime('+1 day', $start);
            }
            $focus->deleted = 1;
            $focus->apply_for = '';
        }
    }else{
        if($_POST['module'] == 'Holidays' && $_POST['action'] == 'Save'){
            $holi_list = explode(',',$focus->public_holiday);
            foreach($holi_list as $holiday_date){
                //edit function save by Lap Nguyen
                $existing = $GLOBALS['db']->getOne("SELECT id FROM holidays WHERE holiday_date = '{$holiday_date}' AND deleted=0 AND type='Public Holiday' and aplly_for = '{$focus->type}'");
                if(!empty($existing))
                    $hl = BeanFactory::getBean("Holidays", $existing);
                else
                    $hl = new Holiday();
                $hl->holiday_date = $holiday_date;
                $hl->description = $focus->description;
                $hl->apply_for = $focus->apply_for;
                $hl->type = $focus->type;
                $hl->save();
            }
            $focus->deleted = 1;
            DotbApplication::redirect("index.php?action=ListView&module=Holidays&record=&return_module=Holidays");
        }else
            $focus->apply_for = '';

    }
    //Custom Save range of holiday

    $focus->save($check_notify);
    $return_id = $focus->id;

    if(isset($_POST['return_module']) && $_POST['return_module'] != "") $return_module = $_POST['return_module'];
    else $return_module = "Holidays";
    if(isset($_POST['return_action']) && $_POST['return_action'] != "") $return_action = $_POST['return_action'];
    else $return_action = "DetailView";
    if(isset($_POST['return_id']) && $_POST['return_id'] != "") $return_id = $_POST['return_id'];

    $GLOBALS['log']->debug("Saved record with id of ".$return_id);

    handleRedirect($return_id,'Holidays');
?>
