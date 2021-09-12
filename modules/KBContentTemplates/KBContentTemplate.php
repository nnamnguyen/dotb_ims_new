<?php


class KBContentTemplate extends DotbBean
{
    public $table_name = 'kbcontent_templates';
    public $object_name = 'KBContentTemplate';
    public $new_schema = true;
    public $module_dir = 'KBContentTemplates';

    /**
     * {@inheritdoc}
     * Check KBContents create.
     **/
    public function save($check_notify = false)
    {
        if (!DotbACL::checkAccess('KBContents', 'create')) {
            return;
        }
        return parent::save($check_notify);
    }

    /**
     * {@inheritdoc}
     **/
    public function bean_implements($interface)
    {
        switch ($interface) {
            case 'ACL':
                return false;
        }
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function get_summary_text()
    {
        return $this->name;
    }
}
