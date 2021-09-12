<?php

$viewdefs['Users']['DetailView'] = array(
    'templateMeta' => array('maxColumns' => '2', 
                            'widths' => array(
                                array('label' => '10', 'field' => '30'), 
                                array('label' => '10', 'field' => '30')
                            ),
                            'form' => array(
                                'headerTpl'=>'modules/Users/tpls/DetailViewHeader.tpl',
                                'footerTpl'=>'modules/Users/tpls/DetailViewFooter.tpl',
                            ),
                      ),
    'panels' => array (
        'LBL_USER_INFORMATION' => array (
            array('full_name','user_name'),
            array('status',
                  array(
                      'name'=>'UserType',
                      'customCode'=>'{$USER_TYPE_READONLY}',
                  ),
            ),
            array('picture'),
        ),
        'LBL_EMPLOYEE_INFORMATION' => array(
            array('employee_status','show_on_employees'),
            array('title','phone_work'),
            array('department','phone_mobile'),
            array('reports_to_name','phone_other'),
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
