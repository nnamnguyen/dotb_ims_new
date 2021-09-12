<?php
    //Capture lead
    $args = $_POST;

    //user create
    if(empty($args['api_user'])) $args['api_user'] = 'apps_admin';
    $args['api_user_id'] = $GLOBALS['db']->getOne("SELECT id FROM users WHERE user_name = '{$args['api_user']}'");
    if(empty($args['api_user_id'])) $args['api_user_id'] = '1';
    $GLOBALS['current_user'] = BeanFactory::getBean('Users', $args['api_user_id']);

    //get Team Id
    $teamId = $GLOBALS['db']->getOne("SELECT id FROM teams WHERE description LIKE '%{$args['center']}%' AND private = 0 AND deleted = 0 LIMIT 1");
    $args['team_id'] = $teamId;
    if (empty($args['team_id'])) $args['team_id'] = '1';

    //Check campaign_name
    if (!empty($args['campaign_name'])) {
        $args['campaign_id'] = $GLOBALS['db']->getOne("SELECT DISTINCT IFNULL(campaigns.id, '') primaryid FROM campaigns WHERE (campaigns.name LIKE '%{$args['campaign_name']}%') AND campaigns.deleted = 0");
        if (empty($args['campaign_id'])) {
            $cam                = new Campaign();
            $cam->name          = $args['campaign_name'];
            $cam->team_id       = $args['team_id'];
            $cam->team_set_id   = $args['team_id'];
            $cam->save();
            $args['campaign_id'] = $cam->id;
        }
    }
    //get Assigned to
    $args['assigned_user_id'] = $GLOBALS['db']->getOne("SELECT IFNULL(manager_user_id, '') manager_user_id FROM teams WHERE id='{$args['team_id']}'");

    //get data
    if(empty($args['email1']))
        $args['email1'] = $args['email'];

    if(empty($args['status']))
        $args['status'] = 'New';

    if(!empty($args['name']) && empty($args['first_name']))
        $args['first_name']  = split_fullname($args['name'],0);
    if(!empty($args['name']) && empty($args['last_name']))
        $args['last_name']  = split_fullname($args['name']);

    //get module name
    if(strtolower($args['type']) == 'lead')
        $module_name = 'Lead';
    else $module_name = 'Prospect';

    //add Lead/Prospect
    $lead = new $module_name();
    $lead->disable_row_level_security =true;
    foreach ($lead->field_defs as $keyField => $aFieldName)
        $lead->$keyField = $args[$keyField];

    //Check duplicate
    $duplicates = $lead->findDuplicates();
    if(count($duplicates['records']) > 0){
        ob_clean();
        die(json_encode(array(
            'success'   => 0,
            'messages'  => 'duplicated_found',
            'record'    => $duplicates['records'][0]['id'],
        )));
    }

    $lead->save();

    ob_clean();
    die(json_encode(array(
        'success'   => 1,
        'messages'  => 'created_new_'.$module_name,
        'record'    => $lead->id,
    )));


