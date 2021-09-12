<?php
/**
 * Create By: Hiếu Phạm
 * DateTime: 7:17 PM 14/05/2019
 * To:
 */

if (!defined('dotbEntry') || !dotbEntry) die('Not A Valid Entry Point');

require_once 'include/generic/DotbWidgets/DotbWidgetFieldvarchar.php';

class DotbWidgetFieldAudio extends DotbWidgetFieldVarchar
{
    function DotbWidgetFieldText(&$layout_manager)
    {
        parent::DotbWidgetFieldVarchar($layout_manager);
    }

    function queryFilterEquals($layout_def)
    {
        return $this->reporter->db->convert($this->_get_column_select($layout_def), "text2char") .
            " = " . $this->reporter->db->quoted($layout_def['input_name0']);
    }

    function queryFilterNot_Equals_Str($layout_def)
    {
        $column = $this->_get_column_select($layout_def);
        return "($column IS NULL OR " . $this->reporter->db->convert($column, "text2char") . " != " .
            $this->reporter->db->quoted($layout_def['input_name0']) . ")";
    }

    function queryFilterNot_Empty($layout_def)
    {
        $column = $this->_get_column_select($layout_def);
        return "($column IS NOT NULL AND " . $this->reporter->db->convert($column, "length") . " > 0)";
    }

    function queryFilterEmpty($layout_def)
    {
        $column = $this->_get_column_select($layout_def);
        return "($column IS NULL OR " . $this->reporter->db->convert($column, "length") . " = 0)";
    }

    function displayList($layout_def)
    {
        return nl2br(parent::displayListPlain($layout_def));
    }
}

?>