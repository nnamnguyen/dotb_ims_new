<?php


use Dotbcrm\Dotbcrm\Security\InputValidation\InputValidation;

$inputValidation = InputValidation::getService();
$samlRequest = $inputValidation->getValidInputRequest('SAMLRequest');
$logout = $inputValidation->getValidInputRequest('logout');
$relayState = $inputValidation->getValidInputRequest('RelayState');
if ($samlRequest) {
    if (!$logout) {
        $smarty = new Dotb_Smarty();
        $redirectUrl = 'index.php?module=Users&action=Logout&logout=1&SAMLRequest=' . urlencode($samlRequest);
        if ($relayState) {
            $redirectUrl .= '&RelayState=' . urlencode($relayState);
        }
        $smarty->assign(array(
                'REDIRECT_URL'  => $redirectUrl,
        ));
        $smarty->display('modules/Users/tpls/Logout.tpl');
    } else {
        /** @var AuthenticationController $authController */
        $authController->authController->logout();
    }
} else {
    // record the last theme the user used
    $current_user->setPreference('lastTheme', $theme);
    $GLOBALS['current_user']->call_custom_logic('before_logout');

    // submitted by Tim Scott from DotBCRM forums
    foreach ($_SESSION as $key => $val) {
        $_SESSION[$key] = ''; // cannot just overwrite session data, causes segfaults in some versions of PHP
    }
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time()-42000, '/');
    }

    DotbApplication::endSession();

    LogicHook::initialize();
    $GLOBALS['logic_hook']->call_custom_logic('Users', 'after_logout');

    /** @var AuthenticationController $authController */
    $authController->authController->logout();
}
