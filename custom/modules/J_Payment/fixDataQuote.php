<?php
$sql_1 = "UPDATE quotes SET parent_type = 'Leads' WHERE parent_type = 'Lead'";
$sql_2 = "UPDATE quotes SET parent_type = 'Contacts' WHERE parent_type = 'Contact'";
$sql_3 = "UPDATE j_paymentdetail SET parent_type = 'Contacts',parent_id = student_id, payment_type = 'Normal'";

$GLOBALS['db']->query($sql_1);
$GLOBALS['db']->query($sql_2);
$GLOBALS['db']->query($sql_3);