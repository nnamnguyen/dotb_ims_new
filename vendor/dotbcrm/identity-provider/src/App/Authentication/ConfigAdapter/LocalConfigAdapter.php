<?php


namespace Dotbcrm\IdentityProvider\App\Authentication\ConfigAdapter;

class LocalConfigAdapter extends AbstractConfigAdapter
{
    public const LOCKOUT_DISABLED = 0;
    public const LOCK_TYPE_TIME = 2;
    public const LOCK_TYPE_PERMANENT = 1;

    public const PASSWORD_EXPIRATION_DISABLED = 0;
    public const PASSWORD_EXPIRATION_TYPE_TIME = 1;
    public const PASSWORD_EXPIRATION_TYPE_LOGIN = 2;

    /**
     * modify IPD-API config to Local auth usage
     * @param $config
     * @return array
     */
    public function getConfig(string $config): array
    {
        $config = $this->decode($config);
        if (empty($config)) {
            return [];
        }

        return [
            'password_requirements' => [
                'minimum_length' => (int)$config['password_requirements']['minimum_length'],
                'maximum_length' => (int)$config['password_requirements']['maximum_length'],
                'require_upper' => (bool)$config['password_requirements']['require_upper'],
                'require_lower' => (bool)$config['password_requirements']['require_lower'],
                'require_number' => (bool)$config['password_requirements']['require_number'],
                'require_special' => (bool)$config['password_requirements']['require_special'],
                'password_regex' => (string)$config['password_requirements']['password_regex'],
                'regex_description' => (string)$config['password_requirements']['regex_description'],
            ],
            'password_reset_policy' => [
                'enable' => (bool)$config['password_reset_policy']['enable'],
                'expiration' => (int)$config['password_reset_policy']['expiration']['seconds'],
                'require_recaptcha' => (bool)$config['password_reset_policy']['require_recaptcha'],
                'recaptcha_public' => (string)$config['password_reset_policy']['recaptcha_public'],
                'recaptcha_private' => (string)$config['password_reset_policy']['recaptcha_private'],
                'require_honeypot' => (bool)$config['password_reset_policy']['require_honeypot'],
            ],
            'password_expiration' => [
                'type' => $this->getPasswordExpirationType($config['password_expiration'] ?? []),
                'time' => (int)$config['password_expiration']['time']['seconds'],
                'attempt' => (int)$config['password_expiration']['attempt'],
            ],
            'login_lockout' => [
                'type' => (int)$config['login_lockout']['type'],
                'attempt' => (int)$config['login_lockout']['attempt'],
                'time' => (int)$config['login_lockout']['time']['seconds'],
            ],
        ];
    }

    /**
     * @param array $config
     * @return int
     */
    private function getPasswordExpirationType(array $config): int
    {
        if (!empty($config['time']['seconds']) && empty($config['attempt'])) {
            return self::PASSWORD_EXPIRATION_TYPE_TIME;
        } elseif (empty($config['time']['seconds']) && !empty($config['attempt'])) {
            return self::PASSWORD_EXPIRATION_TYPE_LOGIN;
        } else {
            return self::PASSWORD_EXPIRATION_DISABLED;
        }
    }
}
