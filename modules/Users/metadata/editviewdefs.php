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
            array(
                array(
                    'name'=>'user_name',
                    'displayParams' => array('required'=>true),
                    ),
                'first_name'
            ),
            array(array(
                      'name' => 'status',
                      'displayParams' => array('required'=>true),
                  ),
                  'last_name'),
            array(array(
                      'name'=>'UserType',
                      'customCode'=>'{if $IS_ADMIN}{$USER_TYPE_DROPDOWN}{else}{$USER_TYPE_READONLY}{/if}',
                      ),
                ),
            array('picture'),
        ),
        'LBL_EMPLOYEE_INFORMATION' => array(
            array('employee_status',
                  'show_on_employees'),
            array('title',
                  'phone_work'),
            array('department',
                  'phone_mobile'),
            array('reports_to_name',
                  'phone_other'),
            array('','phone_fax'),
            array('','phone_home'),
            array('messenger_type','messenger_id'),
            array('address_street','address_city'),
            array('address_state','address_postalcode'),
            array('address_country'),
            array('description'),
        ),
    ),
);
