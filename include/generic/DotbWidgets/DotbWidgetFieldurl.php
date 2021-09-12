<?php


class DotbWidgetFieldURL extends DotbWidgetFieldVarchar
{
 	/* Display item as link
     * @param array $layout_def definition of field which we want to display as link
     * @return string html code
     */
    function displayList($layout_def) 
    {
        $urlValue = trim($this->_get_list_value($layout_def));
        return '<a target="_blank" href="' . $urlValue . '">' . $urlValue . "</a>";
    }
    
}
