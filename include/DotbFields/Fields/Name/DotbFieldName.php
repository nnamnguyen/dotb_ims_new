<?php

class DotbFieldName extends DotbFieldBase
{
    /**
     * {@inheritdoc}
     */
    public function fixForFilter(&$value, $columnName, DotbBean $bean, DotbQuery $q, DotbQuery_Builder_Where $where, $op)
    {
        $tableAndFieldName = explode('.', $columnName);
        $tableName = $tableAndFieldName[0];
        $fieldName = $tableAndFieldName[1];
        //check to see if this name type field has a 'fields' array defined
        if (!empty($bean->field_defs[$fieldName]) && !empty($bean->field_defs[$fieldName]['fields'])) {
            //iterate through array to create search with concatenated fields
            $conField = $bean->db->concat($tableName, $bean->field_defs[$fieldName]['fields']);
            $likeSql = $bean->db->getLikeSQL($conField, "{$value}%");
            $where->addRaw($likeSql);
            //return false so no further processing is done on this field
            return false;
        }
        return true;
    }
}
