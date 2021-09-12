<?php



$dashletData['PipelineBySalesStageDashlet']['searchFields'] = array(
        'pbss_date_start' => array(
                'name'  => 'pbss_date_start',
                'vname' => 'LBL_CLOSE_DATE_START',
                'type'  => 'datepicker',
            ),

        'pbss_chart_type' => array(
                'name'  => 'pbss_chart_type',
                'vname' => 'LBL_CHART_TYPE',
                'type'  => 'singleenum',
            ),
        'pbss_date_end' => array(
                'name'  => 'pbss_date_end',
                'vname' => 'LBL_CLOSE_DATE_END',
                'type'  => 'datepicker',
            ),
        'pbss_sales_stages' => array(
                'name'  => 'pbss_sales_stages',
                'vname' => 'LBL_SALES_STAGES',
                'type'  => 'enum',
            ),
        );
?>
