<?php



class DotbFieldCurrency_id extends DotbFieldBase
{
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

        if (!empty($bean->$fieldName)) {
            $data[$fieldName] = $bean->$fieldName;
        } else {
            $data[$fieldName] = "-99";
        }
    }
}
