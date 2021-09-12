<?php


if (isset($_SESSION['authenticated_user_id']))
{
    ob_clean();
    header('Location: ' . $GLOBALS['app']->getLoginRedirect());
    dotb_cleanup(true);
    return;
}

// display the logged out screen
$smarty = new Dotb_Smarty();
$smarty->assign(array(
    'LOGIN_URL'  => 'index.php?action=Login&module=Users',
    'STYLESHEET' => getJSPath('modules/Users/login.css'),
));
$smarty->display('modules/Users/LoggedOut.tpl');
