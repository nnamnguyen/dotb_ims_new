<?php



class TeamsApiHelper extends DotbBeanApiHelper
{

    /**
     * Formats the bean so it is ready to be handed back to the API's client. Certian fields will get extra processing
     * to make them easier to work with from the client end.
     *
     * @param $bean DotbBean The bean you want formatted
     * @param $fieldList array Which fields do you want formatted and returned (leave blank for all fields)
     * @param $options array Currently no options are supported
     * @return array The bean in array format, ready for passing out the API to clients.
     */
    public function formatForApi(DotbBean $bean, array $fieldList = array(), array $options = array())
    {
        $data = parent::formatForApi($bean, $fieldList, $options);

        if (in_array("name", $fieldList) && !empty($bean->name_2)) {
            $data['name'] = trim($bean->name . ' ' . $bean->name_2);
            if (!empty($data['name_2'])) {
                $data['name_2'] = '';
            }
        }

        return $data;
    }
}
