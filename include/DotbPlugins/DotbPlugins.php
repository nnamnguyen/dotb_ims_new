<?php


/**
 * Plugin management
 * @api
 */
class DotbPlugins
{
    /**
     * @const URL of the Dotb plugin server
     */
    private const DOTB_PLUGIN_SERVER = 'https://www.dotbcrm.com/crm/plugin_service.php';

    /**
     * @var nusoap_client
     */
    private $client;

    /**
     * Constructor
     *
     * Initializes the SOAP session
     */
    public function __construct()
    {
        $client = new nusoap_client(self::DOTB_PLUGIN_SERVER . '?wsdl', true);

        if ($client->getError()) {
            return;
        }

        $this->client = $client;
    }

    /**
     * Returns an array of available plugins to download for this instance
     *
     * @return array
     */
    public function getPluginList()
    {
        if (!$this->client) {
            return [];
        }

        $result = $this->client->call('get_plugin_list', [
            'subscription' => $GLOBALS['license']->settings['license_key'],
            'dotb_version' => $GLOBALS['dotb_version'],
        ]);

        if (empty($result[0]['item'])) {
            return [];
        }

        return $result[0]['item'];
    }

    /**
     * Returns the download token for the given plugin
     *
     * @param  string $plugin_id
     * @return string token
     */
    private function getPluginDownloadToken($plugin_id)
    {
        if (!$this->client) {
            return '';
        }

        $result = $this->client->call('get_plugin_token', [
            'subscription' => $GLOBALS['license']->settings['license_key'],
            'user_id' => $GLOBALS['current_user']->id,
            'raw_name' => $plugin_id,
        ]);

        return $result['token'];
    }

    /**
     * Downloads the plugin from Dotb using an HTTP redirect
     *
     * @param string $plugin_id
     */
    public function downloadPlugin($plugin_id)
    {
        $token = $this->getPluginDownloadToken($plugin_id);
        ob_clean();
        DotbApplication::redirect(self::DOTB_PLUGIN_SERVER . '?token=' . urlencode($token));
    }
}
