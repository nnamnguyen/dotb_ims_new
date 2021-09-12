<?php


class NotificationsFilterApi extends FilterApi {


    //Override the parent definition to allow responses to be cached for a short period client side
    public function registerApiRest()
    {
        $parentDef = parent::registerApiRest();
        if (!empty($parentDef['filterModuleAll'])) {
            $def = array_merge($parentDef['filterModuleAll'], array(
                'path' => array('Notifications'),
                //Should be the only change from the parent method
                'cacheEtag' => true,
            ));

            return array('retrieve' => $def);
        }

        return array();
    }

}
