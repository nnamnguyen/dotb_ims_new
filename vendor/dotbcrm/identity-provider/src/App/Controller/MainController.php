<?php


namespace Dotbcrm\IdentityProvider\App\Controller;

use Dotbcrm\IdentityProvider\App\Application;
use Dotbcrm\IdentityProvider\App\Authentication\AuthProviderManagerBuilder;
use Dotbcrm\IdentityProvider\App\Authentication\ConsentRequest\ConsentToken;
use Dotbcrm\IdentityProvider\App\Constraints as CustomAssert;
use Dotbcrm\IdentityProvider\App\Provider\TenantConfigInitializer;
use Dotbcrm\IdentityProvider\Srn;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ConstraintViolation;

/**
 * Class MainController.
 */
class MainController
{
    /**
     * @param Application $app Silex application instance.
     * @param Request $request
     * @return string
     */
    public function loginEndPointAction(Application $app, Request $request)
    {
        $providersTitle = [
            AuthProviderManagerBuilder::PROVIDER_KEY_LOCAL => 'Local',
            AuthProviderManagerBuilder::PROVIDER_KEY_LDAP => 'LDAP',
        ];
        $params = [
            'tid' => $request->get('tid'),
            'user_name' => $request->get('user_name'),
            'provider' => $providersTitle[$request->get('provider')],
        ];
        $app->getLogger()->info('Successfully authentication status page render', [
            'params' => $params,
            'tags' => ['IdM.main'],
        ]);
        return $app->getTwigService()->render('main/status.html.twig', $params);
    }

    /**
     * @param Application $app Silex application instance.
     * @param Request $request
     * @return string
     */
    public function renderFormAction(Application $app, Request $request)
    {
        $token = $app->getRememberMeService()->retrieve();
        if ($token) {
            $app->getSession()->set(TenantConfigInitializer::SESSION_KEY, $token->getAttribute('tenantSrn'));
            return $this->redirectAuthenticatedUser($app, $token);
        }
        $tenantConfigInitializer = new TenantConfigInitializer($app);
        $params = ['tid' => '', 'user_name' => ''];
        if ($tenantConfigInitializer->hasTenant($request)) {
            $tenantConfigInitializer->initConfig($request);
            $tenant = Srn\Converter::fromString($app->getSession()->get(TenantConfigInitializer::SESSION_KEY));
            $params['tid'] = $tenant->getTenantId();
            $config = $app->getConfig();
            if (!empty($config['saml'])) {
                return RedirectResponse::create($app->getUrlGeneratorService()->generate('samlInit'));
            }
        }
        if ($request->query->has('login_hint')) {
            $params['user_name'] = $request->query->get('login_hint');
        }
        return $this->renderLoginForm($app, $params);
    }

    /**
     * @param Application $app Silex application instance.
     * @param Request $request
     * @return string
     */
    public function postFormAction(Application $app, Request $request)
    {
        /** @var Session $sessionService */
        $sessionService = $app->getSession();
        $flashBag = $sessionService->getFlashBag();

        // collect data
        $data = [
            'tid' => $request->get('tid'),
            'user_name' => $request->get('user_name'),
            'password' => $request->get('password'),
            'csrf_token' => $request->get('csrf_token'),
        ];

        $app->getLogger()->debug('Validation form data', [
            'data' => $data,
            'tags' => ['IdM.main'],
        ]);
        $constraint = new Assert\Collection([
            'tid' => [new Assert\NotBlank()],
            'user_name' => [new Assert\NotBlank()],
            'password' => [new Assert\NotBlank()],
            'csrf_token' => [new CustomAssert\Csrf($app->getCsrfTokenManager())],
        ]);
        $violations = $app->getValidatorService()->validate($data, $constraint);
        if (count($violations) > 0) {
            $errors = array_map(function (ConstraintViolation $violation) {
                return $violation->getMessage();
            }, iterator_to_array($violations));
            $app->getLogger()->debug('Invalid form with errors', [
                'errors' => $errors,
                'tags' => ['IdM.main'],
            ]);
            $flashBag->add('error', 'All fields are required.');
            return new RedirectResponse($app->getUrlGeneratorService()->generate('loginRender', [
                TenantConfigInitializer::REQUEST_KEY => $data['tid'],
                'login_hint' => $data['user_name'],
            ]));
        }

        try {
            call_user_func(new TenantConfigInitializer($app), $request);
            $token = $app->getUsernamePasswordTokenFactory(
                $data['user_name'],
                $data['password']
            )->createAuthenticationToken();
            $app->getLogger()->info('Authentication token for user:{user_name} in tenant:{tid}', [
                'user_name' => $token->getUsername(),
                'tid' => $sessionService->get(TenantConfigInitializer::SESSION_KEY),
                'tags' => ['IdM.main'],
            ]);
            $token = $app->getAuthManagerService()->authenticate($token);
        } catch (BadCredentialsException $e) {
            $flashBag->add('error', 'Invalid credentials');

            $app->getLogger()->notice('Bad credentials occurred for user:{user_name} in tenant:{tid}', [
                'user_name' => $token->getUsername(),
                'tid' => $sessionService->get(TenantConfigInitializer::SESSION_KEY),
                'tags' => ['IdM.main'],
            ]);
        } catch (AuthenticationException $e) {
            $flashBag->add('error', $e->getMessage());

            $app->getLogger()->warning('Authentication Exception occurred for user:{user_name} in tenant:{tid}', [
                'user_name' => $token->getUsername(),
                'tid' => $sessionService->get(TenantConfigInitializer::SESSION_KEY),
                'exception' => $e,
                'tags' => ['IdM.main'],
            ]);
        } catch (\InvalidArgumentException $e) {
            $flashBag->add('error', 'Invalid credentials');

            $app->getLogger()->warning('User:{user_name} try login with invalid tenant:{tid}', [
                'user_name' => $data['user_name'],
                'tid' => $data['tid'],
                'exception' => $e,
                'tags' => ['IdM.main'],
            ]);
        } catch (\RuntimeException $e) {
            $flashBag->add('error', 'Invalid credentials');

            $app->getLogger()->warning('User:{user_name} try login with not existing tenant:{tid}', [
                'user_name' => $data['user_name'],
                'tid' => $data['tid'],
                'exception' => $e,
                'tags' => ['IdM.main'],
            ]);
        } catch (\Exception $e) {
            $flashBag->add('error', 'APP ERROR: ' . $e->getMessage());

            $app->getLogger()->error('Exception occurred for user:{user_name} in tenant:{tid}', [
                'user_name' => $data['user_name'],
                'tid' => $sessionService->get(TenantConfigInitializer::SESSION_KEY),
                'exception' => $e,
                'tags' => ['IdM.main'],
            ]);
        }

        if (!empty($token) && $token->isAuthenticated()) {
            $tenant = Srn\Converter::fromString($sessionService->get(TenantConfigInitializer::SESSION_KEY));
            $userIdentity = $token->getUser()->getLocalUser()->getAttribute('id');
            $userSrn = $app->getSrnManager($tenant->getRegion())->createUserSrn($tenant->getTenantId(), $userIdentity);
            $token->setAttribute('srn', Srn\Converter::toString($userSrn));
            $token->setAttribute('tenantSrn', $sessionService->get(TenantConfigInitializer::SESSION_KEY));
            $app->getRememberMeService()->store($token);

            return $this->redirectAuthenticatedUser($app, $token);
        }

        return new RedirectResponse($app->getUrlGeneratorService()->generate('loginRender', [
            TenantConfigInitializer::REQUEST_KEY => $sessionService->get(TenantConfigInitializer::SESSION_KEY),
            'login_hint' => $data['user_name'],
        ]));
    }

    /**
     * LogOut action
     * @param Application $app
     * @param Request $request
     * @return RedirectResponse
     */
    public function logoutAction(Application $app, Request $request): RedirectResponse
    {
        $app->getRememberMeService()->clear();
        if ($app->getSession()->has(TenantConfigInitializer::SESSION_KEY)) {
            $app->getSession()->remove(TenantConfigInitializer::SESSION_KEY);
        }

        return new RedirectResponse($app->getUrlGeneratorService()->generate('loginRender'));
    }

    /**
     * Redirect user to consent or landing page
     *
     * @param Application $app
     * @param TokenInterface $token Authenticated result token
     * @return RedirectResponse
     */
    protected function redirectAuthenticatedUser(Application $app, TokenInterface $token): RedirectResponse
    {
        $sessionService = $app->getSession();

        if ($sessionService->get('consent')) {
            /** @var ConsentToken $consentToken */
            $consentToken = $sessionService->get('consent');
            $consentToken->setTenantSRN($token->getAttribute('tenantSrn'));

            $sessionService->set('authenticatedUser', $token);
            return $app->redirect($app->getUrlGeneratorService()->generate('consentConfirmation'));
        }

        $app->getLogger()->info('Redirect user:{user_name} in tenant:{tid} to route:{route}', [
            'user_name' => $token->getUsername(),
            'tid' => $sessionService->get(TenantConfigInitializer::SESSION_KEY),
            'route' => 'loginEndPoint',
            'tags' => ['IdM.main'],
        ]);
        return RedirectResponse::create($app->getUrlGeneratorService()->generate(
            'loginEndPoint',
            [
                'tid' => $sessionService->get(TenantConfigInitializer::SESSION_KEY),
                'user_name' => $token->getUsername(),
                'provider' => $token->getProviderKey(),
            ]
        ));
    }

    /**
     * @param Application $app
     * @param array $params
     * @return string
     */
    protected function renderLoginForm(Application $app, array $params = [])
    {
        $app->getLogger()->info('Render login form', [
            'params' => $params,
            'tags' => ['IdM.main'],
        ]);
        $params = array_merge($params, [
            'csrf_token' => $app->getCsrfTokenManager()->getToken(CustomAssert\Csrf::FORM_TOKEN_ID)
        ]);
        return $app->getTwigService()->render('main/login.html.twig', $params);
    }
}
