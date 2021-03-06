<?php


class DotbForecasting_Individual extends DotbForecasting_AbstractForecast implements DotbForecasting_ForecastSaveInterface
{
    /**
     * Where we store the data we want to use
     *
     * @var array
     */
    protected $dataArray = array();

    /**
     * Run all the tasks we need to process get the data back
     *
     * @deprecated
     * @see ForecastWorksheetsFilterApi
     * @return array|string
     */
    public function process()
    {
        return array();
    }


    /**
     * getQuery
     * @deprecated
     * This is a helper function to allow for the query function to be used in ForecastWorksheet->create_export_query
     */
    public function getQuery()
    {
        return '';
    }

    /**
     * Save the Individual Worksheet
     *
     * @return ForecastWorksheet
     * @throws DotbApiException
     */
    public function save()
    {
        /* @var $seed ForecastWorksheet */
        $seed = BeanFactory::newBean("ForecastWorksheets");
        $seed->loadFromRow($this->args);
        $sfh = new DotbFieldHandler();

        foreach ($seed->field_defs as $properties) {
            $fieldName = $properties['name'];

            if(!isset($this->args[$fieldName])) {
               continue;
            }

            if (!$seed->ACLFieldAccess($fieldName,'save') ) {
                // No write access to this field, but they tried to edit it
                global $app_strings;
                throw new DotbApiException(string_format($app_strings['DOTB_API_EXCEPTION_NOT_AUTHORIZED'], array($fieldName, $this->args['module'])));
            }

            $type = !empty($properties['custom_type']) ? $properties['custom_type'] : $properties['type'];
            $field = $sfh->getDotbField($type);

            if(!is_null($field)) {
               $field->save($seed, $this->args, $fieldName, $properties);
            }
        }

        $seed->setWorksheetArgs($this->args);
        // we need to set the parent_type and parent_id so it finds it when we try and retrieve the old records
        $seed->parent_type = $this->getArg('parent_type');
        $seed->parent_id = $this->getArg('parent_id');
        $seed->saveWorksheet();

        // we have the id, just retrieve the record again
        $seed = BeanFactory::getBean("ForecastWorksheets", $this->getArg('record'));

        return $seed;
    }
}
