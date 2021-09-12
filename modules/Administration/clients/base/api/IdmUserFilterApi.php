<?php


class IdmUserFilterApi extends FilterApi
{
    /**
     * @return array
     */
    public function registerApiRest()
    {
        return [
            'getIdmUsers' => [
                'reqType' => ['GET'],
                'path' => ['Administration', 'idm', 'users'],
                'pathVars' => [''],
                'method' => 'getIdmUsers',
                'shortHelp' => 'Fetch users for IDM migration',
                'longHelp' => 'include/api/help/administration_idm_user_filter_get_help.html',
                'exceptions' => [
                    'DotbApiExceptionError',
                    'DotbApiExceptionInvalidParameter',
                    'DotbApiExceptionNotAuthorized',
                ],
                'minVersion' => '11.2',
            ],
        ];
    }

    /**
     * @param ServiceBase $api
     * @param array $args
     * @param string $acl
     * @return array
     * @throws DotbApiExceptionError
     * @throws DotbApiExceptionInvalidParameter
     * @throws DotbApiExceptionNotAuthorized
     * @throws DotbApiExceptionNotFound
     */
    public function getIdmUsers(ServiceBase $api, array $args, $acl = 'list')
    {
        $this->ensureMigrationEnabled();
        $this->ensureAdminUser();

        $api->action = 'list';

        $args['module'] = 'Users';

        list($args, $q, $options, $seed) = $this->filterListSetup($api, $args);

        return $this->runQuery($api, $args, $q, $options, $seed);
    }

    /**
     * Format beans keeping raw user hashes
     *
     * @param ServiceBase $api
     * @param array $args
     * @param $beans
     * @param array $options
     * @return array
     */
    protected function formatBeans(ServiceBase $api, array $args, $beans, array $options = array())
    {
        // backup user hashes
        $userHashes = array_map(function (\User $user) {
            return [$user->id, $user->user_hash];
        }, $beans);
        $userHashes = array_column($userHashes, 1, 0);

        $records = parent::formatBeans($api, $args, $beans, $options);

        // restore user hashes after "formatForApi"
        foreach ($records as &$row) {
            $row['user_hash'] = $userHashes[$row['id']];
        }

        return $records;
    }

    /**
     * Ensure current user has admin permissions
     * @throws DotbApiExceptionNotAuthorized
     */
    private function ensureAdminUser() : void
    {
        if (empty($GLOBALS['current_user']) || !$GLOBALS['current_user']->isAdmin()) {
            throw new \DotbApiExceptionNotAuthorized(
                $GLOBALS['app_strings']['EXCEPTION_NOT_AUTHORIZED']
            );
        }
    }

    /**
     * @throws DotbApiExceptionNotFound
     */
    private function ensureMigrationEnabled(): void
    {
        if (empty($GLOBALS['dotb_config']['idmMigration'])) {
            throw new DotbApiExceptionNotFound();
        }
    }
}
