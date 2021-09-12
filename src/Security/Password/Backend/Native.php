<?php


namespace Dotbcrm\Dotbcrm\Security\Password\Backend;

use Dotbcrm\Dotbcrm\Security\Password\BackendInterface;

/**
 *
 * Native PHP password_hash backend
 *
 * This is the default and recommended way of hashing password in a
 * secure way. Only one algorithm is currently available. The related
 * directives for $dotb_config are:
 *
 *  $dotb_config['passwordHash']['backend'] = 'native'
 *  $dotb_config['passwordHash']['algo'] = 'PASSWORD_BCRYPT'
 *
 * Optionally the cost can be configured:
 *
 *  $dotb_config['passwordHash']['options']['cost'] = 10
 *
 * @see http://php.net/manual/en/function.password-hash.php
 * @see https://wiki.php.net/rfc/password_hash
 */
class Native implements BackendInterface
{
    /**
     * Selected algorithm
     * @var integer
     */
    protected $algo;

    /**
     * Hashing options
     * @var array
     */
    protected $options = array();

    /**
     * Ctor
     */
    public function __construct()
    {
        $this->algo = PASSWORD_DEFAULT;
    }

    /**
     * {@inheritdoc}
     */
    public function setAlgo($algo)
    {
        if (defined($algo)) {
            $this->algo = constant($algo);
        }
    }

    /**
     * {@inheritdoc}
     *
     * The available options depend on the selected algorithm:
     * @see http://php.net/manual/en/function.password-hash.php
     *
     *  - PASSWORD_BCRYPT
     *      cost = integer, defaults to 10
     *      salt = not allowed
     */
    public function setOptions(array $options)
    {
        // Ignore salt option, rely on automatic salt generation only
        if (isset($options['salt'])) {
            unset($options['salt']);
        }

        $this->options = $options;
    }

    /**
     * {@inheritdoc}
     */
    public function verify($password, $hash)
    {
        return password_verify($password, $hash);
    }

    /**
     * {@inheritdoc}
     */
    public function hash($password)
    {
       return password_hash($password, $this->algo, $this->options);
    }

    /**
     * {@inheritdoc}
     */
    public function needsRehash($hash)
    {
        return password_needs_rehash($hash, $this->algo, $this->options);
    }
}
