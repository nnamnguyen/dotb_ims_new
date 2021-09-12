<?php




class OauthTokensViewAuthorize extends DotbView
{
	public function display()
    {
        if(!DotbOAuthServer::enabled()) {
            dotb_die($GLOBALS['mod_strings']['LBL_OAUTH_DISABLED']);
        }
        global $current_user;
        $tokenParam = (!isset($_REQUEST['token']) && isset($_REQUEST['oauth_token']))
            ? 'oauth_token'
            : 'token';
        $requestToken = $this->request->getValidInputRequest($tokenParam, 'Assert\Guid');
        $dotb_smarty = new Dotb_Smarty();
        $dotb_smarty->assign('APP', $GLOBALS['app_strings']);
        $dotb_smarty->assign('MOD', $GLOBALS['mod_strings']);
        $dotb_smarty->assign('token', $requestToken);
        $dotb_smarty->assign('sid', session_id());
        $token = OAuthToken::load($requestToken);
        if(empty($token) || empty($token->consumer) || $token->tstate != OAuthToken::REQUEST || empty($token->consumer_obj)) {
            dotb_die('Invalid token');
        }

        if(empty($_REQUEST['confirm'])) {
            $dotb_smarty->assign('consumer', sprintf($GLOBALS['mod_strings']['LBL_OAUTH_CONSUMERREQ'], $token->consumer_obj->name));
            $hash = md5(rand());
            $_SESSION['oauth_hash'] = $hash;
            $dotb_smarty->assign('hash', $hash);
            echo $dotb_smarty->fetch('modules/OAuthTokens/tpl/authorize.tpl');
        } else {
            if($_REQUEST['sid'] != session_id() || $_SESSION['oauth_hash'] != $_REQUEST['hash']) {
                dotb_die('Invalid request');
            }
            $verify = $token->authorize(array("user" => $current_user->id));
            if(!empty($token->callback_url)){
                $redirect_url=$token->callback_url;
                if(strchr($redirect_url, "?") !== false) {
                    $redirect_url .= '&';
                } else {
                    $redirect_url .= '?';
                }
                $redirect_url .= "oauth_verifier=".$verify.'&oauth_token=' . $requestToken;
                DotbApplication::redirect($redirect_url);
            }
            $dotb_smarty->assign('VERIFY', $verify);
            $dotb_smarty->assign('token', '');
            echo $dotb_smarty->fetch('modules/OAuthTokens/tpl/authorized.tpl');
        }
    }

}

