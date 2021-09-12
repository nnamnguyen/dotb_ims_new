<?php




class DotbFieldDate extends DotbFieldDatetime {

    /**
     * Handles export field sanitizing for field type
     *
     * @param $value string value to be sanitized
     * @param $vardef array representing the vardef definition
     * @param $focus DotbBean object
     * @param $row Array of a row of data to be exported
     *
     * @return string sanitized value
     */
    public function exportSanitize($value, $vardef, $focus, $row=array())
    {
        $timedate = TimeDate::getInstance();
        $db = DBManagerFactory::getInstance();
        //If it's in ISO format, convert it to db format
        if(preg_match('/(\d{4})\-?(\d{2})\-?(\d{2})T(\d{2}):?(\d{2}):?(\d{2})\.?\d*([Z+-]?)(\d{0,2}):?(\d{0,2})/i', $value)) {
           $value = $timedate->fromIso($value)->asDbDate(false);
        }

        return $timedate->to_display_date($db->fromConvert($value, 'date'), false);
    }

    /**
     * {@inheritdoc}
     */
    public function fixForFilter(&$value, $columnName, DotbBean $bean, DotbQuery $q, DotbQuery_Builder_Where $where, $op)
    {
        return true;
    }

    /**
     * pass value through
     * @param $value
     * @return string
     */
    public function apiUnformatField($value)
    {
        return $value;
    }

}
