<?php

$hook_array['before_save'][] = array (
    1,
    'Leads_LogicHook_DRICustomerJourney::saveFetchedRow',
    'custom/modules/Leads/LogicHook/DRICustomerJourney.php',
    'Leads_LogicHook_DRICustomerJourney',
    'saveFetchedRow'
);

$hook_array['after_save'][] = array (
    1,
    'Leads_LogicHook_DRICustomerJourney::startJourney',
    'custom/modules/Leads/LogicHook/DRICustomerJourney.php',
    'Leads_LogicHook_DRICustomerJourney',
    'startJourney'
);

$hook_array['after_save'][] = array (
    2,
    'Leads_LogicHook_DRICustomerJourney::convertLead',
    'custom/modules/Leads/LogicHook/DRICustomerJourney.php',
    'Leads_LogicHook_DRICustomerJourney',
    'convertLead'
);
