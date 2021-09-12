<?php

 if(!defined('dotbEntry'))define('dotbEntry', true);

setcookie('touchscreen','1', time() + 86400 * 90);

header('Location:index.php?module=Users&action=Login');
