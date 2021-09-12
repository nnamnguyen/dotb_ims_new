<?php

class KBArticle extends DotbBean
{
    public $new_schema = true;
    public $module_dir = 'KBArticles';
    public $object_name = 'KBArticle';
    public $table_name = 'kbarticles';

    public function bean_implements($interface)
    {
        switch ($interface) {
            case 'ACL':
                return false;
        }
        return false;
    }
    public function get_summary_text()
    {
        return $this->name;
    }
}
