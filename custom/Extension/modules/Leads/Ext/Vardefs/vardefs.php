<?php
//Custom field - By Hieu Pham
$dictionary['Lead']['fields']['phone_mobile']['enableSMS']= true;
$dictionary['Lead']['fields']['phone_work']['enableSMS']= true;

//Custom Relationship. Leads - SMS  By Hieu Pham
$dictionary['Lead']['fields']['leads_sms'] = array (
    'name' => 'leads_sms',
    'type' => 'link',
    'relationship' => 'lead_smses',
    'module' => 'C_SMS',
    'bean_name' => 'C_SMS',
    'source' => 'non-db',
    'vname' => 'LBL_LEAD_SMS',
);
$dictionary['Lead']['relationships']['lead_smses'] = array (
    'lhs_module'        => 'Leads',
    'lhs_table'            => 'leads',
    'lhs_key'            => 'id',
    'rhs_module'        => 'C_SMS',
    'rhs_table'            => 'c_sms',
    'rhs_key'            => 'parent_id',
    'relationship_type'    => 'one-to-many',
);


$dictionary['Lead']['fields']['last_name']['required']= true;
$dictionary['Lead']['fields']['first_name']['required']= true;
$dictionary['Lead']['duplicate_check'] = array(
    'enabled' => true,
    'FilterDuplicateCheck' => array(
        'filter_template' => array(
            array(
                '$or' => array(
                    array('phone_mobile' => array('$equals' => '$phone_mobile')),
                    array('email1' => array('$equals' => '$email1')),
                )
            ),
        ),
        'ranking_fields' => array(),
    ),
);
$dictionary['Lead']['fields']['international_name'] = array(
    'name' => 'international_name',
    'vname' => 'LBL_INTERNATIONAL_NAME',
    'type' => 'varchar',
    'len' => '100',
);
$dictionary['Lead']['fields']['industry'] = array(
    'name' => 'industry',
    'vname' => 'LBL_INDUSTRY',
    'type' => 'varchar',
    'len' => '100',
);
$dictionary['Lead']['fields']['business_code'] = array(
    'name' => 'business_code',
    'vname' => 'LBL_BUSSINESS_CODE',
    'type' => 'varchar',
    'len' => '50',
);
$dictionary['Lead']['fields']['date_of_issue'] = array(
    'name' => 'date_of_issue',
    'vname' => 'LBL_DATE_OF_ISSUE',
    'type' => 'date',
);

$dictionary['Lead']['fields']['first_name']['importable']= 'required';
$dictionary['Lead']['fields']['last_name']['importable']= true;
$dictionary['Lead']['fields']['phone_mobile']['importable']= 'required';
$dictionary['Lead']['fields']['account_name']['importable']= true;
$dictionary['Lead']['fields']['status']['full_text_search']= array('enabled' => true, 'searchable' => false);
$dictionary['Lead']['fields']['salutation']['audited']= false;
$dictionary['Lead']['fields']['first_name']['audited']= false;
$dictionary['Lead']['fields']['last_name']['audited']= false;
$dictionary['Lead']['fields']['title']['audited']= false;
$dictionary['Lead']['fields']['phone_work']['audited']= false;
$dictionary['Lead']['fields']['phone_fax']['audited']= false;
$dictionary['Lead']['fields']['facebook']['audited']= false;
$dictionary['Lead']['fields']['twitter']['audited']= false;
$dictionary['Lead']['fields']['googleplus']['audited']= false;
$dictionary['Lead']['fields']['phone_home']['audited']= false;
$dictionary['Lead']['fields']['phone_other']['audited']= false;
$dictionary['Lead']['fields']['alt_address_street']['audited']= false;
$dictionary['Lead']['fields']['alt_address_city']['audited']= false;
$dictionary['Lead']['fields']['alt_address_state']['audited']= false;
$dictionary['Lead']['fields']['alt_address_postalcode']['audited']= false;
$dictionary['Lead']['fields']['alt_address_country']['audited']= false;
$dictionary['Lead']['fields']['assistant']['audited']= false;
$dictionary['Lead']['fields']['assistant_phone']['audited']= false;
$dictionary['Lead']['fields']['dp_business_purpose']['audited']= false;
$dictionary['Lead']['fields']['birthdate']['audited']= false;
$dictionary['Lead']['fields']['mkto_sync']['audited']= false;
$dictionary['Lead']['fields']['dri_workflow_template_id']['audited'] = false;
$dictionary['Lead']['fields']['dri_workflow_template_name']['audited']= false;
$dictionary['Lead']['fields']['primary_address_street_2']['audited']= false;
$dictionary['Lead']['fields']['primary_address_street_3']['audited']= false;
$dictionary['Lead']['fields']['alt_address_street_2']['audited']= false;
$dictionary['Lead']['fields']['alt_address_street_3']['audited']= false;
$dictionary['Lead']['fields']['phone_mobile']['required']= true;

// Add new fields by nnamnguyen
$dictionary['Lead']['fields']['facebook'] = array(
    'name' => 'facebook',
    'vname' => 'LBL_FACEBOOK',
    'type' => 'url',
    'len' => '100',
);
$dictionary['Lead']['fields']['reference'] = array(
    'name' => 'reference',
    'vname' => 'LBL_REFERENCE',
    'type' => 'url',
    'len' => '100',
);
$dictionary['Lead']['fields']['utm_medium'] = array(
    'name' => 'utm_medium',
    'vname' => 'LBL_UTM_MEDIUM',
    'type' => 'varchar',
    'len'=> 20
);
$dictionary['Lead']['fields']['utm_content'] = array(
    'name' => 'utm_content',
    'vname' => 'LBL_UTM_CONTENT',
    'type' => 'varchar',
    'len'=> 20
);
$dictionary['Lead']['fields']['utm_campaign'] = array(
    'name' => 'utm_campaign',
    'vname' => 'LBL_UTM_CAMPAIGN',
    'type' => 'varchar',
    'len'=> 20
);
$dictionary['Lead']['fields']['reference_product'] = array(
    'name' => 'reference_product',
    'vname' => 'LBL_REFERENCE_PRODUCT',
    'type' => 'enum',
    'len'=> 20,
    'options'=>'reference_product_list'
);
