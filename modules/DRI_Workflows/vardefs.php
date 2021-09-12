<?php

$dictionary['DRI_Workflow'] = array (
    'table' => 'dri_workflows',
    'audited' => true,
    'unified_search' => false,
    'duplicate_merge' => true,
    'comment' => 'DRI_Workflow',
    'fields' => array (),
    'relationships' => array (),
    'indices' => array (),
    'optimistic_lock' => true,
    'uses' => array (
        'default',
        'assignable',
        'team_security',
    ),
);

VardefManager::createVardef(
    'DRI_Workflows',
    'DRI_Workflow'
);

// make sure not to redeclare this function
if (!function_exists('add_customer_journey_parent')) {
    /**
     * This function is a copy of \DRI_Workflows\VardefManager::addParent.
     * When ever making updates to this method, this function needs to be updated as well.
     *
     * The reason for duplicating this functionality is due to an error in
     * the installation of the plugin in Dotb >=8.0 when having the package scanner enabled.
     *
     * @param array $settings
     */
    function add_customer_journey_parent(array $settings) {
        foreach (array ('module_name', 'object_name', 'table_name') as $key) {
            if (!isset($settings[$key])) {
                throw new \InvalidArgumentException('missing required setting '.$key);
            }
        }

        $object = $settings['object_name'];
        $bean = isset($settings['bean_name']) ? $settings['bean_name'] : $settings['object_name'];
        $table = $settings['table_name'];
        $module = $settings['module_name'];
        $prefix = strtolower($object);
        $id_name = $prefix . '_id';
        $name = $prefix . '_name';
        $link_name = $prefix . '_link';
        $label_name = 'LBL_' . strtoupper($object);
        $enabled = isset($settings['enabled']) ? $settings['enabled'] : true;
        $rank = isset($settings['rank']) ? $settings['rank'] : 10;
        $relationship = 'dri_workflow_' . strtolower($module);

        $GLOBALS['dictionary']['DRI_Workflow']['relationships'][$relationship] = array (
            'relationship_type' => 'one-to-many',
            'lhs_key' => 'id',
            'lhs_module' => $module,
            'lhs_table' => $table,
            'rhs_module' => 'DRI_Workflows',
            'rhs_table' => 'dri_workflows',
            'rhs_key' => $id_name,
        );

        $GLOBALS['dictionary']['DRI_Workflow']['fields'][$id_name] = array (
            'name' => $id_name,
            'vname' => $label_name,
            'required' => false,
            'reportable' => false,
            'audited' => true,
            'importable' => 'true',
            'massupdate' => false,
            'type' => 'id',
        );

        $GLOBALS['dictionary']['DRI_Workflow']['fields'][$name] = array (
            'name' => $name,
            'vname' => $label_name,
            'required' => false,
            'reportable' => false,
            'audited' => true,
            'importable' => 'true',
            'massupdate' => false,
            'source' => 'non-db',
            'type' => 'relate',
            'rname' => 'name',
            'table' => $table,
            'id_name' => $id_name,
            'sort_on' => 'name',
            'module' => $module,
            'link' => $link_name,
            'customer_journey_parent' => array (
                'enabled' => $enabled,
                'rank' => $rank,
            ),
        );

        $GLOBALS['dictionary']['DRI_Workflow']['fields'][$link_name] = array (
            'name' => $link_name,
            'vname' => $label_name,
            'source' => 'non-db',
            'type' => 'link',
            'side' => 'right',
            'bean_name' => $bean,
            'relationship' => $relationship,
            'module' => $module,
        );

        $GLOBALS['dictionary']['DRI_Workflow']['indices']['idx_cj_jry_'.$id_name] = array (
            'name' => 'idx_cj_jry_'.$id_name,
            'type' => 'index',
            'fields' => array ($id_name),
        );
    }
}

add_customer_journey_parent(array (
    'module_name' => 'Accounts',
    'object_name' => 'Account',
    'table_name' => 'accounts',
    'rank' => 0,
));

add_customer_journey_parent(array (
    'module_name' => 'Contacts',
    'object_name' => 'Contact',
    'table_name' => 'contacts',
    'rank' => 10,
));

add_customer_journey_parent(array (
    'module_name' => 'Leads',
    'object_name' => 'Lead',
    'table_name' => 'leads',
    'rank' => 20,
));

add_customer_journey_parent(array (
    'module_name' => 'Opportunities',
    'object_name' => 'Opportunity',
    'table_name' => 'opportunities',
    'rank' => 30,
));

add_customer_journey_parent(array (
    'module_name' => 'Cases',
    'object_name' => 'Case',
    'bean_name' => 'aCase',
    'table_name' => 'cases',
    'rank' => 40,
));
