<?php


/**
 * Relationship between ACL Roles and Users which maintains ACL Role Sets
 */
class ACLRoleUserRelationship extends M2MRelationship
{
    /**
     * @var AclRoleSetRegistrar
     */
    protected $registrar;

    /**
     * {@inheritDoc}
     */
    public function add($lhs, $rhs, $additionalFields = array())
    {
        $result = parent::add($lhs, $rhs, $additionalFields);
        if ($result) {
            $this->registerUserAclRoles($rhs);
        }

        return $result;
    }

    /**
     * {@inheritDoc}
     */
    public function remove($lhs, $rhs, $save = true)
    {
        $result = parent::remove($lhs, $rhs, $save);
        if ($result) {
            $this->registerUserAclRoles($rhs);
        }

        return $result;
    }

    /**
     * Registers current set of user's roles
     *
     * @param User $user
     */
    protected function registerUserAclRoles(User $user)
    {
        if (!$this->registrar) {
            $this->registrar = new AclRoleSetRegistrar();
        }

        $this->registrar->registerAclRoleSet($user);
    }
}
