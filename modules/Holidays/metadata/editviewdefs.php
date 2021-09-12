<?php
    if(!defined('dotbEntry') || !dotbEntry) die('Not A Valid Entry Point');

    $viewdefs['Holidays']['EditView'] = array(
        'templateMeta' => array(
            'form' =>
            array (
                'hidden' =>
                array (
                    1 => '<link rel="stylesheet" href="{dotb_getjspath file="custom/include/javascript/MultiDatesPicker/css/jquery-ui.theme.css"}"/>',
                ),
            ),
            'maxColumns' => '2',
            'widths' => array(
                array('label' => '10', 'field' => '30'),
                array('label' => '10', 'field' => '30')
            ),
            'javascript' => '{dotb_getscript file="modules/Holidays/js/quickcreate.js"}',
        ),
        'panels' =>array (
            'default' =>
            array (
                array (

                    array (
                        'name' => 'public_holiday',
                        'label' => 'LBL_PUBLIC_HOLIDAY',
                        'customCode' => '<input type="hidden" name="public_holiday" id="public_holiday" value="{$fields.public_holiday.value}"><div id="full_year" class="box"></div>'
                    ),
                ),

                array (

                    array (
                        'name' => 'holidays_range',
                        'customCode' => '<input type="text" name="holidays_range" id="holidays_range" size="50" maxlength="100" value=""><div id="date-range12-container" style="display: block;"></div>',
                    ),
                ),

                array (

                    array (
                        'name' => 'type',
                    ),
                ),
                array (

                    array (
                        'name' => 'apply_for',
                        'label' => 'LBL_APPLY_FOR',
                    ),
                ),
                array (
                    array (
                        'name' => 'description',
                    ),
                ),
            ),
        )


    );
?>