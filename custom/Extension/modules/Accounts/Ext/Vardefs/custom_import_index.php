<?php

$dictionary['Account']['indices'][] = array(
    'name' => 'idx_phone_office_cstm',
    'type' => 'index',
    'fields' => array(
        0 => 'phone_office',
    ),
    'source' => 'non-db',
);