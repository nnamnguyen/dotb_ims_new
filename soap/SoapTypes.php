<?php


$server->wsdl->addComplexType(
    'note_attachment',
    'complexType',
    'struct',
    'all',
    '',
    array(
        "id" => array('name'=>"id",'type'=>'xsd:string'),
		"filename" => array('name'=>"filename",'type'=>'xsd:string'),
		"file" => array('name'=>"file",'type'=>'xsd:string'),
    )
);

$server->wsdl->addComplexType(
    'new_note_attachment',
    'complexType',
    'struct',
    'all',
    '',
    array(
        "id" => array('name'=>"id",'type'=>'xsd:string'),
		"filename" => array('name'=>"filename",'type'=>'xsd:string'),
		"file" => array('name'=>"file",'type'=>'xsd:string'),
		"related_module_id" => array('name'=>"related_module_id",'type'=>'xsd:string'),
		"related_module_name" => array('name'=>"related_module_name",'type'=>'xsd:string'),
    )
);

$server->wsdl->addComplexType(
    'new_return_note_attachment',
    'complexType',
    'struct',
    'all',
    '',
    array(
        "note_attachment"=>array('name'=>'note_attachment', 'type'=>'tns:new_note_attachment'),
    )
);

$server->wsdl->addComplexType(
    'return_note_attachment',
    'complexType',
    'struct',
    'all',
    '',
    array(
        "note_attachment"=>array('name'=>'note_attachment', 'type'=>'tns:note_attachment'),
		"error"=> array('name'=>'error', 'type'=>'tns:error_value'),
    )
);

$server->wsdl->addComplexType(
   	 'user_auth',
   	 'complexType',
   	 'struct',
   	 'all',
  	  '',
	array(
		'user_name'=>array('name'=>'user_name', 'type'=>'xsd:string'),
		'password' => array('name'=>'password', 'type'=>'xsd:string'),
		'version'=>array('name'=>'version', 'type'=>'xsd:string'),
	)

);

$server->wsdl->addComplexType(
    'field',
	'complexType',
   	 'struct',
   	 'all',
  	  '',
		array(
			'name'=>array('name'=>'name', 'type'=>'xsd:string'),
			'type'=>array('name'=>'type', 'type'=>'xsd:string'),
			'label'=>array('name'=>'label', 'type'=>'xsd:string'),
			'required'=>array('name'=>'required', 'type'=>'xsd:int'),
			'options'=>array('name'=>'options', 'type'=>'tns:name_value_list'),
            'default_value'=>array('name'=>'name', 'type'=>'xsd:string'),
		)
);

$server->wsdl->addComplexType(
    'link_field',
	'complexType',
   	 'struct',
   	 'all',
  	  '',
		array(
			'name'=>array('name'=>'name', 'type'=>'xsd:string'),
			'type'=>array('name'=>'type', 'type'=>'xsd:string'),
			'relationship'=>array('name'=>'relationship', 'type'=>'xsd:string'),
			'module'=>array('name'=>'module', 'type'=>'xsd:string'),
			'bean_name'=>array('name'=>'bean_name', 'type'=>'xsd:string'),
		)
);


$server->wsdl->addComplexType(
    'field_list',
	'complexType',
   	 'array',
   	 '',
  	  'SOAP-ENC:Array',
	array(),
    array(
        array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:field[]')
    ),
	'tns:field'
);

$server->wsdl->addComplexType(
    'link_field_list',
	'complexType',
   	 'array',
   	 '',
  	  'SOAP-ENC:Array',
	array(),
    array(
        array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:link_field[]')
    ),
	'tns:link_field'
);



$server->wsdl->addComplexType(
    'name_value',
	'complexType',
   	 'struct',
   	 'all',
  	  '',
		array(
        	'name'=>array('name'=>'name', 'type'=>'xsd:string'),
			'value'=>array('name'=>'value', 'type'=>'xsd:string'),
		)
);
$server->wsdl->addComplexType(
    'name_value_list',
	'complexType',
   	 'array',
   	 '',
  	  'SOAP-ENC:Array',
	array(),
    array(
        array('ref'=>'SOAP-ENC:arrayType', 'wsdl:arrayType'=>'tns:name_value[]')
    ),
	'tns:name_value'
);

$server->wsdl->addComplexType(
    'name_value_lists',
	'complexType',
   	 'array',
   	 '',
  	  'SOAP-ENC:Array',
	array(),
    array(
        array('ref'=>'SOAP-ENC:arrayType', 'wsdl:arrayType'=>'tns:name_value_list[]')
    ),
	'tns:name_value_list'
);


//these are just a list of fields we want to get
$server->wsdl->addComplexType(
    'select_fields',
	'complexType',
   	 'array',
   	 '',
  	  'SOAP-ENC:Array',
	array(),
    array(
        array('ref'=>'SOAP-ENC:arrayType', 'wsdl:arrayType'=>'xsd:string[]')
    ),
	'xsd:string'
);



//these are just a list of fields we want to get
$server->wsdl->addComplexType(
    'module_fields',
	'complexType',
   	 'struct',
   	 'all',
  	  '',
		array(
        	'module_name'=>array('name'=>'module_name', 'type'=>'xsd:string'),
			'module_fields'=>array('name'=>'module_fields', 'type'=>'tns:field_list'),
			'error' => array('name' =>'error', 'type'=>'tns:error_value'),
		)
);

//these are just a list of fields we want to get
$server->wsdl->addComplexType(
    'new_module_fields',
	'complexType',
   	 'struct',
   	 'all',
  	  '',
		array(
        	'module_name'=>array('name'=>'module_name', 'type'=>'xsd:string'),
			'module_fields'=>array('name'=>'module_fields', 'type'=>'tns:field_list'),
			'link_fields'=>array('name'=>'link_fields', 'type'=>'tns:link_field_list'),
		)
);

// a listing of available modules
$server->wsdl->addComplexType(
    'module_list',
	'complexType',
   	 'struct',
   	 'all',
  	  '',
		array(
			'modules'=>array('name'=>'modules', 'type'=>'tns:select_fields'),
			'error' => array('name' =>'error', 'type'=>'tns:error_value'),
		)
);

$server->wsdl->addComplexType(
    'error_value',
	'complexType',
   	 'struct',
   	 'all',
  	  '',
		array(
        	'number'=>array('name'=>'number', 'type'=>'xsd:string'),
			'name'=>array('name'=>'name', 'type'=>'xsd:string'),
			'description'=>array('name'=>'description', 'type'=>'xsd:string'),
		)
);



$server->wsdl->addComplexType(
    'entry_value',
	'complexType',
   	 'struct',
   	 'all',
  	  '',
		array(
        	'id'=>array('name'=>'id', 'type'=>'xsd:string'),
			'module_name'=>array('name'=>'module_name', 'type'=>'xsd:string'),
			'name_value_list'=>array('name'=>'name_value_list', 'type'=>'tns:name_value_list'),
		)
);

$server->wsdl->addComplexType(
    'entry_list',
	'complexType',
   	 'array',
   	 '',
  	  'SOAP-ENC:Array',
	array(),
    array(
        array('ref'=>'SOAP-ENC:arrayType', 'wsdl:arrayType'=>'tns:entry_value[]')
    ),
	'tns:entry_value'
);


$server->wsdl->addComplexType(
   	 'get_mailmerge_document_result',
   	 'complexType',
   	 'struct',
   	 'all',
  	  '',
	array(
		'html' => array('name'=>'html', 'type'=>'xsd:string'),
		'name_value_list'=>array('name'=>'name_value_list', 'type'=>'tns:name_value_list'),
		'error' => array('name' =>'error', 'type'=>'tns:error_value'),
	)
);

$server->wsdl->addComplexType(
    'link_name_to_fields_array',
	'complexType',
   	 'struct',
   	 'all',
  	  '',
		array(
        		'name'=>array('name'=>'name', 'type'=>'xsd:string'),
				'value'=>array('name'=>'value', 'type'=>'tns:select_fields'),
		)
);

$server->wsdl->addComplexType(
    'link_value',
	'complexType',
   	 'array',
   	 '',
  	  'SOAP-ENC:Array',
	array(),
    array(
        array('ref'=>'SOAP-ENC:arrayType', 'wsdl:arrayType'=>'tns:name_value_list[]')
    ),
	'tns:name_value'
);

$server->wsdl->addComplexType(
    'link_array_list',
	'complexType',
   	 'array',
   	 '',
  	  'SOAP-ENC:Array',
	array(),
    array(
        array('ref'=>'SOAP-ENC:arrayType', 'wsdl:arrayType'=>'tns:link_value[]')
    ),
	'tns:link_value'
);

$server->wsdl->addComplexType(
    'link_name_value',
	'complexType',
   	 'struct',
   	 'all',
  	  '',
		array(
        	'name'=>array('name'=>'name', 'type'=>'xsd:string'),
			'records'=>array('name'=>'records', 'type'=>'tns:link_array_list'),
		)
);

$server->wsdl->addComplexType(
    'link_list',
	'complexType',
   	 'array',
   	 '',
  	  'SOAP-ENC:Array',
	array(),
    array(
        array('ref'=>'SOAP-ENC:arrayType', 'wsdl:arrayType'=>'tns:link_name_value[]')
    ),
	'tns:link_name_value'
);

$server->wsdl->addComplexType(
    'link_lists',
	'complexType',
   	 'array',
   	 '',
  	  'SOAP-ENC:Array',
	array(),
    array(
        array('ref'=>'SOAP-ENC:arrayType', 'wsdl:arrayType'=>'tns:link_list[]')
    ),
	'tns:link_list'
);

$server->wsdl->addComplexType(
   	 'get_entry_result_version2',
   	 'complexType',
   	 'struct',
   	 'all',
  	  '',
	array(
		'entry_list' => array('name' =>'entry_list', 'type'=>'tns:entry_list'),
		'relationship_list' => array('name' =>'relationship_list', 'type'=>'tns:link_lists'),
	)
);

$server->wsdl->addComplexType(
   	 'return_search_result',
   	 'complexType',
   	 'struct',
   	 'all',
  	  '',
	array(
		'entry_list' => array('name' =>'entry_list', 'type'=>'tns:link_list'),
	)
);

$server->wsdl->addComplexType(
   	 'get_entry_list_result',
   	 'complexType',
   	 'struct',
   	 'all',
  	  '',
	array(
		'result_count' => array('name'=>'result_count', 'type'=>'xsd:int'),
		'next_offset' => array('name'=>'next_offset', 'type'=>'xsd:int'),
		'field_list'=>array('name'=>'field_list', 'type'=>'tns:field_list'),
		'entry_list' => array('name' =>'entry_list', 'type'=>'tns:entry_list'),
		'error' => array('name' =>'error', 'type'=>'tns:error_value'),
	)
);

$server->wsdl->addComplexType(
   	 'get_entry_list_result_version2',
   	 'complexType',
   	 'struct',
   	 'all',
  	  '',
	array(
		'result_count' => array('name'=>'result_count', 'type'=>'xsd:int'),
		'next_offset' => array('name'=>'next_offset', 'type'=>'xsd:int'),
		'entry_list' => array('name' =>'entry_list', 'type'=>'tns:entry_list'),
		'relationship_list' => array('name' =>'relationship_list', 'type'=>'tns:link_lists'),
	)
);

$server->wsdl->addComplexType(
   	 'get_entry_result',
   	 'complexType',
   	 'struct',
   	 'all',
  	  '',
	array(
		'field_list'=>array('name'=>'field_list', 'type'=>'tns:field_list'),
		'entry_list' => array('name' =>'entry_list', 'type'=>'tns:entry_list'),
		'error' => array('name' =>'error', 'type'=>'tns:error_value'),
	)
);

$server->wsdl->addComplexType(
   	 'get_server_info_result',
   	 'complexType',
   	 'struct',
   	 'all',
  	  '',
	array(
		'flavor' => array('name'=>'id', 'type'=>'xsd:string'),
		'version' => array('name'=>'id', 'type'=>'xsd:string'),
		'gmt_time' => array('name'=>'id', 'type'=>'xsd:string'),
	)
);


$server->wsdl->addComplexType(
   	 'set_entry_result',
   	 'complexType',
   	 'struct',
   	 'all',
  	  '',
	array(
		'id' => array('name'=>'id', 'type'=>'xsd:string'),
		'error' => array('name' =>'error', 'type'=>'tns:error_value'),
	)
);

$server->wsdl->addComplexType(
   	 'new_set_entry_result',
   	 'complexType',
   	 'struct',
   	 'all',
  	  '',
	array(
		'id' => array('name'=>'id', 'type'=>'xsd:string'),
	)
);

$server->wsdl->addComplexType(
   	 'new_set_entries_result',
   	 'complexType',
   	 'struct',
   	 'all',
  	  '',
	array(
		'ids' => array('name'=>'ids', 'type'=>'tns:select_fields'),
	)
);

$server->wsdl->addComplexType(
   	 'set_entries_result',
   	 'complexType',
   	 'struct',
   	 'all',
  	  '',
	array(
		'ids' => array('name'=>'ids', 'type'=>'tns:select_fields'),
		'error' => array('name' =>'error', 'type'=>'tns:error_value'),
	)
);

$server->wsdl->addComplexType(
   	 'id_mod',
   	 'complexType',
   	 'struct',
   	 'all',
  	  '',
	array(
		'id' => array('name'=>'id', 'type'=>'xsd:string'),
		'date_modified' => array('name' =>'date_modified', 'type'=>'xsd:string'),
		'deleted' => array('name' =>'deleted', 'type'=>'xsd:int'),
	)
);

//these are just a list of fields we want to get
$server->wsdl->addComplexType(
    'ids_mods',
	'complexType',
   	 'array',
   	 '',
  	  'SOAP-ENC:Array',
	array(),
    array(
        array('ref'=>'SOAP-ENC:arrayType', 'wsdl:arrayType'=>'tns:id_mod[]')
    ),
	'tns:id_mod'
);

$server->wsdl->addComplexType(
   	 'get_relationships_result',
   	 'complexType',
   	 'struct',
   	 'all',
  	  '',
	array(
		'ids' => array('name'=>'ids', 'type'=>'tns:ids_mods'),
		'error' => array('name' =>'error', 'type'=>'tns:error_value'),
	)
);




$server->wsdl->addComplexType(
    'set_relationship_value',
	'complexType',
   	 'struct',
   	 'all',
  	  '',
		array(
			'module1'=>array('name'=>'module1', 'type'=>'xsd:string'),
			'module1_id'=>array('name'=>'module1_id', 'type'=>'xsd:string'),
			'module2'=>array('name'=>'module2', 'type'=>'xsd:string'),
			'module2_id'=>array('name'=>'module_2_id', 'type'=>'xsd:string'),

		)
);

$server->wsdl->addComplexType(
    'set_relationship_list',
	'complexType',
   	 'array',
   	 '',
  	  'SOAP-ENC:Array',
	array(),
    array(
        array('ref'=>'SOAP-ENC:arrayType', 'wsdl:arrayType'=>'tns:set_relationship_value[]')
    ),
	'tns:set_relationship_value'
);

$server->wsdl->addComplexType(
    'new_set_relationhip_ids',
	'complexType',
   	 'array',
   	 '',
  	  'SOAP-ENC:Array',
	array(),
    array(
        array('ref'=>'SOAP-ENC:arrayType', 'wsdl:arrayType'=>'tns:select_fields[]')
    ),
	'tns:select_fields'
);

$server->wsdl->addComplexType(
   	 'new_set_relationship_list_result',
   	 'complexType',
   	 'struct',
   	 'all',
  	  '',
	array(
		'created' => array('name'=>'created', 'type'=>'xsd:int'),
		'failed' => array('name'=>'failed', 'type'=>'xsd:int'),
	)
);

$server->wsdl->addComplexType(
   	 'set_relationship_list_result',
   	 'complexType',
   	 'struct',
   	 'all',
  	  '',
	array(
		'created' => array('name'=>'created', 'type'=>'xsd:int'),
		'failed' => array('name'=>'failed', 'type'=>'xsd:int'),
		'error' => array('name' =>'error', 'type'=>'tns:error_value'),
	)
);

//SYNC ENCODED (PHP ONLY SUPPORT)

$server->wsdl->addComplexType(
   	 'sync_set_entries_encoded',
   	 'complexType',
   	 'struct',
   	 'all',
  	  '',
	array(
		'conflicts' => array('name'=>'conflicts', 'type'=>'xsd:string'),
		'status' => array('name'=>'status', 'type'=>'xsd:string'),
		'ids' => array('name'=>'ids', 'type'=>'tns:select_fields'),
		'error' => array('name' =>'error', 'type'=>'tns:error_value'),
	)
);
$server->wsdl->addComplexType(
    'document_revision',
    'complexType',
    'struct',
    'all',
    '',
    array(
        "id" => array('name'=>"id",'type'=>'xsd:string'),
		"document_name" => array('name'=>"document_name",'type'=>'xsd:string'),
		"revision" => array('name' => "revision", 'type'=>'xsd:string'),
		"filename" => array('name' => "filename", 'type'=>'xsd:string'),
		"file" => array('name'=>"file",'type'=>'xsd:string'),
    )
);

$server->wsdl->addComplexType(
   	 'get_entry_list_result_encoded',
   	 'complexType',
   	 'struct',
   	 'all',
  	  '',
	array(
		'result_count' => array('name'=>'result_count', 'type'=>'xsd:int'),
		'next_offset' => array('name'=>'next_offset', 'type'=>'xsd:int'),
		'total_count' => array('name'=>'total_count', 'type'=>'xsd:int'),
		'field_list' => array('name'=>'field_list', 'type'=>'tns:select_fields'),
		'entry_list' => array('name'=>'entry_list', 'type'=>'xsd:string'),
		'error' => array('name' =>'error', 'type'=>'tns:error_value'),
	)
);

$server->wsdl->addComplexType(
   	 'get_sync_result_encoded',
   	 'complexType',
   	 'struct',
   	 'all',
  	  '',
	array(
		'result' => array('name'=>'result', 'type'=>'xsd:string'),
		'error' => array('name' =>'error', 'type'=>'tns:error_value'),
	)
);

$server->wsdl->addComplexType(
   	 'get_quick_sync_result_encoded',
   	 'complexType',
   	 'struct',
   	 'all',
  	  '',
	array(
		'result' => array('name'=>'result', 'type'=>'xsd:string'),
		'result_count' => array('name'=>'result_count', 'type'=>'xsd:int'),
		'next_offset' => array('name'=>'next_offset', 'type'=>'xsd:int'),
		'total_count' => array('name'=>'total_count', 'type'=>'xsd:int'),
		'error' => array('name' =>'error', 'type'=>'tns:error_value'),
	)
);

$server->wsdl->addComplexType(
    'return_document_revision',
    'complexType',
    'struct',
    'all',
    '',
    array(
        "document_revision"=>array('name'=>'document_revision', 'type'=>'tns:document_revision'),
		"error"=> array('name'=>'error', 'type'=>'tns:error_value'),
    )
);

$server->wsdl->addComplexType(
    'new_return_document_revision',
    'complexType',
    'struct',
    'all',
    '',
    array(
        "document_revision"=>array('name'=>'document_revision', 'type'=>'tns:document_revision'),
    )
);

$server->wsdl->addComplexType(
    'name_value_operator',
    'complexType',
     'struct',
     'all',
      '',
        array(
            'name'=>array('name'=>'name', 'type'=>'xsd:string'),
            'value'=>array('name'=>'value', 'type'=>'xsd:string'),
            'operator'=>array('name'=>'operator', 'type'=>'xsd:string'),
            'value_array'=>array('name'=>'value_array', 'type'=>'tns:select_fields')
        )
);

$server->wsdl->addComplexType(
    'name_value_operator_list',
    'complexType',
     'array',
     '',
      'SOAP-ENC:Array',
    array(),
    array(
        array('ref'=>'SOAP-ENC:arrayType', 'wsdl:arrayType'=>'tns:name_value_operator[]')
    ),
    'tns:name_value_operator'
);
$server->wsdl->addComplexType(
    'newsletter',
    'complexType',
     'struct',
     'all',
      '',
        array(
            'name'=>array('name'=>'name', 'type'=>'xsd:string'),
            'prospect_list_id'=>array('name'=>'prospect_list_id', 'type'=>'xsd:string'),
            'campaign_id'=>array('name'=>'campaign_id', 'type'=>'xsd:string'),
            'description'=>array('name'=>'description', 'type'=>'xsd:string'),
            'frequency'=>array('name'=>'frequency', 'type'=>'xsd:string'),
        )
);

$server->wsdl->addComplexType(
    'newsletter_list',
    'complexType',
     'array',
     '',
      'SOAP-ENC:Array',
    array(),
    array(
        array('ref'=>'SOAP-ENC:arrayType', 'wsdl:arrayType'=>'tns:newsletter[]')
    ),
    'tns:newsletter'
);


$server->wsdl->addComplexType(
     'get_subscription_lists_result',
     'complexType',
     'struct',
     'all',
      '',
    array(
        'unsubscribed' => array('name'=>'unsubscribed', 'type'=>'tns:newsletter_list'),
        'subscribed' => array('name'=>'subscribed', 'type'=>'tns:newsletter_list'),
        'error' => array('name' =>'error', 'type'=>'tns:error_value'),
    )
);
// generic type for an array of strings
$server->wsdl->addComplexType(
	'str_array',
	'complexType',
	'array',
	'',
	'SOAP-ENC:Array',
	array(),
	array(
        array(
        	'ref' => 'SOAP-ENC:arrayType',
        	'wsdl:arrayType' => 'xsd:string[]'
        )
    ),
	'xsd:string'
);

$server->wsdl->addComplexType(
	'name_value_lists_error',
	'complexType',
	'struct',
	'all',
	'',
	array(
		'name_value_lists' => array(
			'name' => 'panels',
			'type' => 'tns:name_value_lists'
		),
		'error' => array(
			'name' => 'error',
			'type' => 'tns:error_value'
		)
	)
);

$server->wsdl->addComplexType(
   	 'get_entries_count_result',
   	 'complexType',
   	 'struct',
   	 'all',
  	  '',
	array(
		'result_count'=>array('name'=>'result_count', 'type'=>'xsd:int'),
		'error' => array('name' =>'error', 'type'=>'tns:error_value'),
	)
);

$server->wsdl->addComplexType(
   	 'set_entries_detail_result',
   	 'complexType',
   	 'struct',
   	 'all',
  	  '',
	array(
		'name_value_lists' => array('name'=>'name_value_lists', 'type'=>'tns:name_value_lists'),
		'error' => array('name' =>'error', 'type'=>'tns:error_value'),
	)
);
?>
