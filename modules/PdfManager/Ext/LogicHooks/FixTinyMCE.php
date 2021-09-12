<?php


/**
 * Convert all &amp; back to &. TinyMCE HTML encodes & to &amp;, but this messes with logic
 * operators in smarty templates, causing crashes.
 */
$hook_array['before_save'][] = array(
    1,
    'fixAmp',
    'modules/PdfManager/PdfManagerHooks.php',
    'PdfManagerHooks',
    'fixAmp',
);
