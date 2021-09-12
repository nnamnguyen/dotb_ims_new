<?php


class DotbWidgetFieldFullname extends DotbWidgetFieldName
{
    function displayListPlain($layout_def)
    {
        $module = $this->reporter->all_fields[$layout_def['column_key']]['module'];
        $fields = $this->reporter->createNameList($layout_def['table_key']);
        if(empty($fields)) {
            return '';
        }
        $data = array();
        foreach($fields as $field) {
            $field['fields'] = $layout_def['fields'];
            $data[$field['name']] = $this->_get_list_value($field);
        }
        return $GLOBALS['locale']->formatName($module, $data);
    }
}
