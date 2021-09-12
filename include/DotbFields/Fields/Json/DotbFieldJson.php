<?php



/**
 * DotbFieldJson.php
 * 
 * A dotb field that json encodes the content of the field.
 *
 */


class DotbFieldJson extends DotbFieldBase {
	/**
     * This function handles turning the API's version of a teamset into what we actually store
     * @param DotbBean $bean - the bean performing the save
     * @param array $params - an array of paramester relevant to the save, which will be an array passed up to the API
     * @param string $fieldName - The name of the field to save (the vardef name, not the form element name)
     * @param array $properties - Any properties for this field
     */
    public function apiSave(DotbBean $bean, array $params, $fieldName, $properties) {
        // json encode the content
    	$bean->$fieldName = json_encode($params[$fieldName]);
    }

    /**
     * {@inheritDoc}
     */
    public function apiFormatField(
        array &$data,
        DotbBean $bean,
        array $args,
        $fieldName,
        $properties,
        array $fieldList = null,
        ServiceBase $service = null
    ) {
        $this->ensureApiFormatFieldArguments($fieldList, $service);

        if(isset($bean->$fieldName)) {
            $data[$fieldName] = json_decode($bean->$fieldName, true);
        }
    }

    
}
?>
