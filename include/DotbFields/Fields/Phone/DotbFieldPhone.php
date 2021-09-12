<?php




class DotbFieldPhone extends DotbFieldBase {

	/**
     * This should be called when the bean is saved. The bean itself will be passed by reference
     *
     * @param DotbBean bean - the bean performing the save
     * @param array params - an array of paramester relevant to the save, most likely will be $_REQUEST
     */
	public function save($bean, $params, $field, $properties, $prefix = ''){
		 parent::save($bean, $params, $field, $properties, $prefix);
         	 	if (isset($params[$prefix.$field]))
		            $bean->$field = $params[$prefix.$field];
                //Add format field phone - By Lap Nguyen
                //$bean->$field = formatPhoneNumber($bean->$field);

    }

}
