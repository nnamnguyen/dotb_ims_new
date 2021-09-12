<?php



/**
 * Role set metadata context
 */
class MetaDataContextRoleSet implements MetaDataContextInterface
{
    /**
     * @var ACLRoleSet
     */
    protected $roleSet;

    protected $index = array();

    /**
     * Constructor
     *
     * @param ACLRoleSet $roleSet
     */
    public function __construct(ACLRoleSet $roleSet)
    {
        $this->roleSet = $roleSet;

        $roleSet->load_relationship('acl_roles');
        $roles = $roleSet->acl_roles->getBeans();
        foreach ($roles as $role) {
            $this->index[$role->id] = true;
        }
    }

    /** {@inheritDoc} */
    public function getHash()
    {
        return $this->roleSet->hash;
    }

    /** {@inheritDoc} */
    public function isValid(array $file)
    {
        $role = $this->getFileRole($file);
        return !$role || isset($this->index[$role]);
    }

    /** {@inheritDoc} */
    public function compare(array $a, array $b)
    {
        $aRole = $this->getFileRole($a);
        $bRole = $this->getFileRole($b);

        if ($aRole && !$bRole) {
            return -1;
        }

        if (!$aRole && $bRole) {
            return 1;
        }

        return strcmp($aRole, $bRole);
    }

    protected function getFileRole(array $file)
    {
        if (isset($file['params']['role'])) {
            return $file['params']['role'];
        }

        return null;
    }
}
