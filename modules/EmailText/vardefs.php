<?php

/**
 * Class for separate storage of Email texts
 */
global $dictionary;
include DotbAutoLoader::existingCustomOne('metadata/emails_beansMetaData.php');
$dictionary['EmailText'] = $dictionary['emails_text'];