<?php
$q1 = "SELECT IFNULL(c_sitedeployment.id, '') site_id
, IFNULL(c_sitedeployment.name, '') site_name
, IFNULL(c_sitedeployment.protocol, 'http') protocol
, IFNULL(l1.name, '') account_name
, IFNULL(l1.picture, '') account_avatar
FROM c_sitedeployment
INNER JOIN accounts l1 ON c_sitedeployment.parent_id = l1.id
AND c_sitedeployment.parent_type = 'Accounts' AND l1.deleted = 0
WHERE c_sitedeployment.deleted = 0";

$result1 = $GLOBALS['db']->query($q1);
$siteList = array();
while ($row = $GLOBALS['db']->fetchByAssoc($result1)) {
    $siteList[$row['site_id']]['site_id']         = $row['site_id'];
    $siteList[$row['site_id']]['site_name']       = $row['site_name'];
    $siteList[$row['site_id']]['site_url']        = $row['protocol'] . "://" . $row['site_name'];
    $siteList[$row['site_id']]['account_name']    = $row['account_name'];
    $siteList[$row['site_id']]['account_avatar']  = $row['account_avatar'];
}
$siteList = array_values($siteList);
echo json_encode($siteList, JSON_UNESCAPED_UNICODE);
return;
?>