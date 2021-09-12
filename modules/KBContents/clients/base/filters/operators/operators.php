<?php


$viewdefs['KBContents']['base']['filter']['operators'] = array(
    'nestedset' => array(
        '$in' => 'LBL_OPERATOR_IS',
        '$not_in' => 'LBL_OPERATOR_IS_NOT',
        '$empty' => 'LBL_OPERATOR_EMPTY',
        '$not_empty' => 'LBL_OPERATOR_NOT_EMPTY',
    ),
    'htmleditable_tinymce' => array(
        '$contains' => 'LBL_OPERATOR_CONTAINING_THESE_WORDS',
        '$not_contains' => 'LBL_OPERATOR_EXCLUDING_THESE_WORDS',
    ),
);
