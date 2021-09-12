<?php



class DotbWidgetFieldparent_type extends DotbWidgetFieldEnum
{
    public function __construct(&$layout_manager)
    {
        parent::__construct($layout_manager);
        $this->reporter = $this->layout_manager->getAttribute('reporter');  
    }
   
    function displayListPlain($layout_def) {
        $value= $this->_get_list_value($layout_def);
        if (isset($layout_def['widget_type']) && $layout_def['widget_type'] =='checkbox') {
            if ($value != '' &&  ($value == 'on' || intval($value) == 1 || $value == 'yes'))  
            {
                return "<input name='checkbox_display' class='checkbox' type='checkbox' disabled='true' checked>";
            }
            return "<input name='checkbox_display' class='checkbox' type='checkbox' disabled='true'>";
        }
        return $value;
    }    
}
