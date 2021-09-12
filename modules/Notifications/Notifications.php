<?php



class Notifications extends Basic
{
    public $new_schema = true;
    public $module_dir = 'Notifications';
    public $object_name = 'Notifications';
    public $table_name = 'notifications';
    public $importable = false;

    public $id;
    public $name;
    public $date_entered;
    public $date_modified;
    public $modified_user_id;
    public $modified_by_name;
    public $created_by;
    public $created_by_name;
    public $description;
    public $deleted;
    public $created_by_link;
    public $modified_user_link;
    public $assigned_user_id;
    public $assigned_user_name;
    public $assigned_user_link;
    public $is_read;
    public $severity;
    public $disable_custom_fields = true;
    public $disable_row_level_security = true;

    public function __construct()
    {
        parent::__construct();
        $this->addVisibilityStrategy('OwnerVisibility');
    }

    public function bean_implements($interface)
    {
        switch ($interface) {
            case 'ACL':
                return true;
        }
        return false;
    }
}
