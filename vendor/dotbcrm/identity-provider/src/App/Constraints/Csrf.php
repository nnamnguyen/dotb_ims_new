<?php


namespace Dotbcrm\IdentityProvider\App\Constraints;

use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManager;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class Csrf extends Assert\All
{
    public const FORM_TOKEN_ID = 'form_token';

    /**
     * Csrf constructor.
     * @param CsrfTokenManager $tokenManager
     */
    public function __construct(CsrfTokenManager $tokenManager)
    {
        parent::__construct(['constraints' => [
            new Assert\NotBlank(),
            new Assert\Callback([
                'callback' => [$this, 'checkCsrfToken'],
                'payload' => $tokenManager,
            ]),
        ]]);
    }

    /**
     * Checks if CSRF token is valid
     *
     * @param $value
     * @param ExecutionContextInterface $context
     * @param CsrfTokenManagerInterface $csrfManager
     */
    public function checkCsrfToken($value, ExecutionContextInterface $context, CsrfTokenManagerInterface $csrfManager)
    {
        if (!$csrfManager->isTokenValid(new CsrfToken(self::FORM_TOKEN_ID, $value))) {
            $context->buildViolation('CSRF attack detected.')->addViolation();
        }
    }

    /**
     * @return string
     */
    public function validatedBy()
    {
        return ChainValidator::class;
    }
}
