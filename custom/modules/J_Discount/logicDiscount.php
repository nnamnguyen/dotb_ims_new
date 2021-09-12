<?php

if (!defined('dotbEntry') || !dotbEntry) die('Not A Valid Entry Point');

class logicDiscount {
    //before save
    function handleSaveDiscount(&$bean, $event, $arguments){
        if($_POST['module'] == $bean->module_name && $_POST['action'] == 'Save'){
            // save partnership
            if($_POST["type"]=="Partnership"){
                $sql = "UPDATE j_discount_j_partnership_1_c SET deleted=1, date_modified='{$GLOBALS['timedate']->nowDb()}' WHERE j_discount_j_partnership_1j_discount_ida='{$bean->id}'";
                $delete =  $GLOBALS['db']->query($sql);
                $bean->load_relationship('j_discount_j_partnership_1');
                $bean->j_discount_j_partnership_1->add(array_filter($_POST["pa_id"]));
            }

            // save "do not apply with" list
            $notApplyList = array();
            if(!empty($bean->fetched_row)){
                //delete before save
                $ff = json_decode(html_entity_decode($bean->fetched_row['disable_list']),true);
                foreach ($ff as $value){
                    $count_unset = 0;
                    $o_ff =  json_decode(html_entity_decode($GLOBALS['db']->getOne("SELECT disable_list FROM j_discount WHERE id = '$value' AND deleted = 0 AND status = 'Active'")),true);
                    if(!empty($o_ff)){
                        if (($key = array_search($bean->id, $o_ff)) !== false){
                            $count_unset++;
                            unset($o_ff[$key]);
                        }
                        if($count_unset > 0)
                            $GLOBALS['db']->query("UPDATE j_discount set disable_list = '".json_encode($o_ff)."' WHERE id = '$value' AND deleted = 0");
                    }
                }
            }

            foreach ($_POST['check_schema'] as $value){
                if(!in_array($value, $notApplyList)){
                    $notApplyList[] = $value;
                    $o_ff =  json_decode(html_entity_decode($GLOBALS['db']->getOne("SELECT disable_list FROM j_discount WHERE id = '$value' AND deleted = 0 AND status = 'Active'")),true);
                    if (!in_array($bean->id, $o_ff))
                        $o_ff[] = $bean->id;
                    $GLOBALS['db']->query("UPDATE j_discount set disable_list = '".json_encode($o_ff)."' WHERE id = '$value' AND deleted = 0");
                }
            }
            $bean->disable_list = json_encode($notApplyList);

            if($bean->type == 'Partnership' ||$bean->type == 'Reward')
                $bean->order_no = 99;
            if($bean->type == 'Hour'){
                $bean->order_no = 1;
                $discount_by_hour = array();
                foreach ($_POST['promotion_hours'] as $index => $value){
                    if(!empty($value)){
                        $discount_by_hour[$index]['hours']            = $_POST['hours'][$index];
                        $discount_by_hour[$index]['promotion_hours']  = $value;
                    }
                }
                $discount_by_range = array();
                foreach ($_POST['block'] as $index => $value){
                    if(!empty($value)){
                        $discount_by_range[$index]['start_hour']    = $_POST['start_hour'][$index];
                        $discount_by_range[$index]['to_hour']       = $_POST['to_hour'][$index];
                        $discount_by_range[$index]['block']         = $value;
                    }
                }
                $discount_hour_range = array(
                    'discount_by_hour' => $discount_by_hour,
                    'discount_by_range' => $discount_by_range,
                );
                $bean->content = json_encode($discount_hour_range);
            }

            if(empty($bean->order_no)) $bean->order_no = 1;
        }
        $_POST['team_set_id']   = $bean->fetched_row['team_set_id'];
    }
    //after save
    function addTeam(&$bean, $event, $arguments){
        //Check MassUpdate by Lumia
        if(!empty($_REQUEST['__dotb_url'])){
            $post = explode("/",$_REQUEST['__dotb_url']);
            $_POST['module'] = $post[1];
            $_POST['action'] = $post[2];
        }
        if($_POST['module'] == $bean->module_name && ($_POST['action'] == 'Save' || $_POST['action'] == 'MassUpdate')){
            if($_POST['team_set_id'] != $bean->team_set_id){
                $team_list = array();
                //            if(empty($bean->fetched_row) || ($bean->fetched_row['team_set_id'] != $bean->team_set_id) || ($bean->fetched_row['team_id'] != $bean->team_id)){
                // Get all team set
                $teamSetBean = new TeamSet();
                $teams = $teamSetBean->getTeams($bean->team_set_id);
                // Add all team set to  $team_list
                foreach ($teams as $key => $value) {
                    $team_list[] = $key;
                }
                // Add children of team set to $team_list
                foreach ($teams as $key => $value) {
                    // Get children of team
                    $q1 = "SELECT id, name, parent_id FROM teams WHERE private <> 1 AND deleted = 0 AND parent_id = '{$key}'";
                    $rs1 = $GLOBALS['db']->query($q1);

                    while($row = $GLOBALS['db']->fetchByAssoc($rs1)){
                        if (!isset($teams[$row['id']])) $team_list[] = $row['id'];
                        $q2 = "SELECT id, name, parent_id FROM teams WHERE private <> 1 AND deleted = 0 AND parent_id = '{$row['id']}'";
                        $rs2 = $GLOBALS['db']->query($q2);
                        while($row2 = $GLOBALS['db']->fetchByAssoc($rs2))
                            if (!isset($teams[$row['id']])) $team_list[] = $row2['id'];
                    }
                }

                if(!empty($team_list)){
                    $bean->load_relationship('teams');
                    //Add the teams
                    $bean->teams->replace($team_list);
                }
            }
        }
    }
    function listViewColor(&$bean, $event, $arguments){
        switch ($bean->status) {
            case "Active":
                $bean->status = '<span class="textbg_dream">'.$bean->status.'</span>';
                break;
            case "Inactive":
                $bean->status = '<span class="textbg_crimson">'.$bean->status.'</span>';
                break;
        }
        //get list product_tempaltes
        $result =$GLOBALS['db']->fetchArray("SELECT product_templates_id id FROM product_templates_discount Where discount_id = '{$bean->id}' and deleted=0");
        $bean->product_discount = count($result);


    }
}