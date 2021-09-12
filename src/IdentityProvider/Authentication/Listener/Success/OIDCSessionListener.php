<?php


namespace Dotbcrm\Dotbcrm\IdentityProvider\Authentication\Listener\Success;

use Symfony\Component\Security\Core\Event\AuthenticationEvent;

/**
 * Class OIDCSessionListener
 * Provides $_SESSION propagation for OIDC user
 */
class OIDCSessionListener
{
    /**
     * Creates or restore OIDC user session.
     *
     * @param AuthenticationEvent $event
     */
    public function execute(AuthenticationEvent $event)
    {
        $token = $event->getAuthenticationToken();
        $user = $token->getUser();

        $dotbUser = $user->getDotbUser();
        $dotbConfig = $this->getDotbConfig();
        $sessionId = hash('sha256', $token->getCredentials());

        if (session_id() != $sessionId) {
            if (session_id()) {
                session_write_close();
            }
            ini_set("session.use_cookies", false);
            session_id($sessionId);
            session_start();
        }

        if (empty($_SESSION)) {
            $_SESSION['externalLogin'] = true;
            $_SESSION['is_valid_session'] = true;
            $_SESSION['ip_address'] = query_client_ip();
            $_SESSION['user_id'] = $dotbUser->id;
            $_SESSION['type'] = 'user';
            $_SESSION['authenticated_user_id'] = $dotbUser->id;
            $_SESSION['unique_key'] = $dotbConfig->get('unique_key');
            $_SESSION['platform'] = $token->getAttribute('platform');
        }
    }

    /**
     * Gets DotBCRM config.
     *
     * @return null|\DotbConfig
     */
    protected function getDotbConfig()
    {
        return \DotbConfig::getInstance();
    }
}
