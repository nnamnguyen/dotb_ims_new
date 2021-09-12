<?php



class LeadsVarDefHandler extends VarDefHandler
{
    /**
     * Overriden to filter legacy pre-5.1 calls and meetings 
     * @see VarDefHandler::get_vardef_array()
     */
    public function get_vardef_array(
        $use_singular = false,
        $remove_dups = false,
        $use_field_name = false,
        $use_field_label = false,
        $visible_only = false,
        $mlink = true
    ) {
        $options_array = parent::get_vardef_array(
            $use_singular,
            $remove_dups,
            $use_field_name,
            $use_field_label,
            $visible_only,
            $mlink
        );
        if ($this->meta_array_name == 'rel_filter')
            unset($options_array['calls_parent'], $options_array['meetings_parent']);
        return $options_array;
    }
}