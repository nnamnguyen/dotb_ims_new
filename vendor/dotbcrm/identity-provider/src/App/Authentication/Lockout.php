<?php


namespace Dotbcrm\IdentityProvider\App\Authentication;

use Dotbcrm\IdentityProvider\App\Application;
use Dotbcrm\IdentityProvider\App\Authentication\ConfigAdapter\LocalConfigAdapter;
use Dotbcrm\IdentityProvider\Authentication\User;
use Dotbcrm\IdentityProvider\Authentication\Exception\PermanentLockedUserException;
use Dotbcrm\IdentityProvider\Authentication\Exception\TemporaryLockedUserException;

class Lockout
{
    /**
     * Mapping between config value and multiplier.
     * @var array
     */
    protected $expirationTimeTypeMap = [
        'minute' => 1,
        'hour' => 60,
        'day' => 1440,
    ];

    /**
     * @var Application
     */
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Is lockout enabled.
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->getLockType() != LocalConfigAdapter::LOCKOUT_DISABLED;
    }

    /**
     * @param User $user
     * @throws TemporaryLockedUserException | PermanentLockedUserException
     */
    public function throwLockoutException(User $user): void
    {
        if ($this->getLockType() == LocalConfigAdapter::LOCK_TYPE_TIME) {
            $exception = $this->getTimeLockedException($user);
        } else {
            $exception = $this->getPermanentLockedException();
        }
        $exception->setUser($user);
        throw $exception;
    }

    /**
     * Is user locked?
     * @param User $user
     * @return bool
     */
    public function isUserLocked(User $user): bool
    {
        $result = false;
        $lockType = $this->getLockType();
        if ($lockType == LocalConfigAdapter::LOCK_TYPE_PERMANENT) {
            $result = (bool) $user->getAttribute('is_locked_out');
        } elseif ($lockType == LocalConfigAdapter::LOCK_TYPE_TIME) {
            $expireTime = $this->calculateExpireTime($user);
            if ($expireTime) {
                $result = (new \DateTime())->getTimestamp() < $expireTime->getTimestamp();
            }
        }
        return $result;
    }

    /**
     * Return max count of allowed failed logins before lockout from config.
     * @return int
     */
    public function getAllowedFailedLoginCount(): int
    {
        return (int) $this->getConfigValue('attempt', 0);
    }

    /**
     * Calculate expire time of user.
     *
     * @param User $user
     * @return \DateTime | null
     */
    protected function calculateExpireTime(User $user): ?\DateTime
    {
        $lockoutTime = $user->getAttribute('lockout_time');
        if (empty($lockoutTime)) {
            return null;
        }
        $lockoutDuration = (int)$this->getConfigValue('time', 0);
        return \DateTime::createFromFormat('Y-m-d H:i:s', $lockoutTime)
            ->modify("+$lockoutDuration seconds");
    }

    /**
     * Return exception for lock out by time
     *
     * @param User $user
     * @return TemporaryLockedUserException
     */
    protected function getTimeLockedException(User $user): TemporaryLockedUserException
    {
        $expireTime = $this->calculateExpireTime($user);
        $message = 'Too many failed login attempts.';
        if ($expireTime) {
            $timeLeft = $this->calculateTimeLeft($expireTime);
            $message .= ' You can try logging in again in ';
            $map = [
                86400 => 'days',
                3600 => 'hours',
                60 => 'minutes',
                1 => 'seconds',
            ];
            foreach ($map as $seconds => $unit) {
                if (floor($timeLeft/$seconds) > 0) {
                    $message .= floor($timeLeft/$seconds) . " $unit ";
                    $timeLeft -= $seconds * floor($timeLeft/$seconds);
                }
            }
        }
        return new TemporaryLockedUserException(trim($message));
    }

    /**
     * Return exception for permanent lock out
     *
     * @return PermanentLockedUserException
     */
    protected function getPermanentLockedException(): PermanentLockedUserException
    {
        $msg = 'Too many failed login attempts. Please contact the system administrator.';
        return new PermanentLockedUserException($msg);
    }

    /**
     * Return lockout type
     *
     * @return int
     */
    protected function getLockType(): int
    {
        return $this->getConfigValue('type', LocalConfigAdapter::LOCKOUT_DISABLED);
    }

    /**
     * Return password settings config value
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    protected function getConfigValue(string $key, $default = null)
    {
        return $this->app->getConfig()['local']['login_lockout'][$key] ?? $default;
    }

    /**
     * Calculate how much time left from now till given expire-time
     *
     * @param \DateTime $expireTime
     * @return int
     */
    protected function calculateTimeLeft(\DateTime $expireTime): int
    {
        return $expireTime->getTimestamp() - (new \DateTime())->getTimestamp();
    }
}
