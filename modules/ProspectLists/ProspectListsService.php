<?php

class ProspectListsService
{
    /**
     * Add records to a specific prospect list
     *
     * @param $moduleName         the module name for the records that will be associated to the prospect list
     * @param $prospectListId the id of the prospect list
     * @param $recordIds      Array of record ids to be added to the prospect list
     * @return $results       Associative array containing status for each record.
     */
    public function addRecordsToProspectList($moduleName, $prospectListId, $recordIds)
    {
        $prospectList = BeanFactory::getBean("ProspectLists", $prospectListId, array('strict_retrieve' => true));

        if(empty($prospectList)) {
            return false;
        }

        $bean = BeanFactory::newBean($moduleName);
        $results = array();
        $relationship = '';

        foreach ($bean->get_linked_fields() as $field => $def) {
            if ($bean->load_relationship($field)) {
                if ($bean->$field->getRelatedModuleName() == 'ProspectLists') {
                    $relationship = $field;
                    break;
                }
            }
        }

        if ($relationship != '') {
            foreach ($recordIds as $id) {
                $retrieveResult = $bean->retrieve($id);
                if ($retrieveResult === null) {
                    $results[$id] = false;
                } else {
                    $bean->load_relationship($relationship);
                    $bean->prospect_lists->add($prospectListId);
                    $results[$id] = true;
                }
            }
        }

        return $results;
    }
}