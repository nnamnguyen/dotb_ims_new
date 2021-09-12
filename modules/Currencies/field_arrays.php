<?php

/*********************************************************************************

 * Description:  Contains field arrays that are used for caching
 ********************************************************************************/
$fields_array['Currency'] = array ('column_fields' => Array("id"
		,"name"
		,"conversion_rate"
		,"iso4217"
		,"symbol"
		,'status'
                ,"deleted"
                ,"date_entered"
                ,"date_modified"
		),
        'required_fields' => array('name'=>1, 'symbol'=>2, 'conversion_rate'=>3, 'iso4217'=>4 , 'status'=>5),
);
?>