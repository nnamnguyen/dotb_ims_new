<?php


/*********************************************************************************
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

$viewdefs['ProductTemplates']['mobile']['view']['list'] = array(
    'panels' => array(
        array(
            'label' => 'LBL_PANEL_DEFAULT',
            'fields' => array(
                'name',
                'type_name',
                'category_name',
                'status',
                'qty_in_stock',
                'cost_price',
                'list_price',
                'discount_price',
            ),
        ),
    ),
);
