<?php

namespace DRI_Workflows;

require_once 'modules/DRI_Workflows/DRI_Workflow.php';

/**
 * @author Emil Kilhage
 */
class VardefManager
{
    /**
     * A COPY OF THIS METHOD EXISTS IN modules/DRI_Workflows/vardefs.php.
     * Whenever this method is updated, the add_customer_journey_parent
     * function needs to updated as well.
     *
     * Adds default definitions for a parent module
     *
     * required settings are:
     *  - table_name: The modules table name, e.g. accounts
     *  - object_name: The modules object name, e.g. Account
     *  - module_name: The modules module name, e.g. Accounts
     *  - rank: How the parent module should be ranked compared to others
     *
     * optional settings are:
     *  - enabled: if the parent module should be enabled or not, default=true
     *
     * @param array $settings
     */
    public static function addParent(array $settings)
    {
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
            \DRI_Workflow::PARENT_VARDEF_KEY => array (
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

    /**
     * @param string $object
     */
    public static function disable($object)
    {
        $GLOBALS['dictionary']['DRI_Workflow']['fields'][strtolower($object) . '_name'][\DRI_Workflow::PARENT_VARDEF_KEY]['enabled'] = false;
    }
}
