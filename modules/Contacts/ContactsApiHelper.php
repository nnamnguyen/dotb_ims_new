<?php



class ContactsApiHelper extends DotbBeanApiHelper
{
    /**
     * This function checks the sync_contact var and does the appropriate actions
     * @param DotbBean $bean
     * @param array $submittedData
     * @param array $options
     * @return array
     */
    public function populateFromApi(DotbBean $bean, array $submittedData, array $options = array())
    {
        global $current_user;
        $data = parent::populateFromApi($bean, $submittedData, $options);

        if ($data) {
            if (!empty($bean->emailAddress) && $bean->emailAddress->addresses != $bean->emailAddress->fetchedAddresses
            ) {
                $bean->emailAddress->populateLegacyFields($bean);
            }

            if (isset($submittedData['sync_contact'])) {
                $bean->sync_contact = $submittedData['sync_contact'];
            }
        }

        return $data;
    }


}
