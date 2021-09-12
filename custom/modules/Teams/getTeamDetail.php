<?php
include_once("custom/modules/Teams/_helper.php");
if (!empty($_POST['team_id']) && isset($_POST['team_id']))
    echo json_encode(getTeamDetail($_POST['team_id'], $_POST['show_type']));
else
    echo json_encode(array("success" => "0",));

?>
