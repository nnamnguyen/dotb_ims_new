<?php



require_once('include/DotbSmarty/plugins/function.dotb_replace_vars.php');

class DotbFieldLink extends DotbFieldBase {

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

        // this is only for generated links
    	if(isset($bean->field_defs[$fieldName]['gen']) && isTruthy($bean->field_defs[$fieldName]['gen'])) {
            $subject = $bean->field_defs[$fieldName]['default'];
            if (!empty($subject)) {
                $data[$fieldName] = replace_dotb_vars($subject, $bean->toArray(), true);
            } else {
                $data[$fieldName] = "";
            }
	    } else {
            parent::apiFormatField($data, $bean, $args, $fieldName, $properties, $fieldList, $service);
        }
    }
}
