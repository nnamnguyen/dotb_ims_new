<?php



$dictionary['{{$class.name}}'] = array(
    'table' => '{{$class.table_name}}',
    'audited' => {{if $class.audited}}true{{else}}false{{/if}},
    'activity_enabled' => {{if $class.activity_enabled}}true{{else}}false{{/if}},
{{if !($class.templates|strstr:"file")}}
    'duplicate_merge' => true,
{{/if}}
    'fields' => {{$class.fields_string}},
    'relationships' => {{$class.relationships}},
    'optimistic_locking' => true,
{{if !empty($class.table_name) && !empty($class.templates)}}
    'unified_search' => true,
    'full_text_search' => true,
{{/if}}
);

if (!class_exists('VardefManager')){
}
VardefManager::createVardef('{{$class.name}}','{{$class.name}}', array({{$class.templates}}));
