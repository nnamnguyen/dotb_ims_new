<?php


class TemplateAddressStreet extends TemplateField
{
    //Set display type to text, but stored in db as a varchar
    var $type = 'text';
    var $ext3 = 'varchar';
    var $len = 150;

    function get_field_def(){
        $vardef = parent::get_field_def();
        $vardef['dbType'] = $this->ext3;
        return $vardef;
    }
}
