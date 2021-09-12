<?php


namespace Dotbcrm\IdentityProvider\App\Controller;

use Dotbcrm\Apis\Iam\App\V1alpha as AppApi;
use Dotbcrm\IdentityProvider\App\Authentication\ConsentRequest\ConsentToken;
use Dotbcrm\IdentityProvider\App\Authentication\ConsentRequest\ConsentTokenInterface;
use Dotbcrm\IdentityProvider\App\Provider\TenantConfigInitializer;
use Dotbcrm\IdentityProvider\App\Repository\Exception\ConsentNotFoundException;
use Dotbcrm\IdentityProvider\Authentication\Consent\ConsentChecker;
use Dotbcrm\IdentityProvider\Authentication\Tenant;
use Dotbcrm\IdentityProvider\Srn;

use Dotbcrm\IdentityProvider\App\Application;
use Dotbcrm\IdentityProvider\App\Authentication\JoseService;
use Dotbcrm\IdentityProvider\App\Authentication\OAuth2Service;

use Dotbcrm\IdentityProvider\Srn\Converter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Exception\AuthenticationCredentialsNotFoundException;

/**
 * Class ConsentController
 * @package Dotbcrm\IdentityProvider\App\Controller
 */
class ConsentController
{
    /**
     * @var JoseService
     */
    protected $joseService;

    /**
     * @var OAuth2Service
     */
    protected $oAuth2Service;

    /**
     * @var Session
     */
    protected $sessionService;

    /**
     * ConsentController constructor.
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->joseService = $app['JoseService'];
        $this->oAuth2Service = $app['oAuth2Service'];
        $this->sessionService = $app['session'];
    }

    /**
     * Init consent flow
     * @param Application $app
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function consentInitAction(Application $app, Request $request)
    {
        if (!$request->query->has('consent')) {
            throw new BadRequestHttpException('Consent not found', null, 400);
        }

        $consentToken = $app->getConsentRestService()->getToken($request->query->get('consent'));
        $tenantSrn = $consentToken->getTenantSRN();
        if ($tenantSrn) {
            if (preg_match(Srn\SrnRules::TENANT_REGEX, $tenantSrn)) {
                $storedTenant = $app->getTenantRepository()->findTenantById($tenantSrn);
                $tenantSrn = Srn\Converter::toString(
                    $app->getSrnManager($storedTenant->getRegion())->createTenantSrn($tenantSrn)
                );
                $consentToken->setTenantSRN($tenantSrn);
            }
            $this->sessionService->set(TenantConfigInitializer::SESSION_KEY, $tenantSrn);
        }
        $params = [];
        if ($consentToken->getUsername()) {
            $params['login_hint'] = $consentToken->getUsername();
        }
        $this->sessionService->set('consent', $consentToken);
        return $app->redirect($app->getUrlGeneratorService()->generate('loginRender', $params));
    }

    /**
     * consent confirmation action
     * @param Application $app
     * @param Request $request
     * @throws AuthenticationCredentialsNotFoundException
     * @throws \Twig_Error_Loader  When the template cannot be found
     * @throws \Twig_Error_Syntax  When an error occurred during compilation
     * @throws \Twig_Error_Runtime When an error occurred during rendering
     * @return string
     */
    public function consentConfirmationAction(Application $app, Request $request)
    {
        /** @var ConsentToken $consentToken */
        $consentToken = $this->sessionService->get('consent');

        if (is_null($consentToken)) {
            throw new AuthenticationCredentialsNotFoundException('Consent session not found');
        }
        $consentChecker = $this->getConsentChecker($app, $consentToken);
        if (!$consentChecker || !$consentChecker->check()) {
            return $app->getTwigService()->render('consent/app_consent_restricted.html.twig');
        }

        //TODO Remove using forceManualConsentApprove when EndToEnd test will be moved to helm
        if (
            !$app->getConfig()['forceManualConsentApprove']
            && $this->isWebApplication($app, $consentToken->getClientId())
        ) {
            return $this->consentFinishAction($app, $request);
        }

        return $app->getTwigService()->render('consent/confirmation.html.twig', [
            'are_scopes_empty' => $consentChecker->areScopesEmpty(),
            'scope_mapping' => $app->getConsentRestService()->getScopeMapping(),
            'scopes' =>  $consentToken->getScopes(),
            'client' => $consentToken->getClientId(),
            'tenant' => $this->sessionService->get(TenantConfigInitializer::SESSION_KEY),
        ]);
    }

    /**
     * Check application type is web
     * @param Application $app
     * @param string $appId
     * @return bool
     */
    private function isWebApplication(Application $app, string $appId): bool
    {
        $grpcAppApi = $app->getGrpcAppApi();
        $grpcGetAppRequest = new AppApi\GetAppRequest();
        $grpcGetAppRequest->setName($appId);

        /** @var $data AppApi\App */
        [$data, $status] = $grpcAppApi->GetApp($grpcGetAppRequest)->wait();
        if ($status && $status->code === \Grpc\CALL_OK) {
            return $data->getApplicationType() === AppApi\AppType::WEB;
        } else {
            $app->getLogger()->warning('Invalid app-api response GetApp', ['consent', 'app-api']);
            return false;
        }
    }

    /**
     * return filled consent checker
     * @param Application $app
     * @param ConsentTokenInterface $token
     * @return ConsentChecker|null
     */
    protected function getConsentChecker(Application $app, ConsentTokenInterface $token): ?ConsentChecker
    {
        $tenant = Tenant::fromSrn(Converter::fromString($token->getTenantSRN()));
        try {
            $consent = $app->getConsentRepository()->findConsentByClientIdAndTenantId(
                $token->getClientId(),
                $tenant->getId()
            );

            return new ConsentChecker($consent, $token);
        } catch (ConsentNotFoundException $e) {
            return null;
        }
    }

    /**
     * @param Application $app
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function consentFinishAction(Application $app, Request $request)
    {
        /** @var ConsentToken $consentToken */
        /** @var UsernamePasswordToken $userToken */
        list($consentToken, $userToken) = $this->getConsentAndUserToken();

        $this->oAuth2Service->acceptConsentRequest($consentToken, $userToken);
        return $app->redirect($consentToken->getRedirectUrl());
    }

    /**
     * @param Application $app
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function consentCancelAction(Application $app, Request $request)
    {
        /** @var ConsentToken $consentToken */
        list($consentToken, ) = $this->getConsentAndUserToken();

        $this->oAuth2Service->rejectConsentRequest($consentToken->getRequestId(), "No consent");
        return $app->redirect($consentToken->getRedirectUrl());
    }

    /**
     * return array of consent and user token
     * @return array
     */
    protected function getConsentAndUserToken()
    {
        /** @var ConsentToken $consentToken */
        $consentToken = $this->sessionService->get('consent');
        /** @var UsernamePasswordToken $userToken */
        $userToken = $this->sessionService->get('authenticatedUser');

        $this->sessionService->remove(TenantConfigInitializer::SESSION_KEY);
        $this->sessionService->remove('consent');
        $this->sessionService->remove('authenticatedUser');

        if (is_null($consentToken)) {
            throw new AuthenticationCredentialsNotFoundException('Consent session not found');
        }

        if (is_null($userToken)) {
            throw new AuthenticationCredentialsNotFoundException('User is not authenticated');
        }
        return [$consentToken, $userToken];
    }
}
