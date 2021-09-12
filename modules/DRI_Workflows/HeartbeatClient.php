<?php

namespace DRI_Workflows;

require_once "modules/DRI_Workflows/LicenseValidator.php";

class HeartbeatClient
{
    const CACHE_TIME = 86400; // 24 hours
    const DEFAULT_ENDPOINT = 'https://dotb.vn';

    private static $headers = array ( "Content-Type: application/json" );

    /**
     * @param string $licenseKey
     * @param boolean $force
     * @return string | null
     * @throws \Exception
     */
    public function validate($licenseKey, $force = false)
    {
        $cacheKey = $this->getCacheKey($licenseKey);
        $validationKey = dotb_cache_retrieve($cacheKey);
        if ($validationKey !== null && !$force) {
            return $validationKey;
        }
        dotb_cache_put($cacheKey, $validationKey, self::CACHE_TIME);
        return 'dotbcrm@123';
    }

    /**
     * @return string
     */
    protected function getEndpoint()
    {
        return \DotbConfig::getInstance()->get(
            'customer_journey.licenses.url',
            self::DEFAULT_ENDPOINT
        );
    }

    /**
     * @param $licenseKey
     * @return string
     */
    private function getCacheKey($licenseKey)
    {
        return sprintf('DRI_Workflows\\HeartbeatClient\\validate[%s]', $licenseKey);
    }
}
