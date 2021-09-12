<?php

/*
 * Your installation or use of this DotbCRM file is subject to the applicable
 * terms available at
 * http://support.dotbcrm.com/Resources/Master_Subscription_Agreements/.
 * If you do not agree to all of the applicable terms or do not have the
 * authority to bind the entity as an authorized representative, then do not
 * install or use this DotbCRM file.
 *
 * Copyright (C) DotbCRM Inc. All rights reserved.
 */

$dictionary['RT_DotbBoards'] = array(
    'table' => 'rt_dotbboards',
    'audited' => true,
    'activity_enabled' => false,
    'duplicate_merge' => true,
    'fields' => array (
      'boardModule' => array (
        'name' => 'boardModule',
        'vname' => 'LBL_MODULE',
        'type' => 'enum',
        'len' => '100',
      ),
      'groupBy' => array(
        'name' => 'groupBy',
        'vname' => 'LBL_MODULE',
        'type' => 'enum',
        'len' => '100',
      ),
      'successStage' => array(
        'name' => 'successStage',
        'vname' => 'LBL_S_STAGE',
        'type' => 'enum',
        'len' => '100',
      ),
      'failureStage' => array(
        'name' => 'failureStage',
        'vname' => 'LBL_F_STAGE',
        'type' => 'enum',
        'len' => '100',
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
VardefManager::createVardef('RT_DotbBoards','RT_DotbBoards', array('basic','team_security','assignable','taggable'));
