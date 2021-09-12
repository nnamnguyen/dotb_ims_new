<?php


namespace Dotbcrm\IdentityProvider\App\Listener\Success;

use Dotbcrm\IdentityProvider\App\Authentication\ConfigAdapter\LocalConfigAdapter;
use Dotbcrm\IdentityProvider\Authentication\User;
use Dotbcrm\IdentityProvider\Authentication\Exception\PasswordExpiredException;
use Dotbcrm\IdentityProvider\App\Application;
use Dotbcrm\IdentityProvider\App\Authentication\AuthProviderManagerBuilder;

use Doctrine\DBAL\Connection;
use Symfony\Component\Security\Core\Event\AuthenticationEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class UserPasswordListener
{

    /**
     * @var Connection
     */
    protected $db;

    /**
     * Local Authentication config for a particular tenant
     * @var array
     */
    protected $app;

    /**
     * Mapping between config value and multiplier.
     * @var array
     */
    protected $expirationTimeTypeMap = [
        'day' => 1,
        'week' => 7,
        'month' => 30,
    ];

    /**
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->db = $app->getDoctrineService();
        $this->app = $app;
    }

    /**
     * @param AuthenticationEvent $event
     * @param string $eventName
     * @param EventDispatcherInterface $dispatcher
     * @throws PasswordExpiredException
     */
    public function __invoke(AuthenticationEvent $event, string $eventName, EventDispatcherInterface $dispatcher)
    {
        $token = $event->getAuthenticationToken();
        if ($token instanceof UsernamePasswordToken &&
            $token->getProviderKey() !== AuthProviderManagerBuilder::PROVIDER_KEY_LOCAL) {
            return;
        }
        /** @var User $user */
        $user = $token->getUser();
        $expirationType = (int) $this->getConfigValue('type', 0);
        switch ($expirationType) {
            case LocalConfigAdapter::PASSWORD_EXPIRATION_TYPE_TIME:
                $this->checkPasswordTime($user);
                break;
            case LocalConfigAdapter::PASSWORD_EXPIRATION_TYPE_LOGIN:
                $this->checkPasswordLoginAttempts($user);
                break;
        }
    }

    /**
     * Check how many times user has tried to login?
     *
     * @param User $user
     * @throws PasswordExpiredException
     */
    public function checkPasswordLoginAttempts(User $user)
    {
        $attempts = (int) $user->getAttribute('login_attempts');
        $this->db->executeUpdate(
            'UPDATE users SET login_attempts = login_attempts + 1 WHERE id = ?',
            [$user->getAttribute('id')]
        );

        if ($attempts >= (int) $this->getConfigValue('attempt')) {
            throw new PasswordExpiredException('Maximum login times exceeded. Password is expired');
        }
    }

    /**
     * Is user password time expired?
     *
     * @param User $user
     * @throws PasswordExpiredException
     */
    public function checkPasswordTime(User $user)
    {
        $lastChangeDateFromDB = $user->getAttribute('password_last_changed');
        if ($lastChangeDateFromDB) {
            $lastChangeDate = \DateTime::createFromFormat('Y-m-d H:i:s', $lastChangeDateFromDB);
        } else {
            $lastChangeDate = new \DateTime();
            $this->db->executeUpdate('UPDATE users SET password_last_changed = ? WHERE id = ?', [
                $lastChangeDate->format('Y-m-d H:i:s'),
                $user->getAttribute('id')
            ]);
        }

        $timeToExpiration = $this->getConfigValue('time', 1);
        if (time() >= $lastChangeDate->modify("+$timeToExpiration seconds")->getTimestamp()) {
            throw new PasswordExpiredException('Password lifetime is expired. Password is expired');
        }
    }

    /**
     * Get value from tenant's Local config for given key
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    protected function getConfigValue(string $key, $default = null)
    {
        return $this->app->getConfig()['local']['password_expiration'][$key] ?? $default;
    }
}
