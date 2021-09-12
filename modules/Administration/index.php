<?php

/*********************************************************************************
 * Description: TODO:  To be written.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

global $currentModule;
global $current_language;
global $current_user;
global $dotb_flavor;


if (!$current_user->isDeveloperForAnyModule()) {
    dotb_die("Unauthorized access to administration.");
}

echo getClassicModuleTitle(translate('LBL_MODULE_NAME', 'Administration'),
    array(translate('LBL_MODULE_NAME', 'Administration')), false);

//get the module links..
require('modules/Administration/metadata/adminpaneldefs.php');
global $admin_group_header;  ///variable defined in the file above.


$tab = array();
$header_image = array();
$url = array();
$onclick = array();
$label_tab = array();
$id_tab = array();
$description = array();
$group = array();
$dotb_smarty = new Dotb_Smarty();
$values_3_tab = array();
$admin_group_header_tab = array();
$j = 0;

foreach ($admin_group_header as $key => $values) {
    $module_index = array_keys($values[3]);
    $addedHeaderGroups = array();
    foreach ($module_index as $mod_key => $mod_val) {
        if (
            (in_array($mod_val, $access) || (is_admin($current_user) && ($mod_val == 'Administration')) ||
                $mod_val == 'studio' || ($mod_val == 'Forecasts')) &&
            (!isset($addedHeaderGroups[$values[0]]))) {
            $admin_group_header_tab[] = $values;
            $group_header_value = get_form_header(translate($values[0], 'Administration'), $values[1], $values[2]);
            $group[$j][0] = translate($values[0]);
            $addedHeaderGroups[$values[0]] = 1;
//        	if (isset($values[4]))
//    	       $group[$j][1] = '<tr><td style="padding-top: 3px; padding-bottom: 5px;">' . translate($values[4]) . '</td></tr></table>';
//    	    else
            $group[$j][2] = '</tr></table>';
            $colnum = 0;
            $i = 0;
            $fix = array_keys($values[3]);
            if (count($values[3]) > 1) {
                if (!is_admin($current_user) && isset($values[3]['Administration'])) {
                    unset($values[3]['Administration']);
                }
                if (displayStudioForCurrentUser() == false) {
                    unset($values[3]['studio']);
                }
                if (displayWorkflowForCurrentUser() == false) {
                    unset($values[3]['any']['workflow_management']);
                }

                // Need this check because Quotes and Products share the header group
                if (!in_array('Quotes', $access) && isset($values[3]['Quotes'])) {
                    unset($values[3]['Quotes']);
                }
                if (!in_array('Products', $access) && isset($values[3]['Products'])) {
                    unset($values[3]['Products']);
                }
                // Need this check because Emails and Campaigns share the header group
                if (!in_array('Campaigns', $access) && isset($values[3]['Campaigns'])) {
                    unset($values[3]['Campaigns']);
                }

                //////////////////
                $tmp_array = $values[3];
                $return_array = array();
                foreach ($tmp_array as $mod => $value) {
                    $keys = array_keys($value);
                    foreach ($keys as $key) {
                        $return_array[$key] = $value[$key];
                    }
                }
                $values_3_tab[] = $return_array;
                $mod = $return_array;
            } else {
                $mod = $values[3][$fix[0]];
                $values_3_tab[] = $mod;
            }

            foreach ($mod as $link_idx => $admin_option) {
                if (!empty($GLOBALS['admin_access_control_links']) && in_array($link_idx, $GLOBALS['admin_access_control_links'])) {
                    continue;
                }
                $colnum += 1;
                $header_image[$j][$i] = '<i class="fal fa-' . $admin_option[0] . '"></i>';
                $url[$j][$i] = $admin_option[3];
                if (!empty($admin_option[5])) {
                    $onclick[$j][$i] = $admin_option[5];
                }
                $target[$j][$i] = !empty($admin_option[6]) ? $admin_option[6] : '_self';
                $label = translate($admin_option[1], 'Administration');
                if (!empty($admin_option['additional_label'])) $label .= ' ' . $admin_option['additional_label'];
                if (!empty($admin_option[4])) {
                    $label = ' <font color="red">' . $label . '</font>';
                }

                $label_tab[$j][$i] = $label;
                $id_tab[$j][$i] = $link_idx;

                $description[$j][$i] = translate($admin_option[2], 'Administration');

                if (($colnum % 2) == 0) {
                    $tab[$j][$i] = ($colnum % 2);
                } else {
                    $tab[$j][$i] = 10;
                }
                $i += 1;
            }

            //if the loop above ends with an odd entry add a blank column.
            if (($colnum % 2) != 0) {
                $tab[$j][$i] = 10;
            }
            $j += 1;
        }
    }
}

$dotb_smarty->assign("VALUES_3_TAB", $values_3_tab);
$dotb_smarty->assign("ADMIN_GROUP_HEADER", $admin_group_header_tab);
$dotb_smarty->assign("GROUP_HEADER", $group);
$dotb_smarty->assign("ITEM_HEADER_IMAGE", $header_image);
$dotb_smarty->assign("ITEM_URL", $url);
$dotb_smarty->assign("ITEM_ONCLICK", $onclick);
$dotb_smarty->assign("ITEM_HEADER_LABEL", $label_tab);
$dotb_smarty->assign("ITEM_DESCRIPTION", $description);
$dotb_smarty->assign("ITEM_TARGET", $target);
$dotb_smarty->assign("COLNUM", $tab);
$dotb_smarty->assign('ID_TAB', $id_tab);

echo $dotb_smarty->fetch('modules/Administration/index.tpl');
?>
