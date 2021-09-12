<?php

require_once __DIR__ . '/move_dates/lib/MoveDates/DateShiftRequest.php';

$shift_request = \MoveDates\DateShiftRequest::fromSAPI();
$shift_request->execute();
