<?php


global $current_user, $beanFiles;
if (ini_get('max_execution_time') > 0 && ini_get('max_execution_time') < 3600) {
    ini_set('max_execution_time', 3600);
}

$db = DBManagerFactory::getInstance();

if (is_admin($current_user) || isset ($from_sync_client) || is_admin_for_any_module($current_user)) {
    isset($_REQUEST['execute']) ? $execute = $_REQUEST['execute'] : $execute = false;
    $export = false;

    if (sizeof($_POST) && isset ($_POST['raction'])) {
        if (isset ($_POST['raction']) && strtolower($_POST['raction']) == "export") {
            //jc - output buffering is being used. if we do not clean the output buffer
            //the contents of the buffer up to the length of the repair statement(s)
            //will be saved in the file...
            ob_clean();

            header("Content-Disposition: attachment; filename=repairDotbDB.sql");
            header("Content-Type: text/sql; charset={$app_strings['LBL_CHARSET']}");
            header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
            header("Last-Modified: " . TimeDate::httpTime());
            header("Cache-Control: post-check=0, pre-check=0", false);
            header("Content-Length: " . strlen($_POST['sql']));

            //jc:7347 - for whatever reason, html_entity_decode is choking on converting
            //the html entity &#039; to a single quote, so we will use str_replace
            //instead
            $sql = str_replace('&#039;', "'", $_POST['sql']);
            echo $sql;
        } elseif (isset ($_POST['raction']) && strtolower($_POST['raction']) == "execute") {
            $sql = str_replace(
                array(
                    "\n",
                    '&#039;',
                ),
                array(
                    '',
                    "'",
                ),
                preg_replace('#(/\*.+?\*/\n*)#', '', $_POST['sql'])
            );
            foreach (explode(";", $sql) as $stmt) {
                $stmt = trim($stmt);

                if (!empty ($stmt)) {
                    $db->query($stmt, true, 'Executing repair query: ');
                }
            }

            echo "<h3>{$mod_strings['LBL_REPAIR_DATABASE_SYNCED']}</h3>";
        }
    } else {

        if (!$export && empty ($_REQUEST['repair_silent'])) {
            if (empty($hideModuleMenu))
                echo getClassicModuleTitle($mod_strings['LBL_REPAIR_DATABASE'], array($mod_strings['LBL_REPAIR_DATABASE']), true);
            echo "<h1 id=\"rdloading\">{$mod_strings['LBL_REPAIR_DATABASE_PROCESSING']}</h1>";
            ob_flush();
        }

        $sql = '';

        VardefManager::clearVardef();
        $repairedTables = array();

        $db->setOption('skip_index_rebuild', true);
        $indices = $db->get_schema_indices();

        foreach ($beanFiles as $bean => $file) {
            if (file_exists($file)) {
                require_once($file);
                unset($GLOBALS['dictionary'][$bean]);
                $focus = BeanFactory::newBeanByName($bean);
                if ($focus instanceof DotbBean) {
                    $tableName = $focus->getTableName();
                    // Not all Beans are table based, so we need to check if there
                    // is a table_name for this bean before proceeding
                    // Example Beans are MergeRecord and EmptyBean
                    if ($tableName && !isset($repairedTables[$tableName])) {
                        $tableExists = $db->tableExists($tableName);
                        $sql .= $db->repairTable($focus, $execute);
                        // repair table indices only in case if the table previously existed, otherwise the table
                        // has already been created with indices despite skip_index_rebuild
                        if ($tableExists) {
                            $compareIndices = isset($indices[$tableName]) ? $indices[$tableName] : array();
                            $sql .= $db->alterTableIndices(
                                $tableName,
                                $focus->getFieldDefinitions(),
                                $focus->getIndices(),
                                $compareIndices,
                                $execute
                            );
                        }
                        $repairedTables[$focus->table_name] = true;
                    }
                }
                //Repair Custom Fields
                if (($focus instanceof DotbBean) && $focus->hasCustomFields() && !isset($repairedTables[$focus->table_name . '_cstm'])) {
                    $df = new DynamicField($focus->module_dir);
                    //Need to check if the method exists as during upgrade an old version of Dynamic Fields may be loaded.
                    if (method_exists($df, "repairCustomFields")) {
                        $df->bean = $focus;
                        $sql .= $df->repairCustomFields($execute);
                        $repairedTables[$focus->table_name . '_cstm'] = true;
                    }
                }
            }
        }

        $olddictionary = $dictionary;

        unset ($dictionary);
        include('modules/TableDictionary.php');

        foreach ($dictionary as $meta) {

            if (empty($meta['table']) || isset($repairedTables[$meta['table']])) {
                continue;
            }

            $tablename = $meta['table'];
            $fielddefs = $meta['fields'];
            $indices = isset($meta['indices']) ? $meta['indices'] : [];
            $engine = isset($meta['engine']) ? $meta['engine'] : null;
            $sql .= $db->repairTableParams($tablename, $fielddefs, $indices, $execute, $engine);
            $repairedTables[$tablename] = true;
        }

        $dictionary = $olddictionary;


        if (empty ($_REQUEST['repair_silent'])) {
            echo "<script type=\"text/javascript\">document.getElementById('rdloading').style.display = \"none\";</script>";

            if (isset ($sql) && !empty ($sql)) {

                $qry_str = "";
                foreach (explode("\n", $sql) as $line) {
                    if (!empty ($line) && substr($line, -2) != "*/") {
                        $line .= ";";
                    }

                    $qry_str .= $line . "\n";
                }

                $ss = new Dotb_Smarty();
                $ss->assign('MOD', $GLOBALS['mod_strings']);
                $ss->assign('qry_str', $qry_str);
                echo $ss->fetch('modules/Administration/templates/RepairDatabase.tpl');
            } else {
                echo "<h3>{$mod_strings['LBL_REPAIR_DATABASE_SYNCED']}</h3>";
            }
        }
    }

} else {
    dotb_die($GLOBALS['app_strings']['ERR_NOT_ADMIN']);
}
