<?php
/***
* Get Team members are not include User in Parent Team
*
* @param mixed $team_id
* @param mixed $parent_team_id
*/
function getTeamMembers($team_id = null, $parent_team_id = null, $show_type = 'Active'){
    $ext_status = '';
    if($show_type == 'Active')
        $ext_status = "AND l1.status = '$show_type'";

    $ext_parent = '';
    if($parent_team_id != '1')
        $ext_parent = "AND (l1.id NOT IN (SELECT DISTINCT
        IFNULL(tm.id, '') tm_id
        FROM
        teams t
        INNER JOIN
        team_memberships tm_1 ON t.id = tm_1.team_id
        AND tm_1.deleted = 0
        INNER JOIN
        users tm ON tm.id = tm_1.user_id AND tm.deleted = 0
        WHERE
        (((t.id = '$parent_team_id')))
        AND t.deleted = 0))";

    $q1 = "SELECT DISTINCT
    IFNULL(l1.id, '') user_id,
    l1.user_name l1_user_name,
    CONCAT( IFNULL(l1.last_name, ''),
    ' ',
    IFNULL(l1.first_name, '') ) l1_full_name,
    l1.title l1_title,
    l1.is_admin is_admin,
    IFNULL(l2.id, '') l2_id,
    IFNULL(l2.name, '') l2_name,
    l1.phone_mobile l1_phone_mobile,
    IFNULL(l3.id, '') l3_id,
    l3.email_address l3_email_address,
    l1.status l1_employee_status
    FROM
    teams
    INNER JOIN
    team_memberships l1_1 ON teams.id = l1_1.team_id
    AND l1_1.deleted = 0
    INNER JOIN
    users l1 ON l1.id = l1_1.user_id AND l1.deleted = 0 $ext_status
    INNER JOIN
    teams l2 ON l1.default_team = l2.id
    AND l2.deleted = 0
    LEFT JOIN
    email_addr_bean_rel l3_1 ON l1.id = l3_1.bean_id
    AND l3_1.deleted = 0
    AND l3_1.primary_address = '1'
    LEFT JOIN
    email_addresses l3 ON l3.id = l3_1.email_address_id
    AND l3.deleted = 0
    WHERE
    (((teams.id = '$team_id')
    $ext_parent))
    AND teams.deleted = 0
    ORDER BY l1_full_name ASC";
    return $member_list = $GLOBALS['db']->fetchArray($q1);
}


function getTeamsForUser($user_id= null){
    $query = "SELECT DISTINCT
    IFNULL(users.id, '') primaryid,
    IFNULL(users.user_name, '') users_user_name,
    IFNULL(l1.id, '') defaut_team_id,
    IFNULL(l1.name, '') defaut_team_name,
    IFNULL(l2.id, '') team_id,
    IFNULL(l2.name, '') team_name,
    IFNULL(l2.legal_name, '') legal_name
    FROM
    users
    INNER JOIN
    teams l1 ON users.default_team = l1.id
    AND l1.deleted = 0
    INNER JOIN
    team_memberships l2_1 ON users.id = l2_1.user_id
    AND l2_1.deleted = 0
    INNER JOIN
    teams l2 ON l2.id = l2_1.team_id AND l2.deleted = 0
    WHERE
    (((users.id = '$user_id') AND l2.private = 0))
    AND users.deleted = 0";

    $result = $GLOBALS['db']->query($query);
    $html = "<select class='selectpicker select_team' data-width='100%'>";
    while($row = $GLOBALS['db']->fetchByAssoc($result)){
        ($row['team_id'] == $row['defaut_team_id']) ? $html .= "<option selected value='{$row['team_id']}'>{$row['team_name']}</option>" : $html .= "<option value='{$row['team_id']}'>{$row['team_name']}</option>";
    }
    $html .= "</select>";
    return $html;
}

function getListRole(){
    //Get list Role
    $q1 = "SELECT id, name FROM acl_roles
    WHERE acl_roles.deleted=0 AND name <> 'Customer Self-Service Portal Role' ORDER BY name";
    $data = array();
    $rs1 = $GLOBALS['db']->query($q1);
    while($row = $GLOBALS['db']->fetchByAssoc($rs1))
        $data[$row['id']] = $row['name'];

    return $data;
}

function getRolesForUser($user_id= null, $roles= null){
    //get list of Role for a given user id
    $user_roles = array();
    $q2 = "SELECT
    acl_roles.id id, acl_roles.name name
    FROM
    acl_roles
    INNER JOIN
    acl_roles_users ON acl_roles_users.user_id = '$user_id'
    AND acl_roles_users.role_id = acl_roles.id
    AND acl_roles_users.deleted = 0
    WHERE
    acl_roles.deleted = 0";
    $rs2 = $GLOBALS['db']->query($q2);
    while($row = $GLOBALS['db']->fetchByAssoc($rs2) ){
        $user_roles[] = $row['id'];
    }
    // Make Colorzing
    $label_color = array(
        0 => 'label-info',
        1 => 'label-primary',
        2 => 'label-success',
        3 => 'label-danger',
        4 => 'label-default',
        5 => 'label-warning',
        6 => 'highlight_blue',
        7 => 'highlight_bluelight',
        8 => 'highlight_red',
        9 => 'highlight_dream',
        10 => 'highlight_black',
        11 => 'highlight_yellow',
        12 => 'highlight_yellowlight',
        13 => 'highlight_green',
        14 => 'highlight_violet',
        15 => 'highlight_orange',
        16 => 'highlight_crimson',
        17 => 'highlight_blood',
        18 => 'highlight_redlight',
    );
    $i = 0;
    $html = "<select class='selectpicker select_role' data-live-search='true' multiple data-width='200px' title=''>";
    foreach($roles as $role_id => $role_name){
        in_array($role_id, $user_roles) ? $sel = 'selected' : $sel = '';
        $html .= "<option data-content=\"<span class='label $label_color[$i]'>{$role_name}</span>\" $sel value='{$role_id}'>{$role_name}</option>";
        $i > 17 ? $i = 0 : $i++;
    }
    $html .= "</select>";
    return $html;
}

function makeDropdownStatus($selected= null){
    $html = "<select class='selectpicker select_status' data-width='100%'>";
    $html .= get_select_options($GLOBALS['app_list_strings']['user_status_dom'],$selected);
    return $html .= "</select>";
}

function getMembershipForUser($team_id= null, $parent_id= null, $user_id= null){
    if($team_id == '1')
        return 'Global';
    else
        return 'Member';
}

function getTeamDetail($team_id= null, $show_type = ''){
    $team = BeanFactory::getBean('Teams',$team_id);
    if($team_id != '1'){
        $members = getTeamMembers($team->id, $team->parent_id, $show_type);
        $roles   = getListRole();
        global $mod_strings;
        //Prepare Users List
        $html   = "";
        $js     = "";
        $html .= "<table width='100%' class='table table-striped table-bordered dataTable' id='celebs'>";
        $html .= "<thead><tr>
        <th width='15%'>".translate('LBL_NAME','Users')."</th>
        <th width='15%'>".translate('LBL_USER_NAME','Users')."</th>
        <th width='15%'>".translate('LBL_TITLE','Users')."</th>

        <th width='15%'>".translate('LBL_DEFAULT_TEAM','Users')."</th>
        <th width='20%'>".translate('LBL_DEFAULT_SUBPANEL_TITLE','Roles')."</th>
        <th width='10%'>".$mod_strings['LBL_STATUS']."</th>
        <th style='min-width: 50px; text-align:center;'></th>
        </tr></thead>
        <tbody>";
        $count = 0;
        for($i = 0; $i < count($members); $i++){
            //Generate the compose Email.
            //     $emailLinkUrl = 'contact_id='.$members[$i]['l3_id'].
            //            '&parent_type='.'Users'.
            //            '&parent_id='.$members[$i]['user_id'].
            //            '&parent_name='.$members[$i]['l1_full_name'].
            //            '&to_addrs_ids='.$members[$i]['l3_id'].
            //            '&to_addrs_names='.urlencode($members[$i]['l1_full_name']).
            //            '&to_addrs_emails='.urlencode($members[$i]['l3_email_address']).
            //            '&to_email_addrs='.urlencode($members[$i]['l1_full_name'] . '&nbsp;&lt;' . $members[$i]['l3_email_address'] . '&gt;').
            //            '&return_module=""'.
            //            '&return_action=""'.
            //            '&return_id=""';
            //            require_once('modules/Emails/EmailUI.php');
            //            $eUi = new EmailUI();
            //            $j_quickCompose = $eUi->generateComposePackageForQuickCreateFromComposeUrl($emailLinkUrl, true);
            //            $emailLink = "<a href='javascript:void(0);' style='text-decoration: none;font-weight: normal;' onclick='DOTB.quickCompose.init($j_quickCompose);'>";
            //
            $membership = getMembershipForUser($team->id,$team->parent_id,$members[$i]['user_id']);
            $count++;
            $html .= "<tr id='{$members[$i]['user_id']}'>";
            $html .= "<td>{$members[$i]['l1_full_name']}</td>";
            $html .= "<td><a  style='text-decoration: none;font-weight: normal;' href='index.php?module=Users&return_module=Users&action=DetailView&record={$members[$i]['user_id']}'>{$members[$i]['l1_user_name']}</a></td>";
            $html .= "<td>{$members[$i]['l1_title']}</td>";
            //$html .= "<td>$emailLink{$members[$i]['l3_email_address']}</a></td>";
            //$html .= "<td>{$members[$i]['l1_phone_mobile']}</td>";
            //
            $html .= "<td>".getTeamsForUser($members[$i]['user_id'])."</td>";
            if($members[$i]['is_admin'])
                $html .= "<td><p style='margin-left: 10px;'>Administrator</p></td>";
            else
                $html .= "<td>".getRolesForUser($members[$i]['user_id'], $roles)."</td>";

            //$html .= "<td>$membership</td>";
            $html .= "<td>".makeDropdownStatus($members[$i]['l1_employee_status'])."</td>";
            if($membership == 'Member')
                $html .= "<td valign='bottom' nowrap>
                <a class='login_user' style='margin-right: 5px;' href='index.php?module=Users&action=Impersonate&record={$members[$i]['user_id']}' title = '{$mod_strings['LBL_LOG_IN_TO']}{$members[$i]['l1_user_name']}'><span class='glyphicon glyphicon-log-in' aria-hidden='true'></span></a>
                <a class='save_user' style='margin-right: 5px;' href='javascript:void(0)' title = '{$GLOBALS['app_strings']['LBL_EMAIL_SAVE']}'><span class='glyphicon glyphicon-floppy-save' aria-hidden='true'></span></a>
                <a class='remove_user' href='javascript:void(0)' title = '{$GLOBALS['app_strings']['LBL_EMAIL_MENU_REMOVE']}'><span class='glyphicon glyphicon-remove' aria-hidden='true'></a>
                </td>";
            else
                $html .= "<td valign='bottom' nowrap>
                <a class='login_user' style='margin-right: 5px;' href='index.php?module=Users&action=Impersonate&record={$members[$i]['user_id']}' title = '{$mod_strings['LBL_LOG_IN_TO']}{$members[$i]['l1_user_name']}'><span class='glyphicon glyphicon-log-in' aria-hidden='true'></span></a>
                <a class='save_user' title = '{$GLOBALS['app_strings']['LBL_EMAIL_SAVE']}' href='javascript:void(0)'><span class='glyphicon glyphicon-floppy-save' aria-hidden='true'></span></a>
                </td>";

            $html .= "</tr>";
        }
        $html   .= "</tbody>";
        $html   .= "</table>";
        $js     .= "
        <script>
        $(document).ready(function() {
        var table = $('#celebs');
        var oTable = table.dataTable({ 'fnFooterCallback': function( nFoot, aData, iStart, iEnd, aiDisplay ) { $('.selectpicker').selectpicker();}, bStateSave: true, paging: true, aoColumnDefs: [{ bSortable: false, aTargets: [ -1 ]}], });});
        </script>";
    }else{
        $html .= '-Too Many Users to Show-';
    }
    $html_js = $html.$js;
    return array(
        "success" => "1",
        "html" => $html_js,
        "count_user" => $count,
        'team' => array(
            "team_id"       => $team->id,
            "team_name"     => $team->name,
            "legal_name"    => $team->legal_name,
            "phone_number"  => $team->phone_number,
            "short_name"    => $team->short_name,
            "prefix"        => $team->code_prefix,
            "parent_id"     => $team->parent_id,
            "parent_name"   => empty($team->parent_name) ? '<-none->' : $team->parent_name,
            "manager_user_id"   => empty($team->manager_user_id) ? '' : $team->manager_user_id,
            "manager_user_name" => empty($team->manager_user_id) ? '' : get_full_user_name($team->manager_user_id),
            "description"   => $team->description,
            "region"        => $team->region,
        ),
    );
}

function getTeamNodes($selected = null){
    $node_arr = array();
    $q1 = "SELECT id, name, parent_id, description FROM teams WHERE private = 0 AND deleted = 0 ORDER BY date_entered ASC";
    $rs1 = $GLOBALS['db']->query($q1);
    while($row = $GLOBALS['db']->fetchByAssoc($rs1)){
        if($row['id'] == '1')
            $icon = "custom/include/javascript/Ztree/img/diy/1_close.png";
        else
            $icon = 'custom/include/javascript/Ztree/img/diy/12.png';


        $node_arr[] = array('id'=>$row['id'] , 'pId'=> $row['parent_id'], 'name'=>$row['name'], 'icon'=>$icon, 'isParent'=>true, 'open'=>false);
    }
    return $node_arr;
}

function getAllChildIds($teamId= null){
    $childList = array();

    // Get children of team
    $q1 = "SELECT id, name, parent_id FROM teams WHERE private = 0 AND deleted = 0 AND parent_id = '{$teamId}'";
    $rs1 = $GLOBALS['db']->query($q1);
    while($row = $GLOBALS['db']->fetchByAssoc($rs1)){
        if(!in_array($row['id'], $childList)){
            $childList[] = $row['id'];
        }

        $subChildList = getAllChildIds($row['id']);
        foreach($subChildList as $value){
            if(!in_array($value, $childList)){
                $childList[] = $value;
            }
        }
    }

    return $childList;
}
?>
