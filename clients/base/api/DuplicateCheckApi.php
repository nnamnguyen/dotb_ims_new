<?php


class DuplicateCheckApi extends DotbApi
{
    public function registerApiRest()
    {
        return array(
            'duplicateCheck' => array(
                'reqType' => 'POST',
                'path' => array('<module>','duplicateCheck'),
                'pathVars' => array('module',''),
                'method' => 'checkForDuplicates',
                'shortHelp' => 'Check for duplicate records within a module',
                'longHelp' => 'include/api/help/module_duplicatecheck_post_help.html',
            ),
        );
    }

    /**
     * Using the appropriate duplicate check service, search for duplicates in the system
     * TODO: we should refactor some of the bean loading in DotbApi so we can move some of this logic there
     *
     * @param ServiceBase $api
     * @param array $args
     */
    function checkForDuplicates(ServiceBase $api, array $args)
    {
        //create a new bean & check ACLs
        $bean = BeanFactory::newBean($args['module']);

        if (!$bean) {
            throw new DotbApiExceptionInvalidParameter(
                'Module ' . $args['module'] . ' cannot be used for duplicate check'
            );
        }

        $args=$this->trimArgs($args);

        if (!$bean->ACLAccess('read')) {
            throw new DotbApiExceptionNotAuthorized('No access to read records for module: '.$args['module']);
        }

        //populate bean
        $options = array('acl' => 'read', 'find_duplicates' => true);
        $errors = $this->populateFromApi($api, $bean, $args, $options);
        if ($errors !== true) {
            $displayErrors = print_r($errors, true);
            throw new DotbApiExceptionInvalidParameter("Unable to run duplicate check. There were validation errors on the submitted data: $displayErrors");
        }

        //retrieve possible duplicates
        $results = $bean->findDuplicates();

        if ($results) {
            return $results;
        } else {
            return array();
        }

    }

    protected function trimArgs(array $args)
    {
        $args2 = array();
        foreach($args as $key => $value) {
            $args2[trim($key)] = (is_string($value)) ? trim($value) : $value;
        }
        return $args2;
    }

    protected function populateFromApi(ServiceBase $api, DotbBean $bean, array $args, array $options = array())
    {
        $errors = ApiHelper::getHelper($api, $bean)->populateFromApi($bean, $args, $options);

        // remove email_addr_bean_rel records created by DotbFieldEmail::apiSave() for new bean (empty id)
        if (empty($args['id']) && !empty($bean->emailAddress)) {
            $bean->emailAddress->deleteLinks($bean->id, $bean->module_dir);
        }

        return $errors;
    }
}
