<?php
    $hook_version = 1;
    $hook_array = Array();
    // position, file, function
    $hook_array['after_save'] = Array();
    $hook_array['after_save'][] = Array(1, 'created primary unit', 'custom/modules/J_GroupUnit/logicGroupUnit.php','groupUnitLogicHook', 'handleAfterSave');

    $hook_array['before_delete'] = Array();
    $hook_array['before_delete'][] = Array(1, 'delete unit in group', 'custom/modules/J_GroupUnit/logicGroupUnit.php','groupUnitLogicHook', 'handleBeforeDelete');

    ?>
