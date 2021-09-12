<?php

class RT_DotbBoards_dotb extends Basic {
    public $new_schema = true;
    public $module_dir = 'RT_DotbBoards';
    public $object_name = 'RT_DotbBoards';
    public $table_name = 'rt_dotbboards';
    public $importable = false;
    public $team_id;
    public $team_set_id;
    public $team_count;
    public $team_name;
    public $team_link;
    public $team_count_link;
    public $teams;
    public $assigned_user_id;
    public $assigned_user_name;
    public $assigned_user_link;
    public $tag;
    public $tag_link;
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
    public $activities;
    public $following;
    public $following_link;
    public $my_favorite;
    public $favorite_link;
    
    public function bean_implements($interface){
        switch($interface){
            case 'ACL': return true;
        }
        return false;
    }
    
}