<?php


/**
 * The LockedFieldsRelatedModulesUtilities is a helper class that establishes
 * relationships with all other modules in Dotb
 */
class LockedFieldsRelatedModulesUtilities
{
    /**
     * Modules that are on the modInvisList but still need to be exposed to locked
     * fields for processes
     * @var array
     */
    protected static $moduleWhiteList = [
        'Prospects',
        'RevenueLineItems',
    ];

    /**
     * Returns an array of fields for 'lockable_fields' modules
     *
     * @return array
     */
    public static function getRelatedFields()
    {
        global $beanList, $modInvisList;

        $fields = array();
        foreach ($beanList as $module => $bean) {
            // Do not allow establish relationships for modules that are invisible
            // unless they are on the whitelist
            if (in_array($module, $modInvisList) && !in_array($module, static::$moduleWhiteList)) {
                continue;
            }

            // Add the locked field relationship now
            $object = BeanFactory::getObjectName($module);
            $relName = strtolower($module) . "_locked_fields";
            $linkField = VardefManager::getLinkFieldForRelationship($module, $object, $relName);
            if ($linkField) {
                $name = strtolower($module) . '_locked_fields_link';
                $fields[$name] = array(
                    'name' => $name,
                    'vname' => $module,
                    'type' => 'link',
                    'relationship' => $relName,
                    'source' => 'non-db',
                );
            }
        }

        return $fields;
    }
}
