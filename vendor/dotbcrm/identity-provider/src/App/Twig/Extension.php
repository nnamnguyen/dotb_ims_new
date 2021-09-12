<?php


namespace Dotbcrm\IdentityProvider\App\Twig;

use Dotbcrm\IdentityProvider\App\Application;

use Dotbcrm\IdentityProvider\App\Twig\Functions\Tenant as TenantFunction;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;
use Twig\TwigFunction;

class Extension extends AbstractExtension implements GlobalsInterface
{
    /**
     * @var Application
     */
    private $app;


    /**
     * Extension constructor.
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * @return array|TwigFunction[]
     */
    public function getFunctions()
    {
        return [
            new TenantFunction($this->app->getSession(), $this->app->getTenantRepository()),
        ];
    }

    /**
     * @return array
     */
    public function getGlobals()
    {
        $config = $this->app->getConfig();

        return [
            'recaptcha_sitekey' => $config['recaptcha']['sitekey'],
            'honeypot_name' => $config['honeypot']['name'],
        ];
    }
}
