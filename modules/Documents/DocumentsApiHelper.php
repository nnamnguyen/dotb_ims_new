<?php



class DocumentsApiHelper extends DotbBeanApiHelper
{
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
        // If there was a field list requested and document_revision_id was not
        // a requested field we will have problems. Set the revision id so that 
        // additional fields like filename get picked up.
        if (!empty($fieldList) && !in_array('document_revision_id', $fieldList)) {
            $db = DBManagerFactory::getInstance();
            
            // Get the revision ID so that it can be set into the bean
            $query = sprintf(
                'SELECT document_revision_id FROM %s WHERE id = %s',
                $bean->table_name,
                $db->quoted($bean->id)
            );
            
            $rs = $db->query($query);
            $row = $db->fetchByAssoc($rs);
            if (isset($row['document_revision_id'])) {
                // Set the revision and setup everything else for a document that
                // depends on a revision id, like filename, revision, etc
                $bean->document_revision_id = $row['document_revision_id'];
                $bean->fill_in_additional_detail_fields();
            }
        }
        
        return parent::formatForApi($bean, $fieldList, $options);
    }
}
