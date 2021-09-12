<?php




/**
 * DotbField implementation for link fields
 */
class DotbFieldRelateLink extends DotbFieldBase
{
    /**
     * @var RelateApi
     */
    protected $relateApi;

    /**
     * {@inheritDoc}
     *
     * Does nothing since link field data is fetched by internal API call
     */
    public function addFieldToQuery($field, array &$fields)
    {
    }

    /**
     * {@inheritDoc}
     *
     * Does nothing since link field data can't be processed or saved here.
     */
    public function apiSave(DotbBean $bean, array $params, $field, $properties)
    {
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
        if (!is_array($fieldList)) {
            throw new DotbApiExceptionError('$fieldList argument of apiFormatField() is missing');
        }

        // don't render link fields unless it's explicitly requested
        if (!in_array($fieldName, $fieldList)) {
            return;
        }

        if (!$service) {
            throw new DotbApiExceptionError('$service argument of apiFormatField() is missing');
        }

        if (isset($args['display_params'][$fieldName])) {
            $displayParams = $args['display_params'][$fieldName];
        } else {
            $displayParams = array();
        }

        $data[$fieldName] = $this->getBeanCollection($bean, $properties, $displayParams, $service);
    }

    /**
     * {@inheritDoc}
     *
     * Applies the callback only to the given field and does not iterate over "fields" since they mean collection fields
     * to be retrieved, not nested fields as in base field.
     */
    public function iterateViewField(
        ViewIterator $iterator,
        array $field,
        /* callable */ $callback
    ) {
        $callback($field);
    }

    /**
     * Return the data that should be returned for link or collection field
     *
     * @param DotbBean $bean Source bean
     * @param array $field Link or collection field definition
     * @param array $displayParams Field display parameters
     * @param ServiceBase $service
     *
     * @return array
     * @throws DotbApiExceptionError
     */
    protected function getBeanCollection(DotbBean $bean, array $field, array $displayParams, ServiceBase $service)
    {
        $args = array_merge(array(
            // make sure "fields" argument is always passed to the API
            // since otherwise it will return all fields by default
            'fields' => array('id', 'date_modified'),
        ), $displayParams, array(
            'module' => $bean->module_name,
            'record' => $bean->id,
            'link_name' => $field['name'],
        ));

        $response = $this->getRelateApi()->filterRelated($service, $args);

        return $response;
    }

    /**
     * Lazily loads Relate API
     *
     * @return RelateApi
     */
    protected function getRelateApi()
    {
        if (!$this->relateApi) {
            $this->relateApi = new RelateApi();
        }

        return $this->relateApi;
    }
}
