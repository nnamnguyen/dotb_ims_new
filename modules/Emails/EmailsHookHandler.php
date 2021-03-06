<?php


class EmailsHookHandler
{
    /**
     * Anytime an attachment is added to an email, the attachment must be updated to guarantee that its visibility
     * mirrors the visibility of the email.
     *
     * @param DotbBean $bean The email.
     * @param string $event
     * @param array $args
     */
    public function updateAttachmentVisibility(DotbBean $bean, $event, array $args)
    {
        $message = 'The arguments for %s are %s/%s, %s, and %s.';
        $message = sprintf($message, __METHOD__, $bean->getModuleName(), $bean->id, $event, print_r($args, true));
        $GLOBALS['log']->debug($message);

        if ($event !== 'after_relationship_add') {
            $message = '%s is an invalid event. %s is only concerned with after_relationship_add events.';
            $GLOBALS['log']->debug(sprintf($message, $event, __METHOD__));
            return;
        }

        if ($args['link'] !== 'attachments') {
            $message = '%s is an invalid link. %s is only concerned with the Email.attachments link.';
            $GLOBALS['log']->debug(sprintf($message, $args['link'], __METHOD__));
            return;
        }

        $attachment = BeanFactory::retrieveBean(
            $args['related_module'],
            $args['related_id'],
            array('disable_row_level_security' => true)
        );

        if ($attachment) {
            $bean->updateAttachmentVisibility($attachment);
        } else {
            $message = 'Failed to load the attachment Notes/%s for Emails/%s in %s.';
            $GLOBALS['log']->error(sprintf($message, $args['related_id'], $bean->id, __METHOD__));
        }
    }
}
