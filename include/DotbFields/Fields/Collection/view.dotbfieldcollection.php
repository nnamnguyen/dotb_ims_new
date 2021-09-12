<?php

$view = new ViewDotbFieldCollection();
$view->setup();
$view->process();
$view->init_tpl();
echo $view->display();
?>