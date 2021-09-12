<?php


namespace Dotbcrm\IdentityProvider\App\Controller;

use Dotbcrm\Apis\Iam\User\V1alpha\SendEmailForResetPasswordRequest;

use Dotbcrm\IdentityProvider\App\Application;
use Dotbcrm\IdentityProvider\App\Constraints as CustomAssert;
use Dotbcrm\IdentityProvider\App\Provider\TenantConfigInitializer;
use Dotbcrm\IdentityProvider\Srn;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ConstraintViolation;

/**
 * Class PasswordController
 * @package Dotbcrm\IdentityProvider\App\Controller
 */
class ForgotPasswordController
{
    /**
     * @param Application $app Silex application instance.
     * @param Request $request
     * @return string
     */
    public function renderForgotPasswordForm(Application $app, Request $request)
    {
        $params = ['tid' => '', 'user_name' => ''];

        /** @var Session $sessionService */
        $sessionService = $app->getSession();
        $flashBag = $sessionService->getFlashBag();

        try {
            $tenantConfigInitializer = new TenantConfigInitializer($app);
            if ($tenantConfigInitializer->hasTenant($request)) {
                $tenantConfigInitializer->initConfig($request);
                $tenant = Srn\Converter::fromString($app->getSession()->get(TenantConfigInitializer::SESSION_KEY));
                $params['tid'] = $tenant->getTenantId();
            }
        } catch (\RuntimeException $e) {
            $flashBag->add('error', 'Invalid tenant ID');
            $app->getLogger()->info('Forgot Password Form: failed to set tenant ID from session', [
                'exception' => $e,
                'tags' => ['IdM.forgot'],
            ]);
        }

        $app->getLogger()->info('Render forgot password form', [
            'params' => $params,
            'tags' => ['IdM.forgot'],
        ]);
        $params = array_merge($params, [
            'csrf_token' => $app->getCsrfTokenManager()->getToken(CustomAssert\Csrf::FORM_TOKEN_ID)
        ]);
        return $app->getTwigService()->render('password/forgot.html.twig', $params);
    }

    /**
     * @param Application $app
     * @param Request $request
     * @return RedirectResponse
     */
    public function forgotPasswordAction(Application $app, Request $request): RedirectResponse
    {
        /** @var Session $sessionService */
        $sessionService = $app->getSession();
        $flashBag = $sessionService->getFlashBag();
        $config = $app->getConfig();

        // collect data
        $data = [
            'tid' => $request->get('tid'),
            'user_name' => $request->get('user_name'),
            'csrf_token' => $request->get('csrf_token'),
            'recaptcha' => $request->get('g-recaptcha-response'),
            'honeypot' => $request->get($config['honeypot']['name']),
        ];

        $app->getLogger()->debug('Validation of "forgot password" form data', [
            'data' => $data,
            'tags' => ['IdM.forgot'],
        ]);
        $constraint = new Assert\Collection([
            'tid' => [new Assert\NotBlank()],
            'user_name' => [new Assert\NotBlank()],
            'csrf_token' => [new CustomAssert\Csrf($app->getCsrfTokenManager())],
            'recaptcha' => [new CustomAssert\Recaptcha($config['recaptcha']['secretkey'])],
            'honeypot' => [new Assert\Blank()],
        ]);
        $violations = $app->getValidatorService()->validate($data, $constraint);
        if (count($violations) > 0) {
            $errors = array_map(function (ConstraintViolation $violation) {
                return $violation->getMessage();
            }, iterator_to_array($violations));
            $app->getLogger()->debug('Invalid form with errors', [
                'errors' => $errors,
                'tags' => ['IdM.forgot'],
            ]);
            $flashBag->add('error', 'All fields are required');

            return new RedirectResponse($app->getUrlGeneratorService()->generate('forgotPasswordRender'));
        }

        // Do a request for sending password reset email to a service that is responsible for it.
        try {
            $userProviderInfo = $app->getUserProvidersRepository()->findLocalByTenantAndIdentity(
                $data['tid'],
                $data['user_name']
            );

            $srn = $app->getSrnManager($config['idm']['region'])->createUserSrn(
                $userProviderInfo->getTenantId(),
                $userProviderInfo->getUserId()
            );

            $userApi = $app->getGrpcUserApi();
            $sendEmailRequest = new SendEmailForResetPasswordRequest();
            $sendEmailRequest->setName(Srn\Converter::toString($srn));

            $app->getLogger()->info('Sending password-recovery email for {user_name} of tenant {tid}', [
                'user_name' => $data['user_name'],
                'tid' => $data['tid'],
                'tags' => ['IdM.forgot'],
            ]);

            [$data, $status] = $userApi->SendEmailForResetPassword($sendEmailRequest)->wait();
            $sent = $status && $status->code === 0;
        } catch (\Exception $e) {
            $sent = false;
            $app->getLogger()->error(
                'Error while sending password-recovery email for {user_name} of tenant {tid}',
                [
                    'user_name' => $data['user_name'],
                    'tid' => $data['tid'],
                    'exception' => $e->getMessage(),
                    'tags' => ['IdM.forgot'],
                ]
            );
        }

        if ($sent) {
            $flashBag->add('success', 'Email for password recovery has been sent');
        } else {
            $flashBag->add('error', 'Failed to send email for password recovery');
        }

        return new RedirectResponse($app->getUrlGeneratorService()->generate('forgotPasswordRender'));
    }
}
