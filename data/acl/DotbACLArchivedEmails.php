<?php


require_once 'data/DotbACLStrategy.php';

class DotbACLArchivedEmails extends DotbACLStrategy
{
    /**
     * Don't allow write-access to some fields after the email is archived.
     *
     * {@inheritdoc}
     */
    public function checkAccess($module, $view, $context)
    {
        if (!$this->isWriteOperation($view, $context)) {
            return true;
        }

        if ($view !== 'field') {
            return true;
        }

        if (!isset($context['bean'])) {
            return true;
        }

        $bean = $context['bean'];
        $isNew = !$bean->isUpdate();

        if ($bean->state !== Email::STATE_ARCHIVED) {
            return true;
        }

        if ($isNew) {
            // The outbound_email_id field is only used when sending emails from the application. It serves no purpose
            // when an email is archived at its point of creation.
            if ($context['field'] === 'outbound_email_id') {
                return false;
            }

            // Allow anything when the bean is being created.
            return true;
        }

        // These fields cannot be changed or the integrity of an email is lost.
        $immutableFields = [
            'raw_source',
            'description',
            'description_html',
            'date_sent',
            'message_id',
            'name',
            'mailbox_id',
            'state',
            'reply_to_id',
            'outbound_email_id',
            'from_addr_name',
            'to_addrs_names',
            'cc_addrs_names',
            'bcc_addrs_names',
            'reply_to_addr',
            'type',
        ];

        if (in_array($context['field'], $immutableFields)) {
            return false;
        }

        return true;
    }
}
