<?php


/**
 * @param Opportunity $focus        The Current Opportunity we are working with
 */
function perform_save($focus)
{
    global $app_list_strings, $timedate, $current_language;
    $app_list_strings = return_app_list_strings_language($current_language);

    /* @var $admin Administration */
    $admin = BeanFactory::newBean('Administration');
    $settings = $admin->getConfigForModule('Forecasts');

    // if any of the case fields are NULL or an empty string set it to the amount from the main opportunity
    if (is_null($focus->best_case) || strval($focus->best_case) === "") {
        $focus->best_case = $focus->amount;
    }

    if (is_null($focus->worst_case) || strval($focus->worst_case) === "") {
        $focus->worst_case = $focus->amount;
    }

    // Bug49495: amount may be a calculated field
    $focus->updateCalculatedFields();

    //Store the base currency value
    if (isset($focus->amount) && !number_empty($focus->amount)) {
        $focus->amount_usdollar = DotbCurrency::convertWithRate($focus->amount, $focus->base_rate);
    }
}
