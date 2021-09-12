<?php

if(isset($_REQUEST['record']) && !empty($_REQUEST['record'])) {
	BeanFactory::deleteBean('Groups', $_REQUEST['record']);
}

header("Location: index.php?module=Groups&action=index");
