<?php



class LeadsApiHelper extends DotbBeanApiHelper
{
    public function populateFromApi(DotbBean $bean, array $submittedData, array $options = array())
    {
        foreach ($submittedData as $fieldName => $data) {
            if (isset($bean->field_defs[$fieldName])) {
                $properties = $bean->field_defs[$fieldName];
                $type = !empty($properties['custom_type']) ? $properties['custom_type'] : $properties['type'];
                /* Field with name=email is the only field of type=email supported at this time */
                if ($type === 'email') {
                    if ($fieldName !== 'email') {
                        unset($submittedData[$fieldName]);
                    }
                }
            }
        }

        parent::populateFromApi($bean, $submittedData, $options);

        return true;
    }
}

