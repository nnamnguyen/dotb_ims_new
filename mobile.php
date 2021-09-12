<?php

 if(!defined('dotbEntry'))define('dotbEntry', true);

$_SESSION['isMobile'] = true;
header('Location:index.php?module=Users&action=Login&mobile=1');
?>
