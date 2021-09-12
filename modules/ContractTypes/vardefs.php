<?php

$dictionary['ContractType'] = array(
    'favorites' => false,
    'table' => 'contract_types',
    'comment' => 'Specifies the types of contracts available',

    'fields' => array (
        'list_order' => array (
            'name' => 'list_order',
            'vname' => 'LBL_LIST_ORDER',
            'type' => 'int',
            'len' => '4',
            'comment' => 'Relative order in drop down list',
            'importable' => 'required',
        ),
        'documents' => array (
            'name' => 'documents',
            'type' => 'link',
            'relationship' => 'contracttype_documents',
            'source'=>'non-db',
            'vname'=>'LBL_DOCUMENTS',
        ),
    ),
    'acls' => array('DotbACLDeveloperOrAdmin' => array('aclModule'=>'Contracts')),
    'uses' => array(
        'basic',
    ),
);

VardefManager::createVardef(
    'ContractTypes',
    'ContractType'
);

$dictionary['ContractType']['fields']['tag']['massupdate'] = false;
