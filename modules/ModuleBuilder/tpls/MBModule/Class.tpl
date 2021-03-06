<?php

/**
 * THIS CLASS IS GENERATED BY MODULE BUILDER
 * PLEASE DO NOT CHANGE THIS CLASS
 * PLACE ANY CUSTOMIZATIONS IN {{$class.name}}
 */

{{foreach from=$class.requires item='require'}}
require_once '{{$require}}';
{{/foreach}}

class {{$class.name}}_dotb extends {{$class.extends}} {
    public $new_schema = true;
    public $module_dir = '{{$class.name}}';
    public $object_name = '{{$class.name}}';
    public $table_name = '{{$class.table_name}}';
    public $importable = {{if $class.importable}}true{{else}}false{{/if}};
{{foreach from=$class.fields key='field' item='def'}}
    public ${{$field}};
{{/foreach}}
    {{if empty($class.team_security)}}
    public $disable_row_level_security = true;
    {{/if}}

{{if $class.acl}}
    public function bean_implements($interface){
        switch($interface){
            case 'ACL': return true;
        }
        return false;
    }
{{/if}}
    
}
