<?php

 
$_SESSION['MAILMERGE_MODULE_FROM_LISTVIEW'] = 'Campaigns';
$_SESSION['MAILMERGE_MODULE'] = 'Campaigns'; 
$_SESSION['MAILMERGE_RECORDS'] = array($_REQUEST['record']);
header('Location: index.php?module=MailMerge&action=index'); 
?>
