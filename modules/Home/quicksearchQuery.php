<?php


DotbAutoLoader::requireWithCustom('modules/Home/QuickSearch.php');
if(class_exists('quicksearchQueryCustom')) {
    $quicksearchQuery = new quicksearchQueryCustom();
}
else
{
    $quicksearchQuery = new QuickSearchQuery();
}

$json = getJSONobj();
$data = $json->decode(html_entity_decode($_REQUEST['data']));
if(isset($_REQUEST['query']) && !empty($_REQUEST['query'])){
    foreach($data['conditions'] as $k=>$v){
        if (empty($data['conditions'][$k]['value'])
        && ($data['conditions'][$k]['op'] != QuickSearchQuery::CONDITION_EQUAL)) {
            $data['conditions'][$k]['value']=urldecode($_REQUEST['query']);
        }
    }
}
//
//$method = !empty($data['method']) ? $data['method'] : 'query';
//if (is_callable(array($quicksearchQuery, $method))) {
//    echo $quicksearchQuery->$method($data);
//}
//Custom query SQS Team - Lap Nguyen
if(array_search("Teams",$data['modules']) > -1){
    echo $quicksearchQuery->get_non_private_teams_array($data);   
}else{
    $method = !empty($data['method']) ? $data['method'] : 'query';
    if (is_callable(array($quicksearchQuery, $method))) {
        echo $quicksearchQuery->$method($data);
    }  
}
//END