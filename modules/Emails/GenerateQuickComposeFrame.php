<?php


/**
 * Render the quick compose frame needed by the UI.  The data is returned as a JSOn
 * object and consumed by the client in an ajax call.
 */

$em = new EmailUI();
$out = $em->displayQuickComposeEmailFrame();
		
@ob_end_clean();
ob_start();
echo $out;
ob_end_flush();