<?php

namespace CJ_WebHooks;

use CJ_WebHook;

class Request
{
    /**
     * @var \CJ_WebHook
     */
    private $webHook;

    /**
     * @param CJ_WebHook $webHook
     */
    public function __construct(\CJ_WebHook $webHook)
    {
        $this->webHook = $webHook;
    }

    /**
     * @param array $request
     * @throws \DotbApiException
     */
    public function send(array $request)
    {
        $this->debug("Sending request to {$this->webHook->url}");
        $ch = curl_init($this->webHook->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $this->configureRequestMethod($ch, $request);
        $this->configureHeaders($ch);

        $this->debug("Sending request");
        $response = curl_exec($ch);

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $errorNo = curl_errno($ch);
        $error = curl_error($ch);

        if ($errorNo !== 0) {
            $this->handleCurlError($errorNo, $error);
            return;
        }

        $this->debug("Response status code: $httpCode");

        curl_close($ch);

        if ($httpCode === 0 || $httpCode >= 400) {
            $this->handleError($response, $httpCode);
        }
    }

    /**
     * @param string $message
     */
    private function debug($message)
    {
        $GLOBALS['log']->debug("CJ_WebHook\\Request: $message");
    }

    /**
     * @param string $message
     */
    private function fatal($message)
    {
        $GLOBALS['log']->fatal("CJ_WebHook\\Request: $message");
    }

    /**
     * @param $response
     * @return array
     */
    private function parseResponse($response)
    {
        switch ($this->webHook->response_format) {
            case CJ_WebHook::RESPONSE_FORMAT_JSON:
                return json_decode($response, true);
            case CJ_WebHook::RESPONSE_FORMAT_HTTP_QUERY:
                parse_str($response, $output);
                return $output;
            case CJ_WebHook::RESPONSE_FORMAT_TEXT:
                return $response;
        }
    }

    /**
     * @param $ch
     * @param array $data
     */
    private function configureRequestMethod($ch, array $data)
    {
        switch ($this->webHook->request_method) {
            case CJ_WebHook::REQUEST_METHOD_POST:
                curl_setopt($ch, CURLOPT_POST, 1);
                $this->configureRequestBody($ch, $data);
                $this->debug("Using POST");
                break;
            case CJ_WebHook::REQUEST_METHOD_PUT:
                $this->debug("Using PUT");
                curl_setopt($ch, CURLOPT_PUT, 1);
                $this->configureRequestBody($ch, $data);
                break;
            case CJ_WebHook::REQUEST_METHOD_PATCH:
                $this->debug("Using PATCH");
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
                $this->configureRequestBody($ch, $data);
                break;
            case CJ_WebHook::REQUEST_METHOD_DELETE:
                $this->debug("Using DELETE");
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
                $this->configureRequestBody($ch, $data);
                break;
        }
    }

    /**
     * @param $ch
     * @param array $data
     */
    private function configureRequestBody($ch, array $data)
    {
        switch ($this->webHook->request_format) {
            case CJ_WebHook::REQUEST_FORMAT_JSON:
                $body = json_encode($data);
                $this->debug("Body: $body");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
                break;
            case CJ_WebHook::REQUEST_FORMAT_HTTP_QUERY:
                $body = http_build_query($data);
                $this->debug("Body: $body");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
                break;
        }
    }

    /**
     * @param $ch
     */
    private function configureHeaders($ch)
    {
        $headers = explode("\n", trim($this->webHook->headers));

        if (!empty($headers)) {
            $this->debug("Headers: ".json_encode($headers));
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
    }

    /**
     * @param $response
     * @param $httpCode
     * @throws \DotbApiException
     */
    private function handleError($response, $httpCode)
    {
        $response = $this->parseResponse($response);

        if (is_string($response)) {
            $message = $response;
        } elseif (is_array($response)) {
            $message = \DotbArray::staticGet($response, $this->webHook->error_message_path);
        } else {
            $message = 'EXCEPTION_UNKNOWN_EXCEPTION';
        }

        $this->fatal("Error message: $message");

        if ($this->webHook->ignore_errors) {
            $this->debug("Error ignored");
            return;
        }

        $this->debug("Throwing error");
        throw new \DotbApiException(
            $message,
            null,
            null,
            $httpCode ? $httpCode : 500
        );
    }

    /**
     * @param $errorNo
     * @param $error
     * @throws \DotbApiExceptionError
     */
    private function handleCurlError($errorNo, $error)
    {
        $this->fatal("curl error ($errorNo): $error");

        if ($this->webHook->ignore_errors) {
            $this->debug("Error ignored");
            return;
        }

        throw new \DotbApiExceptionError("curl error ($errorNo): $error");
    }
}
