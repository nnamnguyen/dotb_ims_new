<?php


use Dotbcrm\Dotbcrm\Security\Csrf\CsrfAuthenticator;

/**
 * Generate CSRF form token.
 *
 * Accepted $params:
 *
 *  - raw   If true, only return the bare token instead of returning the
 *          default hidden input html field.
 *
 * @param array $params
 * @param Smarty $smarty
 * @return string
 */
function smarty_function_dotb_csrf_form_token($params, &$smarty)
{
    $csrf = CsrfAuthenticator::getInstance();

    if (!empty($params['raw'])) {
        return $csrf->getFormToken();
    }

    return sprintf(
        '<input type="hidden" name="%s" value="%s" />',
        $csrf::FORM_TOKEN_FIELD,
        $csrf->getFormToken()
    );
}

