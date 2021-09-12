<?php

/**
 * This dependency sets the status field to read only if the lead has been converted.
 */
$dependencies['Leads']['status_read_only'] = array(
    'hooks' => array("edit"),
    //Trigger formula for the dependency. Defaults to 'true'.
    'trigger' => 'true',
    'triggerFields' => array('converted'),
    'onload' => true,
    //Actions is a list of actions to fire when the trigger is true
    'actions' => array(
        array(
            'name' => 'ReadOnly', //Action type
            //The parameters passed in depend on the action type
            'params' => array(
                'target' => 'status',
                'label' => 'status_label', //normally <field>_label
                'value' => 'equal($converted,"true")',
            ),
        ),
    ),
);
