<?php


if($_REQUEST['submodule'] == 'Roles'){
	require_once('modules/ACL/Roles/ListView.php');
}
if($_REQUEST['submodule'] == 'Users'){
	require_once('modules/ACL/Roles/ListUsers.php');
}

?>