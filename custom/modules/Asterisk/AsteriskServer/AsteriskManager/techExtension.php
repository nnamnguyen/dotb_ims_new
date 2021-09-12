<?php
exit;
include_once('../../../../../config.php');
include('logger.php');
global $current_user;

//Database initialization
$sqlcon = mysql_connect($dotb_config['dbconfig']['db_host_name'],$dotb_config['dbconfig']['db_user_name'],$dotb_config['dbconfig']['db_password']);
$sqldb  = mysql_select_db($dotb_config['dbconfig']['db_name'],$sqlcon);
echo "Database initialization.<br>";
output('info','Database initialization.');
//Variable Received through PHP URL
$SourceNumber       = null;
$DestinationNumber  = null;
$TeamID             = null;
$TeamSetId          = null;
$CreatedCallID      = null;
$CRMUserID          = null;
$AccountID          = null;
$ParentAccount      = null;
$ParentID           = null;
$LeadID             = null;
$ContactID          = null;
$AsteriskExtension  = $_GET['e'];
$AsteriskUidd       = $_GET['id'];
$StartDate          = $_GET['st'];
$DurationInSec      = $_GET['du'];
$Caller_No          = $_GET['c'];
$direction          = $_GET['di'];
$CallRecordLink     = $_GET['rl'];

$st = $_GET['st'];
$at = $_GET['at'];
$et = $_GET['et'];
$StartDate = $_GET['st'];
$calldispo = $_GET['calldispo'];

//$StartDate=date("Y-m-d H:i:s");
output('info','Received command from  Asterisk Connector to make an call entry');
output('debug','Detail received from  Asterisk Connector : Extension: '.$AsteriskExtension.' Date: '.$StartDate.'Call Duration : '.$DurationInSec.'Caller Number : '.$Caller_No.' Direction : '.$direction.' Record Link : '.$CallRecordLink.' Asterisk Unique ID : '.$AsteriskUidd);
echo "<br>Variable Received through PHP URL<br>";

//Gathering Call entry information
echo "<br>Gathering Call entry information<br>";

//Formating Call Duration and status.
echo "<br>Formating Call Duration and status.<br>";
$CallDurationMinuteSec  = null;
$CallStatus             = null;
$CallSubject            = null;

//Searching newly created
$searchQuery    = "SELECT id FROM calls WHERE outlook_id = '$AsteriskUidd' AND deleted = 0 ORDER BY date_entered DESC LIMIT 1";
$ResultSetUser  = mysql_query($searchQuery,$sqlcon);

$searchQuery="select id from calls where calls.name='".$CallSubject."'and date_start=SUBTIME( DATE_FORMAT('".$StartDate."','%Y-%m-%d %H:%i:%s' ),'7:00:0') and calls.direction='".$direction."' and calls.status='".$CallStatus." ' and calls.created_by='".$CRMUserID."' and calls.outlook_id='".$AsteriskUidd."' and calls.assigned_user_id ='".$CRMUserID."' and deleted=0 order by date_entered desc limit 1";
echo '<br> Search Query for CallID : '.$searchQuery.'<br>';

if(mysql_num_rows($ResultSetUser)){
    $row = mysql_fetch_assoc($ResultSetUser);
    $CreatedCallID = $row['id'];

    output('info','Call has been found in the crm with the call id :'.$CreatedCallID);
    echo "<br>Call has been found in the crm with the call id :".$CreatedCallID. "<br>";
}
if($CreatedCallID == null){
    echo "<br>Call:".$AsteriskUidd." not found. <br>";
    output('info',"Call:".$AsteriskUidd." not found.");
    exit;
}

if($DurationInSec == 0){
    $CallDurationMinuteSec  = '0.0';
    $CallStatus             = 'Missed';
}elseif($DurationInSec<3599){
    $CallDurationMinuteSec  = gmdate("i.s", $DurationInSec);
    $CallStatus             = 'Held';
}else{
    $CallDurationMinuteSec  = gmdate("H.i.s", $DurationInSec);
    $CallStatus             = 'Held';
}
                      //ANSWERED
switch ($calldispo) {
    case 'No':
        $CallStatus = 'NOT HELD';
        break;
    case 'FAILED':
        $CallStatus = 'FAILED';
        break;
    case 'BUSY':
        $CallStatus = 'BUSY';
        break;
    default:
        $CallStatus = 'CONNECTED';
}

//Formating call time and Subject.
echo "<br>Formating call time and Subject.<br>";
echo "<br>Date Recived ".$StartDate."<br>";

$date_in_CRM_format = date('Y-m-d H:i:s',$StartDate);
echo "<br>Formated Date : ".$date_in_CRM_format."<br>";

if( $direction=="Inbound" || $direction=="inbound"){
    $CallSubject        = "Incoming Call from: ".$Caller_No." to: ".$AsteriskExtension;
    $SourceNumber       = $Caller_No;
    $DestinationNumber  = $AsteriskExtension;
    $recordingdirection = "external";
}elseif($direction=="Outbound" || $direction=="outbound"){
    $CallSubject        = "Outgoing Call to: ".$Caller_No." from: ".$AsteriskExtension;
    $SourceNumber       = $AsteriskExtension;
    $DestinationNumber  = $Caller_No;
    $recordingdirection = "out";
}elseif($direction=="internal"){
    exit;
    $CallSubject        = "Internal Call Between: ".$Caller_No." and ".$AsteriskExtension;
    $SourceNumber       = $AsteriskExtension;
    $DestinationNumber  = $Caller_No;
    $recordingdirection = "out";
}else{
    $CallSubject        = "Miss Call to: ".$AsteriskExtension." from: ".$Caller_No."; ".$direction='Inbound';
}
echo "<br>Details prepare for call entry. Subject : ".$CallSubject." Call time according to CRM :".$StartDate."Call duration : ".$CallDurationMinuteSec." Record link : ".$CallRecordLink." Call status :".$CallStatus." <br>";
output('debug',"Details prepare for call entry. Subject : ".$CallSubject." Call time according to CRM :".$StartDate."Call duration : ".$CallDurationMinuteSec." Record link : ".$CallRecordLink." Call status :".$CallStatus." <br>");

//call Recording Formate
$CallRecordLink="http://203.162.56.197/rs_record/";
$format=".gsm";
$recordingdate=substr($st,0,10);
$recordingdate=str_replace("-","/",$recordingdate);

$recod_date=substr($st,0,10);
$recod_date=str_replace("-","",$recod_date);

$recordingtime=substr($st,-8);
$recordingtime=str_replace("-","",$recordingtime);

$CallRecordLink=$CallRecordLink.$recordingdate."/".$recordingdirection.'-'.$DestinationNumber.'-'.$SourceNumber.'-'.$recod_date.'-'.$recordingtime.'-'.$AsteriskUidd.$format;

$qUpdate = "UPDATE calls_cstm SET call_duration_minute_c = '$CallDurationMinuteSec', record_c='$CallRecordLink'";
$retval = mysql_query( $qUpdate, $sqlcon );
if(!$retval){
    echo "<br>Could not enter data: ".mysql_error()."<br>";
    output('info',"Could not enter data: ".mysql_error()."<br>");
}else{
   echo "<br>Update Successfully $AsteriskUidd!<br>";
   output('info',"Update Successfully Call: $AsteriskUidd.");
}

?>
