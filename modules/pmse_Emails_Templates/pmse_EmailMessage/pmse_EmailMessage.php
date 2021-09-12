<?php


/**
 * Class pmse_EmailMessage
 */
class pmse_EmailMessage extends Basic
{

    public $module_dir = 'pmse_Emails_Templates/pmse_EmailMessage';
    public $module_name = 'pmse_EmailMessage';
    public $table_name = 'pmse_email_message';
    public $object_name = 'pmse_EmailMessage';

    public $from_addr;
    public $from_name;
    public $to_addrs;
    public $cc_addrs;
    public $bcc_addrs;
    public $body;
    public $body_html;
    public $subject;
    public $flow_id;

    /**
     * @inheritDoc
     */
    public function ACLAccess($view, $context = null)
    {
        switch ($view) {
            case 'list':
                if (is_array($context)
                    && isset($context['source'])
                    && $context['source'] === 'filter_api') {
                    return false;
                }
                break;
            case 'edit':
            case 'view':
                if (is_array($context)
                    && isset($context['source'])
                    && $context['source'] === 'module_api') {
                    return false;
                }
                break;
        }
        return parent::ACLAccess($view, $context);
    }
}
