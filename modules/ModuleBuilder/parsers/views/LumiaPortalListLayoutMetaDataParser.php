<?php


class LumiaPortalListLayoutMetaDataParser extends LumiaListLayoutMetaDataParser
{
    /**
     * Invalid field types for various lumia clients. Format should be
     * $client => array('type', 'type').
     *
     * @var array
     * @protected
     */
    protected $invalidTypes = array(
        'portal' => array('iframe', 'encrypt', 'html', 'currency', 'currency_id'),
    );

    /**
     * List of allowed views for this parser.
     *
     * This is checked in the constructor and will throw an exception if the
     * requested view is not allowed.
     *
     * @var array
     */
    protected $allowedViews = array(
        MB_PORTALLISTVIEW,
    );

    /**
     * Sets the sortable property of the fielddef
     *
     * @param string $fieldName  The name of the field being worked on
     * @param array $fieldDef The current fielddef collection for a field
     * @return array The modified fielddef collection
     */
    public function setDefSortable($fieldName, $fieldDef)
    {
        $fieldDef = parent::setDefSortable($fieldName, $fieldDef);

        //In the portal list view, disable the relate fields to be sortable even when "sort_on" is set.
        //Examples: created_by_name and modified_by_name have 'sort_on' => array('last_name')
        //In desktop version, their sortings are enabled, which uses FilterAPIs/DotbQuery to handle the database join.
        //In portal version, their sortings are disabled. It still uses unified search (spot search) API and no
        //handlings for related fields are added, since it will be migrated to use the new global search API later.
        if (isset($this->_fielddefs[$fieldName]['type']) && $this->_fielddefs[$fieldName]['type'] === 'relate') {
            $fieldDef['sortable'] = false;
        }
        return $fieldDef;
    }
}
