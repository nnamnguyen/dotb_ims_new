<?php

use Dotbcrm\Dotbcrm\Security\Crypto\Blowfish;

class DotbWidgetFieldEncrypt extends DotbWidgetReportField
{
    function queryFilterEquals(&$layout_def)
    {
        $search_value = Blowfish::encode(Blowfish::getKey('encrypt_field'), $layout_def['input_name0']);
        return $this->_get_column_select($layout_def)."='".$GLOBALS['db']->quote($search_value)."'\n";
    }

    function queryFilterNot_Equals_Str(&$layout_def)
    {
        $search_value = Blowfish::encode(Blowfish::getKey('encrypt_field'), $layout_def['input_name0']);
        return $this->_get_column_select($layout_def)."!='".$GLOBALS['db']->quote($search_value)."'\n";
    }

    function displayList($layout_def) {
            return $this->displayListPlain($layout_def);
    }

    function displayListPlain($layout_def) {
            $value= $this->_get_list_value($layout_def);

            $value = Blowfish::decode(Blowfish::getKey('encrypt_field'), $value);
            return $value;
    }
       
}
