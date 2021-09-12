<?php


/**
 * Class DotbACLKB
 * Additional ACL for KB.
 */
class DotbACLKB extends DotbACLStrategy
{

    /**
     * {@inheritDoc}
     *
     * Need to override default ACL in future.
     */
    public function checkAccess($module, $view, $context)
    {
        return true;
    }
}
