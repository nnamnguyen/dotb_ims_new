<?php
// Add 2 field (left side) in relationship Contacts and SiteDeployment by nnamnguyen
$dictionary['Contact']['relationships']['sitedeployment_contacts'] = array (
    'lhs_module'        => 'Contacts',
    'lhs_table'            => 'contacts',
    'lhs_key'            => 'id',
    'rhs_module'        => 'C_SiteDeployment',
    'rhs_table'            => 'c_sitedeployment',
    'rhs_key'            => 'sitedeployment_contact_id',
    'relationship_type'    => 'one-to-many',
);
$dictionary['Contact']['fields']['sitedeployment_contacts_link'] = array(//chưa kéo subpanel cho contacts và cũng k cần hiển thị subpanel
    'name' => 'sitedeployment_contacts_link',
    'type' => 'link',
    'relationship' => 'sitedeployment_contacts',
    'module' => 'C_SiteDeployment',
    'bean_name' => 'C_SiteDeployment',
    'source' => 'non-db',
    'vname' => 'LBL_SITEDEPLOYMENT_CONTACTS',
);