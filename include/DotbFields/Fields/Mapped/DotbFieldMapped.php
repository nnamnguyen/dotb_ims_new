<?php




/**
 * Class DotbFieldMapped
 * For use on fields such as tag_lower, which need to be on the database,
 * but whose values will always be dependent on another field
 *
 * In the vardef for a mapped field, two additional properties besides 'type' => 'mapped'
 * must be defined:
 *  'parentField' => The field type that this field is based on
 *  'mapFunction' => A function that is defined on the parentField's type that performs the mapping
 */
class DotbFieldMapped extends DotbFieldBase
{
    /**
     * Override of parent apiSave to force the custom save to be run from API
     * @param DotbBean $bean
     * @param array     $params
     * @param string    $field
     * @param array     $properties
     */
    public function apiSave(DotbBean $bean, array $params, $field, $properties) {
        // Mapped fields needs to have something to map from.
        if (empty($properties['mapFunction']) || empty($properties['parentField'])) {
            return;
        }

        // First make sure the parent field exists on this bean
        if (isset($bean->field_defs[$properties['parentField']])) {
            $sfh = new DotbFieldHandler();
            $sf = $sfh->getDotbField($bean->field_defs[$properties['parentField']]['type']);
            if (method_exists($sf, $properties['mapFunction'])) {
                $bean->{$field} = $sf->{$properties['mapFunction']}($bean->{$properties['parentField']});
            }
        }
    }
}
