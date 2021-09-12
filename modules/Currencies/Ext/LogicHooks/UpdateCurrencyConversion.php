<?php


/**
 * Define the before_save hook that will determine if the currency rate changed and kick off a job to update
 * all instances of that in the app.
 */
$hook_array['before_save'][] = array(
    1,
    'updateCurrencyConversion',
    'modules/Currencies/CurrencyHooks.php',
    'CurrencyHooks',
    'updateCurrencyConversion',
);
