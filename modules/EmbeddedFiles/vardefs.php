<?php


$dictionary['EmbeddedFile'] = array(
    'table' => 'embedded_files',
    'audited' => false,
    'activity_enabled' => false,
    'comment' => 'Files for KBContent body.',
    'fields' => array(
        'filename' =>
            array(
                'name' => 'filename',
                'vname' => 'LBL_FILENAME',
                'type' => 'file',
                'dbType' => 'varchar',
                'len' => '255',
                'importable' => false,
            ),
        'file_mime_type' =>
            array(
                'name' => 'file_mime_type',
                'vname' => 'LBL_FILE_MIME_TYPE',
                'type' => 'varchar',
                'len' => '100',
                'importable' => false,
            ),
    ),
    'relationships' => array(),
    'duplicate_check' => array(
        'enabled' => false,
    ),
    'uses' => array(
        'basic',
    ),
    'ignore_templates' => array(
        'taggable',
    ),
);

VardefManager::createVardef(
    'EmbeddedFiles',
    'EmbeddedFile'
);
