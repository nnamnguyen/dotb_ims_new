<?php


/**
 * Interface for external login behavior
 */
interface ExternalLoginInterface extends LoginInterface
{
    /**
     * Get URL to follow to get logged in
     *
     * @param array $returnQueryVars Query variables that should be added to the callback URL
     * @return string
     */
    public function getLoginUrl($returnQueryVars = array());
    /**
     * Get URL to follow to get logged out
     * @return string
     */
    public function getLogoutUrl();
}
