<?php
if(!defined('dotbEntry') || !dotbEntry) die('Not A Valid Entry Point');

/**
 * Tab representation
 * @api
 */
class DotbTab
{
    function DotbTab($type='singletabmenu')
    {
        $this->type = $type;
        $this->ss = new Dotb_Smarty();
    }

    function setup($mainTabs, $otherTabs=array(), $subTabs=array(), $selected_group='All')
    {
        global $dotb_version, $dotb_config, $current_user;

        $max_tabs = $current_user->getPreference('max_tabs');
        if(!isset($max_tabs) || $max_tabs <= 0) $max_tabs = $GLOBALS['dotb_config']['default_max_tabs'];

				$key_all = translate('LBL_TABGROUP_ALL');
				if ($selected_group == 'All') {
						$selected_group = $key_all;
				}

        $moreTabs = array_slice($mainTabs,$max_tabs);
        /* If the current tab is in the 'More' menu, move it into the visible menu. */
        if(!empty($moreTabs[$selected_group]))
        {
        	$temp = array($selected_group => $mainTabs[$selected_group]);
            unset($mainTabs[$selected_group]);
            array_splice($mainTabs, $max_tabs-1, 0, $temp);
        }

        $subpanelTitles = array();

        if(isset($otherTabs[$key_all]) && isset($otherTabs[$key_all]['tabs']))
        {
            foreach($otherTabs[$key_all]['tabs'] as $subtab)
            {
                $subpanelTitles[$subtab['key']] = $subtab['label'];
            }
        }

        $this->ss->assign('showLinks', 'false');
        $this->ss->assign('dotbtabs', array_slice($mainTabs, 0, $max_tabs));
        $this->ss->assign('moreMenu', array_slice($mainTabs, $max_tabs));
        $this->ss->assign('othertabs', $otherTabs);
        $this->ss->assign('subpanelTitlesJSON', json_encode($subpanelTitles));
        $this->ss->assign('startSubPanel', $selected_group);
        $this->ss->assign('dotbVersionJsStr', "?s=$dotb_version&c={$dotb_config['js_custom_version']}");
        if(!empty($mainTabs))
        {
            $mtak = array_keys($mainTabs);
            $this->ss->assign('moreTab', $mainTabs[$mtak[min(count($mtak)-1, $max_tabs-1)]]['label']);
        }
    }

    function fetch()
    {
        return $this->ss->fetch('include/SubPanel/tpls/' . $this->type . '.tpl');
    }

    function display()
    {
       $this->ss->display('include/SubPanel/tpls/' . $this->type . '.tpl');
    }
}



?>
