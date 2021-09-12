<?php

class CalendarEventsApiHelper extends DotbBeanApiHelper
{
    /**
     * List of fields for calendar events that should be returned as an integer
     *
     * @var array
     */
    protected $numericFields = array(
        'duration_hours',
        'duration_minutes',
    );

    /**
     * @param Call|Meeting|DotbBean $bean
     * @param array $submittedData
     * @param array $options
     * @return array
     * @throws DotbApiExceptionMissingParameter
     */
    public function populateFromApi(DotbBean $bean, array $submittedData, array $options = array())
    {
        /**
         * The duration_hours and duration_minutes fields must be positive integers; either actual integers or strings
         * that are integers.
         *
         * @param mixed $time
         * @return bool
         */
        $isPositiveInteger = function ($time) {
            return preg_match('/^\d+$/', (string)$time) === 1;
        };

        unset($submittedData['repeat_parent_id']); // never allow this to be updated via the api

        $data = parent::populateFromApi($bean, $submittedData, $options);

        if (empty($bean->date_start)) {
            throw new DotbApiExceptionMissingParameter('Missing parameter: date_start');
        }

        if (!isset($bean->duration_hours) || strlen((string)$bean->duration_hours) === 0) {
            throw new DotbApiExceptionMissingParameter('Missing parameter: duration_hours');
        }

        if (!isset($bean->duration_minutes) || strlen((string)$bean->duration_minutes) === 0) {
            throw new DotbApiExceptionMissingParameter('Missing parameter: duration_minutes');
        }

        if (!$isPositiveInteger($bean->duration_hours)) {
            throw new DotbApiExceptionInvalidParameter('Invalid parameter: duration_hours');
        }

        if (!$isPositiveInteger($bean->duration_minutes)) {
            throw new DotbApiExceptionInvalidParameter('Invalid parameter: duration_minutes');
        }

        $bean->update_vcal = false;

        $bean->users_arr = $this->getInvitees($bean, 'users', $submittedData);
        $bean->leads_arr = $this->getInvitees($bean, 'leads', $submittedData);
        $bean->contacts_arr = $this->getInvitees($bean, 'contacts', $submittedData);

        return $data;
    }

    /**
     * {@inheritdoc}
     *
     * Adds the contact's name if one is related.
     *
     * `send_invites` and `auto_invite_parent` are internal processing flags and should never be
     * returned as fields.
     *
     * @param DotbBean $bean
     * @param array $fieldList
     * @param array $options
     * @return array
     */
    public function formatForApi(DotbBean $bean, array $fieldList = array(), array $options = array())
    {
        $data = parent::formatForApi($bean, $fieldList, $options);

        if (!empty($bean->contact_id)) {
            $contact = BeanFactory::getBean('Contacts', $bean->contact_id);
            if ($contact instanceof Contact) {
                $data['contact_name'] = $contact->full_name;
            }
        }

        unset($data['send_invites']);
        unset($data['auto_invite_parent']);

        // Handle enforcement of numerics, an issue introduced in MACAROON-684.
        foreach ($this->numericFields as $field) {
            if (array_key_exists($field, $data)) {
                $data[$field] = $this->getNumericValue($data[$field]);
            }
        }
        return $data;
    }

    /**
     * Gets a numeric value for certain calendar event fields.
     *
     * @param string $data Numeric value of data, as a string
     * @return integer The numeric value of data, as an integer
     */
    protected function getNumericValue($data)
    {
        return is_numeric($data) ? (int)$data : null;
    }

    /**
     * Returns an array of IDs for records associated via the specified link.
     *
     * @param DotbBean $bean
     * @param string $link The name of the link from which to load related records.
     * @param array $submittedData The submitted data for this request
     * @return array
     */
    protected function getInvitees(DotbBean $bean, $link, $submittedData)
    {
        $invites = array();
        if ($bean->load_relationship($link)) {
            $invites = $bean->$link->get();
        }

        if (isset($submittedData[$link]['add'])) {
            foreach ($submittedData[$link]['add'] as $id) {
                if (is_array($id)) {
                    $id = $id['id'];
                }
                $invites[] = $id;
            }
        }

        if (isset($submittedData[$link]['delete'])) {
            foreach ($submittedData[$link]['delete'] as $id) {
                if (is_array($id)) {
                    $id = $id['id'];
                }
                $idx = array_search($id, $invites);
                array_splice($invites, $idx, 1);
            }
        }

        return $invites;
    }
}
