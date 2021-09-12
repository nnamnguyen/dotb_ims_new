<?php


class DotbWidgetFieldText extends DotbWidgetFieldVarchar
{
    function queryFilterEquals($layout_def)
    {
        return $this->reporter->db->convert($this->_get_column_select($layout_def), "text2char").
        	" = ".$this->reporter->db->quoted($layout_def['input_name0']);
    }

    function queryFilterNot_Equals_Str($layout_def)
    {
        $column = $this->_get_column_select($layout_def);
        return "($column IS NULL OR ". $this->reporter->db->convert($column, "text2char")." != ".
            $this->reporter->db->quoted($layout_def['input_name0']).")";
    }

    function queryFilterNot_Empty($layout_def)
    {
        $column = $this->_get_column_select($layout_def);
        //return "($column IS NOT NULL AND ".$this->reporter->db->convert($column, "length")." > 0)";
        return " ( 1=1 )\n";
    }

    function queryFilterEmpty($layout_def)
    {
        $column = $this->_get_column_select($layout_def);
        return "($column IS NULL OR ".$this->reporter->db->convert($column, "length")." = 0)";
    }
	
    function displayList($layout_def) {
        return nl2br(parent::displayListPlain($layout_def));
    }
}
