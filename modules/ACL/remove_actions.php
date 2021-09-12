<?php


function removeACLActions($current_user, $beanList, $beanFiles, $silent)
{
    $actionarr = ACLAction::getDefaultActions();
    if (is_admin($current_user)) {
        $arr = array();
        foreach ($actionarr as $actionobj) {
            if (empty($actionobj->category)) {
                continue;
            }
            if (!isset($beanList[$actionobj->category]) || !file_exists($beanFiles[$beanList[$actionobj->category]])) {
                if (!isset($_REQUEST['upgradeWizard'])) {
                    if (!in_array($actionobj->category, $arr)) {
                        array_push($arr, $actionobj->category);
                        if (!$silent) {
                            echo 'Removing for ' . $actionobj->category . '<br>';
                        }
                    }
                }
                ACLAction::removeActions($actionobj->category);
            }
        }
    }
}

?>
