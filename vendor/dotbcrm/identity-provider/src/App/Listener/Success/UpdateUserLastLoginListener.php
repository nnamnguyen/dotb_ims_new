<?php


namespace Dotbcrm\IdentityProvider\App\Listener\Success;

use Dotbcrm\IdentityProvider\Authentication\User;

use Doctrine\DBAL\Connection;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Security\Core\Event\AuthenticationEvent;

class UpdateUserLastLoginListener
{
    /**
     * @var Connection
     */
    protected $db;

    /**
     * constructor
     * @param Connection $db
     */
    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

    /**
     * make this class callable
     * @param AuthenticationEvent $event
     * @param string $eventName
     * @param EventDispatcherInterface $dispatcher
     */
    public function __invoke(AuthenticationEvent $event, $eventName, EventDispatcherInterface $dispatcher)
    {
        /** @var User $user */
        $user = $event->getAuthenticationToken()->getUser();
        if (!$user) {
            return;
        }
        $userId = $user->getAttribute('id');
        $this->db->executeUpdate(
            'UPDATE users SET last_login = ? WHERE id = ?',
            [(new \DateTime())->format('Y-m-d H:i:s'), $userId]
        );
    }
}
