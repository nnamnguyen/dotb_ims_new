<?php


namespace Dotbcrm\IdentityProvider\App;

use Silex\Application as App;
use Silex\Api\ControllerProviderInterface;
use Silex\ControllerCollection;
use Dotbcrm\IdentityProvider\App\Authentication\BearerAuthentication;
use Dotbcrm\IdentityProvider\App\Controller\AuthenticationController;
use Dotbcrm\IdentityProvider\App\Controller\ConsentController;
use Dotbcrm\IdentityProvider\App\Controller\MainController;
use Dotbcrm\IdentityProvider\App\Controller\SAMLController;
use Dotbcrm\IdentityProvider\App\Controller\SetPasswordController;
use Dotbcrm\IdentityProvider\App\Controller\ForgotPasswordController;
use Dotbcrm\IdentityProvider\App\Provider\TenantConfigInitializer;

class ControllerProvider implements ControllerProviderInterface
{
    /**
     * Returns routes to connect to the given application.
     *
     * @param App $app
     * @return ControllerCollection
     */
    public function connect(App $app)
    {
        /* @var ControllerCollection $controllers */
        $controllers = $app['controllers_factory'];
        $tenantConfigInitializer = new TenantConfigInitializer($app);
        $mainController = new MainController();
        $samlController = new SAMLController();
        $consentController = new ConsentController($app);
        $setPasswordController = new SetPasswordController($app);
        $authenticationController = new AuthenticationController();
        $forgotPasswordController = new ForgotPasswordController();
        $restBearerAuthentication = new BearerAuthentication(
            $app['oAuth2Service'],
            'idp.auth.password',
            $app['logger']
        );
        $controllers->before(function ($request) use ($tenantConfigInitializer) {
            $exceptionRoutes = [
                'loginProcess',
                'loginRender',
                'consentInit',
                'consentFinish',
                'restAuthenticate',
                'forgotPasswordRender',
                'forgotPasswordProcess',
            ];
            //TODO This constraint should be more complex solution Or need to be removed.
            if (!in_array($request->attributes->get('_route'), $exceptionRoutes)) {
                call_user_func($tenantConfigInitializer, $request);
            }
        });

        $controllers
            ->get('/login-end-point', [$mainController, 'loginEndPointAction'])
            ->bind('loginEndPoint');

        $controllers
            ->get('/', [$mainController, 'renderFormAction'])
            ->bind('loginRender');
        $controllers
            ->post('/', [$mainController, 'postFormAction'])
            ->bind('loginProcess');

        $controllers
            ->get('/password/forgot', [$forgotPasswordController, 'renderForgotPasswordForm'])
            ->bind('forgotPasswordRender');

        $controllers
            ->post('/password/forgot', [$forgotPasswordController, 'forgotPasswordAction'])
            ->bind('forgotPasswordProcess');

        $controllers
            ->post('/logout', [$mainController, 'logoutAction'])
            ->bind('logout');

        $controllers
            ->post('/authenticate', [$authenticationController, 'authenticate'])
            ->before([$restBearerAuthentication, 'authenticateClient'])
            ->bind('restAuthenticate');

        $controllers
            ->get('saml/logout-end-point', [$samlController, 'logoutEndPointAction'])
            ->bind('samlLogoutEndPoint');
        $controllers
            ->get('saml/login-end-point', [$samlController, 'loginEndPointAction'])
            ->bind('samlLoginEndPoint');
        $controllers
            ->get('/saml', [$samlController, 'renderFormAction'])
            ->bind('samlRender');
        $controllers
            ->get('/saml/init', [$samlController, 'initAction'])
            ->bind('samlInit');
        $controllers
            ->post('/saml/acs', [$samlController, 'acsAction'])
            ->bind('samlAcs');
        $controllers
            ->match('/saml/logout', [$samlController, 'logoutAction'])
            ->bind('samlLogout');
        $controllers
            ->get('/saml/logout/init', [$samlController, 'logoutInitAction'])
            ->bind('samlLogoutInit');
        $controllers
            ->get('/saml/metadata', [$samlController, 'metadataAction'])
            ->bind('samlMetaData');

        $controllers
            ->get('/consent', [$consentController, 'consentInitAction'])
            ->bind('consentInit');

        $controllers
            ->get('/consent/confirmation', [$consentController, 'consentConfirmationAction'])
            ->bind('consentConfirmation');

        $controllers
            ->get('/consent/finish', [$consentController, 'consentFinishAction'])
            ->bind('consentFinish');

        $controllers
            ->get('/consent/cancel', [$consentController, 'consentCancelAction'])
            ->bind('consentCancel');

        $controllers
            ->get('/password/set', [$setPasswordController, 'showSetPasswordForm'])
            ->bind('showSetPasswordForm');
        $controllers
            ->post('/password/set', [$setPasswordController, 'setPassword'])
            ->bind('setPassword');

        return $controllers;
    }
}
