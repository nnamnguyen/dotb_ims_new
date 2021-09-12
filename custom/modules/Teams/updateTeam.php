<?php
    require_once("custom/modules/Teams/_helper.php");

    /**
     * add by TKT
     * check license
     */
    require_once 'custom/include/KTEncrypt.php';
    $kt = new KTEncrypt();
    $lic = unserialize($kt->decode(trim(file_get_contents('license.key'),'"'), 'r>((5\tg&z/2y5y#\;'));
    if (empty($lic)) die(json_encode(array("success" => "0", "isReachedLimitTeams" => true)));
    else {
        $sql = "SELECT DISTINCT
                        COUNT(IFNULL(t1.id, '')) count_team
                    FROM
                        teams t1
                            INNER JOIN
                        teams t2 ON t1.parent_id = t2.id AND t2.deleted = 0
                            AND t1.deleted = 0
                            AND t1.id NOT IN (SELECT DISTINCT
                                tt.parent_id
                            FROM
                                teams tt
                            WHERE
                                tt.private = 0 AND tt.deleted = 0
                                    AND (tt.parent_id <> ''
                                    AND tt.parent_id IS NOT NULL))
                     WHERE t1.id <> '{$_POST['parent_id']}'";
        $team = $GLOBALS['db']->getOne($sql);
        $team = (int)$team;
        if ($team >= $lic['teams'] && empty($_POST['team_id'])) die(json_encode(array("success" => "0", "isReachedLimitTeams" => true)));
    }

    $action = $_POST['act'];
    if (empty($action)) {
        echo json_encode(array("success" => "0",));
    } else {


        // ******************(^ _ ^)*********************************

        // Update & Create Team
        if ($action == 'save') {
            if (empty($_POST['team_id']))
                $focus = new Team();
            else
                $focus = BeanFactory::getBean('Teams', $_POST['team_id']);

            $focus->name            = $_POST['team_name'];
            $focus->legal_name      = $_POST['legal_name'];
            $focus->code_prefix     = mb_strtoupper($_POST['prefix'], 'UTF-8');
            $focus->short_name      = mb_strtoupper($_POST['short_name'], 'UTF-8');
            $focus->phone_number    = $_POST['phone_number'];
            $focus->parent_id       = $_POST['parent_id'];
            $focus->parent_name     = $_POST['parent_name'];
            $focus->manager_user_id     = $_POST['manager_user_id'];
            $focus->manager_user_name     = $_POST['manager_user_name'];
            $focus->description     = $_POST['description'];
            $focus->region          = $_POST['region'];
            $focus->save();

            //add all users of parent to this team - Except Global
            if (empty($_POST['team_id'])) {
                $call_back = 'create';

                if ($focus->parent_id != '1') {
                    $users_parent = getTeamMembers($focus->parent_id);
                    for ($i = 0; $i < count($users_parent); $i++) {
                        $focus->add_user_to_team($users_parent[$i]['user_id']);
                    }
                }

            } else {
                $call_back = 'update';
                //Copy users from parent team to this team

                if ($focus->parent_id != '1' && $_POST['copyUserFlag'] == 'true') {
                    $users_parent = getTeamMembers($focus->parent_id);
                    for ($i = 0; $i < count($users_parent); $i++) {
                        $focus->add_user_to_team($users_parent[$i]['user_id']);
                    }
                }
            }
            // Add to all record of parent team
            if (!empty($_POST['parent_id']) && ($call_back == 'create' || $focus->fetched_row['parent_id'] != $focus->parent_id) ) {
                //list all module to effect this function ($module_name => $table)
                $modify_modules = array("J_Coursefee" => "j_coursefee", "J_Kindofcourse" => "j_kindofcourse", "J_Discount" => "j_discount");
                foreach ($modify_modules as $key => $value) {
                    $q1 = "SELECT " . $value . ".id id FROM " . $value . "
                    WHERE deleted = 0 AND team_set_id IN (
                    SELECT team_set_id FROM team_sets_teams
                    WHERE deleted = 0
                    AND team_id = '{$_POST['parent_id']}') AND team_id <> '1'";
                    $rs1 = $GLOBALS['db']->query($q1);

                    while ($row = $GLOBALS['db']->fetchByAssoc($rs1)) {
                        //Load current list team
                        $bean = BeanFactory::getBean($key, $row['id']);
                        $teamSetBean = new TeamSet();
                        $team_set = $teamSetBean->getTeams($bean->team_set_id);
                        $new_team_list = array();
                        foreach ($team_set as $team_id => $team_bean) {
                            $new_team_list[] = $team_id;
                        }
                        $new_team_list[] = $focus->id;
                        //Add new team list
                        $bean->load_relationship('teams');
                        $bean->teams->replace($new_team_list);
                    }
                }

            }
            echo json_encode(array(
                "success" => "1",
                "act" => "save",
                "call_back" => $call_back,
                'team' => array(
                    "team_id"       => $focus->id,
                    "team_name"     => $focus->name,
                    "legal_name"   => $focus->legal_name,
                    "phone_number"  => $focus->phone_number,
                    "short_name"    => $focus->short_name,
                    "prefix"        => $focus->code_prefix,
                    "parent_id"     => $focus->parent_id,
                    "parent_name"   => empty($focus->parent_name) ? '<-none->' : $focus->parent_name,
                    "manager_user_id"   => empty($focus->manager_user_id) ? '' : $focus->manager_user_id,
                    "manager_user_name" => empty($focus->manager_user_id) ? '' : get_full_user_name($focus->manager_user_id),
                    "description"   => $focus->description,
                    "region"        => $focus->region,
                ),
            ));
        } // Delete Team
        elseif (!empty($_POST['team_id']) && $action == 'delete') {
            $focus = new Team();
            $focus->retrieve($_POST['team_id']);
            if ($focus->has_users_in_teams()) {
                echo json_encode(array(
                    "success" => "0",
                ));
            } else {
                //todo: Verify that no items are still assigned to this team.
                if ($focus->id == $focus->global_team) {
                    $msg = $GLOBALS['app_strings']['LBL_MASSUPDATE_DELETE_GLOBAL_TEAM'];
                    $GLOBALS['log']->fatal($msg);
                    $error_message = $app_strings['LBL_MASSUPDATE_DELETE_GLOBAL_TEAM'];
                    DotbApplication::appendErrorMessage($error_message);
                    header('Location: index.php?module=Teams&action=DetailView&record=' . $focus->id);
                    return;
                }
                //Call mark_deleted function
                $focus->delete_team();
                echo json_encode(array(
                    "success" => "1",
                    "act" => "delete",
                ));
            }
        } else {
            echo json_encode(array("success" => "0",));
        }
    }
?>
