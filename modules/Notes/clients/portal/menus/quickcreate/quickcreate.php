<?php
//FILE DOTBCRM flav=ent


$module_name = 'Notes';
$viewdefs[$module_name]['portal']['menu']['quickcreate'] = array(
    //Disabled in Portal by default
    'visible' => false,
    //Included in case quick create for Notes becomes enabled later
    'layout' => 'create',
    'label' => 'LNK_NEW_NOTE',
    'order' => 9,
    'icon' => 'fa-plus',
);
