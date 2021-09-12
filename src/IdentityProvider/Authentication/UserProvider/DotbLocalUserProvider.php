<?php


namespace Dotbcrm\Dotbcrm\IdentityProvider\Authentication\UserProvider;

use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\User;
use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\Exception\InactiveUserException;
use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\Exception\InvalidUserException;

use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class DotbLocalUserProvider implements UserProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function loadUserByUsername($username)
    {
        return $this->getUser($username);
    }

    /**
     * Get user by field value.
     *
     * @param string $value
     * @param string $field
     * @return User
     */
    public function loadUserByField($value, $field)
    {
        return $this->getUser($value, $field);
    }

    /**
     * {@inheritdoc}
     */
    public function refreshUser(UserInterface $user)
    {
        if (!($user instanceof User)) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($user)));
        }

        return $this->getUser($user->getUsername());
    }

    /**
     * {@inheritdoc}
     */
    public function supportsClass($class)
    {
        return $class === User::class;
    }

    /**
     * Search and return mango base user.
     * Search can be performed by any User field; 'user_name' by default.
     *
     * @param string $nameIdentifier Value to search by.
     * @param string $field Field name to search by.
     * @return User
     */
    protected function getUser($nameIdentifier, $field = 'user_name')
    {
        global $current_user;

        /** @var \User $dotbUser */
        $dotbUser = $this->createUserBean();

        $isUserSet = false;
        if (empty($current_user) || !$current_user->id) {
            // make sure we use correct user datetime preferences
            $timedate = \TimeDate::getInstance();
            $timedate->setUser($dotbUser);
            $isUserSet = true;
        }

        if ($field == 'email') {
            $dotbUser->retrieve_by_email_address($nameIdentifier);
        } else {
            $query = $this->getDotbQuery();
            $query->select(['id']);
            $query->from($dotbUser);
            $query->where()->equals($field, $nameIdentifier);
            $dotbUserId = $query->getOne();
            $dotbUser->retrieve($dotbUserId, true, false);
        }

        if ($isUserSet) {
            // clear our temporary user just in case
            $timedate->setUser(null);
        }

        if (!$dotbUser->id) {
            throw new UsernameNotFoundException('User was not found by provided name identifier');
        }

        if ($dotbUser->status != User::USER_STATUS_ACTIVE) {
            throw new InactiveUserException('Inactive user');
        }

        if (!empty($dotbUser->is_group) || !empty($dotbUser->portal_only)) {
            throw new InvalidUserException('Portal or group user can not log in.');
        }

        $dotbUser->emailAddress->handleLegacyRetrieve($dotbUser);
        $user = new User($nameIdentifier, $dotbUser->user_hash);
        $user->setDotbUser($dotbUser);

        return $user;
    }

    /**
     * Create Dotb User bean.
     *
     * @param string $username
     * @param array $additionalFields
     * @return \User
     */
    public function createUser($username, array $additionalFields = [])
    {
        $dotbUser = $this->createUserBean();
        $dotbUser->populateFromRow(array_merge($additionalFields, ['user_name' => $username]));

        $dotbUser->new_with_id = isset($additionalFields['id']);

        $dotbUser->save();

        if (isset($additionalFields['email'])) {
            $dotbUser->emailAddress->addAddress($additionalFields['email'], true);
            $dotbUser->emailAddress->save($dotbUser->id, $dotbUser->module_dir);
        }

        return $dotbUser;
    }

    /**
     * Instantiate Dotb User bean.
     *
     * @return \User|\DotbBean
     */
    protected function createUserBean()
    {
        return \BeanFactory::getBean('Users');
    }

    /**
     * Get Dotb Query.
     *
     * @return \DotbQuery
     */
    protected function getDotbQuery()
    {
        return new \DotbQuery();
    }
}
