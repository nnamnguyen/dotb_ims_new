<?php

global $selector_meta_array;
$selector_meta_array = Array(

'normal_trigger' => Array(
				'enum_multi' => true
				,'time_type' => false
				,'select_field' => false
			),
'time_trigger' => Array(
				'enum_multi' => true
				,'time_type' => true
				,'select_field' => false
			),
'alert_filter' => Array(
				'enum_multi' => false
				,'time_type' => false
				,'select_field' => true
			),
'count_trigger' => Array(
				'enum_multi' => false
				,'time_type' => false
				,'select_field' => true
			),									
);
?>