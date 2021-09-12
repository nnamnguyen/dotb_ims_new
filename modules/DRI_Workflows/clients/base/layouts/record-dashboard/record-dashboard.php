<?php

$viewdefs['DRI_Workflows']['base']['layout']['record-dashboard'] = array(
    'metadata' => array(
        'components' => array(
            array(
                'rows' => array(
                    array(
                        array(
                            'view' => array(
                                'type' => 'dri-customer-journey-dashlet',
                                'label' => 'LBL_DEFAULT_DRI_CUSTOMER_JOURNEY_DASHLET_TITLE',
                            ),
                            'width' => 12,
                        ),
                    ),
                ),
                'width' => 12,
            ),
        ),
    ),
    'name' => 'LBL_DEFAULT_DASHBOARD_TITLE',
);
