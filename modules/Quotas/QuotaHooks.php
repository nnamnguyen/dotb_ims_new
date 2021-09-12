<?php


class QuotaHooks
{
    public static function setQuotaSubscriptions(Quota $bean, $event, $args)
    {
        if($event !== 'before_save') {
            return false;
        }

        // Subscribe the user making the quota change
        global $current_user;
        Subscription::subscribeUserToRecord($current_user, $bean);

        // Subscribe the user whose quota is getting changed
        $assignee = BeanFactory::retrieveBean('Users', $bean->user_id);
        Subscription::subscribeUserToRecord($assignee, $bean);

        return true;
    }
}
