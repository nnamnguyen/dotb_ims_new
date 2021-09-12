<?php


class TemplateLink extends TemplateText
{
    public $type = 'link';

    /**
    * get array of field's properties
    *
    * @return array
    */
    public function get_field_def()
    {
        $defs = parent::get_field_def();
        $defs['source'] = 'non-db';
        return $defs;
    }
}
?>
