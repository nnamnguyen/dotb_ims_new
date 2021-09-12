<?php



DotbRelationshipFactory::rebuildCache();

if (empty ($_REQUEST ['silent'])) {
    echo $mod_strings ['LBL_DONE'];
}
