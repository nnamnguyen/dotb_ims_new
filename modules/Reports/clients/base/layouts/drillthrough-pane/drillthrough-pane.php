<?php



$viewdefs['Reports']['base']['layout']['drillthrough-pane'] = array(
    'name' => 'drillthrough-pane',
    'css_class' => 'dashboard drillthrough-pane',
    'components' => array(
        array(
            'view' => array(
                'name' => 'drillthrough-pane-headerpane',
                'template' => 'headerpane',
                'fields' => array(
                    array(
                        'name' => 'title',
                        'type' => 'text',
                    ),
                ),
                'buttons' => array(
                    array(
                        'type' => 'button',
                        'icon' => 'fa-refresh',
                        'css_class' => 'btn',
                        'tooltip' => 'LBL_REFRESH_LIST_AND_CHART',
                        'events' => array(
                            'click' => 'click:refresh_list_chart',
                        ),
                    ),
                ),
            ),
        ),
    ),
);
