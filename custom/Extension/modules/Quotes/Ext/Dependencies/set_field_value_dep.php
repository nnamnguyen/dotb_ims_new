<?php

$dependencies['Quotes']['quote_stage_dep'] = array(
    'hooks' => array("edit", "view"), //not including save so that the value isn't stored in the DB
    'trigger' => 'equal($parent_type,"Leads")', //Optional, the trigger for the dependency. Defaults to 'true'.
    'triggerFields' => array('parent_type'), //unneeded for this example as its not field triggered
    'onload' => true,
    'actions' => array(
        array(
            'name' => 'SetValue',
            'params' => array(
                'target' => 'quote_stage',
                'value' => 'Quotation'
            )
        ),
    ),
    'notActions' => array(
        array(
            'name' => 'SetValue',
            'params' => array(
                'target' => 'quote_stage',
                'value' => 'UnPaid'
            )
        ),
    )
);