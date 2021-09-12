<?php


namespace Dotbcrm\Dotbcrm\Security;

use JsonSerializable;

/**
 * Security subject.
 *
 * Answers the question "Who made the change?"
 */
interface Subject extends JsonSerializable
{
}
