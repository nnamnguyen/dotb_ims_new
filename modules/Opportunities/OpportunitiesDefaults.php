<?php


class OpportunitiesDefaults
{
    /**
     * Sets up the default Opportunities config settings
     *
     * @return array
     */
    public static function setupOpportunitiesSettings()
    {
        $admin = BeanFactory::newBean('Administration');
        $oppsConfig = self::getDefaults();

        foreach ($oppsConfig as $name => $value) {
            $admin->saveSetting('Opportunities', $name, $value, 'base');
        }

        return $oppsConfig;
    }

    /**
     * Returns the default values for Opportunities to use
     *
     * @return array default config settings for Opportunities to use
     */
    public static function getDefaults()
    {
        // default opps config setup
        return array(
            // this is used to indicate the default way to view Opportunities
            'opps_view_by' => 'Opportunities', // Options: 'Opportunities', 'RevenueLineItems'
        );
    }

    /**
     * Returns an Opportunities config default given the key for the default
     * @param $key
     * @return mixed
     */
    public static function getConfigDefaultByKey($key)
    {
        $oppsDefault = self::getDefaults();
        return $oppsDefault[$key];
    }
}
