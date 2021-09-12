<?php



class ReportsApiHelper extends DotbBeanApiHelper
{
    /**
     * This function sets the fromApi var on Reports to true so Exceptions are handled properly
     * @param DotbBean $bean
     * @param array $submittedData
     * @param array $options
     * @return array
     */
    public function populateFromApi(DotbBean $bean, array $submittedData, array $options = array())
    {
        $bean->fromApi = true;

        // if we update the name, we need to update the report_def as well
        if (isset($submittedData['name']) && $submittedData['name'] !== $bean->name) {
            $fieldName = 'content';
            // if content is sent over, we want to update that, otherwise get the data from the bean
            $content = isset($submittedData[$fieldName]) ? $submittedData[$fieldName] : $bean->$fieldName;
            $tmpContent = json_decode($content, true);
            $tmpContent['report_name'] = $submittedData['name'];
            $submittedData[$fieldName] = JSON::encode($tmpContent);
        }

        return parent::populateFromApi($bean, $submittedData, $options);
    }

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
        if(isset($bean->fetched_row) && !empty($bean->fetched_row['report_type']) && $bean->report_type == 'summary' && $bean->fetched_row['report_type'] == 'Matrix') {
            $bean->report_type = $bean->fetched_row['report_type'];
        }
        return parent::formatForApi($bean, $fieldList, $options);
    }

    /**
     * @inheritDoc
     */
    public function sanitizeSubmittedData($data)
    {
        // to use the original posted module instead of the one from api path
        if (!empty($GLOBALS['HTTP_RAW_POST_DATA'])) {
            $postContents = $GLOBALS['HTTP_RAW_POST_DATA'];
        } else {
            $postContents = file_get_contents('php://input');
        }
        if ($postContents) {
            $postArray = json_decode($postContents, true);
            if (!empty($postArray['module'])) {
                $data['module'] = $postArray['module'];
            }
        }
        return $data;
    }
}
