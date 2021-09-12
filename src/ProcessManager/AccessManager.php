<?php


namespace Dotbcrm\Dotbcrm\ProcessManager;

require_once 'data/BeanFactory.php';
require_once 'include/api/DotbApiException.php';
require_once 'modules/pmse_Inbox/engine/PMSELogger.php';

/**
 * Class implements the ACL functionality used in ProcessManager
 */
class AccessManager
{
    /**
     * The singleton instance
     * @var AccessManager
     */
    protected static $instance = null;

    /**
     * Retrieves the singleton instance
     */
    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new AccessManager();
        }
        return static::$instance;
    }

    /**
     * This method checks ACL access in custom APIs
     * @param $api
     * @param $args
     * @throws DotbApiExceptionNotAuthorized
     */
    public function verifyAccess($api, $args)
    {
        $route = $api->getRequest()->getRoute();
        if (isset($route['acl'])) {
            $acl = $route['acl'];
            $seed = \BeanFactory::newBean($args['module']);
            if (!$seed->ACLAccess($acl)) {
                $dotbApiExceptionNotAuthorized = new \DotbApiExceptionNotAuthorized(
                    'No access to view/edit records for module: ' . $args['module']
                );
                \PMSELogger::getInstance()->alert($dotbApiExceptionNotAuthorized->getMessage());
                throw $dotbApiExceptionNotAuthorized;
            }
        }
    }

    /**
     * This method check if the user have admin or developer access to this API
     * @param $api
     * @param $args
     * @throws DotbApiExceptionNotAuthorized
     */
    public function verifyUserAccess($api, $args)
    {
        global $current_user;
        $route = $api->getRequest()->getRoute();
        $user = $current_user;
        if (isset($route['acl']) && $route['acl'] == 'adminOrDev') {
            if (!($user->isAdmin() || $user->isDeveloperForAnyModule())) {
                $dotbApiExceptionNotAuthorized = new \DotbApiExceptionNotAuthorized(
                    'No access to view/edit records for module: ' . $args['module']
                );
                \PMSELogger::getInstance()->alert($dotbApiExceptionNotAuthorized->getMessage());
                throw $dotbApiExceptionNotAuthorized;
            }
        }
    }
}
