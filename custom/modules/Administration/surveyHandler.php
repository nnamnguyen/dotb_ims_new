<?php

/**
 * The file used to manage actions for Survey Rocket views 
 *
 * LICENSE: The contents of this file are subject to the license agreement ("License") which is included
 * in the installation package (LICENSE.txt). By installing or using this file, you have unconditionally
 * agreed to the terms and conditions of the License, and you may not use this file except in compliance
 * with the License.
 *
 * @author     Biztech Consultancy
 */
require_once 'custom/biz/classes/Surveycontroller.php';
$oSurveycontroller = new Surveycontroller();
 if (isset($_REQUEST['main_method'])) {
    if ($_REQUEST['main_method'] == 'outfitters_license') {
        $oSurveycontroller->outfitters_license();
    }
} else {
    echo 'not valid action';
}




