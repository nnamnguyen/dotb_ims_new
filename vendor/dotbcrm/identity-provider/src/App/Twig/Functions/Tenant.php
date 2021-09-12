<?php


namespace Dotbcrm\IdentityProvider\App\Twig\Functions;

use Dotbcrm\IdentityProvider\App\Provider\TenantConfigInitializer;
use Dotbcrm\IdentityProvider\App\Repository\TenantRepository;
use Dotbcrm\IdentityProvider\Authentication\Tenant as TenantEntity;
use Dotbcrm\IdentityProvider\Srn;

use Symfony\Component\HttpFoundation\Session\Session;

use Twig\TwigFunction;

class Tenant extends TwigFunction
{
    private const NAME = 'tenant';

    /**
     * @var Session
     */
    private $session;

    /**
     * @var TenantRepository
     */
    private $tenantRepository;


    /**
     * Tenant constructor.
     * @param Session $session
     * @param TenantRepository $tenantRepository
     */
    public function __construct(Session $session, TenantRepository $tenantRepository)
    {
        parent::__construct(self::NAME, [$this, 'getTenant']);

        $this->session = $session;
        $this->tenantRepository = $tenantRepository;
    }

    /**
     * @return null|TenantEntity
     */
    public function getTenant(): ?TenantEntity
    {
        $srnString = $this->session->get(TenantConfigInitializer::SESSION_KEY);
        if (!$srnString) {
            return null;
        }

        $srn = Srn\Converter::fromString($srnString);
        try {
            $tenant = $this->tenantRepository->findTenantById($srn->getTenantId());
        } catch (\Exception $e) {
            return null;
        }

        return $tenant;
    }
}
