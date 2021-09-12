<?php


namespace Dotbcrm\Dotbcrm\IdentityProvider\Authentication\Listener\Success;

use Dotbcrm\Dotbcrm\Security\InputValidation\InputValidation;
use Dotbcrm\Dotbcrm\Session\SessionStorage;

use Symfony\Component\Security\Core\Event\AuthenticationEvent;

class PostLoginAuthListener
{
    /**
     * set user in globals and session
     * @param AuthenticationEvent $event
     */
    public function execute(AuthenticationEvent $event)
    {
        global $log;
        /** @var \User $currentUser */
        $currentUser = $event->getAuthenticationToken()->getUser()->getDotbUser();
        $dotbConfig = \DotbConfig::getInstance();
        /** @var SessionStorage $sessionStorage */
        $sessionStorage = SessionStorage::getInstance();
        if (!$sessionStorage->sessionHasId()) {
            $sessionStorage->start();
        }

        //just do a little house cleaning here
        unset($sessionStorage['login_password']);
        unset($sessionStorage['login_error']);
        unset($sessionStorage['login_user_name']);
        unset($sessionStorage['ACL']);

        $uniqueKey = $dotbConfig->get('unique_key');

        //set the server unique key
        if (!empty($uniqueKey)) {
            $sessionStorage['unique_key'] = $uniqueKey;
        }

        //set user language
        $sessionStorage['authenticated_user_language'] = InputValidation::getService()->getValidInputRequest(
            'login_language',
            'Assert\Language',
            $dotbConfig->get('default_language')
        );

        $log->debug("authenticated_user_language is " . $sessionStorage['authenticated_user_language']);

        // Clear all uploaded import files for this user if it exists
        $tmp_file_name = \ImportCacheFiles::getImportDir() . "/IMPORT_" . $currentUser->id;

        if (file_exists($tmp_file_name)) {
            unlink($tmp_file_name);
        }
    }
}
