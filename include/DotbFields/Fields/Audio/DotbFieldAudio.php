<?php
/**
 * Create By: Hiếu Phạm
 * DateTime: 7:14 PM 14/05/2019
 * To:
 */

require_once 'include/DotbFields/Fields/Base/DotbFieldBase.php';
require_once 'data/DotbBean.php';

class DotbFieldAudio extends DotbFieldBase
{
    //this function is called to format the field before saving.  For example we could put code in here
    // to check spelling or to change the case of all the letters
    public function save(&$bean, $params, $field, $properties, $prefix = '')
    {
        $GLOBALS['log']->debug("DotbFieldAudio::save() function called.");
        parent::save($bean, $params, $field, $properties, $prefix);
    }
}
?>