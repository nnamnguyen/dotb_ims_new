<?php


namespace Dotbcrm\IdentityProvider\App\Provider;

use Dotbcrm\IdentityProvider\App\Application;
use Dotbcrm\IdentityProvider\Srn;
use Symfony\Component\HttpFoundation\Request;

/**
 * Init config for tenant.
 */
class TenantConfigInitializer
{
    /**
     * The key request key value is hardcoded in Mango. Check Mango side before changing this value.
     */
    public const REQUEST_KEY = 'tenant_hint';

    public const SESSION_KEY = 'tenant';

    /**
     * @var Application
     */
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Config initializer.
     * @param Request $request
     */
    public function __invoke(Request $request)
    {
        $this->initConfig($request);
    }

    /**
     * Initializes config
     *
     * @param Request $request
     * @throws \RuntimeException
     */
    public function initConfig(Request $request)
    {
        $tenant = $this->getTenant($request);
        if (empty($tenant)) {
            $this->app->getLogger()->critical('Cant build configs without tenant id', [
                'request' => [
                    'request' => sprintf('%s %s', $request->getMethod(), $request->getRequestUri()),
                    'headers' => $request->headers->all(),
                    'queryString' => $request->getQueryString(),
                    'post' => $request->request->all(),
                ],
                'tags' => ['IdM.config'],
            ]);
            throw new \RuntimeException('Cant build configs without tenant id');
        }
        $this->app['config'] = $this->app->getTenantConfiguration()->merge($tenant, $this->app['config']);
        $request->getSession()->set(self::SESSION_KEY, Srn\Converter::toString($tenant));
    }

    /**
     * Do we have tenant set
     *
     * @param Request $request
     * @return boolean
     */
    public function hasTenant(Request $request)
    {
        return $request->get(self::REQUEST_KEY)
            || $request->get('tid')
            || $request->getSession()->has(self::SESSION_KEY);
    }

    /**
     * Looks in all the various nooks and crannies and attempts to find an tenant srn
     *
     * @param Request $request
     * @return \Dotbcrm\IdentityProvider\Srn\Srn
     */
    protected function getTenant(Request $request)
    {
        if (!empty($request->get('tid'))) {
            $tenantString = $request->get('tid');
        } elseif (!empty($request->get(self::REQUEST_KEY))) {
            $tenantString = $request->get(self::REQUEST_KEY);
        } elseif ($request->getSession()->has(self::SESSION_KEY)) {
            $tenantString = $request->getSession()->get(self::SESSION_KEY);
        } else {
            return null;
        }
        try {
            return Srn\Converter::fromString($tenantString);
        } catch (\InvalidArgumentException $e) {
            $storedTenant = $this->app->getTenantRepository()->findTenantById($tenantString);
            //make double convertion to validate generated SRN
            return Srn\Converter::fromString(
                Srn\Converter::toString(
                    $this->app->getSrnManager($storedTenant->getRegion())->createTenantSrn($tenantString)
                )
            );
        }
    }
}
