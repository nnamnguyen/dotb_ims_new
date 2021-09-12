<?php


class EAPMViewGoogleOauth2Redirect extends DotbView
{
    /**
     * {@inheritDoc}
     *
     * @param array $params Ignored
     */
    public function process($params = array())
    {
        global $dotb_config;

        $token = $this->authenticate();
        if ($token) {
            $token = json_decode($token, true);
            $response = array(
                'result' => true,
                'hasRefreshToken' => isset($token['refresh_token']),
            );
        } else {
            $response = array(
                'result' => false,
            );
        }

        $this->ss->assign('response', $response);
        $this->ss->assign('siteUrl', $dotb_config['site_url']);
        $this->ss->display('modules/EAPM/tpls/GoogleOauth2Redirect.tpl');
    }

    protected function authenticate()
    {
        if (!isset($_GET['code'])) {
            return false;
        }

        $api = new ExtAPIGoogle();
        return $api->authenticate($_GET['code']);
    }
}
