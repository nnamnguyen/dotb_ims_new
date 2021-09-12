<?php


$dictionary['KBDocument'] = array(
    'reassignable' => false,
    'table' => 'kbdocuments',
    'favorites' => true,
    'unified_search' => true,
    'full_text_search' => false,
    'comment' => 'Knowledge Base management',
    'fields' => array(
    ),
    'uses' => array(
        'basic',
        'team_security',
        'assignable',
    ),
    'ignore_templates' => array(
        'taggable',
    ),
);
VardefManager::createVardef(
    'KBDocuments',
    'KBDocument'
);

//boost value for full text search
$dictionary['KBDocument']['fields']['name']['full_text_search']['boost'] = 1.49;
