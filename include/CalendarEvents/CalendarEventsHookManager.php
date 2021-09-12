<?php


/**
 * CalendarEvents hook handler class
 * contains hook configuration for CalendarEvents
 */
class CalendarEventsHookManager
{
    protected $inviteeRelationships = array(
        'meetings_users' => true,
        'meetings_contacts' => true,
        'meetings_leads' => true,
        'calls_users' => true,
        'calls_contacts' => true,
        'calls_leads' => true,
    );

    /**
     * @deprecated Since 7.8
     * CalendarEvents initialization hook
     *
     * Serve "before_relationship_update" hook handling
     */
    public function beforeRelationshipUpdate(DotbBean $bean, $event, $args)
    {
        $relationship = $args['relationship'];
        if (($bean->module_name === 'Meetings' || $bean->module_name === 'Calls') &&
            !empty($this->inviteeRelationships[$relationship]) &&
             empty($bean->updateAcceptStatus)
        ) {
            throw new BypassRelationshipUpdateException();
        }
    }
}
