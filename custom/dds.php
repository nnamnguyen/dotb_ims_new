<?php

if (php_sapi_name() === 'cli') {
    require_once __DIR__ . '/move_dates/lib/MoveDates/DateShiftRequest.php';

    $shift_request = \MoveDates\DateShiftRequest::fromSAPI();
    $shift_request->truncateFTEDbTables();
    $shift_request->execute();
    $shift_request->setTrialExpire();
}
else {
    http_response_code(404);
}
