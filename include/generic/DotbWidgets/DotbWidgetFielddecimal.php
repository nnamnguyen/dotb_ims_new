<?php



class DotbWidgetFieldDecimal extends DotbWidgetFieldInt
{
    function displayListPlain($layout_def)
    {

        //Bug40995
        if(!empty($layout_def['precision']))
        {
            return format_number(parent::displayListPlain($layout_def), $layout_def['precision'], $layout_def['precision']);
        }
        //Bug40995
        else{
            //Add format user - Edit By Lap Nguyen
            $vardef = $this->getVardef($layout_def);
            $precision = $vardef['precision'];
            if ( !isset($precision) ) $precision = 2;
            return format_number(parent::displayListPlain($layout_def), $precision, $precision);
        }
    }
}

?>
