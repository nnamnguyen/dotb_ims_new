<?php

 //format '<action_name>' => '<view_name>',
 $action_view_map = array(
 						'index' => 'main',
 						'module'=>'module',
 						'modulefields'=>'modulefields',
 						'modulelabels'=>'modulelabels',
 						'relationships'=>'relationships',
 						'relationship'=>'relationship',
                        'resetmodule'=>'resetmodule',
 						'modulefield'=>'modulefield',
 						'displaydeploy'=>'displaydeploy',
 						'package'=>'package',
 						'dropdown'=>'dropdown',
 						'dropdowns'=>'dropdowns',
 						'detailview' => 'detail',
 						'editview' => 'edit',
 						'popup' => 'popup',
 						'home'=>'home',
                        'visibilityeditor' => 'visibilityeditor',
 						'exportcustomizations'=>'exportcustomizations',
                        'depdropdown' => 'depdropdown',
                        'roledropdownfilter' => 'roledropdownfilter',
 						'portalstyle' => 'portalstyle',
 						'portalpreview' => 'portalpreview',
 						'portalsync' => 'portalsync',
 						'portalstylesave' => 'portalstylesave',
                        'portalconfig' => 'portalconfig',
                        'portaltheme' => 'portaltheme',

 					);
    // add those we need from the global action_view_map
    $action_view_map['dc'] = 'dc';
    $action_view_map['dcajax'] = 'dcajax';
    $action_view_map['quick'] = 'quick';
    $action_view_map['quickcreate'] = 'quickcreate';
    $action_view_map['spot'] = 'spot';
    $action_view_map['inlinefield'] = 'inlinefield';
    $action_view_map['inlinefieldsave'] = 'inlinefieldsave';
    $action_view_map['pluginlist'] = 'plugins';
    $action_view_map['downloadplugin'] = 'downloadplugin';
?>
