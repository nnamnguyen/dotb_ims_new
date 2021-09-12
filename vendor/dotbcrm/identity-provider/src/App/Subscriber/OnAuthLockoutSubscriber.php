<?php


namespace Dotbcrm\IdentityProvider\App\Subscriber;

use Dotbcrm\IdentityProvider\Authentication\User;
use Dotbcrm\IdentityProvider\App\Authentication\Lockout;
use Dotbcrm\IdentityProvider\App\Provider\TenantConfigInitializer;
use Dotbcrm\IdentityProvider\Authentication\UserProvider\LocalUserProvider;
use Dotbcrm\IdentityProvider\Srn\Converter;

use Psr\Log\LoggerInterface;
use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Event\AuthenticationEvent;
use Symfony\Component\Security\Core\Event\AuthenticationFailureEvent;
use Dotbcrm\IdentityProvider\Authentication\Exception\PermanentLockedUserException;
use Dotbcrm\IdentityProvider\Authentication\Exception\TemporaryLockedUserException;
use Symfony\Component\Security\Core\AuthenticationEvents;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;

class OnAuthLockoutSubscriber implements EventSubscriberInterface
{
    /**
     * @var Lockout
     */
    protected $lockout;

    /**
     * @var Connection
     */
    protected $db;

    /**
     * We need Session in order to always initialize tenant-id for LocalUserProvider
     *
     * @var Session
     */
    protected $session;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @param Lockout $lockout
     * @param Connection $db
     * @param Session $session
     * @param LoggerInterface $logger
     */
    public function __construct(
        Lockout $lockout,
        Connection $db,
        Session $session,
        LoggerInterface $logger
    ) {
        $this->lockout = $lockout;
        $this->db = $db;
        $this->session = $session;
        $this->logger = $logger;
    }

    /**
     * @inheritdoc
     */
    public static function getSubscribedEvents()
    {
        return [
            AuthenticationEvents::AUTHENTICATION_SUCCESS => 'onSuccess',
            AuthenticationEvents::AUTHENTICATION_FAILURE => 'onFailure',
        ];
    }

    /**
     * runs on success
     * @param AuthenticationEvent $event
     */
    public function onSuccess(AuthenticationEvent $event)
    {
        if (!$this->lockout->isEnabled()) {
            return;
        }

        /** @var User $user */
        $user = $event->getAuthenticationToken()->getUser();
        $userId = $user->getAttribute('id');
        if ($user->getAttribute('failed_login_attempts') || $user->getAttribute('is_locked_out')) {
            $this->db->executeUpdate(
                'UPDATE users SET is_locked_out = false, failed_login_attempts = 0 WHERE id = ?',
                [$userId]
            );
            $user->setAttribute('is_locked_out', false);
            $user->setAttribute('failed_login_attempts', 0);
        }

        return;
    }

    /**
     * runs on failure
     * @param AuthenticationFailureEvent $event
     * @throws \Doctrine\DBAL\DBALException
     */
    public function onFailure(AuthenticationFailureEvent $event): void
    {
        $isPermanentFail = $event->getAuthenticationException() instanceof PermanentLockedUserException;
        $isTemporaryFail = $event->getAuthenticationException() instanceof TemporaryLockedUserException;
        if ($isPermanentFail || $isTemporaryFail) {
            return;
        }

        $username = $event->getAuthenticationToken()->getUsername();
        /** @var User $user */
        try {
            $user = $this->getLocalUserProvider()->loadUserByUsername($username);
        } catch (UsernameNotFoundException $e) {
            $user = null;
        }
        if ($user) {
            $this->db->executeUpdate(
                'UPDATE users SET is_locked_out = false, ' .
                'failed_login_attempts = failed_login_attempts + 1 WHERE id = ?',
                [$user->getAttribute('id')]
            );
            $user->setAttribute('is_locked_out', false);
            $user->setAttribute('failed_login_attempts', (int) $user->getAttribute('failed_login_attempts') + 1);

            $this->logger->info(
                'FAILED LOGIN:attempts[' . $user->getAttribute('failed_login_attempts') .'] - '. $username
            );
        } else {
            $this->logger->info('FAILED LOGIN: ' . $username);
        }

        if (!$this->lockout->isEnabled() || !$user) {
            return;
        }

        if ((int) $user->getAttribute('failed_login_attempts') >= $this->lockout->getAllowedFailedLoginCount()) {
            $lockoutTime = (new \DateTime())->format('Y-m-d H:i:s');
            $this->db->executeUpdate(
                'UPDATE users SET is_locked_out = true, failed_login_attempts = 0, lockout_time = ? WHERE id = ?',
                [$lockoutTime, $user->getAttribute('id')]
            );
            $user->setAttribute('is_locked_out', true);
            $user->setAttribute('lockout_time', $lockoutTime);
            $user->setAttribute('failed_login_attempts', 0);
        }
    }

    /**
     * Get LocalUserProvider.
     * We load it lazily to initialize it with tenant-id. Otherwise it'd be better to inject it into constructor.
     *
     * @return UserProviderInterface
     */
    protected function getLocalUserProvider()
    {
        $tenant = $this->session->get(TenantConfigInitializer::SESSION_KEY);
        $tenantId = Converter::fromString($tenant)->getTenantId();
        return new LocalUserProvider($this->db, $tenantId);
    }
}
