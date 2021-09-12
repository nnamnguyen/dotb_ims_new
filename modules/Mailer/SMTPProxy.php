<?php


class SMTPProxy extends SMTP
{
    /**
     * {@inheritDoc}
     *
     * Logs the error if one exists.
     */
    protected function setError($message, $detail = '', $smtp_code = '', $smtp_code_ex = '')
    {
        parent::setError($message, $detail, $smtp_code, $smtp_code_ex);

        if (empty($message)) {
            return;
        }

        $logMessage = ['SMTP ->'];
        $level = 'warn';

        $logMessage[] = "ERROR: {$message}.";

        $hasDetail = !empty($detail);
        $hasSmtpCode = !empty($smtp_code);
        $hasSmtpCodeEx = !empty($smtp_code_ex);

        if ($hasSmtpCode) {
            // the presence of $smtp_code seems to indicate that a more serious error occurred
            // it was likely a failure when attempting to talk with an SMTP server
            $level = 'fatal';
        }

        if ($hasDetail) {
            $logMessage[] = "Reply: {$detail}";
        }

        if ($hasSmtpCode) {
            $logMessage[] = "Code: {$smtp_code}";
        }

        if ($hasSmtpCodeEx) {
            $logMessage[] = "Extended Code: {$smtp_code_ex}";
        }

        $GLOBALS['log']->$level(implode(' ', $logMessage));
    }
}
