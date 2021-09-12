<?php

    class logicComment
    {
        function handleAfterSave(&$bean, $event, $arguments)
        {
            if ($bean->parent_type == 'Cases') {
                $case = BeanFactory::getBean('Cases', $bean->parent_id, array('disable_row_level_security' => true));



                if (empty($bean->fetched_row)) {
                    if ($bean->direction == 'inbound') {
                        $GLOBALS['db']->query("DELETE FROM notifications WHERE parent_id='{$bean->parent_id}'");
                        //Create Notification
                        $nt = BeanFactory::newBean("Notifications");
                        $nt->name = 'Cases #' . $case->case_number . ': You have new comments';
                        $nt->assigned_user_id = $bean->assigned_user_id;
                        $nt->parent_id = $bean->parent_id;
                        $nt->parent_type = $bean->parent_type;
                        $nt->created_by = $bean->created_by;
                        $nt->description = $bean->description;
                        $nt->is_read = 0;
                        $nt->severity = "information";
                        $nt->save();
                    }

                    //update last comment status
                    $case->last_comment_direction = $bean->direction;
                    $case->last_comment_date = $bean->date_entered;
                    $case->count_comment = $GLOBALS['db']->getOne("SELECT DISTINCT COUNT(DISTINCT c_comments.id) c_comments__count
                        FROM c_comments INNER JOIN cases_c_comments_1_c l1_1 ON c_comments.id = l1_1.cases_c_comments_1c_comments_idb AND l1_1.deleted = 0
                        INNER JOIN cases l1 ON l1.id = l1_1.cases_c_comments_1cases_ida AND l1.deleted = 0
                        WHERE l1.id = '{$case->id}' AND c_comments.deleted = 0
                        GROUP BY l1.id");
                    $case->save();
                }
            }
        }

        function handleCommentBox(&$bean, $event, $arguments){
            global $timedate;
            if($bean->direction == 'inbound'){
                $class = "text-warning";
                $img = './include/images/cmt_user.png';
            }
            else {
                $class = "text-success";
                $img = './include/images/cmt_admin.jpg';

            }


            $bean->description  = "<li style='white-space: normal;'>
            <a href='#bwc/index.php?module=Employees&amp;action=DetailView&amp;record={$bean->created_by}' class='pull-left' style='padding-right: 10px;'>
            <img src='".$img."' class='img-circle' style='width:50px;'> </a>
            <div><span class='text-muted pull-right'> <small class='text-muted'>".$timedate->time_Ago($bean->date_entered)."</small> </span>
            <strong class='".$class."'>@{$bean->created_by_name}</strong><p>".$bean->description."</p></div></li>";
        }
}