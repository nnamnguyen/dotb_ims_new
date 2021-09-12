<?php


namespace Dotbcrm\IdentityProvider\Srn;

class SrnRules
{
    const SCHEME = 'srn';

    const MAX_LENGTH = 255;

    const MIN_COMPONENTS = 6;

    const ALLOWED_CHARS = '/^[a-zA-Z0-9_\-.;\/]*$/';

    const SEPARATOR = ':';

    const TENANT_LENGTH = 10;

    const TENANT_REGEX = '/^\d{1,' . self::TENANT_LENGTH . '}$/';
}
