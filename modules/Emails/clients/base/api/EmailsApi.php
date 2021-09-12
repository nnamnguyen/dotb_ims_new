<?php


class EmailsApi extends ModuleApi
{
    /**
     * {@inheritdoc}
     */
    public function registerApiRest()
    {
        return array(
            'create' => array(
                'reqType' => 'POST',
                'path' => array('Emails'),
                'pathVars' => array('module'),
                'method' => 'createRecord',
                'shortHelp' => 'This method creates a new Emails record',
                'longHelp' => 'modules/Emails/clients/base/api/help/emails_record_post_help.html',
                'exceptions' => array(
                    'DotbApiExceptionInvalidParameter',
                    'DotbApiExceptionMissingParameter',
                    'DotbApiExceptionNotAuthorized',
                    'DotbApiExceptionNotFound',
                    'DotbApiException',
                    'DotbApiExceptionError',
                ),
            ),
            'retrieve' => array(
                'reqType' => 'GET',
                'path' => array('Emails', '?'),
                'pathVars' => array('module', 'record'),
                'method' => 'retrieveRecord',
                'shortHelp' => 'Returns a single Emails record',
                'longHelp' => 'modules/Emails/clients/base/api/help/emails_record_get_help.html',
                'exceptions' => array(
                    'DotbApiExceptionMissingParameter',
                    'DotbApiExceptionNotAuthorized',
                    'DotbApiExceptionNotFound',
                ),
            ),
            'update' => array(
                'reqType' => 'PUT',
                'path' => array('Emails', '?'),
                'pathVars' => array('module', 'record'),
                'method' => 'updateRecord',
                'shortHelp' => 'This method updates an Emails record',
                'longHelp' => 'modules/Emails/clients/base/api/help/emails_record_put_help.html',
                'exceptions' => array(
                    'DotbApiExceptionInvalidParameter',
                    'DotbApiExceptionMissingParameter',
                    'DotbApiExceptionNotAuthorized',
                    'DotbApiExceptionNotFound',
                    'DotbApiException',
                    'DotbApiExceptionError',
                ),
            ),
        );
    }

    /**
     * Sends the email when the state is "Ready".
     *
     * {@inheritdoc}
     */
    public function createRecord(ServiceBase $api, array $args)
    {
        $isReady = isset($args['state']) && $args['state'] === Email::STATE_READY;
        $result = parent::createRecord($api, $args);

        if ($isReady) {
            $loadArgs = array('module' => 'Emails', 'record' => $result['id']);
            $email = $this->loadBean($api, $loadArgs, 'save', array('source' => 'module_api'));

            try {
                $this->sendEmail($email);
                $result = $this->formatBeanAfterSave($api, $args, $email);
            } catch (Exception $e) {
                $email->delete();
                throw $e;
            }
        }

        return $result;
    }

    /**
     * Sends the email when the state is "Ready".
     *
     * {@inheritdoc}
     */
    public function updateRecord(ServiceBase $api, array $args)
    {
        $isReady = isset($args['state']) && $args['state'] === Email::STATE_READY;
        $result = parent::updateRecord($api, $args);

        if ($isReady) {
            $email = $this->loadBean($api, $args, 'save', array('source' => 'module_api'));
            $this->sendEmail($email);
            $result = $this->formatBeanAfterSave($api, $args, $email);
        }

        return $result;
    }

    /**
     * Send the email.
     *
     * The system configuration is used if no configuration is specified on the email. An error will occur if the
     * application is not configured correctly to send email.
     *
     * @param DotbBean $email
     * @throws DotbApiException
     * @throws DotbApiExceptionError
     */
    protected function sendEmail(DotbBean $email)
    {
        try {
            $config = null;
            $oe = null;

            if (empty($email->outbound_email_id)) {
                $seed = BeanFactory::newBean('OutboundEmail');
                $q = new DotbQuery();
                $q->from($seed);
                $q->where()->in('type', [OutboundEmail::TYPE_SYSTEM, OutboundEmail::TYPE_SYSTEM_OVERRIDE]);
                // There should only be one system or system-override account that is accessible. The admin can actually
                // access both a system and system-override account. Sorting in descending order by type and setting a
                // limit guarantees that the system-override account is prioritized when finding the default record to
                // use.
                $q->orderBy('type');
                $q->limit(1);
                $beans = $seed->fetchFromQuery($q, ['id']);

                if (!empty($beans)) {
                    $bean = array_shift($beans);
                    $email->outbound_email_id = $bean->id;
                }
            }

            if (!empty($email->outbound_email_id)) {
                $oe = BeanFactory::retrieveBean('OutboundEmail', $email->outbound_email_id);
            }

            if ($oe) {
                if ($oe->isConfigured()) {
                    $config = OutboundEmailConfigurationPeer::buildOutboundEmailConfiguration(
                        $GLOBALS['current_user'],
                        [
                            'config_id' => $oe->id,
                            'config_type' => $oe->type,
                            'from_email' => $oe->email_address,
                            'from_name' => $oe->name,
                        ],
                        $oe
                    );
                } else {
                    throw new MailerException(
                        'The configuration for sending email is invalid',
                        MailerException::InvalidConfiguration
                    );
                }
            }

            if (empty($config)) {
                throw new MailerException(
                    'Could not find a configuration for sending email',
                    MailerException::InvalidConfiguration
                );
            }

            $email->sendEmail($config);
        } catch (MailerException $e) {
            switch ($e->getCode()) {
                case MailerException::FailedToSend:
                case MailerException::FailedToConnectToRemoteServer:
                case MailerException::InvalidConfiguration:
                    throw new DotbApiException(
                        $e->getUserFriendlyMessage(),
                        null,
                        'Emails',
                        451,
                        'smtp_server_error'
                    );
                case MailerException::InvalidHeader:
                case MailerException::InvalidEmailAddress:
                case MailerException::InvalidAttachment:
                case MailerException::FailedToTransferHeaders:
                case MailerException::ExecutableAttachment:
                    throw new DotbApiException(
                        $e->getUserFriendlyMessage(),
                        null,
                        'Emails',
                        451,
                        'smtp_payload_error'
                    );
                default:
                    throw new DotbApiExceptionError($e->getUserFriendlyMessage());
            }
        } catch (Exception $e) {
            throw new DotbApiExceptionError('Failed to send the email: ' . $e->getMessage());
        }
    }

    /**
     * EmailsApi needs an extended version of {@link RelateRecordApi} that is specific to Emails.
     *
     * @return EmailsRelateRecordApi
     */
    protected function getRelateRecordApi()
    {
        if (!$this->relateRecordApi) {
            $this->relateRecordApi = new EmailsRelateRecordApi();
        }

        return $this->relateRecordApi;
    }
}
