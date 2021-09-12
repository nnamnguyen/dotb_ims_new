<?php


class KBDocument extends DotbBean
{
    public $new_schema = true;
    public $module_dir = 'KBDocuments';
    public $object_name = 'KBDocument';
    public $table_name = 'kbdocuments';

    public function bean_implements($interface)
    {
        switch ($interface) {
            case 'ACL':
                return false;
        }
        return false;
    }
}
