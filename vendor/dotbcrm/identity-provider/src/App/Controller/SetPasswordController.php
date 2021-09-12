<?php

namespace Dotbcrm\IdentityProvider\App\Controller;

use Dotbcrm\IdentityProvider\App\Application;
use Dotbcrm\IdentityProvider\App\Constraints as CustomAssert;
use Dotbcrm\IdentityProvider\Authentication\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ConstraintViolation;

/**
 * Class SetPasswordController
 * @package Dotbcrm\IdentityProvider\App\Controller
 */
class SetPasswordController
{
    /**
     * @var Application
     */
    protected $app;

    /**
     * SetPasswordController constructor.
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * @param Application $app
     * @param Request $request
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function showSetPasswordForm(Application $app, Request $request): string
    {
        $token = $request->get('token');
        if (!$token) {
            throw new BadRequestHttpException('Required parameters missing', null, 400);
        }

        $oneTimeTokenRepository =  $app->getOneTimeTokenRepository();
        try {
            $oneTimeTokenRepository->findUserByTokenAndTenant($token, $request->get('tid'));
        } catch (\RuntimeException $e) {
            throw new BadRequestHttpException('Invalid parameters', null, 400);
        }
        return $this->renderSetPasswordForm($app, $request);
    }

    /**
     * @return array
     */
    protected function buildPasswordCheckConstraints(): array
    {
        $constraints = [
            new Assert\NotBlank(['message' => 'Password is empty']),
        ];
        $config = $this->app->getConfig();
        $passwordSettings = $config['local']['password_requirements'];
        $minMax = array_filter(
            [
                'min' => $passwordSettings['minimum_length'],
                'max' => $passwordSettings['maximum_length'],
                'minMessage' => 'Password is too short. It should have {{ limit }} character or more.',
                'maxMessage' => 'Password is too long. It should have {{ limit }} character or less.',
            ]
        );
        if ($minMax['min'] || $minMax['max']) {
            $constraints[] = new Assert\Length($minMax);
        }

        if ($passwordSettings['require_upper']) {
            $constraints[] = new Assert\Regex([
                'pattern' => '/[A-Z]+/',
                'message' => 'Password should contains at least one upper-case letter',
            ]);
        }

        if ($passwordSettings['require_lower']) {
            $constraints[] = new Assert\Regex([
                'pattern' => '/[a-z]+/',
                'message' => 'Password should contains at least one lower-case letter',
            ]);
        }

        if ($passwordSettings['require_number']) {
            $constraints[] = new Assert\Regex([
                'pattern' => '/\d+/',
                'message' => 'Password should contains at least one number',
            ]);
        }

        if ($passwordSettings['require_special']) {
            $constraints[] = new Assert\Regex([
                'pattern' => '/[' . preg_quote('|}{~!@#$%^&*()_+=-') . ']+/',
                'message' => 'Password should contains at least one special character "|}{~!@#$%^&*()_+=-' . '"',
            ]);
        }

        return $constraints;
    }

    /**
     * @param Application $app
     * @param Request $request
     * @return string
     * @throws \Throwable
     */
    public function setPassword(Application $app, Request $request): string
    {
        $token = $request->get('token');
        if (!$token) {
            throw new BadRequestHttpException('Required parameters missing', null, 400);
        }

        /** @var Session $sessionService */
        $sessionService = $app->getSession();
        $flashBag = $sessionService->getFlashBag();

        $data = [
            'tid' => $request->get('tid'),
            'token' => $token,
            'newPassword' => $request->get('newPassword'),
            'confirmPassword' => $request->get('confirmPassword'),
            'csrf_token' => $request->get('csrf_token'),
        ];

        $constraint = new Assert\Collection([
            'tid' => [new Assert\NotBlank()],
            'token' => [new Assert\NotBlank()],
            'newPassword' => $this->buildPasswordCheckConstraints(),
            'confirmPassword' => [
                new Assert\NotBlank(['message' => 'Password confirmation is empty']),
                new Assert\EqualTo(
                    [ 'value' => $data['newPassword'], 'message' => 'Password and password confirmation don\'t match']
                ),
            ],
            'csrf_token' => [new CustomAssert\Csrf($app->getCsrfTokenManager())],
        ]);

        $violations = $app->getValidatorService()->validate($data, $constraint);
        if (\count($violations) > 0) {
            $errors = array_map(
                function (ConstraintViolation $violation) {
                    return $violation->getMessage();
                },
                iterator_to_array($violations)
            );
            $app->getLogger()->debug(
                'Invalid form with errors',
                [
                    'errors' => $errors,
                    'tags' => ['IdM.password'],
                ]
            );
            $flashBag->add('error', $errors[0]);
            return $this->showSetPasswordForm($app, $request);
        }

        $tid = $request->get('tid');

        $oneTimeTokenRepository =  $app->getOneTimeTokenRepository();
        try {
            $oneTimeToken = $oneTimeTokenRepository->findUserByTokenAndTenant($token, $tid);
        } catch (\RuntimeException $e) {
            throw new BadRequestHttpException('Invalid parameters', null, 400);
        }

        $password = $app->getEncoderFactory()
            ->getEncoder(User::class)
            ->encodePassword($data['newPassword'], '');

        $app->getDoctrineService()->update(
            'users',
            ['password_hash' => $password],
            ['id' => $oneTimeToken->getUserId()]
        );
        $oneTimeTokenRepository->delete($oneTimeToken);

        return $app->getTwigService()->render('password/success.html.twig', []);
    }

    /**
     * @param Application $app
     * @param Request $request
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    protected function renderSetPasswordForm(Application $app, Request $request): string
    {
        return $app->getTwigService()->render(
            'password/set.html.twig',
            [
                'tid' => $request->get('tid'),
                'token' => $request->get('token'),
                'csrf_token' => $app->getCsrfTokenManager()->getToken(CustomAssert\Csrf::FORM_TOKEN_ID),
            ]
        );
    }
}
