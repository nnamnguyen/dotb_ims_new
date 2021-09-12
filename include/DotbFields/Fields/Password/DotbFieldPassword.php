<?php




class DotbFieldPassword extends DotbFieldBase 
{
    /**
     * @see DotbFieldBase::importSanitize()
     */
    public function importSanitize(
        $value,
        $vardef,
        $focus,
        ImportFieldSanitize $settings
        )
    {
        $value = md5($value);
        
        return $value;
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

        $data[$fieldName] = true;
        if(empty($bean->$fieldName)) {
            $data[$fieldName] = null;
        }
    }

    /**
     * Encrypt and save a password
     * {@inheritdoc}
     */
    public function apiSave(DotbBean $bean, array $params, $fieldName, $properties)
    {
        if(!isset($params[$fieldName])) {
            return;
        }
        if(empty($params[$fieldName])) {
            $bean->$fieldName = null;
        } elseif($params[$fieldName] !== true) {
            $bean->$fieldName = User::getPasswordHash($params[$fieldName]);
        }
    }
}
