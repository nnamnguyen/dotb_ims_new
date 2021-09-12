<?php
class Ucm6202 {
    /*
     * Host name or IP of PBX
     */
    private $host;
    /*
     * API port. Default 8443
     */
    private $port;
    /*
     * User name for access to API. Default 'cdrapi'
     */
    private $user;
    /*
     * User password for access to API. Default 'cdrapi123'
     */
    private $pass;
    /*
     * CURL handler
     */
    private $curl;
    /**
     * Initial connection to PBX API
     * @param string $host
     * @param string $user
     * @param string $pass
     * @param string $port 
     */
    public function __construct($host, $user = 'cdrapi', $pass = 'cdrapi123', $port = '8443') {
        $this->host = $host;
        $this->port = $port;
        $this->user = $user;
        $this->pass = $pass;
        $this->curl = curl_init();
        $cookie_jar = tempnam('/tmp','cookie');
        /*curl_setopt($this->curl, CURLOPT_CAINFO, dirname(__FILE__)."/cacert.pem");*/
        //curl_setopt($auth_request, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
        curl_setopt($this->curl, CURLOPT_HEADER, 1); 
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($this->curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($this->curl, CURLOPT_USERPWD, $this->user . ":" . $this->pass);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, TRUE);    
        curl_setopt($this->curl, CURLOPT_CONNECTTIMEOUT, 1000);    
    }
    /**
     * Find records from CDR
     * @param array $params
     * @return array|false
     */
    public function find($params = []) {
        $url = '/recapi?';
        $urlBuf = array_filter($params, function($item) {
            if (is_null($item)) {
                return false;
            } else {
                return true;
            }
        });
        $resBuf = [];
        foreach ($urlBuf as $key => $value) {
            $resBuf[] = $key . '=' . $value;
        }
        $urlParams = implode('&', $resBuf);
        if (strlen($urlParams) > 0) {
            $url .= '&' . $urlParams;
        }
        $url = 'https://42.112.210.63:8443/recapi?filename=auto-1558448721-50-0363742834.wav';        
        curl_setopt($this->curl, CURLOPT_URL, $url);
        $result = curl_exec($this->curl);
        $httpcode = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);
        $message = curl_error ($this->curl);

    }
}