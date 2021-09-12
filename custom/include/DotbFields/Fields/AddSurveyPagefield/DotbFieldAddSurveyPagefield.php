<?php

/**
 * The file used to created custom filed AddSurveyPagefield
 *
 * LICENSE: The contents of this file are subject to the license agreement ("License") which is included
 * in the installation package (LICENSE.txt). By installing or using this file, you have unconditionally
 * agreed to the terms and conditions of the License, and you may not use this file except in compliance
 * with the License.
 *
 * @author     Biztech Consultancy
 */
require_once('include/DotbFields/Fields/Base/DotbFieldBase.php');
require_once('data/DotbBean.php');

class DotbFieldAddSurveyPagefield extends DotbFieldBase {

    //this function is called to format the field before saving.  For example we could put code in here
    // to check spelling or to change the case of all the letters

    public function save($bean, $params, $field, $properties, $prefix = '') {
        $GLOBALS['log']->debug("DotbFieldAddSurveyPagefield::save() function called.");
        parent::save($bean, $params, $field, $properties, $prefix);
    }

}
?>