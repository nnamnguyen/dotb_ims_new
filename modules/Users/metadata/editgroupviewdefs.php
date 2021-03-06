<?php

$viewdefs['Users']['EditView'] = array(
    'templateMeta' => array('maxColumns' => '2', 
                            'widths' => array(
                                array('label' => '10', 'field' => '30'), 
                                array('label' => '10', 'field' => '30')
                            ),
                            'form' => array(
                                'headerTpl'=>'modules/Users/tpls/EditViewHeader.tpl',
                                'footerTpl'=>'modules/Users/tpls/EditViewFooter.tpl',
                            ),
                      ),
    'panels' => array (
        'LBL_USER_INFORMATION' => array (
            array('user_name',
                  array('name' => 'last_name',
                        'label' => 'LBL_LIST_NAME',
                  ),
            ),
            array(array(
                      'name' => 'status',
                      'customCode' => '{if $IS_ADMIN}@@FIELD@@{else}{$STATUS_READONLY}{/if}',
                  ),
                  array(
                      'name'=>'UserType',
                      'customCode'=>'{if $IS_ADMIN}{$USER_TYPE_DROPDOWN}{else}{$USER_TYPE_READONLY}{/if}',
                  ),
            ),
        ),
    ),
);
