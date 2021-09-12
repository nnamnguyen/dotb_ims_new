<?php

$viewdefs['DocumentRevisions']['EditView'] = array(
    'templateMeta' => array('form' => array('enctype'=>'multipart/form-data',
                                            'hidden'=>array('<input type="hidden" name="return_id" value="{$smarty.request.return_id}">'),
                                ),       
                            'maxColumns' => '2', 
                            'widths' => array(
                                array('label' => '10', 'field' => '30'), 
                                array('label' => '10', 'field' => '30')
                                ),
                            'javascript' => '{dotb_getscript file="include/javascript/popup_parent_helper.js"}
{dotb_getscript file="modules/Documents/documents.js"}',
        ),
    'panels' =>array (
        '' => 
        array (
            array (
                array ( 'name' => 'document_name', 'type' => 'readonly' ),
                array ( 'name' => 'latest_revision', 'type' => 'readonly' ),
            ),
            array (
                'revision',
            ),
            
            array (
                'filename',
                'doc_type',
            ),
            
            array (
                array ( 'name' => 'change_log', 'size' => '126', 'maxlength' => '255' ),
            ),

        ),
    ),
);
