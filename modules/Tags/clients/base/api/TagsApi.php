<?php



/**
 * Extends ModuleApi for Tags specific work
 *
 * Class TagsApi
 */
class TagsApi extends ModuleApi
{
    /**
     * Set up the endpoint for Tags
     *
     * @return array
     */
    public function registerApiRest()
    {
        return array(
            'update' => array(
                'reqType' => 'PUT',
                'path' => array('Tags','?'),
                'pathVars' => array('module','record'),
                'method' => 'updateRecord',
                'shortHelp' => 'This method updates a record of the specified type',
                'longHelp' => 'include/api/help/module_record_put_help.html',
            ),
        );
    }

    /**
     * Fetches data from the $args array and updates the bean with that data
     *
     * @param DotbBean   $bean The bean to be updated
     * @param ServiceBase $api  The API class of the request, used in cases
     *      where the API changes how the fields are pulled from the args array.
     * @param array       $args The arguments array passed in from the API
     * @return id Bean id
     */
    public function updateBean(DotbBean $bean, ServiceBase $api, array $args)
    {
        //Set verfiedUnique from args
        $bean->verifiedUnique = !empty($args['verifiedUnique']);
        return parent::updateBean($bean, $api, $args);
    }
}
