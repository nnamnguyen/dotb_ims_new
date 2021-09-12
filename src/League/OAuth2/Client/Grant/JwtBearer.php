<?php


namespace Dotbcrm\Dotbcrm\League\OAuth2\Client\Grant;

use League\OAuth2\Client\Grant\AbstractGrant;

/**
 * urn:ietf:params:oauth:grant-type:jwt-bearer grant type
 */
class JwtBearer extends AbstractGrant
{
    /**
     * @inheritdoc
     */
    protected function getName()
    {
        return 'urn:ietf:params:oauth:grant-type:jwt-bearer';
    }

    /**
     * @inheritdoc
     */
    protected function getRequiredRequestParameters()
    {
        return [
            'assertion',
        ];
    }
}
