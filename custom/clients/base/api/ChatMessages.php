<?php

    class ChatMessages extends DotbApi
    {
        function registerApiRest()
        {
            return array(
                'save_chat_message' => array(
                    'reqType' => 'POST',
                    'path' => array('chat-message', 'save'),
                    'pathVars' => array('', ''),
                    'method' => 'save',
                ),
                'chat_message' => array(
                    'reqType' => 'POST',
                    'path' => array('chat-message'),
                    'pathVars' => array('', ''),
                    'method' => 'get',
                ),
                'chat_message_set_noty_is_read' => array(
                    'reqType' => 'POST',
                    'path' => array('chat-message', 'set_noty_is_read'),
                    'pathVars' => array('', ''),
                    'method' => 'setNotyIsRead',
                )
            );
        }

        function save(ServiceBase $api, array $args)
        {
            global $timedate, $current_user;
            $bean = BeanFactory::newBean('C_Comments');
            $bean->description  = $args['description'];
            $bean->parent_id    = $args['parent_id'];
            $bean->cases_c_comments_1cases_ida = $args['parent_id'];
            $bean->parent_type  = $args['parent_type'];
            $bean->direction    = 'Outbound';

            if (!empty($args['attachment'])) {
                $bean->id = create_guid();
                $bean->new_with_id = true;
                if (!file_exists('upload/comments')) mkdir('upload/comments');
                file_put_contents('upload/comments/' . $bean->id, base64_decode($args['attachment']['data']));
                $bean->attachment_name = $args['attachment']['name'];
            }
            $bean->save();

            if ($bean->parent_type == "Cases") {
                require_once("custom/clients/mobile/helper/NotificationHelper.php");
                $notify = new NotificationMobile();
                $notify->pushNotification($GLOBALS['app_strings']['LBL_TITLE_FEEDBACK_NOTIFICATION'], $bean->description, $bean->module_name, $bean->id, $bean->parent_id);
            }

            return array(
                'success' => 1,
                'data' => array(
                    'created_by_name' => $current_user->full_name,
                    'created_by' => $current_user->id,
                    'description' => $args['description'],
                    'date_entered' => $timedate->to_display_date_time($bean->date_entered),
                    'attachment_id' => $bean->id,
                    'attachment_name' => $bean->attachment_name
                )
            );
        }

        function setNotyIsRead(ServiceBase $api, array $args)
        {
            $GLOBALS['db']->query("update notifications set is_read=1 where parent_type='Cases' and parent_id='{$args['parent_id']}'");
        }

        function get(ServiceBase $api, array $args)
        {
            global $timedate, $db, $locale;
            $data = array();
            $r = $db->query("select created_by,description,date_entered,attachment_id,attachment_name
                from c_comments
                where parent_id='{$args['parent_id']}' and parent_type='{$args['parent_type']}'
                order by date_entered");
            while ($row = $db->fetchByAssoc($r)) {
                $r2 = $db->query("select first_name,last_name from users where id='{$row['created_by']}'");
                if ($r2 = $db->fetchByAssoc($r2)) {
                    $data[] = array(
                        'description' => $row['description'],
                        'date_entered' => $timedate->to_display_date_time($row['date_entered']),
                        'created_by' => $row['created_by'],
                        'created_by_name' => $locale->getLocaleFormattedName($r2['first_name'], $r2['last_name']),
                        'attachment_name' => $row['attachment_name'],
                        'attachment_id' => $row['attachment_id'],
                    );
                }
            }

            return array('success' => 1, 'data' => $data);
        }
}