<?php
/**
 * Create By: HP
 * DateTime: 7:05 PM 14/05/2019
 * To: Creating the Form Controller for audio field
 */

if (!defined('dotbEntry') || !dotbEntry) die('Not A Valid Entry Point');

require_once 'custom/modules/DynamicFields/templates/Fields/TemplateAudio.php';

function get_body(&$ss, $vardef)
{
    global $app_list_strings, $mod_strings;
    $vars = $ss->get_template_vars();
    $fields = $vars['module']->mbvardefs->vardefs['fields'];
    $fieldOptions = array();
    foreach ($fields as $id => $def) {
        $fieldOptions[$id] = $def['name'];
    }
    $ss->assign('fieldOpts', $fieldOptions);

    //If there are no colors defined, use black text on
    // a white background
    if (isset($vardef['audioType'])) {
        $audioType = $vardef['audioType'];
    } else {
        $audioType = 'audio/ogg';
    }

    $ss->assign('AUDIOTYPE', $audioType);

    return $ss->fetch('custom/modules/DynamicFields/templates/Fields/Forms/Audio.tpl');
}
?>