<?php

class logicCase{
    function handleStatusColor(&$bean, $event, $arguments)
    {
        $colorClass = '';
        switch ($bean->status) {
            case 'New':
                $colorClass = "textbg_green";
                break;
            case 'Assigned':
                $colorClass = "textbg_blue";
                break;
            case 'Pending Input':
                $colorClass = "textbg_orange";
                break;
            case 'Closed':
                $colorClass = "textbg_red";
                break;
            default :
                $colorClass = "No_color";
        }
        $tmp_status = translate('case_status_dom', '', $bean->status);
        $bean->status = "<span class='label ellipsis_inline ".$colorClass." '>".$tmp_status."</span>";
    }
    function handleLastCmtTime(&$bean, $event, $arguments)
    {
        $case_id = $bean->id;
        $sql = "SELECT DISTINCT
                    IFNULL(c_comments.id, '') primaryId,
                    IFNULL(c_comments.date_entered, '') date_entered,
                    IFNULL(c_comments.description, '') description
                FROM
                    c_comments
                INNER JOIN
                    cases_c_comments_1_c l1_1 ON c_comments.id = l1_1.cases_c_comments_1c_comments_idb
                    AND l1_1.deleted = 0
                INNER JOIN
                    cases l1 ON l1.id = l1_1.cases_c_comments_1cases_ida
                    AND l1.deleted = 0
                WHERE
                    (((l1.id = '$case_id')))
                    AND c_comments.deleted = 0
                    ORDER BY c_comments.date_entered DESC limit 1";
        $row = $GLOBALS['db']->fetchOne($sql);
        if(!empty($row)) {
            $content = $row['description'];
            if(strlen($content)>=50)
            {
                $content = substr($content, 0, 50);
                $content = $content.' ...';
            }

            $bean -> last_comment = '<div><i class="far fa-comment-dots" style="color: dodgerblue"></i> '.$content.'<br /><i>'.$GLOBALS['timedate']->time_Ago($row['date_entered']).'</i></div>';

        }

    }
    function handleBeforeSave(&$bean, $event, $arguments){

//        if ($bean->parent_type == 'Cases') {
//            $case = BeanFactory::getBean('Cases', $bean->parent_id, array('disable_row_level_security' => true));
            if (empty($bean->fetched_row)) {
                if ($bean->direction == 'inbound') {
                    $GLOBALS['db']->query("DELETE FROM notifications WHERE parent_id='{$bean->parent_id}'");
                    //Create Notification
                    $nt = BeanFactory::newBean("Notifications");
                    $nt->name = 'You have new feedback';
                    $nt->assigned_user_id = $bean->assigned_user_id;
                    $nt->parent_id = $bean->id;
                    $nt->parent_type = $bean->module_name;
                    $nt->created_by = $bean->created_by;
                    $nt->description = $bean->description;
                    $nt->is_read = 0;
                    $nt->severity = "information";
                    $nt->save();
                }

                //update last comment status
//                $case->last_comment_direction = $bean->direction;
//                $case->last_comment_date = $bean->date_entered;
//                $case->count_comment = $GLOBALS['db']->getOne("SELECT DISTINCT COUNT(DISTINCT c_comments.id) c_comments__count
//                        FROM c_comments INNER JOIN cases_c_comments_1_c l1_1 ON c_comments.id = l1_1.cases_c_comments_1c_comments_idb AND l1_1.deleted = 0
//                        INNER JOIN cases l1 ON l1.id = l1_1.cases_c_comments_1cases_ida AND l1.deleted = 0
//                        WHERE l1.id = '{$case->id}' AND c_comments.deleted = 0
//                        GROUP BY l1.id");
//                $case->save();
//            }
        }
//
//        if (empty($bean->fetched_row)) {
//
//        }

    }
}