<?php


use Dotbcrm\Dotbcrm\Security\InputValidation\InputValidation;
use Dotbcrm\Dotbcrm\Security\InputValidation\Request;

global $current_user;

if (!$current_user->isAdminForModule('Users')) {
    dotb_die("Unauthorized access to administration.");
}

$request = InputValidation::getService();

$record = $request->getValidInputRequest('record', 'Assert\Guid');
$user_id = $request->getValidInputRequest('user_id', 'Assert\Guid');
$records = $request->getValidInputRequest(
    'records',
    array('Assert\All' => array('constraints' => 'Assert\Guid'))
);

if ((empty($record) && empty($records)) || empty($user_id)) {
    global $mod_strings;

    dotb_die($mod_strings['ERR_ADD_RECORD']);
} else {
    $focus = BeanFactory::newBean('Teams');

    if (!is_array($records)) {
        $records = array();
    }

    if (!empty($record)) {
        $records[] = $record;
    }

    foreach ($records as $id) {
        $focus->retrieve($id);
        $focus->add_user_to_team($user_id);
    }
}

header("Location: index.php?module={$_REQUEST['return_module']}&action={$_REQUEST['return_action']}&record={$_REQUEST['return_id']}");
