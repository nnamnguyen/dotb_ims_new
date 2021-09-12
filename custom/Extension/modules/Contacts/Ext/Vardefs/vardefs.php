<?php
//Custom field - By Hieu Pham
$dictionary['Contact']['fields']['phone_mobile']['enableSMS']= true;
$dictionary['Contact']['fields']['phone_work']['enableSMS']= true;
$dictionary['Contact']['fields']['assistant_phone']['enableSMS']= true;

//Custom Relationship. Contact - SMS  By Hieu Pham
$dictionary['Contact']['fields']['contacts_sms'] = array (
    'name' => 'contacts_sms',
    'type' => 'link',
    'relationship' => 'contact_smses',
    'module' => 'C_SMS',
    'bean_name' => 'C_SMS',
    'source' => 'non-db',
    'vname' => 'LBL_STUDENT_SMS',
);
$dictionary['Contact']['relationships']['contact_smses'] = array (
    'lhs_module'        => 'Contacts',
    'lhs_table'            => 'contacts',
    'lhs_key'            => 'id',
    'rhs_module'        => 'C_SMS',
    'rhs_table'            => 'c_sms',
    'rhs_key'            => 'parent_id',
    'relationship_type'    => 'one-to-many',
);
$dictionary['Contact']['fields']['last_name']['required']= true;
$dictionary['Contact']['fields']['first_name']['required']= true;
$dictionary['Contact']['fields']['last_name']['importable']= true;
$dictionary['Contact']['fields']['account_name']['importable']= true;
$dictionary['Contact']['fields']['website'] = array (
    'name' => 'website',
    'type' => 'url',
    'vname' => 'LBL_WEBSITE',
    'len'=> 20
);
$dictionary['Contact']['fields']['utm_source'] = array (
    'name' => 'utm_source',
    'vname' => 'LBL_UTM_SOURCE',
    'type' => 'varchar',
    'len'=> 20
);
$dictionary['Contact']['duplicate_check'] = array(
    'enabled' => true,
    'FilterDuplicateCheck' => array(
        'filter_template' => array(
            array(
                '$and' => array(
                    array('first_name' => array('$starts' => '$first_name')),
                    array('last_name' => array('$starts' => '$last_name')),
                    array('accounts.id' => array('$equals' => '$account_id')),
                    array('phone_mobile' => array('$equals' => '$phone_mobile')),
                    array('dnb_principal_id' => array('$equals' => '$dnb_principal_id')),
                )
            ),
        ),
        'ranking_fields' => array(
            array(
                'in_field_name' => 'account_id',
                'dupe_field_name' => 'account_id',
            ),
            array(
                'in_field_name' => 'last_name',
                'dupe_field_name' => 'last_name',
            ),
            array(
                'in_field_name' => 'first_name',
                'dupe_field_name' => 'first_name',
            ),
        ),
    ),
);
//Add new fields by nnamnguyen
$dictionary['Contact']['fields']['department'] = array (
    'name' => 'department',
    'vname' => 'LBL_DEPARTMENT',
    'type' => 'varchar',
    'len'=> 100,
);
$dictionary['Contact']['fields']['office_phone'] = array (
    'name' => 'office_phone',
    'vname' => 'LBL_OFFICE_PHONE',
    'type' => 'int',
    'len'=> 10,
);