<?php


use Dotbcrm\Dotbcrm\Security\InputValidation\InputValidation;
use Dotbcrm\Dotbcrm\DependencyInjection\Container;
use Dotbcrm\Dotbcrm\Security\Context;
use Dotbcrm\Dotbcrm\Security\Subject\EmailAddressConfirmationLink;

$request = InputValidation::getService();
$id = $request->getValidInputRequest('email_address_id', 'Assert\Guid');

global $current_user, $dotb_config;

// Retrieve admin user so that team queries are bypassed
if (empty($current_user) || empty($current_user->id)) {
    $current_user = BeanFactory::newBean('Users')->getSystemUser();
}

$ea = BeanFactory::retrieveBean('EmailAddresses', $id);
if (!empty($ea)) {
    if ($ea->opt_out) {
        $ea->opt_out = 0;
        $subject = new EmailAddressConfirmationLink($ea);
        $context = Container::getInstance()->get(Context::class);

        try {
            $context->activateSubject($subject);
            $ea->save();
        } finally {
            $context->deactivateSubject($subject);
        }
    }
}

$redirectUrl = '';
if (!empty($dotb_config['email_address_confirmation_redirect_url'])) {
    $redirectUrl = $dotb_config['email_address_confirmation_redirect_url'];
}

if (headers_sent() || empty($redirectUrl) || strlen($redirectUrl) > 2083) {
    @ob_clean();
    ob_start();
    include_once 'modules/EmailAddresses/Confirmed.php';
    $output_html = ob_get_contents();
    ob_end_clean();
    echo $output_html;
    dotb_cleanup(true);
} else {
    header("Location: {$redirectUrl}");
}
