<?php

$fields = array(
    'category_name',
    'discount_price',
    'tax_class',
    'mft_part_num',
    'weight'
);

$dependencies['RevenueLineItems']['read_only_fields'] = array(
    'hooks' => array("edit"),
    //Trigger formula for the dependency. Defaults to 'true'.
    'trigger' => 'true',
    'triggerFields' => array('product_template_name'),
    'onload' => true,
    //Actions is a list of actions to fire when the trigger is true
    'actions' => array(),
);

foreach ($fields as $field) {
    $dependencies['RevenueLineItems']['read_only_fields']['actions'][] = array(
        'name' => 'ReadOnly', //Action type
        //The parameters passed in depend on the action type
        'params' => array(
            'target' => $field,
            'label' => $field . '_label', //normally <field>_label
            'value' => 'not(equal($product_template_name,""))', //Formula
        ),
    );
}

/**
 * This dependency set the commit_stage to the correct value and to read only when the sales stage
 * is Closed Won (include) or Closed Lost (exclude)
 */
$dependencies['RevenueLineItems']['commit_stage_readonly_set_value'] = array(
    'hooks' => array("edit"),
    //Trigger formula for the dependency. Defaults to 'true'.
    'trigger' => 'true',
    'triggerFields' => array('sales_stage'),
    'onload' => true,
    //Actions is a list of actions to fire when the trigger is true
    'actions' => array(
        array(
            'name' => 'ReadOnly', //Action type
            //The parameters passed in depend on the action type
            'params' => array(
                'target' => 'commit_stage',
                'label' => 'commit_stage_label', //normally <field>_label
                'value' => 'isForecastClosed($sales_stage)', //Formula
            ),
        ),
        array(
            'name' => 'SetValue', //Action type
            //The parameters passed in depend on the action type
            'params' => array(
                'target' => 'commit_stage',
                'label' => 'commit_stage_label', //normally <field>_label
                'value' => 'ifElse(isForecastClosedWon($sales_stage), "include",
                    ifElse(isForecastClosedLost($sales_stage), "exclude", $commit_stage))', //Formula
            ),
        )
    ),
);

$dependencies['RevenueLineItems']['set_base_rate'] = array(
    'hooks' => array("edit"),
    //Trigger formula for the dependency. Defaults to 'true'.
    'trigger' => 'true',
    'triggerFields' => array('sales_stage'),
    'onload' => true,
    //Actions is a list of actions to fire when the trigger is true
    'actions' => array(
        array(
            'name' => 'SetValue', //Action type
            //The parameters passed in depend on the action type
            'params' => array(
                'target' => 'base_rate',
                'label' => 'base_rate_lable', //normally <field>_label
                'value' => 'ifElse(isForecastClosed($sales_stage), $base_rate, currencyRate($currency_id))', //Formula
            ),
        )
    )
);

/**
 * This dependency set the best and worst values to equal likely when the sales stage is
 * set to closed won.
 */
$dependencies['RevenueLineItems']['best_worst_sales_stage_read_only'] = array(
    'hooks' => array("edit"),
    //Trigger formula for the dependency. Defaults to 'true'.
    'trigger' => 'true',
    'triggerFields' => array('sales_stage'),
    'onload' => true,
    //Actions is a list of actions to fire when the trigger is true
    'actions' => array(
        array(
            'name' => 'ReadOnly', //Action type
            //The parameters passed in depend on the action type
            'params' => array(
                'target' => 'best_case',
                'label' => 'best_case_label', //normally <field>_label
                'value' => 'isForecastClosed($sales_stage)', //Formula
            ),
        ),
        array(
            'name' => 'ReadOnly', //Action type
            //The parameters passed in depend on the action type
            'params' => array(
                'target' => 'worst_case',
                'label' => 'worst_case_label', //normally <field>_label
                'value' => 'isForecastClosed($sales_stage)', //Formula
            ),
        ),
        array(
            'name' => 'SetValue', //Action type
            //The parameters passed in depend on the action type
            'params' => array(
                'target' => 'best_case',
                'label' => 'best_case_label',
                'value' => 'string(ifElse(isForecastClosed($sales_stage), $likely_case, $best_case))',
            ),
        ),
        array(
            'name' => 'SetValue', //Action type
            //The parameters passed in depend on the action type
            'params' => array(
                'target' => 'worst_case',
                'label' => 'worst_case_label',
                'value' => 'string(ifElse(isForecastClosed($sales_stage), $likely_case, $worst_case))',
            ),
        ),
    )
);

$dependencies['RevenueLineItems']['likely_case_copy_when_closed'] = array(
    'hooks' => array("edit"),
    //Trigger formula for the dependency. Defaults to 'true'.
    'trigger' => 'true',
    'triggerFields' => array('likely_case'),
    'onload' => true,
    //Actions is a list of actions to fire when the trigger is true
    'actions' => array(
        array(
            'name' => 'SetValue', //Action type
            //The parameters passed in depend on the action type
            'params' => array(
                'target' => 'best_case',
                'label' => 'best_case_label',
                'value' => 'string(ifElse(isForecastClosed($sales_stage), $likely_case, $best_case))',
            ),
        ),
        array(
            'name' => 'SetValue', //Action type
            //The parameters passed in depend on the action type
            'params' => array(
                'target' => 'worst_case',
                'label' => 'worst_case_label',
                'value' => 'string(ifElse(isForecastClosed($sales_stage), $likely_case, $worst_case))',
            ),
        ),
    )
);
