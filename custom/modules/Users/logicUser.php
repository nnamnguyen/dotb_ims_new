<?php

if (!defined('dotbEntry') || !dotbEntry) die('Not A Valid Entry Point');

class logicUser
{
    public function checkLicense(&$bean, $event, $arguments)
    {
        require_once 'custom/include/KTEncrypt.php';
        $kt = new KTEncrypt();
        $lic = unserialize($kt->decode(trim(file_get_contents('license.key'), '"'), 'r>((5\tg&z/2y5y#\;'));
        $sql = "SELECT COUNT(*) 
                    FROM users
                    WHERE id <> '1'
                    AND status = 'Active'
                    AND deleted = 0";

        $result = $GLOBALS['db']->query("SHOW COLUMNS FROM users LIKE 'teacher_id'");
        if ($result->num_rows == 0) $sql .= " and (teacher_id='' or teacher_id=null)";

        $user = $GLOBALS['db']->getOne($sql);
        $user = (int)$user;
        if ($user >= $lic['users'] && isset($bean->fetched_row['id']) && $bean->fetched_row['status'] == 'Inactive' && $bean->status == 'Active') {
            $mess = $GLOBALS['mod_strings']['LBL_LIMIT_USER'];
            echo '<script type="text/javascript">
                        window.top.App.alert.show(\'message-id\', {
                        level: \'confirmation\',
                        messages: "'. $mess .'",
                        autoClose: false,
                        onConfirm: function () {
                            window.top.App.router.redirect(\'#C_AdminConfig/layout/license\');
                        },
                        onCancel: function () {
                            window.top.App.router.redirect(\'#bwc/index.php?module=Users&action=index\');
                        }
                     });
                    </script>';
            die();
        }
    }
}