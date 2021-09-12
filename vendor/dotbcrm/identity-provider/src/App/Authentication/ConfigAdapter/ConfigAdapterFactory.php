<?php


namespace Dotbcrm\IdentityProvider\App\Authentication\ConfigAdapter;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ConfigAdapterFactory
{
    /**
     * @var UrlGeneratorInterface
     */
    protected $urlGenerator;

    /**
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(UrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * @param $code
     * @return null|AbstractConfigAdapter
     */
    public function getAdapter($code): ?AbstractConfigAdapter
    {
        $method = sprintf('get%sAdapter', ucfirst(strtolower($code)));
        $adapter = null;
        if (method_exists($this, $method)) {
            $adapter = $this->$method();
        }
        return $adapter;
    }

    /**
     * @return SamlConfigAdapter
     */
    protected function getSamlAdapter(): SamlConfigAdapter
    {
        return new SamlConfigAdapter($this->urlGenerator);
    }

    /**
     * @return LocalConfigAdapter
     */
    protected function getLocalAdapter(): LocalConfigAdapter
    {
        return new LocalConfigAdapter();
    }

    /**
     * @return LdapConfigAdapter
     */
    protected function getLdapAdapter(): LdapConfigAdapter
    {
        return new LdapConfigAdapter();
    }
}
