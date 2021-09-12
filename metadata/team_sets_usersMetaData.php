<?php


/**
 * Denormalized team_sets vs users to optimize TeamSecurity
 * There are two different tables. You are not looking at a copy/paste failure !
 */

$dictionary['team_sets_users_1'] = array(
    'table' => 'team_sets_users_1',
    'fields' => array(
        'team_set_id' => array(
            'name' => 'team_set_id',
            'type' => 'id',
            'required' => true,
        ),
        'user_id' => array(
            'name' => 'user_id',
            'type' => 'id',
            'required' => true,
        ),
    ),
    'indices' => array(
        array(
            'name' => 'idx_tud1_id',
            'type' => 'primary',
            'fields' => array(
                'team_set_id',
                'user_id',
            ),
        ),
        array(
            'name' => 'idx_tud1_user_id',
            'type' => 'index',
            'fields' => array(
                'user_id',
            ),
        ),
    ),
);

$dictionary['team_sets_users_2'] = array(
    'table' => 'team_sets_users_2',
    'fields' => array(
        'team_set_id' => array(
            'name' => 'team_set_id',
            'type' => 'id',
            'required' => true,
        ),
        'user_id' => array(
            'name' => 'user_id',
            'type' => 'id',
            'required' => true,
        ),
    ),
    'indices' => array(
        array(
            'name' => 'idx_tud2_id',
            'type' => 'primary',
            'fields' => array(
                'team_set_id',
                'user_id',
            ),
        ),
        array(
            'name' => 'idx_tud2_user_id',
            'type' => 'index',
            'fields' => array(
                'user_id',
            ),
        ),
    ),
);

$dictionary['team_set_events'] = array(
    'table' => 'team_set_events',
    'fields' => array(
        'id' => array(
            'name' => 'id',
            'type' => 'id',
        ),
        'action' => array(
            'name' => 'action',
            'type' => 'varchar',
            'len' => '100',
        ),
        'params' => array(
            'name' => 'params',
            'type' => 'text',
        ),
        'date_created' => array(
            'name' => 'date_created',
            'type' => 'datetime',
        ),
    ),
    'indices' => array(),
);
