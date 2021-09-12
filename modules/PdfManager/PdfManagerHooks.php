<?php


class PdfManagerHooks
{
    /**
     * Fixes TinyMCE converting & to &amp;, protecting smarty templates.
     *
     * @param PdfManager $bean
     * @param [type] $event
     * @param array $params
     * @return void
     */
    public function fixAmp(PdfManager $bean, $event, $params = array())
    {
        $bean->body_html = str_replace('&amp;', '&', $bean->body_html);
    }
}
