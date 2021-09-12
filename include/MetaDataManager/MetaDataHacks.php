<?php

/**
 * Assists in modifying the Metadata in places that the core cannot handle at this time.
 *
 */
class MetaDataHacks
{
    /**
     * The DotbFieldHandler
     *
     * @var DotbFieldHandler
     */
    protected $sfh;

    /**
     * Fix the ACLs for non-db fields that actually do need ACLs for
     *
     * @param  array $fieldsAcls array of fields that have ACLs
     * @return array Array of fixed ACL's
     */
    public function fixAcls(array $fieldsAcls)
    {
        return $fieldsAcls;
    }

    /**
     * Relate fields are weird.
     * We need to set the type ot what the
     * field type really is not relate.
     *
     * @param  array $fieldDefs
     * @return array $fieldDefs
     */
    public function fixRelateFields(array $fieldDefs)
    {
        if (empty($fieldDefs)) {
            return $fieldDefs;
        }

        foreach ($fieldDefs as $name => &$fieldDef) {
            if ($fieldDef['type'] == 'relate' && (substr($name, -3) == '_id')) {
                $fieldDef['type'] = 'id';
            }
        }

        return $fieldDefs;
    }

    /**
     * Cleans field def default values before returning them as a member of the
     * metadata response payload
     *
     * Bug 56505
     * Cleans default value of fields to strip out metacharacters used by the app.
     * Used initially for cleaning default multienum values.
     *
     * @param  array $fielddefs
     * @return array
     */
    public function normalizeFieldDefs(array $defs)
    {
        $this->getDotbFieldHandler();

        foreach ($defs['fields'] as $name => $def) {
            if (isset($def['type'])) {
                $type = !empty($def['custom_type']) ? $def['custom_type'] : $def['type'];

                $field = $this->sfh->getDotbField($type);

                $defs['fields'][$name] = $field->getNormalizedDefs($def, $defs);
            }
        }

        return $defs['fields'];
    }

    /**
     * Gets the DotbFieldHandler object
     *
     * @return DotbFieldHandler The DotbFieldHandler
     */
    protected function getDotbFieldHandler()
    {
        if (empty($this->sfh)) {
            $this->sfh = new DotbFieldHandler;
        }

        return $this->sfh;
    }
}
