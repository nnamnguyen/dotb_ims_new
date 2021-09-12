<?php

include('include/modules.php');

global $beanFiles, $mod_strings;
echo $mod_strings['LBL_REBUILD_AUDIT_SEARCH'] . ' <BR>';
foreach ($beanFiles as $bean => $file)
{
	if(strlen($file) > 0 && file_exists($file)) {
		require_once($file);
	    $focus = BeanFactory::newBeanByName($bean);
		if ($focus->is_AuditEnabled()) {
			if (!$focus->db->tableExists($focus->get_audit_table_name())) {
				printf($mod_strings['LBL_REBUILD_AUDIT_SEARCH'],$focus->get_audit_table_name(), $focus->object_name);
				$focus->create_audit_table();
			} else {
				printf($mod_strings['LBL_REBUILD_AUDIT_SKIP'],$focus->object_name);
			}
		}
	}
}
echo $mod_strings['LBL_DONE'];
?>