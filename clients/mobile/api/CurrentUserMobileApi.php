<?php



class CurrentUserMobileApi extends CurrentUserApi {

    /**
     * Get the user hash
     *
     * @param User $user
     *
     * @return string
     */
    protected function getUserHash(User $user)
    {
        $hash = parent::getUserHash($user);
        //Mix in the mobile tabs as User::getUserMDHash only takes the base tabs into account
        $tabs = MetaDataManager::getManager('mobile')->getTabList();

        return md5($hash . serialize($tabs));
    }
}
