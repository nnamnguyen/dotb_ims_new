<?php

/*********************************************************************************

 * Description:  Contains field arrays that are used for caching
 ********************************************************************************/
$fields_array['UserPreferences'] = array ('column_fields' => Array(
		'id'
		,'category'
		,'name'
		,'contents'
		,'assigned_user_id'
		,'date_entered'
		,'date_modified'
		,'deleted'
		),
        'list_fields' =>  array('id', 'contents','category'),
);
?>