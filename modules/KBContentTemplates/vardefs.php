<?php


$dictionary['KBContentTemplate'] = array(
    'table' => 'kbcontent_templates',
    'audited' => true,
    'activity_enabled' => true,
    'comment' => 'A template is used as a body for KBContent.',
    'fields' => array(
        'body' => array(
            'name' => 'body',
            'vname' => 'LBL_TEXT_BODY',
            'type' => 'longtext',
            'comment' => 'Template body',
            'audited' => true,
        ),
    ),
    'relationships' => array(),
    'duplicate_check' => array(
        'enabled' => false,
    ),
    'uses' => array(
        'basic',
        'team_security',
    ),
    'ignore_templates' => array(
        'taggable',
    ),
    'acls' => array(
        'DotbACLKB' => true,
        'DotbACLDeveloperOrAdmin' => array(
            'aclModule' => 'KBContents',
            'allowUserRead' => true
        ),
    ),
);

VardefManager::createVardef(
    'KBContentTemplates',
    'KBContentTemplate'
);
$dictionary['KBContentTemplate']['fields']['name']['audited'] = true;
