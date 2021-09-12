<?php

$viewdefs['TaxRates']['base']['view']['selection-list'] = array(
    'panels' => array(
        array(
            'name' => 'panel_header',
            'label' => 'LBL_PANEL_1',
            'fields' => array(
                array(
                    'name' => 'name',
                    'label' => 'LBL_LIST_NAME',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'value',
                    'label' => 'LBL_TAXRATE',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'date_modified',
                    'label' => 'LBL_DATE_MODIFIED',
                    'enabled' => true,
                    'default' => true,
                    'readonly' => true,
                ),
            ),
        ),
    ),
);
