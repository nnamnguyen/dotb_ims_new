<?php



/*
 * Record List API implementation
 */
class RecordListApi extends DotbApi
{
    public function registerApiRest()
    {
        return array(
            'recordListCreate' => array(
                'reqType' => 'POST',
                'path' => array('<module>','record_list'),
                'pathVars' => array('module',''),
                'jsonParams' => array('filter'),
                'method' => 'recordListCreate',
                'shortHelp' => 'An API to create and save lists of records',
                'longHelp' => 'include/api/help/module_recordlist_post.html',
            ),
            'recordListDelete' => array(
                'reqType' => 'DELETE',
                'path' => array('<module>','record_list','?'),
                'pathVars' => array('module','','record_list_id'),
                'method' => 'recordListDelete',
                'shortHelp' => 'An API to delete an old record list',
                'longHelp' => 'include/api/help/module_recordlist_delete.html',
            ),
            'recordListGet' => array(
                'reqType' => 'GET',
                'path' => array('<module>','record_list','?'),
                'pathVars' => array('module','','record_list_id'),
                'method' => 'recordListGet',
                'shortHelp' => 'An API to fetch a previously created record list',
                'longHelp' => 'include/api/help/module_recordlist_get.html',
            ),
        );
    }

    /**
     * To create a record list
     * @param ServiceBase $api The API class of the request, used in cases where the API changes how the fields are pulled from the args array.
     * @param array $args The arguments array passed in from the API containing the module and the records
     * @return array id, module, records
     */
    public function recordListCreate(ServiceBase $api, array $args)
    {
        $seed = BeanFactory::newBean($args['module']);

        if (!$seed->ACLAccess('access')) {
            throw new DotbApiExceptionNotAuthorized();
        }

        if (!is_array($args['records'])) {
            throw new DotbApiExceptionMissingParameter();
        }
        
        $id = RecordListFactory::saveRecordList($args['records'], $args['module']);

        $loadedRecordList = RecordListFactory::getRecordList($id);
        
        return $loadedRecordList;
    }

    /**
     * To delete a record list
     * @param ServiceBase $api The API class of the request, used in cases where the API changes how the fields are pulled from the args array.
     * @param array $args The arguments array passed in from the API containing the module
     * @return bool Did the delete succeed
     */
    public function recordListDelete(ServiceBase $api, array $args)
    {
        $seed = BeanFactory::newBean($args['module']);
        if (!$seed->ACLAccess('access')) {
            throw new DotbApiExceptionNotAuthorized();
        }

        if (empty($args['record_list_id'])) {
            throw new DotbApiExceptionMissingParameter();
        }
        if (!$api->user->isAdmin()) {
            $recordList = RecordListFactory::getRecordList($args['record_list_id']);
            if ($recordList['assigned_user_id'] != $api->user->id) {
                throw new DotbApiExceptionNotAuthorized();
            }
        }

        $ret = RecordListFactory::deleteRecordList($args['record_list_id']);

        return true;
    }

    /**
     * To retrieve a record list
     * @param ServiceBase $api The API class of the request, used in cases where the API changes how the fields are pulled from the args array.
     * @param array $args The arguments array passed in from the API containing the module and id of the record list
     * @return array The record list
     */
    public function recordListGet(ServiceBase $api, array $args)
    {
        $seed = BeanFactory::newBean($args['module']);
        if (!$seed->ACLAccess('access')) {
            throw new DotbApiExceptionNotAuthorized();
        }

        $recordList = RecordListFactory::getRecordList($args['record_list_id']);
        if ($recordList == null) {
            throw new DotbApiExceptionNotFound();
        }
        if ($recordList['module_name'] != $args['module']) {
            throw new DotbApiExceptionNotAuthorized();
        }
        if (!$api->user->isAdmin()) {
            if ($recordList['assigned_user_id'] != $api->user->id) {
                throw new DotbApiExceptionNotAuthorized();
            }
        }

        return $recordList;
    }
}
