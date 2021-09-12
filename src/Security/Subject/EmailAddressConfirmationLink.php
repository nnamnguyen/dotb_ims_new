<?php

namespace Dotbcrm\Dotbcrm\Security\Subject;

use Dotbcrm\Dotbcrm\Security\Subject;

/**
 * EmailAddressConfirmationLink subject
 */
final class EmailAddressConfirmationLink implements Subject
{
    /**
     * @test
     * @covers ::jsonSerialize
     */
    public function jsonSerialize()
    {
        return [
            '_type' => 'email-address-confirmation-link',
        ];
    }
}
