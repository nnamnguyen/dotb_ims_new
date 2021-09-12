<?php
//FILE DOTBCRM flav=ent


$module_name = 'Contacts';
$viewdefs[$module_name]['portal']['menu']['quickcreate'] = array(
    //Disabled in Portal by default
    'visible' => false,
    //Included in case quick create for Contacts becomes enabled later
    'layout' => 'create',
    'label' => 'LNK_NEW_CONTACT',
    'order' => 1,
    'icon' => 'fa-plus',
);
