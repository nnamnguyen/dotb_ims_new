<?php

global $current_user;
$data = array();
$queries = array(
    'amounts'=>array(
        'Possible'=>'SELECT sum(amount) val FROM opportunities where sales_stage NOT IN (\'Closed Lost\') and deleted=0',
        'Committed'=>'SELECT sum(amount) val FROM opportunities where sales_stage = \'Closed Won\' and deleted=0',
        'Average'=>'SELECT AVG(amount) val FROM opportunities where sales_stage = \'Closed Won\' and deleted=0',
    ),
    'counts'=>array(
        'New Deals'=>'SELECT count(id) val FROM opportunities where sales_stage = \'Prospecting\' and deleted=0',
        'Closed Won Deals'=>'SELECT count(id) val FROM opportunities where sales_stage = (\'Closed Won\') and deleted=0',
        'Closed Lost Deals'=>'SELECT count(id) val FROM opportunities where sales_stage = (\'Closed Lost\') and deleted=0',
        'Total Deals'=>'SELECT count(id) val FROM opportunities where deleted=0',
    )
);

$styles = array(
    'amounts'=>array(
        'Average'=>'',
        'Possible'=>'blue',
        'Committed'=>'green',
    ),
    'counts'=>array(
        'Total Deals'=>'',
        'New Deals'=>'blue',
        'Open Deals'=>'yellow',
        'Closed Won Deals'=>'green',
        'Closed Lost Deals'=>'red',
    )
);

foreach ($queries as $catname => $catQueries) {
    foreach ($catQueries as $queryName => $query) {
        $result = $GLOBALS['db']->query($query);
        while($row = $GLOBALS['db']->fetchByAssoc($result)){
            if(isset($row['val'])) {
                if ($catname == 'amounts') {
                    $row['val'] = '$'.number_format($row['val']);
                }
                $row['label'] = $queryName;
                $row['style'] = $styles[$catname][$queryName];
                $data[$catname][] = $row;
            }
        }
    }
}
