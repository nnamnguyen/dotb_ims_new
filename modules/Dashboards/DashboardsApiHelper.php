<?php



class DashboardsApiHelper extends DotbBeanApiHelper
{
    /**
     * 'view' is deprecated because it's reserved db word.
     * Some old API (before 7.2.0) can use 'view'.
     * Because of that API will use 'view' as 'view_name' if 'view_name' isn't present.
     *
     * @param DotbBean $bean
     * @param array     $submittedData
     * @param array     $options
     *
     * @return array
     */
    public function populateFromApi(DotbBean $bean, array $submittedData, array $options = array())
    {
        if (isset($submittedData['view']) && !isset($submittedData['view_name'])) {
            $submittedData['view_name'] = $submittedData['view'];
        }
        return parent::populateFromApi($bean, $submittedData, $options);
    }

    /**
     * 'view' is deprecated because it's reserved db word.
     * Some old API (before 7.2.0) can use 'view'.
     * Because of that API will return 'view' with the same value as 'view_name'.
     *
     * @param DotbBean $bean
     * @param array     $fieldList
     * @param array     $options
     *
     * @return array
     */
    public function formatForApi(DotbBean $bean, array $fieldList = array(), array $options = array())
    {
        $data = parent::formatForApi($bean, $fieldList, $options);
        if (isset($data['view_name'])) {
            $data['view'] = $data['view_name'];
        }
        return $data;
    }
}
