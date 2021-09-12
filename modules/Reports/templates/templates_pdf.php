<?php

require_once("include/Dotbpdf/dotbpdf_config.php");
if ( !headers_sent() ) {
    ini_set('zlib.output_compression', 'Off');
}
if (PDF_CLASS == "EZPDF" && file_exists('modules/Reports/templates/templates_ezpdf.php')) {
    require_once('modules/Reports/templates/templates_ezpdf.php');
}else{
    require_once('modules/Reports/templates/templates_tcpdf.php');
}
