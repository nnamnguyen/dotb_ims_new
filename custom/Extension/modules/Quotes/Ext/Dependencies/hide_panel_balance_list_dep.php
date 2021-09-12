<?php

//$dependencies['Quotes']['hide_panel_balance_list_dep'] = array(
//    'hooks' => array("edit","view"),
////    'trigger' => 'and(and(equal($parent_type,"Contacts"),equal($quote_stage,"UnPaid")),equal($use_free_balance,"0"))',
//    'trigger' =>'and($visible_list_balance_panel,and(equal($parent_type,"Contacts"),equal($quote_stage,"UnPaid")))',
//    'triggerFields' => array('parent_type','quote_stage','visible_list_balance_panel'),
//    'onload' => true,
//    //Actions is a list of actions to fire when the trigger is true
//    'actions' => array(
//        array(
//            'name' => 'SetPanelVisibility',
//            'params' => array(
//                'target' => 'panel_list_balance',
//                'value' => 'true',
//            ),
//        )
//    ),
//    //notActions is a list of actions to fire when the trigger is false
//    'notActions' => array(
//        array(
//            'name' => 'SetPanelVisibility',
//            'params' => array(
//                'target' => 'panel_list_balance',
//                'value' => 'false',
//            ),
//        ),
//    ),
//);