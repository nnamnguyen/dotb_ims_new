<?php


class EmailsRelateRecordApi extends RelateRecordApi
{
    /**
     * {@inheritdoc}
     */
    public function registerApiRest()
    {
        return [
            'createRelatedLink' => [
                'reqType' => 'POST',
                'path' => ['Emails', '?', 'link', '?', '?'],
                'pathVars' => ['module', 'record', '', 'link_name', 'remote_id'],
                'method' => 'createRelatedLink',
                'shortHelp' => 'Relates an existing record to an email',
                'longHelp' => 'modules/Emails/clients/base/api/help/emails_record_link_link_name_remote_id_post_help.html',
                'exceptions' => [
                    'DotbApiExceptionMissingParameter',
                    'DotbApiExceptionNotAuthorized',
                    'DotbApiExceptionNotFound',
                ],
            ],
            'createRelatedLinks' => [
                'reqType' => 'POST',
                'path' => ['Emails', '?', 'link'],
                'pathVars' => ['module', 'record', ''],
                'method' => 'createRelatedLinks',
                'shortHelp' => 'Relates existing records to an email',
                'longHelp' => 'modules/Emails/clients/base/api/help/emails_record_link_post_help.html',
                'exceptions' => [
                    'DotbApiExceptionMissingParameter',
                    'DotbApiExceptionNotAuthorized',
                    'DotbApiExceptionNotFound',
                ],
            ],
            'deleteRelatedLink' => [
                'reqType' => 'DELETE',
                'path' => ['Emails', '?', 'link', '?', '?'],
                'pathVars' => ['module', 'record', '', 'link_name', 'remote_id'],
                'method' => 'deleteRelatedLink',
                'shortHelp' => 'Deletes a relationship between an email and another record',
                'longHelp' => 'modules/Emails/clients/base/api/help/emails_record_link_link_name_remote_id_delete_help.html',
                'exceptions' => [
                    'DotbApiExceptionMissingParameter',
                    'DotbApiExceptionNotAuthorized',
                    'DotbApiExceptionNotFound',
                ],
            ],
            'createRelatedLinksFromRecordList' => [
                'reqType' => 'POST',
                'path' => ['Emails', '?', 'link', '?', 'add_record_list', '?'],
                'pathVars' => ['module', 'record', '', 'link_name', '', 'remote_id'],
                'method' => 'createRelatedLinksFromRecordList',
                'shortHelp' => 'Relates existing records from a record list to an email',
                'longHelp' => 'modules/Emails/clients/base/api/help/emails_record_links_from_recordlist_post_help.html',
                'exceptions' => [
                    'DotbApiExceptionMissingParameter',
                    'DotbApiExceptionNotAuthorized',
                    'DotbApiExceptionNotFound',
                ],
            ],
        ];
    }

    /**
     * Prevents existing Notes records from being linked as attachments and existing EmailParticipants records from
     * being linked as a sender or recipients.
     *
     * {@inheritdoc}
     * @throws DotbApiExceptionNotAuthorized
     */
    public function createRelatedLinks(
        ServiceBase $api,
        array $args,
        $securityTypeLocal = 'view',
        $securityTypeRemote = 'view'
    ) {
        if ($args['link_name'] === 'from') {
            throw new DotbApiExceptionNotAuthorized('Cannot link an existing sender');
        } elseif (in_array($args['link_name'], ['to', 'cc', 'bcc'])) {
            throw new DotbApiExceptionNotAuthorized('Cannot link existing recipients');
        } elseif ($args['link_name'] === 'attachments') {
            throw new DotbApiExceptionNotAuthorized('Cannot link existing attachments');
        }

        return parent::createRelatedLinks($api, $args, $securityTypeLocal, $securityTypeRemote);
    }

    /**
     * Prevents existing Notes records from being linked as attachments and existing EmailParticipants records from
     * being linked as a sender or recipients.
     *
     * {@inheritdoc}
     * @throws DotbApiExceptionNotAuthorized
     */
    public function createRelatedLinksFromRecordList(ServiceBase $api, array $args)
    {
        if ($args['link_name'] === 'from') {
            throw new DotbApiExceptionNotAuthorized('Cannot link an existing sender');
        } elseif (in_array($args['link_name'], ['to', 'cc', 'bcc'])) {
            throw new DotbApiExceptionNotAuthorized('Cannot link existing recipients');
        } elseif ($args['link_name'] === 'attachments') {
            throw new DotbApiExceptionNotAuthorized('Cannot link existing attachments');
        }

        return parent::createRelatedLinksFromRecordList($api, $args);
    }

    /**
     * The sender cannot be removed. Replace the sender with a different sender instead.
     *
     * {@inheritdoc}
     * @throws DotbApiExceptionNotAuthorized
     */
    public function deleteRelatedLink(ServiceBase $api, array $args)
    {
        if ($args['link_name'] === 'from') {
            throw new DotbApiExceptionNotAuthorized('The sender cannot be removed');
        }

        return parent::deleteRelatedLink($api, $args);
    }
}
