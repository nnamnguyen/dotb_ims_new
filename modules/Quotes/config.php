<?php

//include any group of products in these stages for the standard pdf template
//Does not need to be translated this is just for the keys
$in_total_group_stages =  $GLOBALS['app_list_strings']['in_total_group_stages'];
$pdf_group_subtotal = true;

if (DotbAutoLoader::existing('custom/modules/Quotes/config.php'))
{
	include_once('custom/modules/Quotes/config.php');
}
