<?php


//BWC: nusoap library has been moved to vendor directory in 7+
if(file_exists('vendor/nusoap/nusoap.php')) {
    require_once 'vendor/nusoap/nusoap.php';
} else if(file_exists("include/nusoap/nusoap.php")) {
    require_once "include/nusoap/nusoap.php";
}

/**
 * Class DotbHeartbeatClient
 *
 * SoapClient for Dotb's heartbeat server. Currently we are using nusoap
 * because SoapClient is not a required extension for DotBCRM.
 */
class DotbHeartbeatClient extends nusoap_client
{
    /**
     * We don't use WSDL mode to avoid more traffic to the heartbeat server.
     *
     * @var string Endpoint url
     */
    const DEFAULT_ENDPOINT = 'https://update.dotb.cloud/heartbeat/soap.php';

    /**
     * These parameters are already SoapClient compatible when moving away
     * from nusoap in the future.
     *
     * @var array SoapClient options
     */
    protected $defaultOptions = array(
        'connection_timeout' => 15,
        'exceptions' => 0 // unused for nusoap
    );

    /**
     * Constructor
     */
    public function __construct()
    {
        $endpoint = $this->getEndpoint();
        $this->setupNuSoap($endpoint);
        $options = $this->getOptions();
        parent::__construct($endpoint, false, false, false, false, false, $options['connection_timeout']);
    }

    /**
     * Setup nuSoap before making any connections based on given endpoint.
     * @param string $endpoint Endpoint
     */
    protected function setupNuSoap($endpoint)
    {
        // validate server cert for SSL connections
        if (strpos($endpoint, 'https://') === 0) {
            $this->setUseCURL(true);
            $this->curl_options = array(
                CURLOPT_SSL_VERIFYPEER => true,
                CURLOPT_SSL_VERIFYHOST => 2,
            );
        }
    }

    /**
     * Returns endpoint
     * reads $dotb_config['heartbeat']['endpoint']
     * default is DotbHeartbeatClient::DEFAULT_ENDPOINT
     *
     * @return string
     */
    protected function getEndpoint()
    {
        return DotbConfig::getInstance()->get('heartbeat.endpoint', self::DEFAULT_ENDPOINT);
    }

    /**
     * Returns Soap Options
     * reads $dotb_config['heartbeat']['options']
     * default is DotbHeartbeatClient::$defaultOptions
     *
     * @return array
     */
    protected function getOptions()
    {
        return array_merge($this->defaultOptions, DotbConfig::getInstance()->get('heartbeat.options', array()));
    }

    /**
     * Proxy to dotbPing WSDL method
     *
     * @return mixed
     */
    public function dotbPing()
    {
        return $this->call('dotbPing', array());
    }

    /**
     * Proxy to dotbHome WSDL method
     * Encodes $info
     *
     * @param string $key License key
     * @param array $info
     * @return mixed
     */
    public function dotbHome($key, array $info)
    {
        $data = $this->encode($info);
        return $this->call('dotbHome', array('key' => $key, 'data' => $data));
    }

    /**
     * Serialize + Base64
     * @see DotbHeartbeatClient::dotbHome
     *
     * @param $value
     * @return string
     */
    protected function encode($value)
    {
        return base64_encode(serialize($value));
    }

    /**
     * Base64 decode + Unserialize
     * @see DotbHeartbeatClient::dotbHome
     *
     * @param $value
     * @return mixed
     */
    protected function decode($value)
    {
        return unserialize(base64_decode($value));
    }
}
