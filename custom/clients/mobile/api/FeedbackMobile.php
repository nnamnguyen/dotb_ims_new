<?php

    class FeedbackMobile extends DotbApi
    {
        function registerApiRest()
        {
            return array(
                'feedbackmobile_listcomment' => array(
                    'reqType' => 'POST',
                    'path' => array('appchat-message', 'list-comments'),
                    'pathVars' => array(),
                    'method' => 'listComments',
                    'noLoginRequired' => true,
                ),
                'feedbackmobile_savecomment' => array(
                    'reqType' => 'POST',
                    'path' => array('appchat-message', 'save-comment'),
                    'pathVars' => array(),
                    'method' => 'saveComment',
                    'noLoginRequired' => true,
                )
            );
        }

        /**
         *
         * @param array $args = data,case_id
         *  'path' => array('chat-message', 'save-comment'),
         */
        function saveComment(ServiceBase $api, array $args){

            require_once 'include/utils/file_utils.php';

            global $timedate, $dotb_config;

            $api_user = $GLOBALS['db']->getOne("SELECT id FROM users WHERE user_name = 'apps_admin'");
            if(empty($api_user))$api_user = '1';
            $GLOBALS['current_user'] = BeanFactory::getBean('Users', $api_user);

            $bean              = new C_Comments();
            $bean->id          = create_guid();
            $bean->new_with_id = true;
            $bean->description = $args['data'];
            $bean->parent_id   = $args['case_id'];
            $bean->parent_type = 'Cases';
            $bean->direction   = 'inbound';
//            $bean->created_by  = 'apps_admin';
            $bean->cases_c_comments_1cases_ida = $args['case_id'];

            if (!empty($args['attachment'])) {
                $file     = base64_decode($args['attachment']['data']);
                $filesize = filesize($file);
                $idUp     = $bean->id;
                if ($filesize <= $dotb_config['upload_maxsize']) {
                    file_put_contents('upload/' . $bean->id, $file);
                    $bean->filename      = $args['attachment']['name'];
                    $bean->document_name = $args['attachment']['name'];

                    $extension = get_file_extension($bean->filename);
                    if (!empty($extension)) {
                        $bean->file_ext = $extension;
                        $bean->file_mime_type = get_mime_content_type_from_filename($bean->filename);
                    }
                    $logUpload  = 'uploaded';
                }else{
                    $logUpload      = 'limited_filesize';
                    $idUp           = $bean->id;
                    $bean->filename = '';
                    $bean->file_ext = '';
                    $bean->file_mime_type = '';
                }
            }

            $bean->save();


            return array(
                'success' => 1,
                'data' => array(
                    'direction'     => $bean->direction,
                    'description'   => $bean->description,
                    'date_entered'  => $timedate->to_display_date_time($bean->date_entered),
                    'create_by'     => $args['api_user_id'],
                    'attachment'      => array(
                        'log_upload'  => $logUpload,
                        'id'          => $idUp,
                        'name'        => $bean->filename,
                        'file_ext'    => $bean->file_ext,
                        'file_mime_type'=> $bean->file_mime_type,
                    )
                )
            );
        }

        /**
         *
         * @param array $args = case_id
         * 'path' => array('chat-message', 'list-comments'),
         */
        function listComments(ServiceBase $api, array $args)
        {
            global $timedate, $db, $locale;
            $data = array();

            $api_user = $GLOBALS['db']->getOne("SELECT id FROM users WHERE user_name = 'apps_admin'");
            if(empty($api_user))$api_user = '1';
            $GLOBALS['current_user'] = BeanFactory::getBean('Users', $api_user);

            $r = $db->query("SELECT DISTINCT
                IFNULL(l1.id, '') case_id,
                IFNULL(c_comments.id, '') primaryid,
                IFNULL(c_comments.filename, '') filename,
                IFNULL(c_comments.description, '') description,
                IFNULL(c_comments.direction, '') direction,
                IFNULL(c_comments.file_ext, '') file_ext,
                IFNULL(c_comments.file_mime_type, '') file_mime_type,
                c_comments.date_entered date_entered,
                IFNULL(l2.id, '') user_id,
                IFNULL(l2.first_name, '') first_name,
                IFNULL(l2.last_name, '') last_name
                FROM c_comments
                INNER JOIN cases_c_comments_1_c l1_1 ON c_comments.id = l1_1.cases_c_comments_1c_comments_idb AND l1_1.deleted = 0
                INNER JOIN cases l1 ON l1.id = l1_1.cases_c_comments_1cases_ida AND l1.deleted = 0
                LEFT JOIN users l2 ON c_comments.created_by = l2.id AND l2.deleted = 0
                WHERE (((l1.id = '{$args['case_id']}')))
                AND c_comments.deleted = 0
                ORDER BY c_comments.date_entered ASC");
            while ($row = $db->fetchByAssoc($r)){
                $create_by = $row['user_id'];
                if($row['user_id'] == $api_user ) $create_by = 'apps_admin';
                $data[] = array(
                    'direction'     => $row['direction'],
                    'description'   => $row['description'],
                    'date_entered'  => $timedate->to_display_date_time($row['date_entered']),
                    'created_by'    => $create_by,
                    'created_by_name' => $locale->getLocaleFormattedName($row['first_name'], $row['last_name']),
                    'attachment'    => array(
                        'id'        => $row['primaryid'],
                        'name'      => $row['filename'],
                        'file_ext'  => $row['file_ext'],
                        'file_mime_type'=> $row['file_mime_type'],
                    )
                );
            }

            return array('success' => 1, 'data' => $data);
        }
}