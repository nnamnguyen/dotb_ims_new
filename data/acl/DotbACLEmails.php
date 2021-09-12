<?php


require_once 'data/DotbACLStrategy.php';

class DotbACLEmails extends DotbACLStrategy
{
    /**
     * Don't allow write-access to some fields because they are set by the application.
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

        $immutableFields = [
            'reply_to_status',
        ];

        if (in_array($context['field'], $immutableFields)) {
            return false;
        }

        return true;
    }
}
