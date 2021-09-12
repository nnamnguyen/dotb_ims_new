<?php



class DotbFieldEncrypt extends DotbFieldBase
{
    /**
     * Decrypt encrypt fields values before inserting them into the emails
     *
     * @param string $inputField
     * @param mixed  $vardef
     * @param mixed  $displayParams
     * @param int    $tabindex
     *
     * @return string
     */
    public function getEmailTemplateValue($inputField, $vardef, $displayParams = array(), $tabindex = 0)
    {
        if ($this->allowRead($vardef)) {
            // Uncrypt the value
            $account = BeanFactory::newBean('Empty');

            return $account->decrypt_after_retrieve($inputField);
        }

        return '';
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
        //If read is not allowed, only return the null/not_null status of the field
        if ($this->allowRead($properties)) {
            $data[$fieldName] = $bean->$fieldName;
        } else {
            $data['_' . $fieldName . '_populated'] = !empty($bean->$fieldName);
        }
    }

    public function displayFromFunc($displayType, $parentFieldArray, $vardef, $displayParams, $tabindex = 0)
    {
        if ($this->allowRead($vardef)) {
            return parent::displayFromFunc($displayParams, $parentFieldArray, $vardef, $displayParams, $tabindex);
        }

        return '';
    }

    public function exportSanitize($value, $vardef, $focus, $row = array())
    {
        if ($this->allowRead($vardef)) {
            return parent::exportSanitize($value, $vardef, $focus, $row);
        }

        return '';
    }

    public function formatField($rawField, $vardef)
    {
        if ($this->allowRead($vardef)) {
            return parent::formatField($rawField, $vardef);
        }

        return '';
    }

    protected function allowRead($def)
    {
        return empty($def['write_only']);
    }
}
