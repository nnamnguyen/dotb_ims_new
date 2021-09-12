<?php


namespace Dotbcrm\Dotbcrm\Security\Csrf;

use Dotbcrm\Dotbcrm\Security\Crypto\CSPRNG;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

/**
 *
 * CSRF token generator using our build-in CSPRNG.
 *
 */
class CsrfTokenGenerator implements TokenGeneratorInterface
{
    /**
     * @var CSPRNG
     */
    protected $csprng;

    /**
     * Token size
     * @var integer
     */
    protected $size = 32;

    /**
     * Ctor
     * @param CSPRNG $csprng
     */
    public function __construct(CSPRNG $csprng = null)
    {
        $this->csprng = $csprng ?: CSPRNG::getInstance();
    }

    /**
     * {@inheritdoc}
     */
    public function generateToken()
    {
        // generate encoded token
        $token = $this->csprng->generate($this->size, true);

        // strip off url unfriendly chars
        return strtr($token, '+/', '-_');
    }

    /**
     * Set token size
     * @param integer $size
     */
    public function setSize($size)
    {
        $this->size = (int) $size;
    }
}
