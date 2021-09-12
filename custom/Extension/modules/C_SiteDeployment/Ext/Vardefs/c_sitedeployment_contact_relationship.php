<?php
// Add 3 field (right side) in relationship SiteDeployment and Contacts by nnamnguyen
$dictionary['C_SiteDeployment']['fields']['contacts_sitedeployment_link'] = array(
    'name' => 'contacts_sitedeployment_link',
    'type' => 'link',
    'relationship' => 'sitedeployment_contacts',
    'link_type' => 'many',
    'side' => 'right',
    'module' => 'Contacts',
    'bean_name' => 'Contact',
    'source' => 'non-db',
    'vname' => 'LBL_SITEDEPLOYMENT_CONTACT_NAME',
    'id_name' => 'sitedeployment_contact_id',
);
$dictionary['C_SiteDeployment']['fields']['sitedeployment_contact_id'] = array(
    'name' => 'sitedeployment_contact_id',
    'vname' => 'LBL_SITEDEPLOYMENT_CONTACT_NAME_ID',
    'type' => 'id',
    'required' => false,
    'reportable' => false,
    'comment' => ''
);
$dictionary['C_SiteDeployment']['fields']['sitedeployment_contact_name'] = array(
    'name' => 'sitedeployment_contact_name',
    'rname' => 'name',
    'id_name' => 'sitedeployment_contact_id',
    'vname' => 'LBL_SITEDEPLOYMENT_CONTACT_NAME_TITLE',
    'type' => 'relate',
    'link' => 'contacts_sitedeployment_link',
    'table' => 'contacts',
    'isnull' => 'true',
    'module' => 'Contacts',
    'dbType' => 'varchar',
    'len' => 'id',
    'reportable' => true,
    'source' => 'non-db',
);

// Add 3 field (right side) in relationship SiteDeployment and Contacts by nnamnguyen
// $dictionary["C_SiteDeployment"]["fields"]["c_sitedeployment_contact"] = array(
//     'name' => 'c_sitedeployment_contact',
//     'type' => 'link',
//     'relationship' => 'c_sitedeployment_contact',
//     'source' => 'non-db',
//     'module' => 'Contacts',
//     'bean_name' => 'Contact',
//     'side' => 'right',
//     'vname' => 'LBL_CONTACTS_C_SITEDEPLOYMENT_FROM_C_SITEDEPLOYMENT_TITLE',
//     'id_name' => 'contacts_c_sitedeployment_contacts_ida',
//     'link-type' => 'one',
// );
// $dictionary["C_SiteDeployment"]["fields"]["contacts_c_sitedeployment_name"] = array(
//     'name' => 'contacts_c_sitedeployment_name',
//     'type' => 'relate',
//     'source' => 'non-db',
//     'vname' => 'LBL_CONTACTS_C_SITEDEPLOYMENT_FROM_CONTACTS_TITLE',
//     'save' => true,
//     'id_name' => 'contacts_c_sitedeployment_contacts_ida',
//     'link' => 'contacts_c_sitedeployment',
//     'table' => 'contacts',
//     'module' => 'Contacts',
//     'rname' => 'name',
// );
// $dictionary["C_SiteDeployment"]["fields"]["contacts_c_sitedeployment_contacts_ida"] = array(
//     'name' => 'contacts_c_sitedeployment_contacts_ida',
//     'type' => 'id',
//     'source' => 'non-db',
//     'vname' => 'LBL_CONTACTS_C_SITEDEPLOYMENT_FROM_C_SITEDEPLOYMENT_TITLE_ID',
//     'id_name' => 'contacts_c_sitedeployment_contacts_ida',
//     'link' => 'contacts_c_sitedeployment',
//     'table' => 'contacts',
//     'module' => 'Contacts',
//     'rname' => 'id',
//     'reportable' => false,
//     'side' => 'right',
//     'massupdate' => false,
//     'duplicate_merge' => 'disabled',
//     'hideacl' => true,
// );
