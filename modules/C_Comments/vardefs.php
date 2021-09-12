<?php



    $dictionary['C_Comments'] = array(
        'table' => 'c_comments',
        'audited' => true,
        'activity_enabled' => false,
        'fields' => array (
            'direction' => array(
                'name' => 'direction',
                'type' => 'enum',
                'options' => 'comments_direction_options',
                'label' => 'LBL_DIRECTION',
                'len' => 100,
                'default' => 'outbound',
            ),
            'parent_id' => array(
                'vname' => 'LBL_PARENT_ID',
                'name' => 'parent_id',
                'type' => 'varchar',
                'len' => 36
            ),
            'parent_type' => array(
                'vname' => 'LBL_PARENT_TYPE',
                'name' => 'parent_type',
                'type' => 'varchar',
                'len' => 100
            ),
        ),
        'relationships' => array (
        ),
        'optimistic_locking' => true,
        'unified_search' => true,
        'full_text_search' => true,
    );

    if (!class_exists('VardefManager')){
    }
    VardefManager::createVardef('C_Comments','C_Comments', array('basic','assignable','taggable','file'));


    $dictionary['C_Comments']['fields']['description']['required'] = true;
    $dictionary['C_Comments']['fields']['description']['rows'] = 4;
    $dictionary['C_Comments']['fields']['description']['cols'] = 90;
