<?php

$viewdefs['Opportunities']['base']['layout']['create-preview'] = array(
    'components' => array(
        array(
            'view' => 'product-catalog',
            'context' => array(
                'module' => 'Quotes',
            ),
        ),
    ),
);
